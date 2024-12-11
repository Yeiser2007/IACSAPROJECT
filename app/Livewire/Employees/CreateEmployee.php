<?php

namespace App\Livewire\Employees;

use App\Models\EmployeeExternal;
use App\Models\EmployeeInternal;
use App\Models\Employees;
use Livewire\Component;
use Carbon\Carbon;
use Livewire\WithFileUploads;

class CreateEmployee extends Component
{
    use WithFileUploads;
    public $noi;
    public $employee_number;
    public $name;
    public $first_name;
    public $last_name;
    public $category;
    public $daily_salary;
    public $status;
    public $hire_date;
    public $termination_date;
    public $gender;
    public $payroll_type;
    public $rfc;
    public $curp;
    public $imms_number;
    public $seniority_days;
    public $employee_type;
    public $age;
    public $phone;
    public $full_address;
    public $license_vehicle;
    public $familiar_phone;
    public $descount_infonavit;
    public $descount_FONACOT;
    public $job;

    public $work_code;
    public $postal_code;
    public $integrated_daily_salary;
    public $level_study;
    public $residencia;
    public $state;
    public $residence;
    public $img;
    public $currentStep = 1;
    public $payment_type;

    public function render()
    {
        $current_date = Carbon::now()->startOfDay();;
        if (!empty($this->hire_date)) {
            $start_date = Carbon::parse($this->hire_date)->startOfDay(); 
            $this->seniority_days = $start_date->diffInDays($current_date)-1;
        } else {
            $this->seniority_days = 0; // O cualquier otro valor que consideres adecuado
        }
        return view('livewire.employees.create-employee');
    }

    public function nextStep()
    {
        $this->validate($this->getValidationRules());
        $this->currentStep++;
    }

    public function previousStep()
    {
        $this->currentStep--;
    }

    private function getValidationRules()
    {
        switch ($this->currentStep) {
            case 1:
                return [
                    'noi' => 'required|numeric|max:255|unique:employees,noi' ,
                    'employee_number' => 'required|numeric|max:255|unique:employees,employee_number',
                    'name' => 'required|string|max:255',
                    'first_name' => 'required|string|max:255',
                    'last_name' => 'required|string|max:255',
                    'gender' => 'required|string|max:255',
                    'img' => 'nullable|image|max:2048'
                ];
            case 2:
                return [
                    'hire_date' => 'required|date',
                    'category' => 'required|string|max:255',
                    'status' => 'required|string|max:255',
                    'payroll_type' => 'required|string|max:255',
                    'rfc' => 'required|string|size:13',
                    'curp' => 'required|string|size:18',
                    'imms_number' => 'required|string|size:11',
                    'seniority_days' => 'required|numeric|min:0',
                    'daily_salary' => 'required|numeric|min:0',
                    'payment_type'=> 'required'
                ];
            case 3:
                if ($this->employee_type == 'INTERNO') {
                    return [
                        'full_address' => 'required|string|max:255',
                        'postal_code' => 'required|string|max:255',
                        'age' => 'required|integer|min:0',
                        'integrated_daily_salary' => 'required|numeric|min:0',
                        'level_study' => 'required|string|max:255',
                        'license_vehicle' => 'required|string|max:255',
                        'familiar_phone' => 'required|string|min:10',
                        'job' => 'required|string|max:255',
                        'descount_infonavit' => 'required|numeric|min:0',
                        'descount_FONACOT' => 'required|numeric|min:0',
                        'phone' => 'required|string|min:10',
                        'residence' => 'required|string|max:255',
                        'state' => 'required|string|max:255',
                    ];

                } elseif ($this->employee_type == 'EXTERNO') {

                    return [
                        'work_code' => 'required|string|max:255',
                    ];
                }


            default:
                return [];
        }

    }

    public function submit()
    {
        //validar si existe una imagen
        if ($this->img) {
            $customFileName = 'empleado_'. $this->noi . time() . '.' . $this->img->getClientOriginalExtension();
            $path = $this->img->storeAs('employees', $customFileName, 'public');
            $route = 'storage/'.$path;
        }else{
            $route='';
        }
   
        $employee = new Employees();
        $employee->noi = $this->noi;
        $employee->employee_number = $this->employee_number;
        $employee->name = $this->name;
        $employee->first_name = $this->first_name;
        $employee->last_name = $this->last_name;
        $employee->img_url = $route;    
        $employee->category = $this->category;
        $employee->daily_salary = $this->daily_salary;
        $employee->status = $this->status;
        $employee->hire_date = $this->hire_date;
        $employee->termination_date = $this->termination_date;
        $employee->gender = $this->gender;
        $employee->payroll_type = $this->payroll_type;
        $employee->rfc = $this->rfc;
        $employee->curp = $this->curp;
        $employee->imms_number = $this->imms_number;
        //dividir los seniority_days entre 365 traer con 2 decimales
        $this->seniority_days = number_format($this->seniority_days / 365, 2, '.', '');
        $employee->seniority_days = $this->seniority_days;
        $employee->employee_type = $this->employee_type;
        $employee->payment_type = $this->payment_type;
        $employee->save();

        $latest = Employees::latest()->first();


        if($this->employee_type == 'INTERNO') {
            $internal_employee = new EmployeeInternal();
            $internal_employee->employee_id = $latest->id;
            $internal_employee->integrated_daily_salary = $this->integrated_daily_salary;
            $internal_employee->age = $this->age;
            $internal_employee->full_address = $this->full_address;
            $internal_employee->postal_code = $this->postal_code;
            $internal_employee->level_study = $this->level_study;
            $internal_employee->job = $this->job;
            $internal_employee->license_vehicle = $this->license_vehicle;
            $internal_employee->descount_infonavit = $this->descount_infonavit;
            $internal_employee->descount_FONACOT = $this->descount_FONACOT;
            $internal_employee->state = $this->descount_FONACOT;
            $internal_employee->residence = $this->descount_FONACOT;
            $internal_employee->phone = $this->phone;
            $internal_employee->familiar_phone = $this->familiar_phone;
            $internal_employee->save();

        } elseif ($this->employee_type == 'EXTERNO') {
            $external_employee = new EmployeeExternal();
            $external_employee->employee_id =$latest->id;
            $external_employee->work_code = $this->work_code;
            $external_employee->save();
        }
        $this->reset([
            'noi',
            'employee_number',
            'name',
            'first_name',
            'last_name',
            'category',
            'daily_salary',
            'phone',
            'status',
            'hire_date',
            'termination_date',
            'gender',
            'payroll_type',
            'rfc',
            'curp',
            'imms_number',
            'seniority_days',
            'employee_type',
            'integrated_daily_salary',
            'age',
            'full_address',
            'postal_code',
            'level_study',
            'job',
            'license_vehicle',
            'familiar_phone',
            'img',
            'work_code',]);
        $this->currentStep = 1;
    session()->flash('success', 'El empleado se ha agregado correctamente.');

    return redirect()->route('empleados.index');
        // $this->dispatch('render');
        // return redirect()->route('empleados');
        
    }


}
