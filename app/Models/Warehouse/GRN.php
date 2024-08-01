<?php

namespace App\Models\Warehouse;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\{Material, UnitType, Brand, Vendor, RawMaterial}; // Correctly import the Material model
// use App\Models\UnitType; // Ensure you also import other related models
// use App\Models\Brand;
// use App\Models\Vendor;

class GRN extends Model
{
    use HasFactory;
    protected $table = 'grn';

    protected $fillable = [
        // 'date',
        // // 'order_id',
        // 'warehouse_id',
        // 'material_type',
        // 'material_id',
        // 'brand_id',
        // 'material_unit_type_id',
        // 'raw_material_id',
        // 'received_quantity',
        // 'vendor_id',
        // 'delivery_location',
        // 'received_by',
        // 'remark',
        'add_material_id',
        'material_req_list_id',
        'received_date',
        'received_time',
        'warehouse_id',
        'received_by',
        'received_quantity',
        'grn_type',

    ];

    public function material_name()
    {
        return $this->hasOne(Material::class, 'id', 'material_id');
    }

    public function brand_name()
    {
        return $this->hasOne(Brand::class, 'id', 'brand_id');
    }

    public function vendor_name()
    {
        return $this->hasOne(Vendor::class, 'id', 'vendor_id');
    }

    public function raw_material_name()
    {
        return $this->hasOne(RawMaterial::class, 'id', 'raw_material_id');
    }
}
