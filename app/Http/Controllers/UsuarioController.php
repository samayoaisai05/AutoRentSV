<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UsuarioController extends Controller
{
    public function perfil()
    {
        return view('perfil.index');
    }

    public function index(Request $request)
    {
        $buscar = $request->input('buscar');

        $clientes = User::where('is_admin', 0)
            ->with('reservas')
            ->when($buscar, function ($query, $buscar) {
                $query->where(function ($q) use ($buscar) {
                    $q->where('name', 'like', "%{$buscar}%")
                      ->orWhere('apellido', 'like', "%{$buscar}%")
                      ->orWhere('email', 'like', "%{$buscar}%");
                });
            })
            ->latest()
            ->get();

        return view('admin.clientes.index', compact('clientes', 'buscar'));
    }

    public function edit(User $cliente)
    {
        return view('admin.clientes.edit', compact('cliente'));
    }

    public function update(Request $request, User $cliente)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'apellido' => ['nullable', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', 'unique:users,email,' . $cliente->id],
            'telefono' => ['nullable', 'string', 'max:20'],
            'direccion' => ['nullable', 'string', 'max:255'],
        ]);

        $cliente->update($request->all());

        return redirect()->route('clientes.index')->with('success', 'Cliente actualizado correctamente.');
    }

    public function destroy(User $cliente)
    {
        $cliente->delete();

        return redirect()->route('clientes.index')->with('success', 'Cliente eliminado correctamente.');
    }
}
