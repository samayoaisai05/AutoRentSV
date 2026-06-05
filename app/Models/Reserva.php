<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Reserva extends Model
{
    protected $fillable = [
        'user_id',
        'vehiculo_id',
        'fecha_inicio',
        'fecha_fin',
        'dias',
        'precio_dia',
        'total',
        'estado'
    ];
}
