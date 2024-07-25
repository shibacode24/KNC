<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RepairingAndMaintenance extends Model
{
    use HasFactory;

    protected $table = 'repairing_and_maintenance';

    protected $fillable = ['site_id', 'warehouse_id', 'non_consumable_category_id', 'non_consumable_material_id', 'quantity', 'remark', 'status'];

}
