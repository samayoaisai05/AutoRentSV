<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\VehiculoController;
use App\Http\Controllers\ReservaController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ReporteController;
use App\Http\Controllers\ProfileController;

//Rutas públicas
Route::get('/', function () {
    return view('home.index');
})->name('home');

//Cátalogo público
Route::get('/catalogo', [VehiculoController::class, 'catalogo'])
    ->name('catalogo.index');

Route::get('/catalogo/{vehiculo}', [VehiculoController::class, 'show'])
    ->name('catalogo.show');

//Dashboard
Route::get('/dashboard', function () {

    if(auth()->user()->is_admin){

        return view('admin.dashboard');
    }

    return view('cliente.dashboard');

})->middleware(['auth'])->name('dashboard');

//Perfil de Breeze
Route::middleware('auth')->group(function () {

    Route::get('/profile', [ProfileController::class, 'edit'])
        ->name('profile.edit');

    Route::patch('/profile', [ProfileController::class, 'update'])
        ->name('profile.update');

    Route::delete('/profile', [ProfileController::class, 'destroy'])
        ->name('profile.destroy');

    //Reservas de clientes
    Route::get('/mis-reservas', [ReservaController::class, 'misReservas'])
        ->name('reservas.mis');

    Route::get('/reservar/{vehiculo}', [ReservaController::class, 'create'])
        ->name('reservas.create');

    Route::post('/reservar', [ReservaController::class, 'store'])
        ->name('reservas.store');

    //Vehículos de admin

    Route::resource('vehiculos', VehiculoController::class);

    //Clientes
    Route::get('/clientes', [HomeController::class, 'clientes'])
        ->name('clientes.index');

    //Reservas de admin
    Route::get('/admin/reservas', [ReservaController::class, 'index'])
        ->name('admin.reservas.index');

    Route::put('/admin/reservas/{reserva}', [ReservaController::class, 'update'])
        ->name('admin.reservas.update');

    //Reportes
    Route::get('/reportes', [ReporteController::class, 'index'])
        ->name('reportes.index');

    Route::get('/reportes/vehiculos', [ReporteController::class, 'vehiculosPdf'])
        ->name('reportes.vehiculos');

    Route::get('/reportes/clientes', [ReporteController::class, 'clientesPdf'])
        ->name('reportes.clientes');

    Route::get('/reportes/reservas', [ReporteController::class, 'reservasPdf'])
        ->name('reportes.reservas');
});

require __DIR__ . '/auth.php';