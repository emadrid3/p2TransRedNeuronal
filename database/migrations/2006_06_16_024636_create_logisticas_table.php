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
            $table->integer('valorFactura')->nullable();
            $table->integer('numeroOrden');
            $table->integer('valorAdicional');
            $table->mediumText('observacion');
            $table->enum('estadoFactura', array('Pendiente Pago', 'Pendiente Facturar', 'Pago'));
            $table->integer('flete')->nullable();
            $table->integer('anticipo')->nullable();
            $table->integer('porcentaje')->nullable();
            $table->integer('saldo')->nullable();
            $table->unsignedBigInteger('idCliente'); // Relación con Clientes
            $table->unsignedBigInteger('idVehiculo'); //Relación con vehiculos
            $table->unsignedBigInteger('idConductor'); //Relación con conductor
            $table->unsignedBigInteger('idCarga'); //Relación con carga

            //claves foraneas
            $table->foreign('idCliente')->references('id')->on('clientes');
            $table->foreign('idVehiculo')->references('id')->on('vehiculos');
            $table->foreign('idConductor')->references('id')->on('conductores');
            $table->foreign('idCarga')->references('id')->on('cargas');

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
