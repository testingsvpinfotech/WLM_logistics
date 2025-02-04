<?php

namespace App\Http\Controllers\customer;

use App\Http\Controllers\Controller;
use App\Models\DomesticBooking;
use App\Models\DomesticOrdersProducts;
use App\Models\DomesticRate;
use App\Models\PickupAddress;
use App\Models\PincodeMaster;
use App\Models\StackManager;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;
use Illuminate\Validation\Rules\Exists;

class DomesticsOrders extends Controller
{
    protected $pincode;
    protected $rate;
    protected $domestic;

    public function __construct()
    {
        $this->pincode = new PincodeMaster;
        $this->rate = new DomesticRate;
        $this->domestic = new DomesticBooking;
    }
    //  All Orders
    public function index()
    {
        $searchData = request()->input('search');
        $from_date = !empty(request()->input('from_date')) ? request()->input('from_date') : date('Y-m-01');
        $to_date = !empty(request()->input('to_date')) ? request()->input('to_date') : date('Y-m-d');
        $currentPage = request()->input('page', 1);
        $query = DomesticBooking::query();

        $query->join('tbl_shipment_stock_manager', 'tbl_domestic_booking.booking_id', '=', 'tbl_shipment_stock_manager.booking_id')
            ->join('tbl_domestic_weight_details', 'tbl_domestic_booking.booking_id', '=', 'tbl_domestic_weight_details.booking_id')
            ->join('tbl_domestic_booking_invoice', 'tbl_domestic_booking.booking_id', '=', 'tbl_domestic_booking_invoice.booking_id')
            ->join('tbl_customers', 'tbl_customers.id', '=', 'tbl_domestic_booking.customer_id')
            ->where(['tbl_domestic_booking.mfd' => 0, 'tbl_shipment_stock_manager.shipment_type' => 1, 'tbl_domestic_booking.customer_id' => Session('customer.id')]);

        if (!empty($searchData)) {
            $query->where(function ($query) use ($searchData) {
                $query->where('tbl_domestic_booking.order_id', 'like', '%' . $searchData . '%')
                    ->orWhere('tbl_domestic_booking.buy_full_name', 'like', '%' . $searchData . '%');
            });
        }

        if (!empty($from_date) && !empty($to_date)) {
            $query->whereBetween('tbl_domestic_booking.booking_date', [$from_date, $to_date]);
        }

        $orders = $query->paginate(50, [
            'tbl_domestic_booking.*',
            'tbl_domestic_booking_invoice.*',
            'tbl_customers.*',
            'tbl_domestic_weight_details.*'
        ], 'page', $currentPage);
        $count = $this->domestic->get_listing_count(Session('customer.id'), $from_date, $to_date);
        $data = [
            'title' => "All Orders",
            'orders' => $orders,
            'search' => $searchData,
            'from_date' => $from_date,
            'to_date' => $to_date,
            'all_orders' => $count['all_orders'],
            'Unprocessable' => $count['Unprocessable'],
            'Processing' => $count['Processing'],
            'Ready_to_ship' => $count['Ready_to_ship'],
            'Manifest' => $count['Manifest'],
            'Return' => $count['Return']
        ];

        return view('customer.orders.view_orders', $data);
    }

    // Unprocessing Ordrs
    public function UnprocessOrders()
    {
        $searchData = request()->input('search');
        $from_date = !empty(request()->input('from_date')) ? request()->input('from_date') : date('Y-m-01');
        $to_date = !empty(request()->input('to_date')) ? request()->input('to_date') : date('Y-m-d');
        $currentPage = request()->input('page', 1);
        $query = DomesticBooking::query();
        $query->join('tbl_shipment_stock_manager', 'tbl_domestic_booking.id', '=', 'tbl_shipment_stock_manager.booking_id');
        $query->where(['tbl_domestic_booking.mfd' => 0, 'tbl_shipment_stock_manager.shipment_type' => 1, 'tbl_shipment_stock_manager.order_booked' => 1, 'tbl_shipment_stock_manager.api_booked' => 0, 'tbl_shipment_stock_manager.pickup' => 0, 'tbl_domestic_booking.created_id' => Session('customer.id')]);
        if (!empty($searchData)) {
            $query->where('tbl_domestic_booking.order_id', 'like', '%' . $searchData . '%')
                ->orWhere('tbl_domestic_booking.buy_full_name', 'like', '%' . $searchData . '%');
        }
        if (!empty($from_date) && !empty($to_date)) {
            $query->whereBetween('tbl_domestic_booking.orderDate', [$from_date, $to_date]);
        } else {
            $query->whereBetween('tbl_domestic_booking.orderDate', [$from_date, $to_date]);
        }
        $orders = $query->paginate(50, ['tbl_domestic_booking.*'], 'page', $currentPage);
        $count = $this->domestic->get_listing_count(Session('customer.id'), $from_date, $to_date);
        $data = [
            'title' => "Not Shipped",
            'orders' => $orders,
            'search' => $searchData,
            'from_date' => $from_date,
            'to_date' => $to_date,
            'all_orders' => $count['all_orders'],
            'Unprocessable' => $count['Unprocessable'],
            'Processing' => $count['Processing'],
            'Ready_to_ship' => $count['Ready_to_ship'],
            'Manifest' => $count['Manifest'],
            'Return' => $count['Return']
        ];
        return view('customer.orders.view_UnprocessOrders_orders', $data);
    }
    // Processing Ordrs
    public function ProcessOrders()
    {
        $searchData = request()->input('search');
        $from_date = !empty(request()->input('from_date')) ? request()->input('from_date') : date('Y-m-01');
        $to_date = !empty(request()->input('to_date')) ? request()->input('to_date') : date('Y-m-d');
        $currentPage = request()->input('page', 1);
        $query = DomesticBooking::query();
        $query->join('tbl_shipment_stock_manager', 'tbl_domestic_booking.id', '=', 'tbl_shipment_stock_manager.booking_id');
        $query->where(['tbl_domestic_booking.mfd' => 0, 'tbl_shipment_stock_manager.shipment_type' => 1, 'tbl_shipment_stock_manager.order_booked' => 1, 'tbl_shipment_stock_manager.api_booked' => 1, 'tbl_domestic_booking.created_id' => Session('customer.id'), 'tbl_shipment_stock_manager.lable_genration' => 0, 'tbl_shipment_stock_manager.pickup' => 0]);
        if (!empty($searchData)) {
            $query->where('tbl_domestic_booking.order_id', 'like', '%' . $searchData . '%')
                ->orWhere('tbl_domestic_booking.buy_full_name', 'like', '%' . $searchData . '%');
        }
        if (!empty($from_date) && !empty($to_date)) {
            $query->whereBetween('tbl_domestic_booking.orderDate', [$from_date, $to_date]);
        } else {
            $query->whereBetween('tbl_domestic_booking.orderDate', [$from_date, $to_date]);
        }
        $orders = $query->paginate(50, ['tbl_domestic_booking.*'], 'page', $currentPage);
        $count = $this->domestic->get_listing_count(Session('customer.id'), $from_date, $to_date);
        $data = [
            'title' => "Booked",
            'orders' => $orders,
            'search' => $searchData,
            'from_date' => $from_date,
            'to_date' => $to_date,
            'all_orders' => $count['all_orders'],
            'Unprocessable' => $count['Unprocessable'],
            'Processing' => $count['Processing'],
            'Ready_to_ship' => $count['Ready_to_ship'],
            'Manifest' => $count['Manifest'],
            'Return' => $count['Return']
        ];
        return view('customer.orders.view_ProcessOrders_orders', $data);
    }
    // Processing Ordrs
    public function readyforship()
    {
        $searchData = request()->input('search');
        $from_date = !empty(request()->input('from_date')) ? request()->input('from_date') : date('Y-m-01');
        $to_date = !empty(request()->input('to_date')) ? request()->input('to_date') : date('Y-m-d');
        $currentPage = request()->input('page', 1);
        $query = DomesticBooking::query();
        $query->join('tbl_shipment_stock_manager', 'tbl_domestic_booking.id', '=', 'tbl_shipment_stock_manager.booking_id');
        $query->where(['tbl_domestic_booking.mfd' => 0, 'tbl_domestic_booking.created_id' => Session('customer.id'), 'tbl_shipment_stock_manager.shipment_type' => 1, 'tbl_shipment_stock_manager.order_booked' => 1, 'tbl_shipment_stock_manager.api_booked' => 1, 'tbl_shipment_stock_manager.lable_genration' => 1, 'tbl_shipment_stock_manager.pickup' => 0]);
        if (!empty($searchData)) {
            $query->where('tbl_domestic_booking.order_id', 'like', '%' . $searchData . '%')
                ->orWhere('tbl_domestic_booking.buy_full_name', 'like', '%' . $searchData . '%');
        }
        if (!empty($from_date) && !empty($to_date)) {
            $query->whereBetween('tbl_domestic_booking.orderDate', [$from_date, $to_date]);
        } else {
            $query->whereBetween('tbl_domestic_booking.orderDate', [$from_date, $to_date]);
        }
        $orders = $query->paginate(50, ['tbl_domestic_booking.*'], 'page', $currentPage);
        $count = $this->domestic->get_listing_count(Session('customer.id'), $from_date, $to_date);
        $data = [
            'title' => "Ready to Ship",
            'orders' => $orders,
            'search' => $searchData,
            'from_date' => $from_date,
            'to_date' => $to_date,
            'all_orders' => $count['all_orders'],
            'Unprocessable' => $count['Unprocessable'],
            'Processing' => $count['Processing'],
            'Ready_to_ship' => $count['Ready_to_ship'],
            'Manifest' => $count['Manifest'],
            'Return' => $count['Return']
        ];
        return view('customer.orders.view_readyforship_orders', $data);
    }
    public function Manifest()
    {
        $searchData = request()->input('search');
        $from_date = !empty(request()->input('from_date')) ? request()->input('from_date') : date('Y-m-01');
        $to_date = !empty(request()->input('to_date')) ? request()->input('to_date') : date('Y-m-d');
        $currentPage = request()->input('page', 1);
        $query = DomesticBooking::query();
        $query->join('tbl_shipment_stock_manager', 'tbl_domestic_booking.id', '=', 'tbl_shipment_stock_manager.booking_id');
        $query->where(['tbl_domestic_booking.mfd' => 0, 'tbl_shipment_stock_manager.shipment_type' => 1, 'tbl_domestic_booking.created_id' => Session('customer.id'), 'tbl_shipment_stock_manager.pickup' => 1]);
        if (!empty($searchData)) {
            $query->where('tbl_domestic_booking.order_id', 'like', '%' . $searchData . '%')
                ->orWhere('tbl_domestic_booking.buy_full_name', 'like', '%' . $searchData . '%');
        }
        if (!empty($from_date) && !empty($to_date)) {
            $query->whereBetween('tbl_domestic_booking.orderDate', [$from_date, $to_date]);
        } else {
            $query->whereBetween('tbl_domestic_booking.orderDate', [$from_date, $to_date]);
        }
        $orders = $query->paginate(50, ['tbl_domestic_booking.*'], 'page', $currentPage);
        $count = $this->domestic->get_listing_count(Session('customer.id'), $from_date, $to_date);
        $data = [
            'title' => "Cancelled",
            'orders' => $orders,
            'search' => $searchData,
            'from_date' => $from_date,
            'to_date' => $to_date,
            'all_orders' => $count['all_orders'],
            'Unprocessable' => $count['Unprocessable'],
            'Processing' => $count['Processing'],
            'Ready_to_ship' => $count['Ready_to_ship'],
            'Manifest' => $count['Manifest'],
            'Return' => $count['Return']
        ];
        return view('customer.orders.view_Manifest_orders', $data);
    }
    public function returnOrders()
    {
        $searchData = request()->input('search');
        $from_date = !empty(request()->input('from_date')) ? request()->input('from_date') : date('Y-m-01');
        $to_date = !empty(request()->input('to_date')) ? request()->input('to_date') : date('Y-m-d');
        $currentPage = request()->input('page', 1);
        $query = DomesticBooking::query();
        $query->join('tbl_shipment_stock_manager', 'tbl_domestic_booking.id', '=', 'tbl_shipment_stock_manager.booking_id');
        $query->where(['tbl_domestic_booking.mfd' => 0, 'tbl_domestic_booking.created_id' => Session('customer.id'), 'tbl_shipment_stock_manager.shipment_type' => 1, 'tbl_shipment_stock_manager.order_booked' => 1, 'tbl_shipment_stock_manager.api_booked' => 1, 'tbl_shipment_stock_manager.lable_genration' => 1, 'tbl_shipment_stock_manager.pickup' => 1, 'tbl_shipment_stock_manager.returns' => 1]);
        if (!empty($searchData)) {
            $query->where('tbl_domestic_booking.order_id', 'like', '%' . $searchData . '%')
                ->orWhere('tbl_domestic_booking.buy_full_name', 'like', '%' . $searchData . '%');
        }
        if (!empty($from_date) && !empty($to_date)) {
            $query->whereBetween('tbl_domestic_booking.orderDate', [$from_date, $to_date]);
        } else {
            $query->whereBetween('tbl_domestic_booking.orderDate', [$from_date, $to_date]);
        }
        $orders = $query->paginate(50, ['tbl_domestic_booking.*'], 'page', $currentPage);
        $count = $this->domestic->get_listing_count(Session('customer.id'), $from_date, $to_date);
        $data = [
            'title' => "Returns Order",
            'orders' => $orders,
            'search' => $searchData,
            'from_date' => $from_date,
            'to_date' => $to_date,
            'all_orders' => $count['all_orders'],
            'Unprocessable' => $count['Unprocessable'],
            'Processing' => $count['Processing'],
            'Ready_to_ship' => $count['Ready_to_ship'],
            'Manifest' => $count['Manifest'],
            'Return' => $count['Return']
        ];
        return view('customer.orders.view_returnOrders', $data);
    }

