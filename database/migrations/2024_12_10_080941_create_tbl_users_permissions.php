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
        Schema::create('tbl_users_permissions', function (Blueprint $table) {
            $table->id(); // Primary key for this table
            $table->integer('menu_id');
            $table->unsignedBigInteger('usertype'); // Ensure the type matches the primary key in tbl_usertypes
            $table->integer('view')->default(0);
            $table->integer('add')->default(0);
            $table->integer('edit')->default(0);
            $table->integer('delete')->default(0);
            $table->integer('other')->default(0);
            $table->integer('mfd')->default(0);
        
            // Define the foreign key constraint
            $table->foreign('usertype')->references('id')->on('tbl_usertypes')->onDelete('RESTRICT')->onUpdate('cascade');
            
            $table->timestamps(); // Adds created_at and updated_at columns
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tbl_users_permissions');
    }
};
