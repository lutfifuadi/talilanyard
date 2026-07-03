<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Check if admin user exists to avoid duplicates or issues when seeding multiple times
        if (!User::where('email', 'admin@cetaktalilanyard.com')->exists()) {
            User::factory()->create([
                'name' => 'Admin Cetak Lanyard',
                'email' => 'admin@cetaktalilanyard.com',
                'password' => bcrypt('admin123'),
            ]);
        }

        User::factory(10)->create();

        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);
    }
}
