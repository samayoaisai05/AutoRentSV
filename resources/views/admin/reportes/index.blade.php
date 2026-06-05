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

    .report-card{
        background: var(--white);
        border: 1px solid var(--gray);
        border-radius: 15px;
        padding: 30px;
        text-align: center;
        transition: all .3s ease;
        height: 100%;
    }

    .report-card:hover{
        transform: translateY(-8px);
        box-shadow: 0 10px 25px rgba(0,0,0,.1);
    }

    .report-icon{
        font-size: 4rem;
        color: var(--accent);
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
        color: var(--white);
        border: none;
        padding: 10px 20px;
        border-radius: 10px;
        font-weight: 600;
        transition: all .3s ease;
        text-decoration: none;
    }

    .btn-report:hover{
        background-color: var(--accent-hover);
        color: var(--white);
    }
</style>

<div class="page-header">
    <div class="container">
        <h1>Reportes del Sistema</h1>
        <p>Genera reportes en formato PDF para la administración de AutoRent SV</p>
    </div>
</div>

<div class="container">

    <div class="row g-4">

        <!-- Reporte Vehículos -->
        <div class="col-md-4">
            <div class="report-card">

                <div class="report-icon">
                    🚗
                </div>

                <h3 class="report-title">
                    Reporte de Vehículos
                </h3>

                <p class="report-description">
                    Consulta y descarga todos los vehículos registrados en el sistema.
                </p>

                <a href="{{ route('reportes.vehiculos') }}"
                   class="btn-report">
                    Generar PDF
                </a>

            </div>
        </div>

        <!-- Reporte Clientes -->
        <div class="col-md-4">
            <div class="report-card">

                <div class="report-icon">
                    👥
                </div>

                <h3 class="report-title">
                    Reporte de Clientes
                </h3>

                <p class="report-description">
                    Visualiza la información completa de los clientes registrados.
                </p>

                <a href="{{ route('reportes.clientes') }}"
                   class="btn-report">
                    Generar PDF
                </a>

            </div>
        </div>

        <!-- Reporte Reservas -->
        <div class="col-md-4">
            <div class="report-card">

                <div class="report-icon">
                    📋
                </div>

                <h3 class="report-title">
                    Reporte de Reservas
                </h3>

                <p class="report-description">
                    Obtén el historial completo de reservas realizadas en AutoRent SV.
                </p>

                <a href="{{ route('reportes.reservas') }}"
                   class="btn-report">
                    Generar PDF
                </a>

            </div>
        </div>

    </div>

</div>

@endsection