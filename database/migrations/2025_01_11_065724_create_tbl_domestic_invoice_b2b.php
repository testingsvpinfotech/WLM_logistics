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
        Schema::create('tbl_domestic_invoice_b2b', function (Blueprint $table) {
            $table->id();
            $table->integer('booking_id');
            $table->string('invoice_no');
            $table->date('invoice_date');
            $table->decimal('invoice_amount',10,2);
            $table->string('eway_no');
            $table->date('eway_date');
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
        Schema::dropIfExists('tbl_domestic_invoice_b2b');
    }
};
