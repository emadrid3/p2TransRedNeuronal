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
        date_default_timezone_set('Europe/Madrid');
        // Cargando el csv en memoria
        $archivo = '../transgirar/Finales seeders dataset/HistorialTable.csv';
        $csv = Reader::createFromPath($archivo);
        $csv->setHeaderOffset(0);
        $out = new \Symfony\Component\Console\Output\ConsoleOutput();
        //$out->writeln($date);
        foreach($csv as $offset => $registro){
            $impl = implode(';', $registro);
            $x = explode(';',$impl);
            $id = $x[0];
            $fecha = explode('/',$x[1]);
            $date = date("Y-m-d", mktime(0,0,0,$fecha[1], $fecha[0], $fecha[2]));
            //$date = date("Y-m-d", strtotime($fecha));
            $placa = $x[2];
            $tipoVehiculo = $x[3];
            $tipo = $x[4];
            $conductor = str_replace('�','Ñ',$x[5]);
            $origen = $x[6];
            $destino = $x[7];
            $cliente = $x[8];
            $flete = $x[9];
            \DB::table('historiales')->insert(
                array(
                    'id' => $id,
                    'fecha' => $date,
                    'placa' => $placa,
                    'tipoVehiculo' => $tipoVehiculo,
                    'tipo' => $tipo,
                    'conductor' => $conductor,
                    'origen' => $origen,
                    'destino' => $destino,
                    'cliente' => $cliente,
                    'flete' => $flete,
                    'created_at' => \Carbon\Carbon::now(),
                    'updated_at' => \Carbon\Carbon::now(),
                )
            );
        }
    }
}