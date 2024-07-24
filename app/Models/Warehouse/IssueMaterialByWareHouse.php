<?php

namespace App\Models\Warehouse;

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

}
