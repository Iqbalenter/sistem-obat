<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('pemindahan_obats', function (Blueprint $table) {
            $table->string('obat_nama')->nullable()->after('obat_id');
            $table->string('kategori_nama')->nullable()->after('obat_nama');
        });

        // Backfill snapshot dari data yang masih ada
        DB::statement(
            "UPDATE pemindahan_obats po
             LEFT JOIN obats o ON po.obat_id = o.id
             LEFT JOIN kategoris k ON o.kategori_id = k.id
             SET po.obat_nama = COALESCE(po.obat_nama, o.nama_obat),
                 po.kategori_nama = COALESCE(po.kategori_nama, k.nama_kategori)"
        );
    }

    public function down(): void
    {
        Schema::table('pemindahan_obats', function (Blueprint $table) {
            $table->dropColumn(['obat_nama','kategori_nama']);
        });
    }
};
