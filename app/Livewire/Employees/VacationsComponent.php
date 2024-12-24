<?php

namespace App\Livewire\Employees;

use App\Models\Employees;
use App\Models\Vacations;
use Livewire\Component;
use Livewire\WithPagination;
use Carbon\Carbon;

class VacationsComponent extends Component
{
    use WithPagination;
    public $search;
    public $endDate, $startDate, $comments, $employeeId,$messageDays,$daysOfVacation;
    public $sort = 'id';
    public $direction = 'desc';
    public $remainingDays = 0;
    public $days = 0;


    public function mount()
    {

    }

    public function render()
    {
        $employees = Employees::all();
        $vacations = Vacations::whereHas('employee', function ($query) {
            $query->where('name', 'like', '%' . $this->search . '%')
                ->orWhere('last_name', 'like', '%' . $this->search . '%')
                ->orWhere('first_name', 'like', '%' . $this->search . '%');
        })
        ->with('employee')
        ->orderBy($this->sort, $this->direction) // Orden general para el resultado final
        ->get();
        
        // Agrupar por empleado y obtener el último registro de cada grupo
        $vacationsGrouped = $vacations->groupBy('employee_id')->map(function ($vacationGroup) {
            return $vacationGroup->sortByDesc('created_at')->first(); // Ordena por la fecha de creación
        });
    
        return view('livewire.employees.vacations-component', compact('employees', 'vacationsGrouped'));
    }
    
    public function addVacation(){
        return route('empleados.vacaciones-agregar');
    }
    public function redirectToVacationForm($employeeId)
    {
        $this->dispatch('create-vacation', id: $employeeId);
        return redirect()->route('vacations.create', ['employee_id' => $employeeId]);
    }
    public function daysOfVacation($yearsOfWork){

        if($yearsOfWork >= 0 && $yearsOfWork < 1){
            $this->days = 0;
        }
        else if($yearsOfWork >=1 && $yearsOfWork < 2){
            $this->days = 12;
        }
        else if($yearsOfWork >=2 && $yearsOfWork < 3){
            $this->days = 14;
        }
        else if($yearsOfWork >=3 && $yearsOfWork < 4){
            $this->days = 16;
        }
        else if($yearsOfWork >=4 && $yearsOfWork < 5){
            $this->days = 18;
        }    
        else if($yearsOfWork >=65&& $yearsOfWork < 6){
            $this->days = 20;
        }
        else if($yearsOfWork >=6 && $yearsOfWork < 11){
            $this->days = 22;
        }
        else if($yearsOfWork >= 11 && $yearsOfWork < 16){
            $this->days = 24;
        }
        else if($yearsOfWork >= 16 && $yearsOfWork < 21){
            $this->days = 26;
        }
        else if($yearsOfWork >= 21 && $yearsOfWork < 26){     
            $this->days = 28;
        }
        else if($yearsOfWork >= 21 && $yearsOfWork < 26){
            $this->days = 30;
        }
    }
    public function calculateDaysOfVacation(){
        $employee = Employees::all();
        foreach ($employee as $e) {
            $this->daysOfVacation($e->seniority_days);
            $vacation = Vacations::where('employee_id', $e->id)->first(); 
            $vacation->days = $this->days;
            $vacation->remaining_days = 0;
            $vacation->save();
    }
    session()->flash('success', 'La solicitud de vacaciones se registro correctamente.');
    return redirect()->route('empleados.vacaciones');
  }
    
}
