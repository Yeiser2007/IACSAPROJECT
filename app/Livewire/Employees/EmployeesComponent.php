<?php

namespace App\Livewire\Employees;

use App\Models\EmployeeExternal;
use App\Models\EmployeeInternal;
use App\Models\Employees;
use Livewire\Component;
use Livewire\WithPagination;

class EmployeesComponent extends Component
{
    use WithPagination;
    public $search;
    public $name;
    public $noi;
    public $first_name;
    public $last_name;
    public $employee_number;
    public $curp;
    public $rfc;
    public $img_url;
    public $employeeData;
    public $employee_type;
    public $imms_number;
    public $id;
    public $idByUser=1;
    protected $paginationTheme = 'bootstrap';   
    public $sort='id';
    public $direction = 'asc';
    public function render()
    {
        $employees = Employees::where('employee_number', 'like', '%' . $this->search . '%')
        ->orWhere('name', 'like', '%' . $this->search . '%')
        ->orWhere('noi', 'like', '%' . $this->search . '%')
        ->orderBy($this->sort, $this->direction)
        ->paginate();

        return view('livewire.employees.employees-component',compact('employees'));
    }
    public function destroy($id){
        $user = Employees::find($id);
        $user->delete();
        session()->flash('Alert', 'El empleado se ha eliminado correctamente.');
        return redirect()->route('empleados.index');
    }
    public function assignName($id,$name){
        $this->name = $name;
        $this->id = $id;
    }
    public function showModal($id,$noi,$name,$first_name,$last_name,$employee_number,$curp,$rfc,$img_url,$imms_number){
        $this->idByUser = $id;
        $this->noi = $noi;
        $this->name = $name;
        $this->first_name = $first_name;
        $this->last_name = $last_name;
        $this->employee_number = $employee_number;
        $this->curp = $curp;
        $this->rfc = $rfc;
        $this->img_url = $img_url;
        $this->imms_number = $imms_number;
    }
    public function showInfo($employee_id,$employee_type){
        if($employee_type == 'EXTERNO'){
            $this->employee_type = 'EXTERNO';
            $this->employeeData = EmployeeExternal::where('employee_id', $employee_id)->first();
        }elseif($employee_type == 'INTERNO'){
            $this->employee_type = 'INTERNO';
            $this->employeeData = EmployeeInternal::where('employee_id', $employee_id)->first();
        }
        
    }
    public function order($sort){
        if($this->sort == $sort){
            $this->direction = $this->direction == 'asc' ? 'desc' : 'asc';
        }else{
            $this->sort = $sort;
            $this->direction = 'asc';
        }
        $this->sort = $sort;
    }
}
