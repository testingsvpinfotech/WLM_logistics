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
        Schema::create('tbl_international_tracking', function (Blueprint $table) {
            $table->id();
            $table->integer('order_id');
            $table->integer('lr_no')->nullable();
            $table->string('location');
            $table->string('status');
            $table->text('comment');
            $table->text('remark');
            $table->dateTime('dateTime');
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
        Schema::dropIfExists('tbl_international_tracking');
    }
};
