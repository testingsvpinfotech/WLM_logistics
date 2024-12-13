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
        Schema::table('tbl_domestic_products', function (Blueprint $table) {
            // $table->index('booking_id');
            // $table->index('productName');
            // $table->index('width');
            // $table->index('height');
            // $table->index('length');
            // $table->index('weight');
            // $table->index('inv_no');
            // $table->index('quantity');
            // $table->index('unitPrice');
            // $table->index('mfd');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('tbl_domestic_products', function (Blueprint $table) {
            //
        });
    }
};
