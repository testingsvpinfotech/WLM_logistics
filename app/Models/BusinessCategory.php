<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BusinessCategory extends Model
{
    use HasFactory;
    protected $table = 'tbl_customer_business_category';
    public $timestamps = false;
    protected $fillable = ['id','category_id','category_name','description','image', 'status','mfd', 'created_at', 'updated_at'];
}
