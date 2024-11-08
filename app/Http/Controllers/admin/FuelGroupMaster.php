<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Session; // Add this line
use App\Models\FuelGroup;

class FuelGroupMaster extends Controller
{
    public function index()
    {
        $data = [];
        $data['title'] = 'View Fuel Group';
        $data['Rategroup'] = FuelGroup::where(['mfd'=>0])->get();
        return view('admin.fuelGroup_master.view_fuel_group',$data);
    }

    public function add_group()
    {
        $data = [];
        $data['title'] = 'Add Fuel Group';
        return view('admin.fuelGroup_master.add_fuel_group',$data);
    }

    public function store_fuel(Request $request)
    {
        $validation = Validator::make($request->all(), [
            'name' => 'required|string|unique:tbl_fuel_group,name|regex:/^[a-zA-Z\s]+$/',
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
                    $user = FuelGroup::create([
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

    public function edit_fuel($id)
    {
        $data['title'] = 'Edit Fuel Group';
        $data['editData'] = FuelGroup::find($id);
        return view('admin.fuelGroup_master.edit_fuel_group',$data);
    }

    public function update_fuel_group(Request $request)
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
                    $post = FuelGroup::find($request->id);
                    $post->update([
                        'name' => $request->name,
                        'description' => $request->description]);
                    $post->save();
                DB::commit();
                session()->flash('success', 'Fuel update successfully');
                $responce = [
                    'status'=>'success',
                    'error' => 'Fuel update successfully'
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

    public function destroyFuelgroup(Request $request)
    {
        try {
            DB::beginTransaction();
                $post = FuelGroup::find($request->id);
                $post->update(['mfd' => '1']);
                $post->save();
            DB::commit();
            session()->flash('success', 'Fuel Deleted successfully');
            $responce = [
                'success' => 'Fuel Deleted successfully'
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
