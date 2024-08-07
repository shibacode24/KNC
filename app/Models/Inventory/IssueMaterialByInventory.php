<?php

namespace App\Models\Inventory;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Material;
use App\Models\UnitType;
use App\Models\Brand;
use App\Models\{Warehouse, RawMaterial, Status};
use App\Models\{NonConsumableCategoryMaterial, NonConsumableCategory, NonConsumableUnitType, NonConsumableBrand};
use App\Models\Site;

class IssueMaterialByInventory extends Model
{
    use HasFactory;

    protected $table = 'issue_material_by_inventory';

    protected $fillable = [
        'requested_material_date',
        'material_type',
        'site_id',
        'supervisor_id',
        'requested_material_id',
        'material_id',
        'raw_material_id',
        'brand_id',
        'requested_material_quantity',
        'material_unit_id',
        'selected_warehouse_id',
        'available_material',
        'issue_material',
        'remaining_material',
        'remark',
        'inventory_status',
        'app_status',
        'issue_type',
    ];

    public function material_name()
    {
        return $this->hasOne(Material::class, 'id', 'material_id');
    }

    public function unit_type()
    {
        return $this->hasOne(UnitType::class, 'id', 'material_unit_id');
    }

    public function brand_name()
    {
        return $this->hasOne(Brand::class, 'id', 'brand_id');
    }

    public function warehouse_name()
    {
        return $this->hasOne(Warehouse::class, 'id', 'selected_warehouse_id');
    }

    public function site_name()
{
    return $this->hasOne(Site::class, 'id',  'site_id');
}

    public function raw_material_name()
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
