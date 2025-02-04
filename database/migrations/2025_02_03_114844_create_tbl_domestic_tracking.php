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
        Schema::create('tbl_domestic_tracking', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('order_no')->index();
            $table->string('airway_no')->index();
            $table->string('status')->index();
            $table->string('location');
            $table->dateTime('datetime');
            $table->integer('courier_id')->nullable()->index();
            $table->boolean('is_delivered')->default(false);
            $table->boolean('is_pod')->default(false);
            $table->date('mfd')->index();

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
        Schema::dropIfExists('tbl_domestic_tracking');
    }
};
