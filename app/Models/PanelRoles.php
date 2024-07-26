<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PanelRoles extends Model
{
    use HasFactory;
    protected $table = 'panel_roles';

    protected $fillable = ['role', 'permission'];


    protected $casts = [

        'permission' => 'array',

    ];
}
