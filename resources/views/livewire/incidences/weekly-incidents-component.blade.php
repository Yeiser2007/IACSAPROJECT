<div>
    <div class="card mt-3">
        <div class="card-header">
            <h5>Registrar incidencias semanales</h5>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="form-group col-6">
                    <p class="h5">Selecciopne la semana:</p>
                    <select class="form-control" name="week">
                    </select>
                </div>
                <div class="form-group col-6">
                    <p class="h5">Empleado:</p>
                    <select class="form-control" name="employee">
                        
                    </select>
                </div>
                <div class="form-group col-3">
                    <p class="h5">Bono de puntualidad:</p>
                    <input type="text" class="form-control" name="bonus">
                </div>   
                <div class="form-group col-3">
                    <p class="h5">Dias de vacacaiones:</p>
                    <input type="text" class="form-control" name="vacation_days">   
                </div>
                <div class="form-group col-3">
                    <p class="h5">Prima Vacacional</p>
                    <input type="text" class="form-control" name="vacation_salary">
                </div>
                <div class="form-group col-3">
                    <p class="h5">Turno:</p>
                    <select class="form-control" name="shift">
                        <option value="Mañana">Mañana</option>  
                        <option value="Tarde">Tarde</option>  
                        <option value="Noche">Noche</option>  
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
<div class="card">
        <div class="card-header">
            <h5>Incidencias semanales</h5>
        </div>
        <div class="card-body">
            <table class="table table-striped table-bordered table-hover dataTable dtr-inline table-responsive">
                <thead>
                    <tr>
                        <th>NOI</th>
                       
                        <th>Nombre</th>
                        <th>Puesto</th>
                        <th>Sueldo bruto mensual</th>
                        <th>Alta IMMS</th>
                        <th>Sueldo bruto mensual</th>
                        <th>Sueldo libre mensual</th>
                        <th>Pago</th>
                        <th>Dias Trabajados</th>
                        <th>Infonavit</th>
                        <th>Festivo Laborado</th>
                        <th>bono Puntualidad y Asistencia</th>
                        <th>Prestamo Descontar </th>
                        <th>Turno</th>
                        <th>Comentarios</th>
                        <th>Estatus</th>
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
