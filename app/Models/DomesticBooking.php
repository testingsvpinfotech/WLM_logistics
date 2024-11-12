<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;

class DomesticBooking extends Model
{
    use HasFactory;
    protected $table = 'tbl_domestic_booking';
    public $timestamps = false;
    protected $fillable = ['id', 'order_id', 'order_channel', 'fuel_group_id','rate_group_id','order_tag','pickup_address', 'resellar_name', 'paymentMode', 'buy_full_name', 'buy_mobile', 'buy_email', 'buy_alter_mobile', 'buy_company_name', 'buy_gst_in', 'buy_delivery_address', 'buy_delivery_landmark', 'buy_delivery_pincode', 'billing_status', 'buy_full_billing_name', 'buy_billing_mobile', 'buy_billing_email', 'buy_delivery_billing_address', 'buy_delivery_billing_landmark', 'order_shipping_charges', 'order_gift_wrap', 'order_transaction_fee', 'order_total' ,'order_discounts', 'product_sub_total', 'product_other_charges', 'product_discount','dead_weight','length','breath', 'height' ,'voluematrix_weight', 'applicable_weight', 'orderDate','created_id','created_by', 'mfd', 'created_at','updated_at'];

    public function get_domestic_orders($where = "", $limit = 50, $page = 1)
    {
        $query = DB::table('tbl_domestic_booking as b')
            ->join('tbl_domestic_products as p', 'p.booking_id', '=', 'b.id')
            ->select('b.*')
            ->where('b.mfd', '=', 0)
            ->orderBy('b.id', 'desc');
    
        // You might want to use the page directly for pagination
        $result = $query->paginate($limit, ['*'], 'page', $page);
        // dd($query->toSql(), $query->getBindings());
        return $result;
    }
    public function get_orders_count($where = "")
    {
        $query = DB::table('tbl_domestic_booking as b')
            ->join('tbl_domestic_products as p', 'p.booking_id', '=', 'b.id')
            ->select('b.*')
            ->where('b.mfd', '=', 0)
            ->where($where);
        $result = $query->get();
        // dd($query->toSql(), $query->getBindings());
        return $result;
    }
}
