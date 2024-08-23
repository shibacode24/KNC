<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LostMaterial extends Model
{
    use HasFactory;
    protected $table = 'lost_material';
    protected $fillable = ['site_id', 'material_type', 'material_id', 'raw_material_id', 'unit_type_id', 'lost_quantity', 'remark', 'status',];

    public function site_name()
    {
        return $this->hasOne(Site::class, 'id',  'site_id');
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
