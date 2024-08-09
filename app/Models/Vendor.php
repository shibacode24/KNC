<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vendor extends Model
{
    use HasFactory;
    protected $table = 'vendor';
    protected $fillable = [
        'vendor_name',
        'email',
        'mobile_number',
        'aadhar_number',
        'pan_number',
        'city_address',
        'brand',
        'materials',
        'city_id',
        'status'

    ];

    public function cityname()
    {
        return $this->hasOne(City::class, 'id', 'city_id');
    }
    public function brandname()
    {
        return $this->hasOne(Brand::class, 'id', 'brand');
    }
    public function materialname()
    {
        return $this->hasOne(Material::class, 'id', 'materials');
    }

    public function accountDetails()
    {
        return $this->hasMany(AccountDetails::class);
    }
}
