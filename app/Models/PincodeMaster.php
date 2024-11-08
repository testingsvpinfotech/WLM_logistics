<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PincodeMaster extends Model
{
    use HasFactory;
    protected $table = 'tbl_pincode';
    public $timestamps = false;
    protected $fillable = ['id', 'pincode','state_id','city_id', 'mfd' ,'created_at', 'updated_at'];
}
