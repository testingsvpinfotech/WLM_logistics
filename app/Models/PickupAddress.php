<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PickupAddress extends Model
{
    use HasFactory;
    protected $table = 'tbl_pickup_address';
    public $timestamps = false;
    protected $fillable = ['id', 'user_id', 'customer_id', 'contact_person', 'contact_no', 'alter_contact_no', 'email', 'address', 'landmark', 'pincode', 'mfd', 'created_at','updated_at'];
}
