@extends('layouts.app')

@section('title', 'Detalle del Vehículo')

@section('content')

<div class="container py-5">

    <div class="row">

        <div class="col-lg-8">

            @if($vehiculo->imagen)

                <img src="{{ asset('storage/vehiculos/'.$vehiculo->imagen) }}"
                     class="img-fluid rounded shadow w-100"
                     style="max-height:600px; object-fit:cover;"
                     alt="{{ $vehiculo->marca }}">

            @else

                <img src="https://via.placeholder.com/800x500"
                     class="img-fluid rounded shadow">

            @endif

        </div>

        <div class="col-lg-4">

            <h1 class="mb-4">
                {{ $vehiculo->marca }}
                {{ $vehiculo->modelo }}
            </h1>

            <p>
                <strong>Año:</strong>
                {{ $vehiculo->anio }}
            </p>

            <p>
                <strong>Color:</strong>
                {{ $vehiculo->color }}
            </p>

            <p>
                <strong>Placa:</strong>
                {{ $vehiculo->placa }}
            </p>

            <p>
                <strong>Precio por día:</strong>
                ${{ number_format($vehiculo->precio_dia,2) }}
            </p>

            <p>
                <strong>Estado:</strong>
                {{ $vehiculo->estado }}
            </p>

            <p>
                <strong>Descripción:</strong>
                {{ $vehiculo->descripcion }}
            </p>

            @auth

    @if(Auth::user()->is_admin)

        <a href="{{ route('vehiculos.edit', $vehiculo->id) }}"
           class="btn btn-warning btn-lg">
            Editar Vehículo
        </a>

    @else

        @if($vehiculo->estado === 'Disponible')
            <a href="{{ route('reservas.create', $vehiculo->id) }}"
               class="btn btn-lg"
               style="background:#F97316;color:white;">
                Reservar Vehículo
            </a>
        @else
            <button class="btn btn-secondary btn-lg" disabled>
                No disponible
            </button>
        @endif

    @endif

@else

    <a href="{{ route('login') }}"
       class="btn btn-lg"
       style="background:#F97316;color:white;">
        Inicia sesión para reservar
    </a>

@endauth

        </div>

    </div>

</div>

@endsection
