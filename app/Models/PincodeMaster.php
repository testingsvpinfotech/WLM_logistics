<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class PincodeMaster extends Model
{
    use HasFactory;
    protected $table = 'tbl_pincode';
    public $timestamps = false;
    protected $fillable = ['id', 'pincode', 'state_id', 'city_id', 'mfd', 'created_at', 'updated_at'];

    public function pincodedata($pincode)
    {
        $query = DB::table('tbl_pincode')
            ->join('tbl_state', 'tbl_state.id', '=', 'tbl_pincode.state_id')
            ->join('tbl_city', 'tbl_city.id', '=', 'tbl_pincode.city_id')
            ->select('tbl_pincode.*', 'tbl_state.name as state', 'tbl_city.name as city')
            ->where($pincode);

        return $query->first();
    }
    public function pincodeZone($pincode,$courier)
    {
        $query = DB::table('tbl_pincode')
            ->join('tbl_region_master', function ($join) {
                $join->on('tbl_region_master.city_id', '=', 'tbl_pincode.city_id')
                    ->on('tbl_region_master.state_id', '=', 'tbl_pincode.state_id');
            })
            ->join('tbl_region_group', 'tbl_region_master.zone_id', '=', 'tbl_region_group.id')
            ->select('tbl_region_group.id')
            ->where(['tbl_pincode.pincode' => $pincode,'tbl_region_group.courier_id'=>$courier])
            ->where('tbl_region_group.mfd', 0);
        return $query->first();
    }
    public function pincodecourierwise($pintable,$pincode,$zone,$service)
    {
        $query = DB::table($pintable)->where(['pincode'=>$pincode,'zone_id'=>$zone,'service'=>$service,'mfd'=>0]);
        return $query->first();
    }
}
