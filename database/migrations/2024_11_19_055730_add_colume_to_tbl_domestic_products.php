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
        Schema::table('tbl_domestic_products', function (Blueprint $table) {
            $table->string('inv_no')->after('productName');
            $table->decimal('inv_value',10,2)->after('productName');
            $table->decimal('weight',10,1)->after('productName');
            $table->decimal('length',10,1)->after('productName');
            $table->decimal('height',10,1)->after('productName');
            $table->decimal('width',10,1)->after('productName');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('tbl_domestic_products', function (Blueprint $table) {
            //
        });
    }
};
