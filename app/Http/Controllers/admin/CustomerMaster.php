<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Session;
use App\Models\CustomerModel;
use Symfony\Component\HttpFoundation\StreamedResponse;
class CustomerMaster extends Controller
{
    public function index()
    {
        $searchData = trim(request()->input('search'));
        $from_date = request()->input('from_date');
        $to_date = request()->input('to_date');  
        $currentPage = request()->input('page', 1);
        $query = CustomerModel::query();
        $query->where(['mfd' => 0]);
        if (!empty($searchData)) {
            $query->where('personal_name', 'like', '%' . $searchData . '%')
                ->orWhere('Customer_Code', 'like', '%' . $searchData . '%')
                ->orWhere('surname', 'like', '%' . $searchData . '%')
                ->orWhere('email', 'like', '%' . $searchData . '%')
                ->orWhere('mobile_number', 'like', '%' . $searchData . '%')
                ->orWhere('pincode', 'like', '%' . $searchData . '%')
                ->orWhere('account_holder_name', 'like', '%' . $searchData . '%')
                ->orWhere('company_name', 'like', '%' . $searchData . '%')
                ->orWhere('bank_name', 'like', '%' . $searchData . '%');
        }
        if (!empty($from_date) && !empty($to_date)) {
            $query->whereBetween('created_at', [$from_date, $to_date]);
        }
        if(!empty(request()->input('Excel')) && request()->input('Excel')=='download-excel'){
            $this->exportCustomer($query->get());
        }
        $orders = $query->paginate(25, ['tbl_customers.*'], 'page', $currentPage);
        $data = [
            'title' => "View Customers",
            'orders' => $orders,
            'search' => $searchData, 
            'from_date' => $from_date, 
            'to_date' => $to_date,
            'currentPage'=> $currentPage,
        ];
        return view('admin.customerMaster.customerMaster', $data);
    }

    public function downloadImage($path)
    {
        // Define the path to the image in the public folder
        $filePath = public_path('admin-assets/customer_documents/'.$path);
        
        // Return a response that triggers the download
        return response()->download($filePath);
    }

    public function edit_customer($id)
    {
        $data = [];
        $data['title'] = "Edit Customer";
        $data['editData'] = CustomerModel::find($id);
        $data['domestic_fuel'] = DB::table('tbl_fuel_group')->where(['mfd'=>0])->get();
        $data['domestic_rate'] = DB::table('tbl_rate_group')->where(['mfd'=>0])->get();
        $data['international_fuel'] = DB::table('tbl_international_fuel_group')->where(['mfd'=>0])->get();
        $data['international_rate'] = DB::table('tbl_international_rate_group')->where(['mfd'=>0])->get();
        return view('admin.customerMaster.edit_customer',$data);
    }
   
    public function update_customer(Request $request)
    {
        $validation = validator::make($request->all(),
        [
              'personal_name'=>'required|string|regex:/^[a-zA-Z\s]+$/',
              'surname'=> 'required|string|regex:/^[a-zA-Z\s]+$/',
              'company_name'=> 'required|string',
              'address_line1'=> 'required',
              'address_line2'=> 'required',
              'order_idea' => 'required|numeric',
              'category_id' => 'required|numeric',
              'fuel_group_id' => 'required|numeric',
              'rate_group_id' => 'required|numeric',
              'inter_fuel_group' => 'required|numeric',
              'inter_rate_group' => 'required|numeric',
              'demo_date'=>'nullable|date_format:Y-m-d',
              'account_no' => 'numeric|min:17|max:20|nullable',
              'pincode' => 'required|numeric',
              'account_type' => 'string|nullable',
              'account_holder_name' => 'string|nullable',
              'bank_name' => 'string|nullable',
              'branch_name' => 'string|nullable',
              'gstno' => '',
              'ifsc_code' => 'string|nullable',
        ]);
        if($validation->passes())
        {
            try{
                $data = [
                    'personal_name'=>$request->personal_name,
                    'surname'=>$request->surname,
                    'company_name'=>$request->company_name,
                    'order_idea'=>$request->order_idea,
                    'category_id'=>$request->category_id,
                    'address_line1'=>$request->address_line1,
                    'address_line2'=>$request->address_line2,
                    'pincode'=>$request->pincode,
                    'demo_schedule'=>$request->demo_date,
                    'account_no'=>$request->account_no,
                    'account_type'=>$request->account_type,
                    'account_holder_name'=>$request->account_holder_name,
                    'ifsc_code'=>$request->ifsc_code,
                    'bank_name'=>$request->bank_name,
                    'branch_name'=>$request->branch_name,
                    'gstno'=>$request->gstno,
                    'fuel_group_id'=>$request->fuel_group_id,
                    'rate_group_id'=>$request->rate_group_id,
                    'inter_fuel_group'=>$request->inter_fuel_group,
                    'inter_rate_group'=>$request->inter_rate_group,
                ];
              $branch = DB::table('tbl_customers')->where('id', $request->id)->update($data);
              if ($branch) {
                DB::commit();
                $msg =  session()->flash('success', 'Customer Update successfully');
                $responce = [
                    'status'=>'success',
                    'error' => 'Customer Update successfully'
                ];
                echo json_encode($responce);exit;
            } else {
                // If creation was not successful, throw an exception
                throw new \Exception('Data not inserted');
            }
            }catch(\Exception $e){
                DB::rollBack();
                $msg =  session()->flash('faild', 'An error occurred: ' . $e->getMessage());
                $responce = [
                    'status'=>'faild',
                    'error' =>'An error occurred: ' . $e->getMessage()
                ];
                echo json_encode($responce);exit;
            }

        }else{
            $json = [
                'status'=>'false',
                'data'=> $validation->errors()
            ];
            echo json_encode($json);exit;
        }
    }    


