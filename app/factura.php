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
        'valorFactura',
        'numeroOrden',
        'valorAdicional',
        'observacion',
        'estadoFactura',
        'flete',
        'anticipo',
        'porcentaje',
        'saldo',
        'idCliente',
        'idVehiculo',
    ];
}
