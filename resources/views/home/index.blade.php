@extends('layouts.app')

@section('title', 'Inicio')

@section('content')

<div class="container mt-5">

    <div class="text-center">

        <h1 class="display-4 fw-bold">
            Bienvenido a AutoRent SV
        </h1>

        <p class="lead">
            Sistema de alquiler de vehículos en línea.
        </p>

        <a href="{{ route('catalogo.index') }}"
           class="btn btn-warning btn-lg">
            Ver Catálogo
        </a>

    </div>

</div>

@endsection