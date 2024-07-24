<?php

namespace App\Models\account_department;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Expence_Category extends Model
{
    use HasFactory;
    protected $table = 'expence_category';
    protected $fillable = [
        'expence_category'
    ];
}
