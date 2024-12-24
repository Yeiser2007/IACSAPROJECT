@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
<h1>Editar empleado</h1>
@if (session('info'))


        <div class="alert alert-success alert-dismissible fade show" role="alert">
  <strong>{{session()->get('info')}}</strong> 
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
    

@endif

@stop

@section('content')

<div class="card">
    
        <form action="{{ route('empleados.update', $employee) }}" method="post" enctype="multipart/form-data">
        <div class="card-body">
            @csrf
            @method('put')
            <div class="row">
                <div class="form-group col-3">
                    <p class="h5">NOI:</p>
                    <input type="text" class="form-control" name="noi" value="{{ $employee->noi }}">
                </div>
                <div class="form-group col-3">
                    <p class="h5">Número de empleado:</p>
                    <input type="text" class="form-control" name="employee_number"
                        value="{{ $employee->employee_number }}">
                </div>
                <div class="form-group col-3">
                    <p class="h5">Género:</p>
                    <select class="form-control" name="gender">
                        <option value="M" {{ $employee->gender == 'M' ? 'selected' : '' }}>Masculino</option>
                        <option value="F" {{ $employee->gender == 'F' ? 'selected' : '' }}>Femenino</option>
                    </select>
                </div>
                <div class="form-group col-3">
                    <p class="h5">Categoría:</p>
                    <input type="text" class="form-control" name="category" value="{{ $employee->category }}">
                </div>
            </div>
            <div class="row">
                <div class="form-group col-4">
                    <p class="h5">Nombre:</p>
                    <input type="text" class="form-control" name="name" value="{{ $employee->name }}">
                </div>
                <div class="form-group col-4">
                    <p class="h5">Primer apellido:</p>
                    <input type="text" class="form-control" name="first_name" value="{{ $employee->first_name }}">
                </div>
                <div class="form-group col-4">
                    <p class="h5">Apellido paterno:</p>
                    <input type="text" class="form-control" name="last_name" value="{{ $employee->last_name }}">
                </div>
            </div>
            <div class="row">
                <div class="form-group col-4">
                    <p class="h5">RFC:</p>
                    <input type="text" class="form-control" name="rfc" value="{{ $employee->rfc }}">
                </div>
                <div class="form-group col-4">
                    <p class="h5">CURP:</p>
                    <input type="text" class="form-control" name="curp" value="{{ $employee->curp }}">
                </div>
                <div class="form-group col-4">
                    <p class="h5">Número IMMS:</p>
                    <input type="text" class="form-control" name="imms_number" value="{{ $employee->imms_number }}">
                </div>

            </div>

            <div class="row">
            <div class="form-group col-3">
                    <p class="h5">Fecha de alta IMMS:</p>
                    <input type="date" class="form-control" name="imms_date"
                        value="{{ $employee->imms_date }}">
                </div>
                <div class="form-group col-3">
                    <p class="h5">Fecha de contratación:</p>
                    <input type="date" class="form-control" readonly name="hire_date" value="{{ $employee->hire_date }}">
                </div>
                <div class="form-group col-3">
                    <p class="h5">Días de antigüedad:</p>
                    <input type="text" class="form-control" readonly name="seniority_days"
                        value="{{ $employee->seniority_days }}">
                </div>
                <div class="form-group col-3">
                    <p class="h5">Fecha de baja:</p>
                    <input type="date" class="form-control" name="termination_date"
                        value="{{ $employee->termination_date }}">
                </div>
            </div>
            

            <div class="row">
            <div class="form-group col-3">
                <p class="h5">Estatus:</p>
                <select class="form-control" name="status">
                    <option value="Alta" {{ $employee->status == 'activo' ? 'selected' : '' }}>Alta</option>
                    <option value="Baja" {{ $employee->status == 'inactivo' ? 'selected' : '' }}>Baja</option>

                </select>
            </div>
            <div class="form-group col-3">
                    <p class="h5">Tipo de Nómina:</p>
                    <select class="form-control" name="payroll_type">
                        <option value="A" {{ $employee->payroll_type == 'A' ? 'selected' : '' }}>Tipo A</option>
                        <option value="B" {{ $employee->payroll_type == 'B' ? 'selected' : '' }}>Tipo B</option>
                    </select>
                </div>
               
                <div class="form-group col-3">
                    <p class="h5">Salario diario:</p>
                    <input type="text" class="form-control" name="daily_salary" value="{{ $employee->daily_salary }}">
                </div>
                <div class="form-group col-3">
                <p class="h5">Actualizar imagen:</p>
                <input type="file" class="form-control" name="img" id="">
                </div>
                
            </div>

             <hr>
             <div class="row">
             <div class="form-group col-12">
                    <p class="h5"> <b>Tipo de empleado: </b> </p>
                    <input type="text" class="form-control" name="employee_type" value="{{ $employee->employee_type }}" readonly>
                </div>
             </div>
            

            @if ($employee->employee_type == 'INTERNO')
                <div class="row">
                    <div class="form-group col-4">
                        <p class="h5">Salario integrado diario:</p>
                        <input type="text" class="form-control" name="integrated_daily_salary"
                            value="{{ $employees_type->integrated_daily_salary }}">
                    </div>
                    <div class="form-group col-4">
                        <p class="h5">Edad:</p>
                        <input type="text" class="form-control" name="age" value="{{ $employees_type->age }}">
                    </div>
                    <div class="form-group col-4">
                        <p class="h5">Nivel de estudios:</p>
                        <input type="text" class="form-control" name="level_study"
                            value="{{ $employees_type->level_study }}">
                    </div>
                </div>
                <div class="row">
                <div class="form-group col-3">
                        <p class="h5">Oficio:</p>
                        <input type="text" class="form-control" name="job" value="{{ $employees_type->job }}">
                    </div>
                <div class="form-group col-2">
                        <p class="h5">Código Postal:</p>
                        <input type="text" class="form-control" name="postal_code"
                            value="{{ $employees_type->postal_code }}">
                    </div>
                    <div class="form-group col-7">
                        <p class="h5">Dirección completa:</p>
                        <input type="text" class="form-control" name="full_address"
                            value="{{ $employees_type->full_address }}">
                    </div>
                    
                    
                </div>

                <div class="row">
                    <div class="form-group col-4">
                        <p class="h5">Licencia de vehículo:</p>
                        <input type="text" class="form-control" name="license_vehicle"
                            value="{{ $employees_type->license_vehicle }}">
                    </div>
                    <div class="form-group col-4">
                        <p class="h5">Teléfono familiar:</p>
                        <input type="text" class="form-control" name="familiar_phone"
                            value="{{ $employees_type->familiar_phone }}">
                    </div>
                    <div class="form-group col-4">
                    <p class="h5">Teléfono:</p>
                    <input type="text" class="form-control" name="phone" value="{{ $employees_type->phone }}">
                </div>
                </div>
                <div class="row">
                    <div class="form-group col-6">
                        <p class="h5">Descuento infonavit 2:</p>
                        <input type="text" class="form-control" name="descount_infonavit"
                            value="{{ $employees_type->descount_infonavit }}">
                    </div>
                    <div class="form-group col-6">
                        <p class="h5">Descuento FONACOT 2:</p>
                        <input type="text" class="form-control" name="descount_FONACOT"
                            value="{{ $employees_type->descount_FONACOT }}">
                    </div>
                </div>
            @elseif ($employee->employee_type == 'EXTERNO')
                <div class="row">
                    <div class="form-group col-6">
                        <p class="h5">Código de trabajo:</p>
                        <input type="text" class="form-control" name="work_code" value="{{ $employees_type->work_code }}">
                    </div>
                </div>

            @endif
            </div>
            <div class="card-footer d-flex justify-content-end text-end">
            <button class="btn btn-primary" type="submit" >Guardar</button>
            </div>
        </form>
   


</div>
@stop

@section('css')
@livewireStyles
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
@stop

@section('js')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
    crossorigin="anonymous"></script>
@livewireScripts

@stop