<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AvailableMaterial extends Model
{
    use HasFactory;
    protected $table = 'available_material';
    protected $fillable = ['warehouse_id', 'type', 'material_id', 'brand_id', 'raw_material_id', 'available_quantity',];

    public function warehouse_name()
    {
        return $this->hasOne(Warehouse::class, 'id', 'warehouse_id');
    }

    public function material_name()
    {
        return $this->hasOne(Material::class, 'id', 'material_id');
    }

    // public function raw_material_name()
    // {
    //     return $this->hasOne(RawMaterial::class, 'id', 'raw_material');
    // }


    public function unit_type()
    {
        return $this->hasOne(UnitType::class, 'id', 'material_unit_id');
    }

    public function brand_name()
    {
        return $this->hasOne(Brand::class, 'id', 'brand_id');
    }

    // public function warehouse_name()
    // {
    //     return $this->hasOne(Warehouse::class, 'id', 'selected_warehouse_id');
    // }

    public function site_name()
{
    return $this->hasOne(Site::class, 'id',  'site_id');
}

    public function raw_material()
    {
        return $this->hasOne(RawMaterial::class, 'id', 'raw_material_id');
    }


//non consumable
// public function non_consumable_material_name()
// {
//     return $this->hasOne(NonConsumableCategoryMaterial::class, 'id', 'material_id');
// }

// public function non_consumable_raw_material_name()
// {
//     return $this->hasOne(NonConsumableCategory::class, 'id', 'raw_material_id');
// }

public function non_consumable_material_name()
{
    return $this->hasOne(NonConsumableCategoryMaterial::class, 'id', 'raw_material_id');
}

public function non_consumable_category_name()
{
    return $this->hasOne(NonConsumableCategory::class, 'id', 'material_id');
}


public function non_consumable_unit_type()
{
    return $this->hasOne(NonConsumableUnitType::class, 'id', 'material_unit_id');
}

public function non_consumable_brand_name()
{
    return $this->hasOne(NonConsumableBrand::class, 'id', 'brand_id');
}



}
