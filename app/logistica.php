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
        'numero_factura',
        'numero_orden',
        'encargado_id',
        'fecha',
        'vehiculo_id',
        'flete',
        'anticipo',
        'descuento',
        'conductor_id',
        'origen',
        'destino',
        'trayecto',
        'carga_id',
        'cliente_id',
        'extra',
        'extra_total',
        'descripcion',
        'factura_total'
    ];
}
