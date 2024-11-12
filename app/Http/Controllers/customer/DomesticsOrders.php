<?php

namespace App\Http\Controllers\customer;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Log;
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
use App\Models\PickupAddress;
use App\Models\DomesticBooking;
use App\Models\DomesticRate;
use App\Models\DomesticOrdersProducts;
use App\Models\InternationalBooking;
class DomesticsOrders extends Controller
{
    protected $pincode;
    protected $rate;

   function __construct()
   {
      $this->pincode = new PincodeMaster;
      $this->rate = new DomesticRate;
   }
    public function index()
    {
        $currentPage = request()->input('page', 1);
        $domesticBooking = new DomesticBooking();
        $internationalBooking = new InternationalBooking();
        $data = [];
        $data['title'] = "View Orders";
        $data['orders'] = $domesticBooking->get_domestic_orders('', 50, $currentPage); // Page 1
        $data['interorders'] = $internationalBooking->get_international_orders('', 50, $currentPage); // Page 1
        return view('customer.orders.view_orders', $data);
    }

    public function add_orders()
    {
        $data = [];
        $data['title'] = "WLM Logistics";
        $data['state'] = DB::table('tbl_state')->get();
        $data['country'] = DB::table('tbl_country')->get();
        $data['pickup_address'] = DB::table('tbl_customers')->where(['id'=>Session('customer.id')])->first();
        $data['addressbook'] = DB::table('tbl_pickup_address')->where(['customer_id'=>Session('customer.id'),'mfd'=>0])->get();
        return view('customer.orders.add_order',$data);
    }
    public function get_pincode(Request $request)
    {
        $validation =  validator::make($request->all(),[
            'pincode' => 'required|numeric|min:6',
        ]);
        if($validation->passes()){
            $pincode = $request->input('pincode');
            $data = DB::table('tbl_pincode')->where(['pincode'=>$pincode,'mfd'=>0])->first();
               
            if(!empty($data)){ 
                $city = DB::table('tbl_city')->where(['id'=>$data->id,'mfd'=>0])->first();
                $json = [
                        'status'=>'True',
                        'data'=>['state'=>$data->state_id,'city'=>$city->name,'country'=>'india']
                    ];
            }else{
                $json = [
                    'status'=>'faild',
                    'data'=> ['msg'=>"This Pincode Not In system."]
                ];
            }
        }else{
            $json = [
                'status'=>'false',
                'data'=> $validation->errors()
            ];
        }
        return json_encode($json);
    }

