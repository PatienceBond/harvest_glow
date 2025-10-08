<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Seed users
        $this->call([
            UserSeeder::class,
        ]);

        // Optionally seed other data
        // Uncomment to seed sample data
        // $this->call([
        //     HarvestGlowSeeder::class,
        // ]);
    }
}
