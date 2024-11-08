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
        Schema::create('tbl_domestic_products', function (Blueprint $table) {
            $table->id();
            $table->integer('booking_id');
            $table->string('productName');
            $table->decimal('unitPrice', 10, 2);
            $table->integer('quantity');
            $table->string('productCategory')->nullable();
            $table->string('order_hsn_code')->nullable();
            $table->string('order_sku')->nullable();
            $table->decimal('order_tax_rate', 5, 2)->nullable();  // Adjusted to decimal for accuracy
            $table->decimal('order_product_discount', 5, 2)->nullable();  // Adjusted to decimal for discount
            $table->integer('mfd')->default(0);  // Assuming 0 represents not manufactured
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
        Schema::dropIfExists('tbl_domestic_products');
    }
};
