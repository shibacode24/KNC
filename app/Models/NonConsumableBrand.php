<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NonConsumableBrand extends Model
{
    use HasFactory;
    protected $table = 'non_consumable_brand';

    protected $fillable = [
        'category_id',
        'brand'
    ];
    public function category_name()
    {
        return $this->hasOne(NonConsumableCategory::class, 'id', 'category_id');
    }
}
