<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Database\Seeders\SupplierSeeder;
use Database\Seeders\RoleSeeder;
use Database\Seeders\KategoriSeeder;
use Database\Seeders\ObatSeeder;

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
            'name' => 'Iqbal',
            'username' => 'Iqbal',
            'password' => Hash::make('iqbal123'),
        ]);
        
        $this->call(RoleSeeder::class);
        $this->call(SupplierSeeder::class);
        $this->call(KategoriSeeder::class);
        $this->call(ObatSeeder::class);
    }
}
