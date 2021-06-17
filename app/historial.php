<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class historial extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id',
        'fecha',
        'placa',
        'tipoVehiculo',
        'tipo',
        'conductor',
        'origen',
        'destino',
        'cliente',
        'flete',
    ];
}
