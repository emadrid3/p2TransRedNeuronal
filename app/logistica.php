<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class logistica extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id',
        'fecha',
        'origen',
        'destino',
        'idVehiculo',
        'idConductor',
        'idCarga',
        'idFactura',
    ];
}
