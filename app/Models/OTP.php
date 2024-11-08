<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OTP extends Model
{
    use HasFactory;
    protected $table = 'tbl_mobile_no_otps';
    public $timestamps = false;
    protected $fillable = ['id', 'customer_id','otp','expires_at' ,'created_at', 'updated_at'];
}
