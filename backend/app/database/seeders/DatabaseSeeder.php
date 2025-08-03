<?php

namespace Database\Seeders;

use App\Enums\AppUserRole;
use App\Models\AppUser;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        AppUser::firstOrCreate(['email' => 'main@grr.la'], [
            'name' => 'Admin',
            'email' => 'main@grr.la',
            'password' => 'main@grr.la',
            'role' => AppUserRole::Admin,
        ]);

        AppUser::firstOrCreate(['email' => 'user@grr.la'], [
            'name' => 'John Doe',
            'email' => 'user@grr.la',
            'password' => 'user@grr.la',
            'role' => AppUserRole::User,
        ]);
    }
}
