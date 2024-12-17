<?php

namespace App\Livewire\Incidences;

use App\Models\Incidences;
use App\Models\Vacations;
use App\Models\WeeklyIncidences;
use Carbon\Carbon;
use DB;
use Livewire\Component;
use Livewire\WithPagination;

class WeeklyIncidentsComponent extends Component
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
        $incidencesByWeek = WeeklyIncidences::where('week', $this->weekSelected)
        ->with('employee')
        ->orderBy('employee_id')
        ->get();
        return view('livewire.incidences.weekly-incidents-component',compact('incidencesByWeek'));
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
        $incidencesGrouped = Incidences::select(
            'employee_id',
     DB::raw('SUM(CASE WHEN overtime_hours > 0 THEN overtime_hours ELSE 0 END) as total_overtime_hours'),
            DB::raw('SUM(sunday_premium) as total_sunday_premium'),
            DB::raw('SUM(CASE WHEN holiday > 0 THEN holiday ELSE 0 END) as total_holiday'),
            DB::raw('COUNT(DISTINCT record_date) as total_days_registered'),
            DB::raw('COUNT(*) as total_incidences_registered')
        )
        ->with('employees')
        ->whereBetween('record_date', [$this->startWeekSelected, $this->endWeekSelected])
        ->groupBy('employee_id')
        ->get();
        if ($incidencesGrouped->isEmpty()) {
            session()->flash('error', 'No se encontraron incidencias para la semana seleccionada.');
            return redirect()->route('incidencias-semanales.index');
        }

        foreach ($incidencesGrouped as $incidence) {
            $employee = $incidence->employees;
            $vacation_id = Vacations::where('employee_id', $incidence->employee_id)->latest()->first();
                $totalOvertime = $incidence->total_overtime_hours;
                $doubleHours = min($totalOvertime, 9); // Máximo 9 horas dobles
                $tripleHours = max($totalOvertime - 9, 0); // Horas extras restantes como triples
        
                WeeklyIncidences::updateOrCreate(
                    [
                        'week' => $this->weekSelected,
                        'employee_id' => $incidence->employee_id,
                    ],
                    [
                        'vacation_id' => $vacation_id ? $vacation_id->id : null,
                        'double_hours' => $doubleHours,
                        'triple_hours' => $tripleHours,
                        'sunday_premium' => $incidence->total_sunday_premium,
                        'days_worked' => $incidence->total_days_registered,
                        'vacation_bonus' => 0,
                        'loan_charge_initial' => 0,
                        'loan_partial' => 0,
                        'loan_lapse' => 0,
                        'balance' => 0,
                        'fair_bonus_vacation' => 0,
                        'punctuality_bonus' => 0,
                        'turn' => 'mixto',
                        'comments' => null,
                        'holidays_worked' => $incidence->total_holiday,
                    ]
                );
        }
        

        session()->flash('success', 'Registros generados correctamente.');
        return redirect()->route('incidencias-semanales.index');
    }
}
