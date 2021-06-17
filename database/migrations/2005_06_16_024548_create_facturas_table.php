<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFacturasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('facturas', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('valorFactura')->nullable();
            $table->integer('numeroOrden');
            $table->integer('valorAdicional');
            $table->mediumText('observacion');
            $table->enum('estadoFactura',array('Pendiente Pago','Pendiente Facturar','Pago'));
            $table->integer('flete')->nullable();
            $table->integer('anticipo')->nullable();
            $table->integer('porcentaje')->nullable();
            $table->integer('saldo')->nullable();
            $table->unsignedBigInteger('idCliente');
            $table->unsignedBigInteger('idVehiculo');

            $table->foreign('idVehiculo')->references('id')->on('vehiculos');
            $table->foreign('idCliente')->references('id')->on('clientes');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('facturas');
    }
}
