<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DomesticRate extends Model
{
    use HasFactory; 
    protected $table = 'tbl_domestic_rate';
    public $timestamps = false;
    protected $fillable = ['id', 'group_id', 'mode_id', 'from_zone', 'to_zone', 'tat', 'applicable_from', 'applicable_to', 'minimum_rate', 'minimum_weight', 'from_weight', 'to_weight', 'rate', 'fixed_perkg', 'mfd', 'created_at','updated_at'];
}
