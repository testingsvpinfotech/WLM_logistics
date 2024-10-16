<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FuelGroup extends Model
{
    use HasFactory;
    protected $table = 'tbl_fuel_group';
    public $timestamps = false;
    protected $fillable = ['id','name', 'description', 'mfd', 'created_at', 'updated_at'];
}
