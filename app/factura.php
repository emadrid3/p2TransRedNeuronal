<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class factura extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id',
        'idLogistica',
        'valorFactura',
        'numeroFactura',
        'numeroOrden',
        'valorAdicional',
        'flete',
        'anticipo',
        'porcentaje',
        'idVehiculo',
        'idCliente',
        'estado',
    ];
}
