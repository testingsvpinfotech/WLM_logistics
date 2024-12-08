<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Session;
use App\Models\WalletTransection;
use App\Models\CustomerModel;
use App\Models\UserMaster;
use Illuminate\Cache\RateLimiting\Limit;

class CustomerWalletTrasection extends Controller
{
    public function index() 
    {
        $customer_id = Session('customer.id');
        $reference_no = request()->input('reference_no');
        $from_date = request()->input('from_date');
        $to_date = request()->input('to_date');
        $currentPage = request()->input('page', 1);
        $query = WalletTransection::query();
        $query->where(['customer_id'=> $customer_id]);
        if (!empty($reference_no)) {
            $query->where(['reference_no'=> $reference_no]);
        }
        if (!empty($from_date) && !empty($to_date)) {
            $query->whereBetween('date', [$from_date, $to_date]);
        }
        $orders = $query->paginate(50, ['*'], 'page', $currentPage);
        $data = [
            'title' => "Walllet Transections",
            'transection' => $orders,
            'customer_id' => $customer_id, 
            'reference_no' => $reference_no, 
            'from_date' => $from_date, 
            'to_date' => $to_date,
            'customer'=> DB::table('tbl_customers')->where(['mfd'=>0])->get()
        ];
        return view("customer.customer_wallet.view_transection", $data);
    }
}
