<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NonConsumableBrand extends Model
{
    use HasFactory;
    protected $table = 'non_consumable_brand';

    protected $fillable = [
        'material_id',
        'brand'
    ];
    public function material_name()
    {
        return $this->hasOne(NonConsumableCategoryMaterial::class, 'id', 'material_id');
    }
}
