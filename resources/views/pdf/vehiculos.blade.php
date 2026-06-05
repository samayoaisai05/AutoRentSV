<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<title>Reporte de Vehículos</title>

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
    <p>Reporte de Vehículos</p>
</div>

<table>

    <thead>
        <tr>
            <th>ID</th>
            <th>Marca</th>
            <th>Modelo</th>
            <th>Año</th>
            <th>Color</th>
            <th>Precio/Día</th>
            <th>Estado</th>
        </tr>
    </thead>

    <tbody>

        @foreach($vehiculos as $vehiculo)

        <tr>
            <td>{{ $vehiculo->id }}</td>
            <td>{{ $vehiculo->marca }}</td>
            <td>{{ $vehiculo->modelo }}</td>
            <td>{{ $vehiculo->anio }}</td>
            <td>{{ $vehiculo->color }}</td>
            <td>${{ number_format($vehiculo->precio_dia,2) }}</td>
            <td>{{ $vehiculo->estado }}</td>
        </tr>

        @endforeach

    </tbody>

</table>

<div class="footer">
    Fecha de generación: {{ date('d/m/Y H:i:s') }}
</div>

</body>
</html>