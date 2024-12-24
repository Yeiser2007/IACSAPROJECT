<div>
    @if ($days == 0)

        <div class="alert alert-danger alert-dismissible fade show mt-3" role="alert">
  <strong>¡HEY!</strong>Este empleado no tiene dias de vacaciones
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
    @endif


    <div class="row col-12 mt-2">
        <div class="col-4">
            <div class="card" style="height: 85vh;">
                <div class="card-header">
                    <h5>Registrar vacaciones</h5>
                </div>
                <form wire:submit.prevent="saveVacation">
                <div class="card-body">
                   
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group col-12">
                                    <p class="h4">Id</p>
                                    <input type="number" class="form-control" wire:model="employeeId" readonly>
                                </div>
                                <div class="form-group col-12">
                                    <p class="h5">Empleado:</p>
                                    <input type="text" class="form-control" wire:model.live="employeeName" readonly>
                                </div>
                                <div class="form-group col-12">
                                    <p class="h5">Fecha de ausencia:</p>
                                    <input type="date" class="form-control" wire:model.live="startDate">
                                    @error('startDate')
                                        <span class="text-danger">{{ $message }}</span>

                                    @enderror
                                </div>
                                <div class="form-group col-12">
                                    <p class="h5">Días tomados</p>
                                    <input type="number " class="form-control" wire:model.live="daysTaken">
                                    @error('daysTaken')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class=" form-group col-12 ">
                                        <p class="h5" for="vacation">Días restantes:</p>
                                        <input type="text" class="form-control" wire:model.live="days" readonly>
                                    
                                    @error('days')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="form-group col-12">
                                    <p class="h5">Comentarios:</p>
                                    <input type="text" class="form-control" wire:model.live="comments" name="comments">
                                    @error('comments')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                        </div>
                </div>
                <div class="card-footer d-flex justify-content-end align-items-end ">
                    <button class="btn btn-primary" type="submit">Registrar</button>
                </div>
                </form>
            </div>
        </div>
        <div class="col-8">
            <div class="card" style="height: 85vh;">
                <div class="card-header">
                    <h5>Registro de vacaciones tomadas</h5>
                </div>
                <div class="card-body">
                    <div class="row col-12">
                        <div class="col-12">
                            <table
                                class="table table-striped table-bordered table-hover dataTable dtr-inline table-responsiv">
                                <thead>
                                    <th>Fecha de salida</th>
                                    <th>Fecha de regreso</th>
                                    <th>Dias tomados</th>
                                    <th>Comentarios</th>
                                </thead>
                                <tbody>
                                    @foreach ($vacations as $vacation)
                                        <tr>
                                            <td class="text-center">{{ $vacation->start_date }}</td>
                                            <td class="text-center">{{ $vacation->end_date }}</td>
                                            <td class="text-center">{{ $vacation->remaining_days }}</td>
                                            <td class="text-center">{{ $vacation->comments }}</td>
                                        </tr>
                                    @endforeach

                                </tbody>

                            </table>
                        </div>
                    </div>
                </div>
                </form>
            </div>
        </div>
    </div>





</div>
</div>