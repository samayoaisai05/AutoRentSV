@extends('layouts.app')

@section('title', 'Gestión de Vehículos')

@section('content')

<div class="container py-4">

    <div class="d-flex justify-content-between mb-4">

        <h2>Vehículos</h2>

        <a href="{{ route('vehiculos.create') }}"
           class="btn btn-warning">
            Nuevo Vehículo
        </a>

    </div>

    @if(session('success'))

        <div class="alert alert-success">
            {{ session('success') }}
        </div>

    @endif

    <table class="table table-bordered table-hover">

        <thead class="table-dark">

            <tr>
                <th>ID</th>
                <th>Marca</th>
                <th>Modelo</th>
                <th>Año</th>
                <th>Estado</th>
                <th>Acciones</th>
            </tr>

        </thead>

        <tbody>

            @foreach($vehiculos as $vehiculo)

            <tr>

                <td>{{ $vehiculo->id }}</td>
                <td>{{ $vehiculo->marca }}</td>
                <td>{{ $vehiculo->modelo }}</td>
                <td>{{ $vehiculo->anio }}</td>
                <td>{{ $vehiculo->estado }}</td>

                <td>

                    <a href="{{ route('vehiculos.edit',$vehiculo->id) }}"
                       class="btn btn-primary btn-sm">
                        Editar
                    </a>

                    <form action="{{ route('vehiculos.destroy',$vehiculo->id) }}"
                          method="POST"
                          class="d-inline">

                        @csrf
                        @method('DELETE')

                        <button class="btn btn-danger btn-sm">
                            Eliminar
                        </button>

                    </form>

                </td>

            </tr>

            @endforeach

        </tbody>

    </table>

</div>

@endsection