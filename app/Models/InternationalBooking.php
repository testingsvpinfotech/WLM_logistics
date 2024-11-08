<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;

class InternationalBooking extends Model
{
    use HasFactory;
    protected $table = 'tbl_international_booking';
    public $timestamps = false;
    protected $fillable = [
        'id', 'order_id', 'order_channel', 'order_tag', 'channel_invoice','pickup_address' ,'channel_invoice_date',
        'payment_transaction_id', 'transaction_url', 'signature_type', '3C_applicable', 'meis_applicable',
        'payment_status', 'inco_terms', 'tax_id', 'payment_mode', 'buy_full_name', 'buy_mobile', 'buy_email',
        'buy_alter_mobile', 'buy_company_name', 'buy_gst_in', 'buy_delivery_addressline1', 'buy_delivery_addressline2',
        'buy_delivery_country_id', 'buy_delivery_currency_id', 'buy_delivery_pincode', 'buy_delivery_state',
        'buy_delivery_city', 'ship_to_fba', 'shipment_purpose', 'billing_status', 'delivery_country_id',
        'buy_full_billing_name', 'buy_billing_mobile', 'buy_billing_email', 'buy_delivery_billing_addressline1',
        'buy_delivery_billing_addressline2', 'buy_delivery_billing_pincode', 'buy_delivery_billing_state',
        'buy_delivery_billing_city', 'order_shipping_charges', 'order_gift_wrap', 'order_transaction_fee',
        'order_discounts', 'product_sub_total', 'product_other_charges', 'product_discount', 'order_total',
        'dead_weight', 'length', 'breath', 'height', 'volumetric_weight', 'applicable_weight', 'order_date',
        'created_id', 'created_by', 'mfd', 'created_at', 'updated_at'
    ];


    public function get_international_orders($where = "", $limit = 50, $page = 1)
    {
        $query = DB::table('tbl_international_booking as b')
            ->join('tbl_international_product as p', 'p.booking_id', '=', 'b.id')
            ->select('b.*')
            ->where('b.mfd', '=', 0);
    
        // You might want to use the page directly for pagination
        $result = $query->paginate($limit, ['*'], 'page', $page);
        // dd($query->toSql(), $query->getBindings());
        return $result;
    }
    
}
