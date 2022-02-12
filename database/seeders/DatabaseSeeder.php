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
       $this->call(DirectorSeeder::class);
       $this->call(PerformerSeeder::class);
       $this->call(GenreSeeder::class);
       $this->call(MovieSeeder::class);
       $this->call(LanguageSeeder::class);
       $this->call(TheaterSeeder::class);
       $this->call(RatingSeeder::class);

       $this->call(MoviesGenresSeeder::class);
       $this->call(MoviesTheatersSeeder::class);
       $this->call(MoviesDirectorsSeeder::class);
       $this->call(MoviesLanguagesSeeder::class);
       $this->call(MoviesPerformersSeeder::class);
    }
}
