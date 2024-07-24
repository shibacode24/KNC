<?php

namespace App\Models\account_department;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Expence_Head extends Model
{
    use HasFactory;
    protected $table = 'expence_head';
    protected $fillable = [
        'expence_head',
        'expence_category_id',
    ];

    public function expence_name()
    {
    return $this->hasOne(Expence_Category::class , 'id', 'expence_category_id');
    }
}
