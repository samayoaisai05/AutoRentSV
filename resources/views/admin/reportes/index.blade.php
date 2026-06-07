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

    .filter-card{
        background: #fff;
        border-radius: 15px;
        box-shadow: 0 5px 15px rgba(0,0,0,.08);
        padding: 20px;
        margin-bottom: 30px;
    }
</style>

{{-- HEADER --}}
<div class="page-header">
    <div class="container">
        <h1>Reportes del Sistema</h1>
        <p>Genera reportes en PDF con filtros personalizados</p>
    </div>
</div>

<div class="container">

    {{-- 🔥 FILTRO --}}
    <div class="filter-card">

        <form method="GET"
              action="{{ route('reportes.reservas.filtradas') }}"
              target="_blank">

            <h5 class="mb-3">Filtrar Reservas</h5>

            <div class="row g-3">

                {{-- FECHA INICIO --}}
                <div class="col-md-3">
                    <label>Desde</label>
                    <input type="date" name="inicio" class="form-control">
                </div>

                {{-- FECHA FIN --}}
                <div class="col-md-3">
                    <label>Hasta</label>
                    <input type="date" name="fin" class="form-control">
                </div>

                {{-- MES --}}
                <div class="col-md-3">
                    <label>Mes</label>
                    <select name="mes" class="form-control">
                        <option value="">-- Todos --</option>
                        <option value="1">Enero</option>
                        <option value="2">Febrero</option>
                        <option value="3">Marzo</option>
                        <option value="4">Abril</option>
                        <option value="5">Mayo</option>
                        <option value="6">Junio</option>
                        <option value="7">Julio</option>
                        <option value="8">Agosto</option>
                        <option value="9">Septiembre</option>
                        <option value="10">Octubre</option>
                        <option value="11">Noviembre</option>
                        <option value="12">Diciembre</option>
                    </select>
                </div>

                {{-- BOTÓN --}}
                <div class="col-md-3 d-flex align-items-end">
                    <button class="btn btn-dark w-100">
                        Generar PDF
                    </button>
                </div>

            </div>

        </form>

    </div>

    {{-- ESTADÍSTICAS --}}
    <div class="row mb-5">

        <div class="col-md-4 mb-3">
            <div class="stats-card">
                <div class="stats-number">{{ $totalVehiculos }}</div>
                <div class="stats-title">Vehículos</div>
            </div>
        </div>

        <div class="col-md-4 mb-3">
            <div class="stats-card">
                <div class="stats-number">{{ $totalClientes }}</div>
                <div class="stats-title">Clientes</div>
            </div>
        </div>

        <div class="col-md-4 mb-3">
            <div class="stats-card">
                <div class="stats-number">{{ $totalReservas }}</div>
                <div class="stats-title">Reservas</div>
            </div>
        </div>

    </div>

    {{-- REPORTES --}}
    <div class="row g-4">

        <div class="col-md-4">
            <div class="report-card">
                <div class="report-icon">🚗</div>
                <h3 class="report-title">Vehículos</h3>
                <p class="report-description">Listado completo de vehículos.</p>
                <a href="{{ route('reportes.vehiculos') }}" target="_blank" class="btn-report">
                    Generar PDF
                </a>
            </div>
        </div>

        <div class="col-md-4">
            <div class="report-card">
                <div class="report-icon">👥</div>
                <h3 class="report-title">Clientes</h3>
                <p class="report-description">Listado de clientes registrados.</p>
                <a href="{{ route('reportes.clientes') }}" target="_blank" class="btn-report">
                    Generar PDF
                </a>
            </div>
        </div>

        <div class="col-md-4">
            <div class="report-card">
                <div class="report-icon">📋</div>
                <h3 class="report-title">Reservas</h3>
                <p class="report-description">Historial de reservas.</p>
                <a href="{{ route('reportes.reservas') }}" target="_blank" class="btn-report">
                    Generar PDF
                </a>
            </div>
        </div>

    </div>

</div>

{{-- 🔥 JS BLOQUEO DE FILTROS --}}
<script>
document.addEventListener("DOMContentLoaded", function () {

    const mes = document.querySelector('select[name="mes"]');
    const inicio = document.querySelector('input[name="inicio"]');
    const fin = document.querySelector('input[name="fin"]');

    // MES bloquea fechas
    mes.addEventListener('change', function () {

        if (this.value !== "") {
            inicio.disabled = true;
            fin.disabled = true;

            inicio.value = "";
            fin.value = "";
        } else {
            inicio.disabled = false;
            fin.disabled = false;
        }

    });

    // FECHAS bloquean mes
    function checkFechas() {

        if (inicio.value !== "" || fin.value !== "") {
            mes.disabled = true;
            mes.value = "";
        } else {
            mes.disabled = false;
        }

    }

    inicio.addEventListener('change', checkFechas);
    fin.addEventListener('change', checkFechas);

});
</script>

@endsection