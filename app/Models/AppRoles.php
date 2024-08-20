<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AppRoles extends Model
{
    use HasFactory;

    use HasFactory;
    protected $table = 'app_roles';

    protected $fillable = ['role', 'permission'];

    protected $casts = [

        'permission' => 'array',

    ];

}
