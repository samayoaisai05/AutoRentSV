@extends('layouts.app')

@section('title', 'Dashboard Administrador')

@section('content')

<style>
    :root{
        --primary:#0F172A;
        --secondary:#1E3A5F;
        --accent:#F97316;
        --light:#F8FAFC;
        --white:#FFFFFF;
    }

    body{
        background-color: var(--light);
    }

    .header-dashboard{
        background: linear-gradient(135deg,var(--primary),var(--secondary));
        color: white;
        padding: 50px 0;
        margin-bottom: 40px;
        border-radius: 0 0 20px 20px;
    }

    .card-stat{
        border: none;
        border-radius: 15px;
        box-shadow: 0 5px 15px rgba(0,0,0,.1);
        transition: .3s;
    }

    .card-stat:hover{
        transform: translateY(-5px);
    }

    .number{
        font-size: 2rem;
        font-weight: bold;
        color: var(--accent);
    }

    .card-option{
        border: none;
        border-radius: 15px;
        box-shadow: 0 5px 15px rgba(0,0,0,.1);
        transition: .3s;
        height: 100%;
    }

    .card-option:hover{
        transform: translateY(-5px);
    }

    .btn-custom{
        background-color: var(--accent);
        color: white;
        border: none;
    }

    .btn-custom:hover{
        background-color: #EA580C;
        color: white;
    }

    .icon{
        font-size: 3rem;
    }
</style>

<div class="header-dashboard">
    <div class="container text-center">
        <h1>Panel de Administración</h1>
        <p>
            Bienvenido {{ Auth::user()->name }},
            administra todas las operaciones de AutoRent SV.
        </p>
    </div>
</div>

<div class="container">

    {{-- Estadísticas --}}
    <div class="row mb-5">

        <div class="col-md-3 mb-3">
            <div class="card card-stat text-center p-4">
                <div class="icon">🚗</div>
                <div class="number">{{ $totalVehiculos }}</div>
                <h5>Vehículos</h5>
            </div>
        </div>

        <div class="col-md-3 mb-3">
            <div class="card card-stat text-center p-4">
                <div class="icon">👥</div>
                <div class="number">{{ $totalClientes }}</div>
                <h5>Clientes</h5>
            </div>
        </div>

        <div class="col-md-3 mb-3">
            <div class="card card-stat text-center p-4">
                <div class="icon">📋</div>
                <div class="number">{{ $totalReservas }}</div>
                <h5>Reservas</h5>
            </div>
        </div>

    </div>

    {{-- Accesos rápidos --}}
    <div class="row g-4">

        <div class="col-md-3">
            <div class="card card-option p-4 text-center">
                <div class="icon">🚗</div>
                <h4>Vehículos</h4>
                <p>Administrar la flota disponible.</p>

                <a href="{{ route('vehiculos.index') }}"
                   class="btn btn-custom">
                    Gestionar
                </a>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card card-option p-4 text-center">
                <div class="icon">👥</div>
                <h4>Clientes</h4>
                <p>Consultar clientes registrados.</p>

                <a href="{{ route('clientes.index') }}"
                   class="btn btn-custom">
                    Gestionar
                </a>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card card-option p-4 text-center">
                <div class="icon">📋</div>
                <h4>Reservas</h4>
                <p>Administrar reservas realizadas.</p>

                <a href="{{ route('admin.reservas.index') }}"
                   class="btn btn-custom">
                    Gestionar
                </a>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card card-option p-4 text-center">
                <div class="icon">📊</div>
                <h4>Reportes</h4>
                <p>Generar reportes del sistema.</p>

                <a href="{{ route('reportes.index') }}"
                   class="btn btn-custom">
                    Ver Reportes
                </a>
            </div>
        </div>

    </div>

</div>

@endsection