<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'panel_role',
        'app_role',
        'name',
        'email',
        'password',
        'contact',
        'aadhar_number',
        'pan_number',
        'city',
        'address',
        'latitude',
        'longitude',
        'permission',
        'app_permission',
    ];

        public function supervisor(){
            return $this->hasOne(Supervisor::class, 'user_id', 'id');
        }

        public function employee()
        {
            return $this->hasOne(Employee::class, 'user_id', 'id');
        }

        public function role_name()
        {
            return $this->hasOne(PanelRoles::class, 'id', 'panel_role');
        }

        public function app_role_name()
        {
            return $this->hasOne(AppRoles::class, 'id', 'app_role');
        }

        public function siteManager(){
            return $this->hasOne(Site_Manager::class, 'user_id', 'id');
        }

        public function siteIncharge(){
            return $this->hasOne(Site_Incharge::class, 'user_id', 'id');
        }

        public function engineer(){
            return $this->hasOne(Engineer::class, 'user_id', 'id');
        }
    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
        'permission' => 'array',
        'app_permission' => 'array',


    ];
}
