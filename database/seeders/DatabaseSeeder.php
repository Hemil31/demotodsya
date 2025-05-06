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
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Test User',
            'email' => 'aveg@gmail.com',
            'role' => 2, // 1 for user, 2 for admin
            'status' => 1,
            'password' => bcrypt('Admin@123'), // password
        ]);
    }
}
