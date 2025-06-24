<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Update semua user yang sudah ada menjadi admin
        User::whereNull('role')->orWhere('role', '')->update(['role' => 'admin']);
        
        // Buat user pegawai untuk testing
        $pegawaiUsers = [
            [
                'name' => 'Pegawai Satu',
                'username' => 'pegawai1',
                'password' => Hash::make('12345678'),
                'role' => 'pegawai'
            ],
            [
                'name' => 'Pegawai Dua',
                'username' => 'pegawai2',
                'password' => Hash::make('12345678'),
                'role' => 'pegawai'
            ],
            [
                'name' => 'Staff Apotek',
                'username' => 'staff',
                'password' => Hash::make('12345678'),
                'role' => 'pegawai'
            ]
        ];

        foreach ($pegawaiUsers as $userData) {
            // Cek apakah username sudah ada
            if (!User::where('username', $userData['username'])->exists()) {
                User::create($userData);
                $this->command->info('User pegawai ' . $userData['username'] . ' berhasil dibuat.');
            } else {
                $this->command->info('User ' . $userData['username'] . ' sudah ada, skip.');
            }
        }

        $this->command->info('Role seeder selesai dijalankan!');
        $this->command->info('Admin users: ' . User::where('role', 'admin')->count());
        $this->command->info('Pegawai users: ' . User::where('role', 'pegawai')->count());
    }
}
