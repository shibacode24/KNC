<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NonConsumableCategoryMaterial extends Model
{
    use HasFactory;
    protected $table = 'non_consumable_category_material';

    protected $fillable = ['category_id', 'sub_category_name', 'brand_id', 'unit_type_id', 'minimum_keeping_quantity', 'maximum_keeping_quantity'];


    public function category_name()
    {
        return $this->hasOne(NonConsumableCategory::class, 'id', 'category_id');
    }

    public function unit_name()
    {
        return $this->hasOne(NonConsumableUnitType::class, 'id', 'unit_type_id');
    }

    public function brand_name()
    {
        return $this->hasOne(NonConsumableBrand::class, 'id', 'brand_id');
    }


}
