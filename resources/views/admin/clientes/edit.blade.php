@extends('layouts.app')

@section('title', 'Editar Cliente')

@section('content')

<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card shadow-sm border-0 rounded-4">
                <div class="card-body p-4">
                    <h2 class="h4 mb-1">Editar cliente</h2>
                    <p class="text-muted mb-4">Actualiza los datos básicos del cliente sin afectar sus reservas.</p>

                    <form action="{{ route('clientes.update', $cliente) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label">Nombre</label>
                                <input type="text" name="name" class="form-control" value="{{ old('name', $cliente->name) }}" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Apellido</label>
                                <input type="text" name="apellido" class="form-control" value="{{ old('apellido', $cliente->apellido) }}">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Email</label>
                                <input type="email" name="email" class="form-control" value="{{ old('email', $cliente->email) }}" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Teléfono</label>
                                <input type="text" name="telefono" class="form-control" value="{{ old('telefono', $cliente->telefono) }}">
                            </div>
                            <div class="col-md-12">
                                <label class="form-label">Dirección</label>
                                <input type="text" name="direccion" class="form-control" value="{{ old('direccion', $cliente->direccion) }}">
                            </div>
                        </div>

                        <div class="mt-4 d-flex gap-2">
                            <button type="submit" class="btn btn-dark">Guardar cambios</button>
                            <a href="{{ route('clientes.index') }}" class="btn btn-outline-secondary">Cancelar</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
