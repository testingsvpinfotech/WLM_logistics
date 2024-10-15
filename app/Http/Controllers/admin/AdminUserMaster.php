<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Models\UserMaster;

class AdminUserMaster extends Controller
{
    public function index()
    {
        $data = [];
        $data['title'] = 'View User Master';
        $data['users'] = DB::table('tbl_users as u')
                        ->join('tbl_branches as b', 'u.branch_id', '=', 'b.id')
                        ->join('tbl_usertypes as r', 'u.usertype', '=', 'r.id')
                        ->select('u.id as id','u.username', 'u.user_name', 'u.contact_no', 'u.alternate_contact_no', 'u.email', 'u.usertype', 'u.branch_id', 'b.branch_name as branch_name','r.name as usertype')
                        ->where(['u.mfd'=>0])
                        ->get();
        return view('admin.user_master.view_user_master',$data);
    }

    public function add_user()
    {
        $data = [];
        $data['title'] = 'Add User';
        $data['userType'] = DB::table('tbl_usertypes')->where(['mfd'=>0])->get();
        $data['branch'] = DB::table('tbl_branches')->where(['mfd'=>0])->get();
        return view('admin.user_master.add_user',$data);
    }
    public function edit_user($id)
    {
        $data = [];
        $data['title'] = 'Edit User';
        // $data['user'] = UserMaster::find($id);
        $data['user'] = UserMaster::find($id);
        $data['userType'] = DB::table('tbl_usertypes')->where(['mfd'=>0])->get();
        $data['branch'] = DB::table('tbl_branches')->where(['mfd'=>0])->get();
        // dd($data['user']);
        return view('admin.user_master.edit_user',$data);
    }

    public function store_user(Request $request)
    {
        $validation = validator::make($request->all(),
        [
              'username'=>'required|string|unique:tbl_users,username|regex:/^[a-zA-Z\s]+$/',
              'password'=> 'required|min:8',
              'user_name'=>'required|string|regex:/^[a-zA-Z\s]+$/',
              'contact_no' => 'required|numeric|min:10',
              'alternate_contact_no'=>'nullable|numeric|min:10',
              'email'=>'required',
              'usertype'=> 'required|numeric|min:1',
              'branch_id'=> 'required|numeric|min:1'
        ]);
        if($validation->passes())
        {
            try{
                $userData = [
                'username'=>$request->username,
                'password'=>Hash::make($request->password),
                'user_name' =>$request->user_name,
                'contact_no' =>$request->contact_no,
                'email' =>$request->email,
                'alternate_contact_no' =>$request->alternate_contact_no,
                'usertype' =>$request->usertype,
                'branch_id' =>$request->branch_id,
                'created_at'=> date('Y-m-d H:i:s')
                ];

                DB::beginTransaction();
                $branch =  UserMaster::create($userData);
                if ($branch) {
                    DB::commit();
                    $msg =  session()->flash('success', 'Branch saved successfully');
                    $responce = [
                        'status'=>'success',
                        'error' => 'Branch saved successfully'
                    ];
                    echo json_encode($responce);exit;
                } else {
                    // If creation was not successful, throw an exception
                    throw new \Exception('Data not inserted');
                }

            }catch(\Exception $e){
                DB::rollBack();
                $msg =  session()->flash('faild', 'An error occurred: ' . $e->getMessage());
                $responce = [
                    'status'=>'faild',
                    'error' =>'An error occurred: ' . $e->getMessage()
                ];
                echo json_encode($responce);exit;
            }
        }else{
            $json = [
                'status'=>'false',
                'data'=> $validation->errors()
            ];
        }
        return json_encode($json);exit;
    }

    public function update_user(Request $request)
    {
        // dd($request->all());
        $validation = validator::make($request->all(),
        [
            'username'=>'required|string',
            'password'=> 'nullable|min:8',
            'user_name'=>'required|string|regex:/^[a-zA-Z\s]+$/',
            'contact_no' => 'required|numeric|min:10',
            'alternate_contact_no'=>'nullable|numeric|min:10',
            'email'=>'required',
            'usertype'=> 'required|numeric|min:1',
            'branch_id'=> 'required|numeric|min:1'
        ]);
      
        if($validation->passes())
        {
            try{
               
                $userData = [
                    'user_name' =>$request->user_name,
                    'contact_no' =>$request->contact_no,
                    'email' =>$request->email,
                    'alternate_contact_no' =>$request->alternate_contact_no,
                    'usertype' =>$request->usertype,
                    'branch_id' =>$request->branch_id,
                    ];
                 if(!empty($request->password))
                 {
                    $userData['password'] = Hash::make($request->password);
                 }
                DB::beginTransaction();
                $branch =  UserMaster::find($request->id);
                $branch->update($userData);
                $branch->save();
                if ($branch) {
                    DB::commit();
                    $msg =  session()->flash('success', 'Branch Updated successfully');
                    $responce = [
                        'status'=>'success',
                        'error' => 'Branch Updated successfully'
                    ];
                    echo json_encode($responce);exit;
                } else {
                    // If creation was not successful, throw an exception
                    throw new \Exception('Data not inserted');
                }
            }catch(\Exception $e){
                DB::rollBack();
                $msg =  session()->flash('faild', 'An error occurred: ' . $e->getMessage());
                $responce = [
                    'status'=>'faild',
                    'error' =>'An error occurred: ' . $e->getMessage()
                ];
                echo json_encode($responce);exit;
            }
        }else{
            $json = [
                'status'=>'false',
                'data'=> $validation->errors()
            ];
        }
        return json_encode($json);exit;
    }


    public function destroyUser(Request $request)
    {
        try {
            DB::beginTransaction();
                $post = UserMaster::find($request->id);
                $post->update(['mfd' => '1']);
                $post->save();
            DB::commit();
            session()->flash('success', 'User Deleted successfully');
            $responce = [
                'success' => 'User Deleted successfully'
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
