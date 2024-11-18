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
        Schema::create('tbl_customer_wallet_transection', function (Blueprint $table) {
            $table->id();
            $table->integer('customer_id')->index();
            $table->integer('transaction_type')->comment('1 => Credit, 2 => Debit');
            $table->decimal('amount', 10, 2)->nullable();
            $table->decimal('balance_amount', 10, 2)->nullable();
            $table->string('reference_no')->nullable();
            $table->text('description')->nullable();
            $table->integer('status')->comment('1 => Success, 2 => Pending, 3 => Failed');
            $table->integer('display_status')->default(0);
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
        Schema::dropIfExists('tbl_customer_wallet_transection');
    }
};
