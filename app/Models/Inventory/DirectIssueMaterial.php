<?php

namespace App\Models\Inventory;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\{Brand, RawMaterial, Warehouse, UnitType, Material, Supervisor, Site};

class DirectIssueMaterial extends Model
{
    use HasFactory;
    protected $table = 'direct_issue_material';
    protected $fillable = [
        'date',
        'time',
        'site_id',
        'supervisor_id',
        'warehouse_id',
        'material_id',
        'brand_id',
        'raw_material_id',
        'unit_id',
        'quantity',
        'remark',
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
        return $this->hasOne(UnitType::class, 'id', 'unit_id');
    }

    public function brand_name()
    {
        return $this->hasOne(Brand::class, 'id', 'brand_id');
    }

    public function raw_material_name()
    {
        return $this->hasOne(RawMaterial::class, 'id', 'raw_material_id');
    }

    public function site_name()
    {
        return $this->hasOne(Site::class, 'id', 'site_id');
    }

    public function supervisor_name()
    {
        return $this->hasOne(Supervisor::class, 'id', 'supervisor_id');
    }
}
