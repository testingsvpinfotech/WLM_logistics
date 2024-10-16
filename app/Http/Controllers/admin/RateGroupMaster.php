<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Session; // Add this line
use App\Models\RateGroup;

class RateGroupMaster extends Controller
{
    public function index()
    {
        $data = [];
        $data['title'] = 'View Rate Group';
        $data['Rategroup'] = RateGroup::where(['mfd'=>0])->get();
        return view('admin.rateGroup_master.view_rate_group',$data);
    }

    public function add_group()
    {
        $data = [];
        $data['title'] = 'Add Rate Group';
        return view('admin.rateGroup_master.add_rate_group',$data);
    }

    public function store_rate(Request $request)
    {
        $validation = Validator::make($request->all(), [
            'name' => 'required|string|unique:tbl_rate_group,name|regex:/^[a-zA-Z\s]+$/',
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
                    $user = RateGroup::create([
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

    public function edit_rate($id)
    {
        $data['title'] = 'Edit Rate Group';
        $data['editData'] = RateGroup::find($id);
        return view('admin.rateGroup_master.edit_rate_group',$data);
    }

    public function update_rate_group(Request $request)
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
                    $post = RateGroup::find($request->id);
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

    public function destroyRategroup(Request $request)
    {
        try {
            DB::beginTransaction();
                $post = RateGroup::find($request->id);
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
