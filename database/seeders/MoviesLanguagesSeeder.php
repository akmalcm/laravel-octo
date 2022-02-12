<?php

namespace Database\Seeders;

use App\Models\Language;
use App\Models\Movie;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MoviesLanguagesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('movies_languages')->truncate();

        $movies = Movie::all();
        $languages = Language::all();

        // Populate the pivot table
        $movies->each(function ($movie) use ($languages) {
            $movie->languages()->attach(
                $languages->random(rand(1, 3))->pluck('id')->toArray()
            );
        });
    }
}
