<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ZoneMaster extends Model
{
    use HasFactory;
    protected $table = 'tbl_region_master';
    public $timestamps = false;
    protected $fillable = ['id', 'zone_id', 'state_id', 'city_id','created_at','updated_at'];

    
}
