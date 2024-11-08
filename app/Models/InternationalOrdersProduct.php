<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InternationalOrdersProduct extends Model
{
    use HasFactory;
    protected $table = 'tbl_international_product';
    public $timestamps = false;
    protected $fillable = ['id', 'booking_id', 'productName', 'unitPrice', 'quantity', 'productdescription' ,'productCategory', 'order_hsn_code', 'order_sku', 'order_tax_rate', 'order_product_discount', 'mfd', 'created_at','updated_at'];
}
