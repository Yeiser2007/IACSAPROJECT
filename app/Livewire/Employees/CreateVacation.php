<?php

namespace App\Livewire\Employees;

use App\Models\Employees;
use App\Models\Vacations;
use Carbon\Carbon;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\On; 

class CreateVacation extends Component
{
    use WithPagination;
    public $endDate, $startDate, $comments, $employeeId,$messageDays,$daysOfVacation,$days=0;
    public $id,$yearsOfWork,$remainingDays,$hireDate,$employeeName;
    
    public function mount($id){
        $this->id = $id;
        $this->updatedEmployeeId();
        $this->calculateRemainingDays();
        $this->updateDataEmployee();
        $this->daysOfVacation();
    }
    #[On('create-vacation')] 
    public function updatePostList($title)
    {
        $this->id = $title;

    }
    public function render()
    {
        $employees = Employees::all();
        return view('livewire.employees.create-vacation',compact('employees'));
    }
    public function updatedEndDate()
    {
        $this->calculateRemainingDays();
    }

    public function updatedStartDate()
    {
        $this->endDate = $this->startDate;
        $this->calculateRemainingDays();
    }

    public function updatedEmployeeId()
    {
        $this->employee = Employees::find($this->id);
        $this->employeeName = $this->employee->name . ' ' . $this->employee->first_name . ' ' . $this->employee->last_name;
        $vacation = Vacations::where('employee_id', $this->employeeId)->latest()->first();
        if ($vacation) {
            $this->daysOfVacation = $vacation->days; 
            $this->remainingDays = $vacation->remaining_days;
        } else {
            $this->daysOfVacation = 0;
        }
    }
    private function calculateRemainingDays()
    {
        if ($this->startDate && $this->endDate ) {
            try {
                $start = Carbon::parse($this->startDate);
                $end = Carbon::parse($this->endDate);
                $diff = $start->diffInDays($end);
                if ($this->daysOfVacation < 0) {
                    $this->messageDays = "la fecha de inicio debe ser menor a la fecha de fin";
                    return;
                }
                elseif ( $start == $end ) {
                    $this->daysOfVacation = $this->daysOfVacation - 1;
                    $this->remainingDays = $this->remainingDays + 1;
                }else{
                    $this->remainingDays = $this->remainingDays + $diff;
                    $this->daysOfVacation = $this->daysOfVacation - $diff;
                }    
                if ($this->daysOfVacation < 0) {;
                    $this->messageDays = "El empleado seleccionado ha agotado sus días de vacaciones  ";
                    session()->flash('error', 'El empleado seleccionado ha agotado sus días de vacaciones  ');
                    return redirect()->route('empleados.vacaciones');
                }else{
                    $this->messageDays = null;
                }
            } catch (\Exception $e) {
                $this->remainingDays = 0;
            }
        }
    }
    public function saveVacation()
    {
        $this->validate([
            'employeeId' => 'required',
            'comments' => 'required',
            'startDate' => 'required',
            'endDate' => 'required',
            'daysOfVacation' => 'required|numeric|min:0|max:' . $this->daysOfVacation
        ]);
            
            $vacation = new Vacations();
            $vacation->employee_id = $this->employeeId;
            $vacation->start_date = $this->startDate;
            $vacation->end_date = $this->endDate;
            $vacation->remaining_days = $this->remainingDays;
            $vacation->days = $this->daysOfVacation;
            $vacation->comments = $this->comments;
            $vacation->save();
            session()->flash('success', 'La solicitud de vacaciones se registro correctamente.');
            return redirect()->route('empleados.vacaciones');
    }
    public function updateDataEmployee(){
        $employee = Employees::find($this->id);
        $this->yearsOfWork = $employee->seniority_days;
        $this->hireDate = $employee->hire_date;
    }
    public function daysOfVacation(){

        if($this->yearsOfWork < 2){
            $this->days = 12;
        }
        else if($this->yearsOfWork < 3){
            $this->days = 14;
        }
        else if($this->yearsOfWork < 4){
            $this->days = 16;
        }
        else if($this->yearsOfWork  <  5){
            $this->days = 18;
        }    
        else if($this->yearsOfWork < 6){
            $this->days = 20;
        }
        else if($this->yearsOfWork >=6 && $this->yearsOfWork < 11){
            $this->days = 22;
        }
        else if($this->yearsOfWork >= 11 && $this->yearsOfWork < 16){
            $this->days = 24;
        }
        else if($this->yearsOfWork >= 16 && $this->yearsOfWork < 21){
            $this->days = 26;
        }
        else if($this->yearsOfWork >= 21 && $this->yearsOfWork < 26){
            $this->days = 28;
        }
        else if($this->yearsOfWork >= 21 && $this->yearsOfWork < 26){
            $this->days = 30;
        }
    }
}
