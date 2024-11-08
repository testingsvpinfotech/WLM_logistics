<?php

namespace App\Http\Controllers\customer;

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
use App\Models\PickupAddress;
use App\Models\DomesticBooking;
use App\Models\DomesticOrdersProducts;
use App\Models\InternationalBooking;
class CustomerDashboard extends Controller
{
    public function index()
    {
        $data = [];
        $data['title'] ='Welcome To WLM '.session('customer.personal_name');
        $today = now()->toDateString(); // current date
        $yesterday = now()->subDay()->toDateString(); // yesterday's date
        $domesticBooking = new DomesticBooking();
        $today_yesterday = ['DATE(b.orderDate)'=>$today ,'DATE(b.orderDate)'=>$yesterday];
        // $domestic = $domesticBooking->get_orders_count( $today_yesterday);
        // dd($domestic);
        return view('customer.view_dashboard',$data);
    }

    public function home()
    {
        $data = [];
        $data['title'] ='Welcome To WLM '.session('customer.personal_name');
        return view('customer.home_dashboard',$data);
    }

    public function logout(Request $request)
    {
        // Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('sign-in');
    }
}
