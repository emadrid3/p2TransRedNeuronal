<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInvoiceTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invoice', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('idLogistica');
            $table->unsignedBigInteger('valorFactura');
            $table->string('numeroFactura');
            $table->string('numeroOrden');
            $table->unsignedBigInteger('valorAdicional');
            $table->unsignedBigInteger('flete');
            $table->unsignedBigInteger('anticipo');
            $table->unsignedBigInteger('porcentaje');
            $table->unsignedBigInteger('idVehiculo');
            $table->unsignedBigInteger('idCliente');
            $table->enum('estado',array('pendiente de pago','pagado'));
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
        Schema::dropIfExists('invoice');
    }
}