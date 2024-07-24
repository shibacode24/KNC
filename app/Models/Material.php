<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Material extends Model
{
    use HasFactory;


    protected $table = 'material';

    protected $fillable = ['material', 'unit_type_id',];

    public function unit_type()
    {
        return $this->hasOne(UnitType::class, 'id', 'unit_type_id');
    }
}
