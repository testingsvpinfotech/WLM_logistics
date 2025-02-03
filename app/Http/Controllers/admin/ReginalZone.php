<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Session; // Add this line
use App\Models\ZoneGroup;
use App\Models\ZoneMaster;

class ReginalZone extends Controller
{
    protected $zoneGroup;
    public function __construct()
    {
        $this->zoneGroup = new ZoneGroup();
    }
    public function index()
    {
        $data = [];
        $data['title'] = "View Zone Master";

        $data['zone']  = DB::table('tbl_region_group as m')
        ->join('tbl_courier_company as g', 'g.id', '=', 'm.courier_id')
        ->where(['m.mfd'=>0])
        ->select('m.*','g.company_name')->get();
        return view('admin.zone_master.view_zone_master', $data);
    }

    public function add_zone()
    {
        $data = [];
        $data['title'] = "Add Zone";
        $data['state'] = DB::table('tbl_state')->where(['mfd' => '0'])->get();
        $data['courier'] = DB::table('tbl_courier_company')->where(['company_type'=>1,'status'=>0,'mfd' => '0'])->get();
        return view('admin.zone_master.add_zone', $data);
    }
    public function edit_zone($id)
    {
        $data = [];
        $data['title'] = "Edit Zone";
        $data['groupEdit'] = ZoneGroup::find($id);
        $data['zone'] = $this->zoneGroup->getzoneData(['g.id' => $id]);
        $data['courier'] = DB::table('tbl_courier_company')->where(['company_type'=>1,'status'=>0,'mfd' => '0'])->get();
        $data['states'] = DB::table('tbl_region_master') ->where('zone_id', $id)->pluck('state_id')->toArray();
        $data['cityIds'] = DB::table('tbl_region_master')->where(['zone_id'=>$id])->pluck('city_id')->toArray();
        $data['city'] = DB::table('tbl_region_master')->join('tbl_city','tbl_city.id', '=', 'tbl_region_master.city_id')->select('tbl_city.*')->where(['tbl_region_master.zone_id'=>$id])->get();
        $data['state'] = DB::table('tbl_state')->where(['mfd' => '0'])->get();
        return view('admin.zone_master.edit_zone', $data);
    }
    public function view_zone($id)
    {
        $data = [];
        $data['title'] = "View Zone";
        $data['zone'] = $this->zoneGroup->getzoneData(['g.id' => $id]);
        $data['state'] = DB::table('tbl_state')->where(['mfd' => '0'])->get();
        return view('admin.zone_master.zone_view', $data);
    }

    public function getCity(Request $request)
    {
        $state_id = $request->state;
        $courier_id = $request->courier_id;
        $html = '';
        if (!empty($state_id)) {
            $city = DB::table('tbl_city')->whereIn('state_id', $state_id)->get();
            if (!empty($city)) {
                foreach ($city as $key => $val) {
                    $zoneExist = DB::table('tbl_region_master')
                    ->join('tbl_region_group', 'tbl_region_master.zone_id', '=', 'tbl_region_group.id')
                    ->where([
                        'tbl_region_master.city_id' => $val->id,
                        'tbl_region_master.state_id' => $val->state_id,
                        'tbl_region_group.courier_id' => $courier_id
                    ])
                    ->select('tbl_region_master.*', 'tbl_region_group.zone_name') // Add specific columns as needed
                    ->get();
                    // dd($zoneExist);
                    if ($zoneExist->isEmpty()) {
                        $html .= '<option value="' . $val->id . '">' . strtolower($val->name) . '</option>';
                    }
                    //    dd($zoneExist);
                }
                $responce = [
                    'status' => 'success',
                    'data' => $html
                ];
                echo json_encode($responce);
                exit;
            }

        } else {
            $responce = [
                'status' => 'empty',
                'error' => 'City Not Found Please Check other Zone otherwise Inactive zone'
            ];
            echo json_encode($responce);
            exit;
        }
    }


