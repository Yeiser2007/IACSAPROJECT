@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
<h1>Lista de empleados</h1>
@stop

@section('content')
<livewire:employees.employees-component />

@stop

@section('css')
@livewireStyles
@vite('resources/css/form.css')
@vite('resources/css/table.css')
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

@stop

@section('js')
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
    crossorigin="anonymous"></script>
@livewireScripts
@if(session('success'))
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            Swal.fire({
                icon: 'success',
                title: 'Empleado',
                text: '{{ session("success") }}',
            });
        });
    </script>
@endif
@if(session('Alert'))
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            Swal.fire({
                icon: 'info',
                title: 'Empleado Eliminado',
                text: '{{ session("Alert") }}',
            });
        });
    </script>
@endif

<script>
    Livewire.on('render', () => {
        var modal = bootstrap.Modal.getInstance(document.getElementById('addModal'));
        if (modal) {
            modal.hide();
        }
        Swal.fire({
            icon: 'success',
            title: 'Empleado Agregado',
            text: 'El empleado se ha agregado correctamente.',
        });
    });
    Livewire.on('deleteEmployee', () => {
        var modal = bootstrap.Modal.getInstance(document.getElementById('deleteModal'));
        if (modal) {
            modal.hide();
        }
        Swal.fire({
            icon: 'success',
            title: 'Usuario Eliminado',
            text: 'El usuario se ha eliminado correctamente.',
        });
    });
</script>




@stop