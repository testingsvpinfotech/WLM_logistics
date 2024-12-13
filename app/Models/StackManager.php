<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StackManager extends Model
{
    use HasFactory;
    protected $table = 'tbl_shipment_stock_manager';
    public $timestamps = false;
    protected $fillable = ['id', 'booking_id', 'order_id', 'forwording_no', 'shipment_type', 'order_booked', 'api_booked', 'lable_genration', 'pickup', 'returns', 'return_attempt', 'updated_at', 'delivered', 'mfd','created_at'];
}
