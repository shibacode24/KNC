<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Supervisor extends Model
{
    use HasFactory;
    protected $table = 'supervisor';
    protected $fillable = [
        'supervisor_name',
        'email',
        'mobile_number',
        'aadhar_number',
        'pan_number',
        'city_address',
        'city_id',
        'user_id',
        'password',
        'status',
    ];

    public function cityname()
    {
        return $this->hasOne(City::class, 'id', 'city_id');
    }

    public function accountDetails()
    {
        return $this->hasMany(AccountDetails::class);
    }
}
