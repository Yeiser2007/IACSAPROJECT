<div>
    <button class="btn btn-success" style="width:200px !important;" data-bs-toggle="modal"
        data-bs-target="#addModal">Agregar</button>

    <div>
        @if (session()->has('message'))
            <div class="alert alert-success">
                {{ session('message') }}
            </div>
        @endif

        <form wire:submit.prevent="submit">
            <div class="modal fade" id="addModal" tabindex="-1" aria-labelledby="registroEmpleadosLabel"
                aria-hidden="true" wire:ignore.self>
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="registroEmpleadosLabel">Registro de Empleados</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="row col-12 mb-3">
                                <div class="multiform">
                                    <h2 class="mb-1">Registro de Empleados</h2>
                                    <div class="progress-bar bg-neutral-700">
                                        <div class="progress-bar-inner bg-neutral-700"
                                            style="width: {{ ($currentStep / 4) * 100 }}%;">
                                        </div>
                                    </div>
                                    <div class="progress-container">
                                        <div class="step-indicator">Datos Personales</div>
                                        <div class="step-indicator">Información Laboral</div>
                                        <div class="step-indicator">Tipo empleado</div>
                                        <div class="step-indicator">Resumen</div>
                                        <div class="step-indicator">{{$currentStep}}</div>
                                    </div>

                                    <!-- Paso 1: Datos Personales -->
                                    <div class="step @if($currentStep === 1) active @endif">
                                        <div class="row col-12">
                                            <div class="col-6">
                                                <label for="noi" class="form-label">NOI:</label>
                                                <input type="text" class="form-control" id="noi" wire:model="noi">
                                                @error('noi')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                            <div class="col-6">
                                                <label for="employee_number" class="form-label">Numero de
                                                    Empleado:</label>
                                                <input type="text" class="form-control" id="employee_number"
                                                    wire:model="employee_number">
                                                @error('employee_number')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="row col-12">
                                            <div class="col-4">
                                                <label for="apellidoP" class="form-label">Apellido Paterno:</label>
                                                <input type="text" class="form-control" id="apellidoP"
                                                    wire:model="first_name" required>
                                                @error('first_name')
                                                <span class="text-danger">{{ $message }}</span> @enderror
                                            </div>
                                            <div class="col-4">
                                                <label for="apellidoM" class="form-label">Apellido Materno:</label>
                                                <input type="text" class="form-control" id="apellidoM"
                                                    wire:model="last_name" required>
                                                @error('last_name')
                                                <span class="text-danger">{{ $message }}</span> @enderror
                                            </div>
                                            <div class="col-4">
                                                <label for="nombre" class="form-label">Nombre:</label>
                                                <input type="text" class="form-control" id="nombre" wire:model="name"
                                                    required>
                                                @error('name') <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="row col-12">
                                            <div class="col-6">
                                                <label for="genero" class="form-label">Género:</label>
                                                <select class="form-select" id="genero" wire:model="gender" required>
                                                    <option value="">Seleccione</option>
                                                    <option value="M">Masculino</option>
                                                    <option value="F">Femenino</option>
                                                    <option value="OTRO">Otro</option>
                                                </select>
                                                @error('gender') <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                            <div class="col-6">
                                                <label for="img" class="form-label">Seleccione una imagen</label>
                                                <input type="file" class="form-control" id="img" wire:model="img">
                                                @error('img') <span class="text-danger">{{ $message }}</span> @enderror
                                            </div>
                                        </div>

                                    </div>

                                    <!-- Paso 2: Información Laboral -->
                                    <div class="step @if($currentStep === 2) active @endif">
                                        <div class="row col-12">
                                            <div class="col-4">
                                                <label for="hire_date" class="form-label">Fecha de Ingreso:</label>
                                                <input type="date" class="form-control" id="hire_date"
                                                    wire:model.live="hire_date" required>
                                                @error('hire_date') <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                            <div class="col-4">
                                                <label for="seniority_days" class="form-label">Dias de
                                                    antiguedad</label>
                                                <input type="text" class="form-control" id="seniority_days"
                                                    wire:model="seniority_days" readonly>
                                                @error('seniority_days') <span class="text-danger">{{ $message }}</span>
                                                @enderror

                                            </div>
                                            <div class="col-4">
                                                <label for="status" class="form-label">Estatus:</label>
                                                <select class="form-select" id="status" wire:model="status" required>
                                                    <option value="">Seleccione</option>
                                                    <option value="Alta">Alta</option>
                                                    <option value="Baja">Baja</option>
                                                </select>
                                                @error('status') <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>


                                        </div>
                                        <div class="row col-12">
                                            <div class="col-5">
                                                <label for="category" class="form-label">Categoría:</label>
                                                <input type="text" class="form-control" id="categoria"
                                                    wire:model="category" required>
                                                @error('category') <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                            <div class="col-7">
                                                <label for="imms_number" class="form-label">Número de IMSS:</label>
                                                <input type="text" class="form-control" id="imms_number"
                                                    wire:model="imms_number" required>
                                                @error('imms_number') <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="row col-12">
                                            <div class="col-6">
                                                <label for="rfc" class="form-label">RFC:</label>
                                                <input type="text" class="form-control" id="rfc" wire:model="rfc"
                                                    required>
                                                @error('rfc') <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                            <div class="col-6">
                                                <label for="curp" class="form-label">CURP:</label>
                                                <input type="text" class="form-control" id="curp" wire:model="curp"
                                                    required>
                                                @error('curp') <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="row col-12">
                                            <div class="col-4">
                                                <label for="payroll_type" class="form-label">Tipo de nomina:</label>
                                                <select class="form-select" id="payroll_type" wire:model="payroll_type"
                                                    required>
                                                    <option value="">Seleccione</option>
                                                    <option value="A">A</option>
                                                    <option value="B">B</option>
                                                </select>
                                                @error('payroll_type') <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                            <div class="col-4">
                                                <label for="payment_type" class="form-label">Tipo de pago:</label>
                                                <select class="form-select" id="payment_type" wire:model="payment_type"
                                                    required>
                                                    <option value="">SELECCIONE UNA OPCION</option>
                                                    <option value="SEMANAL">SEMANAL</option>
                                                    <option value="QUINCENAL">QUINCENAL</option>
                                                </select>
                                                @error('payment_type') <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                            <div class="col-4">
                                                <label for="daily_salary" class="form-label">Salario Diario</label>
                                                <input type="text" class="form-control" id="imms_number"
                                                    wire:model="daily_salary" required>
                                                @error('daily_salary') <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>

                                        </div>


                                    </div>

                                    <!-- Paso 3: Contacto -->
                                    <div class="step @if($currentStep === 3) active @endif">
                                        <div class="row col-12">
                                            <div class="col-8">
                                                <label for="employee_type" class="form-label">Tipo de empleado:</label>
                                                <select class="form-select" id="employee_type"
                                                    wire:model.live="employee_type" required>
                                                    <option value="">Seleccione</option>
                                                    <option value="INTERNO">INTERNO</option>
                                                    <option value="EXTERNO">EXTERNO</option>
                                                </select>
                                                @error('employee_type') <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        @if ($employee_type == 'INTERNO')
                                            <div class="row col-12">
                                                <div class="col-4">
                                                    <label for="age" class="form-label">Edad:</label>
                                                    <input type="number" class="form-control" id="age" wire:model="age"
                                                        required>
                                                    @error('age') <span class="text-danger">{{ $message }}</span>
                                                    @enderror

                                                </div>
                                                <div class="col-4">
                                                    <label for="familiar_phone" class="form-label">Telefono de
                                                        contacto:</label>
                                                    <input type="number" class="form-control" id="familiar_phone"
                                                        wire:model="familiar_phone" required>
                                                    @error('familiar_phone') <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                                <div class="col-4">
                                                    <label for="phone" class="form-label">Numero de telefono:</label>
                                                    <input type="number" class="form-control" id="phone" wire:model="phone"
                                                        required>
                                                    @error('phone') <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="col-12 row">
                                                <div class="col-4">
                                                    <label for="job">Oficio</label>
                                                    <input type="text" id="job" class="form-control" wire:model="job">
                                                    @error('job') <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                                <div class="col-4">
                                                    <label for="license_vehicle">Licencia vehicular</label>
                                                    <input type="text" id="license_vehicle" class="form-control"
                                                        wire:model="license_vehicle">
                                                    @error('license_vehicle') <span
                                                        class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                                <div class="col-4">
                                                    <label for="level_study">Nivel de estudios</label>
                                                    <input type="text" id="level_study" class="form-control"
                                                        wire:model="level_study">
                                                    @error('level_study') <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="row col-12">

                                                <div class="col-4">
                                                    <label for="postal_code" class="form-label">Codigo
                                                        postal</label>
                                                    <input type="number" id="postal_code" wire:model="postal_code"
                                                        class="form-control">
                                                    @error('postal_code') <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                                <div class="col-8">
                                                    <label for="full_address" class="form-label">Direccion
                                                        completa</label>
                                                    <input type="text" id="full_address" wire:model="full_address"
                                                        class="form-control">
                                                    @error('full_address') <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>

                                            </div>
                                            <div class="row">

                                                <div class="col-4">
                                                    <label for="residence" class="form-label">Recidencia</label>
                                                    <select class="form-select" id="residence" wire:model.live="residence"
                                                        required>
                                                        <option value="">Seleccione</option>
                                                        <option value="T">SI</option>
                                                        <option value="F">NO</option>
                                                    </select>
                                                    @error('residence') <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                                <div class="col-4">
                                                    <label for="state" class="form-label">Estado</label>
                                                    <input type="text" id="state" wire:model="state" class="form-control">
                                                    @error('state') <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="row col-12">
                                                <div class="col-4">
                                                    <label for="integrated_daily_salary" class="form-label">Salario
                                                        diario
                                                        integrado:</label>
                                                    <input type="integrated_daily_salary" class="form-control"
                                                        id="integrated_daily_salary" wire:model="integrated_daily_salary"
                                                        required>
                                                    @error('integrated_daily_salary') <span
                                                        class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                                <div class="col-4">
                                                    <label for="descount_infonavit">Descuento infonavit</label>
                                                    <input type="descount_infonavit" class="form-control"
                                                        id="descount_infonavit" wire:model="descount_infonavit">
                                                    @error('descount_infonavit') <span
                                                        class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                                <div class="col-4">
                                                    <label for="descount_FONACOT">Descuento FONACOT</label>
                                                    <input type="descount_FONACOT" class="form-control"
                                                        id="descount_FONACOT" wire:model="descount_FONACOT">
                                                    @error('descount_FONACOT') <span
                                                        class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>

                                            </div>
                                        @endif
                                        @if ($employee_type == 'EXTERNO')

                                            <div class="row col-12">
                                                <div class="col-6">
                                                    <label for="work_code" class="form-label">Codigo de obra:</label>
                                                    <input type="text" class="form-control" id="work_code"
                                                        wire:model="work_code" required>
                                                    @error('work_code') <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                        @endif
                                    </div>


                                    <!-- Paso 4: Resumen -->
                                    <div class="step @if($currentStep === 4) active @endif">
                                        <div class="col-12">
                                            <h3>Resumen</h3>
                                            <hr>
                                            <div class="row col-12">
                                                <div class="col-6">
                                                    <label for="noi">NOI:</label>
                                                    <span>{{ $noi }}</span>
                                                </div>
                                                <div class="col-6">
                                                    <label for="employee_number">Número de empleado:</label>
                                                    <span>{{ $employee_number }}</span>
                                                </div>
                                            </div>
                                            <div class="row col-12">
                                                <div class="col-6">
                                                    <label for="name">Nombre:</label>
                                                    <span>{{ $name }}</span>
                                                </div>
                                                <div class="col-6">
                                                    <label for="first_name">Primer nombre:</label>
                                                    <span>{{ $first_name }}</span>
                                                </div>
                                            </div>
                                            <div class="row col-12">
                                                <div class="col-6">
                                                    <label for="last_name">Primer apellido:</label>
                                                    <span>{{ $last_name }}</span>
                                                </div>
                                                <div class="col-6">
                                                    <label for="phone">Teléfono:</label>
                                                    <span>{{ $phone }}</span>
                                                </div>
                                            </div>
                                            <div class="row col-12">
                                                <div class="col-6">
                                                    <label for="gender">Género:</label>
                                                    <span>{{ $gender }}</span>
                                                </div>
                                                <div class="col-6">
                                                    <label for="hire_date">Fecha de contratación:</label>
                                                    <span>{{ $hire_date }}</span>
                                                </div>
                                            </div>
                                            <div class="row col-12">
                                                <div class="col-6">
                                                    <label for="category">Categoría:</label>
                                                    <span>{{ $category }}</span>
                                                </div>
                                                <div class="col-6">
                                                    <label for="status">Estado:</label>
                                                    <span>{{ $status }}</span>
                                                </div>
                                            </div>
                                            <div class="row col-12">
                                                <div class="col-6">
                                                    <label for="payroll_type">Tipo de nómina:</label>
                                                    <span>{{ $payroll_type }}</span>
                                                </div>
                                                <div class="col-6">
                                                    <label for="rfc">RFC:</label>
                                                    <span>{{ $rfc }}</span>
                                                </div>
                                            </div>
                                            <div class="row col-12">
                                                <div class="col-6">
                                                    <label for="curp">CURP:</label>
                                                    <span>{{ $curp }}</span>
                                                </div>
                                                <div class="col-6">
                                                    <label for="imms_number">Número de IMSS:</label>
                                                    <span>{{ $imms_number }}</span>
                                                </div>
                                            </div>
                                            <div class="row col-12">
                                                <div class="col-6">
                                                    <label for="seniority_days">Días de antigüedad:</label>
                                                    <span>{{ $seniority_days }}</span>
                                                </div>
                                                <div class="col-6">
                                                    <label for="daily_salary">Salario diario:</label>
                                                    <span>{{ $daily_salary }}</span>
                                                </div>
                                            </div>
                                            <div class="row col-12">
                                                <div class="col-6">
                                                    <label for="full_address">Dirección completa:</label>
                                                    <span>{{ $full_address }}</span>
                                                </div>
                                                <div class="col-6">
                                                    <label for="postal_code">Código postal:</label>
                                                    <span>{{ $postal_code }}</span>
                                                </div>
                                            </div>
                                            <div class="row col-12">
                                                <div class="col-6">
                                                    <label for="employee_type">Tipo de empleado:</label>
                                                    <span>{{ $employee_type }}</span>
                                                </div>
                                                <div class="col-6">
                                                    <label for="age">Edad:</label>
                                                    <span>{{ $age }}</span>
                                                </div>
                                            </div>
                                            <div class="row col-12">
                                                <div class="col-6">
                                                    <label for="integrated_daily_salary">Salario diario
                                                        integrado:</label>
                                                    <span>{{ $integrated_daily_salary }}</span>
                                                </div>
                                                <div class="col-6">
                                                    <label for="level_study">Nivel de estudio:</label>
                                                    <span>{{ $level_study }}</span>
                                                </div>
                                            </div>
                                            <div class="row col-12">
                                                <div class="col-6">
                                                    <label for="license_vehicle">Licencia de vehículo:</label>
                                                    <span>{{ $license_vehicle }}</span>
                                                </div>
                                                <div class="col-6">
                                                    <label for="familiar_phone">Teléfono familiar:</label>
                                                    <span>{{ $familiar_phone }}</span>
                                                </div>
                                            </div>
                                            <div class="row col-12">
                                                <div class="col-6">
                                                    <label for="job">Puesto de trabajo:</label>
                                                    <span>{{ $job }}</span>
                                                </div>
                                                <div class="col-6">
                                                    <label for="descount_infonavit">Descuento INFONAVIT:</label>
                                                    <span>{{ $descount_infonavit }}</span>
                                                </div>
                                            </div>
                                            <div class="row col-12">
                                                <div class="col-6">
                                                    <label for="descount_FONACOT">Descuento FONACOT:</label>
                                                    <span>{{ $descount_FONACOT }}</span>
                                                </div>
                                                <div class="col-6">
                                                    <label for="work_code">Código de obra:</label>
                                                    <span>{{ $work_code }}</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>


                                    <div class="modal-footer">
                                        @if ($currentStep > 1)
                                            <button type="button" class="btn btn-secondary"
                                                wire:click="previousStep">Anterior</button>
                                        @endif

                                        @if ($currentStep < 4)
                                            <button type="button" class="btn btn-primary"
                                                wire:click="nextStep">Siguiente</button>
                                        @endif

                                        @if ($currentStep === 4)
                                            <button type="submit" class="btn btn-success">Registrar
                                                Empleado <div class="spinner-border text-dark" wire:loading
                                                    wire:target="save" role="status">
                                                    <span class="visually-hidden">Loading...</span>
                                                </div></button>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>