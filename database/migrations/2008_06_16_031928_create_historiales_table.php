<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHistorialesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('historiales', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->date('fecha')->nullable();
            $table->string('placa')->nullable();
            $table->string('tipoVehiculo')->nullable();
            $table->string('tipo')->nullable();
            $table->string('conductor')->nullable();
            $table->string('origen')->nullable();
            $table->string('destino')->nullable();
            $table->string('cliente')->nullable();
            $table->integer('flete')->nullable();
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
        Schema::dropIfExists('historiales');
    }
}
