<?php

namespace App\Livewire\Incidences;


use App\Models\Abilitations;
use App\Models\Employees;
use App\Models\Incidences;
use Livewire\Attributes\On;
use Livewire\Component;
use Carbon\Carbon;
use Livewire\WithPagination;

class IncidencesComponent extends Component
{
    use WithPagination;
    public $daysOfWeek = [];
    public $weeksOfYear = [];
    public $currentWeek;
    public $weekSelected;
    public $weekSelect;
    public $search = '';
    protected $paginationTheme = 'bootstrap';
    public $sort = 'id';
    public $direction = 'asc';
    public $comments;
    public $reasons;
    public $overtimeHours;
    public $abilitation;
    public $exitTime;
    public $recordedSchedule; 
    public $entryTime = '08:00';
    public $daysSelected = [];
    protected $listeners = ['render' => 'handleUpdatedValue'];
    

    public function showModal()
    {
        $this->modalVisible = true;
    }

    public function mount()
    {
        $this->weeksOfYear();
        $this->daysOfWeek($this->currentWeek);
    }
    #[On('render')]
    public function handleUpdatedValue($week)
    {
        $this->weekSelected = $week;
    }
    public function weeksOfYear()
    {
        $currentDate = Carbon::now();

        $this->currentWeek = $currentDate->weekOfYear-1;

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
        if ($numberOfWeek == 0) {
            $startWeek = Carbon::now()->subYear()->endOfYear()->startOfWeek(4);
        } else {
            $startWeek = Carbon::now()->startOfYear()->addWeeks($numberOfWeek)->startOfWeek(4);
        }
        $endWeek = $startWeek->copy()->addDays(6);
        $this->daysOfWeek = [];
        for ($date = $startWeek->copy(); $date->lte($endWeek); $date->addDay()) {
            $this->daysOfWeek[] = [
                'fecha' => $date->toDateString(),
                'nombre' => $date->locale('es')->isoFormat('dddd'),
            ];
        }
    }
    
    public function render()
    {
        if ($this->weekSelected == null) {
            return view('livewire.incidences.incidences-component', [
                'incidencesByEmployee' => []
            ]);
        }

        $this->daysOfWeek($this->weekSelected);

        $registros = Incidences::whereIn('record_date', array_column($this->daysOfWeek, 'fecha'))
            ->with('employees:id,name,first_name,last_name')
            ->with('abilitations:id,name,salary')
            ->whereHas('employees', function ($query) {
                $query->where('name', 'like', '%' . $this->search . '%');
            })
            ->get();

        $incidencesByEmployee = $registros->groupBy('employee_id')->map(function ($registrosUsuario) {
            $employee = $registrosUsuario->first()->employees; // Obtener empleado del primer registro
            return [
                'employees' => [
                    'id' => $employee->id,
                    'name' => $employee->name,
                    'first_name' => $employee->first_name,
                    'last_name' => $employee->last_name
                ],
                'totalHours' => $registrosUsuario->sum('overtime_hours'),
                'sundayPremium' => $registrosUsuario->where('sunday_premium', 1)->count(),
                'holiday' => $registrosUsuario->where('holiday', 1)->count(),
                'incidences' => $registrosUsuario->groupBy(function ($registro) {
                    return Carbon::parse($registro->record_date)->locale('es')->dayName;

                }),
                
            ];
        });
        // dd($incidencesByEmployee);
        return view('livewire.incidences.incidences-component', compact('incidencesByEmployee'));
    }
    public function showExtras($id,$entryTime, $exit_time, $recorded_schedule, $hours, $comments, $reasons, $abilitation_id)
    {
        $employeeSalary = Employees::find($id);
        $this->overtimeHours = $hours;
        $this->comments = $comments;
        $this->reasons = $reasons;
        $abilitation_id = Abilitations::find($abilitation_id);
        $this->abilitation = $abilitation_id->salary - $employeeSalary->daily_salary;
        $this->exitTime = $exit_time;
        $this->recordedSchedule = $recorded_schedule;
        $this->entryTime = $entryTime;
    }
    public function generateIncidences()
    {
        $selectedDays = collect($this->daysSelected)->filter(function ($isSelected) {
            return $isSelected; 
        })->keys(); 
    
        $daysOfWeekFiltered = array_filter($this->daysOfWeek, function ($day) use ($selectedDays) {
            return true; // Mantener todos los días para procesarlos.
        });
    
        $employees = Employees::where('status', 'Alta')->get();
        
        foreach ($employees as $employee) {
            foreach ($daysOfWeekFiltered as $day) {
                $fecha = Carbon::parse($day['fecha']);
                $exists = Incidences::where('employee_id', $employee->id)
                    ->where('record_date', $day['fecha'])
                    ->exists();
    
                if (!$exists) {
                    $isSunday = $fecha->isSunday();
                    $isHoliday = $selectedDays->contains($day['nombre']);
    
                    if ($isSunday || $isHoliday) {
                        $recordedSchedule = $isHoliday ? 'Festivo' : 'Descanso';
                        $entryTime = null;
                        $exitTime = null;
                    } else {
                        $recordedSchedule = $fecha->isSaturday() ? '13:00' : '17:00';
                        $entryTime = '08:00';
                        $exitTime = $recordedSchedule;
                    }
    
                    Incidences::create([
                        'employee_id' => $employee->id,
                        'record_date' => $day['fecha'],
                        'recorded_schedule' => $recordedSchedule,
                        'entry_time' => $entryTime,
                        'exit_time' => $exitTime,
                        'overtime_hours' => 0,
                        'sunday_premium' => 0,
                        'user_id' => auth()->user()->id,
                        'holiday' => $isHoliday ? 'Si' : '',
                        'abilitation_id' => null,
                        'reason' => '',
                        'comments' => '',
                    ]);
                }
            }
        }
        $this->dispatch('reloadPage');  
    }
    

}
