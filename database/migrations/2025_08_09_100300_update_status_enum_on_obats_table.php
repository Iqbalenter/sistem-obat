<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        // 1) Perluas enum agar menampung nilai lama & baru
        DB::statement("ALTER TABLE obats MODIFY status ENUM('aktif','pemusnahan','pengembalian','dipertahankan','dimusnahkan','dikembalikan') NOT NULL DEFAULT 'dipertahankan'");

        // 2) Migrasikan data lama ke nilai baru
        DB::statement("UPDATE obats SET status = 'dipertahankan' WHERE status = 'aktif'");
        DB::statement("UPDATE obats SET status = 'dimusnahkan' WHERE status = 'pemusnahan'");
        DB::statement("UPDATE obats SET status = 'dikembalikan' WHERE status = 'pengembalian'");

        // 3) Restriksi enum hanya ke nilai baru
        DB::statement("ALTER TABLE obats MODIFY status ENUM('dipertahankan','dimusnahkan','dikembalikan') NOT NULL DEFAULT 'dipertahankan'");
    }

    public function down(): void
    {
        // 1) Perluas enum agar menampung nilai lama & baru (kembali)
        DB::statement("ALTER TABLE obats MODIFY status ENUM('aktif','pemusnahan','pengembalian','dipertahankan','dimusnahkan','dikembalikan') NOT NULL DEFAULT 'aktif'");

        // 2) Migrasikan data baru ke nilai lama
        DB::statement("UPDATE obats SET status = 'aktif' WHERE status = 'dipertahankan'");
        DB::statement("UPDATE obats SET status = 'pemusnahan' WHERE status = 'dimusnahkan'");
        DB::statement("UPDATE obats SET status = 'pengembalian' WHERE status = 'dikembalikan'");

        // 3) Restriksi enum hanya ke nilai lama
        DB::statement("ALTER TABLE obats MODIFY status ENUM('aktif','pemusnahan','pengembalian') NOT NULL DEFAULT 'aktif'");
    }
};
