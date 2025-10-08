<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create Admin User
        User::create([
            'name' => 'Admin User',
            'email' => 'admin@harvestglow.org',
            'password' => Hash::make('password'),
            'email_verified_at' => now(),
        ]);

        $this->command->info('User seeded successfully!');
        $this->command->info('Email: admin@harvestglow.org');
        $this->command->info('Password: password');
    }
}
