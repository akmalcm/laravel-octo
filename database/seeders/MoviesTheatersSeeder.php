<?php

namespace Database\Seeders;

use App\Models\Movie;
use App\Models\Theater;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MoviesTheatersSeeder extends Seeder {
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        $movies = Movie::all();
        $theaters = Theater::all();

        // Populate the pivot table
        $movies->each(function ($movie) use ($theaters) {
            $movie->theaters()->attach(
                $theaters->random(rand(1, 3))->pluck('id')->toArray()
            );
        });
    }
}
