<?php

namespace Database\Factories;

use App\Models\VetVisit;
use App\Models\Pet;
use Illuminate\Database\Eloquent\Factories\Factory;

class VetVisitFactory extends Factory
{
    protected $model = VetVisit::class;

    public function definition()
    {
        return [
            'pet_id' => Pet::factory(), // Default to creating a new pet if not provided
            // The 'vet_visits' table has 'description' and 'date' columns based on the migration
            'description' => $this->faker->sentence,
            'date' => $this->faker->dateTimeThisYear(),
        ];
    }
}
