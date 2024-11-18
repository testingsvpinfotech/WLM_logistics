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
        Schema::table('tbl_pickup_address', function (Blueprint $table) {
            $table->string('warehouse_r_name')->nullable()->after('contact_person');
            $table->text('return_address')->nullable()->after('pincode');
            $table->string('return_pincode')->nullable()->after('pincode');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('tbl_pickup_address', function (Blueprint $table) {
            //
        });
    }
};
