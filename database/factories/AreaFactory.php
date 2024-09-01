<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Area>
 */
class AreaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->randomElement([
                "Banani",
                "Canbazar Army-b",
                "Canbazar Army-e",
                "Canbazar Civil-b",
                "Canbazar Civil-e",
                "Mannan Line",
                "Moinul Road",
                "Mostofa Kamal",
                "Nirjhor",
                "AHQ",
                "Ispr",
                "CMH",
                "Dgfi",
                "Rajonigondha",
                "Seena Polly",
                "Staff Road",
                "Yousuf Road",
                "Zia Koloni"
            ])
        ];
    }
}
