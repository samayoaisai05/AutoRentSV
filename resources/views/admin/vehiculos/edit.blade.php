@extends('layouts.app')

@section('title', 'Editar Vehículo')

@section('content')

<div class="container py-5">

    <div class="card">

        <div class="card-header bg-dark text-white">
            Editar Vehículo
        </div>

        <div class="card-body">

            <form action="{{ route('vehiculos.update',$vehiculo->id) }}"
                  method="POST"
                  enctype="multipart/form-data">

                @csrf
                @method('PUT')

                <div class="mb-3">

                    <label>Marca</label>

                    <input type="text"
                           name="marca"
                           value="{{ $vehiculo->marca }}"
                           class="form-control">

                </div>

                <div class="mb-3">

                    <label>Modelo</label>

                    <input type="text"
                           name="modelo"
                           value="{{ $vehiculo->modelo }}"
                           class="form-control">

                </div>

                <div class="mb-3">

                    <label>Año</label>

                    <input type="number"
                           name="anio"
                           value="{{ $vehiculo->anio }}"
                           class="form-control">

                </div>

                <div class="mb-3">

                    <label>Color</label>

                    <input type="text"
                           name="color"
                           value="{{ $vehiculo->color }}"
                           class="form-control">

                </div>

                <div class="mb-3">

                    <label>Placa</label>

                    <input type="text"
                           name="placa"
                           value="{{ $vehiculo->placa }}"
                           class="form-control">

                </div>

                <div class="mb-3">

                    <label>Precio por día</label>

                    <input type="number"
                           step="0.01"
                           name="precio_dia"
                           value="{{ $vehiculo->precio_dia }}"
                           class="form-control">

                </div>

                <div class="mb-3">

                    <label>Imagen del Vehículo</label>

                    @php
                        $imagenActual = !empty($vehiculo->imagen) && file_exists(public_path('storage/vehiculos/' . $vehiculo->imagen))
                            ? asset('storage/vehiculos/' . $vehiculo->imagen)
                            : asset('img/no-image.svg');
                    @endphp

                    <div class="mb-2">
                        <img src="{{ $imagenActual }}"
                             alt="Imagen actual del vehículo"
                             class="img-fluid rounded"
                             style="max-height: 160px; object-fit: cover;">
                    </div>

                    <input type="file"
                           name="imagen"
                           class="form-control">

                    <small class="text-muted">Si no eliges una imagen nueva, se conservará la actual.</small>

                </div>

                <div class="mb-3">

                    <label>Descripción</label>

                    <textarea
                        name="descripcion"
                        class="form-control"
                        rows="4">{{ $vehiculo->descripcion }}</textarea>

                </div>

                <div class="mb-4">

                    <label>Estado</label>

                    <select name="estado"
                            class="form-select">

                        <option value="Disponible"
                            {{ $vehiculo->estado == 'Disponible' ? 'selected' : '' }}>
                            Disponible
                        </option>

                        <option value="Reservado"
                            {{ $vehiculo->estado == 'Reservado' ? 'selected' : '' }}>
                            Reservado
                        </option>

                        <option value="Mantenimiento"
                            {{ $vehiculo->estado == 'Mantenimiento' ? 'selected' : '' }}>
                            Mantenimiento
                        </option>

                    </select>

                </div>

                <button class="btn btn-warning">
                    Actualizar Vehículo
                </button>

            </form>

        </div>

    </div>

</div>

@endsection
