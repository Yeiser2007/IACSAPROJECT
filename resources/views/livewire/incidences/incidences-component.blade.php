<div>
  @livewire('incidences.create-incidence')

  <div class="card-header bg-white">
    <div class="row col-12 ">
      <div class="col-6">
        <h5>Tabla de registros semana: <b> {{ $weekSelected }}</b></h5>
      </div>
      <div class="col-6">
        <button type="button" class="btn btn-warning float-end" data-bs-toggle="modal"
          data-bs-target="#generateIncidencesModal">
          Generar registros
        </button>
      </div>
    </div>
  </div>

  <div class="card-body bg-white">
    <div class="row col-12 mb-2">
      <div class="col-4 d-flex justify-content-start ">
        <a href="{{ route('incidencias.export', $weekSelected) }}" class="btn btn-success">Exportar a excel</a>
      </div>
      <div class="col-8 d-flex justify-content-end">
        <span class="input-group-text">
          <i class="fas fa-search"></i>
        </span>
        <div class="input-group">
          <input type="text" id="search" wire:model.live="search" class="form-control"
            placeholder="Ingresa el valor a buscar por noi, nombre, numero de empleado">
        </div>
      </div>
    </div>
    @foreach ($daysOfWeek as $day)
    <span class="text-nowrap"> {{ $day['nombre'] }}-{{ $day['fecha'] }} </span>
  @endforeach
    <div class="row col-12" style="overflow-x: auto; white-space: nowrap;">
      <table class="table table-striped table-bordered table-hover dataTable dtr-inline table-responsiv">
        <thead>
          <tr>
            <th class="text-nowrap  sticky-col first-col">Empleado</th>
            @foreach ($daysOfWeek as $day)
        <th>{{ ucfirst($day['nombre']) }}</th>
      @endforeach
            <th class="text-nowrap">Total T.E.</th>
            <th class="text-nowrap">Descanso o Festivo</th>
            <th class="text-nowrap">Prima dominical</th>
          </tr>
        </thead>
        <tbody>
          {{ $weekSelect }}
          @foreach ($incidencesByEmployee as $employeeIncidences)
        <tr>
        <td class="text-nowrap sticky-col first-col">{{ $employeeIncidences['employees']['name'] }}
          {{ $employeeIncidences['employees']['first_name'] }} {{ $employeeIncidences['employees']['last_name'] }}
        </td>
        @foreach ($daysOfWeek as $day)
      <td class="text-nowrap">
        @if (isset($employeeIncidences['incidences'][$day['nombre']]))
      @foreach ($employeeIncidences['incidences'][$day['nombre']] as $incidence)
      <div class="d-flex flex-column gap-2">
      @if (!$incidence->exit_time || !$incidence->entry_time)
      <strong> {{ $incidence->recorded_schedule }} </strong>
    @else
      <strong> {{ $incidence->entry_time }}- {{ $incidence->exit_time }}</strong>
    @endif

      @if($incidence->overtime_hours > 0 || $incidence->comments != "" || $incidence->reason != "" || $incidence->abilitation_id != "")
      <button type="button"
      wire:click="showExtras('{{ $incidence->employee_id }}','{{$incidence->entry_time}}','{{$incidence->exit_time}}','{{$incidence->recorded_schedule}}','{{$incidence->overtime_hours}}','{{$incidence->comments}}','{{$incidence->reason}}','{{$incidence->abilitation_id}}')"
      class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteModal">
      <i class="fas fa-eye"></i>
      </button>
    @endif
      </div>
    @endforeach
    @else
    <div class="row">
    <p>Sin incidencia</p>
    </div>
  @endif
      </td>
    @endforeach
        <td class="text-nowrap">{{$employeeIncidences['totalHours']}}</td>
        <td class="text-nowrap">{{$employeeIncidences['holiday']}}</td>
        <td class="text-nowrap">{{$employeeIncidences['sundayPremium']}}</td>

        </tr>
      @endforeach
        </tbody>
      </table>

    </div>
    <div class="row total-registros">
      <span>Total de registros: <span>50</span></span>
    </div>
  </div>

  <div class="modal fade" id="deleteModal" wire:ignore.self tabindex="-1" aria-labelledby="deleteModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="deleteModalLabel">Ver extras</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <span><b>Horario laboral:</b>{{ $entryTime }}-{{ $exitTime }} </span><br>
          @if ($overtimeHours != 0)
        <span><b>Horario Extra:</b>{{ $exitTime }}-{{ $recordedSchedule }} </span><br>
        <span><b>Horas extras:</b>{{ $overtimeHours }} </span><br>
      @else
      <span><b>Estatus:</b>{{$recordedSchedule}}</span><br>
    @endif

          <span><b>Comentarios:</b> {{ $comments }} </span><br>
          <span><b>Motivos</b> {{ $reasons }} </span><br>
          <span><b>Habilitacion</b> {{ $abilitation }} </span><br>

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>

        </div>
      </div>
    </div>
  </div>

  <div class="modal fade" id="generateIncidencesModal" tabindex="-1" aria-labelledby="generateIncidencesModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <!-- Encabezado del modal -->
        <div class="modal-header">
          <h5 class="modal-title" id="generateIncidencesModalLabel">Seleccionar días de la semana</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>

        <!-- Cuerpo del modal -->
        <div class="modal-body">
          <form id="daysForm">
            <div id="daysContainer">
              <span><b>¿Algún día de esta semana es festivo?</b></span>
              @foreach ($daysOfWeek as $day)
          <div class="form-check form-switch">
          <!-- Checkbox para seleccionar días festivos -->
          <input class="form-check-input" type="checkbox" id="day-{{ $day['nombre'] }}"
            wire:model="daysSelected.{{ $day['nombre'] }}">
          <label class="form-check-label" for="day-{{ $day['nombre'] }}">
            {{ $day['nombre'] }}
          </label>
          </div>
        @endforeach
            </div>
          </form>
        </div>

        <!-- Pie del modal -->
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
          <button type="button" class="btn btn-primary" wire:click="generateIncidences()" id="saveDays">
            Guardar
          </button>
        </div>

      </div>
    </div>
  </div>


</div>