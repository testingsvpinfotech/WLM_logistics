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
        Schema::create('tbl_branches', function (Blueprint $table) {
            $table->id();
            $table->string('branch_id')->nullable(false);
            $table->string('branch_name', 155)->unique();
            $table->string('branch_head_name', 255);
            $table->string('contact_no', 55)->nullable();
            $table->string('alternate_contact_no', 55)->nullable();
            $table->string('email', 155)->nullable();
            $table->text('address')->nullable(false);
            $table->integer('pincode');
            $table->integer('state');
            $table->integer('city');
            $table->string('pan_no', 20)->nullable();
            $table->string('pan_copy')->nullable();
            $table->string('gst_no', 20)->nullable();
            $table->string('gst_copy')->nullable();
            $table->string('bank_name', 255)->nullable();
            $table->string('ifsc_code', 255)->nullable();
            $table->string('account_no', 255)->nullable();
            $table->string('account_holder_name', 255)->nullable();
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
        Schema::dropIfExists('tbl_branches');
    }
};
