<?php

namespace Tests\Feature;

use App\Models\Movie;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class RatingTest extends TestCase
{
    public function test_giveRating() {
        $movie = Movie::factory(Movie::class)->create();

        $payload = [
            'movie_title' => $movie->title,
            'username' => 'Ringo',
            'rating' => 10,
            'r_description' => "A masterpiece!.",
        ];

        $this->json('POST', '/api/give_rating', $payload)
            ->assertStatus(201)
            ->assertJson(['message' => "Successfully added review for ".$movie->title." by user: Ringo", 'success' => true]);
    }
}
