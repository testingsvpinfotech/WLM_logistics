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
        Schema::create('tbl_transfer_mode', function (Blueprint $table) {
            $table->id();
            $table->string('mode_name');
            $table->text('description')->nullable();
            $table->integer('courier_id')->default(0);
            $table->integer('status')->default(0);
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
        Schema::dropIfExists('tbl_transfer_mode');
    }
};
