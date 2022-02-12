<?php

namespace Database\Seeders;

use App\Models\Genre;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GenreSeeder extends Seeder {
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        Genre::truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

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
