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
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;

class CourierPincodes extends Controller
{

    public function find_pincode()
    {
        $pin = [];
        if (request()->input('pincode')) {
            $courier_company = DB::table('tbl_courier_company')->where(['company_type' => 1])->get();
            $count = 1;
            foreach ($courier_company as $key => $val) {
                $pinCheck = DB::table($val->pincode_table)->where(['pincode' => request()->input('pincode')])->first();
                if (!empty($pinCheck)) {
                    $STATE = DB::table('tbl_state')->where(['id' => $pinCheck->state_id])->first();
                    $city = DB::table('tbl_city')->where(['id' => $pinCheck->city_id])->first();
                    $zone = DB::table('tbl_region_group')->where(['id' => $pinCheck->zone_id])->first();
                    if (!empty($pinCheck)) {
                        $pin[] = [
                            'sr' => $count,
                            'pincode' => $pinCheck->pincode,
                            'courier' => $val->company_name,
                            'state' => $STATE->name,
                            'city' => $city->name,
                            'zone' => $zone->zone_name,
                            'service' => ($pinCheck->service == 1) ? 'Surface' : 'Air',
                            'oda' => ($pinCheck->ODA == 1) ? 'TRUE' : 'FALSE',
                        ];
                    }

                    $count++;
                }
            }
        }
        $data = [];
        $data['title'] = "View Courierwise Pincode";
        $data['pinList'] = $pin;
        return view('admin.courierwise_pincode.view_pincode', $data);
    }
    public function index()
    {
        $data = [];
        $data['title'] = "Upload Courier Pin Code";
        $data['Courier'] = DB::table('tbl_courier_company')->where(['company_type' => 1])->whereNotNull('pincode_table')->get();
        return view('admin.courierwise_pincode.upload_pincode', $data);
    }

    public function export_zone_file()
    {
        $filePath = public_path('admin-assets/pincode_courier/sample_file_pincode.csv');
        return response()->download($filePath);
    }

    public function store_pincode(Request $request)
    {
        $validation = Validator::make($request->all(), [
            'date' => 'required',
            'courier_type' => 'required|string',
            'csv_file' => 'required|file',
        ]);
        if ($validation->fails()) {
            $responce = [
                'status' => 'false',
                'data' => $validation->errors()
            ];
            echo json_encode($responce);
            exit;
        } else {
            try {
                DB::beginTransaction();
                $file             = fopen($_FILES['csv_file']['tmp_name'], "r");
                $cnt = 1;
                while (!feof($file)) {
                    $data    = fgetcsv($file);
                    if ($cnt == 1) {
                        $cnt++;
                        continue;
                    }

                    if (!empty($data)) {
                        $courier_company = DB::table('tbl_courier_company')->where(['company_type' => 1, 'pincode_table' => $request->courier_type])->first();
                        if (!empty($courier_company)) {
                            $pincode = trim(preg_replace('/\s\s+/', ' ', str_replace("\n", " ", $data[0])));
                            $state = strtoupper(trim(preg_replace('/\s\s+/', ' ', str_replace("\n", " ", $data[1]))));
                            $city = strtoupper(trim(preg_replace('/\s\s+/', ' ', str_replace("\n", " ", $data[2]))));
                            $zone = strtoupper(trim(preg_replace('/\s\s+/', ' ', str_replace("\n", " ", $data[3]))));
                            $service = trim(preg_replace('/\s\s+/', ' ', str_replace("\n", " ", $data[4])));
                            $Isoda = trim(preg_replace('/\s\s+/', ' ', str_replace("\n", " ", $data[5])));
                            $getState = DB::table('tbl_state')->whereRaw('UPPER(name) = ?', [$state])->first();
                            $getCity = DB::table('tbl_city')->whereRaw('UPPER(name) = ?', [$city])->first();
                            $getZone = DB::table('tbl_region_group')->where(['courier_id' => $courier_company->id])->whereRaw('UPPER(zone_name) = ?', [$zone])->first();
                            // dd($getZone);
                            if (!empty($getState) && !empty($getCity) && !empty($getZone)) {
                                $zoneId = $getZone->id;
                                $cityId = $getCity->id;
                                $stateId = $getState->id;
                                $pincodeData = [
                                    'pincode' => $pincode,
                                    'state_id' => $stateId,
                                    'city_id' => $cityId,
                                    'zone_id' => $zoneId,
                                    'service' => $service,
                                    'ODA' => $Isoda,
                                ];
                                $getpin = DB::table($request->courier_type)->where($pincodeData)->first();
                                if (empty($getpin)) {
                                    DB::table($request->courier_type)->insert($pincodeData);
                                }
                            }
                        }
                    }
                    $cnt++;
                }
                DB::commit();
                $msg =  session()->flash('success', 'Pincode updated successfully');
                $responce = [
                    'status' => 'success',
                    'error' => 'Pincode updated successfully'
                ];
                echo json_encode($responce);
                exit;
            } catch (\Exception $e) {
                DB::rollBack();
                $msg =  session()->flash('faild', 'An error occurred: ' . $e->getMessage());
                $responce = [
                    'status' => 'faild',
                    'error' => 'An error occurred: ' . $e->getMessage() . ' Line :' . $e->getLine()
                ];
                echo json_encode($responce);
                exit;
            }
        }
    }
}
