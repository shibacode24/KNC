<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TaskSubCategory extends Model
{
    use HasFactory;
    protected $table = 'task_subcategory';
    protected $fillable = [
        'category_id',
        'subcategory_name',
    ];

    public function category()
    {
        return $this->hasOne(TaskCategory::class, 'id', 'category_id');
    }
}
