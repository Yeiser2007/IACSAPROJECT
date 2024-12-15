<?php

namespace App\Livewire\Employees;

use App\Models\Employees;
use App\Models\Vacations;
use Livewire\Component;
use Livewire\WithPagination;
use Carbon\Carbon;

class VacationsComponent extends Component
{
    public $search;

    public $endDate, $startDate, $comments, $employeeId,$messageDays,$daysOfVacation;
    public $sort = 'id';
    public $direction = 'desc';
    public $remainingDays = 0;

    public function mount()
    {
        
        $this->updatedEmployeeId();
        $this->calculateRemainingDays();
    }

    public function render()
    {
        $employees = Employees::all();
       //traer las vacaciones con la relacion de empleados
        $vacations = Vacations::whereHas('employee', function ($query) {
            $query->where('name', 'like', '%' . $this->search . '%')
                ->orWhere('last_name', 'like', '%' . $this->search . '%')
                ->orWhere('first_name', 'like', '%' . $this->search . '%');
        })
        ->with('employee')->orderBy($this->sort, $this->direction)->paginate(10);
        return view('livewire.employees.vacations-component', compact('employees','vacations'));
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
}
