@extends('layouts.app')

@section('title', 'Catálogo de Vehículos')

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

    .catalog-header{
        background: linear-gradient(135deg, var(--primary), var(--secondary));
        color: var(--white);
        padding: 70px 0;
        text-align: center;
        margin-bottom: 50px;
    }

    .catalog-header h1{
        font-weight: 700;
        font-size: 2.8rem;
        margin-bottom: 10px;
    }

    .catalog-header p{
        font-size: 1.1rem;
        opacity: 0.9;
    }

    .vehicle-card{
        background: var(--white);
        border: 1px solid var(--gray);
        border-radius: 15px;
        overflow: hidden;
        transition: all 0.3s ease;
        height: 100%;
    }

    .vehicle-card:hover{
        transform: translateY(-8px);
        box-shadow: 0 10px 25px rgba(0,0,0,0.12);
    }

    .vehicle-image{
        height: 220px;
        overflow: hidden;
        background: #f3f4f6;
    }

    .vehicle-image img{
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .vehicle-info{
        padding: 20px;
    }

    .vehicle-title{
        color: var(--primary);
        font-size: 1.3rem;
        font-weight: 700;
        margin-bottom: 15px;
    }

    .vehicle-detail{
        color: var(--text);
        margin-bottom: 8px;
        font-size: 0.95rem;
    }

    .badge-disponible{
        background-color: #22c55e;
        color: white;
        padding: 8px 14px;
        border-radius: 20px;
        font-size: 0.85rem;
        font-weight: 600;
    }

    .badge-reservado{
        background-color: #ef4444;
        color: white;
        padding: 8px 14px;
        border-radius: 20px;
        font-size: 0.85rem;
        font-weight: 600;
    }

    .btn-detalle{
        background-color: var(--accent);
        color: var(--white);
        width: 100%;
        margin-top: 15px;
        font-weight: 600;
        border-radius: 10px;
        transition: all .3s ease;
    }

    .btn-detalle:hover{
        background-color: var(--accent-hover);
        color: var(--white);
    }

    .empty-state{
        text-align: center;
        padding: 70px 20px;
        background: white;
        border-radius: 15px;
        border: 1px solid var(--gray);
    }

    .empty-state h3{
        color: var(--primary);
        margin-bottom: 15px;
    }

    .empty-state p{
        color: var(--text);
    }
</style>

<!-- Encabezado -->
<div class="catalog-header">
    <div class="container">
        <h1>Catálogo de Vehículos</h1>
        <p>Encuentra el vehículo ideal para tu próximo viaje.</p>
    </div>
</div>

<!-- Catálogo -->
<div class="container">

    @if($vehiculos->count() > 0)

        <div class="row g-4">

            @foreach($vehiculos as $vehiculo)

                <div class="col-md-6 col-lg-4">

                    <div class="vehicle-card">

                        <!-- Imagen -->
                        <div class="vehicle-image">

                            @php
                                $imagenCatalogo = !empty($vehiculo->imagen) && file_exists(public_path('storage/vehiculos/' . $vehiculo->imagen))
                                    ? asset('storage/vehiculos/' . $vehiculo->imagen)
                                    : asset('img/no-image.svg');
                            @endphp

                            <img src="{{ $imagenCatalogo }}"
                                 class="img-fluid"
                                 alt="{{ $vehiculo->marca }} {{ $vehiculo->modelo }}">

                        </div>

                        <!-- Información -->
                        <div class="vehicle-info">

                            <h4 class="vehicle-title">
                                {{ $vehiculo->marca }} {{ $vehiculo->modelo }}
                            </h4>

                            <div class="vehicle-detail">
                                <strong>Año:</strong>
                                {{ $vehiculo->anio }}
                            </div>

                            <div class="vehicle-detail">
                                <strong>Color:</strong>
                                {{ $vehiculo->color }}
                            </div>

                            <div class="vehicle-detail">
                                <strong>Precio por día:</strong>
                                ${{ number_format($vehiculo->precio_dia, 2) }}
                            </div>

                            <div class="mt-3">
                                <span class="{{ $vehiculo->estado === 'Disponible' ? 'badge-disponible' : 'badge-reservado' }}">
                                    {{ $vehiculo->estado === 'Disponible' ? 'Disponible' : 'Reservado' }}
                                </span>
                            </div>

                            <!-- Botón Ver Detalles -->
                            <a href="{{ route('catalogo.show', $vehiculo->id) }}"
                               class="btn btn-detalle">
                                Ver Detalles
                            </a>

                        </div>

                    </div>

                </div>

            @endforeach

        </div>

    @else

        <div class="empty-state">
            <h3>No hay vehículos disponibles</h3>
            <p>Actualmente no existen vehículos registrados para mostrar.</p>
        </div>

    @endif

</div>

@endsection
