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
        Schema::table('tbl_fuel_master', function (Blueprint $table) {
            $table->date('date')->nullable()->after('docket_charges');
            $table->decimal('min_pickup_charges',10,2)->after('docket_charges');
            $table->decimal('pickup_percentage',10,2)->after('docket_charges');
            $table->decimal('min_rov_charges',10,2)->after('docket_charges');
            $table->decimal('rov_percentage',10,2)->after('docket_charges');
            $table->decimal('min_oda_charges',10,2)->after('docket_charges');
            $table->decimal('oda_per_kg',10,2)->after('docket_charges');
            $table->decimal('min_handaling_charges',10,2)->after('docket_charges');
            $table->decimal('handaling_per_kg',10,2)->after('docket_charges');
            $table->dropColumn('fov');
            $table->dropColumn('applicable_from');
            $table->dropColumn('applicable_to');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('tbl_fuel_master', function (Blueprint $table) {
            //
        });
    }
};
