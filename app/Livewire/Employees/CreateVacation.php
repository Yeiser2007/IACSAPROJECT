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
    public $endDate, $startDate, $comments, $employeeId,$messageDays,$days=0;

    public $id,$yearsOfWork,$remainingDays,$hireDate,$employeeName,$daysTaken;
    
    public function mount($id){
        $this->id = $id;
        $this->updateDataVacation();
        $this->calculateRemainingDays();
        $this->updateDataEmployee();
    }
    #[On('create-vacation')] 
    public function updatePostList($title)
    {
        $this->id = $title;

    }
    public function getDays(){
        $daysOfVacation = Vacations::where('employee_id', $this->id)->first();
        $this->days = $daysOfVacation->days;
    }
    public function render()
    {
        $vacations = Vacations::where('employee_id', $this->id)
        ->whereNotNull('start_date')
        ->get();
        return view('livewire.employees.create-vacation',compact('vacations'));
    }
    public function updatedDaysTaken(){
        $this->calculateRemainingDays();
    }

    public function updatedStartDate()
    {
        $this->calculateRemainingDays();
    }

 
    private function calculateRemainingDays()
    {
        if ($this->startDate && $this->daysTaken ) {
            try {
                $start = Carbon::parse($this->startDate);
                $end = $start->copy()->addDays((int)$this->daysTaken);
                $this->endDate = $end->toDateString();
                $diff = $start->diffInDays($end);
                $this->days = $this->days - $this->daysTaken;
                if ($this->days < 0) {
                    $this->messageDays = "El empleado seleccionado ha agotado sus días de vacaciones  ";
                    session()->flash('error', 'El empleado seleccionado ha agotado sus días de vacaciones  ');
                    return redirect()->route('empleados.vacaciones');
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
            'remainingDays' => 'required|numeric|min:0',
            'days' => 'required|numeric|min:0'
        ]);
            
            $vacation = new Vacations();
            $vacation->employee_id = $this->employeeId;
            $vacation->start_date = $this->startDate;
            $vacation->end_date = $this->endDate;
            $vacation->remaining_days = $this->remainingDays + $this->daysTaken;
            $vacation->days = $this->days;
            $vacation->comments = $this->comments;
            $vacation->save();
            session()->flash('success', 'La solicitud de vacaciones se registro correctamente.');
            return redirect()->route('empleados.vacaciones');
    }
    public function updateDataEmployee(){
        $employee = Employees::find($this->id);
        $this->employeeName = $employee->name . ' ' . $employee->first_name . ' ' . $employee->last_name;
        $this->yearsOfWork = $employee->seniority_days;
        $this->hireDate = $employee->hire_date;
    }
    public function updateDataVacation(){
        $vacation = Vacations::where('employee_id', $this->id)->latest()->first();
        $this->employeeId = $vacation->employee_id;
        $this->days = $vacation->days;
        $this->remainingDays = $vacation->remaining_days;
    }
}