    public function add_orders()
    {
        $data = [];
        $data['title'] = "Speedy Fright Logistics";
        $data['state'] = DB::table('tbl_state')->get();
        $data['country'] = DB::table('tbl_country')->get();
        $data['pickup_address'] = DB::table('tbl_customers')->where(['id' => Session('customer.id')])->first();
        $data['addressbook'] = DB::table('tbl_pickup_address')->where(['customer_id' => Session('customer.id'), 'mfd' => 0])->get();
        return view('customer.orders.add_order', $data);
    }
    public function get_pincode(Request $request)
    {
        $validation = validator::make($request->all(), [
            'pincode' => 'required|numeric|min:6',
        ]);
        if ($validation->passes()) {
            $pincode = $request->input('pincode');
            $data = DB::table('tbl_pincode')->where(['pincode' => $pincode, 'mfd' => 0])->first();

            if (!empty($data)) {
                $city = DB::table('tbl_city')->where(['id' => $data->city_id, 'mfd' => 0])->first();
                $json = [
                    'status' => 'True',
                    'data' => ['state' => $data->state_id, 'StateName' => $city->state, 'city' => $city->name, 'country' => 'india'],
                ];
            } else {
                $json = [
                    'status' => 'faild',
                    'data' => ['msg' => "This Pincode Not In system."],
                ];
            }
        } else {
            $json = [
                'status' => 'false',
                'data' => $validation->errors(),
            ];
        }
        return json_encode($json);
    }

