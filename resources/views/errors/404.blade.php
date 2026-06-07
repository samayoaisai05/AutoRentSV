@extends('layouts.app')

@section('title', 'Página no encontrada')

@section('content')

<style>
    .error-container{
        min-height:80vh;
        display:flex;
        justify-content:center;
        align-items:center;
    }

    .error-card{
        max-width:600px;
        text-align:center;
        background:white;
        border-radius:20px;
        padding:50px;
        box-shadow:0 10px 25px rgba(0,0,0,.1);
    }

    .error-code{
        font-size:6rem;
        font-weight:bold;
        color:#F97316;
    }

    .btn-home{
        background:#F97316;
        color:white;
        border:none;
        padding:12px 25px;
        border-radius:10px;
        text-decoration:none;
    }

    .btn-home:hover{
        background:#EA580C;
        color:white;
    }
</style>

<div class="error-container">

    <div class="error-card">

        <div class="error-code">
            404
        </div>

        <h2>Página no encontrada</h2>

        <p class="text-muted">
            La página que intentas visitar no existe o fue movida.
        </p>

        <a href="{{ route('home') }}" class="btn-home">
            Volver al inicio
        </a>

    </div>

</div>

@endsection