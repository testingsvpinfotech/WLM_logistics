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
        Schema::create('tbl_international_booking', function (Blueprint $table) {
            $table->id();
            $table->string('order_id', 255)->index();
            $table->string('order_channel', 255);
            $table->string('order_tag', 255)->nullable();
            $table->string('channel_invoice', 255)->nullable();
            $table->date('channel_invoice_date')->nullable();
            $table->string('payment_transaction_id', 255)->nullable();
            $table->string('transaction_url', 255)->nullable();
            $table->integer('signature_type')->nullable();
            $table->string('3C_applicable')->nullable();
            $table->string('meis_applicable')->nullable();
            $table->string('payment_status', 255)->nullable();
            $table->string('inco_terms', 255)->nullable();
            $table->string('tax_id', 255)->nullable();
            $table->string('payment_mode', 50);
            $table->string('buy_full_name');
            $table->string('buy_mobile');
            $table->string('buy_email')->nullable();
            $table->string('buy_alter_mobile')->nullable();
            $table->string('buy_company_name', 255)->nullable();
            $table->string('buy_gst_in', 255)->nullable();
            $table->text('buy_delivery_addressline1');
            $table->string('buy_delivery_addressline2')->nullable();
            $table->integer('buy_delivery_country_id');
            $table->integer('buy_delivery_currency_id');
            $table->string('buy_delivery_pincode');
            $table->string('buy_delivery_state');
            $table->string('buy_delivery_city');
            $table->string('ship_to_fba')->nullable();
            $table->string('shipment_purpose')->nullable();
            $table->string('billing_status');
            $table->string('delivery_country_id')->nullable();
            $table->string('buy_full_billing_name')->nullable();
            $table->string('buy_billing_mobile')->nullable();
            $table->string('buy_billing_email')->nullable();
            $table->text('buy_delivery_billing_addressline1')->nullable();
            $table->text('buy_delivery_billing_addressline2')->nullable();
            $table->string('buy_delivery_billing_pincode')->nullable();
            $table->string('buy_delivery_billing_state')->nullable();
            $table->string('buy_delivery_billing_city')->nullable();
            $table->decimal('order_shipping_charges', 10, 2)->nullable();
            $table->decimal('order_gift_wrap', 10, 2)->nullable();
            $table->decimal('order_transaction_fee', 10, 2)->nullable();
            $table->decimal('order_discounts', 10, 2)->nullable();
            $table->decimal('product_sub_total', 10, 2)->nullable();
            $table->decimal('product_other_charges', 10, 2)->nullable();
            $table->decimal('product_discount', 10, 2)->nullable();
            $table->decimal('order_total', 10, 2)->nullable();
            $table->decimal('dead_weight', 10, 2)->nullable();
            $table->decimal('length', 10, 2)->nullable();
            $table->decimal('breath', 10, 2)->nullable();
            $table->decimal('height', 10, 2)->nullable();
            $table->decimal('volumetric_weight', 10, 2)->nullable();
            $table->decimal('applicable_weight', 10, 2)->nullable();
            $table->dateTime('order_date')->useCurrent();
            $table->integer('created_id')->default(0);
            $table->string('created_by');
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
        Schema::dropIfExists('tbl_international_booking');
    }
};
