<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LostMaterial extends Model
{
    use HasFactory;
    protected $table = 'lost_material';
    protected $fillable = ['site_id', 'material_type', 'material_id', 'raw_material_id', 'unit_type_id', 'lost_quantity', 'remark', 'status',];
}
