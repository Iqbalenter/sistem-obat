<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PemindahanObat extends Model
{
    protected $table = 'pemindahan_obats';

    protected $fillable = [
        'obat_id',
        'jenis', // pemusnahan / pengembalian
        'jumlah',
        'alasan',
        'tanggal',
        'supplier_id', // untuk pengembalian
        'diproses_oleh',
    ];

    protected $casts = [
        'tanggal' => 'date',
    ];

    public function obat()
    {
        return $this->belongsTo(Obat::class);
    }

    public function supplier()
    {
        return $this->belongsTo(Supplier::class);
    }
}
