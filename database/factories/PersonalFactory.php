<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Personal>
 */
class PersonalFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'idpersonal' => fake()->unique()->lexify('?????'), 
            'nombrepersonal' => fake()->name(),
            'telefono' => fake()->phoneNumber(), 
            'tipo' => fake()->word(), 
        ];
    }
}
