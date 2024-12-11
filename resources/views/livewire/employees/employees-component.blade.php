<div>
    <div class="card-header bg-white d-flex items-center">

        <div class="col-6 d-flex justify-start">
            <h5 class="text-start"><b>Tabla de empleados</b></h5>
        </div>
        <div class="col-6 d-flex justify-content-end">
            @can('users.create')
                @livewire('employees.create-employee')
            @endcan
        </div>
    </div>


    <div class="card-body bg-white ">

        <div class="row mb-2">
            <div class="col-4 d-flex justify-content-start ">
                <a href="{{ route('empleados.export') }}" class="btn btn-success">Exportar a excel</a>
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
        @if ($employees->count() > 0)
            <div style="overflow-x: auto; white-space: nowrap;">
                <table class="table table-striped table-bordered table-hover dataTable dtr-inline table-responsive">
                    <thead>
                        <th class="text-nowrap" style="display: none">Id</th>
                        <th class="text-center cursor-pointer sticky-col first-col" style="min-width: 65px"
                            wire:click="order('noi')">NOI
                            @if ($sort == 'noi')
                                @if ($direction == 'asc')
                                    <i class="fas fa-sort-up float-right mt-1"></i>
                                @else
                                    <i class="fas fa-sort-down float-right mt-1"></i>
                                @endif
                            @else

                                <i class="fas fa-sort float-right mt-1"></i>

                            @endif
                        </th>
                        <th class="text-center cursor-pointer sticky-col second-col " wire:click="order('first_name')">
                            Nombre Completo
                            @if ($sort == 'first_name')
                                @if ($direction == 'asc')
                                    <i class="fas fa-sort-up float-right mt-1"></i>
                                @else
                                    <i class="fas fa-sort-down float-right mt-1"></i>
                                @endif
                            @else

                                <i class="fas fa-sort float-right mt-1"></i>

                            @endif
                        </th>
                        <th class="text-center cursor-pointer" style="min-width: 150px"
                            wire:click="order('employee_number')">No.
                            Empleado
                            @if ($sort == 'employee_number')
                                @if ($direction == 'asc')
                                    <i class="fas fa-sort-up float-right mt-1"></i>
                                @else
                                    <i class="fas fa-sort-down float-right mt-1"></i>
                                @endif
                            @else

                                <i class="fas fa-sort float-right mt-1"></i>

                            @endif
                        </th>
                        <th class="text-nowrap">CategorÍa</th>
                        <th class="text-nowrap">Salario diario</th>
                        <th class="text-nowrap">Estatus</th>
                        <th class="text-nowrap">Fecha ingreso</th>
                        <th class="text-nowrap">Fecha baja</th>
                        <th class="text-nowrap">Genero</th>
                        <th class="text-nowrap">Tipo nómina</th>
                        <th class="text-nowrap">RFC</th>
                        <th class="text-nowrap">CURP</th>
                        <th class="text-nowrap">No. IMMS</th>
                        <th class="text-nowrap">Antiguedad</th>
                        <th class="text-nowrap">Tipo de empleado</th>
                        <th class="text-nowrap">Tipo de pago</th>
                        <th class="text-nowrap sticky-col last-col">Acciones</th>
                    </thead>
                    <tbody>

                        @foreach ($employees as $employee)
                            <tr>
                                <td class="text-nowrap" style="display: none">{{$employee->id}}</td>
                                <td class="text-nowrap  text-center sticky-col first-col"><span
                                        class="badge rounded-pill bg-success">{{$employee->noi}}</span></td>
                                <td class="text-nowrap sticky-col second-col text-uppercase text-center">{{$employee->name}}
                                    {{$employee->first_name}} {{$employee->last_name}}
                                </td>
                                <td class="text-nowrap text-uppercase text-center"><span
                                        class="badge rounded-pill bg-info">{{$employee->employee_number}}</span></td>
                                <td class="text-nowrap text-uppercase text-center">{{$employee->category}}</td>
                                <td class="text-nowrap text-uppercase text-center">{{$employee->daily_salary}}</td>
                                <td class="text-nowrap text-uppercase text-center">{{$employee->status}}</td>
                                <td class="text-nowrap text-uppercase text-center">{{$employee->hire_date}}</td>
                                <td class="text-nowrap text-uppercase text-center">{{$employee->termination_date}}</td>
                                <td class="text-nowrap text-uppercase text-center">{{$employee->gender}}</td>
                                <td class="text-nowrap text-uppercase text-center">{{$employee->payroll_type}}</td>
                                <td class="text-nowrap text-uppercase text-center">{{$employee->rfc}}</td>
                                <td class="text-nowrap text-uppercase text-center">{{$employee->curp}}</td>
                                <td class="text-nowrap text-uppercase text-center">{{$employee->imms_number}}</td>
                                <td class="text-nowrap text-uppercase text-center">{{$employee->seniority_days}}</td>
                                <td class="text-nowrap text-uppercase text-center">{{$employee->payment_type}}</td>
                                <td class="text-nowrap text-uppercase text-center">
                                    @if ($employee->employee_type=="EXTERNO")
                                    <button type="button" class="btn btn-info" data-bs-toggle="modal" data-bs-target="#showInfo"
                                            wire:click="showInfo('{{$employee->id}}','{{ $employee->employee_type }}')">
                                            {{$employee->employee_type}}
                                        </button>
                                        
                                    @elseif ($employee->employee_type=="INTERNO")
                                    <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#showInfo"
                                            wire:click="showInfo('{{$employee->id}}','{{ $employee->employee_type }}')">
                                            {{$employee->employee_type}}
                                        </button>
                                    @endif
                               
                                </td>

                                <td class="text-nowrap sticky-col last-col">
                                    <div class="d-inline-flex gap-2">
                                        <button type="button" class="btn btn-info" data-bs-toggle="modal" data-bs-target="#showModal"
                                            wire:click="showModal('{{$employee->id}}','{{$employee->noi}}','{{$employee->name}}','{{$employee->first_name}}','{{$employee->last_name}}','{{$employee->employee_number}}','{{$employee->curp}}','{{$employee->rfc}}','{{$employee->img_url}}','{{$employee->imms_number}}')">
                                            <i class="fas fa-eye"></i>
                                        </button>
                                        <a href="{{route('empleados.edit', $employee)}}" class="btn btn-primary"><i
                                                class="fas fa-edit"></i></a>
                                        @can('users.destroy')
                                            <button type="button"
                                                wire:click="assignName({{ $employee->id }}, '{{ $employee->name }}')"
                                                class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteModal">
                                                <i class="fas fa-trash"></i>
                                            </button>

                                        @endcan
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

            </div>
        @else
            <div class="row">
                <span> No existen registros</span>
            </div>

        @endif

    </div>


    <div class="card-footer">
        {{ $employees->links() }}
    </div>

    <div class="modal fade" id="showInfo" wire:ignore.self tabindex="-1" aria-labelledby="deleteModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="deleteModalLabel">Informacion general</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row col-12">
                        @if ($employee_type == 'EXTERNO')
                            <span> <b> CODIGO DE TRABAJO:</b> {{ $employeeData->work_code }}</span>
                        @elseif ($employee_type == 'INTERNO')
                            <span> <b> SALARIO DIARIO INTEGRADO:</b> {{ $employeeData->integrated_daily_salary  }}</span>
                            <span><b>EDAD: </b> {{ $employeeData->age }} </span>
                            <span><b>NIVEL DE ESTUDIO: </b> {{ $employeeData->level_study }} </span>
                            <span><b>TELEFONO: </b> {{ $employeeData->phone }} </span>
                            <span><b>TELEFONO FAMILIAR: </b> {{ $employeeData->familiar_phone }} </span>
                            <span><b>ESTADO: </b> {{ $employeeData->state }} </span>
                            <span><b>DIRECCION COMPLETA: </b> {{ $employeeData->full_address }}</span>
                            <span><b>CODIGO POSTAL: </b> {{ $employeeData->postal_code }} </span>
                            <span><b>DESCUENTO INFONAVIT: </b> {{ $employeeData->descount_infonavit }}</span>
                            <span><b>DESCUENTO FONACOT: </b>{{ $employeeData->descount_FONACOT }}</span>
                            <span><b>LICENCIA VEHICULAR: </b>{{ $employeeData->license_vehicle }}</span>
                            <span><b>OFICIO: </b>{{ $employeeData->job }}</span>
                            <span><b>RESIDENCIA: </b>{{ $employeeData->residence }}</span>

                        @endif

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>
    </div>


    <div class="modal fade" id="showModal" wire:ignore.self tabindex="-1" aria-labelledby="deleteModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content ">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="deleteModalLabel">Informacion general</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row col-12">
                        <div class="col-6">
                            <span><b>NOI:</b> {{ $noi }} </span>
                            <br><span><b>Nombre:</b> {{ $name }}</span>
                            <br><span><b>Primer nombre:</b> {{ $first_name }}</span>
                            <br><span><b>Primer apellido:</b> {{ $last_name }}</span>
                            <br><span><b>Número de empleado:</b> {{ $employee_number }}</span>
                            <br><span><b>Curp:</b> {{ $curp }}</span>
                            <br><span><b>RFC:</b> {{ $rfc }}</span>
                            <br><span> <b> Numero seguro social:</b> {{ $imms_number }}</span>
                        </div>
                        <div class="col-6 d-flex flex-column align-items-center ">
                            <label for="img">Foto del empleado</label>
                            <img src="{{asset($img_url) }}" style="width: 200px; height: 200px; object-fit: cover; border-radius: 50%; border: 2px solid #ccc; display: block; margin: 0 auto; margin-bottom: 10px; box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1)" alt="">
                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                <a class="btn btn-secondary" href="{{ url('/empleados/export-card/' . $idByUser) }}">Imprimir</a>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="deleteModal" wire:ignore.self tabindex="-1" aria-labelledby="deleteModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="deleteModalLabel">Eliminar Usuario</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <span>¿Estas seguro de eliminar el empleado {{ $name }} </span>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                    <button type="button" class="btn btn-danger" wire:click="destroy({{$id}})">Eliminar</button>
                </div>
            </div>
        </div>
    </div>
</div>