<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustomerModel extends Model
{
    use HasFactory;
    protected $table = 'tbl_customers';
    public $timestamps = false;
    protected $fillable = ['id', 'personal_name', 'surname', 'company_name', 'email', 'password', 'mobile_number', 'order_idea', 'mobile_verification_status', 'resend_otp_count', 'category_id', 'address_line1', 'address_line2', 'pincode', 'whatsapp_tracking_status', 'wallet_amount', 'demo_schedule', 'account_no', 'account_type', 'account_holder_name', 'ifsc_code', 'bank_name', 'branch_name', 'gstno', 'status', 'mfd', 'created_at',
'updated_at'];
}
