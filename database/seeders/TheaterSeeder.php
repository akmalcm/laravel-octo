<?php

namespace Database\Seeders;

use App\Models\Theater;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TheaterSeeder extends Seeder {
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        Theater::truncate();

        Theater::create([
            'name' => "ABC Movie",
        ]);
        Theater::create([
            'name' => "DEF Movie",
        ]);
        Theater::create([
            'name' => "GHI Movie",
        ]);
    }
}
