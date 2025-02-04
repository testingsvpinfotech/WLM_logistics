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
    protected $fillable = ['booking_id', 'order_no', 'airway_no', 'pickup_date', 'courier_id', 'lable_image', 'token_no', 'originarea', 'destinationarea', 'order_channels', 'payment_mode', 'pickup_location_wearhouse', 'sender_name', 'sender_contact_no', 'sender_pincode', 'sender_address', 'sender_gstno', 'receiver_name', 'receiver_company_name', 'receiver_contact_no', 'receiver_gstno', 'receiver_address', 'receiver_pincode', 'frieht', 'transportation_charges', 'pickup_charges', 'delivery_charges', 'courier_charges', 'green_tax', 'awb_charges', 'fov_charges', 'appt_charges', 'ess_ch', 'caf_ch', 'idc_ch', 'vahc_ch', 'edl_ch', 'dc_ch', 'owh_ch', 'pay_type', 'total_amount', 'fuel_subcharges', 'insurance_charges', 'sub_total', 'cgst', 'sgst', 'igst', 'grand_total', 'booking_date', 'booking_time', 'branch_id', 'customer_id', 'mfd', 'is_cancel', 'created_at','updated_at'];

    // public function get_domestic_orders($where = "", $limit = 50, $page = 1)
    // {
    //     $query = DB::table('tbl_domestic_booking as b')
    //         ->join('tbl_domestic_products as p', 'p.booking_id', '=', 'b.id')
    //         ->select('b.*')
    //         ->where('b.mfd', '=', 0)
    //         ->orderBy('b.id', 'desc');

    //     // You might want to use the page directly for pagination
    //     $result = $query->paginate($limit, ['*'], 'page', $page);
    //     // dd($query->toSql(), $query->getBindings());
    //     return $result;
    // }
    // public function get_orders_count($where = "")
    // {
    //     $query = DB::table('tbl_domestic_booking as b')
    //         ->join('tbl_domestic_products as p', 'p.booking_id', '=', 'b.id')
    //         ->select('b.*')
    //         ->where('b.mfd', '=', 0)
    //         ->where($where);
    //     $result = $query->get();
    //     // dd($query->toSql(), $query->getBindings());
    //     return $result;
    // }
    // // customer listing count 
    public function get_listing_count($where = 0,$from_date,$to_date)
    {
        // all orders
        $query_all_orders = DB::table('tbl_domestic_booking as b')
            ->join('tbl_shipment_stock_manager as s', 's.booking_id', '=', 'b.booking_id')
            ->select(DB::raw('COUNT(*) as all_orders'))
            ->whereBetween('b.booking_date', [$from_date, $to_date])
            ->where('b.mfd', '=', 0);
        if ($where != 0) {
            $query_all_orders->where(['b.customer_id' => $where]);
        }
        $all_orders = $query_all_orders->first();
        // Unprocessable
        $query_Unprocessable = DB::table('tbl_domestic_booking as b')
            ->join('tbl_shipment_stock_manager as s', 's.booking_id', '=', 'b.booking_id')
            ->select(DB::raw('COUNT(*) as Unprocessable'))
            ->whereBetween('b.booking_date', [$from_date, $to_date])
            ->where(['b.mfd' => 0, 's.shipment_type' => 1, 's.order_booked' => 1, 's.api_booked' => 0, 's.lable_genration' => 0, 's.pickup' => 0]);
        if ($where != 0) {
            $query_Unprocessable->where(['b.customer_id' => $where]);
        }
        $query_Unprocessable = $query_Unprocessable->first();
        // Processing
        $query_Processing = DB::table('tbl_domestic_booking as b')
            ->join('tbl_shipment_stock_manager as s', 's.booking_id', '=', 'b.booking_id')
            ->select(DB::raw('COUNT(*) as Processing'))
            ->whereBetween('b.booking_date', [$from_date, $to_date])
            ->where(['b.mfd' => 0, 's.shipment_type' => 1, 's.order_booked' => 1, 's.api_booked' => 1, 's.pickup' => 0]);
        if ($where != 0) {
            $query_Processing->where(['b.customer_id' => $where]);
        }
        $query_Processing = $query_Processing->first();
        // Ready to ship
        $query_Ready_to_ship = DB::table('tbl_domestic_booking as b')
            ->join('tbl_shipment_stock_manager as s', 's.booking_id', '=', 'b.booking_id')
            ->select(DB::raw('COUNT(*) as Ready_to_ship'))
            ->whereBetween('b.booking_date', [$from_date, $to_date])
            ->where(['b.mfd' => 0, 's.shipment_type' => 1, 's.order_booked' => 1, 's.api_booked' => 1, 's.lable_genration' => 1, 's.pickup' => 0]);
        if ($where != 0) {
            $query_Ready_to_ship->where(['b.customer_id' => $where]);
        }
        $query_Ready_to_ship = $query_Ready_to_ship->first();
        // Manifest
        $query_Manifest = DB::table('tbl_domestic_booking as b')
            ->join('tbl_shipment_stock_manager as s', 's.booking_id', '=', 'b.booking_id')
            ->select(DB::raw('COUNT(*) as Manifest'))
            ->whereBetween('b.booking_date', [$from_date, $to_date])
            ->where(['b.mfd' => 0, 's.shipment_type' => 1,'s.pickup' => 1]);
        if ($where != 0) {
            $query_Manifest->where(['b.customer_id' => $where]);
        }
        $query_Manifest = $query_Manifest->first();
        // Return Orders
        $query_Return = DB::table('tbl_domestic_booking as b')
            ->join('tbl_shipment_stock_manager as s', 's.booking_id', '=', 'b.booking_id')
            ->select(DB::raw('COUNT(*) as Manifest'))
            ->whereBetween('b.booking_date', [$from_date, $to_date])
            ->where(['b.mfd' => 0, 's.shipment_type' => 1, 's.order_booked' => 1, 's.api_booked' => 1, 's.lable_genration' => 1, 's.pickup' => 1,'s.returns'=>1]);
        if ($where != 0) {
            $query_Return->where(['b.customer_id' => $where]);
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
