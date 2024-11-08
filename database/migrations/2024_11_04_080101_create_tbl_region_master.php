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
        Schema::create('tbl_region_master', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('zone_id')->index();
            $table->unsignedInteger('state_id')->index();
            $table->unsignedInteger('city_id')->index();
        
            // $table->foreign('zone_id')->references('id')->on('tbl_region_group')
            // ->onDelete('RESTRICT');
            // $table->foreign('state_id')->references('id')->on('tbl_state')->onUpdate('cascade');
            // $table->foreign('city_id')->references('id')->on('tbl_city')->onUpdate('cascade');
        
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
        Schema::dropIfExists('tbl_region_master');
    }
};
