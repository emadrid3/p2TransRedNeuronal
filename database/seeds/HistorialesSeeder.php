<?php

use App\Http\Controllers\Controller;
use Illuminate\Database\Seeder;
use League\Csv\Reader;

class HistorialesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Cargando el csv en memoria
        $archivo = '../transgirar/Finales seeders dataset/HistorialTable2.csv';
        $csv = Reader::createFromPath($archivo);
        $csv->setHeaderOffset(0);
        foreach($csv as $offset => $registro){
            $impl = implode(';', $registro);
            $x = explode(';',$impl);
            $id = $x[0];
            $fecha = $x[1];
            $placa = $x[2];
            $tipoVehiculo = $x[3];
            $tipo = $x[4];
            $conductor = $x[5];
            $origen = $x[6];
            $destino = $x[7];
            $cliente = $x[8];
            $flete = $x[9];
            \DB::table('historiales')->insert(
                array(
                    'id' => $id,
                    'fecha' => $fecha,
                    'placa' => $placa,
                    'tipoVehiculo' => $tipoVehiculo,
                    'tipo' => $tipo,
                    'conductor' => $conductor,
                    'origen' => $origen,
                    'destino' => $destino,
                    'cliente' => $cliente,
                    'flete' => $flete,
                )
            );
        }
    }
}