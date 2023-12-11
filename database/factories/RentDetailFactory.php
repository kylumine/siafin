<?php

namespace Database\Factories;
use App\Models\Movie;
use App\Models\Rent;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\RentDetail>
 */
class RentDetailFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'days_rented' => fake()->numberBetween(1,7),
            'total' => fake()->randomElement(['50','150','100','200','250','300','350']),
            'movie_id' => fake()->randomElement(Movie::pluck('id')),
            'rent_id' => fake()->randomElement(Rent::pluck('id')),
        ];
    }
}
