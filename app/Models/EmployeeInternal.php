<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EmployeeInternal extends Model
{
    protected $table = 'internal_employees';
    protected $fillable = [
        'employee_id',
        'integrated_daily_salary',
        'age',
        'full_address',
        'postal_code',
        'descount_infonavit',
        'descount_FONACOT',
        'level_study',
        'job',
        'license_vehicle',
        'familiar_phone'
    ];
}
