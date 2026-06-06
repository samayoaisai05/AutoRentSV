<?php

namespace App\Http\Controllers;

use App\Models\User;

class UsuarioController extends Controller
{
    public function perfil()
    {
        return view('perfil.index');
    }

    public function index()
    {
        $clientes = User::where('is_admin', 0)
            ->with('reservas')
            ->get();

        return view('admin.clientes.index', compact('clientes'));
    }
}
