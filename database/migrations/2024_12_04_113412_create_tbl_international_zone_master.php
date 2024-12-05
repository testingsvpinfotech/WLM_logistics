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
        Schema::create('tbl_international_zone_master', function (Blueprint $table) {
            $table->id();
             $table->integer('courier_id');
             $table->integer('type');
             $table->integer('country_id');
             $table->integer('zone');
             $table->date('from_date');
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
        Schema::dropIfExists('tbl_international_zone_master');
    }
};
