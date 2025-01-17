<?php

namespace Database\Seeders;

use App\Models\Genre;
use App\Models\Movie;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MoviesGenresSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('movies_genres')->truncate();

        $movies = Movie::all();
        $genres = Genre::all();

        // Populate the pivot table
        $movies->each(function ($movie) use ($genres) {
            $movie->genres()->attach(
                $genres->random(rand(1, 3))->pluck('id')->toArray()
            );
        });
    }
}
