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
        Schema::create('tbl_users', function (Blueprint $table) {
            $table->id();
            $table->string('username', 155)->unique();  // Unique constraint
            $table->string('password', 455);
            $table->string('user_name', 255);
            $table->string('contact_no', 255);
            $table->string('alternate_contact_no', 255)->nullable();
            $table->string('email', 255);
            $table->string('last_session', 255)->nullable();
            $table->integer('usertype');
            $table->integer('branch_id');
            $table->string('mfd')->default('0');
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
        Schema::dropIfExists('tbl_users');
    }
};
