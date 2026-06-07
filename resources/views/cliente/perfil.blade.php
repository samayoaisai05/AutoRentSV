@extends('layouts.app')

@section('title', 'Mi Perfil')

@section('content')

@php
$user = auth()->user();
@endphp

{{-- MENSAJE DE ÉXITO --}}
@if(session('success'))

<script>
document.addEventListener('DOMContentLoaded', function () {

    Swal.fire({
        icon: 'success',
        title: 'Éxito',
        text: '{{ session('success') }}',
        confirmButtonColor: '#F97316',
        confirmButtonText: 'Aceptar'
    }).then((result) => {

        if (result.isConfirmed) {
            window.location.href = "{{ route('dashboard') }}";
        }

    });

});
</script>

@endif

<style>
:root{
    --primary:#0F172A;
    --secondary:#1E3A5F;
    --accent:#F97316;
    --light:#F8FAFC;
}

body{
    background: var(--light);
}

.perfil-header{
    background: linear-gradient(135deg,var(--primary),var(--secondary));
    color:white;
    padding:60px 0;
    border-radius:0 0 25px 25px;
    margin-bottom:40px;
}

.card-perfil{
    border:none;
    border-radius:20px;
    box-shadow:0 8px 20px rgba(0,0,0,.08);
    background:white;
}

.titulo-seccion{
    color:var(--primary);
    font-weight:700;
    margin-bottom:25px;
}

.btn-orange{
    background:var(--accent);
    color:white;
    border:none;
    border-radius:12px;
    padding:12px;
    font-weight:600;
}

.btn-orange:hover{
    background:#EA580C;
    color:white;
}

.avatar{
    width:110px;
    height:110px;
    background:linear-gradient(135deg,#F97316,#EA580C);
    color:white;
    border-radius:50%;
    display:flex;
    align-items:center;
    justify-content:center;
    font-size:45px;
    margin:auto;
}

.info-item{
    border-bottom:1px solid #e5e7eb;
    padding-bottom:12px;
    margin-bottom:12px;
}

.info-label{
    color:#64748B;
    font-size:.9rem;
}

.info-value{
    color:#0F172A;
    font-weight:600;
}

.perfil-form{
    border:none;
    border-radius:20px;
    box-shadow:0 8px 20px rgba(0,0,0,.08);
    background:white;
    padding:30px;
}

.perfil-form input,
.perfil-form textarea,
.perfil-form select{
    width:100%;
    padding:12px 15px !important;
    border-radius:12px !important;
    border:1px solid #E5E7EB !important;
    background:#F8FAFC !important;
}

.perfil-form input:focus,
.perfil-form textarea:focus{
    border-color:#F97316 !important;
    box-shadow:0 0 0 3px rgba(249,115,22,.15);
}

.perfil-form button{
    background:#F97316 !important;
    border:none !important;
    color:white !important;
    border-radius:12px !important;
    padding:12px 25px !important;
    font-weight:600;
}

.perfil-form button:hover{
    background:#EA580C !important;
}
</style>

<div class="perfil-header">
    <div class="container text-center">
        <h1 class="fw-bold">Mi Perfil</h1>
        <p>
            Administra tu información personal y la seguridad de tu cuenta.
        </p>
    </div>
</div>

<div class="container pb-5">

    <div class="row g-4">

        {{-- PANEL IZQUIERDO --}}
        <div class="col-lg-4">

            <div class="card card-perfil p-4">

                <div class="avatar mb-3">
                    👤
                </div>

                <div class="text-center mb-4">
                    <h4>{{ $user->name }}</h4>

                    <span class="badge bg-success">
                        Cliente Activo
                    </span>
                </div>

                <div class="info-item">
                    <div class="info-label">Correo electrónico</div>

                    <div class="info-value">
                        {{ $user->email }}
                    </div>
                </div>

                <div class="info-item">
                    <div class="info-label">Teléfono</div>

                    <div class="info-value">
                        {{ $user->telefono ?? 'No registrado' }}
                    </div>
                </div>

                <div class="info-item">
                    <div class="info-label">Dirección</div>

                    <div class="info-value">
                        {{ $user->direccion ?? 'No registrada' }}
                    </div>
                </div>

                <a href="{{ route('reservas.mis') }}"
                   class="btn btn-orange w-100 mt-3">
                    Ver mis reservas
                </a>

            </div>

        </div>

        {{-- PANEL DERECHO --}}
        <div class="col-lg-8">

            <div class="perfil-form mb-4">

                <h4 class="titulo-seccion">
                    Editar Información Personal
                </h4>

                @include('profile.partials.update-profile-information-form')

            </div>

            <div class="perfil-form mb-4">

                <h4 class="titulo-seccion">
                    Cambiar Contraseña
                </h4>

                @include('profile.partials.update-password-form')

            </div>

            <div class="perfil-form">

                <h4 class="titulo-seccion text-danger">
                    Zona de Peligro
                </h4>

                @include('profile.partials.delete-user-form')

            </div>

        </div>

    </div>

</div>

@endsection