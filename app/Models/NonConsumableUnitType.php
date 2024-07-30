<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NonConsumableUnitType extends Model
{
    use HasFactory;
    protected $table = 'non_consumable_unit_type';

    protected $fillable = ['unit_type'];
}
