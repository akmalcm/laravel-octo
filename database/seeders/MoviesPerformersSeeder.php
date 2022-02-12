<?php

namespace Database\Seeders;

use App\Models\Movie;
use App\Models\Performer;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MoviesPerformersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $movies = Movie::all();
        $performers = Performer::all();

        // Populate the pivot table
        $movies->each(function ($movie) use ($performers) {
            $movie->performers()->attach(
                $performers->random(rand(1, 3))->pluck('id')->toArray()
            );
        });
    }
}
