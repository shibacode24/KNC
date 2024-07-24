<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    use HasFactory;
    protected $table = 'brand';

    protected $fillable = ['brand','material_id'];
    public function material_name()
    {
        return $this->hasOne(Material::class, 'id', 'material_id');
    }
}
