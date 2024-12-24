<?php

namespace App\Livewire\Incidences;

use App\Models\Employees;
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
    public $inputs = [];


    public $vacation_bonus,$vacations_days, $loan_charge_initial, $loan_partial, $loan_lapse, $balance, $comments, $punctuality_bonus;
    protected $paginationTheme = "bootstrap";

    public function mount()
    {
        $this->weeksOfYear();
        $this->daysOfWeek($this->currentWeek);
        $this->inputs = WeeklyIncidences::all()->keyBy('id')->map(function ($incidence) {
            return [
                'bonus' => $incidence->bonus,
                'vacation_days' => $incidence->vacation_days,
                'vacation_bonus' => $incidence->vacation_bonus,
                'loan_charge_initial' => $incidence->loan_charge_initial,
                'loan_partial' => $incidence->loan_charge_initial / ($incidence->loan_lapse ?: 1), 
                'loan_lapse' => $incidence->loan_lapse,
                'balance' => $incidence->loan_charge_initial - ($incidence->loan_charge_initial / ($incidence->loan_lapse ?: 1)),
                'infonavit' => $incidence->infonavit,
                'comments' => $incidence->comments,
            ];
        })->toArray();
    }
    
    public function render()
    {
        $employees = Employees::all();
        $incidencesByWeek = WeeklyIncidences::where('week', $this->weekSelected)
        ->with(['employee', 'vacation' => function ($query) {
            $query->where(function ($query) {
                $query->whereBetween('start_date', [$this->startWeekSelected, $this->endWeekSelected])
                      ->orWhereBetween('end_date', [$this->startWeekSelected, $this->endWeekSelected])
                      ->orWhere(function ($query) {
                          $query->where('start_date', '<=', $this->startWeekSelected)
                                ->where('end_date', '>=', $this->endWeekSelected);
                      });
            });
        }])
        ->orderBy('employee_id')
        ->paginate(7);
    
        return view('livewire.incidences.weekly-incidents-component',compact('incidencesByWeek','employees'));
    }

    public function weeksOfYear()
    {
        $currentDate = Carbon::now();

        $this->currentWeek = $currentDate->weekOfYear-1;
        $lastWednesdayPrevYear = Carbon::now()->subYear()->endOfYear()->startOfWeek(4);

        for ($week = 0; $week <= $this->currentWeek; $week++) {
            $startWeek = $lastWednesdayPrevYear->copy()->addWeeks($week);
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

    public function updated($field)
{
    if (preg_match('/inputs\.(\d+)\.(.+)/', $field, $matches)) {
        $id = $matches[1];
        $key = $matches[2];

        if (in_array($key, ['loan_charge_initial', 'loan_lapse'])) {
            $loanChargeInitial = $this->inputs[$id]['loan_charge_initial'] ?? 0;
            $loanLapse = $this->inputs[$id]['loan_lapse'] ?? 1;
            $this->inputs[$id]['loan_partial'] = $loanLapse > 0 ? $loanChargeInitial / $loanLapse : 0;
            $this->inputs[$id]['balance'] = $loanChargeInitial - $this->inputs[$id]['loan_partial'];
        }
    }
}

    public function generateIncidences()
    {
        $incidencesGrouped = Incidences::select(
            'employee_id',
            DB::raw('SUM(CASE WHEN overtime_hours > 0 THEN overtime_hours ELSE 0 END) as total_overtime_hours'),
            DB::raw('SUM(sunday_premium) as total_sunday_premium'),
            DB::raw('SUM(holiday) as total_holiday'),
            DB::raw('COUNT(DISTINCT record_date) as total_days_registered'),
            DB::raw('COUNT(*) as total_incidences_registered'),
            DB::raw('SUM(CASE WHEN abilitations.salary IS NOT NULL THEN abilitations.salary - employees.daily_salary ELSE 0 END) as total_adjusted_salary')
        )
        ->join('employees', 'incidences.employee_id', '=', 'employees.id') // Asegura la relación con empleados.
        ->leftJoin('abilitations', 'incidences.abilitation_id', '=', 'abilitations.id') // Relación con abilitations.
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
        
                 $faver = WeeklyIncidences::updateOrCreate(
                    [
                        'week' => $this->weekSelected,
                        'employee_id' => $incidence->employee_id,
                    ],
                    [
                        'vacation_days' =>0,
                        'double_hours' => $doubleHours,
                        'triple_hours' => $tripleHours,
                        'sunday_premium' => $incidence->total_sunday_premium,
                        'days_worked' => $incidence->total_days_registered,
                        'holiday_worked' => $incidence->total_holiday,
                        'abilitation' => $incidence->total_adjusted_salary,
                        'vacation_bonus' => 0,
                        'loan_charge_initial' => 0,
                        'loan_partial' => 0,
                        'loan_lapse' => 0,
                        'balance' => 0,
                        'fair_bonus_vacation' => 0,
                        'punctuality_bonus' => 0,
                        'turn' => 'mixto',
                        'comments' => null,
                    ]
                );
        }
        

        session()->flash('success', 'Registros generados correctamente.');
        return redirect()->route('incidencias-semanales.index');
    }
    public function update($id)
{
    if (!isset($this->inputs[$id])) {
        return;
    }

    $validatedData = $this->validate([
        "inputs.$id.vacation_bonus" => 'nullable|numeric',
        "inputs.$id.vacation_days" => 'nullable|numeric',
        "inputs.$id.loan_charge_initial" => 'nullable|numeric',
        "inputs.$id.loan_partial" => 'nullable|numeric',
        "inputs.$id.loan_lapse" => 'nullable|numeric',
        "inputs.$id.balance" => 'nullable|numeric',
        "inputs.$id.bonus" => 'nullable|numeric',
        "inputs.$id.comments" => 'nullable|string|max:255',
        "inputs.$id.infonavit" => 'nullable|string|in:SI,NO',
    ]);

    // Actualizar la incidencia
    $incidence = WeeklyIncidences::findOrFail($id);
    $incidence->update($validatedData['inputs'][$id]);
    $incidence->status = 'actualizado';
    $incidence->save();

    session()->flash('success', 'Incidencia actualizada correctamente.');
    return redirect()->route('incidencias-semanales.index');
}
public function changeStatus($id)
{
    $incidence = WeeklyIncidences::findOrFail($id);
    $incidence->status = 'pendiente';
    $incidence->save();
    session()->flash('message', 'Incidencia actualizada correctamente.');
}
}
