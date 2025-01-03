<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Vacations extends Model
{
    protected $table = 'vacations';

    protected $fillable = [
        'emplloyee_id',
        'start_date',
        'end_date',
        'days',
        'remaining_days',
        'comments'
    ];
    public function employee()
    {
        return $this->belongsTo(Employees::class);
    }
}
