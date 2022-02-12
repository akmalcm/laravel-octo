<?php

namespace Database\Seeders;

use App\Models\Movie;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MovieSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Movie::truncate();

        $faker = \Faker\Factory::create();
        for ($i = 0; $i < 5; $i++) {
            Movie::create([
                'title' => $faker->name,
                'release_date' => $faker->date,
                'length' => $faker->numberBetween(50,200),
                'description' => $faker->sentence,
            ]);
        }
    }
}
