<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Add admin user as requested by the user
        User::factory()->create([
            'name' => 'Admin User',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('password'), // explicitly setting password as 'password'
        ]);

        // Call the individual seeders
        $this->call([
            CategorySeeder::class,
            BlogSeeder::class,
            EventSeeder::class,
            ServiceSeeder::class,
        ]);
    }
}
