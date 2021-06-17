<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLogisticasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('logisticas', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->date('fecha');
            $table->string('origen');
            $table->json('destino');
            $table->unsignedBigInteger('idVehiculo'); //Relación con vehiculos
            $table->unsignedBigInteger('idConductor'); //Relación con conductor
            $table->unsignedBigInteger('idCarga'); //Relación con carga
            $table->unsignedBigInteger('idFactura'); //Relación con factura

            //claves foraneas
            $table->foreign('idVehiculo')->references('id')->on('vehiculos');
            $table->foreign('idConductor')->references('id')->on('conductores');
            $table->foreign('idCarga')->references('id')->on('cargas');
            $table->foreign('idFactura')->references('id')->on('facturas');

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
        Schema::dropIfExists('logisticas');
    }
}
