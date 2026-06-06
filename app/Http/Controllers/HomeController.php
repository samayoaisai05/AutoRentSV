<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Reserva;
use App\Models\Vehiculo;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function dashboard()
    {
        $usuario = Auth::user();

        // Dashboard del administrador
        if ($usuario->is_admin) {

            $totalVehiculos = Vehiculo::count();
            $totalClientes = User::where('is_admin', 0)->count();
            $totalReservas = Reserva::count();

            return view('admin.dashboard', compact(
                'totalVehiculos',
                'totalClientes',
                'totalReservas'
            ));
        }

        // Dashboard del cliente
        $misReservas = Reserva::where('user_id', $usuario->id)->count();

        $reservasActivas = Reserva::where('user_id', $usuario->id)
            ->where('estado', 'Confirmada')
            ->count();

        $reservasFinalizadas = Reserva::where('user_id', $usuario->id)
            ->where('estado', 'Finalizada')
            ->count();

        $totalGastado = Reserva::where('user_id', $usuario->id)
            ->sum('total');

        return view('cliente.dashboard', compact(
            'misReservas',
            'reservasActivas',
            'reservasFinalizadas',
            'totalGastado'
        ));
    }
}
