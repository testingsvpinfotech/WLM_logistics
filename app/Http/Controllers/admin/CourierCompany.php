<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Session; // Add this line
use Illuminate\Support\Facades\File;
use App\Models\CourierCompnayModel;
class CourierCompany extends Controller
{
     public function index()
     {
        $data = [];
        $data['title'] = "View Courier Company";
        $data['Courier'] = CourierCompnayModel::where(['mfd'=>0])->get();
        return view('admin.courier_company.view_courier_company',$data);
     }

     public function add_courier()
     {
        $data = [];
        $data['title'] = "Add Courier Company";
        return view('admin.courier_company.add_courier_company',$data);
     }
     public function edit_courier($id)
     {
        $data = [];
        $data['title'] = "Edit Courier Company";
        $data['editData'] = CourierCompnayModel::find($id);
        return view('admin.courier_company.edit_courier_company',$data);
     }

     public function store_courier(Request $request)
     {
        // dd($request->all());
        $validation = validator::make($request->all(),
        [
              'company_name'=>'required|regex:/^[a-zA-Z\s]*$/',
        ]);
        if($validation->passes())
        {
            try{
                $Data = [
                     'company_name'=>$request->company_name,
                     'company_type'=>$request->company_type,
                     'description'=>$request->description,
                     'domestic_url'=>$request->domestic_url,
                     'international_url'=>$request->international_url,
                ];
                DB::beginTransaction();
                $branch =  CourierCompnayModel::create($Data);
                if ($branch) {
                    DB::commit();
                    $msg =  session()->flash('success', 'Courier Company saved successfully');
                    $responce = [
                        'status'=>'success',
                        'error' => 'Courier Company saved successfully'
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

     public function update_courier(Request $request)
    {
        // dd($request->all());
        $validation = validator::make($request->all(),
        [
            'company_name'=>'required|regex:/^[a-zA-Z\s]*$/',
        ]);
      
        if($validation->passes())
        {
            try{
               
                $Data = [
                    'company_name'=>$request->company_name,
                    'company_type'=>$request->company_type,
                    'description'=>$request->description,
                    'domestic_url'=>$request->domestic_url,
                    'international_url'=>$request->international_url,
               ];
                DB::beginTransaction();
                $branch =  CourierCompnayModel::find($request->id);
                $branch->update($Data);
                $branch->save();
                if ($branch) {
                    DB::commit();
                    $msg =  session()->flash('success', 'Courier Company Updated successfully');
                    $responce = [
                        'status'=>'success',
                        'error' => 'Courier Company Updated successfully'
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

    public function status(Request $request)
    {
        try {
            DB::beginTransaction();
                $post = CourierCompnayModel::find($request->id);
                $post->update(['status' => $request->data]);
                $post->save();
            DB::commit();
            session()->flash('success', 'Business Category Deleted successfully');
            $responce = [
                'status' => 'success',
                'success' => 'Business Category Deleted successfully'
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
    public function destroycorier(Request $request)
    {
        try {
            DB::beginTransaction();
                $post = CourierCompnayModel::find($request->id);
                $post->update(['mfd' => '1']);
                $post->save();
            DB::commit();
            session()->flash('success', 'Courier Company Deleted successfully');
            $responce = [
                'status' => 'success',
                'success' => 'Courier Company Deleted successfully'
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
