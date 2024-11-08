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
        Schema::create('tbl_domestic_rate', function (Blueprint $table) {
            $table->id();
            $table->integer('group_id');
            $table->integer('mode_id');
            $table->integer('from_zone');
            $table->integer('to_zone');
            $table->integer('tat');
            $table->date('applicable_from');
            $table->date('applicable_to');
            $table->decimal('minimum_rate',10,2);
            $table->decimal('minimum_weight',10,2);
            $table->decimal('from_weight');
            $table->decimal('to_weight');
            $table->decimal('rate',10,2);
            $table->integer('fixed_perkg');
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
        Schema::dropIfExists('tbl_domestic_rate');
    }
};
