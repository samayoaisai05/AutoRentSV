@extends('layouts.app')

@section('title', 'Gestión de Vehículos')

@section('content')

<div class="container py-4">

    <div class="d-flex justify-content-between mb-4">

        <h2>Vehículos</h2>

        <a href="{{ route('vehiculos.create') }}"
           class="btn btn-warning">
            Nuevo Vehículo
        </a>

    </div>

    @if(session('success'))

        <div class="alert alert-success">
            {{ session('success') }}
        </div>

    @endif

    <table class="table table-bordered table-hover">

        <thead class="table-dark">

            <tr>
                <th>ID</th>
                <th>Imagen</th>
                <th>Marca</th>
                <th>Modelo</th>
                <th>Placa</th>
                <th>Precio/Día</th>
                <th>Año</th>
                <th>Estado</th>
                <th>Acciones</th>
            </tr>

        </thead>

        <tbody>

            @foreach($vehiculos as $vehiculo)

            <tr>

                <td>{{ $vehiculo->id }}</td>
                <td>
                    @php
                        $imagenAdmin = !empty($vehiculo->imagen) && file_exists(public_path('storage/vehiculos/' . $vehiculo->imagen))
                            ? asset('storage/vehiculos/' . $vehiculo->imagen)
                            : asset('img/no-image.svg');
                    @endphp
                    <img src="{{ $imagenAdmin }}" alt="{{ $vehiculo->marca }} {{ $vehiculo->modelo }}" class="img-thumbnail" style="width: 70px; height: 50px; object-fit: cover;">
                </td>
                <td>{{ $vehiculo->marca }}</td>
                <td>{{ $vehiculo->modelo }}</td>
                <td>{{ $vehiculo->placa ?? '—' }}</td>
                <td>$ {{ number_format($vehiculo->precio_dia, 2) }}</td>
                <td>{{ $vehiculo->anio }}</td>
                <td>{{ $vehiculo->estado }}</td>

                <td>

    <a href="{{ route('vehiculos.edit',$vehiculo->id) }}"
       class="btn btn-primary btn-sm">
        Editar
    </a>

    <form id="formEliminar{{ $vehiculo->id }}"
          action="{{ route('vehiculos.destroy',$vehiculo->id) }}"
          method="POST"
          class="d-inline">

        @csrf
        @method('DELETE')

        <button type="button"
                class="btn btn-danger btn-sm"
                onclick="confirmarEliminar({{ $vehiculo->id }})">
            Eliminar
        </button>

    </form>

</td>

            </tr>

            @endforeach

        </tbody>

    </table>

</div>

<script>
function confirmarEliminar(id){

    Swal.fire({
        title: '¿Eliminar vehículo?',
        text: 'Esta acción no se puede deshacer',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#F97316',
        cancelButtonColor: '#6c757d',
        confirmButtonText: 'Sí, eliminar',
        cancelButtonText: 'Cancelar'
    }).then((result)=>{

        if(result.isConfirmed){
            document.getElementById('formEliminar'+id).submit();
        }

    });

}
</script>

@endsection
