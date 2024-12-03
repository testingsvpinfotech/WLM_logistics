<?php

namespace App\Http\Controllers\customer;

use App\Http\Controllers\Controller;
use App\Models\DomesticBooking;
use App\Models\DomesticOrdersProducts;
use App\Models\DomesticRate;
use App\Models\InternationalBooking;
use App\Models\PickupAddress;
use App\Models\PincodeMaster;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;
class RateMaster extends Controller
{

    protected $domesticRate;   
    function __construct()
    {
        $this->domesticRate = new DomesticRate;
    }
     public function index()
     {
        $data = [];
        $data['title'] = 'Rate Card';
        $where= ['tbl_domestic_rate.group_id'=> session('customer.rate_group_id')];
        $data['rate'] = $this->domesticRate->domesticRatedetails($where);
        return view('customer.domestic_rate.view_details_rate',$data);
     }
}
