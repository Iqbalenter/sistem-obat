<?php

namespace Database\Seeders;

use App\Models\Kategori;
use App\Models\Obat;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;

class ObatSeeder extends Seeder
{
    /**
     * Jalankan seeder untuk tabel obats.
     */
    public function run(): void
    {
        $kelompok = [
            'Obat Batuk' => [
                'EPEXOL DROPS',
                'SISTENOL 10 KAPLET',
                'OBH COMBI ANAK',
                'BISOLVON KIDS STRAWBERRY',
                'ERDOSTEIN',
                'LIMOXIN DROP',
                'SILADEX MUKOLITIK',
                'MUCOPECT',
                'LASERIN SIRUP',
                'AMBROXOL',
            ],
            'Obat Mata' => [
                'Cendo Lyteers',
                'Insto Regular / Insto Dry Eyes',
                'Rohto Cool / Rohto Redness',
                'Allergan Optive',
                'Tobrex (Tobramycin)',
                'Garasone Eye Drop',
                'Zylet / Tobradex',
                'Moxifloxacin (Vigamox)',
                'Moxifloxacin Eye Drops',
                'Cendo Xitrol',
            ],
            'Obat Maag' => [
                'PROMAG',
                'POLYSILANE',
                'COLIDAN',
                'MYLANTA',
                'FAMOCID',
                'ANTASIDA DOEN',
                'LAMBUCID',
                'POLYCROL',
                'SANMAG',
                'HUFAMAG',
            ],
            'Obat Sakit Kepala' => [
                'Paracetamol',
                'Oskadon',
                'Paramex',
                'Saridon Extra',
                'Bodrex Extra',
                'Mefenamic Acid',
                'Panadol',
                'Sumagesic',
                'Proris Ibuprofen',
                'Poldan Mig',
            ],
            'Obat Asma' => [
                'Ataroc Sirup 60 Ml',
                'Ventolin Inhaler 100 Mcg 200 dosis',
                'Astharol 2 mg 10 tablet',
                'Astharol 2 mg Sirup 60 ml',
                'Ataroc 25 Mg 10 tablet',
                'Aminophylline Coronet 200 mg 100 Tablet',
                'Ventolin Nebules 5 Ampul',
                'Astherin 2,5 mg 10 Kaplet',
                'Berodual Inhaler 200 dosis 100 ml',
                'Berotec Inhaler 100 Mcg 10 ml',
            ],
        ];

        $today = Carbon::today();

        foreach ($kelompok as $namaKategori => $daftarObat) {
            $kategori = Kategori::firstOrCreate(['nama_kategori' => $namaKategori]);

            foreach ($daftarObat as $namaObat) {
                Obat::updateOrCreate(
                    ['nama_obat' => $namaObat],
                    [
                        'nama_obat' => $namaObat,
                        'kategori_id' => $kategori->id,
                        'supplier_id' => null,
                        'tanggal_masuk' => $today,
                        'tanggal_expired' => $today->copy()->addYear(),
                        'stok' => 100,
                        // Status default mengikuti enum terbaru: dipertahankan/dimusnahkan/dikembalikan
                        'status' => 'dipertahankan',
                        'gambar' => null,
                    ]
                );
            }
        }
    }
}

