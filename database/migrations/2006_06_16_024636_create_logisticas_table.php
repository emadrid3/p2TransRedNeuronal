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
            $table->string('numero_factura')->nullable();
            $table->string('numero_orden')->nullable();
            $table->string('numero_factura_cliente')->nullable();
            $table->unsignedBigInteger('encargado_id')->nullable();
            $table->date('fecha')->nullable();
            $table->unsignedBigInteger('vehiculo_id')->nullable();
            $table->float('flete')->nullable();
            $table->float('anticipo')->nullable();
            $table->float('descuento')->nullable();
            $table->unsignedBigInteger('conductor_id')->nullable();
            $table->unsignedBigInteger('origen')->nullable();
            $table->unsignedBigInteger('destino')->nullable();
            $table->json('trayecto')->nullable();
            $table->unsignedBigInteger('carga_id')->nullable();
            $table->unsignedBigInteger('tipo_id')->nullable();
            $table->unsignedBigInteger('cliente_id')->nullable();
            $table->json('extra')->nullable();
            $table->float('extra_total')->nullable();
            $table->string('descripcion')->nullable();
            $table->float('factura_total')->nullable();
            $table->enum('estado',array('en proceso','liquidado'));
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
