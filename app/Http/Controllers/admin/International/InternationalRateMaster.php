<?php

namespace App\Http\Controllers\Admin\International;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Session; // Add this line
use App\Models\InternationalRate;

class InternationalRateMaster extends Controller
{
    public function index() 
    {
       $data = [];
       $data["title"] = 'View International Rate';
       $data['rateMaster'] = DB::table('tbl_international_rate')
                            ->join('tbl_courier_company', 'tbl_international_rate.courier_company', '=', 'tbl_courier_company.id')
                            ->join('tbl_international_rate_group', 'tbl_international_rate.rate_group_id', '=', 'tbl_international_rate_group.id')
                            ->select(
                                'tbl_international_rate.courier_company',
                                        'tbl_international_rate.type_export_import',
                                DB::raw('MAX(tbl_international_rate.mfd) as mfd'),
                                DB::raw('MAX(tbl_international_rate.type_export_import) as type'),
                                DB::raw('MAX(tbl_courier_company.company_name) as company_name'),
                                DB::raw('MAX(tbl_international_rate_group.id) as id'),
                                DB::raw('MAX(tbl_international_rate_group.name) as name'),
                                DB::raw('MAX(tbl_international_rate.from_date) as date')
                            )
                            ->where(['tbl_international_rate.mfd'=>0])
                            ->groupBy('tbl_international_rate.courier_company','tbl_international_rate.type_export_import')
                            ->orderBy('tbl_international_rate.id','desc')
                            ->get();
       return view('admin.InternationalRateMaster.view_rate_master', $data);   
    }

    public function getRateData($courier_company,$type,$Rategroup,$date)
    {
        $data = [];
        $data["title"] = 'View Details Rate';
        $data['ratedetails'] = DB::table('tbl_international_rate')
                    ->where([
                        ['mfd', '=', 0],
                        ['courier_company', '=', $courier_company],
                        ['type_export_import', '=', $type],
                        ['rate_group_id', '=', $Rategroup],
                        ['from_date', '=', $date]
                    ])
                    ->select('from_weight','doc_type', DB::raw('MIN(id) as id'),DB::raw('MIN(type_export_import) as type_export_import'),DB::raw('MIN(to_weight) as to_weight'),DB::raw('MIN(fixed_perkg) as fixed_perkg'),DB::raw('MIN(rate) as rate'),DB::raw('MIN(courier_company) as courier_company'),DB::raw('MIN(rate_group_id) as rate_group_id'),DB::raw('MIN(from_date) as from_date')) 
                    ->groupBy('from_weight','doc_type')
                    ->orderBy('id','desc')
                    ->get();
        $data['header'] = DB::table('tbl_international_rate')
                    ->where([
                        ['mfd', '=', 0],
                        ['courier_company', '=', $courier_company],
                        ['type_export_import', '=', $type],
                        ['rate_group_id', '=', $Rategroup],
                        ['from_date', '=', $date]
                    ])
                    ->select('zone_id', DB::raw('MIN(id) as id')) 
                    ->groupBy('zone_id')
                    ->get();
        return view('admin.InternationalRateMaster.view_rate_details_master', $data);
    }
    public function export_zone_file()
    {
        $filePath = public_path('admin-assets/International_rate/sample_rate.csv');
        return response()->download($filePath);
    }
    public function add_rate()
    {
        $data = [];
       $data["title"] = 'Add International Rate';
       $data['rate_group'] =  DB::table('tbl_international_rate_group')->where(['mfd'=>0])->get();;
       $data['courier_company'] =  DB::table('tbl_courier_company')->where(['mfd'=>0,'company_type'=>2,'status'=>0])->get();;
       return view('admin.InternationalRateMaster.add_rate', $data);   
    }

    public function store_rate(Request $request)
    {
        $validation = Validator::make($request->all(), [
            'from_date' => 'required',
            'rate_group' => 'required|numeric',
            'courier_company' => 'required|numeric',
            'internationalType' => 'required|numeric',
            'shipment_type' => 'required|numeric',
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
                $shipmentType 		= $request->shipment_type;	
                $Rategroup 		= $request->rate_group;	
                $date 		= $request->from_date;	
                $file 			= fopen($_FILES['csv_file']['tmp_name'],"r");
                $heading_array = array();
                $cnt = 0;
                $weight 		= 0;
                while(! feof($file))
                {
                    $data	= fgetcsv($file);
                    if($cnt == 0)
                    {
                        $heading_array = $data;
                    }
                    else
                    {
                        if(!empty($data))
                        {				
                        for($i= 0;$i<count($data);$i++)
                        {						
                            
                            if($i == 0)
                            {
                                $fixed_perkg= $data[0];
                            }
                            else if($i == 1)
                            {
                                $weight_from	= $data[1];
                            }
                            else if($i == 2)
                            {
                                $weight_to		= $data[2];
                            }
                            else
                            {
                                if(!empty($data[$i]) && !empty($weight_to))
                                {
                                    $memData = array(
                                        'from_date'=>$date,                                               
                                        'rate_group_id'=>$Rategroup,
                                        'courier_company'=>$c_courier_id,
                                        'doc_type'=>$shipmentType,
                                        'type_export_import'=> $zone_type,
                                        'zone_id'=>$heading_array[$i],
                                        'from_weight'=>$weight_from,
                                        'to_weight'=>$weight_to,
                                        'rate'=>$data[$i],
                                        'fixed_perkg'=>$fixed_perkg,
                                        'created_at'=>date('Y-m-d h:s:i'),
                                    );          
                                    $exist = DB::table('tbl_international_rate')->where([ 'rate_group_id'=>$Rategroup,
                                    'mfd'=>0,
                                    'from_date'=>$date,   
                                    'courier_company'=>$c_courier_id,
                                    'doc_type'=>$shipmentType,
                                    'type_export_import'=> $zone_type,
                                    'zone_id'=>$heading_array[$i],
                                    'from_weight'=>$weight_from,
                                    'to_weight'=>$weight_to,
                                    'rate'=>$data[$i],
                                    'fixed_perkg'=>$fixed_perkg])->first();      
                                    if(empty($exist)){
                                        $user = InternationalRate::create($memData);
                                    } 
                                }
                            }
                        }
                    }
                    }
                    $cnt++;
                }
                DB::commit();
                $msg =  session()->flash('success', 'International Rate successfully');
                $responce = [
                    'status'=>'success',
                    'error' => 'International Rate successfully'
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

    public function Ratedelete(Request $request)
    {
        try {
            DB::beginTransaction();
            $Rowdata = InternationalRate::find($request->id);
            InternationalRate::where(['rate_group_id'=>$Rowdata->rate_group_id,'courier_company'=>$Rowdata->courier_company,'type_export_import'=>$Rowdata->type_export_import,'from_date'=>$Rowdata->from_date])
            ->update(['mfd' => 1]);
            DB::commit();
            session()->flash('success', 'International Rate Deleted successfully');
            $responce = [
                'status' => 'success',
                'success' => 'International Rate Deleted successfully'
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
