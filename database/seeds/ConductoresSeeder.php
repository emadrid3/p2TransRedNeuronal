<?php

use Illuminate\Database\Seeder;

class ConductoresSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('conductores')->insert(
            [
                'nombre' 		=>	'David',
                'cedula'	    =>	'111',
                'celular'		=>	'14445884'
            ],
            [
                'nombre' 		=>	'David',
                'cedula'	    =>	'111',
                'celular'		=>	'14445884'
            ],
            [
                'nombre' 		=>	'David',
                'cedula'	    =>	'111',
                'celular'		=>	'14445884'
            ]);
    }
}
