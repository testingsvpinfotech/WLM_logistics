<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdminBranchMaster extends Model
{
    use HasFactory;
    protected $table = 'tbl_branches';
    public $timestamps = false;
    protected $fillable = ['id','branch_id','branch_name','branch_head_name','contact_no','alternate_contact_no','email','address','pincode','state','city','pan_no','gst_no','bank_name','ifsc_code','account_no','account_holder_name','mfd','pan_copy','gst_copy','created_at', 'updated_at'];
}
