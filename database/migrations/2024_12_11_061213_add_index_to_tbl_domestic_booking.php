<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('tbl_domestic_booking', function (Blueprint $table) {
            $table->index(columns: 'id');
            $table->index(columns: 'order_id');
            $table->index(columns: 'forwording_no');
            $table->index(columns: 'paymentMode');
            $table->index(columns: 'mfd');
            $table->index(columns: 'orderDate');
            $table->index(columns: 'created_id');
            $table->index(columns: 'created_by');
            $table->index(columns: 'applicable_weight');
            $table->index(columns: 'voluematrix_weight');
            $table->index(columns: 'pickup_address');
            $table->index(columns: 'billing_status');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('tbl_domestic_booking', function (Blueprint $table) {
        
        });
    }
};
