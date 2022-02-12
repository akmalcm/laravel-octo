<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class MovieTest extends TestCase {

    public function test_addMovie() {
        $payload = [
            'title' => "The King's Man",
            'release' => '2020-09-18',
            'length' => 98,
            'description' => "As a collection of history's worst tyrants and criminal masterminds gather to plot a war to wipe out millions, one man must race against time to stop them.",
            'mpaa_rating' => 'PG-13',
            'genre' => ['Action', 'Adventure', 'Comedy'],
            'director' => 'Matthew Vaughn',
            'performer' => 'Gemma Arterton',
            'performer' => 'Matthew Goode',
            'performer' => 'Ralph Fiennes',
            'language' => 'English',
        ];

        $this->json('POST', '/api/add_movie', $payload)
            ->assertStatus(201)
            ->assertJson(['message' => "Successfully added movie The King's Man with Movie_ID 6", 'success' => true]);
    }
}
