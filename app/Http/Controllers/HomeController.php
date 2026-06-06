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
            ->where('estado', 'Aprobada')
            ->count();

        $reservasFinalizadas = Reserva::where('user_id', $usuario->id)
            ->where('estado', 'Finalizada')
            ->count();

        $totalGastado = Reserva::where('user_id', $usuario->id)
            ->sum('total');

        $reservasRecientes = Reserva::with('vehiculo')
            ->where('user_id', $usuario->id)
            ->latest()
            ->take(5)
            ->get();

        return view('cliente.dashboard', compact(
            'usuario',
            'misReservas',
            'reservasActivas',
            'reservasFinalizadas',
            'totalGastado',
            'reservasRecientes'
        ));
    }
}
