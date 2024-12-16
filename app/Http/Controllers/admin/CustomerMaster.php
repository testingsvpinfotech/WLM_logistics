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
class CustomerMaster extends Controller
{
    public function index()
    {
        $searchData = request()->input('search');
        $from_date = request()->input('from_date');
        $to_date = request()->input('to_date');  
        $currentPage = request()->input('page', 1);
        $query = CustomerModel::query();
        $query->join('tbl_shipment_stock_manager', 'tbl_domestic_booking.id', '=', 'tbl_shipment_stock_manager.booking_id');
        $query->where(['tbl_domestic_booking.mfd' => 0, 'tbl_shipment_stock_manager.shipment_type' => 1]);
        if (!empty($searchData)) {
            $query->where('tbl_domestic_booking.order_id', 'like', '%' . $searchData . '%')
                ->orWhere('tbl_domestic_booking.buy_full_name', 'like', '%' . $searchData . '%');
        }
        if (!empty($from_date) && !empty($to_date)) {
            $query->whereBetween('tbl_domestic_booking.created_at', [$from_date, $to_date]);
        }
        $orders = $query->paginate(50, ['tbl_domestic_booking.*'], 'page', $currentPage);
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
}
