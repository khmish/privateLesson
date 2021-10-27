<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $faker = \Faker\Factory::create();
        $names=['Hassan','Meshal','Fahed'];
        $emails=['Hassan@Hassan.com','Meshal@Meshal.com','Fahed@Fahed.com'];
        \App\Models\Lessson::factory(10)->create();
        for ($i=0; $i <count($emails) ; $i++) { 
            # code...
            \App\Models\User::factory()->state(function (array $attributes) use($names,$emails,$i) {
                return [
                    'name' => $names[$i],
                    'email' => $emails[$i],
                    'role' => "admin",
                ];
            })->create();
        }
        // $this->call([
        //     TutorSeeder::class
        // ]);
    }
}
