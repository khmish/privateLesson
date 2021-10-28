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
        $names = ['Hassan', 'Meshal', 'Fahed'];
        $emails = ['Hassan@Hassan.com', 'Meshal@Meshal.com', 'Fahed@Fahed.com'];
        \App\Models\Lessson::factory(10)->create();
        for ($i = 0; $i < count($emails); $i++) {
            # code...
            \App\Models\User::factory()->state(function (array $attributes) use ($names, $emails, $i) {
                return [
                    'name' => $names[$i],
                    'email' => $emails[$i],
                    'role' => "admin",
                    'gender' => "male",
                ];
            })->create();
        }
        for ($index=1; $index <= 5; $index++) { 
            # code...
            for ($i = 1; $i <= 5; $i++) {
                # code...
                \App\Models\TutorLevelEducation::factory()->state(function (array $attributes) use ($index,$i) {
                    return [
                        'tutor_id' => $index,
                        'leveleducation_id' => $i,
                    ];
                })->create();
            }
        }
        for ($index=1; $index <= 5; $index++) { 
            # code...
            for ($i = 1; $i <= 5; $i++) {
                # code...
                \App\Models\TutorSub::factory()->state(function (array $attributes) use ($index,$i) {
                    return [
                        'tutor_id' => $index,
                        'subject_id' => $i,
                    ];
                })->create();
            }
        }
        
        // $this->call([
        //     TutorSeeder::class
        // ]);
    }
}
