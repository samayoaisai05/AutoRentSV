<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Reserva;
use App\Models\Vehiculo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function dashboard(Request $request)
    {
        $usuario = Auth::user();

        /*
        |----------------------------------
        | ADMIN DASHBOARD
        |----------------------------------
        */
        if ($usuario->is_admin) {

            $totalVehiculos = Vehiculo::count();
            $vehiculosDisponibles = Vehiculo::where('estado', 'Disponible')->count();
            $vehiculosReservados = Vehiculo::where('estado', 'Reservado')->count();
            $vehiculosMantenimiento = Vehiculo::where('estado', 'Mantenimiento')->count();
            $totalClientes = User::where('is_admin', 0)->count();
            $totalReservas = Reserva::count();
            $reservasPendientes = Reserva::where('estado', 'Pendiente')->count();
            $reservasAprobadas = Reserva::where('estado', 'Aprobada')->count();
            $reservasFinalizadas = Reserva::where('estado', 'Finalizada')->count();
            $reservasCanceladas = Reserva::where('estado', 'Cancelada')->count();

            $totalIngresos = Reserva::where('estado', 'Aprobada')->sum('total');

            // =========================
            // FILTRO TIPO DASHBOARD
            // =========================
            $tipo = $request->tipo ?? 'mes';

            $query = Reserva::where('estado', 'Aprobada');

            if ($tipo == 'dia') {
                $data = $query->selectRaw('DATE(created_at) as label, SUM(total) as total')
                    ->groupBy('label')
                    ->orderBy('label')
                    ->get();
            } elseif ($tipo == 'semana') {
                $data = $query->selectRaw('WEEK(created_at) as label, SUM(total) as total')
                    ->groupBy('label')
                    ->orderBy('label')
                    ->get();
            } elseif ($tipo == 'mes') {
                $data = $query->selectRaw('MONTH(created_at) as label, SUM(total) as total')
                    ->groupBy('label')
                    ->orderBy('label')
                    ->get();
            } elseif ($tipo == 'anio') {
                $data = $query->selectRaw('YEAR(created_at) as label, SUM(total) as total')
                    ->groupBy('label')
                    ->orderBy('label')
                    ->get();
            }

            $meses = $data->pluck('label');
            $totales = $data->pluck('total');

            return view('admin.dashboard', compact(
                'totalVehiculos',
                'vehiculosDisponibles',
                'vehiculosReservados',
                'vehiculosMantenimiento',
                'totalClientes',
                'totalReservas',
                'reservasPendientes',
                'reservasAprobadas',
                'reservasFinalizadas',
                'reservasCanceladas',
                'totalIngresos',
                'meses',
                'totales',
                'tipo'
            ));
        }

        /*
        |----------------------------------
        | CLIENTE DASHBOARD
        |----------------------------------
        */

        $misReservas = Reserva::where('user_id', $usuario->id)->count();

        $reservasActivas = Reserva::where('user_id', $usuario->id)
            ->where('estado', 'Aprobada')
            ->count();

        $reservasFinalizadas = Reserva::where('user_id', $usuario->id)
            ->where('estado', 'Finalizada')
            ->count();

        $totalGastado = Reserva::where('user_id', $usuario->id)
            ->whereIn('estado', ['Aprobada', 'Finalizada'])
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
