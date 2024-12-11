<?php

namespace App\Livewire\Incidences;

use App\Models\abilitations;
use Illuminate\Validation\Rule;
use Livewire\Component;
use App\Models\Employees;
use App\Models\Incidences;
use Carbon\Carbon;

class CreateIncidence extends Component
{
    public $start_time = '09:00';
    public $end_time = '17:00';
    public $end_time_register;
    public $overtime_hours = 0;
    public $startWeek;
    public $endWeek;
    public $incidencesByEmployee;
    public $daysOfWeek = [];
    public $daySelected;
    public $currentWeek;
    public $weeksOfYear = [];
    public $usersWithoutIncidence = [];
    public $weekSelected;
    public $reason;
    public $comments;
    public $userSelected;
    public $dayValidation = "No";
    public $abilitation_id;
    public $statusRegister='No';
    public $abilitations;

    public function mount()
    {
        $this->abilitations = abilitations::all();
        $this->weeksOfYear();
        $this->daysOfWeek($this->currentWeek);
    }
    public function updatedDayValidation($daySelected){
        $this->dayValidation = $daySelected ? 'Si' : 'No';
    }
    public function updatedStatusRegister($statusRegister){
        if($this->statusRegister == 'Si'){
            $this->abilitation_id = null;
            $this->reason = null;
            $this->comments = null;
            $this->end_time_register = null;
        }

    }
    public function weeksOfYear()
    {
        $currentDate = Carbon::now();

        $this->currentWeek = $currentDate->weekOfYear;

        for ($week = 1; $week <= $this->currentWeek; $week++) {
            $startWeek = Carbon::now()->startOfYear()->addWeeks($week)->startOfWeek(4);
            $endWeek = $startWeek->copy()->addDays(6);
            $this->weeksOfYear[] = [
                'numero' => $week,
                'rango' => $startWeek->format('d M') . ' - ' . $endWeek->format('d M'),
            ];
        }

        $this->weekSelected = $this->currentWeek;
    }
    public function daysOfWeek($week)
    {
        Carbon::setLocale('es');
        $numberOfWeek = intval($week);

        $startWeek = Carbon::now()->startOfYear()->addWeeks($numberOfWeek)->startOfWeek(4);
        $endWeek = $startWeek->copy()->addDays(6);

        $this->daysOfWeek = [];
        for ($date = $startWeek->copy(); $date->lte($endWeek); $date->addDay()) {
            $this->daysOfWeek[] = [
                'fecha' => $date->toDateString(),
                'nombre' => $date->locale('es')->isoFormat('dddd'),
            ];
        }
    }
    public function updatedWeekSelected($numeroSemana)
    {
        $this->weekSelected = $numeroSemana;
        $this->daysOfWeek($numeroSemana);
        $this->dispatch('render', $numeroSemana);
    }
    public function updatedDaySelected($daySelected)
    {
        $this->usersWithoutIncidence = $this->getUsers($daySelected);
    }
    public function getUsers($daySelected)
    {
        $date = Carbon::parse($daySelected)->toDateString();
        // $excludedEmployeeIds = Incidences::whereDate('record_date', $date)
        //     ->pluck('employee_id')
        //     ->toArray();
        // $users = Employees::whereNotIn('id', $excludedEmployeeIds)->get();
        $users =Employees::all();
    
        return $users;
    }
    public function updatedEndTime()
    {
        $this->updateOvertime();
    }
    public function updatedEndTimeRegister()
    {
        $this->validate([
            'end_time_register' => 'after_or_equal:end_time'
        ], [
            'end_time_register.after' => 'Por favor revise la hora que esta registrando como salida',
        ]);


        if ($this->end_time_register <= $this->end_time) {
            $this->overtime_hours = 0;
        } else {
            $this->updateOvertime();
        }

    }
    public function updateOvertime()
    {
        if ($this->end_time && $this->end_time_register) {
            $end = Carbon::parse($this->end_time);
            $registeredEnd = Carbon::parse($this->end_time_register);

            $diffInMinutes = $end->diffInMinutes($registeredEnd);

            if ($diffInMinutes > 0 && $diffInMinutes< 24) {
                $this->overtime_hours = 0;
            } else if($diffInMinutes> 24 && $diffInMinutes<44) {
                $this->overtime_hours = 0.5;
            } else {
                $this->overtime_hours = (int) floor($diffInMinutes / 60) + 1; // Redondea hacia abajo al número entero más cercano
          
            }
                 
        }
    }
    public function render()
    {

        return view('livewire.incidences.create-incidence');
    }
}
