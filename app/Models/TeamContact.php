<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TeamContact extends Model
{
    use HasFactory;
    protected $table = 'team_contact';
    protected $fillable = [
        'team_name',
        'contact',
        'work',
        'site_id',

    ];

}
