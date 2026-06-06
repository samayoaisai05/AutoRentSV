@extends('layouts.app')

@section('title', 'Reportes')

@section('content')

<style>
    :root{
        --primary: #0F172A;
        --secondary: #1E3A5F;
        --accent: #F97316;
        --accent-hover: #EA580C;
        --light: #F8FAFC;
        --gray: #E5E7EB;
        --text: #374151;
        --white: #FFFFFF;
    }

    body{
        background-color: var(--light);
    }

    .page-header{
        background: linear-gradient(135deg, var(--primary), var(--secondary));
        color: var(--white);
        padding: 60px 0;
        margin-bottom: 40px;
        text-align: center;
    }

    .page-header h1{
        font-weight: 700;
        margin-bottom: 10px;
    }

    .stats-card{
        background: var(--white);
        border-radius: 15px;
        padding: 25px;
        text-align: center;
        box-shadow: 0 5px 15px rgba(0,0,0,.08);
        transition: .3s;
    }

    .stats-card:hover{
        transform: translateY(-5px);
    }

    .stats-number{
        font-size: 2rem;
        font-weight: bold;
        color: var(--accent);
    }

    .stats-title{
        color: var(--text);
    }

    .report-card{
        background: var(--white);
        border: 1px solid var(--gray);
        border-radius: 15px;
        padding: 30px;
        text-align: center;
        transition: .3s;
        height: 100%;
    }

    .report-card:hover{
        transform: translateY(-8px);
        box-shadow: 0 10px 25px rgba(0,0,0,.1);
    }

    .report-icon{
        font-size: 4rem;
        margin-bottom: 20px;
    }

    .report-title{
        color: var(--primary);
        font-weight: 700;
        margin-bottom: 15px;
    }

    .report-description{
        color: var(--text);
        margin-bottom: 25px;
    }

    .btn-report{
        background-color: var(--accent);
        color: white;
        border: none;
        padding: 10px 20px;
        border-radius: 10px;
        font-weight: 600;
        text-decoration: none;
        transition: .3s;
    }

    .btn-report:hover{
        background-color: var(--accent-hover);
        color: white;
    }
</style>

<div class="page-header">
    <div class="container">
        <h1>Reportes del Sistema</h1>

        <p>
            Genera y descarga reportes en PDF para llevar un mejor
            control de las operaciones de AutoRent SV.
        </p>
    </div>
</div>

<div class="container">

    {{-- Estadísticas --}}
    <div class="row mb-5">

        <div class="col-md-4 mb-3">
            <div class="stats-card">
                <div class="stats-number">
                    {{ $totalVehiculos }}
                </div>

                <div class="stats-title">
                    Vehículos Registrados
                </div>
            </div>
        </div>

        <div class="col-md-4 mb-3">
            <div class="stats-card">
                <div class="stats-number">
                    {{ $totalClientes }}
                </div>

                <div class="stats-title">
                    Clientes Registrados
                </div>
            </div>
        </div>

        <div class="col-md-4 mb-3">
            <div class="stats-card">
                <div class="stats-number">
                    {{ $totalReservas }}
                </div>

                <div class="stats-title">
                    Reservas Realizadas
                </div>
            </div>
        </div>

    </div>

    {{-- Tarjetas de reportes --}}
    <div class="row g-4">

        {{-- Reporte Vehículos --}}
        <div class="col-md-4">

            <div class="report-card">

                <div class="report-icon">
                    🚗
                </div>

                <h3 class="report-title">
                    Reporte de Vehículos
                </h3>

                <p class="report-description">
                    Consulta y descarga la información completa
                    de todos los vehículos registrados.
                </p>

                <a href="{{ route('reportes.vehiculos') }}"
                   class="btn-report"
                   target="_blank">

                    Generar PDF

                </a>

            </div>

        </div>

        {{-- Reporte Clientes --}}
        <div class="col-md-4">

            <div class="report-card">

                <div class="report-icon">
                    👥
                </div>

                <h3 class="report-title">
                    Reporte de Clientes
                </h3>

                <p class="report-description">
                    Visualiza la información de los clientes
                    registrados en AutoRent SV.
                </p>

                <a href="{{ route('reportes.clientes') }}"
                   class="btn-report"
                   target="_blank">

                    Generar PDF

                </a>

            </div>

        </div>

        {{-- Reporte Reservas --}}
        <div class="col-md-4">

            <div class="report-card">

                <div class="report-icon">
                    📋
                </div>

                <h3 class="report-title">
                    Reporte de Reservas
                </h3>

                <p class="report-description">
                    Obtén el historial completo de reservas
                    realizadas en el sistema.
                </p>

                <a href="{{ route('reportes.reservas') }}"
                   class="btn-report"
                   target="_blank">

                    Generar PDF

                </a>

            </div>

        </div>

    </div>

</div>

@endsection