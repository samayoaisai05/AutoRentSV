@extends('layouts.app')

@section('title', 'Dashboard Cliente')

@section('content')

<div class="container mt-4">
    <h1>Dashboard Cliente</h1>

    <div class="card">
        <div class="card-body">
            Bienvenido {{ Auth::user()->name }}
        </div>
    </div>
</div>

@endsection