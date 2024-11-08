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
        Schema::create('tbl_menu_master', function (Blueprint $table) {
            $table->id();
            $table->integer('master_menu_id');
            $table->integer('master_menu_identity')->nullable();
            $table->integer('sub_menu_id');
            $table->string('master_menu_name');
            $table->string('sub_menu_name',355);
            $table->string('menu_url');
            $table->integer('menu_status')->default(0);
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
        Schema::dropIfExists('tbl_menu_master');
    }
};
