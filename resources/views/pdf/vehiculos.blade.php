<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<title>Reporte de Vehículos</title>

<style>

body{
    font-family: Arial, sans-serif;
    color:#374151;
    margin: 30px;
}

/* HEADER */
.header{
    text-align:center;
    border-bottom:3px solid #F97316;
    padding-bottom:15px;
    margin-bottom:25px;
}

.header img{
    width:120px;
    margin-bottom:10px;
}

/* TABLA */
table{
    width:100%;
    border-collapse:collapse;
    font-size:13px;
}

th{
    background:#1E3A5F;
    color:white;
    padding:10px;
    border:1px solid #ddd;
    text-transform:uppercase;
}

td{
    padding:8px;
    border:1px solid #ddd;
    text-align:center;
    vertical-align: middle;
}

tr:nth-child(even){
    background:#f8fafc;
}

/* IMAGEN VEHÍCULO */
.vehicle-img{
    width:80px;
    height:60px;
    object-fit:cover;
    border-radius:6px;
    border:1px solid #e5e7eb;
}

/* BADGE */
.badge{
    padding:4px 8px;
    border-radius:6px;
    background:#F97316;
    color:white;
    font-size:12px;
}

/* FOOTER */
.footer{
    margin-top:25px;
    text-align:center;
    font-size:12px;
    color:gray;
    border-top:1px solid #e5e7eb;
    padding-top:10px;
}

</style>
</head>

<body>

{{-- HEADER --}}
<div class="header">

    <img src="{{ public_path('img/logo.png') }}">

    <h1>AutoRent SV</h1>
    <p>Reporte de Vehículos Registrados</p>

</div>

{{-- TABLA --}}
<table>

    <thead>
        <tr>
            <th>ID</th>
            <th>Imagen</th>
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

            {{-- IMAGEN VEHÍCULO --}}
            <td>
                @if($vehiculo->imagen)
                    <img class="vehicle-img"
                         src="{{ public_path('storage/vehiculos/' . $vehiculo->imagen) }}">
                @else
                    Sin imagen
                @endif
            </td>

            <td>{{ $vehiculo->marca }}</td>
            <td>{{ $vehiculo->modelo }}</td>
            <td>{{ $vehiculo->anio }}</td>
            <td>{{ $vehiculo->color }}</td>
            <td>${{ number_format($vehiculo->precio_dia,2) }}</td>

            <td>
                <span class="badge">
                    {{ $vehiculo->estado }}
                </span>
            </td>

        </tr>

        @endforeach

    </tbody>

</table>

{{-- FOOTER --}}
<div class="footer">
    Fecha de generación: {{ date('d/m/Y H:i:s') }}
    <br>
    © {{ date('Y') }} AutoRent SV
</div>

</body>
</html>