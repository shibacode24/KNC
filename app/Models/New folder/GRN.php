<?php

namespace App\Models;
namespace App\Models\Material;
namespace App\Models\Vendor;
namespace App\Models\UnitType;
namespace App\Models\Brand;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GRN extends Model
{
    use HasFactory;
    protected $table = 'grn';

    protected $fillable = [
        'date',
        'order_id',
        'vendor_id',
        'material_id',
        'brand_id',
        'material_unit_type_id',
        'received_quantity',
        'delivery_location',
        'received_by',
        'remark',
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

    public function vendor_name()
    {
        return $this->hasOne(Vendor::class, 'id', 'vendor_id');
    }

}
