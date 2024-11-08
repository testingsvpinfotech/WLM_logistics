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
        Schema::create('tbl_pincode', function (Blueprint $table) {
            $table->id();
            $table->string('pincode', 155)->unique();
            $table->unsignedBigInteger('state_id'); // Ensure the column is defined before referencing it
            $table->unsignedBigInteger('city_id');  // Ensure the column is defined before referencing it
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
        Schema::dropIfExists('tbl_pincode');
    }
};
