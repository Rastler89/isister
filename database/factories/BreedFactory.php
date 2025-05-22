<?php

namespace Database\Factories;

use App\Models\Breed;
use App\Models\Specie;
use Illuminate\Database\Eloquent\Factories\Factory;

class BreedFactory extends Factory
{
    protected $model = Breed::class;

    public function definition()
    {
        return [
            'name' => ['en' => $this->faker->unique()->word], // Adjusted for JSON attribute
            'specie_id' => Specie::factory(), // Default to creating a new specie if not provided
        ];
    }
}
