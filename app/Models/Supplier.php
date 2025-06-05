<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    protected $table = 'suppliers';
    
    protected $fillable = [
        'nama_supplier',
        'no_telepon',
        'alamat'
    ];
    
    // Relasi jika nanti ada obat yang memiliki supplier
    public function obats()
    {
        return $this->hasMany(Obat::class, 'supplier_id');
    }
}
