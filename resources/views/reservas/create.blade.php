@extends('layouts.app')

@section('title', 'Reservar Vehículo')

@section('content')

<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card shadow-sm border-0 rounded-4">
                <div class="card-body p-4">
                    <h2 class="h4 mb-1">Reservar vehículo</h2>
                    <p class="text-muted mb-4">Completa las fechas para confirmar tu reserva.</p>

                    @if(session('error'))
                        <div class="alert alert-danger">{{ session('error') }}</div>
                    @endif

                    <div class="row g-4 align-items-center mb-4">
                        <div class="col-md-4">
                            @if($vehiculo->imagen)
                                <img src="{{ asset('storage/vehiculos/' . $vehiculo->imagen) }}" class="img-fluid rounded" alt="{{ $vehiculo->marca }}">
                            @else
                                <img src="https://via.placeholder.com/400x250" class="img-fluid rounded" alt="Vehículo">
                            @endif
                        </div>
                        <div class="col-md-8">
                            <h3 class="mb-2">{{ $vehiculo->marca }} {{ $vehiculo->modelo }}</h3>
                            <p class="mb-1"><strong>Placa:</strong> {{ $vehiculo->placa }}</p>
                            <p class="mb-1"><strong>Precio por día:</strong> ${{ number_format($vehiculo->precio_dia, 2) }}</p>
                            <p class="mb-0"><strong>Estado actual:</strong> {{ $vehiculo->estado }}</p>
                        </div>
                    </div>

                    <form action="{{ route('reservas.store') }}" method="POST">
                        @csrf
                        <input type="hidden" name="vehiculo_id" value="{{ $vehiculo->id }}">

                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label">Fecha de inicio</label>
                                <input type="date" name="fecha_inicio" class="form-control" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Fecha de fin</label>
                                <input type="date" name="fecha_fin" class="form-control" required>
                            </div>
                        </div>

                        <div class="mt-4 d-flex gap-2">
                            <button type="submit" class="btn btn-warning">Confirmar reserva</button>
                            <a href="{{ route('catalogo.show', $vehiculo->id) }}" class="btn btn-outline-secondary">Volver</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
