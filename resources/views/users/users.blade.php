@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
<h1>Lista de usuarios</h1>
@stop

@section('content')
<livewire:users.users-component />

@stop

@section('css')
@livewireStyles
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

@stop

@section('js')
@livewireScripts
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
    crossorigin="anonymous"></script>

<script>
    Livewire.on('render', () => {
        var modal = bootstrap.Modal.getInstance(document.getElementById('addModal'));
        if (modal) {
            modal.hide();
        }
        Swal.fire({
            icon: 'success',
            title: 'Usuario Agregado',
            text: 'El usuario se ha agregado correctamente.',
        });
    });
    Livewire.on('deleteUser', () => {
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