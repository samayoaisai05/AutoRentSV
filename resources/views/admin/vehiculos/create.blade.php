@extends('layouts.app')

@section('title', 'Registrar Vehículo')

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
    color: white;
    padding: 50px 0;
    text-align: center;
    margin-bottom: 40px;
}

.form-card{
    background: white;
    border-radius: 15px;
    padding: 30px;
    border: 1px solid var(--gray);
    box-shadow: 0 5px 15px rgba(0,0,0,.05);
}

.form-label{
    font-weight: 600;
    color: var(--primary);
}

.form-control,
.form-select{
    border: 1px solid #D1D5DB;
}

.btn-guardar{
    background-color: var(--accent);
    color: white;
    border: none;
    padding: 12px 25px;
    border-radius: 10px;
    font-weight: 600;
}

.btn-guardar:hover{
    background-color: var(--accent-hover);
    color: white;
}

.btn-cancelar{
    background-color: #6B7280;
    color: white;
    border: none;
    padding: 12px 25px;
    border-radius: 10px;
    text-decoration: none;
}

.btn-cancelar:hover{
    color: white;
}
</style>

<div class="page-header">
    <div class="container">
        <h1>Registrar Vehículo</h1>
        <p>Agregar un nuevo vehículo al sistema</p>
    </div>
</div>

<div class="container">

    <div class="row justify-content-center">

        <div class="col-lg-8">

            <div class="form-card">

                <form action="{{ route('vehiculos.store') }}"
                      method="POST"
                      enctype="multipart/form-data">

                    @csrf

                    <div class="row">

                        <div class="col-md-6 mb-3">
                            <label class="form-label">Marca</label>
                            <input type="text"
                                   name="marca"
                                   class="form-control"
                                   required>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="form-label">Modelo</label>
                            <input type="text"
                                   name="modelo"
                                   class="form-control"
                                   required>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="form-label">Año</label>
                            <input type="number"
                                   name="anio"
                                   min="2000"
                                   max="2100"
                                   class="form-control"
                                   required>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="form-label">Color</label>
                            <input type="text"
                                   name="color"
                                   class="form-control"
                                   required>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="form-label">Placa</label>
                            <input type="text"
                                   name="placa"
                                   class="form-control"
                                   required>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="form-label">
                                Precio por Día ($)
                            </label>
                            <input type="number"
                                   step="0.01"
                                   name="precio_dia"
                                   class="form-control"
                                   required>
                        </div>

                        <div class="col-md-12 mb-3">
                            <label class="form-label">
                                Imagen del Vehículo
                            </label>
                            <input type="file"
                                   name="imagen"
                                   class="form-control">
                        </div>

                        <div class="col-md-12 mb-3">
                            <label class="form-label">
                                Descripción
                            </label>

                            <textarea
                                name="descripcion"
                                rows="4"
                                class="form-control"></textarea>
                        </div>

                        <div class="col-md-6 mb-4">
                            <label class="form-label">Estado</label>

                            <select name="estado"
                                    class="form-select">

                                <option value="Disponible">
                                    Disponible
                                </option>

                                <option value="Reservado">
                                    Reservado
                                </option>

                                <option value="Mantenimiento">
                                    Mantenimiento
                                </option>

                            </select>
                        </div>

                    </div>

                    <div class="d-flex gap-2">

                        <button type="submit"
                                class="btn btn-guardar">
                            Guardar Vehículo
                        </button>

                        <a href="{{ route('vehiculos.index') }}"
                           class="btn-cancelar">
                            Cancelar
                        </a>

                    </div>

                </form>

            </div>

        </div>

    </div>

</div>

@endsection