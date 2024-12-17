<div>
    <div class="card mt-3">
        <div class="card-header">
            <h5>Registrar incidencias semanales</h5>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="form-group col-6">
                    <p class="h5">Seleccione la semana:</p>
                    <select class="form-control" wire:model.live="weekSelected" name="week">
                        @foreach ($weeksOfYear as $week )
                            <option value="{{$week['numero']}}"> Semana {{ $week['numero'] }} ({{ $week['rango'] }})</option>
                            
                        @endforeach
                    </select>
                    
                </div>
                <div class="form-group col-6">
                    <p class="h5">Empleado:</p>
                    <select class="form-control" name="employee">
                        @foreach ($incidencesByWeek as $employee )
                            <option value="{{$employee->id}}">{{$employee->employee->name}} {{$employee->employee->first_name}} {{$employee->employee->last_name}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group col-3">
                    <p class="h5">Bono de puntualidad:</p>
                    <input type="text" class="form-control" name="bonus">
                </div>   
                <div class="form-group col-3">
                    <p class="h5">Dias de vacacaiones:</p>
                    <input type="text" class="form-control" name="vacation_days">   
                </div>
                <div class="form-group col-3">
                    <p class="h5">Prima Vacacional</p>
                    <input type="text" class="form-control" name="vacation_salary">
                </div>
                <div class="form-group col-3">
                    <p class="h5">Turno:</p>
                    <select class="form-control" name="shift">
                        <option value="Mañana">Mañana</option>  
                        <option value="Tarde">Tarde</option>  
                        <option value="Noche">Noche</option>  
                    </select>
                </div>
                <div class="form-group col-12">
                    <p class="h5">Comentarios:</p>
                    <input type="text" class="form-control" name="comments">    
                </div>
            </div>
        </div>
        <div class="card-footer d-flex justify-content-end">
            <button type="submit" class="btn btn-primary ">Registrar</button>
        </div>
    </div>
<div class="card">
        <div class="card-header">
        <div class="row">
                <div class="col-8">
                    <h5>Incidencias semana: {{$weekSelected}}</h5>
                </div>
                <div class="col-4">
                    <button type="button" wire:click="generateIncidences" class="btn btn-warning float-end">
                        Generar registros
                    </button>
                </div>
            </div>
        </div>
        <div class="card-body">
            <table class="table table-striped table-bordered table-hover dataTable dtr-inline table-responsive">
                <thead>
                    <tr>
                        <th>NOI</th>
                        <th>No. empleado</th>
                        <th>Nombre</th>
                        <th>Categoria</th>
                        <th>Jornada</th>
                        <th>Fecha ingreso</th>
                        <th>Salario diario</th>
                        <th>Sueldo libre semanal</th>
                        <th>Dias Trabajados</th>
                        <th>Bono puntualidad</th>
                        <th>H. Dobles</th>
                        <th>H. Triples</th>
                        <th>Descanso Laborado</th>
                        <th>Prima dominical</th>
                        <th>Dias Vacaciones</th>
                        <th>Prima Vacacional</th>
                        <th>Habilitacion</th>
                        <th>Carga inicial</th>
                        <th>Parcialidad</th>
                        <th>Plazo</th>
                        <th>Saldo</th>
                        <th>Infonavit</th>
                        <th>Comentarios</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($incidencesByWeek as $incidence )
                        <tr>
                            <td>{{ $incidence->employee->noi }}</td>
                            <td>{{ $incidence->employee->employee_number }}</td>
                            <td>{{ $incidence->employee->name }} {{ $incidence->employee->first_name }} {{ $incidence->employee->last_name }}</td>
                            <td>{{ $incidence->employee->category}}</td>
                            <td>día</td>
                            <td>{{ $incidence->employee->hire_date }}</td>
                            <td>{{ $incidence->employee->daily_salary }}</td>
                            <td>{{ $incidence->employee->daily_salary * $incidence->days_worked }}</td>
                            <td>{{ $incidence->days_worked }}</td>
                            <td>{{ $incidence->bonus }}</td>
                            <td>{{ $incidence->double_hours }}</td>
                            <td>{{ $incidence->triple_hours }}</td>
                            <td>{{ $incidence->holidays_worked}}</td>
                            <td>{{ $incidence->sunday_premium }}</td>
                            <td>{{ $incidence->vacation_days }}</td>
                            <td>{{ $incidence->vacation_salary }}</td>
                            <td>{{ $incidence->loan_charge_initial }}</td>  
                            <td>{{ $incidence->loan_partial }}</td>
                            <td>{{ $incidence->loan_lapse }}</td>
                            <td>{{ $incidence->balance }}</td>
                            <td>{{ $incidence->comments }}</td>
                        </tr>   
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="card-footer d-flex justify-content-end">
            <button class="btn btn-warning">Validar registros</button>
        </div>
    </div>
</div>
