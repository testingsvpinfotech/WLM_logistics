<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_domestic_booking', function (Blueprint $table) {
            $table->id();
            $table->string('order_id', 255);
            $table->string('order_channel', 255);
            $table->string('order_tag', 255)->nullable();
            $table->string('resellar_name', 255)->nullable();
            $table->string('paymentMode', 50);  // Assuming paymentMode might be a string like 'Prepaid', 'COD'
            $table->string('buy_full_name');
            $table->string('buy_mobile');
            $table->string('buy_email')->nullable();
            $table->string('buy_alter_mobile')->nullable();
            $table->string('buy_company_name', 255)->nullable();
            $table->string('buy_gst_in', 255)->nullable();
            $table->text('buy_delivery_address');
            $table->string('buy_delivery_landmark');
            $table->string('buy_delivery_pincode');
            $table->string('billing_status');
            $table->string('buy_full_billing_name')->nullable();
            $table->string('buy_billing_mobile')->nullable();
            $table->string('buy_billing_email')->nullable();
            $table->text('buy_delivery_billing_address')->nullable();
            $table->string('buy_delivery_billing_landmark')->nullable(); // Removed duplicate
            $table->decimal('order_shipping_charges', 10, 2)->nullable();
            $table->decimal('order_gift_wrap', 10, 2)->nullable();
            $table->decimal('order_transaction_fee', 10, 2)->nullable();
            $table->decimal('order_discounts', 10, 2)->nullable(); // Changed to decimal for accuracy
            $table->decimal('product_sub_total', 10, 2)->nullable();
            $table->decimal('product_other_charges', 10, 2)->nullable();
            $table->decimal('product_discount', 10, 2)->nullable(); // Changed to decimal
            $table->decimal('voluematrix_weight', 10, 2)->nullable();
            $table->decimal('applicable_weight', 10, 2)->nullable();
            $table->dateTime('orderDate')->useCurrent();
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
        Schema::dropIfExists('tbl_domestic_booking');
    }
};
