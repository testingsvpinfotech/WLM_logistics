<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InternationalRateGroup extends Model
{
    use HasFactory;
    protected $table = 'tbl_international_rate_group';
    public $timestamps = false;
    protected $fillable = ['id','name', 'description', 'mfd', 'created_at', 'updated_at'];
}
