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
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;

class CourierCompany extends Controller
{
    public function index()
    {
        $data = [];
        $data['title'] = "View Courier Company";
        $data['Courier'] = CourierCompnayModel::where(['mfd' => 0])->get();
        return view('admin.courier_company.view_courier_company', $data);
    }

    public function add_courier()
    {
        $data = [];
        $data['title'] = "Add Courier Company";
        return view('admin.courier_company.add_courier_company', $data);
    }
    public function edit_courier($id)
    {
        $data = [];
        $data['title'] = "Edit Courier Company";
        $data['editData'] = CourierCompnayModel::find($id);
        return view('admin.courier_company.edit_courier_company', $data);
    }


    //  Creating dynamic table for pincode
    public function Pincodetable($tableName)
    {
        return Schema::create($tableName, function (Blueprint $table) {
            $table->id();
            $table->string('pincode')->index();
            $table->unsignedBigInteger('city_id')->index();
            $table->unsignedBigInteger('state_id')->index();
            $table->unsignedBigInteger('zone_id')->index();
            $table->boolean('service')->default(0)->index(); // 0 = Surface, 1 = Air
            $table->boolean('ODA')->default(0)->index(); // 0 = Non-ODA, 1 = ODA
            $table->integer('mfd')->default(0)->index();
            $table->timestamps();
        });
    }

    public function store_courier(Request $request)
    {
        // dd($request->all());
        $validation = validator::make(
            $request->all(),
            [
                'company_name' => 'required',
                'company_type' => 'required',
                'img_logo' => 'required',
            ]
        );
        if ($validation->passes()) {
            try {
                if ($request->hasFile('img_logo')) {
                    $file = $request->file('img_logo');
                    $img_logo = uniqid() . '_' . time() . '.' . $file->getClientOriginalExtension();
                    $file->move(public_path('admin-assets/courier_company_logo'), $img_logo);
                }
                if ($request->company_type == 1) {
                    $tableName = 'tbl_' . strtolower($request->company_name) . '_pincode';

                    // Check if table already exists
                    if (Schema::hasTable($tableName)) {
                        return response()->json(['message' => 'Table already exists!'], 400);
                    }
                    $table = $this->Pincodetable($tableName);
                }
                $Data = [
                    'company_name' => $request->company_name,
                    'company_type' => $request->company_type,
                    'description' => $request->description,
                    'domestic_url' => $request->domestic_url,
                    'international_url' => $request->international_url,
                    'img_logo' => $img_logo,
                ];
                if ($request->company_type == 1) {
                    $Data['pincode_table'] = $tableName;
                }
                DB::beginTransaction();
                $branch =  CourierCompnayModel::create($Data);
                if ($branch) {
                    DB::commit();
                    $msg =  session()->flash('success', 'Courier Company saved successfully');
                    $responce = [
                        'status' => 'success',
                        'error' => 'Courier Company saved successfully'
                    ];
                    echo json_encode($responce);
                    exit;
                } else {
                    // If creation was not successful, throw an exception
                    throw new \Exception('Data not inserted');
                }
            } catch (\Exception $e) {
                DB::rollBack();
                $msg =  session()->flash('faild', 'An error occurred: ' . $e->getMessage());
                $responce = [
                    'status' => 'faild',
                    'error' => 'An error occurred: ' . $e->getMessage()
                ];
                echo json_encode($responce);
                exit;
            }
        } else {
            $json = [
                'status' => 'false',
                'data' => $validation->errors()
            ];
        }
        return json_encode($json);
        exit;
    }

    public function update_courier(Request $request)
    {
        // dd($request->all());
        $validation = validator::make(
            $request->all(),
            [
                'company_name' => 'required',
                'company_type' => 'required',
                'img_logo' => 'nullable',
            ]
        );

        if ($validation->passes()) {
            try {
                if ($request->hasFile('img_logo')) {
                    $file = $request->file('img_logo');
                    $img_logo = uniqid() . '_' . time() . '.' . $file->getClientOriginalExtension();
                    $file->move(public_path('admin-assets/courier_company_logo'), $img_logo);
                }
                if ($request->company_type == 1) {
                    $tableName = 'tbl_' . strtolower($request->company_name) . '_pincode';
                    // Check if table already exists
                    if (!Schema::hasTable($tableName)) {
                        $table = $this->Pincodetable($tableName);
                    }
                }
                $Data = [
                    'company_name' => $request->company_name,
                    'company_type' => $request->company_type,
                    'description' => $request->description,
                    'domestic_url' => $request->domestic_url,
                    'international_url' => $request->international_url,
                ];
                if ($request->hasFile('img_logo')) {
                    $Data['img_logo'] = $img_logo;
                }
                if ($request->company_type == 1) {
                    if (Schema::hasTable($tableName)) {
                        $Data['pincode_table'] = $tableName;
                    }
                }
                DB::beginTransaction();
                $branch =  CourierCompnayModel::find($request->id);
                $branch->update($Data);
                $branch->save();
                if ($branch) {
                    DB::commit();
                    $msg =  session()->flash('success', 'Courier Company Updated successfully');
                    $responce = [
                        'status' => 'success',
                        'error' => 'Courier Company Updated successfully'
                    ];
                    echo json_encode($responce);
                    exit;
                } else {
                    // If creation was not successful, throw an exception
                    throw new \Exception('Data not inserted');
                }
            } catch (\Exception $e) {
                DB::rollBack();
                $msg =  session()->flash('faild', 'An error occurred: ' . $e->getMessage());
                $responce = [
                    'status' => 'faild',
                    'error' => 'An error occurred: ' . $e->getMessage() . 'Line : ' . $e->getLine()
                ];
                echo json_encode($responce);
                exit;
            }
        } else {
            $json = [
                'status' => 'false',
                'data' => $validation->errors()
            ];
        }
        return json_encode($json);
        exit;
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
            echo json_encode($responce);
            exit;
        } catch (\Exception $e) {
            DB::rollBack();
            session()->flash('faild', 'An error occurred: ' . $e->getMessage());
            $responce = [
                'error' => 'An error occurred: ' . $e->getMessage()
            ];
            echo json_encode($responce);
            exit;
        }
    }

    public function downloadImage($path)
    {
        // Define the path to the image in the public folder
        $filePath = public_path('admin-assets/courier_company_logo/' . $path);

        // Return a response that triggers the download
        return response()->download($filePath);
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
            echo json_encode($responce);
            exit;
        } catch (\Exception $e) {
            DB::rollBack();
            session()->flash('faild', 'An error occurred: ' . $e->getMessage());
            $responce = [
                'error' => 'An error occurred: ' . $e->getMessage()
            ];
            echo json_encode($responce);
            exit;
        }
    }
}
