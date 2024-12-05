<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InternationalZone extends Model
{
    use HasFactory;
    protected $table = 'tbl_international_zone_master';
    public $timestamps = false;
    protected $fillable = ['id','courier_id','type','country_id','zone','from_date','mfd','created_at','updated_at'];
}
