<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\VehiculoController;
use App\Http\Controllers\ReservaController;
use App\Http\Controllers\ReporteController;
use App\Http\Controllers\UsuarioController;

/*
|--------------------------------------------------------------------------
| Rutas públicas
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return view('home.index');
})->name('home');

Route::get('/catalogo', [VehiculoController::class, 'catalogo'])
    ->name('catalogo.index');

Route::get('/catalogo/{vehiculo}', [VehiculoController::class, 'show'])
    ->name('catalogo.show');


/*
|--------------------------------------------------------------------------
| Dashboard
|--------------------------------------------------------------------------
*/

Route::get('/dashboard', [HomeController::class, 'dashboard'])
    ->middleware('auth')
    ->name('dashboard');


/*
|--------------------------------------------------------------------------
| Rutas protegidas
|--------------------------------------------------------------------------
*/

Route::middleware('auth')->group(function () {

    /*
    |--------------------------------------------------------------------------
    | Perfil
    |--------------------------------------------------------------------------
    */

    Route::get('/profile', [ProfileController::class, 'edit'])
        ->name('profile.edit');

    Route::patch('/profile', [ProfileController::class, 'update'])
        ->name('profile.update');

    Route::delete('/profile', [ProfileController::class, 'destroy'])
        ->name('profile.destroy');

    Route::get('/mi-perfil', function () {
    return view('cliente.perfil');
})->middleware('auth')->name('cliente.perfil');


    /*
    |--------------------------------------------------------------------------
    | Cliente
    |--------------------------------------------------------------------------
    */

    Route::get('/mis-reservas', [ReservaController::class, 'misReservas'])
        ->name('reservas.mis');

    Route::get('/reservar/{vehiculo}', [ReservaController::class, 'create'])
        ->name('reservas.create');

    Route::post('/reservar', [ReservaController::class, 'store'])
        ->name('reservas.store');

    Route::get('/factura/{reserva}', [ReservaController::class, 'factura'])
        ->name('factura');


    /*
    |--------------------------------------------------------------------------
    | Vehículos (Admin)
    |--------------------------------------------------------------------------
    */

    Route::resource('vehiculos', VehiculoController::class);


    /*
    |--------------------------------------------------------------------------
    | Clientes (Admin)
    |--------------------------------------------------------------------------
    */

    Route::get('/clientes', [UsuarioController::class, 'index'])
        ->name('clientes.index');

    Route::get('/clientes/{cliente}/edit', [UsuarioController::class, 'edit'])
        ->name('clientes.edit');

    Route::put('/clientes/{cliente}', [UsuarioController::class, 'update'])
        ->name('clientes.update');

    Route::delete('/clientes/{cliente}', [UsuarioController::class, 'destroy'])
        ->name('clientes.destroy');


    /*
    |--------------------------------------------------------------------------
    | Reservas (Admin)
    |--------------------------------------------------------------------------
    */

    Route::get('/admin/reservas', [ReservaController::class, 'index'])
        ->name('admin.reservas.index');

    Route::put('/admin/reservas/{reserva}', [ReservaController::class, 'update'])
        ->name('admin.reservas.update');


    /*
    |--------------------------------------------------------------------------
    | Reportes
    |--------------------------------------------------------------------------
    */

    Route::get('/reportes', [ReporteController::class, 'index'])
        ->name('reportes.index');

    Route::get('/reportes/vehiculos', [ReporteController::class, 'vehiculosPdf'])
        ->name('reportes.vehiculos');

    Route::get('/reportes/clientes', [ReporteController::class, 'clientesPdf'])
        ->name('reportes.clientes');

    Route::get('/reportes/reservas', [ReporteController::class, 'reservasPdf'])
        ->name('reportes.reservas');

    Route::get('/reportes/reservas/filtradas', [ReporteController::class, 'reservasFiltradas'])
        ->name('reportes.reservas.filtradas');

    Route::get('/reportes/ingresos', [ReporteController::class, 'ingresos'])
        ->name('reportes.ingresos');

});

require __DIR__.'/auth.php';