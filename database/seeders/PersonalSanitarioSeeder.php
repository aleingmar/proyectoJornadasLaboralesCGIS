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
                'profesion_id' => 2,
                'cargo_id' => 2,
                'user_id' => 1
            ],
            [
                'profesion_id' => 2,
                'cargo_id' => 1,
                'user_id' => 2
            ],
            [
                'profesion_id' => 1,
                'cargo_id' => 1,
                'user_id' => 3
            ],
        ]);


    }
}
