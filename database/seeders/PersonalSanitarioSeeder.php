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

        DB::table('personal_sanitarios')->insert([
            [
                'profesion' => "Médicos",
                'cargo' => 'Jefe de Guardia',
                'user_id' => 1
            ],
            [
                'profesion' => "Enfermeros",
                'cargo' => 'Jefe de Guardia',
                'user_id' => 2
            ],
        ]);


    }
}
