<div>
    <div class="card mt-2">
        <div class="card-header">
            <h5>Listado de vacaciones por empleado</h5>
            <div class="input-group">
                <input type="text" id="search" wire:model.live="search" class="form-control"
                    placeholder="Ingresa el valor a buscar por noi, nombre, numero de empleado">
            </div>
        </div>
        <div class="card-body">
            <div class="row col-12" style="overflow-x: auto; white-space: nowrap;">
                <table class="table table-striped table-bordered table-hover dataTable dtr-inline table-responsiv">
                    <thead>
                        <tr>
                            <th>Empleado</th>
                            <th>Fecha inicio</th>
                            <th>Fecha fin</th>
                            <th>Dias tomados</th>
                            <th>Dias restantes</th>
                            <th>Comentarios</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($vacationsGrouped as $vacation)
                            <tr>
                                <td class="text-center">{{ $vacation->employee->name }}
                                    {{ $vacation->employee->first_name }}
                                    {{ $vacation->employee->last_name }}
                                </td>
                                <td class="text-center">{{ $vacation->start_date }}</td>
                                <td class="text-center">{{ $vacation->end_date }}</td>
                                <td class="text-center">{{ $vacation->remaining_days }}</td>
                                <td class="text-center">@if ($vacation->days == 0)
                                    <span class="badge rounded-pill bg-danger"> {{ $vacation->days }}</span>
                                @endif
                                    @if ($vacation->days > 0)
                                        <span class="badge rounded-pill bg-success"> {{ $vacation->days }}</span>
                                    @endif

                                </td>
                                <td class="text-center">{{ $vacation->comments }}</td>

                                <td class="text-center">
                                    <button class="btn btn-sm btn-info"><i class="fas fa-eye"></i></button>
                                    <button class="btn btn-sm btn-success"
                                        wire:click="redirectToVacationForm({{ $vacation->employee_id }})">
                                        <i class="fas fa-plus-square"></i>

                                    </button>

                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

        </div>
        <div class="card-footer">

        </div>
    </div>
</div>