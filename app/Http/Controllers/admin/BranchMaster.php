<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;    
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use App\Models\AdminBranchMaster;
use Illuminate\Support\Facades\File;

class BranchMaster extends Controller
{
    public function index()
    {
        $data = [];
        $data['title'] = "View Branch Master";
        $data['branches'] = DB::table('tbl_branches')->where(['mfd'=>0])->get();
        return view('admin.branch_master.view_branches',$data);
     }
}
