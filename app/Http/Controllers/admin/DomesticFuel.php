<?php

namespace App\Http\Controllers\admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Session;
use App\Models\FuelMaster;
use Carbon\Carbon;

class DomesticFuel extends Controller
{
    

    public function index()
    {
        $data = [];
        $data['title'] = "View Domestic Fuel Master";
        $data['fuel'] = DB::table('tbl_fuel_master')
        ->join('tbl_fuel_group','tbl_fuel_group.id','=','tbl_fuel_master.group_id')
        ->where(['tbl_fuel_master.mfd'=>0])
        ->select('tbl_fuel_master.*','tbl_fuel_group.name' ,'tbl_fuel_master.id as id') // Adjust as needed
        ->get();
        return view('admin.fuelMaster.fuelMaster',$data);
    }
    public function add_fuel()
    {
        $data = [];
        $data['title'] = "Add Fuel Master";
        $data['fuelGroup'] = DB::table('tbl_fuel_group')->where(['mfd'=>0])->get();
        $data['courier'] = DB::table('tbl_courier_company')->where(['mfd'=>0,'company_type'=>1,'status'=>0])->get();
        return view('admin.FuelMaster.add_domestic_fuel',$data);
    }
    public function edit_fuel($id)
    {
        $data = [];
        $data['title'] = "Edit Fuel Master";
        $data['fuelGroup'] = DB::table('tbl_fuel_group')->where(['mfd'=>0])->get();
        $data['courier'] = DB::table('tbl_courier_company')->where(['mfd'=>0,'company_type'=>1,'status'=>0])->get();
        $data['editData'] = DB::table('tbl_fuel_master')->where(['id'=>$id])->first();
        return view('admin.FuelMaster.edit_domestic_fuel',$data);
    }

    public function store_fuel(Request $request)
    {
        $validation = validator::make($request->all(),
        [
              'date'=>'required|date',
              'fuel_group'=> 'required|numeric',
              'courier'=> 'required|numeric',
              'docket_charges'=> 'required|numeric',
              'min_pickup_charges'=> 'required|numeric',
              'pickup_percentage'=> 'required|numeric',
              'min_rov_charges'=> 'required|numeric',
              'rov_percentage'=> 'required|numeric',
              'min_oda_charges'=> 'required|numeric',
              'oda_per_kg'=> 'required|numeric',
              'handaling_charges'=> 'required|numeric',
              'handaling_per_kg'=> 'required|numeric',
        ]);

        if($validation->passes())
        {
            try{
                $data = [
                    'date'=>$request->date,
                    'group_id'=>$request->fuel_group,
                    'courier'=>$request->courier,
                    'docket_charges'=>$request->docket_charges,
                    'min_pickup_charges'=>$request->min_pickup_charges,
                    'pickup_percentage'=>$request->pickup_percentage,
                    'min_rov_charges'=>$request->min_rov_charges,
                    'rov_percentage'=>$request->rov_percentage,
                    'min_oda_charges'=>$request->min_oda_charges,
                    'oda_per_kg'=>$request->oda_per_kg,
                    'min_handaling_charges'=>$request->handaling_charges,
                    'handaling_per_kg'=>$request->handaling_per_kg,
                    'fuel_price'=>'0.00',
                    'created_at' => Carbon::now(),
                ];
              $branch = DB::table('tbl_fuel_master')->insert($data);
              if ($branch) {
                DB::commit();
                $msg =  session()->flash('success', 'Customer Update successfully');
                $responce = [
                    'status'=>'success',
                    'data' => 'Customer Update successfully'
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
                    'data' =>'An error occurred: ' . $e->getMessage()
                ];
                echo json_encode($responce);exit;
            }

        }else{
            $json = [
                'status'=>'false',
                'data'=> $validation->errors()
            ];
            echo json_encode($json);exit;
        }
    }
    public function fuel_update(Request $request)
    {
        $validation = validator::make($request->all(),
        [
              'date'=>'required|date',
              'fuel_group'=> 'required|numeric',
              'courier'=> 'required|numeric',
              'docket_charges'=> 'required|numeric',
              'min_pickup_charges'=> 'required|numeric',
              'pickup_percentage'=> 'required|numeric',
              'min_rov_charges'=> 'required|numeric',
              'rov_percentage'=> 'required|numeric',
              'min_oda_charges'=> 'required|numeric',
              'oda_per_kg'=> 'required|numeric',
              'handaling_charges'=> 'required|numeric',
              'handaling_per_kg'=> 'required|numeric',
        ]);

        if($validation->passes())
        {
            try{
                $data = [
                    'date'=>$request->date,
                    'group_id'=>$request->fuel_group,
                    'courier'=>$request->courier,
                    'docket_charges'=>$request->docket_charges,
                    'min_pickup_charges'=>$request->min_pickup_charges,
                    'pickup_percentage'=>$request->pickup_percentage,
                    'min_rov_charges'=>$request->min_rov_charges,
                    'rov_percentage'=>$request->rov_percentage,
                    'min_oda_charges'=>$request->min_oda_charges,
                    'oda_per_kg'=>$request->oda_per_kg,
                    'min_handaling_charges'=>$request->handaling_charges,
                    'handaling_per_kg'=>$request->handaling_per_kg,
                    'fuel_price'=>'0.00',
                    'created_at' => Carbon::now(),
                ];
              $branch = DB::table('tbl_fuel_master')->where(['id'=>$request->id])->update($data);
              if ($branch) {
                DB::commit();
                $msg =  session()->flash('success', 'Customer Update successfully');
                $responce = [
                    'status'=>'success',
                    'data' => 'Customer Update successfully'
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
                    'data' =>'An error occurred: ' . $e->getMessage()
                ];
                echo json_encode($responce);exit;
            }

        }else{
            $json = [
                'status'=>'false',
                'data'=> $validation->errors()
            ];
            echo json_encode($json);exit;
        }
    }

    public function destroyfuel(Request $request)
    {
        try {
            DB::beginTransaction();
                DB::table('tbl_fuel_master')->where('id',$request->id)->update(['mfd' => '1']);
            DB::commit();
            session()->flash('success', 'Courier Company Deleted successfully');
            $responce = [
                'status' => 'success',
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
