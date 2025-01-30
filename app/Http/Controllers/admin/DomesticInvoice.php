<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\DomesticBooking;
use App\Models\DomesticOrdersProducts;
use App\Models\DomesticRate;
use App\Models\PickupAddress;
use App\Models\PincodeMaster;
use App\Models\StackManager;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;
use Illuminate\Validation\Rules\Exists;

class DomesticInvoice extends Controller
{
    //
   
    public function index()
    {
        $data = [];
        $data['title'] = "View Invoice Billed Cycle 1";
        return view('admin.DomesticInvoice.billing_invoiceCycle1',$data);
    }
    public function View_billed_cycle2()
    {
        $data = [];
        $data['title'] = "View Invoice Billed Cycle 2";
        return view('admin.DomesticInvoice.invoice_cycle1_pending',$data);
    }
    public function invoice_cycle1_pending()
    {
        $data = [];
        $data['title'] = "View Invoice Pending Cycle 1";
        return view('admin.DomesticInvoice.invoice_cycle1_pending',$data);
    }
    public function invoice_cycle2_pending()
    {
        $data = [];
        $data['title'] = "View Invoice Pending Cycle 2";
        return view('admin.DomesticInvoice.invoice_cycle2_pending',$data);
    }
    public function add_invoice()
    {
        $data = [];
        $customer_id = request()->input('customer_id');
        $cycle_date = request()->input('date_cycle');
        $data['time_period'] = !(request()->input('time_period'))?request()->input('time_period'):'';
        $data['invoiceData'] = [];
        if(!empty($customer_id))
        {
            if($cycle_date == 1){
                $from_date = date('Y-m-01');
                $to_date = date('Y-m-15');
            }elseif($cycle_date == 2){
                $from_date = date('Y-m-16');
                $to_date = date('Y-m-t');
            }
            $query = DomesticBooking::query();
           $data['invoiceData'] = $query->where(['created_id'=>$customer_id])
                  ->where('orderDate', '>=', $from_date)
                  ->where('orderDate', '<=', $to_date)
                  ->get(); 
                //   dd($query->toSql(), $query->getBindings());
        }
        $data['title'] = "Domestic Invoice Creation";
        $data['customer'] = DB::table('tbl_customers')->where(['mfd'=>0])->get();
        return view('admin.DomesticInvoice.add_invoice',$data);
    }
    public function view_invoice_print()
    {
        $data = [];
        $data['title'] = 'Invoice Creation';
        $data['company'] = DB::table('tbl_company')->where(['id'=>1])->first();
        return view('admin.DomesticInvoice.print_invoice',$data);
    }


}
