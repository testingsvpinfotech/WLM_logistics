<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StateMaster extends Model
{
    use HasFactory;
    protected $table = 'tbl_state';
    public $timestamps = false;
    protected $fillable = ['id', 'name', 'mfd' ,'created_at', 'updated_at'];
}
