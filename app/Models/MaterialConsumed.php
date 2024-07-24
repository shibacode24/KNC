<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MaterialConsumed extends Model
{
    use HasFactory;

    protected $table = 'material_consumed';

    protected $fillable = ['site_id', 'workplace_id', 'material_id', 'raw_material_id', 'consumed_quantity'];
}
