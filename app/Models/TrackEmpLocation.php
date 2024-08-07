<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TrackEmpLocation extends Model
{
    use HasFactory;
    protected $table = 'track_emp_location';
    protected $fillable = [
        'emp_type',
        'emp_id',
        'latitude',
        'longitude',
        'recorded_at '

    ];
}
