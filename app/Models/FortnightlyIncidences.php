<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FortnightlyIncidences extends Model
{
    protected $table = 'fortnightly_incidences';

    protected $fillable = [
        'fortnight',
        'employee_id',
        'punctuality_bonus',
        'up_imms',
        'loan',
        'turn',
        'comments',
    ];
    public function employees()
    {
        return $this->belongsTo(Employees::class);
    }
}
