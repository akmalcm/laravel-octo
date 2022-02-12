<?php

namespace Database\Seeders;

use App\Models\Language;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LanguageSeeder extends Seeder {
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        Language::truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        Language::create([
            'title' => 'English'
        ]);
        Language::create([
            'title' => 'Spanish'
        ]);
        Language::create([
            'title' => 'French'
        ]);
        Language::create([
            'title' => 'Arabic'
        ]);
    }
}
