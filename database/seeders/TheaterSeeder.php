<?php

namespace Database\Seeders;

use App\Models\Theater;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TheaterSeeder extends Seeder {
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        Theater::truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        Theater::create([
            'name' => "ABC Movies",
        ]);
        Theater::create([
            'name' => "DEF Movies",
        ]);
        Theater::create([
            'name' => "GHI Movies",
        ]);
    }
}
