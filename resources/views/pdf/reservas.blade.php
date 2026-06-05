<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<title>Reporte de Reservas</title>

<style>

body{
    font-family: Arial, sans-serif;
    color:#374151;
}

h1{
    text-align:center;
    color:#0F172A;
}

.header{
    border-bottom:3px solid #F97316;
    margin-bottom:20px;
    padding-bottom:10px;
}

table{
    width:100%;
    border-collapse:collapse;
}

th{
    background:#1E3A5F;
    color:white;
    padding:10px;
    border:1px solid #ddd;
}

td{
    padding:8px;
    border:1px solid #ddd;
}

.footer{
    margin-top:20px;
    text-align:center;
    font-size:12px;
}

</style>
</head>
<body>

<div class="header">
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

            <td>
                ${{ number_format($reserva->total,2) }}
            </td>

            <td>
                {{ $reserva->estado }}
            </td>

        </tr>

        @endforeach

    </tbody>

</table>

<div class="footer">
    Fecha de generación: {{ date('d/m/Y H:i:s') }}
</div>

</body>
</html>