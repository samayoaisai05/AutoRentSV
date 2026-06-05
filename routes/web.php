<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\VehiculoController;
use App\Http\Controllers\ReservaController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ReporteController;
use App\Http\Controllers\UsuarioController;

//Ruta publica
Route::get('/', [HomeController::class, 'index'])
    ->name('home');

//Login y Registro
Route::get('/login', [UsuarioController::class, 'login'])
    ->name('login');

Route::post('/login', [UsuarioController::class, 'autenticar'])
    ->name('login.autenticar');

Route::get('/register', [UsuarioController::class, 'register'])
    ->name('register');

Route::post('/register', [UsuarioController::class, 'store'])
    ->name('register.store');

Route::post('/logout', [UsuarioController::class, 'logout'])
    ->name('logout');

//Catalogo de vehiculos
Route::get('/catalogo', [VehiculoController::class, 'catalogo'])
    ->name('catalogo.index');

Route::get('/catalogo/{vehiculo}', [VehiculoController::class, 'show'])
    ->name('catalogo.show');

//Perfil de cliente
Route::get('/perfil', [UsuarioController::class, 'perfil'])
    ->name('perfil');

Route::put('/perfil', [UsuarioController::class, 'actualizarPerfil'])
    ->name('perfil.update');

//Reservas de cliente
Route::get('/mis-reservas', [ReservaController::class, 'misReservas'])
    ->name('reservas.mis');

Route::get('/reservar/{vehiculo}', [ReservaController::class, 'create'])
    ->name('reservas.create');

Route::post('/reservar', [ReservaController::class, 'store'])
    ->name('reservas.store');

//Dashboard de administrador
Route::get('/dashboard', [HomeController::class, 'dashboard'])
    ->name('dashboard');

//Gestión de vehículos
Route::get('/vehiculos', [VehiculoController::class, 'index'])
    ->name('vehiculos.index');

Route::get('/vehiculos/create', [VehiculoController::class, 'create'])
    ->name('vehiculos.create');

Route::post('/vehiculos', [VehiculoController::class, 'store'])
    ->name('vehiculos.store');

Route::get('/vehiculos/{vehiculo}/edit', [VehiculoController::class, 'edit'])
    ->name('vehiculos.edit');

Route::put('/vehiculos/{vehiculo}', [VehiculoController::class, 'update'])
    ->name('vehiculos.update');

Route::delete('/vehiculos/{vehiculo}', [VehiculoController::class, 'destroy'])
    ->name('vehiculos.destroy');

//Gestión de clientes
Route::get('/clientes', [UsuarioController::class, 'index'])
    ->name('clientes.index');

//Gestión de reservas de Admin
Route::get('/admin/reservas', [ReservaController::class, 'index'])
    ->name('admin.reservas.index');

Route::put('/admin/reservas/{reserva}', [ReservaController::class, 'update'])
    ->name('admin.reservas.update');

//Reportes PDF
Route::get('/reportes', [ReporteController::class, 'index'])
    ->name('reportes.index');

Route::get('/reportes/vehiculos', [ReporteController::class, 'vehiculosPdf'])
    ->name('reportes.vehiculos');

Route::get('/reportes/clientes', [ReporteController::class, 'clientesPdf'])
    ->name('reportes.clientes');

Route::get('/reportes/reservas', [ReporteController::class, 'reservasPdf'])
    ->name('reportes.reservas');
