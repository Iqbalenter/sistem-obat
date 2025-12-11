<?php

namespace Database\Seeders;

use App\Models\Supplier;
use Illuminate\Database\Seeder;

class SupplierSeeder extends Seeder
{
    /**
     * Jalankan seeder untuk tabel suppliers.
     */
    public function run(): void
    {
        $suppliers = [
            [
                'nama_supplier' => 'PT. Enseval Putera Megatrading Tbk.',
                'no_telepon'    => '(021) 4682 2323',
                'alamat'        => 'Jl. Rawa Gelam V Blok C No. 2, Kawasan Industri Pulogadung, Jakarta Timur 13930',
            ],
            [
                'nama_supplier' => 'PT. Kimia Farma Trading & Distribution (KFTD)',
                'no_telepon'    => '(021) 3844 713',
                'alamat'        => 'Jl. Budi Utomo No. 1, Jakarta Pusat 10710',
            ],
            [
                'nama_supplier' => 'PT. Anugrah Argon Medica (AAM)',
                'no_telepon'    => '(021) 526 2333',
                'alamat'        => 'Jl. Jend. Gatot Subroto Kav. 35 - 36, Jakarta Selatan',
            ],
            [
                'nama_supplier' => 'PT. Penta Valent',
                'no_telepon'    => '(021) 8770 1718',
                'alamat'        => 'Jl. Raya Ciracas No. 39, Kelapa Dua Wetan, Ciracas, Jakarta Timur 13740',
            ],
            [
                'nama_supplier' => 'PT. Mensa Bina Sukses',
                'no_telepon'    => '(021) 823 0088',
                'alamat'        => 'Jl. Raya Narogong Km. 10.8 No. 228, Bantar Gebang, Bekasi 17151',
            ],
        ];

        foreach ($suppliers as $supplier) {
            Supplier::updateOrCreate(
                ['nama_supplier' => $supplier['nama_supplier']],
                $supplier
            );
        }
    }
}

