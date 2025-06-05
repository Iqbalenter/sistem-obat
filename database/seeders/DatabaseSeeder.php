<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        // Create admin user
        User::factory()->create([
            'name' => 'Yuri',
            'username' => 'yuri',
            'password' => Hash::make('yuri123'),
        ]);
        
        // Seed data obat untuk testing
        $this->call([
            ObatSeeder::class,
        ]);
    }
}
