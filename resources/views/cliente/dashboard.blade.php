@extends('layouts.app')

@section('title', 'Dashboard Cliente')

@section('content')

<style>
    .dashboard-hero {
        background: linear-gradient(135deg, #0F172A, #1E3A5F);
        color: #fff;
        padding: 48px 0;
        border-radius: 0 0 24px 24px;
        margin-bottom: 32px;
    }

    .dashboard-card {
        border: none;
        border-radius: 18px;
        box-shadow: 0 10px 25px rgba(15, 23, 42, 0.10);
        height: 100%;
    }

    .dashboard-stat {
        border-left: 5px solid #F97316;
    }

    .stat-number {
        font-size: 1.8rem;
        font-weight: 700;
        color: #F97316;
    }

    .badge-status {
        font-size: 0.85rem;
        padding: 0.45rem 0.65rem;
        border-radius: 999px;
    }
</style>

<div class="dashboard-hero">
    <div class="container">
        <h1 class="fw-bold mb-2">Bienvenidos, {{ $usuario->name }}</h1>
        <p class="mb-0 text-white">Aquí puedes ver tu información personal, el resumen de tus reservas y el total gastado en AutoRent SV.</p>
    </div>
</div>

<div class="container pb-5">
    <div class="row g-4">
        <div class="col-lg-4">
            <div class="card dashboard-card p-4">
                <h4 class="mb-3">Tu información</h4>
                <ul class="list-group list-group-flush">
                    <li class="list-group-item px-0"><strong>Nombre:</strong> {{ $usuario->name }} {{ $usuario->apellido ?? '' }}</li>
                    <li class="list-group-item px-0"><strong>Email:</strong> {{ $usuario->email }}</li>
                    <li class="list-group-item px-0"><strong>Teléfono:</strong> {{ $usuario->telefono ?? 'No registrado' }}</li>
                    <li class="list-group-item px-0"><strong>Dirección:</strong> {{ $usuario->direccion ?? 'No registrada' }}</li>
                </ul>
                <div class="mt-3">
                    <span class="badge bg-success badge-status">Cliente activo</span>
                </div>
            </div>
        </div>

        <div class="col-lg-8">
            <div class="row g-4">
                <div class="col-md-6">
                    <div class="card dashboard-card dashboard-stat p-4">
                        <div class="text-muted small">Total de reservas</div>
                        <div class="stat-number">{{ $misReservas }}</div>
                        <p class="mb-0">Reservas realizadas hasta hoy.</p>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card dashboard-card dashboard-stat p-4">
                        <div class="text-muted small">Reservas aprobadas</div>
                        <div class="stat-number">{{ $reservasActivas }}</div>
                        <p class="mb-0">Solicitudes en curso o aprobadas.</p>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card dashboard-card dashboard-stat p-4">
                        <div class="text-muted small">Reservas finalizadas</div>
                        <div class="stat-number">{{ $reservasFinalizadas }}</div>
                        <p class="mb-0">Viajes ya completados.</p>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card dashboard-card dashboard-stat p-4">
                        <div class="text-muted small">Total gastado</div>
                        <div class="stat-number">$ {{ number_format($totalGastado, 2) }}</div>
                        <p class="mb-0">Monto acumulado de tus reservas.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="card dashboard-card mt-4">
        <div class="card-body">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <div>
                    <h4 class="mb-1">Mis reservas recientes</h4>
                    <p class="text-muted mb-0">Historial de las últimas reservas registradas para tu cuenta.</p>
                </div>
                <a href="{{ route('reservas.mis') }}" class="btn btn-outline-dark">Ver todas</a>
            </div>

            @if($reservasRecientes->isEmpty())
                <div class="alert alert-light border mb-0">
                    Aún no tienes reservas registradas. Cuando reserves un vehículo, aparecerán aquí.
                </div>
            @else
                <div class="table-responsive">
                    <table class="table align-middle mb-0">
                        <thead>
                            <tr>
                                <th>Vehículo</th>
                                <th>Inicio</th>
                                <th>Fin</th>
                                <th>Días</th>
                                <th>Total</th>
                                <th>Estado</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($reservasRecientes as $reserva)
                                <tr>
                                    <td>
                                        <strong>{{ optional($reserva->vehiculo)->marca ?? 'Vehículo' }}</strong><br>
                                        <small class="text-muted">{{ optional($reserva->vehiculo)->modelo ?? '' }} · {{ optional($reserva->vehiculo)->placa ?? '' }}</small>
                                    </td>
                                    <td>{{ \Carbon\Carbon::parse($reserva->fecha_inicio)->format('d/m/Y') }}</td>
                                    <td>{{ \Carbon\Carbon::parse($reserva->fecha_fin)->format('d/m/Y') }}</td>
                                    <td>{{ $reserva->dias }}</td>
                                    <td>$ {{ number_format($reserva->total, 2) }}</td>
                                    <td>
                                        <span class="badge bg-info-subtle text-info-emphasis badge-status">{{ $reserva->estado }}</span>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
        </div>
    </div>
</div>

@endsection
