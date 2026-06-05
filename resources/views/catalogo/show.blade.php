@extends('layouts.app')

@section('title', 'Detalle del Vehículo')

@section('content')

<div class="container py-5">

    <div class="row">

        <div class="col-md-6">

            @if($vehiculo->imagen)
                <img src="{{ asset('storage/'.$vehiculo->imagen) }}"
                     class="img-fluid rounded shadow">
            @else
                <img src="https://via.placeholder.com/800x500"
                     class="img-fluid rounded shadow">
            @endif

        </div>

        <div class="col-md-6">

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
                ${{ $vehiculo->precio_dia }}
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

                <a href="{{ route('reservas.create', $vehiculo->id) }}"
                   class="btn btn-lg"
                   style="background:#F97316;color:white;">
                    Reservar Vehículo
                </a>

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