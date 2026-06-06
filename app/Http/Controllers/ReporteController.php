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

    // demás métodos...
}
