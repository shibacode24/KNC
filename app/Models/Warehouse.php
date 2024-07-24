<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Warehouse extends Model
{
    use HasFactory;
    protected $table = 'warehouse';
    protected $fillable = [
        'warehouse_name',
        'incharge_name',
        'incharge_contact',
        'latitude',
        'longitude',
        'city_id',
    ];

    public function cityname()
    {
        return $this->hasOne(City::class, 'id', 'city_id');
    }
}
