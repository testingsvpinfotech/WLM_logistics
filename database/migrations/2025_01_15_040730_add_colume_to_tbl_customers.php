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
        Schema::table('tbl_customers', function (Blueprint $table) {
            $table->string('gst_copy')->nullable()->after('demo_schedule');
            $table->string('gst_no')->nullable()->after('demo_schedule');
            $table->string('pan_card_copy')->nullable()->after('demo_schedule');
            $table->integer('pan_no')->nullable()->after('demo_schedule');
            $table->string('pan_card_name')->nullable()->after('demo_schedule');

            $table->string('verified')->default(0)->after('status')->index();
            $table->dateTime('verified_at')->nullable()->after('status');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('tbl_customers', function (Blueprint $table) {
            //
        });
    }
};
