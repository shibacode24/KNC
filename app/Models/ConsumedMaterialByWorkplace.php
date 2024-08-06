<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ConsumedMaterialByWorkplace extends Model
{
    use HasFactory;
    protected $table = 'consumed_material_by_workplace';
    protected $fillable = [
        'site_id',
        'workplace_id',
        'supervisor_id',
        'material_id',
        'raw_material_id',
        'brand_id',
        'unit_type_id',
    ];
}
