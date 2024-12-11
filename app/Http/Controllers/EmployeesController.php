<?php

namespace App\Http\Controllers;

use App\Exports\MultiSheetExport;
use App\Models\EmployeeExternal;
use App\Models\EmployeeInternal;
use App\Models\Employees;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use App\Exports\UsersExport;
use Maatwebsite\Excel\Facades\Excel;
use Storage;

class EmployeesController extends Controller
{
    public function index()
    {
        return view('employees.employees');
    }
    public function update(Request $request, $employee)
    {
        $employee = Employees::findOrFail($employee);
        $employee->noi = $request->noi;
        $employee->employee_number = $request->employee_number;
        $employee->name = $request->name;
        $employee->first_name = $request->first_name;
        $employee->last_name = $request->last_name;
        $employee->category = $request->category;
        $employee->daily_salary = $request->daily_salary;
        $employee->status = $request->status;
        $employee->hire_date = $request->hire_date;
        $employee->termination_date = $request->termination_date;
        $employee->gender = $request->gender;
        $employee->payroll_type = $request->payroll_type;
        $employee->rfc = $request->rfc;
        $employee->curp = $request->curp;
        $employee->imms_number = $request->imms_number;
        $employee->seniority_days = $request->seniority_days;
        $employee->employee_type = $request->employee_type;
        $latest = $employee->id;
        
        if ($request->hasFile('img')) {
            if ($employee->img_url) {
                Storage::disk('public')->delete($employee->img_url);
            }
        
            // Guardar la nueva imagen
            $file = $request->file('img');
            $customFileName = 'empleado_' . $employee->id . time() . '.' . $file->getClientOriginalExtension();
            $path = $file->storeAs('employees', $customFileName, 'public');
            $employee->img_url = 'storage/' . $path;
            $employee->save();
        }
        $employee->save();



        if ($request->employee_type == 'INTERNO') {
            $internal_employee = EmployeeInternal::where('employee_id', $latest)->first();
            $internal_employee->employee_id = $latest;
            $internal_employee->integrated_daily_salary = $request->integrated_daily_salary;
            $internal_employee->age = $request->age;
            $internal_employee->full_address = $request->full_address;
            $internal_employee->postal_code = $request->postal_code;
            $internal_employee->level_study = $request->level_study;
            $internal_employee->phone = $request->phone;
            $internal_employee->job = $request->job;
            $internal_employee->license_vehicle = $request->license_vehicle;
            $internal_employee->descount_infonavit = $request->descount_infonavit;
            $internal_employee->descount_FONACOT = $request->descount_FONACOT;
            $internal_employee->familiar_phone = $request->familiar_phone;
            $internal_employee->save();
        } elseif ($request->employee_type == 'EXTERNO') {
            $external_employee = EmployeeExternal::where('employee_id', $latest)->first();
            $external_employee->employee_id = $latest;
            $external_employee->work_code = $request->work_code;
            $external_employee->save();
        }

        session()->flash('success', 'Empleado actualizado correctamente.');

        return redirect()->route('empleados.index', $employee);

    }
    public function edit($employee)
    {
        $employee = Employees::findOrFail($employee);
        if ($employee->employee_type == 'INTERNO') {
            $employees_type = EmployeeInternal::where('employee_id', $employee->id)->first();
        } elseif ($employee->employee_type == 'EXTERNO') {
            $employees_type = EmployeeExternal::where('employee_id', $employee->id)->first();
        }
        return view('employees.edit-employees', compact('employees_type', 'employee'));
    }
    public function exportPDF($id){
        $employee = Employees::findOrFail($id);
        $pdf = Pdf::loadView('employees.card-employee', compact('employee'));
        return $pdf->download('credencial.pdf');

    }

    public function exportEmployees()
    {
        return Excel::download(new MultiSheetExport, 'CATALOGO DE EMPLEADOS IACSA.xlsx');
    }
}
