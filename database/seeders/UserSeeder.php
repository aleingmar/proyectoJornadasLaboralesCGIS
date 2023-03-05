<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
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
        DB::table('users')->insert([
            [
                'name' => "Administrador",
                'email' => "administrador@administrador.com",
                'password' => Hash::make('12345678'),
                'telefono' => 676564832
            ],
            [
                'name' => "JefeGuardia Medicos",
                'email' => "jefeGuardiaMedicos@medico.com",
                'password' => Hash::make('12345678'),
                'telefono' => 776566832
            ],
            [
                'name' => "JefeGuardia Enfermeros",
                'email' => "jefeGuardiaEnfermeros@medico.com",
                'password' => Hash::make('12345678'),
                'telefono' => 676534532
            ],
            
        ]);
    }
}
