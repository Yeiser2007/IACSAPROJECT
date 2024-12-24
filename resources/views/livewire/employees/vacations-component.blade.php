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
                            <th>NOI</th>
                            <th>Empleado</th>
                            <th>Puesto</th>
                            <th>Antiguedad</th>
                            <th style="background-color: #fcebb3">Días ganados</th>
                            <th style="background-color: #fcebb3">Días tomados</th>
                            <th style="background-color: #fcebb3">Días restantes</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($vacationsGrouped as $vacation)
                            <tr>
                                <td class="text-center">{{ $vacation->employee->noi }}</td>
                                <td class="text-center">{{ $vacation->employee->name }}{{ $vacation->employee->first_name }}{{ $vacation->employee->last_name }}</td>
                                <td>{{ $vacation->employee->category }}</td>
                                <td class="text-center">{{ $vacation->employee->seniority_days }}</td>
                                @if ($vacation->employee->seniority_days < 1)
                                    <td class="text-center" style="background-color: #fcebb3">
                                        <span class="badge rounded-pill bg-warning">0</span>
                                    </td>   

                                @elseif ($vacation->employee->seniority_days>=1 && $vacation->employee->seniority_days <2)
                                    <td class="text-center" style="background-color: #fcebb3">
                                        <span class="badge rounded-pill bg-success">12</span>
                                    </td>
                                @elseif ($vacation->employee->seniority_days>=2 && $vacation->employee->seniority_days <3  )
                                    <td class="text-center" style="background-color: #fcebb3">
                                        <span class="badge rounded-pill bg-success">14</span>
                                    </td>
                                @elseif ($vacation->employee->seniority_days >=3 && $vacation->employee->seniority_days <4  )
                                    <td class="text-center" style="background-color: #fcebb3">
                                        <span class="badge rounded-pill bg-success">16</span>
                                    </td>
                                @elseif ($vacation->employee->seniority_days >=4 && $vacation->employee->seniority_days <5  )
                                    <td class="text-center" style="background-color: #fcebb3">
                                        <span class="badge rounded-pill bg-success">18</span>
                                    </td>
                                @elseif ($vacation->employee->seniority_days >=5 && $vacation->employee->seniority_days <6  )
                                    <td class="text-center" style="background-color: #fcebb3">
                                        <span class="badge rounded-pill bg-success">20</span>
                                    </td>
                                @elseif ($vacation->employee->seniority_days >=6 && $vacation->employee->seniority_days <11  )
                                    <td class="text-center" style="background-color: #fcebb3">
                                        <span class="badge rounded-pill bg-success">22</span>
                                    </td>
                                @elseif ($vacation->employee->seniority_days >=11 && $vacation->employee->seniority_days <16  )
                                    <td class="text-center" style="background-color: #fcebb3">
                                        <span class="badge rounded-pill bg-success">24</span>
                                    </td>
                                @elseif ($vacation->employee->seniority_days >=16 && $vacation->employee->seniority_days <21  )
                                    <td class="text-center" style="background-color: #fcebb3">
                                        <span class="badge rounded-pill bg-success">26</span>
                                    </td>
                                @elseif ($vacation->employee->seniority_days >=21 && $vacation->employee->seniority_days <26  )
                                    <td class="text-center" style="background-color: #fcebb3">
                                        <span class="badge rounded-pill bg-success">28</span>
                                    </td>
                                @elseif ($vacation->employee->seniority_days >=26 && $vacation->employee->seniority_days <31  )
                                    <td class="text-center" style="background-color: #fcebb3">
                                        <span class="badge rounded-pill bg-success">30</span>
                                    </td>
                                @endif


                                </td>
                                <td class="text-center" style="background-color: #fcebb3">{{ $vacation->remaining_days }}
                                </td>
                                @if ( $vacation->days == 0)
                                    <td class="text-center" style="background-color: #fcebb3">
                                        <span class="badge rounded-pill bg-danger"> {{ $vacation->days }}</span>
                                    </td>
                                @else
                                    <td class="text-center" style="background-color: #fcebb3">
                                        <span class="badge rounded-pill bg-info">{{ $vacation->days }}</span>
                                    </td>
                                @endif
                                

                                <td class="text-center">
            
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
            <button class="btn btn-warning" wire:click="calculateDaysOfVacation">Calcular días</button>
        </div>
    </div>
</div>