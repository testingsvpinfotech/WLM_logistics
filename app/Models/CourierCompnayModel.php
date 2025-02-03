<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CourierCompnayModel extends Model
{
    use HasFactory;
    protected $table = 'tbl_courier_company';
    public $timestamps = false;
    protected $fillable = ['id', 'company_name','pincode_table', 'company_type', 'description', 'domestic_url', 'international_url','img_logo', 'status', 'mfd', 'created_at','updated_at	'];
}
