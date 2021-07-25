<?php

use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'Emanuel',
            'email' => 'emanuel7233@gmail.com',
            'password' => '123',
            'rol' => '1',
        ]);
    }
}
