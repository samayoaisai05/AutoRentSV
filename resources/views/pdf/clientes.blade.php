<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<title>Reporte de Clientes</title>

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
    margin-bottom:25px;
    padding-bottom:15px;
}

.header img{
    width:120px;
    margin-bottom:10px;
}

/* TITULO */
h1{
    margin:0;
    color:#0F172A;
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

/* IMAGEN CLIENTE */
.client-img{
    width:50px;
    height:50px;
    border-radius:50%;
    object-fit:cover;
    border:1px solid #e5e7eb;
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

    {{-- LOGO EMPRESA --}}
    <img src="{{ public_path('img/logo.png') }}">

    <h1>AutoRent SV</h1>
    <p>Reporte de Clientes Registrados</p>

</div>

{{-- TABLA --}}
<table>

    <thead>
        <tr>
            <th>ID</th>
            <th>Nombre</th>
            <th>Apellido</th>
            <th>Correo</th>
            <th>Teléfono</th>
            <th>Dirección</th>
        </tr>
    </thead>

    <tbody>

        @foreach($clientes as $cliente)

        <tr>

            <td>{{ $cliente->id }}</td>

        

            {{-- NOMBRE --}}
            <td>{{ $cliente->name }}</td>

            {{-- APELLIDO --}}
            <td>{{ $cliente->apellido }}</td>

            <td>{{ $cliente->email }}</td>

            <td>{{ $cliente->telefono ?? '—' }}</td>

            <td>{{ $cliente->direccion ?? '—' }}</td>

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