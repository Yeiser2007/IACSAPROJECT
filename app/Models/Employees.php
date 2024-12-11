<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Employees extends Model
{
    protected $table = 'employees';

    public function incidences()
    {
        return $this->hasMany(Incidences::class, 'employee_id');
    }
    
    
}
