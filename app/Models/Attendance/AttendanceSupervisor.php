<?php

namespace App\Models\Attendance;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AttendanceSupervisor extends Model
{
    use HasFactory;
    protected $table = 'attendance_supervisor';

    protected $fillable = [
        'supervisor_id',
        'date',
        'checkin_time',
        'checkout_time',
    ];

}
