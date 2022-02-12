<?php

namespace Database\Factories;

use App\Models\Movie;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Movie>
 */
class MovieFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Movie::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'title' => 'The Irishman',
            'release_date' => $this->faker->date,
            'length' => $this->faker->numberBetween(50,200),
            'description' => $this->faker->sentence,
            'mpaa_rating' => 'PG-13'
        ];
    }
    
}
