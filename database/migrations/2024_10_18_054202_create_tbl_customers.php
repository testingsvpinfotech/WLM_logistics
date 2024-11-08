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
        Schema::create('tbl_customers', function (Blueprint $table) {
            $table->id();
            $table->string('personal_name', 20);
            $table->string('surname', 20);
            $table->string('company_name', 255);  // Increased the size for company names
            $table->string('email', 255)->unique();
            $table->string('password');  // Typically a string is used for hashed passwords
            $table->string('mobile_number', 20)->unique();  // Mobile numbers usually don't need 255 characters
            $table->integer('order_idea');
            $table->boolean('mobile_verification_status')->default(0);  // Use boolean for true/false fields
            $table->integer('resend_otp_count')->default(0);
            $table->unsignedBigInteger('category_id')->nullable();  // Ensure foreign keys are unsigned
            $table->string('address_line1')->nullable();  // Use string instead of text for single line inputs
            $table->string('address_line2')->nullable();  // Use string for consistency
            $table->unsignedBigInteger('pincode')->nullable();
            $table->boolean('whatsapp_tracking_status')->default(0);  // Use boolean for true/false fields
            $table->decimal('wallet_amount', 10, 2);  // Corrected spelling and syntax for 'wallet_amount'
            $table->date('demo_schedule')->nullable();  // Corrected spelling
            $table->string('account_no')->nullable();
            $table->tinyInteger('account_type')->nullable();  // Small numbers can use tinyInteger
            $table->string('account_holder_name', 255)->nullable();
            $table->string('ifsc_code', 20)->nullable();  // IFSC code is typically 11 characters, so reduced size
            $table->string('bank_name', 255)->nullable();  // Corrected spelling 'brank_name' to 'bank_name'
            $table->string('branch_name', 255)->nullable();
            $table->string('gstno', 255)->nullable();
            $table->boolean('status')->default(0);  // Use boolean for true/false fields
            $table->boolean('mfd')->default(0);  // Use boolean if this is true/false field
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
        Schema::dropIfExists('tbl_customers');
    }
};
