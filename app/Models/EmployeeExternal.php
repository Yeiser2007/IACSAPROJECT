<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EmployeeExternal extends Model
{
    protected $table = 'external_employees';
    protected $fillable = [
        'employee_id',
        'work_code',

    ];
}
