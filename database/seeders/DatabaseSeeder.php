<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        \App\Models\User::factory(1)->create();
        // \App\Models\Area::factory(10)->create();
        // \App\Models\Building::factory(10)->create();
        // \App\Models\Note::factory(10)->create();
        // \App\Models\STb::factory(10)->create();
        // \App\Models\Technician::factory(10)->create();
        // \App\Models\Transaction::factory(10)->create();
        // \App\Models\TransactionType::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
