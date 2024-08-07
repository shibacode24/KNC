<?php

namespace App\Models\Warehouse;

use App\Models\Inventory\IssueMaterialByInventory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IssueMaterialByWareHouse extends Model
{
    use HasFactory;
    protected $table = 'issue_material_by_warehouse';

    protected $fillable = [
        'issue_material_by_inventory_id',
        'remark',
        'status_id',
        'app_status_id',
    ];

    // public function get_inventory_data()
    // {
    //  return $this->hasOne(IssueMaterialByInventory::class , 'id','issue_material_by_inventory_id');
    // }

}
