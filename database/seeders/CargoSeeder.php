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
            [
                'nombre' => "Jefe de Guardia",
            ],
            [
                'nombre' => "Dirección",
            ],
            [
                'nombre' => "Profesional Normal",
            ],
           
        ]);
    }
}
