<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AvailableMaterial extends Model
{
    use HasFactory;
    protected $table = 'available_material';
    protected $fillable = ['warehouse_id', 'type', 'material_id', 'brand_id', 'raw_material_id', 'available_quantity',];
}
