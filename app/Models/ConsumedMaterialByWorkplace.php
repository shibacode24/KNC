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

    public function site_name()
    {
        return $this->hasOne(Site::class, 'id',  'site_id');
    }

    public function workplace_name()
    {
        return $this->hasOne(Workplace::class, 'id',  'workplace_id');
    }


    public function material_name()
    {
        return $this->hasOne(Material::class, 'id', 'material_id');
    }

    public function unit_type()
    {
        return $this->hasOne(UnitType::class, 'id', 'unit_type_id');
    }

    public function brand_name()
    {
        return $this->hasOne(Brand::class, 'id', 'brand_id');
    }
    public function raw_material()
    {
        return $this->hasOne(RawMaterial::class, 'id', 'raw_material_id');
    }

}
