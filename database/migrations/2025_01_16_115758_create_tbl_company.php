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
        Schema::create('tbl_company', function (Blueprint $table) {
            $table->id();
            $table->string('company_logo');
            $table->string('company_name');
            $table->string('email');
            $table->string('contact_no');
            $table->string('cin');
            $table->string('pan_no');
            $table->string('gst_no');
            $table->string('tan');
            $table->text('address');
            $table->text('head_office_address');
            $table->string('pincode');
            $table->string('bank_name');
            $table->string('branch_name');
            $table->string('account_holder_name');
            $table->string('account_no');
            $table->string('ifsc_code');
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
        Schema::dropIfExists('tbl_company');
    }
};
