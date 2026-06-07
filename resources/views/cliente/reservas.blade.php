@extends('layouts.app')

@section('title', 'Mis Reservas')

@section('content')

<div class="container py-5">

    <div class="d-flex justify-content-between align-items-center mb-4">

        <div>
            <h1 class="h3 mb-1">Mis reservas</h1>
            <p class="text-muted mb-0">
                Consulta el historial y el estado de tus reservas.
            </p>
        </div>

        <a href="{{ route('dashboard') }}"
           class="btn btn-outline-dark">
            Volver al dashboard
        </a>

    </div>

    @if($reservas->isEmpty())

        <div class="alert alert-light border">
            No tienes reservas registradas todavía.
        </div>

    @else

        <div class="card shadow-sm border-0 rounded-4">

            <div class="card-body p-0">

                <div class="table-responsive">

                    <table class="table align-middle mb-0">

                        <thead class="table-light">
                            <tr>
                                <th>Vehículo</th>
                                <th>Inicio</th>
                                <th>Fin</th>
                                <th>Días</th>
                                <th>Total</th>
                                <th>Estado</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>

                        <tbody>

                            @foreach($reservas as $reserva)

                            <tr>

                                {{-- VEHÍCULO --}}
                                <td>
                                    <strong>{{ optional($reserva->vehiculo)->marca }}</strong><br>
                                    <small class="text-muted">
                                        {{ optional($reserva->vehiculo)->modelo }}
                                        · {{ optional($reserva->vehiculo)->placa }}
                                    </small>
                                </td>

                                {{-- FECHAS --}}
                                <td>
                                    {{ \Carbon\Carbon::parse($reserva->fecha_inicio)->format('d/m/Y') }}
                                </td>

                                <td>
                                    {{ \Carbon\Carbon::parse($reserva->fecha_fin)->format('d/m/Y') }}
                                </td>

                                {{-- DÍAS --}}
                                <td>{{ $reserva->dias }}</td>

                                {{-- TOTAL --}}
                                <td>
                                    ${{ number_format($reserva->total, 2) }}
                                </td>

                                {{-- ESTADO --}}
                                <td>
                                    @if($reserva->estado == 'Pendiente')
                                        <span class="badge bg-warning text-dark">
                                            {{ $reserva->estado }}
                                        </span>

                                    @elseif($reserva->estado == 'Aprobada')
                                        <span class="badge bg-success">
                                            {{ $reserva->estado }}
                                        </span>

                                    @elseif($reserva->estado == 'Rechazada')
                                        <span class="badge bg-danger">
                                            {{ $reserva->estado }}
                                        </span>

                                    @else
                                        <span class="badge bg-secondary">
                                            {{ $reserva->estado }}
                                        </span>
                                    @endif
                                </td>

                                {{-- ACCIONES --}}
                                <td>

                                    {{-- SOLO SI ESTÁ APROBADA --}}
                                    @if($reserva->estado == 'Aprobada')

                                        <a href="{{ route('factura', $reserva->id) }}"
                                           target="_blank"
                                           class="btn btn-sm btn-success">
                                            📄 Factura
                                        </a>

                                    @else

                                        <span class="text-muted small">
                                            No disponible
                                        </span>

                                    @endif

                                </td>

                            </tr>

                            @endforeach

                        </tbody>

                    </table>

                </div>

            </div>

        </div>

    @endif

</div>

@endsection