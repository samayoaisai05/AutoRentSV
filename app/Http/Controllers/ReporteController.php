<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
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

    public function reservasFiltradasPdf(Request $request)
    {
        $query = Reserva::with(['user', 'vehiculo']);

        // FILTRO POR FECHAS
        if ($request->inicio && $request->fin) {
            $query->whereBetween('fecha_inicio', [$request->inicio, $request->fin]);
        }

        // FILTRO POR MES
        if ($request->mes) {
            $query->whereMonth('fecha_inicio', $request->mes);
        }

        // FILTRO POR SEMANA
        if ($request->semana) {
            $query->whereBetween('fecha_inicio', [
                now()->startOfWeek(),
                now()->endOfWeek()
            ]);
        }

        $reservas = $query->latest()->get();

        return Pdf::loadView('pdf.reservas', compact('reservas'))
            ->stream('reporte-reservas.pdf');
    }

    public function vehiculosPdf()
    {
        $vehiculos = Vehiculo::all();

        $pdf = Pdf::loadView('pdf.vehiculos', compact('vehiculos'));

        return $pdf->stream('reporte-vehiculos.pdf'); // Pestaña nueva
    }

    public function clientesPdf()
    {
        $clientes = User::where('is_admin', 0)->get();

        return Pdf::loadView('pdf.clientes', compact('clientes'))
            ->stream('clientes.pdf'); // Pestaña nueva
    }

    public function reservasPdf()
    {
        $reservas = Reserva::with(['user', 'vehiculo'])->latest()->get();

        return Pdf::loadView('pdf.reservas', compact('reservas'))
            ->stream('reservas.pdf'); // Pestaña nueva
    }
}
