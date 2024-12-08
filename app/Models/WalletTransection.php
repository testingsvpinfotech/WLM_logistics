<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WalletTransection extends Model
{
    use HasFactory;
    protected $table = 'tbl_customer_wallet_transection';
    public $timestamps = false;
    protected $fillable = ['id', 'customer_id', 'transaction_type', 'amount', 'balance_amount', 'reference_no', 'description', 'status', 'date','display_status', 'created_at','updated_at'];
}
