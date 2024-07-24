<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AssignedTaskIssues extends Model
{
    use HasFactory;
    protected $table = 'assigned_task_issues';
    protected $fillable = ['assigned_task_id', 'issue_id'];
}
