@extends('layouts.app')

@section('title', 'Gestión de Reservas')

@section('content')

<style>
    :root{
        --primary:#0F172A;
        --secondary:#1E3A5F;
        --accent:#F97316;
        --light:#F8FAFC;
        --gray:#E5E7EB;
        --white:#FFFFFF;
    }

    .page-header{
        background: linear-gradient(135deg,var(--primary),var(--secondary));
        color:white;
        padding:50px 0;
        margin-bottom:40px;
        text-align:center;
    }

    .card-table{
        background:white;
        border-radius:15px;
        box-shadow:0 5px 15px rgba(0,0,0,.1);
        overflow:hidden;
    }

    .badge-pendiente{
        background:#ffc107;
        color:black;
    }

    .badge-confirmada{
        background:#198754;
    }

    .badge-cancelada{
        background:#dc3545;
    }

    .badge-finalizada{
        background:#0d6efd;
    }
</style>

<div class="page-header">
    <div class="container">
        <h1>Gestión de Reservas</h1>
        <p>Administra las reservas realizadas por los clientes.</p>
    </div>
</div>

<div class="container">

    @if(session('success'))
        <div class="alert alert-success shadow-sm mb-3">
            {{ session('success') }}
        </div>
    @endif

    <div class="card-table">

        <div class="table-responsive">

            <table class="table table-hover align-middle mb-0">

                <thead class="table-dark">

                    <tr>
                        <th>ID</th>
                        <th>Cliente</th>
                        <th>Vehículo</th>
                        <th>Inicio</th>
                        <th>Fin</th>
                        <th>Total</th>
                        <th>Estado</th>
                        <th>Actualizar</th>
                    </tr>

                </thead>

                <tbody>

                @forelse($reservas as $reserva)

                    <tr>

                        <td>
                            {{ $reserva->id }}
                        </td>

                        <td>
                            {{ $reserva->user->name }}
                        </td>

                        <td>
                            {{ $reserva->vehiculo->marca }}
                            {{ $reserva->vehiculo->modelo }}
                        </td>

                        <td>
                            {{ $reserva->fecha_inicio }}
                        </td>

                        <td>
                            {{ $reserva->fecha_fin }}
                        </td>

                        <td>
                            ${{ number_format($reserva->total,2) }}
                        </td>

                        <td>

                            @if($reserva->estado == 'Pendiente')
                                <span class="badge badge-pendiente">
                                    Pendiente
                                </span>

                            @elseif($reserva->estado == 'Aprobada')
                                <span class="badge badge-confirmada">
                                    Aprobada
                                </span>

                            @elseif($reserva->estado == 'Cancelada')
                                <span class="badge badge-cancelada">
                                    Cancelada
                                </span>

                            @else
                                <span class="badge badge-finalizada">
                                    Finalizada
                                </span>
                            @endif

                        </td>

                        <td>

                            <form action="{{ route('admin.reservas.update',$reserva) }}"
                                  method="POST">

                                @csrf
                                @method('PUT')

                                <div class="d-flex gap-2">

                                    <select class="form-select"
                                            name="estado">

                                        <option value="Pendiente"
                                            {{ $reserva->estado=='Pendiente' ? 'selected' : '' }}>
                                            Pendiente
                                        </option>

                                        <option value="Aprobada"
                                            {{ $reserva->estado=='Aprobada' ? 'selected' : '' }}>
                                            Aprobada
                                        </option>

                                        <option value="Cancelada"
                                            {{ $reserva->estado=='Cancelada' ? 'selected' : '' }}>
                                            Cancelada
                                        </option>

                                        <option value="Finalizada"
                                            {{ $reserva->estado=='Finalizada' ? 'selected' : '' }}>
                                            Finalizada
                                        </option>

                                    </select>

                                    <button class="btn btn-success">
                                        Guardar
                                    </button>

                                </div>

                            </form>

                        </td>

                    </tr>

                @empty

                    <tr>
                        <td colspan="8" class="text-center py-4">
                            No existen reservas registradas.
                        </td>
                    </tr>

                @endforelse

                </tbody>

            </table>

        </div>

    </div>

</div>

@endsection
