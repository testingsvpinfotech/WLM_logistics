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
            $table->integer('riskType')->nullable()->after('buy_delivery_billing_landmark');
            $table->text('eway_no')->nullable()->after('buy_delivery_billing_landmark');
            $table->text('invoice_no')->nullable()->after('buy_delivery_billing_landmark');
            $table->decimal('invoice_value',10,2)->nullable()->after('buy_delivery_billing_landmark');
            $table->decimal('insuranse_chargeses',10,2)->nullable()->after('buy_delivery_billing_landmark');
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
