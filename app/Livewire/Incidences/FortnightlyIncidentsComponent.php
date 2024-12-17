<?php

namespace App\Livewire\Incidences;

use App\Models\Employees;
use App\Models\Incidences;
use App\Models\WeeklyIncidences;
use Carbon\Carbon;
use DB;
use Livewire\Component;
use Livewire\WithPagination;

use Livewire\Attributes\On;
class FortnightlyIncidentsComponent extends Component
{
    use WithPagination;

    public $search;

    public $weeksOfYear = [];
    public $daysOfWeek = [];
    public $weekSelected;
    public $currentWeek;
    public $employeesData = [];

    public $startWeekSelected;
    public $endWeekSelected;

    protected $paginationTheme = "bootstrap";

    public function mount()
    {
        $this->weeksOfYear();
        $this->daysOfWeek($this->currentWeek);
    }

    public function render()
    {
        $employees = Employees::all();
        $incidencesGrouped = Incidences::select(
            'employee_id',
            DB::raw('SUM(overtime_hours) as total_overtime_hours'),
            DB::raw('SUM(sunday_premium) as total_sunday_premium'),
            DB::raw('COUNT(DISTINCT record_date) as total_days_registered'), // Contamos los días distintos registrados
            DB::raw('COUNT(*) as total_incidences_registered') // Contamos el n
        )
        ->with('employees')
        ->whereBetween('record_date', [$this->startWeekSelected, $this->endWeekSelected])
        ->groupBy('employee_id')
        ->get();
    
    $data = $incidencesGrouped->map(function ($incidence) {
        $employee = $incidence->employees;
    
        return [
            'employee_id' => $incidence->employee_id,
            'NOI' => $employee ? $employee->noi : 'Desconocido',
            'employee_number' => $employee ? $employee->employee_number : 'Desconocido',
            'jornada' => 'Día',
            'categoria' => $employee ? $employee->category : 'Desconocido',
            'daily_salary' => $employee ? $employee->daily_salary : 'Desconocido',
            'status' => $employee ? $employee->status : 'Desconocido',
            'overtime_hours' => $incidence->overtime_hours,
            'hire_date' => $employee ? $employee->hire_date : 'Desconocido',
            'salary' => $employee ? $employee->salary : 'Desconocido',
            'name' => $employee ? $employee->name . ' ' . $employee->first_name . ' ' . $employee->last_name : 'Desconocido',
            'total_overtime_hours' => $incidence->total_overtime_hours,
            'total_sunday_premium' => $incidence->total_sunday_premium,
            'total_days_registered' => $incidence->total_days_registered, // Total de días registrados
            'total_incidences_registered' => $incidence->total_incidences_registered, // Total de incidencias registradas

        ];
    })->toArray();
        return view('livewire.incidences.fortnightly-incidents-component', compact('employees','data'));
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
        $this->startWeekSelected = $startWeek;
        $this->endWeekSelected = $endWeek;
        $this->weekSelected = $this->currentWeek;
    }
    #[On('render')]
    public function handleUpdatedValue($week)
    {
        $this->weekSelected = $week;
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

        $this->startWeekSelected = $startWeek;
        $this->endWeekSelected = $endWeek;

    }
    public function updatedWeekSelected($numeroSemana)
    {
        $this->weekSelected = $numeroSemana;
        $this->daysOfWeek($numeroSemana);
    }
    public function generateIncidences()
    {
    }



}