    public function exportCustomer($data){
        // dd($data) ;
        $csvFileName = 'CustomerMaster.csv';
        $handle = fopen('php://output', 'w');
        // Set the content type and filename for the download
        header('Content-Type: text/csv');
        header('Content-Disposition: attachment; filename="' . $csvFileName . '"');
        $header = ['SR No', 'Account Code','Customer Name', 'Customer Surname','Compnay Name','Email','Mobile No','Order Type','Category','Adreess','LandMark','Pincode','Wallet Amount','Demo Shedule Date','Account No','Account Type','Account Holder Name','IFSC CODE','Bank Name','Branch Name','GST No','Domestc Fuel Group','Domestc Rate Group','International Fuel Group','Interntional Rate Group','Register Date'];
        fputcsv($handle, $header);
        $count = 1;
        // Write data rows
        foreach ($data as $row) {
            $cate = DB::table('tbl_customer_business_category')->where(['id'=> $row->category_id])->first();
            $fuel = DB::table('tbl_fuel_group')->where(['id'=> $row->fuel_group_id])->first();
            $rate = DB::table('tbl_rate_group')->where(['id'=> $row->fuel_group_id])->first();
            $rate_inter = DB::table('tbl_international_rate_group')->where(['id'=> $row->inter_rate_group])->first();
             $order =  ordersMenus()[$row->order_idea];
             $exportData = [
                $count,
                $row->Customer_Code,
                $row->personal_name,
                $row->surname,
                $row->company_name,
                $row->email,
                $row->mobile_number,
                $order,
                $cate->category_name,
                $row->address_line1,
                $row->address_line2,
                $row->pincode,
                $row->wallet_amount,
                !empty($row->demo_schedule)?$row->demo_schedule:'',
                !empty($row->account_no)?$row->account_no:'',
                !empty($row->account_type)?$row->account_type:'',
                !empty($row->account_holder_name)?$row->account_holder_name:'',
                !empty($row->ifsc_code)?$row->ifsc_code:'',
                !empty($row->bank_name)?$row->bank_name:'',
                !empty($row->branch_name)?$row->branch_name:'',
                !empty($row->gstno)?$row->gstno:'',
                $fuel->name,
                $rate->name,
                "",
                $rate_inter->name,
                date('d-m-Y h:i:A',strtotime($row->created_at)),
             ];
            $count++;
            fputcsv($handle, $exportData);
        }
        fclose($handle);
        exit;
    }


    public function VerifyData(Request $request)
    {
        try {
            DB::beginTransaction();
                $post = CustomerModel::find($request->id);
                $post->update(['verified' => '1','verified_at'=>date('Y-m-d h:i:s')]);
                $post->save();
            DB::commit();
            session()->flash('success', 'Courier Company Deleted successfully');
            $responce = [
                'status' => 'success',
                'success' => 'Customer Document successfully Verified'
            ];
            echo json_encode($responce);exit;
        } catch (\Exception $e) {
            DB::rollBack();
            session()->flash('faild', 'An error occurred: ' . $e->getMessage());
            $responce = [
                'error' =>'An error occurred: ' . $e->getMessage()
            ];
            echo json_encode($responce);exit;
        }  
    }
}
