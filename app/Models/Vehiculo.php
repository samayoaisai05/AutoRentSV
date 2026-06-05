<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Vehiculo extends Model
{
    protected $fillable = [
        'marca',
        'modelo',
        'anio',
        'color',
        'placa',
        'precio_dia',
        'imagen',
        'descripcion',
        'estado'
    ];
}
