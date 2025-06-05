<?php

namespace App\Http\Controllers;

use App\Models\Obat;
use App\Models\Kategori;
use Illuminate\Http\Request;

class PersediaanController extends Controller
{
    public function index(Request $request)
    {
        // Ambil parameter search
        $search = $request->get('search');
        $kategori_filter = $request->get('kategori');
        $stok_filter = $request->get('stok');
        
        // Query dasar dengan relasi kategori
        $query = Obat::with('kategori');
        
        // Filter berdasarkan search (nama obat)
        if (!empty($search)) {
            $query->where('nama_obat', 'like', '%' . $search . '%');
        }
        
        // Filter berdasarkan kategori
        if (!empty($kategori_filter)) {
            $query->where('kategori_id', $kategori_filter);
        }
        
        // Filter berdasarkan stok
        if (!empty($stok_filter)) {
            switch ($stok_filter) {
                case 'low':
                    $query->where('stok', '<=', 10);
                    break;
                case 'medium':
                    $query->whereBetween('stok', [11, 50]);
                    break;
                case 'high':
                    $query->where('stok', '>', 50);
                    break;
            }
        }
        
        // Urutkan berdasarkan nama obat dan paginasi
        $obats = $query->orderBy('nama_obat', 'asc')->paginate(10);
        
        // Ambil semua kategori untuk filter dropdown
        $kategoris = Kategori::orderBy('nama_kategori', 'asc')->get();
        
        // Statistik
        $totalObats = Obat::count();
        $totalStokRendah = Obat::where('stok', '<=', 10)->count();
        $totalKategori = Kategori::count();
        $totalStokSemua = Obat::sum('stok');
        
        return view('persediaan', compact(
            'obats', 
            'kategoris', 
            'search', 
            'kategori_filter', 
            'stok_filter',
            'totalObats',
            'totalStokRendah',
            'totalKategori',
            'totalStokSemua'
        ));
    }
} 