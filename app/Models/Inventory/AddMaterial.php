<?php

namespace App\Models\Inventory;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Material; // Correctly import the Material model
use App\Models\UnitType; // Ensure you also import other related models
use App\Models\{Brand, RawMaterial, Warehouse};


class AddMaterial extends Model
{
    use HasFactory;
    protected $table = 'add_material';

    protected $fillable = [
        'date',
        'warehouse_id',
        'material_id',
        'raw_material_id',
        'brand_id',
        'material_unit_id',
        'quantity',
        'order_status',
    ];

    public function warehouse_name()
    {
        return $this->hasOne(Warehouse::class, 'id', 'warehouse_id');
    }

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

    public function raw_material_name()
    {
        return $this->hasOne(RawMaterial::class, 'id', 'raw_material_id');
    }

    }


