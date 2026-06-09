@extends('layouts.app')

@section('title', 'Panel del administrador')

@section('content')

<style>
:root{
    --primary:#0F172A;
    --secondary:#1E3A5F;
    --accent:#F97316;
    --light:#F8FAFC;
}

.header-dashboard{
    background: linear-gradient(135deg,var(--primary),var(--secondary));
    color:white;
    padding:50px 0;
    margin-bottom:40px;
}

.card-stat{
    border:none;
    border-radius:15px;
    box-shadow:0 5px 15px rgba(0,0,0,.1);
    transition:.3s;
    height:100%;
}

.card-stat:hover{
    transform:translateY(-5px);
}

.number{
    font-size:2rem;
    font-weight:bold;
    color:var(--accent);
}

.icon{
    font-size:2.5rem;
}

.chart-card{
    border:none;
    border-radius:15px;
    padding:20px;
    box-shadow:0 5px 15px rgba(0,0,0,.08);
}
</style>

<div class="header-dashboard">
    <div class="container text-center">
        <h1>Panel de Administración</h1>
        <p>Bienvenido {{ Auth::user()->name }}</p>
    </div>
</div>

<div class="container">

    {{-- CARDS --}}
    <div class="row mb-4">

        <div class="col-md-3">
            <div class="card card-stat text-center p-4">
                <div class="icon">🚗</div>
                <div class="number">{{ $totalVehiculos }}</div>
                <h6 class="mb-1">Vehículos</h6>
                <small class="text-muted d-block">
                    Disponibles: {{ $vehiculosDisponibles ?? 0 }} ·
                    Reservados: {{ $vehiculosReservados ?? 0 }} ·
                    Mantenimiento: {{ $vehiculosMantenimiento ?? 0 }}
                </small>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card card-stat text-center p-4">
                <div class="icon">👥</div>
                <div class="number">{{ $totalClientes }}</div>
                <h6>Clientes</h6>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card card-stat text-center p-4">
                <div class="icon">📋</div>
                <div class="number">{{ $totalReservas }}</div>
                <h6 class="mb-1">Reservas</h6>
                <small class="text-muted d-block">
                    Pendientes: {{ $reservasPendientes ?? 0 }} ·
                    Aprobadas: {{ $reservasAprobadas ?? 0 }} ·
                    Finalizadas: {{ $reservasFinalizadas ?? 0 }} ·
                    Canceladas: {{ $reservasCanceladas ?? 0 }}
                </small>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card card-stat text-center p-4">
                <div class="icon">💰</div>
                <div class="number">
                    ${{ number_format($totalIngresos,2) }}
                </div>
                <h6>Ingresos</h6>
            </div>
        </div>

    </div>

    {{-- FILTRO --}}
    <form method="GET" class="mb-3">
        <select name="tipo" class="form-select w-25" onchange="this.form.submit()">
            <option value="dia" {{ $tipo == 'dia' ? 'selected' : '' }}>Día</option>
            <option value="semana" {{ $tipo == 'semana' ? 'selected' : '' }}>Semana</option>
            <option value="mes" {{ $tipo == 'mes' ? 'selected' : '' }}>Mes</option>
            <option value="anio" {{ $tipo == 'anio' ? 'selected' : '' }}>Año</option>
        </select>
    </form>

    {{-- GRAFICA --}}
    <div class="chart-card">
        <canvas id="graficaIngresos" height="70"></canvas>
    </div>

    {{-- ACCESOS RÁPIDOS --}}
<div class="row g-4 mt-5">

    <div class="col-md-3">
        <div class="card card-stat text-center p-4">
            <div class="icon">🚗</div>

            <h4>Vehículos</h4>

            <p class="text-muted">
                Administrar la flota disponible.
            </p>

            <a href="{{ route('vehiculos.index') }}"
               class="btn btn-warning text-white">
                Gestionar
            </a>
        </div>
    </div>

    <div class="col-md-3">
        <div class="card card-stat text-center p-4">
            <div class="icon">👥</div>

            <h4>Clientes</h4>

            <p class="text-muted">
                Consultar clientes registrados.
            </p>

            <a href="{{ route('clientes.index') }}"
               class="btn btn-warning text-white">
                Gestionar
            </a>
        </div>
    </div>

    <div class="col-md-3">
        <div class="card card-stat text-center p-4">
            <div class="icon">📋</div>

            <h4>Reservas</h4>

            <p class="text-muted">
                Administrar reservas realizadas.
            </p>

            <a href="{{ route('admin.reservas.index') }}"
               class="btn btn-warning text-white">
                Gestionar
            </a>
        </div>
    </div>

    <div class="col-md-3">
        <div class="card card-stat text-center p-4">
            <div class="icon">📊</div>

            <h4>Reportes</h4>

            <p class="text-muted">
                Generar reportes del sistema.
            </p>

            <a href="{{ route('reportes.index') }}"
               class="btn btn-warning text-white">
                Ver Reportes
            </a>
        </div>
    </div>

</div>

</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
const ctx = document.getElementById('graficaIngresos').getContext('2d');

new Chart(ctx, {
    type: 'line',
    data: {
        labels: @json($meses),
        datasets: [{
            label: 'Ingresos ($)',
            data: @json($totales),
            borderColor: '#F97316',
            backgroundColor: 'rgba(249,115,22,0.1)',
            borderWidth: 2,
            tension: 0.4,
            pointRadius: 3
        }]
    }
});
</script>

@endsection
