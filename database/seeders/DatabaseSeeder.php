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
        $this->call([
            RolesAndPermissionsSeeder::class, // Prvo kreiraj dozvole i uloge
            RolesSeeder::class,              // Zatim dodeli role korisnicima
        ]);

        User::factory()->create([
            'name' => 'Admin User',
            'email' => 'admin@example.com',
            'password' => 'admin'
        ]);
        User::factory()->create([
            'name' => 'Regular User',
            'email' => 'regular@example.com',
            'password' => 'regular'
        ]);
    }
}
