<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WorkPlace extends Model
{
    use HasFactory;
    protected $table = 'workplace';

    protected $fillable = ['site_id', 'supervisor_id', 'workplace_name', 'workplace_address'];
}
