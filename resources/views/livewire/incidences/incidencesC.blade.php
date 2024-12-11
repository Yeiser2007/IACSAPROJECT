<div>
<div class="card mt-4">


<div class="card-header bg-white">
    Registrar de incidencias <b><span wire:model>Semana: {{$currentWeek}}</span></b>
</div>
<form wire:submit.prevent="submit">
    <div class="card-body bg-white">
        <div class="row col-12">
            <div class="form-group col-md-4 col-xs-12">
                <label for="semana">Selecciona la semana</label>
                <select id="semana" wire:model.live="weekSelected" class="form-control">
                    @foreach($weeksOfYear as $semana)
                        <option value="{{ $semana['numero'] }}" {{ $semana['numero'] == $currentWeek ? 'selected' : '' }}>
                            Semana {{ $semana['numero'] }} ({{ $semana['rango'] }})
                        </option>
                    @endforeach
                </select>
                {{ $weekSelected }}
            </div>
            <div class="form-group col-md-4 col-xs-12 ">
                <label for="dia">Selecciona el día de la semana</label>
                <div class="d-flex">
                <select id="dia" wire:model.live="daySelected" class="form-control">
                    <option value="">-- Selecciona un día --</option>
                    @foreach($daysOfWeek as $dia)
                        <option value="{{ $dia['fecha'] }}">
                            {{ $dia['nombre'] }} - {{ $dia['fecha'] }}
                        </option>
                    @endforeach
                </select>
                <div class="spinner-border text-dark" wire:loading
                                           role="status">
                                            <span class="visually-hidden">Loading...</span>
                                        </div>
                </div>
                
                {{ $daySelected }}
            </div>
            <div class="form-group col-md-4 col-xs-12">
                <label for="usuario">Usuarios sin incidencia para {{ $daySelected }}</label>
                <select id="usuario" class="form-control" wire:model.live="userSelected">
                    <option value="">Seleccione un usuario</option>
                    @forelse($usersWithoutIncidence as $usuario)
                        <option value="{{ $usuario->id }}">{{ $usuario->name }}</option>
                    @empty
                        <option value="">No hay usuarios sin incidencia para esta fecha</option>
                    @endforelse
                </select>
                {{ $userSelected }}
            </div>
        </div>
        <div class="row col-12">
            <div class="form-group col-md-3 col-xs-12">
                <label for="inicio">Hora entrada</label>
                <input type="time" class="form-control" wire:model.blur="start_time" id="inicio"
                    onchange="calculateExtras()" required />
                    {{ $start_time }}
                    
            </div>
            <div class="form-group col-md-3 col-xs-12">
                <label for="fin">Hora salida</label>
                <input type="time" class="form-control" wire:model.blur="end_time" id="fin" required />
                
            </div>
            <div class="form-group col-md-3 col-xs-12">
                <label for="fin">Hora salida registrada</label>
                <input type="time" class="form-control" wire:model.live="end_time_register" id="fin" required />
                @error('end_time_register')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <div class="form-group col-md-3 col-xs-12">
                <label for="extras">Horas Extras (h)</label>
                <input type="number" class="form-control" wire:model.live="overtime_hours" readonly
                    value=" {{ number_format($overtime_hours, 2) }}" id="extras" />
            </div>
        </div>
        <div class="row col-12">
            <div class="form-group col-md-6 col-xs-12">
                <label for="motivos">Motivos</label>
                <input type="text" class="form-control" id="motivos" name="reason" wire:model="reason" required />
            </div>
            <div class="form-group col-md-6 col-xs-12">
                <label for="comentarios">Comentarios</label>
                <input type="text" class="form-control" id="comentarios" wire:model="comments" name="comments" />
            </div>
        </div>
    </div>

    <div class="card-footer bg-white d-flex justify-content-end align-items-end">
        <button type="submit" class="btn btn-primary mr-4">Registrar</button>
    </div>
</form>
</div>
<div class="card-header bg-white">
    <div class="row col-12 mb-3">
      <div class="col-6">
        <h5>Tabla de incidencias</h5>
      </div>
      <div class="col-6 ">
      <div class="form-group col-md-4 col-xs-4">
          <label for="semana">Selecciona la semana</label>
          <select id="semana" wire:model.live="weekSelected" class="form-control">
            @foreach($weeksOfYear as $semana)
        <option value="{{ $semana['numero'] }}" {{ $semana['numero'] == $currentWeek ? 'selected' : '' }}>
          Semana {{ $semana['numero'] }} ({{ $semana['rango'] }})
        </option>
      @endforeach
          </select>
          {{ $weekSelected }}
        </div>
      </div>
    </div>
  </div>

    <div class="card-body col-md-10 col-lg-10  col-sm-12">
      <div class="row col-12">
       
        <div class="mb-3 col-8 ">
          <input type="text" id="searchInput" class="form-control" placeholder="Buscar por usuario..."
            onkeyup="filterTable()">
        </div>
      </div>
      <div>
      </div>
      <div class="container table-container col-12 ">
        <table class="table table-bordered">
          <thead>
            <tr>
              <th>Empleado</th>
              @foreach ($daysOfWeek as $day)
          <th>{{ ucfirst($day['nombre']) }}</th>
        @endforeach
              <th>Total T.E.</th>
              <th>Descanso o Festivo</th>
              <th>Prima dominical</th>
              <th>Habilitacion</th>
              <th>Acciones</th>
            </tr>
          </thead>
          <tbody>
            {{ $weekSelect}}
            @foreach ($incidencesByEmployee as $employeeIncidences)
        <tr>
          <td>{{ $employeeIncidences['employees']['name'] }} (ID: {{ $employeeIncidences['employees']['id'] }})</td>

          @foreach ($daysOfWeek as $day)
        <td>
        @if (isset($employeeIncidences['incidences'][$day['nombre']]))
      @foreach ($employeeIncidences['incidences'][$day['nombre']] as $incidence)
      <div>
      <strong> {{ $incidence->entry_time }}- {{ $incidence->exit_time }}</strong>
      @if($incidence->overtime_hours > 0)
      <button class="btn btn-info">{{ $incidence->overtime_hours }}</button>
    @endif
      </div>
    @endforeach
    @else
    <!-- Si no hay incidencias para ese día, muestra un guion -->
    -
  @endif
        </td>
      @endforeach
          <td>{{$employeeIncidences['totalHours']}}</td>
          <td>-</td>
          <td>{{$employeeIncidences['sundayPremium']}}</td>
          <td>-</td>
          <td class="text-nowrap sticky-col last-col">
          <div class="d-inline-flex gap-2">
            <a href="{{route('incidencias.edit', $employeeIncidences['employees']['id'] )}}" class="btn btn-primary">Editar</a>
            @can('incidencias.destroy')
        <button type="button" wire:click="assignName({{ $employee->id }}, '{{ $employee->name }}')"
        class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteModal">
        Eliminar
        </button>
      @endcan
          </div>
          </td>
        </tr>
      @endforeach


          </tbody>
        </table>

      </div>
      <div class="row total-registros">
        <span>Total de registros: <span>50</span></span>
      </div>
    </div>
  </div>
</div>
