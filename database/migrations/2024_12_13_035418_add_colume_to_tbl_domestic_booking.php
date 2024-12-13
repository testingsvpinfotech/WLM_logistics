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
        Schema::table('tbl_domestic_booking', function (Blueprint $table) {
            $table->string('ClusterCode')->nullable()->after('lable_img');
            $table->string('DestinationArea')->nullable()->after('lable_img');
            $table->string('DestinationLocation')->nullable()->after('lable_img');
            $table->string('TokenNumber')->nullable()->after('lable_img');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('tbl_domestic_booking', function (Blueprint $table) {
            //
        });
    }
};
