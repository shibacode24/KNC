<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Site extends Model
{
    use HasFactory;
    protected $table = 'sites';
    protected $fillable = [
        'site_personal_or_buisness',
        'firm_id',
        'city_id',
        'client_id',
        'site_name',
        'mobile_number',
        'city_address',
        'latitude',
        'longitude',
        'site_description',
        'site_documents',
        'buisness_name',
    ];

    // Define relationships
    public function firm()
    {
        return $this->belongsTo(Firm::class);
    }

    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    public function cityname()
    {
        return $this->hasOne(City::class, 'id', 'city_id');
    }
}
