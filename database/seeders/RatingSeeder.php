<?php

namespace Database\Seeders;

use App\Models\Rating;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RatingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Rating::truncate();

        $faker = \Faker\Factory::create();
        $id = DB::table('movie')->pluck('id');

        for ($i = 0; $i < 5; $i++) {
            Rating::create([
                'movie_id' => $faker->randomElement($id),
                'username' => $faker->name,
                'rating' => $faker->numberBetween(1,10),
                'description' => $faker->sentence,
            ]);
        }
    }
}
