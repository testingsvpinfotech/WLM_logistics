<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FuelMaster extends Model
{
    use HasFactory;
    protected $table = 'tbl_fuel_master';
    public $timestamps = false;
    protected $fillable = ['id', 'group_id', 'courier', 'fuel_price', 'docket_charges', 'fov', 'applicable_from', 'applicable_to', 'mfd', 'created_at','updated_at'];
}
