<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Factura AutoRent SV</title>

    <style>
        body{
            font-family: Arial, Helvetica, sans-serif;
            color: #374151;
            margin: 30px;
        }

        .header{
            text-align: center;
            border-bottom: 3px solid #F97316;
            padding-bottom: 15px;
            margin-bottom: 30px;
        }

        .header h1{
            color: #0F172A;
            margin: 0;
        }

        .header p{
            margin: 5px 0;
        }

        .section{
            margin-bottom: 25px;
        }

        .section-title{
            background-color: #0F172A;
            color: white;
            padding: 8px;
            font-size: 14px;
            font-weight: bold;
        }

        table{
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }

        table th{
            background-color: #1E3A5F;
            color: white;
            padding: 10px;
            border: 1px solid #ddd;
        }

        table td{
            padding: 10px;
            border: 1px solid #ddd;
        }

        .total{
            margin-top: 20px;
            text-align: right;
            font-size: 18px;
            font-weight: bold;
            color: #F97316;
        }

        .footer{
            margin-top: 50px;
            text-align: center;
            font-size: 12px;
            color: #6b7280;
        }
    </style>
</head>
<body>

    <div class="header">
        <h1>AutoRent SV</h1>
        <p>Sistema de Alquiler de Vehículos</p>
        <p>Factura de Reserva</p>
    </div>

    <div class="section">
        <div class="section-title">
            Información de la Factura
        </div>

        <table>
            <tr>
                <td><strong>Factura N°</strong></td>
                <td>#{{ $reserva->id }}</td>
            </tr>

            <tr>
                <td><strong>Fecha de Emisión</strong></td>
                <td>{{ date('d/m/Y') }}</td>
            </tr>
        </table>
    </div>

    <div class="section">
        <div class="section-title">
            Datos del Cliente
        </div>

        <table>
            <tr>
                <td><strong>Nombre</strong></td>
                <td>
                    {{ $reserva->user->name }}
                    {{ $reserva->user->apellido }}
                </td>
            </tr>

            <tr>
                <td><strong>Correo</strong></td>
                <td>{{ $reserva->user->email }}</td>
            </tr>

            <tr>
                <td><strong>Teléfono</strong></td>
                <td>{{ $reserva->user->telefono }}</td>
            </tr>
        </table>
    </div>

    <div class="section">
        <div class="section-title">
            Información del Vehículo
        </div>

        <table>
            <tr>
                <td><strong>Marca</strong></td>
                <td>{{ $reserva->vehiculo->marca }}</td>
            </tr>

            <tr>
                <td><strong>Modelo</strong></td>
                <td>{{ $reserva->vehiculo->modelo }}</td>
            </tr>

            <tr>
                <td><strong>Año</strong></td>
                <td>{{ $reserva->vehiculo->anio }}</td>
            </tr>

            <tr>
                <td><strong>Color</strong></td>
                <td>{{ $reserva->vehiculo->color }}</td>
            </tr>

            <tr>
                <td><strong>Placa</strong></td>
                <td>{{ $reserva->vehiculo->placa }}</td>
            </tr>
        </table>
    </div>

    <div class="section">
        <div class="section-title">
            Detalle de la Reserva
        </div>

        <table>
            <thead>
                <tr>
                    <th>Fecha Inicio</th>
                    <th>Fecha Fin</th>
                    <th>Días</th>
                    <th>Precio por Día</th>
                    <th>Total</th>
                </tr>
            </thead>

            <tbody>
                <tr>
                    <td>{{ $reserva->fecha_inicio }}</td>
                    <td>{{ $reserva->fecha_fin }}</td>
                    <td>{{ $reserva->dias }}</td>
                    <td>${{ number_format($reserva->precio_dia, 2) }}</td>
                    <td>${{ number_format($reserva->total, 2) }}</td>
                </tr>
            </tbody>
        </table>

        <div class="total">
            Total a Pagar:
            ${{ number_format($reserva->total, 2) }}
        </div>
    </div>

    <div class="footer">
        Gracias por confiar en AutoRent SV.
        <br>
        Documento generado automáticamente por el sistema.
    </div>

</body>
</html>