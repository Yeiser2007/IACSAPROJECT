<div>
    <div class="card mt-2">
        <div class="card-header">
            <h5>Registrar incidencias semanales</h5>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="form-group col-4">
                    <p class="h5">Selecciopne la semana:</p>
                    <select class="form-control" wire:model.live="weekSelected" name="week">
                    @foreach ($weeksOfYear as $week )
                            <option value="{{$week['numero']}}"> Semana {{ $week['numero'] }} ({{ $week['rango'] }})</option>
                        @endforeach
                    </select>
                    @foreach ($daysOfWeek as $days )
                            <option value="{{$days['fecha']}}"> Semana {{ $days['fecha'] }} ({{ $days['nombre'] }})</option>
                    @endforeach
                    {{  $startWeekSelected}} {{$endWeekSelected}}
                </div>
                <div class="form-group col-4">
                    <p class="h5">Empleado:</p>
                    <select class="form-control" name="employee">
                            <option value="" selected disabled > Seleccione un empleado</option>
                        @foreach ($employees as $employee )
                            <option value="{{$employee->id}}">{{$employee->name}} {{$employee->first_name}} {{$employee->last_name}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group col-4">
                    <p class="h5">Puesto:</p>
                    <input type="text" class="form-control" name="position">
                </div>
                <div class="form-group col-3">
                    <p class="h5"> Alta IMMS</p>
                    <input type="text" class="form-control" name="imms_number">
                </div>
                <div class="form-group col-3">
                    <p class="h5">Bono puntualidad y asistencia</p>
                    <input type="text" class="form-control" name="bonus">
                </div>
                <div class="form-group col-3">
                    <p class="h5">Prestamo/Descontar:</p>
                    <input type="text" class="form-control" name="loan">
                </div>
                <div class="form-group col-3">
                    <p class="h5">Turno</p>
                    <select class="form-control" name="shift">
                        <option value="Mañana">Mañana</option>  
                        <option value="Tarde">Tarde</option>  
                        <option value="Noche">Mixto</option>  
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
    <div class="card mt-2">
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
                       
                        <th>Nombre</th>
                        <th>Puesto</th>
                        <th>Sueldo bruto mensual</th>
                        <th>Alta IMMS</th>
                        <th>Sueldo bruto mensual</th>
                        <th>Sueldo libre mensual</th>
                        <th>Pago</th>
                        <th>Dias Trabajados</th>
                        <th>Infonavit</th>
                        <th>Festivo Laborado</th>
                        <th>bono Puntualidad y Asistencia</th>
                        <th>Prestamo Descontar </th>
                        <th>Turno</th>
                        <th>Comentarios</th>
                        <th>Estatus</th>
                    </tr>
                </thead>
                <tbody>
                @foreach($data as $d)
                <tr>
                    <td>{{$d['NOI']}}</td>
                    <td>{{$d['employee_number']}}</td>
                    <td>{{$d['name']}}</td>
                    <td>{{$d['categoria']}}</td>
                    <td>{{$d['jornada']}}</td>
                    <td>{{$d['hire_date']}}</td>
                    <td>{{$d['daily_salary']}}</td>
                    <td>{{$d['total_sunday_premium']}}</td>
                    <td>{{$d['total_days_registered']}}</td>
                    <td>{{$d['total_overtime_hours']}}</td>
                    <td>{{$d['total_overtime_hours']}}</td>
                </tr>
            @endforeach
            </table>
        </div>
        
        <div class="card-footer d-flex justify-content-end">
            <button class="btn btn-warning">Validar registros</button>
        </div>
    </div>
</div>