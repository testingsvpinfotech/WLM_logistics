<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class ZoneGroup extends Model
{
    use HasFactory;
    protected $table = 'tbl_region_group';
    public $timestamps = false;
    protected $fillable = ['id', 'zone_name','courier_id','description', 'status', 'mfd','created_at','updated_at'];

    public function getzoneData($where = "")
    {
        $query = DB::table('tbl_region_master as m')
        ->join('tbl_region_group as g', 'g.id', '=', 'm.zone_id')
        ->join('tbl_state as s', 's.id', '=', 'm.state_id')
        ->join('tbl_city as c', 'c.id', '=', 'm.city_id')
        ->select( 'g.zone_name as zoneName', 's.name as state_name', 'c.name as city_name') // Specify columns needed
        ->where($where);

        return $result = $query->get();
    }
}
