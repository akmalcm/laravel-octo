<?php

namespace Database\Seeders;

use App\Models\Director;
use App\Models\Movie;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MoviesDirectorsSeeder extends Seeder {
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        $movies = Movie::all();
        $directors = Director::all();

        // Populate the pivot table
        $movies->each(function ($movie) use ($directors) {
            $movie->directors()->attach(
                $directors->random(rand(1, 3))->pluck('id')->toArray()
            );
        });
    }
}
