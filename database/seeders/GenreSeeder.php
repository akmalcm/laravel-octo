<?php

namespace Database\Seeders;

use App\Models\Genre;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class GenreSeeder extends Seeder {
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        Genre::truncate();

        Genre::create([
            'title' => "Comedy",
        ]);
        Genre::create([
            'title' => "Adventure",
        ]);
        Genre::create([
            'title' => "Drama",
        ]);
        Genre::create([
            'title' => "Action",
        ]);
        Genre::create([
            'title' => "Sci-fi",
        ]);
    }
}
