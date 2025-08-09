<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('pemindahan_obats', function (Blueprint $table) {
            // Ubah kolom menjadi nullable terlebih dahulu
            $table->unsignedBigInteger('obat_id')->nullable()->change();
        });

        // Drop constraint lama dan buat ulang dengan ON DELETE SET NULL
        Schema::table('pemindahan_obats', function (Blueprint $table) {
            $table->dropForeign(['obat_id']);
            $table->foreign('obat_id')->references('id')->on('obats')->nullOnDelete();
        });
    }

    public function down(): void
    {
        Schema::table('pemindahan_obats', function (Blueprint $table) {
            // Kembalikan ke cascade on delete dan not nullable
            $table->dropForeign(['obat_id']);
            $table->unsignedBigInteger('obat_id')->nullable(false)->change();
            $table->foreign('obat_id')->references('id')->on('obats')->cascadeOnDelete();
        });
    }
};