    public function pickup_address_store(Request $request)
    {
        $validation = Validator::make($request->all(), [
            'add_pickup_address' => 'required|unique:tbl_pickup_address,address',
            'pickup_contact_person' => 'required|string',
            'pickup_contact_no' => 'required|numeric|digits:10',
            'pickup_landmark' => 'required|string',
            'pickup_pincode' => 'required|numeric|digits:6',
        ]);
        if($validation->passes())
        {
            try{
               
                $AddressBook = [
                    'customer_id' => session('customer.id'),
                    'contact_person' =>$request->pickup_contact_person,
                    'contact_no' =>$request->pickup_contact_no,
                    'alter_contact_no' =>$request->pickup_alter_contact,
                    'email' =>$request->pickup_email,
                    'address' =>$request->add_pickup_address,
                    'landmark' =>$request->pickup_landmark,
                    'pincode' =>$request->pickup_pincode,
                ];
            
                DB::beginTransaction();
                $pickupaddress =  PickupAddress::create($AddressBook);
                $lastInsertedId = $pickupaddress->id;
                $data =  PickupAddress::find($lastInsertedId);
                $option = "<option value='".$lastInsertedId."'>".$data->address."</option>";
                if ($pickupaddress) {
                    DB::commit();
                    $msg =  session()->flash('success', 'Address added successfully');
                    $responce = [
                        'status'=>'success',
                        'error' => 'Address added successfully',
                        'data'=> $option
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
    
    public function store_orders(Request $request)
    {
        // dd($request->all());
        $validation = Validator::make($request->all(), [
            'buy_mobile' => 'required|numeric|digits:10',
            'buy_full_name' => 'required|string',
            // 'buy_alter_mobile' => 'numeric|digits:10',
            // 'buy_company_name' => 'string',
            'buy_delivery_address' => 'required',
            'buy_delivery_landmark' => 'required',
            'buy_delivery_pincode' => 'required|numeric|digits:6',
            'buy_delivery_city' => 'required|string',
            'buy_delivery_state' => 'required|numeric',
            'buy_delivery_country' => 'required|string',
            // 'buy_billing_mobile' => 'numeric|digits:10',
            // 'buy_full_billing_name' => 'string',
            // 'buy_billing_email' => 'string',
            // 'buy_delivery_billing_address' => 'string',
            // 'buy_delivery_billing_landmark' => 'string',
            // 'buy_delivery_billing_pincode' => 'numeric|digits:6',
            // 'buy_delivery_billing_city' => 'string',
            // 'buy_delivery_billing_state' => 'numeric',
            // 'buy_delivery_billing_country' => 'string',
            // 'pickup_address' => 'required',
            // 'pickup_contact_person' => 'string',
            // 'pickup_contact_no' => 'numeric|digits:10',
            // 'pickup_alter_contact' => 'numeric|digits:10',
            // 'pickup_email' => 'string',
            // 'add_pickup_address' => 'string',
            // 'pickup_landmark' => 'string',
            // 'pickup_pincode' => 'numeric|digits:6',
            // 'pickup_city' => 'string',
            // 'pickup_state' => 'numeric',
            // 'pickup_country' => 'string',
            'order_shipping_charges' => 'numeric',
            'order_gift_wrap' => 'numeric',
            'order_transaction_fee' => 'numeric',
            'order_discounts' => 'numeric',
            'product_sub_total' => 'numeric',
            'product_other_charges' => 'numeric',
            'product_discount' => 'numeric',
            'order_total' => 'numeric',
            'dead_weight' => 'numeric',
            'length' => 'numeric',
            'breath' => 'numeric',
            'height' => 'numeric',
            'voluematrix_weight' => 'numeric',
            'applicable_weight' => 'numeric',
        ]);
        if($validation->passes())
        {
              $series = 500000000;
              $MAxID = DomesticBooking::max('id');
              $Usid = $MAxID + 1;
              $orderId = $series + $Usid;
            try{
                $orderData = [
                    'order_id' => $orderId,
                    'created_id' => session('customer.id'),
                    'created_by' => session('customer.personal_name').' '.session('customer.surname'),
                    'order_channel' =>$request->order_channel,
                    'order_tag' =>$request->order_tag,
                    'resellar_name' =>$request->resellar_name,
                    'paymentMode' =>$request->paymentMode,
                    'buy_full_name' =>$request->buy_full_name,
                    'buy_mobile' =>$request->buy_mobile,
                    'buy_email' =>$request->buy_email,
                    'buy_alter_mobile' =>$request->buy_alter_mobile,
                    'buy_company_name' =>$request->buy_company_name,
                    'buy_gst_in' =>$request->buy_gst_in,
                    'buy_delivery_address' =>$request->buy_delivery_address,
                    'buy_delivery_landmark' =>$request->buy_delivery_landmark,
                    'buy_delivery_pincode' =>$request->buy_delivery_pincode,
                    'pickup_address' =>$request->pickup_address,
                    'billing_status' =>$request->billing_status,
                    'buy_full_billing_name' =>$request->buy_full_billing_name,
                    'buy_billing_mobile' =>$request->buy_billing_mobile,
                    'buy_billing_email' =>$request->buy_billing_email,
                    'buy_delivery_billing_address' =>$request->buy_delivery_billing_address,
                    'buy_delivery_billing_landmark' =>$request->buy_delivery_billing_landmark,
                    'buy_delivery_billing_pincode' =>$request->buy_delivery_billing_pincode,
                    'order_shipping_charges' =>$request->order_shipping_charges,
                    'order_gift_wrap' =>$request->order_gift_wrap,
                    'order_transaction_fee' =>$request->order_transaction_fee,
                    'order_discounts' =>$request->order_discounts,
                    'product_sub_total' =>$request->product_sub_total,
                    'product_other_charges' =>$request->product_other_charges,
                    'product_discount' =>$request->product_discount,
                    'order_total' =>$request->order_total,
                    'dead_weight' =>$request->dead_weight,
                    'length' =>$request->length,
                    'breath' =>$request->breath,
                    'height' =>$request->height,
                    'voluematrix_weight' =>$request->voluematrix_weight,
                    'applicable_weight' =>$request->applicable_weight,
                ];
                
                // try {
                //     $orderBooking = DomesticBooking::create($orderData);
                //     dd($orderBooking);
                // } catch (\Exception $e) {
                //     dd($e->getMessage());
                // }
               
                DB::beginTransaction();
                   $orderBooking =  DomesticBooking::create($orderData);
                //    dd($orderBooking);
                   $booking_id = $orderBooking->id; // last genrated Id

                   // product insetion 
                    for ($i = 0; $i < count($request->productName); $i++) {
                         $productData = [
                            'booking_id' =>  $booking_id,
                            'productName'=> $request->productName[$i],
                            'unitPrice'=> $request->unitPrice[$i],
                            'quantity'=> $request->quantity[$i],
                            'productCategory'=> $request->productCategory[$i],
                            'order_hsn_code'=> $request->order_hsn_code[$i],
                            'order_sku'=> $request->order_sku[$i],
                            'order_tax_rate'=> $request->order_tax_rate[$i],
                            'order_product_discount'=> $request->order_product_discount[$i],
                         ];
                         $productBooking =  DomesticOrdersProducts::create($productData);
                    }

                if ($orderBooking) {
                    DB::commit();
                    $msg =  session()->flash('success', 'Order added successfully');
                    $responce = [
                        'status'=>'success',
                        'error' => 'Order added successfully',
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

    // Rate Calculation function 
    public function RateCalculate($mode,$courier,$fuel_id,$group_id,$fromPincode,$toPincode,$applicableWeight,$booking_date)
    {
        $from_z = $this->pincode->pincodeZone($fromPincode->pincode);
        $to_z = $this->pincode->pincodeZone($toPincode->pincode);
        $fromZone = !empty($from_z)?$from_z->id : 0;
        $toZone =  !empty($to_z)?$to_z->id : 0;
        $rate = $this->rate->RateCalulate($mode,$courier,$group_id,$fromZone,$toZone,$applicableWeight,$booking_date);
        $fuelCh = DB::table('tbl_fuel_master')->where('group_id',$fuel_id)->first();
        if(!empty($rate) && !empty($fuelCh))
        {
            $fuelPrice =  $rate->rate / 100 * $fuelCh->fuel_price;
            $fovPrice =  $rate->rate / 100 * $fuelCh->fov;
            if($rate->fixed_perkg == 4)
            {
                $fixedRate = $this->rate->RateCalulateFixed($courier,$group_id,$fromZone,$toZone,$applicableWeight,$booking_date);
                $weight = $applicableWeight - $fixedRate->to_weight; 
                $rateAmount = $fixedRate->rate;
                $Calculatedrate = $weight * $rate->rate;
                $calculatedFright =  $rateAmount + $Calculatedrate + $fuelCh->docket_charges + $fuelPrice +  $fovPrice;       
                if($rate->minimum_rate >= $calculatedFright)
                {
                   $fright = $rate->minimum_rate;
                }else{
                    $fright = $calculatedFright;
                }
            }else{
                $calculatedFright =  $rate->rate + $fuelCh->docket_charges + $fuelPrice +  $fovPrice;       
                if($rate->minimum_rate >= $calculatedFright)
                {
                   $fright = $rate->minimum_rate;
                }else{
                    $fright = $calculatedFright;
                }
            }
        }
        return $data = [$fright,$rate->tat,$rate->mode_id];
    }
    
    // Model to get booking list 
    public function getModel(Request $request)
    {
        $id = $request->id;
        $data['booking_data'] = DB::table('tbl_domestic_booking')->where(['id'=>$id])->first();
        if(!empty($data['booking_data'])){
        // from address
        if($data['booking_data']->pickup_address== 'primary')
        {
            $customer = DB::table('tbl_customers')->where(['id'=>session('customer.id')])->first();
            $pincodewhere = ['tbl_pincode.pincode' => $customer->pincode];
            $frompin =  $this->pincode->pincodedata($pincodewhere);
            $data['from_address'] = $customer->address_line1.','.$customer->address_line2.','.$frompin->city.','.$frompin->state.' '.$frompin->pincode;
        }else{
            $customer = DB::table('tbl_pickup_address')->where(['id'=>$data['booking_data']->pickup_address])->first();
            $pincodewhere = ['tbl_pincode.pincode' => $customer->pincode];
            $frompin =  $this->pincode->pincodedata($pincodewhere);
            $data['from_address'] = $customer->address.','.$customer->landmark.','.$frompin->city.','.$frompin->state.' '.$frompin->pincode;
        }
        // To Address
         if($data['booking_data']->billing_status == "on")
         {
            $pincodewhere = ['tbl_pincode.pincode' => $data['booking_data']->buy_delivery_pincode];
            $topin =  $this->pincode->pincodedata($pincodewhere);
            $data['to_address'] = $data['booking_data']->buy_delivery_address.','.$data['booking_data']->buy_delivery_landmark.','.$frompin->city.','.$frompin->state.' '.$frompin->pincode;
         }else{
            $pincodewhere = ['tbl_pincode.pincode' => $data['booking_data']->buy_delivery_pincode];
            $topin =  $this->pincode->pincodedata($pincodewhere);
            $data['to_address'] = $data['booking_data']->buy_delivery_billing_address.','.$data['booking_data']->buy_delivery_billing_landmark.','.$frompin->city.','.$frompin->state.' '.$frompin->pincode;
         }
         $rate_id = DB::table('tbl_customers')->where(['id'=>session('customer.id')])->first();
         $courier_company = DB::table('tbl_courier_company')->where(['status'=>0,'mfd'=>0])->get();
         $delDate = date('Y-m-d',strtotime($data['booking_data']->orderDate));
         $data['courier_company'] = [];
         $from_z = $this->pincode->pincodeZone($frompin->pincode);
         $to_z = $this->pincode->pincodeZone($topin->pincode);
         $fromZone = !empty($from_z)?$from_z->id : 0;
         $toZone =  !empty($to_z)?$to_z->id : 0;
        $modewiseRate = $this->rate->CustomerRate($rate_id->fuel_group_id,$fromZone,$toZone,$data['booking_data']->applicable_weight,date('Y-m-d',strtotime($data['booking_data']->orderDate)));
        // dd($modewiseRate);
        foreach($modewiseRate as $key=>$val)
        {
            $rate = $this->RateCalculate($val->mode_id,$val->courier,$rate_id->fuel_group_id,$rate_id->rate_group_id,$frompin, $topin, $data['booking_data']->applicable_weight, $data['booking_data']->orderDate);
            $daysToAdd = $rate[1];
            $mode = DB::table('tbl_transfer_mode')->where(['id'=>$val->mode_id])->first();
            $courier = DB::table('tbl_courier_company')->where(['id'=>$val->courier,'mfd'=>0,'status'=>0])->first();
            if(!empty($rate)){
                $exists = false;
                foreach ($data['courier_company'] as $existing) {
                    if ($existing['mode_id'] == $mode->id && $existing['company_id'] == $val->courier) {
                        $exists = true;
                        break;
                    }
                }
                // Only add if not already exists
                if (!$exists) {
                    $data['courier_company'][] = [
                        'company_name' => $courier->company_name,
                        'amount' => $rate[0],
                        'company_id' => $val->courier,
                        'mode' => $mode->mode_name,
                        'mode_id' => $mode->id,
                        'deliverydate' => date('M d Y', strtotime("$delDate + $daysToAdd days")),
                        'pickupdate' => date('M d Y', strtotime($delDate))
                    ];
                }
            }
        }
         $responce = [
            'status' => 'success',
            'data'=> $data
         ];
         echo json_encode($responce);
        }
    }
}
