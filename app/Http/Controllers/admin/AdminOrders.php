<?php

namespace App\Http\Controllers\Admin;

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

class AdminOrders extends Controller
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
    public function index()
    {
        $searchData = request()->input('search');
        $from_date = !empty(request()->input('from_date'))?request()->input('from_date'):date('Y-m-01');
        $to_date = !empty(request()->input('to_date'))?request()->input('to_date'):date('Y-m-d');  
        $currentPage = request()->input('page', 1);
        $query = DomesticBooking::query();
        $query->join('tbl_shipment_stock_manager', 'tbl_domestic_booking.id', '=', 'tbl_shipment_stock_manager.booking_id');
        $query->where(['tbl_domestic_booking.mfd' => 0, 'tbl_shipment_stock_manager.shipment_type' => 1]);
        if (!empty($searchData)) {
            $query->where('tbl_domestic_booking.order_id', 'like', '%' . $searchData . '%')
                ->orWhere('tbl_domestic_booking.buy_full_name', 'like', '%' . $searchData . '%');
        }
        if (!empty($from_date) && !empty($to_date)) {
            $query->whereBetween('tbl_domestic_booking.orderDate', [$from_date, $to_date]);
        }else{
            $query->whereBetween('tbl_domestic_booking.orderDate', [$from_date, $to_date]);
        }
        $orders = $query->paginate(50, ['tbl_domestic_booking.*'], 'page', $currentPage);
        $count = $this->domestic->get_listing_count(0,$from_date,$to_date);
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
        return view('admin.orders.view_orders', $data);
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
        $query->where(['tbl_domestic_booking.mfd' => 0, 'tbl_shipment_stock_manager.shipment_type' => 1, 'tbl_shipment_stock_manager.order_booked' => 1, 'tbl_shipment_stock_manager.pickup' => 0]);
        if (!empty($searchData)) {
            $query->where('tbl_domestic_booking.order_id', 'like', '%' . $searchData . '%')
                ->orWhere('tbl_domestic_booking.buy_full_name', 'like', '%' . $searchData . '%');
        }
        if (!empty($from_date) && !empty($to_date)) {
            $query->whereBetween('tbl_domestic_booking.orderDate', [$from_date, $to_date]);
        }else{
            $query->whereBetween('tbl_domestic_booking.orderDate', [$from_date, $to_date]);
        }
        $orders = $query->paginate(50, ['tbl_domestic_booking.*'], 'page', $currentPage);
        $count = $this->domestic->get_listing_count(0,$from_date,$to_date);
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
        return view('admin.orders.view_UnprocessOrders_orders', $data);
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
        $query->where(['tbl_domestic_booking.mfd' => 0, 'tbl_shipment_stock_manager.shipment_type' => 1, 'tbl_shipment_stock_manager.order_booked' => 1, 'tbl_shipment_stock_manager.api_booked' => 1, 'tbl_shipment_stock_manager.pickup' => 0]);
        if (!empty($searchData)) {
            $query->where('tbl_domestic_booking.order_id', 'like', '%' . $searchData . '%')
                ->orWhere('tbl_domestic_booking.buy_full_name', 'like', '%' . $searchData . '%');
        }
        if (!empty($from_date) && !empty($to_date)) {
            $query->whereBetween('tbl_domestic_booking.orderDate', [$from_date, $to_date]);
        }else{
            $query->whereBetween('tbl_domestic_booking.orderDate', [$from_date, $to_date]);
        }
        $orders = $query->paginate(50, ['tbl_domestic_booking.*'], 'page', $currentPage);
        $count = $this->domestic->get_listing_count(0,$from_date,$to_date);
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
        return view('admin.orders.view_ProcessOrders_orders', $data);
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
        $query->where(['tbl_domestic_booking.mfd' => 0, 'tbl_shipment_stock_manager.shipment_type' => 1, 'tbl_shipment_stock_manager.order_booked' => 1, 'tbl_shipment_stock_manager.api_booked' => 1, 'tbl_shipment_stock_manager.lable_genration' => 1, 'tbl_shipment_stock_manager.pickup' => 0]);
        if (!empty($searchData)) {
            $query->where('tbl_domestic_booking.order_id', 'like', '%' . $searchData . '%')
                ->orWhere('tbl_domestic_booking.buy_full_name', 'like', '%' . $searchData . '%');
        }
        if (!empty($from_date) && !empty($to_date)) {
            $query->whereBetween('tbl_domestic_booking.orderDate', [$from_date, $to_date]);
        }else{
            $query->whereBetween('tbl_domestic_booking.orderDate', [$from_date, $to_date]);
        }
        $orders = $query->paginate(50, ['tbl_domestic_booking.*'], 'page', $currentPage);
        $count = $this->domestic->get_listing_count(0,$from_date,$to_date);
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
        return view('admin.orders.view_readyforship_orders', $data);
    }
    public function Manifest()
    {
        $searchData = request()->input('search');
        $from_date = !empty(request()->input('from_date')) ? request()->input('from_date') : date('Y-m-01');
        $to_date = !empty(request()->input('to_date')) ? request()->input('to_date') : date('Y-m-d');
        $currentPage = request()->input('page', 1);
        $query = DomesticBooking::query();
        $query->join('tbl_shipment_stock_manager', 'tbl_domestic_booking.id', '=', 'tbl_shipment_stock_manager.booking_id');
        $query->where(['tbl_domestic_booking.mfd' => 0, 'tbl_shipment_stock_manager.shipment_type' => 1, 'tbl_shipment_stock_manager.order_booked' => 1, 'tbl_shipment_stock_manager.pickup' => 1]);
        if (!empty($searchData)) {
            $query->where('tbl_domestic_booking.order_id', 'like', '%' . $searchData . '%')
                ->orWhere('tbl_domestic_booking.buy_full_name', 'like', '%' . $searchData . '%');
        }
        if (!empty($from_date) && !empty($to_date)) {
            $query->whereBetween('tbl_domestic_booking.orderDate', [$from_date, $to_date]);
        }else{
            $query->whereBetween('tbl_domestic_booking.orderDate', [$from_date, $to_date]);
        }
        $orders = $query->paginate(50, ['tbl_domestic_booking.*'], 'page', $currentPage);
        $count = $this->domestic->get_listing_count(0,$from_date,$to_date);
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
        return view('admin.orders.view_Manifest_orders', $data);
    }
    public function returnOrders()
    {
        $searchData = request()->input('search');
        $from_date = !empty(request()->input('from_date')) ? request()->input('from_date') : date('Y-m-01');
        $to_date = !empty(request()->input('to_date')) ? request()->input('to_date') : date('Y-m-d');
        $currentPage = request()->input('page', 1);
        $query = DomesticBooking::query();
        $query->join('tbl_shipment_stock_manager', 'tbl_domestic_booking.id', '=', 'tbl_shipment_stock_manager.booking_id');
        $query->where(['tbl_domestic_booking.mfd' => 0, 'tbl_shipment_stock_manager.shipment_type' => 1, 'tbl_shipment_stock_manager.order_booked' => 1, 'tbl_shipment_stock_manager.api_booked' => 1, 'tbl_shipment_stock_manager.lable_genration' => 1, 'tbl_shipment_stock_manager.pickup' => 1, 'tbl_shipment_stock_manager.returns' => 1]);
        if (!empty($searchData)) {
            $query->where('tbl_domestic_booking.order_id', 'like', '%' . $searchData . '%')
                ->orWhere('tbl_domestic_booking.buy_full_name', 'like', '%' . $searchData . '%');
        }
        if (!empty($from_date) && !empty($to_date)) {
            $query->whereBetween('tbl_domestic_booking.orderDate', [$from_date, $to_date]);
        }else{
            $query->whereBetween('tbl_domestic_booking.orderDate', [$from_date, $to_date]);
        }
        $orders = $query->paginate(50, ['tbl_domestic_booking.*'], 'page', $currentPage);
        $count = $this->domestic->get_listing_count(0,$from_date,$to_date);
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
        return view('admin.orders.view_returnOrders', $data);
    }
}
