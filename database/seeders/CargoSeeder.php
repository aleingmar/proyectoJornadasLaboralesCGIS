<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CargoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         DB::table('cargos')->insert([
            [ //este será el id=1
                'nombre' => "Jefe de Guardia",
            ],
            [
                'nombre' => "Dirección",
            ],
            [ //id= 3
                'nombre' => "Profesional Normal",
            ],
           
        ]);
    }
}
