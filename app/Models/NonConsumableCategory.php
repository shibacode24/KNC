<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NonConsumableCategory extends Model
{
    use HasFactory;

    protected $table = 'non_consumable_category';

    protected $fillable = ['category',];

}
