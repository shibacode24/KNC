<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AssignedTask extends Model
{
    use HasFactory;
    protected $table = 'assigned_task';
    protected $fillable = ['site_id', 'task_id', 'task_category_id', 'task_subcategory_id', 'contractor_id', 'start_date', 'end_date', 'total_work',
    'work_unit_type_id'];
}
