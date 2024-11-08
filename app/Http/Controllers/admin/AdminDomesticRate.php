<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Session; // Add this line
use App\Models\DomesticRate;
class AdminDomesticRate extends Controller
{
    public function add_rate()
    {
        $data = [];
        $data['title'] = "Add Domestic Rate";
        $data['zone'] = DB::table('tbl_region_group')->where(['mfd'=>0,'status'=>0])->get();
        $data['rate_group'] = DB::table('tbl_rate_group')->where(['mfd'=>0])->get();
        $data['mode'] = DB::table('tbl_transfer_mode')->where(['mfd'=>0,'status'=>0])->get();
        return view('admin.domestic_rate.add_rate',$data);
    }
}
