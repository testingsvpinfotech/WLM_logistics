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
        Schema::create('tbl_fuel_master', function (Blueprint $table) {
            $table->id();
            $table->integer('group_id');
            $table->integer('courier');
            $table->decimal('fuel_price',10,2);
            $table->decimal('docket_charges',10,2);
            $table->decimal('fov',10,2);
            $table->date('applicable_from');
            $table->date('applicable_to');
            $table->integer('mfd')->default(0);
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
        Schema::dropIfExists('tbl_fuel_master');
    }
};
