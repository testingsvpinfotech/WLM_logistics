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
        Schema::table('tbl_shipment_stock_manager', function (Blueprint $table) {
            $table->integer('mfd')->default(0)->after('return_attempt');
            $table->integer('delivered')->default(0)->after('return_attempt');
            $table->index('mfd');
            $table->index('delivered');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('tbl_shipment_stock_manager', function (Blueprint $table) {
            //
        });
    }
};
