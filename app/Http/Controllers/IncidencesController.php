<?php

namespace App\Http\Controllers;

use App\Exports\IncidencesExport;
use App\Models\Abilitations;
use App\Models\Incidences;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class IncidencesController extends Controller
{
    public $daysOfWeek = [];
    public $dayStart;
    public $dayEnd;
    public $week;
    public $month;
    public $year;
    public $recorded_schedule="";
    public $sunday="0";
    public $holiday="0";
    public $comments;

    public function index()
    {
        return view('incidences.incidences');
    }   

    public function edit(){
        return view('incidences.edit-incidence');

    }
    public function update(Request $request,$id){
    //  return $request;
        $carbonDate = Carbon::parse($request->record_date);  
        if ($carbonDate->isSunday()) {
            $this->sunday = '1';
        } 
        if ($request->holiday == "on") {
            $this->holiday = '1';
        }
        if($request->status=="on"){
            $this->recorded_schedule = "Falta";
            $this->comments = "Falta";
        }else{
            $this->recorded_schedule = $request->recorded_schedule;
            $this->comments = $request->comments;
        }  


        $incidence = Incidences::where('employee_id', $id)
        ->where('record_date', $request->record_date)
        ->first();
       if($incidence){
        $incidence->update([
            'employee_id' => $request->employee_id,
            'record_date' => $request->record_date,
            'entry_time' => $request->start_time,
            'exit_time' => $request->end_time,  
            'recorded_schedule' => $this->recorded_schedule,
            'overtime_hours' => $request->overtime_hours,
            'sunday_premium' => $this->sunday,
            'holiday' => $this->holiday,
            'reason' => $request->reason,
            'comments' => $this->comments,
            'user_id' => auth()->user()->id,
            'abilitation_id' => $request->abilitation_id
        ]);
        session()->flash('success', 'La incidencia se Actualizo correctamente.');
    }else{
        $incidence = Incidences::create([
            'employee_id' => $request->employee_id,
            'record_date' => $request->record_date,
            'entry_time' => $request->start_time,
            'exit_time' => $request->end_time,
            'recorded_schedule' => $this->recorded_schedule,
            'overtime_hours' => $request->overtime_hours,
            'sunday_premium' => $this->sunday,
            'holiday' => $this->holiday,
            'reason' => $request->reason,
            'comments' => $this->comments,
            'user_id' => auth()->user()->id,
            'abilitation_id' => $request->abilitation_id
        ]);
        session()->flash('success', 'La incidencia se registro correctamente.');
    }
       
        return redirect()->route('incidencias.index');
    }
    public function addAbilitation(Request $request){
        $abilitation = new Abilitations();
        $abilitation->name = $request->name;
        $abilitation->salary = $request->salary;
        $abilitation->save();
        
        session()->flash('success', 'La abilitacion se registro correctamente.');
        return redirect()->route('incidencias.index');
    }
   
    public function daysOfWeek($week)
    {
        Carbon::setLocale('es');
        $numberOfWeek = intval($week);
        $startWeek = Carbon::now()->startOfYear()->addWeeks($numberOfWeek)->startOfWeek(4);
        $endWeek = $startWeek->copy()->addDays(6);
        $this->dayStart = $startWeek->format('d');
        $this->dayEnd = $endWeek->format('d');
        $this->month = $startWeek->format('M');
        $this->year = $startWeek->format('Y');
        $this->daysOfWeek = [];
        for ($date = $startWeek->copy(); $date->lte($endWeek); $date->addDay()) {
            $this->daysOfWeek[] = [
                'fecha' => $date->toDateString(),
                'nombre' => $date->locale('es')->isoFormat('dddd'),
            ];
        }
    }
    public function getIncidencesByEmployee($week)
{
    $this->daysOfWeek($week);

    $registros = Incidences::whereIn('record_date', array_column($this->daysOfWeek, 'fecha'))
        ->with('employees:id,name,first_name,last_name,daily_salary')
        ->get();

    return $registros->groupBy('employee_id')->map(function ($registrosUsuario) {
        $employee = $registrosUsuario->first()->employees;

        return [
            'employees' => [
                'id' => $employee->id,
                'name' => $employee->name,
                'first_name' => $employee->first_name,
                'last_name' => $employee->last_name,
            ],
            'totalHours' => $registrosUsuario->sum('overtime_hours'),
            'sundayPremium' => $registrosUsuario->where('sunday_premium', 1)->count(),
            'holiday' => $registrosUsuario->where('holiday', 1)->count(),
            'incidences' => $registrosUsuario->groupBy(function ($registro) {
                return Carbon::parse($registro->record_date)->locale('es')->dayName;
            }),
        ];
    });
}

    public function exportIncidences($week)
    {
        $incidencesByEmployee = $this->getIncidencesByEmployee($week);
        // return $incidencesByEmployee;
        return Excel::download(new IncidencesExport($incidencesByEmployee,$week,$this->month,$this->year,$this->dayStart,$this->dayEnd), '4.-REPORTE SEMANAL  INCIDENCIAS  IACSA NO. '.$week.'.xlsx');
    }


}
