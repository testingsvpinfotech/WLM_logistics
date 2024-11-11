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
    protected $fillable = ['id', 'pincode','state_id','city_id', 'mfd' ,'created_at', 'updated_at'];

    public function pincodedata($pincode)
    {
        $query = DB::table('tbl_pincode')
                    ->join('tbl_state', 'tbl_state.id', '=', 'tbl_pincode.state_id')
                    ->join('tbl_city', 'tbl_city.id', '=', 'tbl_pincode.city_id')
                    ->select('tbl_pincode.*','tbl_state.name as state','tbl_city.name as city')
                    ->where($pincode);

        return $query->first();
    }
}
