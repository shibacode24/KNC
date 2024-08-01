<?php

namespace App\Models\Inventory;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\{NonConsumableUnitType, Warehouse,NonConsumableBrand,NonConsumableCategoryMaterial,NonConsumableCategory};

class NonConsumableMaterial extends Model
{
    use HasFactory;
    protected $table = 'non_consumable_material';

    protected $fillable = [
        'date',
        'warehouse_id',
        'material_id',
        'raw_material_id',
        'brand_id',
        'material_unit_id',
        'quantity',
        'issue_type'
    ];

    public function warehouse_name()
    {
        return $this->hasOne(Warehouse::class, 'id', 'warehouse_id');
    }

    public function material_name()
    {
        return $this->hasOne(NonConsumableCategoryMaterial::class, 'id', 'raw_material_id');
    }

    public function category_name()
    {
        return $this->hasOne(NonConsumableCategory::class, 'id', 'material_id');
    }


    public function unit_type()
    {
        return $this->hasOne(NonConsumableUnitType::class, 'id', 'material_unit_id');
    }

    public function brand_name()
    {
        return $this->hasOne(NonConsumableBrand::class, 'id', 'brand_id');
    }

    // public function raw_material_name()
    // {
    //     return $this->hasOne(RawMaterial::class, 'id', 'raw_material_id');
    // }
}
