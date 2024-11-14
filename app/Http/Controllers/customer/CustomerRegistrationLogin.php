<?php

namespace App\Http\Controllers\customer;
use Carbon\Carbon;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Session;
use App\Models\CustomerModel;
use App\Models\BusinessCategory;
use App\Models\OTP;
use App\Models\PincodeMaster;
use App\Models\CityMaster;
use App\Models\StateMaster;
class CustomerRegistrationLogin extends Controller
{
    public function index()
    {
        session('customer');
        $data = [];
        $data['title'] = "WLM LOGISTICS";
        return view('customer.register',$data);
    }

    public function store_register(Request $request)
    {
        $validation = Validator::make($request->all(), [
            'email' => 'required|string|email|unique:tbl_customers,email',
            'password' => 'required|min:8',
            'personal_name' => 'required|string|regex:/^[a-zA-Z\s]+$/',
            'company_name' => 'required|string',
            'surname' => 'required|string|regex:/^[a-zA-Z\s]+$/',
            'mobile_number' => 'required|digits:10',
            'order_idea' => 'required|numeric',
        ]);

        if ($validation->passes()) {
            try {
                $userData = [
                    'email' => $request->email,
                    'personal_name' => ucfirst($request->personal_name),
                    'surname' => ucfirst($request->surname),
                    'company_name' => ucfirst($request->company_name),
                    'password' => Hash::make($request->password),
                    'mobile_number' => $request->mobile_number,
                    'order_idea' => $request->order_idea,
                    'wallet_amount' => '0.00',
                    'created_at' => date('Y-m-d H:i:s'),
                ];

                DB::beginTransaction();

                $customer = CustomerModel::create($userData);
                $lastInsertedId = $customer->id;

                // Store customer data in session
                $sessionData = CustomerModel::find($lastInsertedId);
                Session::put('customer', $sessionData);

                $otpCode = rand(100000, 999999);
                $otpStatus = SendOtp($request->mobile_number,$otpCode);
                if($otpStatus == 'true'){
                    OTP::create([
                        'customer_id' => $lastInsertedId,
                        'otp' => $otpCode,
                        'expires_at' => Carbon::now()->addMinutes(2),
                        'created_at' => now(),
                    ]);
                }
              

                if ($customer) {
                    DB::commit();
                    return response()->json([
                        'status' => 'success',
                        'message' => 'Sign up successfully',
                        'rid' => route('otp-view'),
                    ]);
                } else {
                    throw new \Exception('Data not inserted');
                }
            } catch (\Exception $e) {
                DB::rollBack();
                return response()->json([
                    'status' => 'fail',
                    'error' => 'An error occurred: ' . $e->getMessage(),
                ]);
            }
        } else {
            return response()->json([
                'status' => 'fail',
                'errors' => $validation->errors(),
            ]);
        }
    }

    public function resendOTP(Request $request)
    {
        $mobile_number = session('customer.mobile_number');
        $customerId = session('customer.id');
        $otpCode = rand(100000, 999999);
        $otpStatus = SendOtp($mobile_number,$otpCode);
        if($otpStatus == 'true'){
            OTP::create([
                'customer_id' => $customerId,
                'otp' => $otpCode,
                'expires_at' => Carbon::now()->addMinutes(2),
                'created_at' => now(),
            ]);
            return response()->json([
                'status' => 'success',
                'message' => 'OTP Send successfully',
            ]);
        }
    }
    public function otpview()
    {
        $customerId = Session::get('customer.id'); // Corrected session retrieval
        if (!$customerId) {
            abort(404, 'Session data not found');
        }
        $data['editData'] = CustomerModel::find($customerId);
        $data['otpCode'] = OTP::where('customer_id', $customerId)->latest()->first();
        $data['title'] = "WLM LOGISTICS";

        return view('customer.otp_verification', $data);
    }

    public function verify_otp(Request $request)
    {
        // dd($request->all());
        $otpRecord = Otp::where('customer_id', $request->id)
        ->where('expires_at', '>=', Carbon::now())
        ->latest()
        ->first();
          // Check if the validation fails
        if (!$otpRecord) {
            $responce = [
                'status'=>'false',
                'data' => "OTP has expired or is invalid"
            ];
            echo json_encode($responce);exit;
        }else{
            try {
                DB::beginTransaction();
                    $post = CustomerModel::find($request->id);
                    $post->update([
                        'mobile_verification_status' => 1]);
                    $post->save();
                DB::commit();
                session()->flash('success', 'Otp Verify successfully');
                $responce = [
                    'status'=>'success',
                    'error' => 'Otp Verify successfully'
                ];
                echo json_encode($responce);exit;
            } catch (\Exception $e) {
                DB::rollBack();
                session()->flash('faild', 'An error occurred: ' . $e->getMessage());
                $responce = [
                    'status'=>'faild',
                    'error' =>'An error occurred: ' . $e->getMessage()
                ];
                echo json_encode($responce);exit;
            }  
        }
    }
   
    