    public function pickup_address_store(Request $request)
    {
        $validation = Validator::make($request->all(), [
            'add_pickup_address' => 'required|unique:tbl_pickup_address,address',
            'pickup_contact_person' => 'required|string',
            'warehouse_r_name' => 'required|string',
            'pickup_contact_no' => 'required|numeric|digits:10',
            'pickup_landmark' => 'required|string',
            'return_address' => 'required|string',
            'pickup_pincode' => 'required|numeric|digits:6',
            'return_pincode' => 'required|numeric|digits:6',
        ]);
        if ($validation->passes()) {
            // try {

            $AddressBook = [
                'customer_id' => session('customer.id'),
                'contact_person' => $request->pickup_contact_person,
                'contact_no' => $request->pickup_contact_no,
                'alter_contact_no' => $request->pickup_alter_contact,
                'email' => $request->pickup_email,
                'address' => $request->add_pickup_address,
                'landmark' => $request->pickup_landmark,
                'pincode' => $request->pickup_pincode,
                'warehouse_r_name' => $request->warehouse_r_name,
                'return_address' => $request->return_address,
                'return_pincode' => $request->return_pincode,
            ];
            $pincodewhere = ['tbl_pincode.pincode' => $request->pickup_pincode];
            $frompin = $this->pincode->pincodedata($pincodewhere);
            $pincodewhereto = ['tbl_pincode.pincode' => $request->return_pincode];
            $topin = $this->pincode->pincodedata($pincodewhereto);
            $APIDATA = [
                'name' => $request->pickup_contact_person,
                'phone' => $request->pickup_contact_no,
                'address' => $request->add_pickup_address . ' ' . $request->pickup_landmark,
                'pin' => $request->pickup_pincode,
                'email' => $request->pikcup_email,
                'city' => $frompin->city,
                "country" => "India",
                'registered_name' => $request->warehouse_r_name,
                'return_address' => $request->return_address,
                'return_pin' => $request->return_pincode,
                'return_state' => $topin->state,
                'return_city' => $topin->city,
                "return_country" => "India"
            ];
            $jwtKey = delhiveryAuth(); // 2bc
            $jwtKey = delhiveryAuthB2B(); // b2b
            if (!empty($jwtKey->jwt)) {
                $status =  Wearhouse_creation($APIDATA, $jwtKey->jwt);
            }

            DB::beginTransaction();
            $pickupaddress = PickupAddress::create($AddressBook);
            $lastInsertedId = $pickupaddress->id;
            $data = PickupAddress::find($lastInsertedId);
            $option = "<option value='" . $lastInsertedId . "'>" . $data->address . "</option>";
            if ($pickupaddress) {
                DB::commit();
                $msg = session()->flash('success', 'Address added successfully');
                $responce = [
                    'status' => 'success',
                    'error' => 'Address added successfully',
                    'data' => $option,
                ];
                echo json_encode($responce);
                exit;
            } else {
                // If creation was not successful, throw an exception
                throw new \Exception('Data not inserted');
            }
            // } catch (\Exception $e) {
            //     DB::rollBack();
            //     $msg = session()->flash('faild', 'An error occurred: ' . $e->getMessage());
            //     $responce = [
            //         'status' => 'faild',
            //         'error' => 'An error occurred: ' . $e->getMessage(),
            //     ];
            //     echo json_encode($responce);exit;
            // }
        } else {
            $json = [
                'status' => 'false',
                'data' => $validation->errors(),
            ];
            echo json_encode($json);
            exit;
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
        if ($validation->passes()) {
            $series = 500000000;
            $MAxID = DomesticBooking::max('id');
            $Usid = $MAxID + 1;
            $orderId = $series + $Usid;
            try {
                $orderData = [
                    'order_id' => $orderId,
                    'created_id' => session('customer.id'),
                    'created_by' => session('customer.personal_name') . ' ' . session('customer.surname'),
                    'order_channel' => $request->order_channel,
                    'order_tag' => $request->order_tag,
                    'resellar_name' => $request->resellar_name,
                    'paymentMode' => $request->paymentMode,
                    'buy_full_name' => $request->buy_full_name,
                    'buy_mobile' => $request->buy_mobile,
                    'buy_email' => $request->buy_email,
                    'buy_alter_mobile' => $request->buy_alter_mobile,
                    'buy_company_name' => $request->buy_company_name,
                    'buy_gst_in' => $request->buy_gst_in,
                    'buy_delivery_address' => $request->buy_delivery_address,
                    'buy_delivery_landmark' => $request->buy_delivery_landmark,
                    'buy_delivery_pincode' => $request->buy_delivery_pincode,
                    'pickup_address' => $request->pickup_address,
                    'billing_status' => $request->billing_status,
                    'buy_full_billing_name' => $request->buy_full_billing_name,
                    'buy_billing_mobile' => $request->buy_billing_mobile,
                    'buy_billing_email' => $request->buy_billing_email,
                    'buy_delivery_billing_address' => $request->buy_delivery_billing_address,
                    'buy_delivery_billing_landmark' => $request->buy_delivery_billing_landmark,
                    'buy_delivery_billing_pincode' => $request->buy_delivery_billing_pincode,
                    'order_shipping_charges' => $request->order_shipping_charges,
                    'insuranse_chargeses' => $request->insuranse_chargeses,
                    'invoice_value' => $request->invoice_value,
                    'invoice_no' => $request->invoice_no,
                    'eway_no' => $request->eway_no,
                    'riskType' => $request->riskType,
                    'order_gift_wrap' => $request->order_gift_wrap,
                    'order_transaction_fee' => $request->order_transaction_fee,
                    'order_discounts' => $request->order_discounts,
                    'product_sub_total' => $request->product_sub_total,
                    'product_other_charges' => $request->product_other_charges,
                    'product_discount' => $request->product_discount,
                    'order_total' => $request->order_total,
                    'dead_weight' => $request->dead_weight,
                    'length' => $request->length,
                    'breath' => $request->breath,
                    'height' => $request->height,
                    'voluematrix_weight' => $request->voluematrix_weight,
                    'applicable_weight' => $request->applicable_weight,
                ];

                // try {
                //     $orderBooking = DomesticBooking::create($orderData);
                //     dd($orderBooking);
                // } catch (\Exception $e) {
                //     dd($e->getMessage());
                // }

                DB::beginTransaction();
                $orderBooking = DomesticBooking::create($orderData);
                //    dd($orderBooking);
                $booking_id = $orderBooking->id; // last genrated Id
                $stockData = [
                    'booking_id' => $booking_id,
                    'order_id' => $orderId,
                    'shipment_type' => 1,
                    'order_booked' => 1,
                    'created_at' => Carbon::now(),
                ];
                DB::table('tbl_shipment_stock_manager')->insert($stockData);
                // product insetion
                for ($i = 0; $i < count($request->productName); $i++) {
                    $productData = [
                        'booking_id' => $booking_id,
                        'productName' => $request->productName[$i],
                        'unitPrice' => $request->unitPrice[$i],
                        'quantity' => $request->quantity[$i],
                        'productCategory' => $request->productCategory[$i],
                        'order_hsn_code' => $request->order_hsn_code[$i],
                        'order_sku' => $request->order_sku[$i],
                        'order_tax_rate' => $request->order_tax_rate[$i],
                        'order_product_discount' => $request->order_product_discount[$i],
                        'height' => $request->height[$i],
                        'length' => $request->length[$i],
                        'width' => $request->width[$i],
                        'weight' => $request->weight[$i],
                    ];
                    $productBooking = DomesticOrdersProducts::create($productData);
                }

                if ($orderBooking) {
                    DB::commit();
                    $msg = session()->flash('success', 'Order added successfully');
                    $responce = [
                        'status' => 'success',
                        'error' => 'Order added successfully',
                    ];
                    echo json_encode($responce);
                    exit;
                } else {
                    // If creation was not successful, throw an exception
                    throw new \Exception('Data not inserted');
                }
            } catch (\Exception $e) {
                DB::rollBack();
                $msg = session()->flash('faild', 'An error occurred: ' . $e->getMessage());
                $responce = [
                    'status' => 'false1',
                    'error' => 'An error occurred: ' . $e->getMessage(),
                ];
                echo json_encode($responce);
                exit;
            }
        } else {
            $json = [
                'status' => 'false',
                'data' => $validation->errors(),
            ];
            echo json_encode($json);
            exit;
        }
    }

    // Rate Calculation function
    public function RateCalculate($mode, $courier, $fuel_id, $group_id, $fromPincode, $toPincode, $applicableWeight, $booking_date)
    {
        $from_z = $this->pincode->pincodeZone($fromPincode->pincode);
        $to_z = $this->pincode->pincodeZone($toPincode->pincode);
        $fromZone = !empty($from_z) ? $from_z->id : 0;
        $toZone = !empty($to_z) ? $to_z->id : 0;
        $rate = $this->rate->RateCalulate($mode, $courier, $group_id, $fromZone, $toZone, $applicableWeight, $booking_date);
        $fuelCh = DB::table('tbl_fuel_master')->where('group_id', $fuel_id)->first();
        if (!empty($rate) && !empty($fuelCh)) {
            $fuelPrice = $rate->rate / 100 * $fuelCh->fuel_price;
            // $fovPrice = $rate->rate / 100 * $fuelCh->fov;
            $fovPrice = 0;
            if ($rate->fixed_perkg == 4) {
                $fixedRate = $this->rate->RateCalulateFixed($courier, $group_id, $fromZone, $toZone, $applicableWeight, $booking_date);
                $weight = $applicableWeight - $fixedRate->to_weight;
                $rateAmount = $fixedRate->rate;
                $Calculatedrate = $weight * $rate->rate;
                $calculatedFright = $rateAmount + $Calculatedrate + $fuelCh->docket_charges + $fuelPrice + $fovPrice;
                if ($rate->minimum_rate >= $calculatedFright) {
                    $fright = $rate->minimum_rate;
                } else {
                    $fright = $calculatedFright;
                }
            } else {
                $calculatedFright = $rate->rate + $fuelCh->docket_charges + $fuelPrice + $fovPrice;
                if ($rate->minimum_rate >= $calculatedFright) {
                    $fright = $rate->minimum_rate;
                } else {
                    $fright = $calculatedFright;
                }
            }
        } else {
            $fright = 0;
        }
        return $data = [$fright, $rate->tat, $rate->mode_id];
    }

    // Model to get booking list
    public function getModel(Request $request)
    {
        $id = $request->id;
        $data['booking_data'] = DB::table('tbl_domestic_booking')->where(['id' => $id])->first();
        if (!empty($data['booking_data'])) {
            // from address
            if ($data['booking_data']->pickup_address == 'primary') {
                $customer = DB::table('tbl_customers')->where(['id' => session('customer.id')])->first();
                $pincodewhere = ['tbl_pincode.pincode' => $customer->pincode];
                $frompin = $this->pincode->pincodedata($pincodewhere);
                $data['from_address'] = $customer->address_line1 . ',' . $customer->address_line2 . ',' . $frompin->city . ',' . $frompin->state . ' ' . $frompin->pincode;
            } else {
                $customer = DB::table('tbl_pickup_address')->where(['id' => $data['booking_data']->pickup_address])->first();
                $pincodewhere = ['tbl_pincode.pincode' => $customer->pincode];
                $frompin = $this->pincode->pincodedata($pincodewhere);
                $data['from_address'] = $customer->address . ',' . $customer->landmark . ',' . $frompin->city . ',' . $frompin->state . ' ' . $frompin->pincode;
            }
            // To Address
            if ($data['booking_data']->billing_status == "on") {
                $pincodewhere = ['tbl_pincode.pincode' => $data['booking_data']->buy_delivery_pincode];
                $topin = $this->pincode->pincodedata($pincodewhere);
                $data['to_address'] = $data['booking_data']->buy_delivery_address . ',' . $data['booking_data']->buy_delivery_landmark . ',' . $frompin->city . ',' . $frompin->state . ' ' . $frompin->pincode;
            } else {
                $pincodewhere = ['tbl_pincode.pincode' => $data['booking_data']->buy_delivery_pincode];
                $topin = $this->pincode->pincodedata($pincodewhere);
                $data['to_address'] = $data['booking_data']->buy_delivery_billing_address . ',' . $data['booking_data']->buy_delivery_billing_landmark . ',' . $frompin->city . ',' . $frompin->state . ' ' . $frompin->pincode;
            }
            $rate_id = DB::table('tbl_customers')->where(['id' => session('customer.id')])->first();
            $courier_company = DB::table('tbl_courier_company')->where(['status' => 0, 'mfd' => 0])->get();
            $delDate = date('Y-m-d', strtotime($data['booking_data']->orderDate));
            $data['courier_company'] = [];
            $from_z = $this->pincode->pincodeZone($frompin->pincode);
            $to_z = $this->pincode->pincodeZone($topin->pincode);
            $fromZone = !empty($from_z) ? $from_z->id : 0;
            $toZone = !empty($to_z) ? $to_z->id : 0;
            $modewiseRate = $this->rate->CustomerRate($rate_id->fuel_group_id, $fromZone, $toZone, $data['booking_data']->applicable_weight, date('Y-m-d', strtotime($data['booking_data']->orderDate)));
            // dd($modewiseRate);
            foreach ($modewiseRate as $key => $val) {
                $rate = $this->RateCalculate($val->mode_id, $val->courier, $rate_id->fuel_group_id, $rate_id->rate_group_id, $frompin, $topin, $data['booking_data']->applicable_weight, $data['booking_data']->orderDate);
                $daysToAdd = $rate[1];
                $mode = DB::table('tbl_transfer_mode')->where(['id' => $val->mode_id])->first();
                $courier = DB::table('tbl_courier_company')->where(['id' => $val->courier, 'mfd' => 0, 'status' => 0])->first();
                if (!empty($rate)) {
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
                            'img_logo' => asset('admin-assets/courier_company_logo/' . $courier->img_logo),
                            'company_name' => $courier->company_name,
                            'amount' => $rate[0],
                            'company_id' => $val->courier,
                            'mode' => $mode->mode_name,
                            'mode_id' => $mode->id,
                            'deliverydate' => date('M d Y', strtotime("$delDate + $daysToAdd days")),
                            'pickupdate' => date('M d Y', strtotime($delDate)),
                        ];
                    }
                }
            }
            $responce = [
                'status' => 'success',
                'data' => $data,
            ];
            echo json_encode($responce);
        }
    }

    public function DelhiveryAPICall($booking_id, $courier, $mode, $amount)
    {
        // login account
        $jwtKey = delhiveryAuth();
        if (!empty($jwtKey)) {
            $booking_data = DB::table('tbl_domestic_booking')->where(['id' => $booking_id])->first();
            if (!empty($booking_data)) {
                $product = DB::table('tbl_domestic_products')->where(['booking_id' => $booking_id])->get();
                // from address
                if ($booking_data->pickup_address == 'primary') {
                    $customer = DB::table('tbl_customers')->where(['id' => session('customer.id')])->first();
                    $pincodewhere = ['tbl_pincode.pincode' => $customer->pincode];
                    $frompin = $this->pincode->pincodedata($pincodewhere);
                    $sender_name = $customer->personal_name . ' ' . $customer->surname;
                    $mobile_no = $customer->mobile_number;
                    $sender_address = $customer->address_line1 . ' ' . $customer->address_line2;
                } else {
                    $customer = DB::table('tbl_pickup_address')->where(['id' => $booking_data->pickup_address])->first();
                    $pincodewhere = ['tbl_pincode.pincode' => $customer->pincode];
                    $frompin = $this->pincode->pincodedata($pincodewhere);
                    $data['from_address'] = $customer->address . ',' . $customer->landmark . ',' . $frompin->city . ',' . $frompin->state . ' ' . $frompin->pincode;
                    $sender_name = $customer->contact_person;
                    $mobile_no = $customer->contact_no;
                    $sender_address = $customer->address . ' ' . $customer->landmark;
                }
                // pices
                $pieces_detail = [];
                foreach ($product as $key => $val) {
                    $pieces_detail[] = [
                        "description" => 'box', // Use object syntax -> instead of []
                        // "declared_value" => round($val->inv_value),
                        // "weight" => round($val->weight),
                        // "height" => $val->height,
                        // "length" => $val->length,
                        // "width" => $val->width,
                        "count" => count($product)
                    ];
                }
                // invoice
                $invoice = [];
                foreach ($product as $key => $val) {
                    $invoice[] = [
                        "n_value" => round($val->inv_value),
                        "ident" => $val->inv_no,
                    ];
                }
                // amount 
                $amount = ($booking_data->paymentMode == 'Prepaid') ? 0 : $booking_data->order_total;

                // To Address              
                $pincodewhere = ['tbl_pincode.pincode' => $booking_data->buy_delivery_pincode];
                $topin = $this->pincode->pincodedata($pincodewhere);

                $BookingData = [
                    'pickup_location' => "INNOVATIONMAKER123",
                    'return_address' => [
                        'name' => $sender_name,
                        'phone' => $mobile_no,
                        'address' => $sender_address,
                        'zip' => $frompin->pincode,
                        'city' => $frompin->city,
                        'region' => $frompin->state
                    ],
                    'dropoff_location' => [
                        'consignee' => $booking_data->buy_full_name,
                        'phone' => $booking_data->buy_mobile,
                        'address' =>  $booking_data->buy_delivery_address . ' ' . $booking_data->buy_delivery_landmark,
                        'zip' => $topin->pincode,
                        'city' =>  $topin->city,
                        'region' => $topin->state
                    ],
                    'd_mode' => $booking_data->paymentMode,
                    'amount' => round($amount),
                    'rov_insurance' => true,
                    'weight' => round($booking_data->dead_weight),
                    'invoices' => $invoice,
                    'suborders' => $pieces_detail,
                    'dimensions' =>
                    [
                        [
                            "length" => round($booking_data->length),
                            "width" => round($booking_data->breath),
                            "height" => round($booking_data->height),
                            "count" => count($product)
                        ]
                    ]

                ];
                return  $booking = Bookingdelhivery(json_encode($BookingData), $jwtKey->jwt);
            }
        }
    }
    public function DelhiveryAPICallB2B($booking_id, $courier, $mode, $amount)
    {
        // login account
        $jwtKey = delhiveryAuthB2B()->data->jwt;
        if (!empty($jwtKey)) {
            $booking_data = DB::table('tbl_domestic_booking')->where(['id' => $booking_id])->first();
            if (!empty($booking_data)) {
                $product = DB::table('tbl_domestic_products')->where(['booking_id' => $booking_id])->get();
                // from address
                if ($booking_data->pickup_address == 'primary') {
                    $customer = DB::table('tbl_customers')->where(['id' => session('customer.id')])->first();
                    $pincodewhere = ['tbl_pincode.pincode' => $customer->pincode];
                    $frompin = $this->pincode->pincodedata($pincodewhere);
                    $sender_name = $customer->personal_name . ' ' . $customer->surname;
                    $mobile_no = $customer->mobile_number;
                    $sender_address = $customer->address_line1 . ' ' . $customer->address_line2;
                } else {
                    $customer = DB::table('tbl_pickup_address')->where(['id' => $booking_data->pickup_address])->first();
                    $pincodewhere = ['tbl_pincode.pincode' => $customer->pincode];
                    $frompin = $this->pincode->pincodedata($pincodewhere);
                    $data['from_address'] = $customer->address . ',' . $customer->landmark . ',' . $frompin->city . ',' . $frompin->state . ' ' . $frompin->pincode;
                    $sender_name = $customer->contact_person;
                    $mobile_no = $customer->contact_no;
                    $sender_address = $customer->address . ' ' . $customer->landmark;
                }
                // pices
                $pieces_detail = [];
                foreach ($product as $key => $val) {
                    $pieces_detail[] = [
                        "order_id" => $booking_data->order_id,
                        "box_count" => count($product),
                        "description" => 'box', // Use object syntax -> instead of []
                        "weight" => round($val->weight * 1000),
                        "waybills" => [],
                        'master' => false
                    ];
                }
                // invoice
                $invoice = [];
                foreach ($product as $key => $val) {
                    $invoice[] = [
                        "ewaybill" => "",
                        "inv_amt" => round($val->inv_value),
                        "inv_num" => $val->inv_no,
                        'inv_qr_code' => 'eyJhbGciOiJSUzI1NiIsImtpZCI6IkI4RDYzRUNCNThFQTVFNkY0QUFDM0Q1MjQ1NDNCMjI0NjY2OUIwRjgiLCJ0eXAiOiJKV1QiLCJ4NXQiOiJ1TlkteTFqcVhtOUtyRDFTUlVPeUpHWnBzUGcifQ.eyJkYXRhIjoie1wiU2VsbGVyR3N0aW5cIjpcIjMzQUFQQ1M5NTc1RTFaVVwiLFwiQnV5ZXJHc3RpblwiOlwiMjNBQVBDUzk1NzVFMVpWXCIsXCJEb2NOb1wiOlwiREVMLzExMjIvMDA5NTQwN1wiLFwiRG9jVHlwXCI6XCJJTlZcIixcIkRvY0R0XCI6XCIzMC8xMS8yMDIyXCIsXCJUb3RJbnZWYWxcIjoyNTIwNDgwLjAsXCJJdGVtQ250XCI6MSxcIk1haW5Ic25Db2RlXCI6XCI4NDI4MjBcIixcIklyblwiOlwiODBlZWIxYzA4Zjg0MTJkYWVhZTBmNmM3NjE0ZWJmMzRiZDEzYWU3NDJiZTYwNzM3MTNlY2Q4N2JlYzgwNjVjOFwiLFwiSXJuRHRcIjpcIjIwMjItMTEtMzAgMTI6MDI6MDBcIn0iLCJpc3MiOiJOSUMifQ.VInEh4yiYmEq0ikdj3qX5TlKVwarcNqFVqpUNRjP5rsOqtXH6vhsUZM2LrMfg1jlJRghfH-PKu77DlOR4bmj_4VmZVvhX-Waziey6Z4QBkOLL8qL2_RSNcxOwLUkd56kWWM5_HmiowSA11zFeE34pbaBaN1hRGy5XkEIAKFWqS-rgppPQAuW4CIvyDcbR0B4jYT3JuOHRzkkg4NB75xAsH9YXJ4ffY7Y5O6nxhxEIYcXhWHoKp1HmW1zelFmU-nLmuUif7eJ8U9s6PCL4onFzN4f2m0dYaNCddT-KgNKnFyghMqtXvBm8y6_ree8vfVcVoVrlr_EwyFOE4rpUKiyGg'
                    ];
                }
                // amount 
                $amount = ($booking_data->paymentMode == 'Prepaid') ? 0 : $booking_data->order_total;

                // To Address              
                $pincodewhere = ['tbl_pincode.pincode' => $booking_data->buy_delivery_pincode];
                $topin = $this->pincode->pincodedata($pincodewhere);

                $BookingData = [
                    'lrn' => '',
                    'pickup_location_name' => "testWH",
                    'payment_mode' => $booking_data->paymentMode,
                    'cod_amount' => round($amount),
                    'weight' => round($booking_data->dead_weight * 1000),
                    'dropoff_location' => json_encode([
                        'consignee_name' => $booking_data->buy_full_name,
                        'phone' => $booking_data->buy_mobile,
                        'address' =>  $booking_data->buy_delivery_address . ' ' . $booking_data->buy_delivery_landmark,
                        'zip' => $topin->pincode,
                        'city' =>  $topin->city,
                        'state' => $topin->state,
                        'email' => ''
                    ]),
                    'rov_insurance' => true,
                    'invoices' => json_encode($invoice),
                    'shipment_details' => json_encode($pieces_detail),
                    'dimensions' => json_encode([[
                        "box_count" => count($product),
                        "length" => round($booking_data->length),
                        "width" => round($booking_data->breath),
                        "height" => round($booking_data->height)
                    ]]),
                    'doc_data' => [
                        json_encode([
                            'doc_type' => 'INVOICE_COPY',
                            'doc_meta' => ['invoice_num' => ['I22331030453']]
                        ]),
                    ],
                    'freight_mode' => 'fop',
                    'fm_pickup' => true,
                    'billing_address' => json_encode([
                        'name' => $sender_name,
                        'consignor' => $sender_name,
                        'company' => $sender_name,
                        'phone' => $mobile_no,
                        'address' => $sender_address,
                        'pin' => $frompin->pincode,
                        'city' => $frompin->city,
                        'state' => $frompin->state,
                        "pan_number" => "ETKPD7819F"
                    ]),
                ];
                return  $booking = BookingdelhiveryB2B($BookingData, $jwtKey);
            }
        }
    }

    public function XpressbeesAPICall($booking_id, $courier, $mode, $amount)
    {
        $key1 = XpressbeesAuth()->data;
        $booking_data = DB::table('tbl_domestic_booking')->where(['id' => $booking_id])->first();
        if (!empty($booking_data)) {
            $product = DB::table('tbl_domestic_products')->where(['booking_id' => $booking_id])->get();
            // from address
            if ($booking_data->pickup_address == 'primary') {
                $customer = DB::table('tbl_customers')->where(['id' => session('customer.id')])->first();
                $pincodewhere = ['tbl_pincode.pincode' => $customer->pincode];
                $frompin = $this->pincode->pincodedata($pincodewhere);
                $sender_name = $customer->personal_name . ' ' . $customer->surname;
                $mobile_no = $customer->mobile_number;
                $sender_address = $customer->address_line1 . ' ' . $customer->address_line2;
            } else {
                $customer = DB::table('tbl_pickup_address')->where(['id' => $booking_data->pickup_address])->first();
                $pincodewhere = ['tbl_pincode.pincode' => $customer->pincode];
                $frompin = $this->pincode->pincodedata($pincodewhere);
                $data['from_address'] = $customer->address . ',' . $customer->landmark . ',' . $frompin->city . ',' . $frompin->state . ' ' . $frompin->pincode;
                $sender_name = $customer->contact_person;
                $mobile_no = $customer->contact_no;
                $sender_address = $customer->address . ' ' . $customer->landmark;
            }
            // To Address              
            $pincodewhere = ['tbl_pincode.pincode' => $booking_data->buy_delivery_pincode];
            $topin = $this->pincode->pincodedata($pincodewhere);

            // pices
            $pieces_detail = [];
            foreach ($product as $key => $val) {
                $pieces_detail[] = [
                    "product_name" => $val->productName,
                    "product_price" => round($val->unitPrice),
                    "product_tax_per" => $val->order_tax_rate,
                    "product_sku" => $val->order_sku,
                    "product_hsn" => $val->order_hsn_code,
                    "product_qty" => count($product)
                ];
            }
            // invoice
            $invoice = [];
            foreach ($product as $key => $val) {
                $invoice[] = [
                    "invoice_number" => $val->inv_no,
                    "invoice_date" => '',
                    "ebill_number" => '',
                    "ebill_expiry_date" => ''
                ];
            }

            $bookingData = [
                'id' => $booking_data->order_id,
                'unique_order_number' => 'no',
                'payment_method' => strtoupper($booking_data->paymentMode),
                'consigner_name' => $sender_name,
                'consigner_phone' => $mobile_no,
                'consigner_pincode' => $frompin->pincode,
                'consigner_city' => $frompin->city,
                'consigner_state' => $frompin->state,
                'consigner_address' => $sender_address,
                'consigner_gst_number' => '',
                'consignee_name' => $booking_data->buy_full_name,
                'consignee_phone' => $booking_data->buy_mobile,
                'consignee_address' =>  $booking_data->buy_delivery_address . ' ' . $booking_data->buy_delivery_landmark,
                'consignee_pincode' => $topin->pincode,
                'consignee_city' =>  $topin->city,
                'consignee_state' => $topin->state,
                'consignee_gst_number' => '',
                'products' => $pieces_detail,
                'invoice' => $invoice,
                'weight' => round($booking_data->dead_weight),
                'length' => round($booking_data->length),
                'height' => round($booking_data->height),
                'breadth' => round($booking_data->breath),
                'courier_id' => '7672552672',
                'pickup_location' => 'customer',
                'shipping_charges' => round($booking_data->order_shipping_charges),
                'cod_charges' => round($booking_data->order_shipping_charges),
                'discount' => round($booking_data->order_discounts),
                'order_amount' => round($booking_data->order_total),
                'collectable_amount' => round(0),
            ];

            $callbooking = XpressbessBooking(json_encode($bookingData), $key1);
            if (!empty($callbooking)) {
                $post = DomesticBooking::find($booking_data->id);
                $post->update(['forwording_no' =>  $callbooking->awb_number, 'courier' => $courier]);
                $post->save();
            }
            dd($callbooking);
        }
    }

    public function BlueDartAPICall($booking_id, $courier, $mode, $amount)
    {
        $authkey = BlueDartAuth();
        $keyToekn = $authkey->JWTToken;

        $booking_data = DB::table('tbl_domestic_booking')->where(['id' => $booking_id])->first();
        if (!empty($booking_data)) {
            $product = DB::table('tbl_domestic_products')->where(['booking_id' => $booking_id])->get();
            // from address
            if ($booking_data->pickup_address == 'primary') {
                $customer = DB::table('tbl_customers')->where(['id' => session('customer.id')])->first();
                $pincodewhere = ['tbl_pincode.pincode' => $customer->pincode];
                $frompin = $this->pincode->pincodedata($pincodewhere);
                $sender_name = $customer->personal_name . ' ' . $customer->surname;
                $mobile_no = $customer->mobile_number;
                $sender_address = $customer->address_line1 . ' ' . $customer->address_line2;
            } else {
                $customer = DB::table('tbl_pickup_address')->where(['id' => $booking_data->pickup_address])->first();
                $pincodewhere = ['tbl_pincode.pincode' => $customer->pincode];
                $frompin = $this->pincode->pincodedata($pincodewhere);
                $data['from_address'] = $customer->address . ',' . $customer->landmark . ',' . $frompin->city . ',' . $frompin->state . ' ' . $frompin->pincode;
                $sender_name = $customer->contact_person;
                $mobile_no = $customer->contact_no;
                $sender_address = $customer->address . ' ' . $customer->landmark;
            }
            // To Address              
            $pincodewhere = ['tbl_pincode.pincode' => $booking_data->buy_delivery_pincode];
            $topin = $this->pincode->pincodedata($pincodewhere);
            $itemdtl = [];
            $date = date('Y-m-d H:i:s');
            $date = strtotime($date);
            $date = $date * 1000;
            foreach ($product as $key => $val) {
                $itemdtl[] = [
                    "CGSTAmount" => 0,
                    "HSCode" => "",
                    "IGSTAmount" => 0,
                    "IGSTRate" => 0,
                    "Instruction" => "",
                    "InvoiceDate" => "/Date(" . $date . ")/",
                    "InvoiceNumber" => $val->inv_no,
                    "ItemID" => "Test Item ID1",
                    "ItemName" => $val->productName,
                    "ItemValue" => (int)$val->unitPrice,
                    "Itemquantity" => $val->quantity,
                    "PlaceofSupply" => $frompin->state,
                    "ProductDesc1" => '',
                    "ProductDesc2" => "",
                    "ReturnReason" => "",
                    "SGSTAmount" => 0,
                    "SKUNumber" => "",
                    "SellerGSTNNumber" => "Z2222222",
                    "SellerName" => "ABC ENTP",
                    "TaxableAmount" => (int)$val->order_tax_rate,
                    "TotalValue" => (int)$val->unitPrice,
                    "cessAmount" => "0",
                    "countryOfOrigin" => "IN",
                    "docType" => "INV",
                    "subSupplyType" => 1,
                    "supplyType" => "0"
                ];
            }
            // invoice
            $Dimensions = [];
            foreach ($product as $key => $val) {
                $Dimensions[] = [
                    "Count" => count($product),
                    "Breadth" => $val->width,
                    "Height" => $val->height,
                    "Length" => $val->length,
                ];
            }
            $postdata = '{
                "Request": {
                    "Consignee": {
                        "AvailableDays": "",
                        "AvailableTiming": "",
                        "ConsigneeAddress1": "' . $booking_data->buy_delivery_address . ' ' . $booking_data->buy_delivery_landmark . '",
                        "ConsigneeAddress2": "' . $booking_data->buy_delivery_address . ' ' . $booking_data->buy_delivery_landmark . '",
                        "ConsigneeAddress3": "' . $booking_data->buy_delivery_address . ' ' . $booking_data->buy_delivery_landmark . '",
                        "ConsigneeAddressType": "",
                        "ConsigneeAddressinfo": "",
                        "ConsigneeAttention": "",
                        "ConsigneeEmailID": "",
                        "ConsigneeFullAddress": "",
                        "ConsigneeGSTNumber": "",
                        "ConsigneeLatitude": "",
                        "ConsigneeLongitude": "",
                        "ConsigneeMaskedContactNumber": "",
                        "ConsigneeMobile": "' . $booking_data->buy_mobile . '",
                        "ConsigneeName": "' . $booking_data->buy_full_name . '",
                        "ConsigneePincode": "' . $topin->pincode . '",
                        "ConsigneeTelephone": ""
                    },
                    "Returnadds": {
                        "ManifestNumber": "",
                        "ReturnAddress1": "TEST ADDRESS",
                        "ReturnAddress2": "",
                        "ReturnAddress3": "",
                        "ReturnAddressinfo": "",
                        "ReturnContact": "' . $sender_name . '",
                        "ReturnEmailID": "",
                        "ReturnLatitude": "",
                        "ReturnLongitude": "",
                        "ReturnMaskedContactNumber": "",
                        "ReturnMobile": "' . $mobile_no . '",
                        "ReturnPincode": "' . $frompin->pincode . '",
                        "ReturnTelephone": ""
                    },
                    "Services": {
                        "AWBNo": "",
                        "ActualWeight": "' . $booking_data->dead_weight . '",
                        "CollectableAmount": 0,
                        "Commodity": {
                            "CommodityDetail1": "",
                            "CommodityDetail2": "",
                            "CommodityDetail3": ""
                        },
                       
                        "CreditReferenceNo": "' . $booking_data->order_id . '",
                        "CreditReferenceNo2": "",
                        "CreditReferenceNo3": "",
                        "CurrencyCode": "",
                        "DeclaredValue": ' . (int)$booking_data->order_total . ',
                        "DeliveryTimeSlot": "",';
            $postdata .=    '"Dimensions": [
                            {
                                "Breadth": ' . (int)$booking_data->breath . ',
                                "Count": 1,
                                "Height": ' . (int)$booking_data->height . ',
                                "Length": ' . (int)$booking_data->length . '
                            }
                        ],';
            $postdata .= '"FavouringName": "",
                        "ForwardAWBNo": "",
                        "ForwardLogisticCompName": "",
                        "InsurancePaidBy": "",
                        "InvoiceNo": "",  
                        "IsChequeDD": "",
                        "IsDedicatedDeliveryNetwork": false,
                        "IsForcePickup": false,
                        "IsPartialPickup": false,
                        "IsReversePickup": false,
                        "ItemCount": 1,
                        "OTPBasedDelivery": "0",
                        "OTPCode": "",
                        "Officecutofftime": "",
                        "PDFOutputNotRequired": true,
                        "PrinterLableSize":"3",
                        "PackType": "",
                        "ParcelShopCode": "",
                        "PayableAt": "",
                        "PickupDate": "/Date(' . $date . ')/",
                        "PickupMode": "",
                        "PickupTime": "1800",
                        "PickupType": "",
                        "PieceCount": "1",
                        "PreferredPickupTimeSlot": "",
                        "ProductCode": "D",
                        "ProductFeature": "",
                        "ProductType": 1,
                        "RegisterPickup": true,
                        "SpecialInstruction": "",
                        "SubProductCode": "",
                        "TotalCashPaytoCustomer": 0,
                        "itemdtl":  ' . json_encode($itemdtl) . ',
                        "noOfDCGiven": 0
                    },
                    "Shipper": {
                        "CustomerAddress1": "' . $sender_address . '",
                        "CustomerAddress2": "",
                        "CustomerAddress3": "",
                        "CustomerAddressinfo": "",
                        "CustomerCode": "450914",
                        "CustomerEmailID": "",
                        "CustomerGSTNumber": "",
                        "CustomerLatitude": "",
                        "CustomerLongitude": "",
                        "CustomerMaskedContactNumber": "",
                        "CustomerMobile": "' . $mobile_no . '",
                        "CustomerName": "' . $sender_name . '",
                        "CustomerPincode": "' . $frompin->pincode . '",
                        "CustomerTelephone": "",
                        "IsToPayCustomer": false,
                        "OriginArea": "BOM",
                        "Sender": "' . $sender_name . '",
                        "VendorCode": ""
                    }
                },
                "Profile": {
                    "LoginID": "BOM42763",
                    "LicenceKey": "himmhphkekh2sqkfnrf3kelfllsiknog",
                    "Api_type": "S"
                }
            }';
            return $response = BookingblueDart($postdata, $keyToekn);
        }
    }

    public function booking_API(Request $request)
    {

        if (empty($request->all())) {
            $response = [
                'status' => 'faild',
                'data' => 'Data Not Recived',
            ];
            echo json_encode($response);
        } else {
            $Customer = DB::table('tbl_customers')->where(['id' => session('customer.id')])->first();
            $WalletAmount = $Customer->wallet_amount;
            $ShipmentAmount = $request->amount;
            $status = 1;
            if ($status == 1) {
                $booking = DB::table('tbl_domestic_booking')->where(['id' => $request->booking_id])->first();
                if (!empty($booking)) {
                    $WalletAmount = $Customer->wallet_amount;
                    $ShipmentAmount = $request->amount;
                    $BalanceAmount = $WalletAmount - $ShipmentAmount;
                    if ($BalanceAmount <= 0) {
                        // session()->flash('success', "We don't have sufficent balance");
                        $response = [
                            'status' => 'false',
                            'data' => "We don't have sufficent balance",
                        ];
                        return  json_encode($response);
                    } else {
                        $booking_status = 2;
                        DB::beginTransaction();
                        if ($request->courier == 2) {
                            // b2c
                            // $booking = $this->DelhiveryAPICall($request->booking_id, $request->courier, $request->mode_id, $request->amount);
                            // if (!empty($booking)) {
                            //     $booking_status = 1;
                            //     $delhiveryData = ['forwording_no' =>  $booking, 'courier' => 2];
                            // }

                            $booking = $this->DelhiveryAPICallB2B($request->booking_id, $request->courier, $request->mode_id, $request->amount);
                            if (!empty($booking)) {
                                $booking_status = 1;
                                $delhiveryData = ['forwording_no' =>  $booking, 'courier' => 2];
                            }
                        } elseif ($request->courier == 3) {
                            $this->XpressbeesAPICall($request->booking_id, $request->courier, $request->mode_id, $request->amount);
                        } elseif ($request->courier == 1) {
                            $blueDart = $this->BlueDartAPICall($request->booking_id, $request->courier, $request->mode_id, $request->amount);
                            if (!empty($blueDart)) {
                                if (!empty($blueDart->GenerateWayBillResult)) {
                                    if ($blueDart->GenerateWayBillResult->Status[0]->StatusCode == 'Valid') {
                                        $booking_status = 1;
                                        $blueDartUpdate = [
                                            'forwording_no' => $blueDart->GenerateWayBillResult->AWBNo,
                                            'TokenNumber' => $blueDart->GenerateWayBillResult->TokenNumber,
                                            'DestinationArea' => $blueDart->GenerateWayBillResult->DestinationArea,
                                            'DestinationLocation' => $blueDart->GenerateWayBillResult->DestinationLocation,
                                            'ClusterCode' => $blueDart->GenerateWayBillResult->ClusterCode,
                                            'courier' => 1,
                                            'pickup_date' => date_convter($blueDart->GenerateWayBillResult->ShipmentPickupDate)
                                        ];
                                        DB::table('tbl_domestic_booking')->where(['id' => $request->booking_id])->update($blueDartUpdate);
                                    }
                                }
                            }
                        }
                        try {
                            if ($booking_status == 1) {
                                $wallet = [
                                    'customer_id' => Session('customer.id'),
                                    'transaction_type' => 2,
                                    'amount' => $ShipmentAmount,
                                    'balance_amount' => $BalanceAmount,
                                    'reference_no' => '',
                                    'description' => 'Shipment booked Order No ' . $booking->order_id,
                                    'date' => date('Y-m-d'),
                                    'status' => 1,
                                    'created_at' => date('Y-m-d h:i:s'),
                                    'display_status' => 1
                                ];
                                $transection =  DB::table('tbl_customer_wallet_transection')->insert($wallet);
                                DB::table('tbl_customers')->where(['id' => Session('customer.id')])->update(['wallet_amount' => $BalanceAmount]);
                                DB::table('tbl_shipment_stock_manager')->where(['booking_id' => $request->booking_id])->update(['api_booked' => 1]);
                                DB::commit();
                                session()->flash('success', 'Shipment Booked successfully');
                                if ($transection) {
                                    $responce = [
                                        'status' => 'success',
                                        'data' => 'Shipment Booked successfully',
                                    ];
                                    echo json_encode($responce);
                                    exit;
                                }
                            } else {
                                $responce = [
                                    'status' => 'faild',
                                    'data' =>  'Something went to wrong',
                                ];
                                echo json_encode($responce);
                                exit;
                            }
                        } catch (\Exception $e) {
                            DB::rollBack();
                            $msg = session()->flash('faild', 'An error occurred: ' . $e->getMessage());
                            $responce = [
                                'status' => 'faild',
                                'data' =>  'An error occurred: ' . $e->getMessage(),
                            ];
                            echo json_encode($responce);
                            exit;
                        }
                    }
                }
            }
        }
    }

    public function rate_calculator()
    {
        $data = [];
        $data['title'] = 'Rate calculator';
        $data['mode'] = DB::table('tbl_transfer_mode')->where(['mfd' => 0, 'status' => 0])->get();
        $data['curier'] = DB::table('tbl_courier_company')->where(['mfd' => 0, 'status' => 0])->get();
        return view('customer.rate_calculator.rateCalculator', $data);
    }

    function getRateCalculate(Request $request)
    {
        $validation = Validator::make($request->all(), [
            'courier_id' => 'required',
            'mode_id' => 'required',
            'applicable_weight' => 'required|numeric',
            'from_pincode' => 'required|numeric',
            'to_pincode' => 'required|numeric'
        ]);
        if ($validation->passes()) {
            $rate_id = DB::table('tbl_customers')->where(['id' => session('customer.id')])->first();
            $courier_company = DB::table('tbl_courier_company')->where(['status' => 0, 'mfd' => 0])->get();
            $delDate = date('Y-m-d', strtotime(date('Y-m-d')));
            $data['courier_company'] = [];
            $from_z = $this->pincode->pincodeZone($request->from_pincode);
            $to_z = $this->pincode->pincodeZone($request->to_pincode);
            $fromZone = !empty($from_z) ? $from_z->id : 0;
            $toZone = !empty($to_z) ? $to_z->id : 0;
            $modewiseRate = $this->rate->CustomerRate($rate_id->fuel_group_id, $fromZone, $toZone, $request->applicable_weight, $delDate);
            // dd($modewiseRate);
            foreach ($modewiseRate as $key => $val) {
                $rate = $this->RateCalculate($val->mode_id, $val->courier, $rate_id->fuel_group_id, $rate_id->rate_group_id, (object)['pincode' => $request->from_pincode], (object)['pincode' => $request->to_pincode], $request->applicable_weight, $delDate);
                $daysToAdd = $rate[1];
                $mode = DB::table('tbl_transfer_mode')->where(['id' => $val->mode_id])->first();
                $courier = DB::table('tbl_courier_company')->where(['id' => $val->courier, 'mfd' => 0, 'status' => 0])->first();
                if (!empty($rate)) {
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
                            'img_logo' => asset('admin-assets/courier_company_logo/' . $courier->img_logo),
                            'company_name' => $courier->company_name,
                            'amount' => $rate[0],
                            'company_id' => $val->courier,
                            'mode' => $mode->mode_name,
                            'mode_id' => $mode->id,
                            'deliverydate' => date('M d Y', strtotime("$delDate + $daysToAdd days")),
                            'pickupdate' => date('M d Y', strtotime($delDate)),
                        ];
                    }
                }
            }
            if (empty($data['courier_company'])) {
                return json_encode([
                    'status' => 'rate',
                    'data' => 'Rate Not Exist'
                ]);
            } else {
                return json_encode([
                    'status' => 'true',
                    'data' => $data
                ]);
            }
        } else {
            return json_encode([
                'status' => 'failed',
                'data' => $validation->errors()
            ]);
        }
    }

    public function shipmentTracking()
    {

        $type = request()->input('shipment_type');
        if ($type == 1) {
            $searchData = request()->input('reference_no');
            $currentPage = request()->input('page', 1);
            $query = DomesticBooking::query();
            if (!empty($searchData)) {
                $query->where('order_id', 'like', '%' . $searchData . '%')
                    ->orWhere('forwording_no', 'like', '%' . $searchData . '%');
            }
            $data['domesticShipment'] = [];
            $orders = $query->get();
            if (!empty($orders)) {
                $track = DB::table('tbl_domestic_tracking')->where(['order_id' => $orders[0]->order_id])->get();
                $data = [
                    'domesticShipment' => $orders,
                    'track' => $track,
                    'reference_no' => $searchData,
                ];
            }
        } elseif ($type == 2) {
            $searchData = request()->input('reference_no');
            $currentPage = request()->input('page', 1);
            $query = InternationalBooking::query();
            if (!empty($searchData)) {
                $query->where('order_id', 'like', '%' . $searchData . '%')
                    ->orWhere('forwording_no', 'like', '%' . $searchData . '%');
            }
            $orders = $query->get();
            $data['internationalShipment'] = [];
            if (!empty($orders)) {
                $track = DB::table('tbl_international_tracking')->where(['order_id' => $orders[0]->order_id])->get();
                $data = [
                    'internationalShipment' => $orders,
                    'track' => $track,
                    'reference_no' => $searchData,
                ];
            }
        }
        $data['title'] = "Track Our Shipment";
        return view('customer.trackingShipement.view_trackShipment', $data);
    }


    public function GetEwayAccess()
    {
        if (!empty($_GET['senderPincode'])) {
            $senderPincode = $_GET['senderPincode'];
        } else {
            $senderPincode = $_GET['senderPincodebilling'];
        }
        if ($_GET['reciver'] == 'primary') {
            $customer = DB::table('tbl_customers')->where(['id' => Session('customer.id')])->first();
            $ReciverPincode = $customer->pincode;
        } else {
            $address = DB::table('tbl_pickup_address')->where(['id' => $_GET['reciver']])->first();
            $ReciverPincode = $address->pincode;
        }
        $frompincodewhere = ['tbl_pincode.pincode' => $senderPincode];
        $frompin = $this->pincode->pincodedata($frompincodewhere);

        $topincodewhere = ['tbl_pincode.pincode' => $senderPincode];
        $topin = $this->pincode->pincodedata($topincodewhere);

        if ($frompin->state_id == $topin->state_id) {
            $data = ['from_state' => $frompin->state_id, 'to_state' => $topin->state_id, 'acces' => '1'];
        } else {
            $data = ['from_state' => $frompin->state_id, 'to_state' => $topin->state_id, 'acces' => '2'];
        }
        echo json_encode($data);
        exit();
    }

    public function add_b2b_orders()
    {
        $data = [];
        $data['title'] = "B2B Order Create";
        $data['state'] = DB::table('tbl_state')->get();
        $data['country'] = DB::table('tbl_country')->get();
        $data['pickup_address'] = DB::table('tbl_customers')->where(['id' => Session('customer.id')])->first();
        $data['addressbook'] = DB::table('tbl_pickup_address')->where(['customer_id' => Session('customer.id'), 'mfd' => 0])->get();
        return view('customer.orders.add_b2b_orders', $data);
    }

    public function storeb2bBooking(Request $request)
    {
        // dd($request->all());
        $validation = Validator::make($request->all(), [
            'order_id' => 'nullable',
            'paymentMode' => 'required|string',
            'pickup_type' => 'required',
            'pickup_location_wearhouse' => 'required|numeric',
            'consigner_name' => 'nullable',
            'consiger_phone_no' => 'nullable',
            'consiger_gst_no' => 'nullable',
            'consiger_consignee_address' => 'nullable',
            'consiger_pincode' => 'nullable',
            'consiger_city' => 'nullable',
            'consiger_state' => 'nullable',
            'consignee_name' => 'required|string',
            'company_name' => 'required|string',
            'phone_no' => 'required|numeric',
            'gst_no' => 'required',
            'consignee_address' => 'required',
            'pincode' => 'required|numeric',
            'city' => 'required|string',
            'state' => 'required|string',
            'total_chargable_weight' => 'required|numeric',
            'no_of_invoice' => 'required|integer',
            'no_of_box' => 'required|integer',
            'no_of_pkt' => 'array',
            'no_of_pkt.*' => 'required|integer|min:1',
            'box_name' => 'array',
            'box_name.*' => 'required|string|min:1',
            'hsn_code' => 'required|array|min:1',
            'hsn_code.*' => 'required|string|min:1',
            'lenght' => 'required|array|min:1',
            'lenght.*' => 'required|numeric|min:1',
            'breath' => 'required|array|min:1',
            'breath.*' => 'required|numeric|min:1',
            'height' => 'required|array|min:1',
            'height.*' => 'required|numeric|min:1',
            'actual_weight' => 'required|array|min:0',
            'actual_weight.*' => 'required|numeric|min:0',
            'chargable_weight' => 'required|array|min:0',
            'chargable_weight.*' => 'required|numeric|min:0',
            'volumeMatrix' => 'required|array|min:0',
            'volumeMatrix.*' => 'required|numeric|min:0',
            'invoice_no' => 'required|array|min:1',
            'invoice_no.*' => 'required|string|min:1',
            'invoice_date' => 'required|array|min:1',
            'invoice_date.*' => 'required|date',
            'invoice_amount' => 'required|array|min:1',
            'invoice_amount.*' => 'required|numeric|min:1',
            'eway_no' => 'required|array|min:1',
            'eway_no.*' => 'required|string|min:1',
            'eway_date' => 'required|array|min:1',
            'eway_date.*' => 'required|date',
        ]);
        date_default_timezone_set("Asia/Calcutta");
        if ($validation->passes()) {
            $series = 900000000;
            $MAxID = DomesticBooking::max('booking_id');
            $Usid = $MAxID + 1;
            $orderId = $series + $Usid;
            try {
                $orderData = [
                    'order_no' => $orderId,
                    'customer_id' => session('customer.id'),
                    'branch_id' => session('customer.branch_id'),
                    'booking_date' => date('Y-m-d'),
                    'booking_time' => date('h:i:s'),
                    'created_at' => date('Y-m-d h:i:s'),
                    'order_channels' => 'Custome',
                    'payment_mode' => $request->paymentMode,
                    'pickup_location_wearhouse' => $request->pickup_location_wearhouse,
                    // sender details
                    'sender_name' => $request->consigner_name,
                    'sender_contact_no' => $request->consiger_phone_no,
                    'sender_gstno' => $request->consiger_gst_no,
                    'sender_address' => $request->consiger_address,
                    'sender_pincode' => $request->consiger_pincode,
                    // reciver details 
                    'receiver_name' => $request->consignee_name,
                    'receiver_company_name' => $request->company_name,
                    'receiver_contact_no' => $request->phone_no,
                    'receiver_gstno' => $request->gst_no,
                    'receiver_address' => $request->consignee_address,
                    'receiver_pincode' => $request->pincode,
                ];


                DB::beginTransaction();
                $orderBooking = DomesticBooking::create($orderData);
                //    dd($orderBooking);
                $booking_id = $orderBooking->id; // last genrated Id
                $stockData = [
                    'booking_id' => $booking_id,
                    'order_id' => $orderId,
                    'shipment_type' => 1,
                    'order_booked' => 1,
                    'created_at' => Carbon::now(),
                ];
                DB::table('tbl_shipment_stock_manager')->insert($stockData);
                // product insetion
                $productData = [
                    'booking_id' => $booking_id,
                    'no_of_pack' => $request->no_of_box,
                    'total_chargable_weight' => $request->total_chargable_weight,
                    'product_name' => json_encode($request->box_name),
                    'hson_code' => json_encode(value: $request->hsn_code),
                    'no_of_pack_details' => json_encode($request->no_of_pkt),
                    'length_detail' => json_encode($request->lenght),
                    'breath_detail' => json_encode($request->breath),
                    'height_detail' => json_encode($request->height),
                    'valumetric_chargable_details' => json_encode($request->volumeMatrix),
                    'actual_weight_details' => json_encode($request->actual_weight),
                    'chargable_weight_details' => json_encode($request->chargable_weight),

                ];
                $productBooking = DB::table('tbl_domestic_weight_details')->insert($productData);

                $invoiceData = [
                    'booking_id' => $booking_id,
                    'invoice_no' => json_encode($request->invoice_no),
                    'invoice_values' => json_encode($request->invoice_amount),
                    'invoice_date' => json_encode($request->invoice_date),
                    'eway_no' => json_encode($request->eway_no),
                    'eway_date' => json_encode($request->eway_date),
                ];
                $invoiceBooking = DB::table('tbl_domestic_booking_invoice')->insert($invoiceData);
                $location = DB::table('tbl_branches')->where(['branch_id'=>Session('customer.branch_id')])->first();
                $trackingData = [
                    'order_no' => $orderId,
                    'status' => "Booked",
                    'datetime' => date('Y/m/d h:i:s'),
                    'location'=> $location->branch_name,
                    'mfd'=> 0,
                    
                ];
                $trackBooking = DB::table('tbl_domestic_tracking')->insert($trackingData);


                if ($orderBooking) {
                    DB::commit();
                    $msg = session()->flash('success', 'Order added successfully');
                    $responce = [
                        'status' => 'success',
                        'error' => 'Order added successfully',
                    ];
                    echo json_encode($responce);
                    exit;
                } else {
                    // If creation was not successful, throw an exception
                    throw new \Exception('Data not inserted');
                }
            } catch (\Exception $e) {
                DB::rollBack();
                $msg = session()->flash('faild', 'An error occurred: ' . $e->getMessage());
                $responce = [
                    'status' => 'false1',
                    'error' => 'An error occurred: ' . $e->getMessage() . 'Line :' . $e->getLine(),
                ];
                echo json_encode($responce);
                exit;
            }
        } else {
            $json = [
                'status' => 'false',
                'data' => $validation->errors(),
            ];
            echo json_encode($json);
            exit;
        }
    }

    public function getOrders()
    {
        $id = request()->input('id');
        $booking = DB::table('tbl_domestic_booking')
            ->where(['id' => $id])
            ->first();
        if (!empty($booking)) {
            echo json_encode([
                'status' => true,
                'id' => $id
            ]);
            exit;
        } else {
            echo json_encode([
                'status' => false,
                'id' => $id
            ]);
            exit;
        }
    }

    function updateCanelOrders(Request $request)
    {
        $id = $request->id;
        $msg = $request->msg;
        $booking_data = DB::table('tbl_domestic_booking')->where(['id' => $id])->first();
        if ($booking_data->pickup_address == 'primary') {
            $customer = DB::table('tbl_customers')->where(['id' => session('customer.id')])->first();
            $pincodewhere = ['tbl_pincode.pincode' => $customer->pincode];
            $frompin = $this->pincode->pincodedata($pincodewhere);
            $location = $frompin->city;
        } else {
            $customer = DB::table('tbl_pickup_address')->where(['id' => $booking_data->pickup_address])->first();
            $pincodewhere = ['tbl_pincode.pincode' => $customer->pincode];
            $frompin = $this->pincode->pincodedata($pincodewhere);
            $location = $frompin->city;
        }
        try {
            $stockData = [
                'pickup' => 1,
            ];
            $orderBooking = DB::table('tbl_shipment_stock_manager')->where(['shipment_type' => 1, 'booking_id' => $id])->update($stockData);

            $trackData = [
                'order_id' => $booking_data->order_id,
                'location' => $location,
                'status' => 'Cancelled',
                'comment' => $msg,
                'dateTime' => date('Y-m-d h:i:s'),
                'created_at' => date('Y-m-d h:i:s'),
            ];
            DB::table('tbl_domestic_tracking')->insert($trackData);
            if ($orderBooking) {
                DB::commit();
                $msg = session()->flash('success', 'Order added successfully');
                $responce = [
                    'status' => 'success',
                    'error' => 'Order added successfully',
                ];
                echo json_encode($responce);
                exit;
            } else {
                // If creation was not successful, throw an exception
                throw new \Exception('Data not inserted');
            }
        } catch (\Exception $e) {
            DB::rollBack();
            $msg = session()->flash('faild', 'An error occurred: ' . $e->getMessage());
            $responce = [
                'status' => 'false1',
                'error' => 'An error occurred: ' . $e->getMessage(),
            ];
            echo json_encode($responce);
            exit;
        }
    }
}
