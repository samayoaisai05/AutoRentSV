<?php

namespace App\Http\Controllers;

use App\Models\Reserva;
use App\Models\Vehiculo;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReservaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $reservas = Reserva::with(['user', 'vehiculo'])
            ->latest()
            ->get();

        return view('admin.reservas.index', compact('reservas'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Vehiculo $vehiculo)
    {
        if ($vehiculo->estado !== 'Disponible') {
            return redirect()->route('catalogo.index')
                ->with('error', 'Este vehículo no está disponible para reservar en este momento.');
        }

        return view('reservas.create', compact('vehiculo'));
    }

    public function misReservas()
    {
        $reservas = Reserva::with('vehiculo')
            ->where('user_id', Auth::id())
            ->latest()
            ->get();

        return view('cliente.reservas', compact('reservas'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'vehiculo_id' => 'required|exists:vehiculos,id',
            'fecha_inicio' => 'required|date|after_or_equal:today',
            'fecha_fin' => 'required|date|after_or_equal:fecha_inicio',
        ]);

        $vehiculo = Vehiculo::findOrFail($request->vehiculo_id);

        if ($vehiculo->estado !== 'Disponible') {
            return back()->with('error', 'Este vehículo ya no está disponible para reservar.');
        }

        $fechaInicio = Carbon::parse($request->fecha_inicio);
        $fechaFin = Carbon::parse($request->fecha_fin);
        $dias = $fechaInicio->diffInDays($fechaFin) + 1;
        $total = $vehiculo->precio_dia * $dias;

        Reserva::create([
            'user_id' => Auth::id(),
            'vehiculo_id' => $vehiculo->id,
            'fecha_inicio' => $fechaInicio->format('Y-m-d'),
            'fecha_fin' => $fechaFin->format('Y-m-d'),
            'dias' => $dias,
            'precio_dia' => $vehiculo->precio_dia,
            'total' => $total,
            'estado' => 'Pendiente',
        ]);

        $vehiculo->update(['estado' => 'Reservado']);

        return redirect()->route('reservas.mis')
            ->with('success', 'Reserva creada correctamente. El vehículo quedó marcado como reservado.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Reserva $reserva)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Reserva $reserva)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Reserva $reserva)
    {
        $nuevoEstado = $request->estado;

        $reserva->update([
            'estado' => $nuevoEstado
        ]);

        $vehiculo = $reserva->vehiculo;

        if ($vehiculo) {
            if (in_array($nuevoEstado, ['Aprobada', 'Pendiente'])) {
                $vehiculo->update(['estado' => 'Reservado']);
            } elseif (in_array($nuevoEstado, ['Finalizada', 'Cancelada'])) {
                $vehiculo->update(['estado' => 'Disponible']);
            }
        }

        return back()->with('success', 'Estado actualizado correctamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Reserva $reserva)
    {
        //
    }
}