    public function checkout_category()
    {   
        $data = [];
        $id = session('customer.id');
        $data['title'] = "WLM LOGISTICS";
        $data['BusinessCategory'] = BusinessCategory::where(['status'=>0,'mfd'=>0])->get();
        return view('customer.view_category',$data);
    }
    public function address_details()
    {   
        $data = [];
        $id = session('customer.id');
        $data['title'] = "WLM LOGISTICS";
        return view('customer.address_updation',$data);
    }

    public function getpincode(Request $request)
    {
        // dd($request->all());
          $pincode = PincodeMaster::where(['pincode'=>$request->pincode,'mfd'=>'0'])->first();
            if($pincode){
                $city = CityMaster::find($pincode->city_id);
                $state = StateMaster::find($pincode->state_id);
                $responce = [
                    'status'=>'success',
                    'data' => ['city'=>$city->name,'state'=>$state->name,'country'=>'india']
                ];
                echo json_encode($responce);exit;
            }else{
                $responce = [
                    'status'=>'false',
                    'data' => ''
                ];
                echo json_encode($responce);exit;
            }

    }
    public function update_category(Request $request)
    {
        // dd($request->all());
            try {
                DB::beginTransaction();
                $id = session('customer.id');
                    $post = CustomerModel::find($id);
                    $post->update([
                        'category_id' => $request->category_id]);
                    $post->save();
                DB::commit();
                session()->flash('success', 'Category Update successfully');
                $responce = [
                    'status'=>'success',
                    'error' => 'Category Update successfully'
                ];
                echo json_encode($responce);exit;
            } catch (\Exception $e) {
                DB::rollBack();
                session()->flash('faild', 'An error occurred: ' . $e->getMessage());
                $responce = [
                    'status'=>'faild',
                    'error' =>'An error occurred: ' . $e->getMessage()
                ];
                echo json_encode($responce);exit;
            }  
    }

    public function addressupdate(Request $request)
    {
        $validation = Validator::make($request->all(), [
            'address_line1' => 'required',
            'address_line2' => 'required',
            'pincode' => 'required|digits:6',
            'city' => 'required|string',
            'state' => 'required',
            'country' => 'required'
        ]);

        if ($validation->passes()) {
            try {
                $userData = [
                    'pincode' => $request->pincode,
                    'address_line1' => ucfirst($request->address_line1),
                    'address_line2' => ucfirst($request->address_line2),
                ];

                DB::beginTransaction();
                $id = session('customer.id');
                $post = CustomerModel::find($id);
                $post->update($userData);
                $post->save();
                if ($post) {
                    DB::commit();
                    return response()->json([
                        'status' => 'success',
                        'message' => 'Sign up successfully',
                        'rid' => route('app.dashboard'),
                    ]);
                } else {
                    throw new \Exception('Data not inserted');
                }
            } catch (\Exception $e) {
                DB::rollBack();
                return response()->json([
                    'status' => 'fail',
                    'error' => 'An error occurred: ' . $e->getMessage(),
                ]);
            }
        } else {
            return response()->json([
                'status' => 'false',
                'data' => $validation->errors(),
            ]);
        }
    }

    public function customer_login()
    {
        $data = [];
        $data['title'] = 'WLM Logistics Sign In';
        return view('customer.customer_login',$data);
    }

    public function app_login(Request $request)
     {
         $validation = Validator::make($request->all(), [
             'email' => 'required|string',
             'password' => 'required|min:8'
         ]);
     
         // Check if validation passes
         if ($validation->passes()) {
             // dd($request->all());
             $user = CustomerModel::where(['email'=>$request->email,'mfd'=>0])->first();
             if(empty($user))
             {
                 $json = [
                     'status' => 'faild',
                     'data'   => 'User Not Exist Please check Email'
                 ];
                 return response()->json($json);
             }else{
                 if (Hash::check($request->password, $user->password)) {
                     // Password is correct, proceed with login
                     Session::put(['customer' => $user]);                
                     $json = [
                         'status' => 'success',
                         'data'   => 'Login successful.'
                     ];
                     return response()->json($json);
                 } else {
                     // Password is incorrect
                     $json = [
                         'status' => 'faild',
                         'data'   => 'Incorrect password. Please enter the correct password.'
                     ];
                     return response()->json($json);
                 }
             }
         } else {
             // Return JSON response for validation errors
             $json = [
                 'status' => 'false',
                 'data'   => $validation->errors()
             ];
             return response()->json($json);
         }
     }

}
