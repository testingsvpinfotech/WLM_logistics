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
        Schema::create('tbl_domestic_booking', function (Blueprint $table) {
            $table->bigIncrements('booking_id'); // Custom increment column
            $table->string('order_no')->index();
            $table->string('airway_no')->index();
            $table->date('pickup_date');
            $table->unsignedBigInteger('courier_id')->index();
            $table->string('lable_image')->nullable();
            $table->string('token_no');
            $table->string('originarea');
            $table->string('destinationarea');
            $table->string('order_channels');
            $table->string('payment_mode')->index();

            // Sender details (Nullable as per request)
            $table->string('pickup_location_wearhouse')->index();
            $table->string('sender_name')->nullable()->index();
            $table->string('sender_contact_no')->nullable();
            $table->string('sender_pincode')->nullable()->index();
            $table->text('sender_address')->nullable();
            $table->string('sender_gstno')->nullable();

            $table->string('receiver_name')->index();
            $table->string('receiver_company_name')->index();
            $table->string('receiver_contact_no');
            $table->string('receiver_gstno')->nullable();
            $table->text('receiver_address');
            $table->string('receiver_pincode')->index();

            // Charges
            $table->decimal('frieht', 10, 2)->default(0);
            $table->decimal('transportation_charges', 10, 2)->default(0);
            $table->decimal('pickup_charges', 10, 2)->default(0);
            $table->decimal('delivery_charges', 10, 2)->default(0);
            $table->decimal('courier_charges', 10, 2)->default(0);
            $table->decimal('green_tax', 10, 2)->default(0);
            $table->decimal('awb_charges', 10, 2)->default(0);
            $table->decimal('fov_charges', 10, 2)->default(0);
            $table->decimal('appt_charges', 10, 2)->default(0);
            $table->decimal('other_charges', 10, 2)->default(0);
            $table->decimal('ess_ch', 10, 2)->default(0);
            $table->decimal('caf_ch', 10, 2)->default(0);
            $table->decimal('idc_ch', 10, 2)->default(0);
            $table->decimal('vahc_ch', 10, 2)->default(0);
            $table->decimal('edl_ch', 10, 2)->default(0);
            $table->decimal('dc_ch', 10, 2)->default(0);
            $table->decimal('owh_ch', 10, 2)->default(0);

            $table->string('pay_type')->index();
            $table->decimal('total_amount', 10, 2);
            $table->decimal('fuel_subcharges', 10, 2)->default(0);
            $table->decimal('insurance_charges', 10, 2)->default(0);
            $table->decimal('sub_total', 10, 2)->index();
            $table->decimal('cgst', 10, 2)->default(0);
            $table->decimal('sgst', 10, 2)->default(0);
            $table->decimal('igst', 10, 2)->default(0);
            $table->decimal('grand_total', 10, 2)->index();
            $table->date('booking_date')->index();
            $table->time('booking_time');
            $table->unsignedBigInteger('branch_id')->index();
            $table->unsignedBigInteger('customer_id')->index();
            $table->integer('mfd')->default(0)->index();
            $table->integer('is_cancel')->default(0)->index();
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
