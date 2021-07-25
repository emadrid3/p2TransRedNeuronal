<?php

use Illuminate\Database\Seeder;

class RolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('rols')->insert([
            'Rol' => 'Administrador'
        ]);
        DB::table('rols')->insert([
            'Rol' => 'Contador'
        ]);
        DB::table('rols')->insert([
            'Rol' => 'Logistico'
        ]);
    }
}
