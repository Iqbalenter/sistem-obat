<?php

namespace Database\Seeders;

use App\Models\Kategori;
use Illuminate\Database\Seeder;

class KategoriSeeder extends Seeder
{
    /**
     * Jalankan seeder untuk tabel kategoris.
     */
    public function run(): void
    {
        $items = [
            'Obat Batuk',
            'Obat Mata',
            'Obat Maag',
            'Obat Sakit Kepala',
            'Obat Asma',
        ];

        foreach ($items as $nama) {
            Kategori::updateOrCreate(
                ['nama_kategori' => $nama],
                ['nama_kategori' => $nama]
            );
        }
    }
}

