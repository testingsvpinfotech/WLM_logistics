<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
class DomesticRate extends Model
{
    use HasFactory; 
    protected $table = 'tbl_domestic_rate';
    public $timestamps = false;
    protected $fillable = ['id', 'group_id','courier','mode_id', 'from_zone', 'to_zone', 'tat', 'applicable_from', 'applicable_to', 'minimum_rate', 'minimum_weight', 'from_weight', 'to_weight', 'rate', 'fixed_perkg', 'mfd', 'created_at','updated_at'];

    public function domesticRateGroup()
    {
        return DB::table('tbl_domestic_rate')
        ->join('tbl_rate_group', 'tbl_domestic_rate.group_id', '=', 'tbl_rate_group.id')
        ->where('tbl_domestic_rate.mfd', 0)
        ->groupBy('tbl_domestic_rate.group_id', 'tbl_rate_group.name')  // Example: group by both group_id and group name
        ->select('tbl_domestic_rate.group_id', 'tbl_rate_group.name', DB::raw('COUNT(tbl_domestic_rate.id) as total'))
        ->get();
    }
    public function domesticRatedetails($where)
    {
        return DB::table('tbl_domestic_rate')
        ->join('tbl_rate_group', 'tbl_domestic_rate.group_id', '=', 'tbl_rate_group.id')
        ->join('tbl_transfer_mode', 'tbl_domestic_rate.mode_id', '=', 'tbl_transfer_mode.id')
        ->join('tbl_courier_company', 'tbl_domestic_rate.courier', '=', 'tbl_courier_company.id')
        ->join('tbl_region_group as from_zone', 'tbl_domestic_rate.from_zone', '=', 'from_zone.id')
        ->join('tbl_region_group as to_zone', 'tbl_domestic_rate.to_zone', '=', 'to_zone.id')
        ->where('tbl_domestic_rate.mfd', 0)
        ->where($where)
        ->select(
            'tbl_domestic_rate.*', 'tbl_transfer_mode.mode_name','tbl_rate_group.name as group_name',
            'tbl_courier_company.company_name', 
            'from_zone.zone_name as from_zone', 
            'to_zone.zone_name as to_zone')
            ->orderBy('tbl_domestic_rate.id', 'desc')  
        ->get();
    
    }

    public function RateCalulate($mode,$courier,$group_id,$fromZone,$toZone,$applicableWeight,$booking_date)
    {

        return DB::table('tbl_domestic_rate')
        ->where(['group_id'=>$group_id,'mode_id'=>$mode,'from_zone'=>$fromZone,'to_zone'=>$toZone,'courier'=>$courier,'mfd'=>0])
        ->where('applicable_from', '<=', $booking_date)    
        ->where('applicable_to', '>=', $booking_date)     
        ->where('from_weight', '<=', $applicableWeight)  
        ->where('to_weight', '>=', $applicableWeight)
        ->orderBy('tbl_domestic_rate.id', 'desc')  
        ->first();
    }
    public function CustomerRate($group_id,$fromZone,$toZone,$applicableWeight,$booking_date)
    {

        return DB::table('tbl_domestic_rate')
        ->where(['group_id'=>$group_id,'from_zone'=>$fromZone,'to_zone'=>$toZone,'mfd'=>0])
        ->where('applicable_from', '<=', $booking_date)    
        ->where('applicable_to', '>=', $booking_date)     
        ->orderBy('id', 'desc')  
        ->get();
    }
    public function RateCalulateFixed($courier,$group_id,$fromZone,$toZone,$applicableWeight,$booking_date)
    {
        return DB::table('tbl_domestic_rate')
        ->where(['group_id'=>$group_id,'from_zone'=>$fromZone,'to_zone'=>$toZone,'courier'=>$courier,'mfd'=>0])
        ->where('applicable_from', '<=', $booking_date)    
        ->where('applicable_to', '>=', $booking_date)     
        ->orderBy('tbl_domestic_rate.id', 'asc')  
        ->first();
    }
}
