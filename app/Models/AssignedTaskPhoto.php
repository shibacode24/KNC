<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AssignedTaskPhoto extends Model
{
    use HasFactory;
    protected $table = 'assigned_task_photo';
    protected $fillable = ['assigned_task_id', 'photo'];
}
