<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<title>Factura AutoRent SV</title>

<style>

body{
    font-family: Arial, Helvetica, sans-serif;
    color:#374151;
    margin:20px;
    font-size:12px;
}

/* CONTENEDOR PARA EVITAR SALTOS */
.page{
    page-break-inside: avoid;
}

/* HEADER */
.header{
    text-align:center;
    border-bottom:3px solid #F97316;
    padding-bottom:10px;
    margin-bottom:15px;
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

/* SECCIONES */
.section{
    margin-bottom:12px;
}

.section-title{
    background:#0F172A;
    color:white;
    padding:6px;
    font-size:12px;
    margin-bottom:6px;
}

/* TABLAS */
table{
    width:100%;
    border-collapse:collapse;
}

td, th{
    border:1px solid #ddd;
    padding:6px;
}

th{
    background:#1E3A5F;
    color:white;
    font-size:11px;
}

/* TOTAL */
.total{
    margin-top:10px;
    text-align:right;
    font-size:14px;
    font-weight:bold;
    color:#F97316;
}

/* BADGE */
.badge{
    background:#F97316;
    color:white;
    padding:3px 8px;
    border-radius:5px;
    font-size:11px;
}

/* FOOTER */
.footer{
    margin-top:15px;
    text-align:center;
    font-size:10px;
    color:#6b7280;
}

</style>
</head>

<body>

<div class="page">

{{-- HEADER --}}
<div class="header">
    <img src="{{ public_path('img/logo.png') }}">
    <h1>AutoRent SV</h1>
    <p>Factura de Reserva</p>
</div>

{{-- VALIDACIÓN --}}
@if($reserva->estado != 'Aprobada')

    <h3 style="text-align:center;color:red;">
        Factura disponible solo cuando la reserva está aprobada.
    </h3>

@else

{{-- INFO --}}
<div class="section">
    <div class="section-title">Factura</div>

    <table>
        <tr>
            <td><strong>N°</strong> #{{ $reserva->id }}</td>
            <td><strong>Estado:</strong> <span class="badge">{{ $reserva->estado }}</span></td>
            <td><strong>Fecha:</strong> {{ date('d/m/Y') }}</td>
            <td><strong>Hora:</strong> {{ date('H:i:s') }}</td>
        </tr>
    </table>
</div>

{{-- CLIENTE --}}
<div class="section">
    <div class="section-title">Cliente</div>

    <table>
        <tr>
            <td><strong>Nombre:</strong> {{ $reserva->user->name }}</td>
            <td><strong>Correo:</strong> {{ $reserva->user->email }}</td>
            <td><strong>Tel:</strong> {{ $reserva->user->telefono }}</td>
        </tr>
    </table>
</div>

{{-- VEHÍCULO --}}
<div class="section">
    <div class="section-title">Vehículo</div>

    <table>
        <tr>
            <td><strong>Marca:</strong> {{ $reserva->vehiculo->marca }}</td>
            <td><strong>Modelo:</strong> {{ $reserva->vehiculo->modelo }}</td>
            <td><strong>Año:</strong> {{ $reserva->vehiculo->anio }}</td>
            <td><strong>Color:</strong> {{ $reserva->vehiculo->color }}</td>
        </tr>
    </table>
</div>

{{-- DETALLE --}}
<div class="section">
    <div class="section-title">Detalle</div>

    <table>
        <thead>
            <tr>
                <th>Inicio</th>
                <th>Fin</th>
                <th>Días</th>
                <th>Precio Día</th>
                <th>Total</th>
            </tr>
        </thead>

        <tbody>
            <tr>
                <td>{{ $reserva->fecha_inicio }}</td>
                <td>{{ $reserva->fecha_fin }}</td>
                <td>{{ $reserva->dias }}</td>
                <td>${{ number_format($reserva->precio_dia,2) }}</td>
                <td>${{ number_format($reserva->total,2) }}</td>
            </tr>
        </tbody>
    </table>

    <div class="total">
        Total a pagar: ${{ number_format($reserva->total,2) }}
    </div>
</div>

@endif

{{-- FOOTER --}}
<div class="footer">
    AutoRent SV - Documento generado automáticamente
</div>

</div>

</body>
</html>