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
        Schema::create('tbl_domestic_weight_details', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('booking_id');
            $table->integer('no_of_pack');
            $table->decimal('total_chargable_weight', 10, 2);
            $table->text('no_of_pack_details');
            $table->decimal('length_detail', 10, 2);
            $table->decimal('breath_detail', 10, 2);
            $table->decimal('height_detail', 10, 2);
            $table->decimal('valumetric_chargable_details', 10, 2);
            $table->decimal('actual_weight_details', 10, 2);
            $table->decimal('chargable_weight_details', 10, 2);

            $table->timestamps();

            $table->foreign('booking_id')->references('booking_id')->on('tbl_domestic_booking')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tbl_domestic_weight_details');
    }
};
