@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
<h1>Editar usuario</h1>
@if (session('info'))


    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>{{session()->get('info')}}</strong>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>


@endif
@stop

@section('content')
<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="form-group col-6">
                <p class="h5">Nombre:</p>
                <input type="text" class="form-control" value="{{$user->name}}">
            </div>
            <div class="form-group col-6">
                <p class="h5">Correo:</p>
                <input type="email" class="form-control" value="{{$user->email}}">
            </div>
        </div>
        <div class="row">
            <div class="form-group col-6">
                <p class="h5">Contraseña Actual:</p>
                <input type="text" class="form-control" value="{{$user->password}}">
            </div>

        </div>
        <form action="{{ route('usuarios.update', $user) }}" method="POST">
            @csrf
            @method('PUT')

            @foreach ($roles as $role)
                <div>
                    <label>
                        <input type="checkbox" name="roles[]" value="{{ $role->id }}" {{ $user->roles->contains($role->id) ? 'checked' : '' }}>
                        {{ $role->name }}
                    </label>
                </div>
            @endforeach

            <button type="submit" class="btn btn-primary">Guardar</button>
        </form>
    </div>
</div>


@stop

@section('css')
@livewireStyles
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
@stop