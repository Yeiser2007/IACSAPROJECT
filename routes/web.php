<?php

use App\Http\Controllers\EmployeesController;
use App\Http\Controllers\FortnightlyIncidents;
use App\Http\Controllers\IncidencesController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\WeeklyIncidents;
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
    Route::get('/vacaciones', [EmployeesController::class, 'vacations'])->name('empleados.vacaciones');
    // Route::get('/vacaciones/agregar', [EmployeesController::class, 'addVacation'])->name('empleados.vacaciones-agregar');
    Route::get('/vacations/agregar/{employee_id}', [EmployeesController::class, 'addVacation'])->name('vacations.create');
    //incidencias
    Route::resource('/incidencias', IncidencesController::class);
    Route::get('/incidencias/export/{week}', [IncidencesController::class, 'exportIncidences'])->name('incidencias.export');
    Route::post('/abilitations/add', [IncidencesController::class, 'addAbilitation'])->name('abilitaciones.store');
    
    //incidencias semanales

    Route::resource('/incidencias-semanales', WeeklyIncidents::class);


    //incidencias quincenales
    Route::resource('/incidencias-quincenales', FortnightlyIncidents::class);

    //vacaciones
    



});
