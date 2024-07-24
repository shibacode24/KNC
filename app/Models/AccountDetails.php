<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AccountDetails extends Model
{
    use HasFactory;
    protected $table = 'account_details';

    protected $fillable = [

        'user_id',
        'panel_role_id',
        'supervisor_id',
        'vendor_id',
        'contractor_id',
        'employee_id',
        'account_holder',
        'bank_name',
        'account_number',
        'ifsc_code',
    ];


    public function supervisor()
    {
        return $this->hasOne(Supervisor::class, 'id', 'supervisor_id');
    }
    public function employee()
    {
        return $this->hasOne(Employee::class, 'id', 'employee_id');
    }
    public function contractor()
    {
        return $this->hasOne(Contractor::class, 'id', 'contractor_id');
    }
    public function vendorn()
    {
        return $this->hasOne(Vendor::class, 'id', 'vendor_id');
    }


}
