<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Adminpermissionss extends Model
{
    use HasFactory;

    protected $table = 'tbl_users_permissions';
    public $timestamps = false;
    protected $fillable = ['id', 'menu_id', 'usertype', 'view', 'add', 'edit', 'delete', 'other', 'mfd', 'created_at','updated_at'];
}
