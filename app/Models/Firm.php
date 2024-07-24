<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Firm extends Model
{
    use HasFactory;
    protected $table = 'firm';

    protected $fillable = ['firm_name', 'contact_person_name', 'city_id', 'contact_number', 'city_address', 'latitude', 'longitude', 'gst'];

    public function cityname()
    {
        return $this->hasOne(City::class, 'id', 'city_id');
    }
}