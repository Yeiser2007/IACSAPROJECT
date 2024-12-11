<?php

namespace App\Livewire\Incidences;

use Livewire\Component;
use App\Models\Employees;
use App\Models\Incidences;
use Carbon\Carbon;
class IncidencesC extends Component
{
  
    public $start_time = '09:00';
    public $end_time = '17:00';
    public $end_time_register;
    public $overtime_hours = 0;
    public $search = '';
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
    public function render()
    {
        if (empty($this->weekSelected)) {
            return view('livewire.incidences.incidencesC', [
                'incidencesByEmployee' => []
            ]);
        }
    
        $this->daysOfWeek($this->weekSelected);

        $registros = Incidences::whereIn('record_date', array_column($this->daysOfWeek, 'fecha'))
            ->with('employees:id,name') // Relación correctamente cargada
            ->get();
        
        $incidencesByEmployee = $registros->groupBy('employee_id')->map(function ($registrosUsuario) {
            $employee = $registrosUsuario->first()->employees; // Obtener empleado del primer registro
            return [
                'employees' => [
                    'id' => $employee->id,
                    'name' => $employee->name,
                ],
                'totalHours' => $registrosUsuario->sum('overtime_hours'),
                'sundayPremium' => $registrosUsuario->where('sunday_premium', 1)->count(),
                'incidences' => $registrosUsuario->groupBy(function ($registro) {
                    return Carbon::parse($registro->record_date)->locale('es')->dayName;
                }),
            ];
        });
        return view('livewire.incidences.incidencesC', compact('incidencesByEmployee'));
    }
    public function mount()
    {
        $this->weeksOfYear();
        $this->daysOfWeek($this->currentWeek);
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


    public function updatedDaySelected($daySelected)
    {
        if ($daySelected) {
            $this->usersWithoutIncidence = $this->getUsers($daySelected);
        } else {
            // Manejar el caso cuando no se ha seleccionado un día
            $this->usersWithoutIncidence = [];
        }
    }
    
    public function getUsers($daySelected)
    {
        $date = Carbon::parse($daySelected)->toDateString();
        $excludedEmployeeIds = Incidences::whereDate('record_date', $date)
            ->pluck('employee_id')
            ->toArray();
        $users = Employees::whereNotIn('id', $excludedEmployeeIds)->get();
    
        return $users;
    }

    public function updatedEndTime()
    {
        $this->updateOvertime();
    }

    public function updatedEndTimeRegister()
    {
        $this->validate([
            'end_time_register' => 'required|after:end_time'
        ], [
            'end_time_register.after' => 'Por favor revise la hora que esta registrando como salida',
        ]);


        if ($this->end_time_register < $this->end_time) {
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

            if ($diffInMinutes < 0) {
                $this->overtime_hours = 0;
            } else {
                $this->overtime_hours = (int) floor($diffInMinutes / 60) + 1; // Redondea hacia abajo al número entero más cercano
            }
        }
    }
    public function submit()
    {
        $sunday = null;
        $this->validate([
            'start_time' => 'required',
            'end_time' => 'required',
            'end_time_register' => 'required|after:end_time',
            'daySelected' => 'required',
            'weekSelected' => 'required',
        ]);
        $carbonDate = Carbon::parse($this->daySelected);  
        if ($carbonDate->isSunday()) {
            $sunday = 1;
        } 

        Incidences::create([
            'employee_id' => $this->userSelected,
            'record_date' => $this->daySelected,
            'entry_time' => $this->start_time,
            'exit_time' => $this->end_time_register,
            'overtime_hours' => $this->overtime_hours,
            'sunday_premium' => $sunday,
            'reason' => $this->reason,
            'comments' => $this->comments,
            'user_id' => auth()->user()->id

        ]);
        session()->flash('success', 'La incidencia se registro correctamente.');

    return redirect()->route('incidencias.index');
    }

    
    
}
