<?php

namespace Database\Seeders;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
class TutorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = \Faker\Factory::create();
        //
        for ($i=1; $i <=10 ; $i++) { 
            DB::table('tutors')->insert([
                'user_id' =>$i,
                'title_cert' => $faker->word(),
                'price' => $faker->numberBetween(50,500),
                'type' =>$faker->word(),
            ]);
        }
    }
}
