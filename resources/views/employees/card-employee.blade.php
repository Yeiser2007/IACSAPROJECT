<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Credencial de Empleado</title>
    <style>
body {
    font-family: Arial, sans-serif;
    margin: 0;
    padding: 0;
    background-color: #fff; /* Ignora el fondo en el PDF */
}
.card {
    width: 650px;
    height: 250px;
    background-color: #fff;
    border: 1px solid #ddd; /* Cambiar sombra por borde, compatible con DomPDF */
    border-radius: 5px;
    display: table; /* Uso de table para alinear horizontalmente */
}
.card-body {
    display: table-row; /* Asegura la alineación en fila */
    width: 100%;
}
.card-section {
    display: table-cell; /* Crea columnas para los datos e imagen */
    vertical-align: middle; /* Centra el contenido verticalmente */
    padding: 10px;
    text-align: left;
}
.card-section:first-child {
    border-right: 1px solid #ddd;
}
.card-section span {
    display: block;
    margin-bottom: 5px;
    font-size: 14px;
    color: #333;
}
.card-section img {
    width: 120px;
    height: 150px;
    border-radius: 5px;
    object-fit: cover; /* Puede ser ignorado, pero válido en algunos casos */
    margin: 0 auto;
    display: block;
}
.card-section label {
    display: block;
    font-size: 12px;
    color: #555;
    margin-bottom: 5px;
    text-align: center;
}

    </style>
</head>
<body>
    <div class="card">
        <div class="card-body">
            <!-- Datos del empleado -->
            <div class="card-section">
                <span><b>NOI:</b> {{ $employee->noi }}</span>
                <span><b>Nombre:</b> {{ $employee->name }}</span>
                <span><b>Primer nombre:</b> {{ $employee->first_name }}</span>
                <span><b>Primer apellido:</b> {{ $employee->last_name }}</span>
                <span><b>Número de empleado:</b> {{ $employee->employee_number }}</span>
                <span><b>Curp:</b> {{ $employee->curp }}</span>
                <span><b>RFC:</b> {{ $employee->rfc }}</span>
                <span><b>Número seguro social:</b> {{ $employee->imms_number }}</span>
               

            </div>
            <!-- Foto del empleado -->
            <div class="card-section">
                <label for="img">Foto del empleado</label>
                <img src="{{ public_path($employee->img_url) }}" alt="Foto del empleado">
            </div>
        </div>
    </div>
</body>
</html>

           
