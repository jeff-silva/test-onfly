<?php

namespace Database\Seeders;

use App\Enums\UserRole;
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

        // User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        User::firstOrCreate(['email' => 'main@grr.la'], [
            'name' => 'Admin',
            'email' => 'main@grr.la',
            'password' => 'main@grr.la',
            'role' => UserRole::Admin,
        ]);

        User::firstOrCreate(['email' => 'user@grr.la'], [
            'name' => 'John Doe',
            'email' => 'user@grr.la',
            'password' => 'user@grr.la',
            'role' => UserRole::User,
        ]);
    }
}
