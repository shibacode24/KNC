<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AssignSite extends Model
{
    use HasFactory;
    protected $table = 'assign_site';
    protected $fillable = ['date', 'site_assign', 'role_id', 'user_id'];


    public function site_name()
    {
        return $this->hasOne(Site::class, 'id', 'site_assign');
    }
    public function username()
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }

    public function role_name()
    {
        return $this->hasOne(PanelRoles::class, 'id', 'role_id');
    }

    protected $casts = [

        'user_id' => 'array',

    ];
}
