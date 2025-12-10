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
        'status',
        'gambar', // Tambahkan gambar
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

    // Accessor untuk gambar
    public function getGambarUrlAttribute()
    {
        if ($this->gambar) {
            return asset('storage/' . $this->gambar);
        }
        return asset('images/no-image.png'); // Default image
    }
}
