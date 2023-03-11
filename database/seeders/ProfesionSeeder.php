<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProfesionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('profesions')->insert([
            [ // 1
                'nombre' => "Enfermero",
            ],
            [ //2
                'nombre' => "Médico",
            ],
           
        ]);
    }
}