    public function store_zone(Request $request)
    {
        // dd($request->all());
        $validation = Validator::make($request->all(), [
            'zone_name' => 'required|string|unique:tbl_region_group,zone_name',
            'courier' => 'required',
        ]);

        if ($validation->passes()) {
            $zoneGroup = [
                'zone_name' => $request->zone_name,
                'courier_id' => $request->courier,
                'description' => $request->description
            ];
            try {
                DB::beginTransaction();
                $ZoneGroup = ZoneGroup::create($zoneGroup);
                $zone_id = $ZoneGroup->id;
                foreach ($request->state_id as $key => $state) {
                    if ($state != 'multiselect-all') {
                        foreach ($request->city_id as $key => $city) {
                            $zoneExist = DB::table('tbl_region_master')->where(['city_id' => $state, 'state_id' => $state])->get();
                            if ($zoneExist->isEmpty()) {
                                if ($city != 'multiselect-all') {
                                    $ZoneMaster = [
                                        'zone_id' => $zone_id,
                                        'state_id' => $state,
                                        'city_id' => $city,
                                    ];
                                    $ZoneMasterinsert = ZoneMaster::create($ZoneMaster);
                                }
                            }
                        }
                    }
                }
                DB::commit();
                $msg = session()->flash('success', 'Zone saved successfully');
                $responce = [
                    'status' => 'success',
                    'error' => 'Zone saved successfully'
                ];
                echo json_encode($responce);
                exit;
            } catch (\Exception $e) {
                DB::rollBack();
                $msg = session()->flash('faild', 'An error occurred: ' . $e->getMessage());
                $responce = [
                    'status' => 'faild',
                    'error' => 'An error occurred: ' . $e->getMessage()
                ];
                echo json_encode($responce);
                exit;
            }

        } else {
            $responce = [
                'status' => 'false',
                'error' => $validation->errors()
            ];
            echo json_encode($responce);
            exit;
        }
    }

    public function getEditCity(Request $request)
    {
        $state_id = $request->state;
        $html = '';
        if (!empty($state_id)) {
            $city = DB::table('tbl_city')->whereIn('state_id', $state_id)->get();
            if (!empty($city)) {
                foreach ($city as $key => $val) {
                    // $zoneExist = DB::table('tbl_region_master')->where(['city_id' => $val->id, 'state_id' => $val->state_id])->get();
                    // if ($zoneExist->isEmpty()) {
                        $html .= '<option value="' . $val->id . '">' . strtolower($val->name) . '</option>';
                    // }
                    //    dd($zoneExist);
                }
                $responce = [
                    'status' => 'success',
                    'data' => $html
                ];
                echo json_encode($responce);
                exit;
            }

        } else {
            $responce = [
                'status' => 'empty',
                'error' => 'City Not Found Please Check other Zone otherwise Inactive zone'
            ];
            echo json_encode($responce);
            exit;
        }
    }

    public function update_zone(Request $request)
    {
        // dd($request->all());
        $validation = Validator::make($request->all(), [
            'zone_name' => 'required|string',
            'courier' => 'required',
        ]);

        if ($validation->passes()) {
            $zoneGroup = [
                'zone_name' => $request->zone_name,
                'courier_id' => $request->courier,
                'description' => $request->description
            ];
            try {
                DB::beginTransaction();
                $ZoneGroup = new ZoneGroup;
                $branch =  ZoneGroup::find($request->id);
                $branch->update($zoneGroup);
                $branch->save();
                $zone_id = $request->id;
                ZoneMaster::where(['zone_id'=>$zone_id])->delete();
                foreach ($request->state_id as $key => $state) {
                    if ($state != 'multiselect-all') {
                        foreach ($request->city_id as $key => $city) {
                            $zoneExist = DB::table('tbl_region_master')->where(['city_id' => $state, 'state_id' => $state])->get();
                            if ($zoneExist->isEmpty()) {
                                if ($city != 'multiselect-all') {
                                    $ZoneMaster = [
                                        'zone_id' => $zone_id,
                                        'state_id' => $state,
                                        'city_id' => $city,
                                    ];
                                    $ZoneMasterinsert = ZoneMaster::create($ZoneMaster);
                                }
                            }
                        }
                    }
                }
                DB::commit();
                $msg = session()->flash('success', 'Zone Updated successfully');
                $responce = [
                    'status' => 'success',
                    'error' => 'Zone Updated successfully'
                ];
                echo json_encode($responce);
                exit;
            } catch (\Exception $e) {
                DB::rollBack();
                $msg = session()->flash('faild', 'An error occurred: ' . $e->getMessage());
                $responce = [
                    'status' => 'faild',
                    'error' => 'An error occurred: ' . $e->getMessage()
                ];
                echo json_encode($responce);
                exit;
            }

        } else {
            $responce = [
                'status' => 'false',
                'error' => $validation->errors()
            ];
            echo json_encode($responce);
            exit;
        }
    }

    public function status(Request $request)
    {
        try {
            DB::beginTransaction();
                $post = ZoneGroup::find($request->id);
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
}
