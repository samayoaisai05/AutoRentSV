@extends('layouts.app')

@section('title', 'Gestión de Clientes')

@section('content')

<div class="container py-5">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="fw-bold text-primary">
            Gestión de Clientes
        </h2>
    </div>

    {{-- Buscador --}}
    <div class="card shadow-sm mb-4">
        <div class="card-body">

            <form method="GET" action="{{ route('clientes.index') }}">
                <div class="row">

                    <div class="col-md-10">
                        <input
                            type="text"
                            name="buscar"
                            class="form-control"
                            placeholder="Buscar por nombre o correo..."
                            value="{{ request('buscar') }}">
                    </div>

                    <div class="col-md-2">
                        <button class="btn btn-primary w-100">
                            Buscar
                        </button>
                    </div>

                </div>
            </form>

        </div>
    </div>

    {{-- Tabla --}}
    <div class="card shadow">

        <div class="card-header bg-dark text-white">
            Clientes registrados
        </div>

        <div class="card-body">

            @if($clientes->count())

                <div class="table-responsive">

                    <table class="table table-hover align-middle">

                        <thead class="table-light">

                            <tr>
                                <th>ID</th>
                                <th>Nombre</th>
                                <th>Correo</th>
                                <th>Teléfono</th>
                                <th>Dirección</th>
                                <th>Reservas</th>
                                <th>Acciones</th>
                            </tr>

                        </thead>

                        <tbody>

                        @foreach($clientes as $cliente)

                            <tr>

                                <td>
                                    {{ $cliente->id }}
                                </td>

                                <td>
                                    {{ $cliente->nombre }}
                                    {{ $cliente->apellido }}
                                </td>

                                <td>
                                    {{ $cliente->correo }}
                                </td>

                                <td>
                                    {{ $cliente->telefono }}
                                </td>

                                <td>
                                    {{ $cliente->direccion }}
                                </td>

                                <td>
                                    <span class="badge bg-primary">
                                        {{ $cliente->reservas->count() }}
                                    </span>
                                </td>

                                <td>

                                    <div class="btn-group">

                                        <a href="#"
                                           class="btn btn-info btn-sm">
                                            Ver
                                        </a>

                                        <a href="#"
                                           class="btn btn-warning btn-sm">
                                            Editar
                                        </a>

                                        <form action="#"
                                              method="POST">

                                            @csrf
                                            @method('DELETE')

                                            <button
                                                class="btn btn-danger btn-sm"
                                                onclick="return confirm('¿Eliminar cliente?')">
                                                Eliminar
                                            </button>

                                        </form>

                                    </div>

                                </td>

                            </tr>

                        @endforeach

                        </tbody>

                    </table>

                </div>

            @else

                <div class="alert alert-info text-center">
                    No hay clientes registrados.
                </div>

            @endif

        </div>

    </div>

</div>

@endsection