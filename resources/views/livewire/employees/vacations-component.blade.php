<div>
    <div class="card mt-3">
        <div class="card-header">
            <h5>Registrar vacaciones</h5>
        </div>
        <div class="card-body">
            <form wire:submit.prevent="saveVacation">
                <div class="row">

                    <div class="form-group col-6">
                        <p class="h5">Empleado:</p>
                        <select class="form-control" wire:model.live="employeeId">
                            @foreach ($employees as $employee)
                                <option value="{{ $employee->id }}">{{ $employee->name }} {{ $employee->first_name }}
                                    {{ $employee->last_name }}</option>
                            @endforeach
                        </select>
                        @error('employeeId')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group col-3">
                        <p class="h5">Fecha inicio:</p>
                        <input type="date" class="form-control" wire:model.live="startDate">
                        @error('startDate')
                            <span class="text-danger">{{ $message }}</span>

                        @enderror
                    </div>
                    <div class="form-group col-3">
                        <p class="h5">Fecha fin:</p>
                        <input type="date" class="form-control" wire:model.live="endDate">
                        @error('endDate')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group col-4">
                        <p class="h5">Dias restantes</p>
                        <input type="text" class="form-control" wire:model.live="daysOfVacation">
                        {{ $messageDays }}
                    </div>
                    <div class="form-group col-8">
                        <p class="h5">Comentarios:</p>
                        <input type="text" class="form-control" wire:model.live="comments" name="comments">
                        @error('comments')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                        {{ $comments }}
                    </div>
                </div>
        </div>
        <div class="card-footer d-flex justify-content-end align-items-end ">
            <button class="btn btn-primary" type="submit">Registrar</button>
        </div>

    </div>
    </form>
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
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($vacations as $vacation)
                            <tr>
                                <td class="text-center">{{ $vacation->employee->name }} {{ $vacation->employee->first_name }}
                                    {{ $vacation->employee->last_name }}</td>
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