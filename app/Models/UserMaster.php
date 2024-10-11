<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserMaster extends Model
{
    use HasFactory;
    protected $table = 'tbl_users';
    public $timestamps = false;
    protected $fillable = ['username', 'password', 'user_name', 'contact_no', 'alternate_contact_no', 'email', 'usertype', 'branch_id', 'mfd', 'created_at','updated_at'];
}
