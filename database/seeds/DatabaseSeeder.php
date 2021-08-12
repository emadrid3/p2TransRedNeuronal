<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(ConductoresSeeder::class);
        $this->call(HistorialesSeeder::class);
        $this->call(ClienteSeeder::class);
        $this->call(CargasSeeder::class);
        $this->call(TipoVehiculoSeeder::class);
        $this->call(VehiculosSeeder::class);
        $this->call(RolesSeeder::class);
        $this->call(CiudadesSeeder::class);
        $this->call(UsuarioSeeder::class);
    }
}
