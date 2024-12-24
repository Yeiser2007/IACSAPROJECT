<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WeeklyIncidences extends Model
{
    //
    protected $table = 'weekly_incidences';

    protected $fillable = [
        'week',
        'employee_id',
        'double_hours',
        'triple_hours',
        'sunday_premium',
        'vacation_id',
        'loan_partial',
        'loan_lapse',
        'loan_charge_initial',
        'days_worked',
        'holiday_worked',
        'abilitation',
        'balance',
        'vacation_bonus',
        'bonus',
        'punctuality_bonus',
        'vacation_days',
        'fair_bonus',
        'turn',
        'comments',
    ];

    public function employee()
    {
        return $this->belongsTo(Employees::class, 'employee_id', 'id');
    }
    public function vacation()
    {
        return $this->belongsTo(Vacations::class, 'vacation_id', 'id');
    }   
}
