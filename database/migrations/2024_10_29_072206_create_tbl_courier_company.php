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
        Schema::create('tbl_courier_company', function (Blueprint $table) {
            $table->id();
            $table->string('company_name');
            $table->integer('company_type')->comment('1 => Domestic and 2 => International');
            $table->text('description')->nullable();
            $table->string('domestic_url',355)->nullable();
            $table->string('international_url',355)->nullable();
            $table->integer('status')->default(0)->comment('company active Inactive');
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
        Schema::dropIfExists('tbl_courier_company');
    }
};
