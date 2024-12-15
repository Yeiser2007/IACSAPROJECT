<div>
    <div class="card mt-2">
        <div class="card-header">
            <h5>Registrar incidencias semanales</h5>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="form-group col-4">
                    <p class="h5">Selecciopne la semana:</p>
                    <select class="form-control" name="week">
                    </select>
                </div>
                <div class="form-group col-4">
                    <p class="h5">Empleado:</p>
                    <select class="form-control" name="employee">
                        
                    </select>
                </div>
                <div class="form-group col-4">
                    <p class="h5">Puesto:</p>
                    <input type="text" class="form-control" name="position">
                </div>
                <div class="form-group col-3">
                    <p class="h5"> Alta IMMS</p>
                    <input type="text" class="form-control" name="imms_number">
                </div>
                <div class="form-group col-3">
                    <p class="h5">Bono puntualidad y asistencia</p>
                    <input type="text" class="form-control" name="bonus">
                </div>
                <div class="form-group col-3">
                    <p class="h5">Prestamo/Descontar:</p>
                    <input type="text" class="form-control" name="loan">
                </div>
                <div class="form-group col-3">
                    <p class="h5">Turno</p>
                    <select class="form-control" name="shift">
                        <option value="Mañana">Mañana</option>  
                        <option value="Tarde">Tarde</option>  
                        <option value="Noche">Mixto</option>  
                    </select>
                </div>
                <div class="form-group col-12">
                    <p class="h5">Comentarios:</p>
                    <input type="text" class="form-control" name="comments">
                </div>

            </div>
        </div>
        <div class="card-footer d-flex justify-content-end">
            <button type="submit" class="btn btn-primary ">Registrar</button>
        </div>
    </div>
    <div class="card mt-2">
        <div class="card-header">
            <h5>Incidencias semanales</h5>
        </div>
        <div class="card-body">
            <table class="table table-striped table-bordered table-hover dataTable dtr-inline table-responsive">
                <thead>
                    <tr>
                        <th>NOI</th>
                        <th>No. empleado</th>
                        <th>Nombre</th>
                        <th>Categoria</th>
                        <th>Jornada</th>
                        <th>Fecha ingreso</th>
                        <th>Salario diario</th>
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
                        <th>Carga inicial</th>
                        <th>Parcialidad</th>
                        <th>Plazo</th>
                        <th>Saldo</th>
                        <th>Infonavit</th>
                        <th>Comentarios</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>   
            </table>
        </div>
        <div class="card-footer d-flex justify-content-end">
            <button class="btn btn-warning">Validar registros</button>
        </div>
    </div>
</div>