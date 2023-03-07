<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PersonalSanitarioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        //las tablas se llaman como los modelos pero con una s mas 
        DB::table('personal_sanitarios')->insert([
            [
                'profesion' => "Médico",
                'cargo' => 'Jefe de Guardia',
                'user_id' => 1
            ],
            [
                'profesion' => "Enfermero",
                'cargo' => 'Jefe de Guardia',
                'user_id' => 2
            ],
        ]);


    }
}
