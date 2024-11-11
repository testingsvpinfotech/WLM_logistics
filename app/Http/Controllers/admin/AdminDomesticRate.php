<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Session; // Add this line
use App\Models\DomesticRate;
use Carbon\Carbon;
class AdminDomesticRate extends Controller
{
    protected $domesticRate;   
    function __construct()
    {
        $this->domesticRate = new DomesticRate;
    }
    public function index()
    {
        $data = [];
        $data['title'] = "View Domestic Rate";
        $data['rate'] = $this->domesticRate->domesticRateGroup();
        return view('admin.domestic_rate.view_front_rate',$data);
    }
    public function view_details_rate($id)
    {
        $data = [];
        $data['title'] = "View Domestic Rate";
        $where= ['tbl_domestic_rate.group_id'=> $id];
        $data['rate'] = $this->domesticRate->domesticRatedetails($where);
        return view('admin.domestic_rate.view_details_rate',$data);
    }
    public function add_rate()
    {
        $data = [];
        $data['title'] = "Add Domestic Rate";
        $data['zone'] = DB::table('tbl_region_group')->where(['mfd'=>0,'status'=>0])->get();
        $data['rate_group'] = DB::table('tbl_rate_group')->where(['mfd'=>0])->get();
        $data['mode'] = DB::table('tbl_transfer_mode')->where(['mfd'=>0,'status'=>0])->get();
        $data['curier'] = DB::table('tbl_courier_company')->where(['mfd'=>0,'status'=>0])->get();
        return view('admin.domestic_rate.add_rate',$data);
    }

    public function store_rate(Request $request)
    {
        // dd($request->all());
        $validation = validator::make($request->all(),
        [
              'rate_group_id'=>'required|numeric',
              'mode_id'=>'required|numeric',
              'company_id'=>'required|numeric',
              'from_zone_id'=>'required|numeric',
              'to_zone_id'=>'required|numeric',
              'tat'=>'numeric',
              'minimum_rate'=>'required|numeric',
              'minimum_weight'=>'required|numeric',
              'applicable_from'=>'required',
              'applicable_to'=>'required',
              'weight_range_from.*'=>'required',
              'weight_range_to.*'=>'required',
              'rate.*'=>'required',
              'fixed_perkg.*'=>'required',
        ]);

        if($validation->passes())
        {
            try{
                 DB::beginTransaction();
                 for ($i = 0; $i < count($request->weight_range_from); $i++) {
                    $data = [
                        'group_id' => $request->rate_group_id,
                        'courier' => $request->company_id,
                        'mode_id' => $request->mode_id,
                        'from_zone' => $request->from_zone_id,
                        'to_zone' => $request->to_zone_id,
                        'tat' => $request->tat,
                        'minimum_rate' => $request->minimum_rate,
                        'minimum_weight' => $request->minimum_weight,
                        'applicable_from' => $request->applicable_from,
                        'applicable_to' => $request->applicable_to,
                        'from_weight' => $request->weight_range_from[$i],
                        'to_weight' => $request->weight_range_to[$i],
                        'rate' => $request->rate[$i],
                        'fixed_perkg' => $request->fixed_perkg[$i],
                        'created_at'=> Carbon::now()->format('Y-m-d H:i:s')
                    ];
            
                    $branch =  DomesticRate::create($data);
                }
              
                if ($branch) {
                    DB::commit();
                    $msg =  session()->flash('success', 'Rate  Save successfully');
                    $responce = [
                        'status'=>'success',
                        'error' => 'Rate  Save successfully'
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
            $responce = [
                'status' => 'false',
                'error' => $validation->errors()
            ];
           echo json_encode($responce);
        }
    }
}
