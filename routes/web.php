<?php

use App\Http\Controllers\EmployeesController;
use App\Http\Controllers\IncidencesController;
use App\Http\Controllers\UsersController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('landing');
})->name('landing');

Route::get('/login', function () {
    return view('auth.login');
})->name('login');

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('inicio');
    })->name('dashboard');
    
    Route::get('/usuarios/export', [UsersController::class, 'exportUsers'])->name('usuarios.export');
    Route::resource('/usuarios', UsersController::class);
    //empleados
    Route::get('/empleados/export', [EmployeesController::class, 'exportEmployees'])->name('empleados.export');
    Route::resource('/empleados', EmployeesController::class)->middleware('can:employees.index')->except('create','show')->names('empleados');
    Route::get('/empleados/export-card/{id}', [EmployeesController::class, 'exportPDF'])->name('empleados.exportPDF');
    //incidencias
    Route::resource('/incidencias', IncidencesController::class);
    Route::get('/incidencias/export/{week}', [IncidencesController::class, 'exportIncidences'])->name('incidencias.export');
    
});
