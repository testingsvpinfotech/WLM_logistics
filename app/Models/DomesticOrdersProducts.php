<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DomesticOrdersProducts extends Model
{
    use HasFactory;
    protected $table = 'tbl_domestic_products';
    public $timestamps = false;
    protected $fillable = ['id', 'booking_id', 'productName', 'height','length','width','weight','unitPrice', 'quantity', 'productCategory', 'order_hsn_code', 'order_sku', 'order_tax_rate', 'order_product_discount', 'mfd', 'created_at','updated_at'];
}
