<?php

namespace Database\Seeders;

use App\Models\Movie;
use App\Models\Theater;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MoviesTheatersSeeder extends Seeder {
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        DB::table('movies_theaters')->truncate();

        $movies = Movie::all();
        $theaters = Theater::all();

        $movies->each(function ($movie) use ($theaters) {
            $faker = \Faker\Factory::create();

            $starts_at = Carbon::createFromTimestamp($faker->dateTimeBetween('-5 years', '+0 month')->getTimeStamp());
            $ends_at = Carbon::createFromFormat('Y-m-d H:i:s', $starts_at)->addHours(2);

            $movie->theaters()->attach(
                $theaters->random(rand(1, 3))->pluck('id')->toArray(),
                ['room_no' => $faker->numberBetween(1, 10), 'start_time' => $starts_at, 'end_time' => $ends_at,]
            );
        });
    }
}
