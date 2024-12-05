<?php

namespace App\Http\Controllers\admin\International;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Session; // Add this line
use App\Models\InternationalZone;

class InternationalZoneMaster extends Controller
{
    public function __construct()
    {

    }

    public function index() 
    {
        $data = [];
        $data["title"] = 'View International Zone';
        $data['zoneMaster'] = DB::table('tbl_international_zone_master')
                    ->join('tbl_courier_company', 'tbl_international_zone_master.courier_id', '=', 'tbl_courier_company.id')
                    ->select(
                        'tbl_international_zone_master.courier_id',
                                'tbl_international_zone_master.type',
                        DB::raw('MAX(tbl_international_zone_master.mfd) as mfd'),
                        DB::raw('MAX(tbl_international_zone_master.type) as type'),
                        DB::raw('MAX(tbl_courier_company.company_name) as company_name'),
                        DB::raw('MAX(tbl_international_zone_master.from_date) as date')
                    )
                    ->where(['tbl_international_zone_master.mfd'=>0])
                    ->groupBy('tbl_international_zone_master.courier_id','tbl_international_zone_master.type')
                    ->get();
        return view('admin.international_zone.view_zone_master', $data);
    }

    public function getZoneData($id,$type)
    {
        $data = [];
        $data["title"] = 'View Details Zone';
        $data['zonedetails'] = DB::table('tbl_international_zone_master')
                    ->join('tbl_courier_company', 'tbl_international_zone_master.courier_id', '=', 'tbl_courier_company.id')
                    ->join('tbl_country', 'tbl_international_zone_master.country_id', '=', 'tbl_country.id')
                
                    ->where(['tbl_international_zone_master.mfd'=>0,'tbl_international_zone_master.courier_id'=>$id,'tbl_international_zone_master.type'=>$type])
                    ->get();
        return view('admin.international_zone.view_zone_details_master', $data);
    }
    public function add_zone() 
    {
       $data = [];
       $data["title"] = 'Add International Zone';
       $data['courier_company'] =  DB::table('tbl_courier_company')->where(['mfd'=>0,'company_type'=>2,'status'=>0])->get();;
       return view('admin.international_zone.add_zone', $data);
    }

    public function export_zone_file()
    {
        $filePath = public_path('admin-assets/International_zone/sample_file_zone.csv');
        return response()->download($filePath);
    }

    public function store_zone(Request $request)    
    {
        $validation = Validator::make($request->all(), [
            'from_date' => 'required',
            'courier_company' => 'required|numeric',
            'internationalType' => 'required|numeric',
            'csv_file' => 'required|file',
        ]);
        if($validation->fails())
        {
            $responce = [
                'status'=>'false',
                'data' => $validation->errors()
            ];
            echo json_encode($responce);exit;
        }else{
            try {
                DB::beginTransaction();
                $c_courier_id 	= $request->courier_company;	
                $zone_type 		= $request->internationalType;	
                $date 		= $request->from_date;	
                $file 			= fopen($_FILES['csv_file']['tmp_name'],"r");
                $cnt = 1;
                while(!feof($file))
                {
                    $data	= fgetcsv($file);	
                    if($cnt ==1)
                    {
                        $cnt++;
                        continue;
                    }
                    
                    if(!empty($data))
                    {
                        $country = DB::table('tbl_country')->where(['country_name'=>$data[0]])->first();
                        if(!empty($country) && !empty($data[1]))   
                        {
                            $memData = array(
                                'courier_id' => $c_courier_id,
                                'country_id' => $country->id,  
                                'zone' => $data[1],  
                                'type'=>$zone_type,
                                'from_date'=>$date,
                                'created_at'=>date('Y-m-d h:s:i'),
                            );          
                            $exist = DB::table('tbl_international_zone_master')->where(['courier_id' => $c_courier_id,
                                'country_id' => $country->id,  
                                'zone' => $data[1],  
                                'type'=>$zone_type,])->first();      
                            if(empty($exist)){
                                $user = InternationalZone::create($memData);
                            } 
                        } 
                        
                    }		
                    $cnt++;
        
                }
                DB::commit();
                $msg =  session()->flash('success', 'Internation Zone successfully');
                $responce = [
                    'status'=>'success',
                    'error' => 'Internation Zone successfully'
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

    public function status(Request $request)
    {
        // dd($request->all());
        try {
            DB::beginTransaction();
            InternationalZone::where(['courier_id'=>$request->id,'type'=>$request->type])
            ->update(['mfd' => $request->data]);
            DB::commit();
            session()->flash('success', 'International Rate Deleted successfully');
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
