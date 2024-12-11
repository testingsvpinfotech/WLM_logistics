<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Session; // Add this line
use App\Models\Adminpermissionss;
class AdminPermissions extends Controller
{
    
    public function edit_permission($id){
        $data = [];
        $data['title'] = 'Edit Users Type Permission';
        $data['id'] = $id;
        $data['userType'] = DB::table('tbl_usertypes')->where(['mfd'=>0,'id'=>$id])->get();
        $data['menu_master'] = DB::table('tbl_menu_master')->where(['menu_status'=>0])->whereNull('master_menu_identity')->get();
        return view('admin.rolepermission.updatepermission',$data);
    }

    public function update_permission(Request $request)
    {
    //    dd($request->all());
        $record = Adminpermissionss::where('usertype', $request->usertype)->first();
        if ($record) {
            $record->delete();
        }
        for ($x = 0; $x < count($request->count); $x++) {
            $count = explode("-",$request->count[$x]); $count_menuId = $count[0]; $count_val = $count[1];
            if(isset($request->view[$x])){ // view
                $view = explode("-",$request->view[$x]); $view_menuId = $view[0]; $view_val = $view[1];
                if($count_menuId == $view_menuId){ $view_val = '1';}else{$view_val = '0';} // view val
            }else{
                $view_val = '0';
            }
            if(isset($request->add[$x])){ // addd
                $add = explode("-",$request->add[$x]); $add_menuId = $add[0]; $add_val = $add[1];
                if($count_menuId == $add_menuId){ $add_val = '1';}else{$add_val = '0';} // add val
            }else{
                $add_val = '0';
            }
            if(isset($request->edit[$x])){ // edit
                $edit = explode("-",$request->edit[$x]); $edit_menuId = $edit[0]; $edit_val = $edit[1];
                if($count_menuId == $edit_menuId){ $edit_val = '1';}else{$edit_val = '0';} // edit val
            }else{
                $edit_val = '0';
            }
            if(isset($request->delete[$x])){ // delete
                $delete = explode("-",$request->delete[$x]); $delete_menuId = $delete[0]; $delete_val = $delete[1];
                if($count_menuId == $delete_menuId){ $delete_val = '1';}else{$delete_val = '0';} // delete val
            }else{
                $delete_val = '0';
            }
            if(isset($request->other[$x])){ // others
                $other = explode("-",$request->other[$x]); $other_menuId = $other[0]; $other_val = $other[1];
                if($count_menuId == $other_menuId){ $other_val = '1';}else{$other_val = '0';} // other val
            }else{
                $other_val = '0';
            }
            $permission = [
                 'menu_id'=> $count_menuId,
                 'usertype'=> $request->usertype,
                 'view'=> $view_val,
                 'add'=> $add_val,
                 'edit'=> $edit_val,
                 'delete'=> $delete_val,
                 'other'=> $other_val,
                //  'created_at'=> current_date
            ];
           echo '<pre>'; print_r($permission);
            // $user = AdminPermissions::create($permission);
        }
        die;
       
    }
}
