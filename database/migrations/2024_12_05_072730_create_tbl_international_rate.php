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
        Schema::create('tbl_international_rate', function (Blueprint $table) {
            $table->id();
            $table->integer('rate_group_id');
            $table->integer('courier_company');
            $table->integer('doc_type');
            $table->integer('type_export_import');
            $table->integer('zone_id');
            $table->decimal('from_weight',10,2);
            $table->decimal('to_weight',10,2);
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
        Schema::dropIfExists('tbl_international_rate');
    }
};
