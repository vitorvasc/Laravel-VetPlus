<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('usuarios')->insert([
            'nome_completo' => 'Vitor Vasconcellos', 
            'email' => 'vvasconcellos1@gmail.com',
            'password' => Hash::make('123'),
            'ativo' => true
        ]);
    }
}
