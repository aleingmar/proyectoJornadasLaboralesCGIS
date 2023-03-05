<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AccesoCentroSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('citas')->insert([
            [
                'personal_sanitario_id' => 1,
                'entrada' => '2021-05-30 07:15:00',
                'salida' => '2021-05-30 15:30:10',
            ],
            [
                'personal_sanitario_id' => 1,
                'entrada' => '2021-05-30 08:15:40',
                'salida' => '2021-05-30 16:30:20',
            ],
            [
                'personal_sanitario_id' => 2,
                'entrada' => '2021-05-30 07:25:00',
                'salida' => '2021-05-30 15:36:10',
            ],
        ]);

    }
}