<?php

namespace Database\Seeders;

use App\Models\Performer;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PerformerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Performer::truncate();

        $faker = \Faker\Factory::create();
        for ($i = 0; $i < 5; $i++) {
            Performer::create([
                'name' => $faker->name,
            ]);
        }
    }
}
