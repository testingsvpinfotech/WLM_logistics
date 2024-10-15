<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CityMaster extends Model
{
    use HasFactory;
    protected $table = 'tbl_city';
    public $timestamps = false;
    protected $fillable = ['id', 'name', 'state','mfd' ,'created_at', 'updated_at'];
}
