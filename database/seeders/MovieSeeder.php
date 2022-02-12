<?php

namespace Database\Seeders;

use App\Models\Movie;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MovieSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        Movie::truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
        
        $movie_name = ['Parasite','The Favourite', 'The Farewell I', 'Marriage Story', 'Booksmart'];
        $faker = \Faker\Factory::create();
        for ($i = 0; $i < 5; $i++) {
            Movie::create([
                'title' => $movie_name[$i],
                'release_date' => $faker->date,
                'length' => $faker->numberBetween(50,200),
                'description' => $faker->sentence,
                'mpaa_rating' => $faker->randomElement(['G', 'PG', 'PG-13','R']),
            ]);
        }
    }
}
