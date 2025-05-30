<?php

namespace Database\Factories;

use App\Models\Specie;
use Illuminate\Database\Eloquent\Factories\Factory;

class SpecieFactory extends Factory
{
    protected $model = Specie::class;

    public function definition()
    {
        $word = $this->faker->unique()->word;
        return [
            'name' => json_encode([ // Explicitly encode to JSON string
                'en' => $word,
                'es' => $word . '_es', 
            ]),
        ];
    }
}
