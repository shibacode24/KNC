<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RawMaterial extends Model
{
    use HasFactory;
    protected $table = 'raw_material';
    protected $fillable = [
        'material_id',
        'raw_material_name',
        'brand_id',
        'unit',
        'minimum_keeping_quantity',
        'maximum_keeping_quantity',
        'material_type',
    ];
    public function material_name()
    {
        return $this->hasOne(Material::class, 'id', 'material_id');
    }

    public function unit_name()
    {
        return $this->hasOne(UnitType::class, 'id', 'unit');
    }

    public function brand_name()
    {
        return $this->hasOne(Brand::class, 'id', 'brand_id');
    }


}
