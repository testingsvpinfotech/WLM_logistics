<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InternationalTracking extends Model
{
    use HasFactory;
    protected $table = 'tbl_domestic_rate';
    public $timestamps = false;
    protected $fillable = ['id', 'order_id', 'lr_no', 'location', 'status', 'comment', 'remark', 'dateTime', 'created_at','updated_at'];

}
