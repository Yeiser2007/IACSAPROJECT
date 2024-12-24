<div>
    <div class="card mt-4">


        <div class="card-header bg-white">
            Registrar de incidencias <b><span wire:model>Semana: {{$weekSelected +1}}</span></b>
        </div>
        <form method="post"
            action="{{ route('incidencias.update', $userSelected ? $userSelected->id ?? $userSelected : '') }}">

            @csrf
            @method('PUT')
            <div class="card-body bg-white">
                <div class="row col-12">
                    <div class="form-group col-md-4 col-xs-12">
                        <label for="semana">Selecciona la semana</label>
                        <select id="semana" wire:model.live="weekSelected" style="text-transform: uppercase" class="form-control">
                            @foreach($weeksOfYear as $semana)
                                <option value="{{ $semana['numero'] }}" {{ $semana['numero'] == $currentWeek ? 'selected' : '' }}>
                                    Semana {{ $semana['numero']+1 }} ({{ $semana['rango'] }})
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group col-md-4 col-xs-12 ">
                        <label for="dia">Selecciona el día de la semana</label>
                        <div class="d-flex">
                            <select id="dia" name="record_date" style="text-transform: uppercase" wire:model.live="daySelected" class="form-control">
                                <option value="">-- Selecciona un día --</option>
                                @foreach($daysOfWeek as $dia)
                                    <option value="{{ $dia['fecha'] }}">
                                        {{ $dia['nombre'] }} - {{ $dia['fecha'] }}
                                    </option>
                                @endforeach
                            </select>
                            <div class="spinner-border text-dark" wire:loading role="status">
                                <span class="visually-hidden">Loading...</span>
                            </div>
                        </div>

                    </div>
                    <div class="form-group col-md-4 col-xs-12">
                        <label for="usuario">Usuarios sin incidencia para {{ $daySelected }}</label>
                        <select id="usuario" style="text-transform: uppercase" name="employee_id" class="form-control" wire:model.live="userSelected">
                            <option value="">Seleccione un usuario</option>
                            @forelse($usersWithoutIncidence as $usuario)
                                <option value="{{ $usuario->id }}">{{ $usuario->name }} {{ $usuario->last_name }} {{ $usuario->first_name }}</option>
                            @empty
                                <option value="">No hay usuarios sin incidencia para esta fecha</option>
                            @endforelse
                        </select>
                    </div>
                </div>
                <div class="row col-12">
                    <div class="form-group col-md-2 col-xs-12">
                        <label for="inicio">Hora entrada</label>
                        <input type="time" name="start_time" class="form-control" wire:model.blur="start_time"
                            id="inicio" onchange="calculateExtras()" required />

                    </div>
                    <div class="form-group col-md-2 col-xs-12">
                        <label for="fin">Hora salida</label>
                        <input type="time" name="end_time" class="form-control" wire:model.blur="end_time" id="fin"
                            required />

                    </div>
                    <div class="form-group col-md-2 col-xs-12">
                        <label for="fin">Hora salida registrada</label>
                        <input type="time" name="recorded_schedule" class="form-control"
                            wire:model.live="end_time_register" id="fin" />
                        @error('end_time_register')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group col-md-2 col-xs-12">
                        <label for="extras">Horas Extras (h)</label>
                        <input type="number" name="overtime_hours" class="form-control" wire:model.live="overtime_hours"
                            readonly value=" {{ number_format($overtime_hours, 2) }}" id="extras" />
                    </div>
                    <div class="form-group col-md-2 col-xs-12">
                        <label for="extras">¿Es festivo o no laboral? </label>
                        <div class="form-check form-switch">
                            <input class="form-check-input" name="holiday" type="checkbox" id="flexSwitchCheckDefault"
                                wire:model.live="dayValidation">
                            <label class="form-check-label" for="flexSwitchCheckDefault">{{ $dayValidation}}</label>
                        </div>
                    </div>
                    <div class="form-group col-md-2 col-xs-12">
                        <label for="statusRegister">Falta </label>
                        <div class="form-check form-switch">
                            <input class="form-check-input" name="status" type="checkbox" id="statusRegister"
                                wire:model.live="statusRegister">
                            <label class="form-check-label" for="flexSwitchCheckDefault">{{ $statusRegister}}</label>
                        </div>
                    </div>

                </div>
                <div class="row col-12">
                    <div class="form-group col-md-4 col-xs-12">
                        <label for="motivos">Motivos</label>
                        <input type="text" name="reason" class="form-control" id="motivos" wire:model="reason" />
                    </div>
                    <div class="form-group col-md-4 col-xs-12">
                        <label for="comentarios">Comentarios</label>
                        <input type="text" name="comments" class="form-control" id="comentarios"
                            wire:model="comments" />
                    </div>
                    <div class="form-group col-md-4 col-xs-12">
                        <label for="abilitation">Habilitacion</label>
                        <div class="d-flex">
                        <select class="form-select" style="text-transform: uppercase" name="abilitation_id" wire:model="abilitation_id">
                            <option value="">-- Selecciona una opción --</option>
                            @foreach($abilitations as $abilit)
                                <option value="{{ $abilit->id }}">{{ $abilit->name }}</option>
                            @endforeach
                        </select>
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal"><i class="fas fa-plus"></i>
</button>
                        </div>
                       
                        

                    </div>
                </div>
            </div>

            @if ($userSelected != null)
                <div class="card-footer bg-white d-flex justify-content-end align-items-end">
                    <button type="submit" class="btn btn-primary mr-4">Registrar</button>
                </div>
            @endif

        </form>
    </div>
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Agregar abilitacion</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="{{ route('abilitaciones.store') }}" method="POST">
          @csrf
          <div class="form-group">
            <label for="name">Nombre</label>
            <input type="text" class="form-control" id="name" name="name" required>
          </div>
          <div class="form-group">
            <label for="description">Saliario</label>
            <input class="form-control" id="description" name="salary" required></input>
          </div>
          <button type="submit" class="btn btn-primary">Guardar</button>
        </form>
      </div>
    </div>
  </div>
</div>
</div>