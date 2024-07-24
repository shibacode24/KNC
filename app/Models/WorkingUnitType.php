<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WorkingUnitType extends Model
{
    use HasFactory;
    protected $table = 'working_unit_type';

    protected $fillable = ['working_unit_type'];
}
