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
        Schema::create('tbl_pickup_address', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id')->nullable();
            $table->integer('customer_id')->nullable();
            $table->string('contact_person');
            $table->string('contact_no');
            $table->string('alter_contact_no')->nullable();
            $table->string('email')->nullable();
            $table->text('address');
            $table->text('landmark');
            $table->string('pincode');
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
        Schema::dropIfExists('tbl_pickup_address');
    }
};
