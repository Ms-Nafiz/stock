<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\TransactionType>
 */
class TransactionTypeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'types' => $this->faker->randomElement(["Disconnection", "STB Return", "Reconnection", "STB Change", "Convert (ANG to DG)", "Convert (DG to ANG)", "STB Return & DC", "1st Child DC (Digital)", "New Connection",'Exchange']),
            'stock_impact' => $this->faker->boolean,
            'is_available' => $this->faker->boolean,
        ];
    }
}
