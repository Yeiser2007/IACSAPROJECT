<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Incidences extends Model
{
    protected $table = 'incidences';

    protected $fillable = [
        'employee_id',
        'record_date',
        'entry_time',
        'exit_time',
        'recorded_schedule',
        'overtime_hours',
        'sunday_premium',
        'holiday',
        'abilitation',
        'reason',
        'comments',
        'abilitation_id',
        'user_id',
    ];

    public function employees()
    {
        return $this->belongsTo(Employees::class, 'employee_id');
    }
    public function abilitations()
    {
        return $this->belongsTo(Abilitations::class, 'abilitation_id');
    }
}
