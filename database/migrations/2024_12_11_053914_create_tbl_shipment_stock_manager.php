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
        Schema::create('tbl_shipment_stock_manager', function (Blueprint $table) {
            $table->id();
            $table->string('booking_id')->index();
            $table->string('order_id')->index();
            $table->string('forwording_no')->nullable()->index();
            $table->integer('shipment_type')->default(1)->comment('1 => domestic , 2 => international')->index();
            $table->integer('order_booked')->default(0)->index();
            $table->integer('api_booked')->default(0)->index();
            $table->integer('lable_genration')->default(0)->index();
            $table->integer('pickup')->default(0)->index();
            $table->integer('returns')->default(0)->index();
            $table->integer('return_attempt')->default(0)->index();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tbl_shipment_stock_manager');
    }
};
