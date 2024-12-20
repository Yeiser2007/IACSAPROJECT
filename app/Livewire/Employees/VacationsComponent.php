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

    public function mount()
    {

    }

    public function render()
    {
        // Obtener todos los empleados
        $employees = Employees::all();
    
        // Obtener las vacaciones de los empleados, filtradas por el nombre del empleado
        $vacations = Vacations::whereHas('employee', function ($query) {
            $query->where('name', 'like', '%' . $this->search . '%')
                ->orWhere('last_name', 'like', '%' . $this->search . '%')
                ->orWhere('first_name', 'like', '%' . $this->search . '%');
        })
        ->with('employee') // Incluir los datos del empleado relacionado
        ->orderBy($this->sort, $this->direction) // Ordenar según el criterio proporcionado
        ->paginate(10); // Paginación para mostrar 10 elementos por página

        $vacationsGrouped = $vacations->groupBy('employee_id')->map(function ($vacationGroup) {
            return $vacationGroup->first();
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
    
}
