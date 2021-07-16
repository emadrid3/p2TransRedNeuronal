<?php

use App\Http\Controllers\Controller;
use Illuminate\Database\Seeder;
use League\Csv\Reader;

class ClienteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Cargando el csv en memoria
        $archivo = '../transgirar/Finales seeders dataset/ClienteTable.csv';
        $csv = Reader::createFromPath($archivo);
        $csv->setHeaderOffset(0);
        foreach($csv as $offset => $registro){
            $impl = implode(';', $registro);
            $x = explode(';',$impl);
            $id = $x[0];
            $nombre = $x[1];
            $razonSocial = $x[2];
            $nit = $x[3];
            //$numeroOrden = $x[3]; No esta en el dataset, se omite
            \DB::table('clientes')->insert(
                array(
                    'id' => $id,
                    'nombre' => $nombre,
                    'razonSocial' => $razonSocial,
                    'nit' => $nit,
                    'created_at' => \Carbon\Carbon::now(),
                    'updated_at' => \Carbon\Carbon::now(),
                    //'numeroOrden' => $numeroOrden, No esta en el dataset, se omite, es nullable
                )
            );
        }
    }
}
