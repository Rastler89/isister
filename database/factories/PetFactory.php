<?php

namespace Database\Factories;

use App\Models\Pet;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class PetFactory extends Factory
{
    protected $model = Pet::class;

    public function definition()
    {
        return [
            'name' => $this->faker->name,
            'user_id' => User::factory(),
            'gender' => $this->faker->randomElement(['M', 'F']), // Added
            'birth' => $this->faker->date(), // Added
            'code' => $this->faker->unique()->ean8, //Added
            'breed_id' => 1, // Added, assuming a breed with ID 1 exists or will be created by migrations.
            'hash' => $this->faker->sha256, // Added
            // Assuming 'species' and 'breed' are fillable attributes in Pet model
            // and do not have foreign key constraints that would cause issues here.
            // If they do, this might need adjustment.
            'species' => $this->faker->randomElement(['dog', 'cat', 'bird']),
            // 'breed' => $this->faker->word, // Removed as the column is removed
            'age' => $this->faker->numberBetween(1, 15),
            'weight' => $this->faker->randomFloat(2, 1, 50),
        ];
    }
}
