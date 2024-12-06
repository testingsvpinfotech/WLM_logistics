<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InternationalRate extends Model
{
    use HasFactory;
    protected $table = 'tbl_international_rate';
    public $timestamps = false;
    protected $fillable = ['id', 'rate_group_id','from_date','courier_company', 'doc_type', 'type_export_import', 'zone_id', 'from_weight', 'to_weight', 'rate', 'fixed_perkg', 'mfd', 'created_at','updated_at'];
}
