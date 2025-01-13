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
    protected $fillable = ['id', 'order_id','insuranse_chargeses','b2b_shipmet','no_of_invoices','no_of_boxes','invoice_value','invoice_no','eway_no','riskType','invoice_status','forwording_no','courier','lable_img','ClusterCode','DestinationArea','DestinationLocation','TokenNumber','pickup_date','order_channel', 'fuel_group_id', 'rate_group_id', 'order_tag', 'pickup_address', 'resellar_name', 'paymentMode', 'buy_full_name', 'buy_mobile', 'buy_email', 'buy_alter_mobile', 'buy_company_name', 'buy_gst_in', 'buy_delivery_address', 'buy_delivery_landmark', 'buy_delivery_pincode', 'billing_status', 'buy_full_billing_name', 'buy_billing_mobile', 'buy_billing_email', 'buy_delivery_billing_address', 'buy_delivery_billing_landmark', 'order_shipping_charges', 'order_gift_wrap', 'order_transaction_fee', 'order_total', 'order_discounts', 'product_sub_total', 'product_other_charges', 'product_discount', 'dead_weight', 'length', 'breath', 'height', 'voluematrix_weight', 'applicable_weight', 'orderDate', 'created_id', 'created_by', 'mfd', 'created_at', 'updated_at'];

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
    // customer listing count 
    public function get_listing_count($where = 0)
    {
        // all orders
        $query_all_orders = DB::table('tbl_domestic_booking as b')
            ->join('tbl_shipment_stock_manager as s', 's.booking_id', '=', 'b.id')
            ->select(DB::raw('COUNT(*) as all_orders'))
            ->where('b.mfd', '=', 0);
        if ($where != 0) {
            $query_all_orders->where(['b.created_id' => $where]);
        }
        $all_orders = $query_all_orders->first();
        // Unprocessable
        $query_Unprocessable = DB::table('tbl_domestic_booking as b')
            ->join('tbl_shipment_stock_manager as s', 's.booking_id', '=', 'b.id')
            ->select(DB::raw('COUNT(*) as Unprocessable'))
            ->where(['b.mfd' => 0, 's.shipment_type' => 1, 's.order_booked' => 1, 's.api_booked' => 0, 's.lable_genration' => 0, 's.pickup' => 0]);
        if ($where != 0) {
            $query_Unprocessable->where(['b.created_id' => $where]);
        }
        $query_Unprocessable = $query_Unprocessable->first();
        // Processing
        $query_Processing = DB::table('tbl_domestic_booking as b')
            ->join('tbl_shipment_stock_manager as s', 's.booking_id', '=', 'b.id')
            ->select(DB::raw('COUNT(*) as Processing'))
            ->where(['b.mfd' => 0, 's.shipment_type' => 1, 's.order_booked' => 1, 's.api_booked' => 1, 's.lable_genration' => 0, 's.pickup' => 0]);
        if ($where != 0) {
            $query_Processing->where(['b.created_id' => $where]);
        }
        $query_Processing = $query_Processing->first();
        // Ready to ship
        $query_Ready_to_ship = DB::table('tbl_domestic_booking as b')
            ->join('tbl_shipment_stock_manager as s', 's.booking_id', '=', 'b.id')
            ->select(DB::raw('COUNT(*) as Ready_to_ship'))
            ->where(['b.mfd' => 0, 's.shipment_type' => 1, 's.order_booked' => 1, 's.api_booked' => 1, 's.lable_genration' => 1, 's.pickup' => 0]);
        if ($where != 0) {
            $query_Ready_to_ship->where(['b.created_id' => $where]);
        }
        $query_Ready_to_ship = $query_Ready_to_ship->first();
        // Manifest
        $query_Manifest = DB::table('tbl_domestic_booking as b')
            ->join('tbl_shipment_stock_manager as s', 's.booking_id', '=', 'b.id')
            ->select(DB::raw('COUNT(*) as Manifest'))
            ->where(['b.mfd' => 0, 's.shipment_type' => 1, 's.order_booked' => 1, 's.api_booked' => 1, 's.lable_genration' => 1, 's.pickup' => 1]);
        if ($where != 0) {
            $query_Manifest->where(['b.created_id' => $where]);
        }
        $query_Manifest = $query_Manifest->first();
        // Return Orders
        $query_Return = DB::table('tbl_domestic_booking as b')
            ->join('tbl_shipment_stock_manager as s', 's.booking_id', '=', 'b.id')
            ->select(DB::raw('COUNT(*) as Manifest'))
            ->where(['b.mfd' => 0, 's.shipment_type' => 1, 's.order_booked' => 1, 's.api_booked' => 1, 's.lable_genration' => 1, 's.pickup' => 1,'s.returns'=>1]);
        if ($where != 0) {
            $query_Return->where(['b.created_id' => $where]);
        }
        $query_Return_orers = $query_Return->first();

        $count = [
            'all_orders' => $all_orders->all_orders,
            'Unprocessable' => $query_Unprocessable->Unprocessable,
            'Processing' => $query_Processing->Processing,
            'Ready_to_ship' => $query_Ready_to_ship->Ready_to_ship,
            'Manifest' => $query_Manifest->Manifest,
            'Return' => $query_Return_orers->Manifest
        ];
        return $count;
    }
}
