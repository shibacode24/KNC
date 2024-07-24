<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ApplyLeave extends Model
{
    use HasFactory;
    protected $table = 'apply_leave';
    protected $fillable = ['supervisor_id', 'from_date', 'to_date', 'leave_type', 'reason', 'status',];}
