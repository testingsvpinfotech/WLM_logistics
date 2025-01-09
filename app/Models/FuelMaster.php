<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FuelMaster extends Model
{
    use HasFactory;
    protected $table = 'tbl_fuel_master';
    public $timestamps = false;
    protected $fillable = ['id', 'group_id', 'courier', 'fuel_price', 'docket_charges','handaling_per_kg',
'min_handaling_charges',
'oda_per_kg',
'min_oda_charges',
'rov_percentage',
'min_rov_charges',
'pickup_percentage',
'min_pickup_charges', 'mfd', 'created_at','updated_at'];
}
