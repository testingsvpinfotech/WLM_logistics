<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdminUserType extends Model
{
    use HasFactory;
    protected $table = 'tbl_usertypes';
    public $timestamps = false;
    protected $fillable = ['name', 'description', 'mfd', 'created_at', 'updated_at'];
}
