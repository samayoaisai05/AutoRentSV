<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Reserva;
use App\Models\Vehiculo;
use Barryvdh\DomPDF\Facade\Pdf;

class ReporteController extends Controller
{
    public function index()
    {
        $totalVehiculos = Vehiculo::count();
        $totalClientes = User::where('is_admin', 0)->count();
        $totalReservas = Reserva::count();

        return view('admin.reportes.index', compact(
            'totalVehiculos',
            'totalClientes',
            'totalReservas'
        ));
    }

    public function vehiculosPdf()
    {
        $vehiculos = Vehiculo::all();

        return Pdf::loadView('pdf.vehiculos', compact('vehiculos'))
            ->download('vehiculos.pdf');
    }

    public function clientesPdf()
    {
        $clientes = User::where('is_admin', 0)->get();

        return Pdf::loadView('pdf.clientes', compact('clientes'))
            ->download('clientes.pdf');
    }

    public function reservasPdf()
    {
        $reservas = Reserva::with(['user', 'vehiculo'])->latest()->get();

        return Pdf::loadView('pdf.reservas', compact('reservas'))
            ->download('reservas.pdf');
    }
}
