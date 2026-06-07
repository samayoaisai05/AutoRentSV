<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<title>Reporte de Reservas</title>

<style>

body{
    font-family: Arial, sans-serif;
    color:#374151;
    margin:20px;
    font-size:12px;
}

/* HEADER */
.header{
    text-align:center;
    border-bottom:3px solid #F97316;
    margin-bottom:20px;
    padding-bottom:10px;
}

.header img{
    width:90px;
    margin-bottom:5px;
}

.header h1{
    margin:0;
    color:#0F172A;
    font-size:18px;
}

/* TABLA */
table{
    width:100%;
    border-collapse:collapse;
    font-size:12px;
}

th{
    background:#1E3A5F;
    color:white;
    padding:8px;
    border:1px solid #ddd;
}

td{
    padding:7px;
    border:1px solid #ddd;
    text-align:center;
}

/* FOOTER */
.footer{
    margin-top:20px;
    text-align:center;
    font-size:11px;
    color:#6b7280;
    border-top:1px solid #e5e7eb;
    padding-top:8px;
}

/* BADGE */
.badge{
    background:#F97316;
    color:white;
    padding:3px 8px;
    border-radius:5px;
    font-size:11px;
}

</style>
</head>

<body>

{{-- HEADER --}}
<div class="header">

    {{-- LOGO --}}
    <img src="{{ public_path('img/logo.png') }}">

    <h1>AutoRent SV</h1>
    <p>Reporte de Reservas</p>

</div>

<table>

    <thead>
        <tr>
            <th>ID</th>
            <th>Cliente</th>
            <th>Vehículo</th>
            <th>Inicio</th>
            <th>Fin</th>
            <th>Total</th>
            <th>Estado</th>
        </tr>
    </thead>

    <tbody>

        @foreach($reservas as $reserva)

        <tr>
            <td>{{ $reserva->id }}</td>

            <td>
                {{ $reserva->user->name }}
                {{ $reserva->user->apellido }}
            </td>

            <td>
                {{ $reserva->vehiculo->marca }}
                {{ $reserva->vehiculo->modelo }}
            </td>

            <td>{{ $reserva->fecha_inicio }}</td>

            <td>{{ $reserva->fecha_fin }}</td>

            <td>${{ number_format($reserva->total,2) }}</td>

            <td>
                <span class="badge">
                    {{ $reserva->estado }}
                </span>
            </td>

        </tr>

        @endforeach

    </tbody>

</table>

<div class="footer">
    Fecha de generación: {{ date('d/m/Y H:i:s') }}
    <br>
    © {{ date('Y') }} AutoRent SV
</div>

</body>
</html>