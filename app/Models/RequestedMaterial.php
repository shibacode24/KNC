<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RequestedMaterial extends Model
{
    use HasFactory;
    protected $table = 'requested_material';
    protected $fillable = [
        'site_id',
        'supervisor_id',
        'material_id',
        'material_type',
        'raw_material_id',
        'requested_quantity',
        'material_unit_type_id',
        'brand_id',
        'received_quantity',
        'remaining_quantity',
        'received_remark',
        'status',
    ];

    public function site_name(){

        return $this->hasOne(Site::class, 'id', 'site_id');
    }

    public function supervisor_name(){

        return $this->hasOne(Supervisor::class, 'user_id', 'supervisor_id');

    }

    public function material_name()
    {
        return $this->hasOne(Material::class, 'id', 'material_id');
    }

    public function raw_material_name()
    {
        return $this->hasOne(RawMaterial::class, 'id', 'raw_material_id');
    }

    public function unit_type()
    {
        return $this->hasOne(UnitType::class, 'id', 'material_unit_type_id');
    }

    public function brand_name()
    {
        return $this->hasOne(Brand::class, 'id', 'brand_id');
    }

//non consumable
public function non_consumable_material_name()
{
    return $this->hasOne(NonConsumableCategory::class, 'id', 'material_id');
}

public function non_consumable_raw_material_name()
{
    return $this->hasOne(NonConsumableCategoryMaterial::class, 'id', 'raw_material_id');
}

public function non_consumable_unit_type()
{
    return $this->hasOne(NonConsumableUnitType::class, 'id', 'material_unit_type_id');
}

public function non_consumable_brand_name()
{
    return $this->hasOne(NonConsumableBrand::class, 'id', 'brand_id');
}

}
