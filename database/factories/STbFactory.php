<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\STb>
 */
class STbFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nuid' => $this->faker->unique()->numerify(str_repeat('#', 10)), // Generate a unique NUID
            'bcl_id' => $this->faker->optional()->numerify('BCL####'), // Optional BCL ID
            'category' => $this->faker->randomElement(['HC', 'NL']), // Randomly pick between HC or NL
            'status' => $this->faker->randomElement(['Good', 'Bad', 'Error']), // Random status
            'is_stock' => $this->faker->boolean, // Randomly true or false
            'remarks' => $this->faker->sentence, // Random sentence for remarks
        ];
    }
}
