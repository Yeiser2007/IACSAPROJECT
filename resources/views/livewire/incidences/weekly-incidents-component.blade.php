<div>
    <div class="card mt-3">
        <div class="card-header">
            <div class="row">
                <div class="col-3">
                    <h5>Incidencias semana: {{$weekSelected +1}}</h5>
                </div>
                <div class="form-group col-6">
                    <select class="form-control" wire:model.live="weekSelected" name="week">
                        <option value="" selected disabled>SELECCIONE UNA SEMANA</option>
                        @foreach ($weeksOfYear as $week)
                            <option value="{{$week['numero']}}"> Semana {{ $week['numero'] +1}} ({{ $week['rango'] }})
                            </option>

                        @endforeach
                    </select>

                </div>
                <div class="col-3">
                    <button type="button" wire:click="generateIncidences" class="btn btn-warning float-end">
                        Generar registros
                    </button>
                </div>
            </div>
            <div class="row">
            
            </div>
        </div>
        <div class="card-body">
            <table class="table table-striped table-bordered table-hover dataTable dtr-inline table-responsive">
                <thead>
                    <tr>
                        <th>NOI</th>
                        <th>No. empleado</th>
                        <th class="text-nowrap text-center">Nombre</th>
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
                        <th>Prestamo inicial</th>
                        <th>Plazo</th>
                        <th>Plazo</th>
                        <th>Saldo</th>
                        <th>Infonavit</th>
                        <th>Comentarios</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                @foreach($incidencesByWeek as $incidence)
                <form wire:submit.prevent="update({{ $incidence->id }})">
    <tr>
        <td>{{ $incidence->employee->noi }}</td>
        <td class="text-nowrap text-center">{{ $incidence->employee->employee_number }}</td>
        <td class="text-nowrap text-center">{{ $incidence->employee->name }} {{ $incidence->employee->first_name }} {{ $incidence->employee->last_name }}</td>
        <td>{{ $incidence->employee->category }}</td>
        <td>día</td>
        <td>{{ $incidence->employee->hire_date }}</td>
        <td>{{ $incidence->employee->daily_salary }}</td>
        <td>{{ $incidence->employee->daily_salary * $incidence->days_worked }}</td>
        <td>{{ $incidence->days_worked }}</td>
        <td>
            <input type="text" 
                   class="form-control" 
                   wire:model.defer="inputs.{{ $incidence->id }}.bonus" 
                   {{ $incidence->status == 'actualizado' ? 'disabled' : '' }}>
        </td>
        <td>{{ $incidence->double_hours }}</td>
        <td>{{ $incidence->triple_hours }}</td>
        <td>{{ $incidence->holiday_worked }}</td>
        <td>{{ $incidence->sunday_premium }}</td>
        <td>
            <input type="text" 
                   class="form-control" 
                   wire:model.defer="inputs.{{ $incidence->id }}.vacation_days" 
                   {{ $incidence->status == 'actualizado' ? 'disabled' : '' }}>
        </td>
        <td>
            <input type="text" 
                   class="form-control" 
                   wire:model.defer="inputs.{{ $incidence->id }}.vacation_bonus" 
                   {{ $incidence->status == 'actualizado' ? 'disabled' : '' }}>
        </td>
        <td>{{ $incidence->abilitation }}</td>
        <td>
            <input type="text" 
                   class="form-control" 
                   wire:model.defer="inputs.{{ $incidence->id }}.loan_charge_initial" 
                   value="{{ $incidence->loan_charge_initial }}" 
                   {{ $incidence->status == 'actualizado' ? 'disabled' : '' }}>
        </td>
        <td>
            <input type="text" 
                   class="form-control" 
                   wire:model.defer="inputs.{{ $incidence->id }}.loan_partial" 
                   value="{{ $incidence->loan_partial }}" 
                   {{ $incidence->status == 'actualizado' ? 'disabled' : '' }}>
        </td>
        <td>
            <input type="text" 
                   class="form-control" 
                   wire:model.defer="inputs.{{ $incidence->id }}.loan_lapse" 
                   value="{{ $incidence->loan_lapse }}" 
                   {{ $incidence->status == 'actualizado' ? 'disabled' : '' }}>
        </td>
        <td>
            <input type="text" 
                   class="form-control" 
                   wire:model.defer="inputs.{{ $incidence->id }}.balance" 
                   value="{{ $incidence->balance }}" 
                   {{ $incidence->status == 'actualizado' ? 'disabled' : '' }}>
        </td>
        <td>
            <select class="form-control" 
                    wire:model.defer="inputs.{{ $incidence->id }}.infonavit" 
                    {{ $incidence->status == 'actualizado' ? 'disabled' : '' }}>
                <option value="SI">SI</option>
                <option value="NO">NO</option>
            </select>
        </td>
        <td>
            <input type="text" 
                   class="form-control" 
                   wire:model.defer="inputs.{{ $incidence->id }}.comments" 
                   {{ $incidence->status == 'actualizado' ? 'disabled' : '' }}>
        </td>
        <td class="text-nowrap text-center sticky-col last-col">
            @if ($incidence->status == 'pendiente')
                <button class="btn btn-sm btn-warning">
                    <i class="fas fa-check"></i>
                    <div class="loading" wire:loading role="status"></div>
                </button>   
            @else
                <button class="btn btn-sm btn-success" wire:click.prevent="changeStatus({{ $incidence->id }})">
                    <i class="fas fa-check"></i>
                </button>
            @endif
        </td>
    </tr>
</form>

@endforeach

                </tbody>
            </table>
        </div>
        <div class="card-footer d-flex justify-content-between">

            <div class="col-6 d-flex justify-start text-start">
                {{ $incidencesByWeek->links() }}
            </div>
            <div class="col-6 text-end">
            <button wire:click="validateIncidences" class="btn btn-warning">Validar registros</button>
            </div>
            
            
        </div>
    </div>
</div>