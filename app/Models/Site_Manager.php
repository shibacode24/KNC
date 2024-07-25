<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Site_Manager extends Model
{
    use HasFactory;
    protected $table = 'site_manager';
    protected $fillable = [
        'user_id',
        'employee_name',
        'email',
        'mobile_number',
        'aadhar_number',
        'pan_number',
        'city_address',
        'city_id',
        'account_holder',
        'bank_name',
        'account_number',
        'ifsc_code',

    ];
     public function cityname()
    {
        return $this->hasOne(City::class, 'id', 'city_id');
    }
}
