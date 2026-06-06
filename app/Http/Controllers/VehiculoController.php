<?php

namespace App\Http\Controllers;

use App\Models\Vehiculo;
use Illuminate\Http\Request;

class VehiculoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $vehiculos = Vehiculo::all();

        return view('admin.vehiculos.index', compact('vehiculos'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.vehiculos.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $datos = $request->all();

        if ($request->hasFile('imagen')) {
            $nombre = time() . '_' . $request->imagen->getClientOriginalName();

            $request->imagen->storeAs(
                'vehiculos',
                $nombre,
                'public'
            );

            $datos['imagen'] = $nombre;
        }

        Vehiculo::create($datos);

        return redirect()
            ->route('vehiculos.index')
            ->with('success', 'Vehículo registrado correctamente');
    }

    /**
     * Display the specified resource.
     */
    public function catalogo()
    {
        $vehiculos = Vehiculo::where('estado', 'Disponible')->get();

        return view('catalogo.index', compact('vehiculos'));
    }

    public function show(Vehiculo $vehiculo)
    {
        return view('catalogo.show', compact('vehiculo'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Vehiculo $vehiculo)
    {
        return view('admin.vehiculos.edit', compact('vehiculo'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Vehiculo $vehiculo)
    {
        $request->validate([
            'marca' => 'required',
            'modelo' => 'required',
            'anio' => 'required',
            'color' => 'required',
            'precio_dia' => 'required|numeric',
            'estado' => 'required'
        ]);

        $vehiculo->update($request->all());

        return redirect()
            ->route('vehiculos.index')
            ->with('success', 'Vehículo actualizado correctamente');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Vehiculo $vehiculo)
    {
        $vehiculo->delete();

        return redirect()
            ->route('vehiculos.index')
            ->with('success', 'Vehículo eliminado correctamente');
    }
}
