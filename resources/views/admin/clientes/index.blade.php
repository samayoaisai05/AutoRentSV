@extends('layouts.app')

@section('title', 'Gestión de Clientes')

@section('content')

<div class="container py-5">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="fw-bold mb-1">Gestión de Clientes</h2>
            <p class="text-muted mb-0">Administra usuarios, consulta reservas y mantiene la información del cliente actualizada.</p>
        </div>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="card shadow-sm border-0 mb-4">
        <div class="card-body">
            <form method="GET" action="{{ route('clientes.index') }}">
                <div class="row g-2">
                    <div class="col-md-10">
                        <input type="text" name="buscar" class="form-control" placeholder="Buscar por nombre, apellido o correo..." value="{{ old('buscar', $buscar ?? '') }}">
                    </div>
                    <div class="col-md-2">
                        <button class="btn btn-dark w-100">Buscar</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <div class="card shadow-sm border-0">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-dark">
                        <tr>
                            <th>ID</th>
                            <th>Nombre</th>
                            <th>Email</th>
                            <th>Teléfono</th>
                            <th>Dirección</th>
                            <th>Reservas</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($clientes as $cliente)
                            <tr>
                                <td>{{ $cliente->id }}</td>
                                <td>{{ $cliente->name }} {{ $cliente->apellido }}</td>
                                <td>{{ $cliente->email }}</td>
                                <td>{{ $cliente->telefono ?? '—' }}</td>
                                <td>{{ $cliente->direccion ?? '—' }}</td>
                                <td><span class="badge bg-primary">{{ $cliente->reservas->count() }}</span></td>
                                <td>
                                    <div class="btn-group">
                                        <a href="{{ route('clientes.edit', $cliente) }}" class="btn btn-warning btn-sm">Editar</a>
                                        <form action="{{ route('clientes.destroy', $cliente) }}" method="POST" class="d-inline" onsubmit="return confirm('¿Desea eliminar este cliente?');">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-danger btn-sm">Eliminar</button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center py-4">No hay clientes registrados.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

@endsection
