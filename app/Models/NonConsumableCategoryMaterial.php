<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NonConsumableCategoryMaterial extends Model
{
    use HasFactory;
    protected $table = 'non_consumable_category_material';

    protected $fillable = ['category_id', 'material'];


    public function category_name()
    {
        return $this->hasOne(NonConsumableCategory::class, 'id', 'category_id');
    }

}
