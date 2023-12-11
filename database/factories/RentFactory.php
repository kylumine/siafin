<?php

namespace Database\Factories;
use App\Models\Customer;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Rent>
 */
class RentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'total' => fake()->randomElement(['50','150','100','200','250','300','350']),
            'rented_on' => fake()->date(),
            'return_by' => fake()->date(),
            'customer_id' => fake()->randomElement(Customer::pluck('id')),
        ];
    }
}
