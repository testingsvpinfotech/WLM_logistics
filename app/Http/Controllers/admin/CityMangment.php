<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Models\CityMaster;
class CityMangment extends Controller
{
    public function index()
    {
        $data = [];
        $data['title'] = 'View City Managment';
        $data['city'] = DB::table('tbl_city')
                        ->where(['mfd'=>0])
                        ->get();
        return view('admin.city_managment.view_city',$data);
    }
}
