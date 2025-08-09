<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Obat extends Model
{
    protected $table = 'obats';
    
    protected $fillable = [
        'nama_obat',
        'tanggal_masuk',
        'kategori_id',
        'tanggal_expired',
        'stok',
        'supplier_id',
        'status', // Tambahkan status
    ];

    protected $casts = [
        'tanggal_masuk' => 'date',
        'tanggal_expired' => 'date',
    ];
    
    // Relasi dengan tabel kategori
    public function kategori()
    {
        return $this->belongsTo(Kategori::class, 'kategori_id');
    }

    // Relasi dengan tabel supplier
    public function supplier()
    {
        return $this->belongsTo(Supplier::class, 'supplier_id');
    }
}
