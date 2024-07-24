<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    use HasFactory;
    protected $table = 'client';
    protected $fillable = [
        'name',
        'email',
        'mobile_number',
        'whatsapp_number',
        'aadhar_number',
        'pan_number',
        'city_address',
        'city_id',
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
    ];
    public function cityname()
    {
        return $this->hasOne(City::class, 'id', 'city_id');
    }
}