@extends('layouts.app')

@section('title', 'Inicio')

@section('content')

{{-- HERO --}}
<div class="hero-section text-white d-flex align-items-center">

    <div class="container text-center">

        {{-- LOGO --}}
        <img src="{{ asset('img/logo.png') }}"
             width="180"
             height="180"
             class="mb-3 hero-logo">

        <h1 class="display-4 fw-bold">
            AutoRent SV
        </h1>

        <p class="lead mb-4">
            Alquila vehículos modernos, seguros y al mejor precio en El Salvador.
        </p>

        <a href="{{ route('catalogo.index') }}"
        class="btn btn-warning btn-lg px-5 hero-btn">
            Ver Catálogo
        </a>

    </div>

</div>

{{-- FEATURES --}}
<div class="container py-5">

    <div class="text-center mb-5">

        <h2 class="fw-bold" style="color:#0F172A;">
            ¿Por qué elegir AutoRent SV?
        </h2>

        <p class="text-muted">
            Una experiencia rápida, segura y moderna para alquilar vehículos.
        </p>

    </div>

    <div class="row g-4 text-center">

        <div class="col-md-4">
            <div class="feature-card p-4 h-100">
                <div class="icon">⚡</div>
                <h4 class="fw-bold mt-2">Rápido</h4>
                <p class="text-muted">Reserva en minutos sin procesos complicados.</p>
            </div>
        </div>

        <div class="col-md-4">
            <div class="feature-card p-4 h-100">
                <div class="icon">🔒</div>
                <h4 class="fw-bold mt-2">Seguro</h4>
                <p class="text-muted">Vehículos verificados para tu tranquilidad.</p>
            </div>
        </div>

        <div class="col-md-4">
            <div class="feature-card p-4 h-100">
                <div class="icon">💰</div>
                <h4 class="fw-bold mt-2">Económico</h4>
                <p class="text-muted">Precios accesibles para cualquier usuario.</p>
            </div>
        </div>

    </div>

</div>

{{-- CTA FINAL --}}
<div class="cta-section text-white text-center py-5">

    <h2 class="mb-3 fw-bold">
        ¿Listo para tu próximo viaje?
    </h2>

    <p class="mb-4">
        Explora nuestro catálogo y encuentra el vehículo perfecto.
    </p>

    <a href="{{ route('catalogo.index') }}"
       class="btn btn-warning btn-lg px-5 hero-btn">
        Explorar Vehículos
    </a>

</div>

{{-- ESTILOS --}}
<style>

/* HERO */
.hero-section{
    background: linear-gradient(rgba(15,23,42,0.85), rgba(15,23,42,0.85)),
    url('https://images.unsplash.com/photo-1619767886558-efdc259cde1a?auto=format&fit=crop&w=1600&q=80');
    background-size: cover;
    background-position: center;
    height: 90vh;
}

/* LOGO */
.hero-logo{
    border-radius: 20px;
    transition: 0.3s ease;
}

.hero-logo:hover{
    transform: scale(1.05);
}

/* BOTONES */
.hero-btn{
    transition: all 0.3s ease;
    font-weight: 600;
}

.hero-btn:hover{
    transform: translateY(-3px);
    box-shadow: 0 10px 25px rgba(249,115,22,0.3);
}

/* FEATURES */
.feature-card{
    background: #ffffff;
    border-radius: 18px;
    border: 1px solid #e5e7eb;
    transition: all 0.3s ease;
    box-shadow: 0 10px 25px rgba(15, 23, 42, 0.05);
}

.feature-card:hover{
    transform: translateY(-12px);
    border-color: #F97316;
    box-shadow: 0 18px 40px rgba(249, 115, 22, 0.25);
}

.icon{
    font-size: 44px;
}

/* CTA */
.cta-section{
    background: linear-gradient(
        rgba(15, 23, 42, 0.92),
        rgba(15, 23, 42, 0.92)
    ),
    url('https://images.unsplash.com/photo-1511919884226-fd3cad34687c?auto=format&fit=crop&w=1600&q=80');
    background-size: cover;
    background-position: center;
    border-top: 3px solid #F97316;
}

</style>

@endsection