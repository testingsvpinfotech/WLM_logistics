<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Models\StateMaster;
class StateManagment extends Controller
{
    public function index()
    {
        $data = [];
        $data['title'] = 'View State Managment';
        $data['state'] = DB::table('tbl_state')
                        ->where(['mfd'=>0])
                        ->get();
        return view('admin.state_managment.view_state',$data);
    }
}
