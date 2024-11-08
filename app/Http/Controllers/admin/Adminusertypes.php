<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Session; // Add this line
use App\Models\AdminUserType;
class Adminusertypes extends Controller
{
    public function index()
    {
        $data = [];
        $data['title'] = 'View UserTypes Master';
        $data['roleMaster'] = AdminUserType::where(['mfd'=>0])->get();
        return view('admin.usertypes_master.view_userypes',$data);
    }

    public function add_usertype()
    {
        $data = [];
        $data['title'] = 'Add UserTypes';
        return view('admin.usertypes_master.add_usertypes',$data);
    }

    public function store_usertype(Request $request)
    {
        $validation = Validator::make($request->all(), [
            'name' => 'required|string|unique:tbl_usertypes,name|regex:/^[a-zA-Z\s]+$/',
        ]);
        if($validation->fails())
        {
            $responce = [
                'status'=>'false',
                'error' => $validation->errors()
            ];
            echo json_encode($responce);exit;
        }else{
            try {
                DB::beginTransaction();
                    $user = AdminUserType::create([
                        'name' => $request->name,
                        'description' => $request->description,
                        'created_at' => date('Y-m-d h:s:i')
                    ]);
                DB::commit();
                $msg =  session()->flash('success', 'Role saved successfully');
                $responce = [
                    'status'=>'success',
                    'error' => 'Role saved successfully'
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

    public function editusertype($id)
    {
        $data['title'] = 'Edit UserType';
        $data['editData'] = AdminUserType::find($id);
        return view('admin.usertypes_master.edit_usertype',$data);
    }

    public function updateUsertype(Request $request)
    {
        $validation = validator::make($request->all(),[
            'name' => 'required|string|regex:/^[a-zA-Z\s]+$/',
        ]);
          // Check if the validation fails
        if ($validation->fails()) {
            $responce = [
                'status'=>'false',
                'error' => $validation->errors()
            ];
            echo json_encode($responce);exit;
        }
        if ($validation->passes()) {
            try {
                DB::beginTransaction();
                    $post = AdminUserType::find($request->id);
                    $post->update([
                        'name' => $request->name,
                        'description' => $request->description]);
                    $post->save();
                DB::commit();
                session()->flash('success', 'Usertypes update successfully');
                $responce = [
                    'status'=>'success',
                    'error' => 'Usertypes update successfully'
                ];
                echo json_encode($responce);exit;
            } catch (\Exception $e) {
                DB::rollBack();
                session()->flash('faild', 'An error occurred: ' . $e->getMessage());
                $responce = [
                    'status'=>'faild',
                    'error' =>'An error occurred: ' . $e->getMessage()
                ];
                echo json_encode($responce);exit;
            }  
        }
    }

    public function destroyUsertype(Request $request)
    {
        try {
            DB::beginTransaction();
                $post = AdminUserType::find($request->id);
                $post->update(['mfd' => '1']);
                $post->save();
            DB::commit();
            session()->flash('success', 'UserType Deleted successfully');
            $responce = [
                'success' => 'UserType Deleted successfully'
            ];
            echo json_encode($responce);exit;
        } catch (\Exception $e) {
            DB::rollBack();
            session()->flash('faild', 'An error occurred: ' . $e->getMessage());
            $responce = [
                'error' =>'An error occurred: ' . $e->getMessage()
            ];
            echo json_encode($responce);exit;
        }  
    }
}
