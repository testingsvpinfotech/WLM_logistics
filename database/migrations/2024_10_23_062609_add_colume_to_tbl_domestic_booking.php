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
         $table->string('created_by')->nullable()->after('orderDate');
         $table->integer('created_id')->nullable()->after('orderDate');
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
