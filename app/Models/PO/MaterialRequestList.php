<?php

namespace App\Models\PO;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Material; // Correctly import the Material model
use App\Models\UnitType; // Ensure you also import other related models
use App\Models\Brand;
use App\Models\{Vendor, RawMaterial, Warehouse};
use App\Models\{NonConsumableCategoryMaterial,NonConsumableCategory,NonConsumableBrand,NonConsumableUnitType};


class MaterialRequestList extends Model
{
    use HasFactory;
    protected $table = 'material_request_list';

    protected $fillable = [
        'type',
        'date',
        'add_material_id',
        'warehouse_id',
        'material_id',
        'quantity',
        'material_unit_id',
        'raw_material_id',
        'brand_id',
        'vendor_id',
        'order_id',
        'invoice_date',
        'invoice_number',
        'invoice',
        'order_by',
        'status',
    ];

    public function material_name()
    {
        return $this->hasOne(Material::class, 'id', 'material_id');
    }

    public function warehouse_name()
    {
        return $this->hasOne(Warehouse::class, 'id', 'warehouse_id');
    }

    public function raw_material_name()
    {
        return $this->hasOne(RawMaterial::class, 'id', 'raw_material_id');
    }

    public function unit_type()
    {
        return $this->hasOne(UnitType::class, 'id', 'material_unit_id');
    }

    public function brand_name()
    {
        return $this->hasOne(Brand::class, 'id', 'brand_id');
    }
    public function vendor_name()
    {
        return $this->hasOne(Vendor::class, 'id', 'vendor_id');
    }



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
