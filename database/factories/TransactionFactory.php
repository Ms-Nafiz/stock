<?php

namespace Database\Factories;

use App\Models\Area;
use App\Models\Building;
use App\Models\STb;
use App\Models\Technician;
use App\Models\TransactionType;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Transaction>
 */
class TransactionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'address' => $this->faker->address,
            'complain_id' => $this->faker->uuid, // assuming complain_id is a UUID from an API
            'transaction_type_id' => TransactionType::factory(), // assuming a related factory exists
            'technician_id' => Technician::factory(), // assuming a related factory exists
            'area_id' => Area::factory(), // assuming a related factory exists
            'building_id' => Building::factory(), // assuming a related factory exists
            'stb_id' => STb::factory(), // assuming a related factory exists
        ];
    }
}
