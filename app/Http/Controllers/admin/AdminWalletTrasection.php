<?php

namespace App\Http\Controllers\admin;

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

class AdminWalletTrasection extends Controller
{
    //

    public function index() 
    {
        $customer_id = request()->input('customer_id');
        $reference_no = request()->input('reference_no');
        $from_date = request()->input('from_date');
        $to_date = request()->input('to_date');
        $currentPage = request()->input('page', 1);
        $query = WalletTransection::query();
        if (!empty($customer_id)) {
            $query->where(['customer_id'=> $customer_id]);
        }
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
        return view("admin.wallet_transection.view_transection", $data);
    }
    public function add_topup() 
    {
        $data = [];
        $data['title'] = "Add Manul Topup Walllet";
        $data["customer"] = DB::table('tbl_customers')->where(['mfd'=>0])->get();
        return view("admin.wallet_transection.view_add_toup_transection", $data);
    }

    public function store_topup(Request $request)   
    {
        $validation = Validator::make($request->all(), [
            'customer_id' => 'required',
            'wallet_type' => 'required',
            'reference_no' => 'required',
            'recharge_amount' => 'required|numeric',
        ]);
        if($validation->fails())
        {
            $responce = [
                'status'=>'false',
                'data' => $validation->errors()
            ];
            echo json_encode($responce);exit;
        }else{
            try {
                DB::beginTransaction();
                    $lastT = DB::table('tbl_customer_wallet_transection')->where(['customer_id'=>$request->customer_id])->orderBy('id','desc')->take(1)->first();
                    if(!empty($lastT)){
                        $amount =  $lastT->balance_amount + $request->recharge_amount;
                    }else{
                        $amount = $request->recharge_amount;
                    }
                    $user = WalletTransection::create([
                         'customer_id'=> $request->customer_id,
                         'amount'=> $request->recharge_amount,
                         'transaction_type'=> $request->wallet_type,
                         'reference_no'=> $request->reference_no,
                         'description'=> $request->description,
                         'balance_amount'=> $amount,
                         'status'=>1,
                         'date'=> date('Y-m-d'),
                         'created_at'=> date('Y-m-d H:i:s')
                    ]);
                    $customer =  CustomerModel::find($request->customer_id);
                     $customer->update(['wallet_amount'=>$amount]);
                     $customer->save();
                DB::commit();
                $msg =  session()->flash('success', 'Wallet Reachrge added successfully');
                $responce = [
                    'status'=>'success',
                    'data' => 'Wallet Reachrge added successfully'
                ];
                echo json_encode($responce);exit;
            } catch (\Exception $e) {
                DB::rollBack();
                $msg =  session()->flash('faild', 'An error occurred: ' . $e->getMessage());
                $responce = [
                    'status'=>'faild',
                    'error' =>'An error occurred: ' . $e->getMessage()
                ];
                echo json_encode($responce);exit;
            }  
        }
    }
}
