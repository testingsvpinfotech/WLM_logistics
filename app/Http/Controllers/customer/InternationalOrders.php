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
use App\Models\DomesticOrdersProducts;
use App\Models\InternationalOrdersProduct;
use App\Models\InternationalBooking;
class InternationalOrders extends Controller
{

    public function index()
    {
        $currentPage = request()->input('page', 1);
        $domesticBooking = new DomesticBooking();
        $internationalBooking = new InternationalBooking();
        $data = [];
        $data['title'] = "View Orders";
        $data['interorders'] = $internationalBooking->get_international_orders('', 50, $currentPage); // Page 1
        return view('customer.orders.view_international', $data);
    }
    public function add_orders()
    {
        $data = [];
        $data['title'] = "WLM Logistics";
        $data['state'] = DB::table('tbl_state')->get();
        $data['country'] = DB::table('tbl_country')->get();
        $data['pickup_address'] = DB::table('tbl_customers')->where(['id'=>Session('customer.id')])->first();
        $data['addressbook'] = DB::table('tbl_pickup_address')->where(['customer_id'=>Session('customer.id'),'mfd'=>0])->get();
        return view('customer.orders.add_international_order',$data);
    }
    public function store_orders(Request $request)
    {
        // dd($request->all());
        $validation = Validator::make($request->all(), [
            'inter_buy_mobile' => 'required|numeric|digits:10',
            'inter_buy_full_name' => 'required|string',
            // 'buy_alter_mobile' => 'numeric|digits:10',
            // 'buy_company_name' => 'string',
            'inter_buy_address_line1' => 'required',
            // 'inter_buy_delivery_landmark' => 'required',
            'inter_buy_pincode' => 'required|numeric|digits:6',
            'inter_buy_state' => 'required|string',
            'inter_buy_city' => 'required|string',
            'inter_country_id' => 'required|numeric',
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
            'inter_order_shipping_charges' => 'numeric',
            'inter_order_gift_wrap' => 'numeric',
            'inter_order_transaction_fee' => 'numeric',
            'inter_order_discounts' => 'numeric',
            'inter_product_sub_total' => 'numeric',
            'inter_product_other_charges' => 'numeric',
            'inter_product_discount' => 'numeric',
            'inter_order_total' => 'numeric',
            'inter_dead_weight' => 'numeric',
            'inter_length' => 'numeric',
            'inter_breath' => 'numeric',
            'inter_height' => 'numeric',
            'inter_voluematrix_weight' => 'numeric',
            'inter_applicable_weight' => 'numeric',
        ]);
        if($validation->passes())
        {
              $series = 100000000;
              $MAxID = InternationalBooking::max('id');
              $Usid = $MAxID + 1;
              $orderId = $series + $Usid;
            try{
                $orderData = [
                    'order_id' => $orderId,
                    'created_id' => session('customer.id'),
                    'created_by' => session('customer.personal_name').' '.session('customer.surname'),
                    'order_channel' =>$request->inter_order_channel,
                    'order_tag' =>$request->inter_order_tag,
                    'channel_invoice' =>$request->inter_channel_invoice,
                    'channel_invoice_date' =>$request->inter_channel_invoice_date,
                    'payment_transaction_id' =>$request->inter_payment_transection_id,
                    'transaction_url' =>$request->inter_transection_url,
                    'signature_type' =>$request->inter_signature_type,
                    '3C_applicable' =>$request->inter_3Capplicable,
                    'Meis_applicable' =>$request->inter_Meis_applicable,
                    'Payment_Status' =>$request->inter_Payment_Status,
                    'Inco_Terms' =>$request->inter_Inco_Terms,
                    'tax_id' =>$request->inter_tax_id,
                    'payment_mode' =>$request->inter_paymentMode,
                    'ship_to_fba' =>$request->ship_to_fba,
                    'shipment_purpose' =>$request->shipment_purpose,
                    'buy_delivery_country_id' =>$request->inter_country_id,
                    'buy_delivery_currency_id' =>$request->inter_currency_id,
                    'buy_full_name' =>$request->inter_buy_full_name,
                    'buy_mobile' =>$request->inter_buy_mobile,
                    'pickup_address' =>$request->inter_pickup_address,
                    'buy_email' =>$request->inter_buy_email,
                    'buy_alter_mobile' =>$request->inter_buy_alter_mobile,
                    'buy_company_name' =>$request->inter_buy_company_name,
                    'buy_gst_in' =>$request->inter_buy_gst_in,
                    'buy_delivery_addressline1' =>$request->inter_buy_address_line1,
                    'buy_delivery_addressline2' =>$request->inter_buy_address_line2,
                    'buy_delivery_pincode' =>$request->inter_buy_pincode,
                    'buy_delivery_state' =>$request->inter_buy_state,
                    'buy_delivery_city' =>$request->inter_buy_city,
                    'billing_status' =>$request->inter_billing_status,
                    'buy_full_billing_name' =>$request->inter_buy_full_billing_name,
                    'buy_billing_mobile' =>$request->inter_buy_billing_mobile,
                    'buy_billing_email' =>$request->inter_buy_billing_email,
                    'buy_delivery_billing_addressline1' =>$request->inter_delivery_address_line1,
                    'buy_delivery_billing_addressline2' =>$request->inter_delivery_address_line2,
                    'delivery_country_id' =>$request->inter_delivery_country_id,
                    'buy_delivery_billing_pincode' =>$request->inter_delivery_pincode,
                    'buy_delivery_billing_state' =>$request->inter_delivery_state,
                    'buy_delivery_billing_city' =>$request->inter_delivery_city,
                    'order_shipping_charges' =>$request->inter_order_shipping_charges,
                    'order_gift_wrap' =>$request->inter_order_gift_wrap,
                    'order_transaction_fee' =>$request->inter_order_transaction_fee,
                    'order_discounts' =>$request->inter_order_discounts,
                    'product_sub_total' =>$request->inter_product_sub_total,
                    'product_other_charges' =>$request->inter_product_other_charges,
                    'product_discount' =>$request->inter_product_discount,
                    'order_total' =>$request->inter_order_total,
                    'dead_weight' =>$request->inter_dead_weight,
                    'length' =>$request->inter_length,
                    'breath' =>$request->inter_breath,
                    'height' =>$request->inter_height,
                    'voluematrix_weight' =>$request->inter_voluematrix_weight,
                    'applicable_weight' =>$request->inter_applicable_weight,
                ];
                //  dd($orderData);
                DB::beginTransaction();
                    try {
                        $orderBooking = InternationalBooking::create($orderData);
                        // dd($orderBooking);
                    } catch (\Exception $e) {
                        dd($e->getMessage());
                    }
                   $booking_id = $orderBooking->id; // last genrated Id

                   // product insetion 
                    for ($i = 0; $i < count($request->inter_productName); $i++) {
                         $productData = [
                            'booking_id' =>  $booking_id,
                            'productName'=> $request->inter_productName[$i],
                            'unitPrice'=> $request->inter_unitPrice[$i],
                            'quantity'=> $request->inter_quantity[$i],
                            'productCategory'=> $request->inter_productCategory[$i],
                            'productdescription'=> $request->inter_productCategory[$i],
                            'order_hsn_code'=> $request->inter_order_hsn_code[$i],
                            'order_sku'=> $request->inter_order_sku[$i],
                            'order_tax_rate'=> $request->inter_order_tax_rate[$i],
                            'order_product_discount'=> $request->inter_order_product_discount[$i],
                         ];
                         $productBooking =  InternationalOrdersProduct::create($productData);
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
                // DB::rollBack();
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
}
