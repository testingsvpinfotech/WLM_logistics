<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Models\PincodeMaster;
class PincodeService extends Controller
{
    public function index()
    {
        $data = [];
        $data['title'] = 'View Pincode Service';
        $data['pincode'] = DB::table('tbl_pincode as p')
                        ->join('tbl_state as s', 'p.state_id', '=', 's.id')
                        ->join('tbl_city as c', 'p.city_id', '=', 'c.id')
                        ->select('p.id as id','p.pincode','s.name as state','c.name as city')
                        ->where(['p.mfd'=>0])
                        ->get();
        return view('admin.pincode_service.view_pincode_service',$data);
    }
}
