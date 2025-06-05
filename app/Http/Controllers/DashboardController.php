<?php

namespace App\Http\Controllers;

use App\Models\Obat;
use App\Models\Kategori;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        // Statistik Utama
        $totalObat = Obat::count();
        $totalKategori = Kategori::count();
        $totalStok = Obat::sum('stok');
        
        // Alert Statistics
        $obatExpired = Obat::where('tanggal_expired', '<', Carbon::today())->count();
        $obatAkanExpired = Obat::where('tanggal_expired', '>=', Carbon::today())
                              ->where('tanggal_expired', '<=', Carbon::today()->addDays(90))
                              ->count();
        $stokRendah = Obat::where('stok', '<=', 10)->count();
        $stokKosong = Obat::where('stok', '=', 0)->count();
        
        // Obat Terbaru (5 terakhir)
        $obatTerbaru = Obat::with('kategori')
                          ->latest('created_at')
                          ->limit(5)
                          ->get();
        
        // Obat yang perlu perhatian (expired dalam 7 hari atau stok rendah)
        $obatPerluPerhatian = Obat::with('kategori')
                                 ->where(function($query) {
                                     $query->where('tanggal_expired', '>=', Carbon::today())
                                           ->where('tanggal_expired', '<=', Carbon::today()->addDays(7))
                                           ->orWhere('stok', '<=', 5);
                                 })
                                 ->orderBy('tanggal_expired', 'asc')
                                 ->limit(8)
                                 ->get();
        
        // Kategori dengan jumlah obat terbanyak
        $topKategori = Kategori::withCount('obats')
                              ->orderBy('obats_count', 'desc')
                              ->limit(5)
                              ->get();
        

        
        // Aktivitas terbaru (bisa ditambahkan log system nantinya)
        $aktivitasTerbaru = [
            [
                'action' => 'Obat baru ditambahkan',
                'details' => $obatTerbaru->first()->nama_obat ?? 'Tidak ada data',
                'time' => $obatTerbaru->first()->created_at ?? Carbon::now(),
                'type' => 'create',
                'icon' => 'plus'
            ],
            [
                'action' => 'Peringatan stok rendah',
                'details' => $stokRendah . ' obat memiliki stok rendah',
                'time' => Carbon::now(),
                'type' => 'warning',
                'icon' => 'exclamation'
            ],
            [
                'action' => 'Peringatan expired',
                'details' => $obatAkanExpired . ' obat akan expired dalam 30 hari',
                'time' => Carbon::now(),
                'type' => 'danger',
                'icon' => 'clock'
            ]
        ];
        
        // Progress stok berdasarkan kategori
        $stokPerKategori = Kategori::select('nama_kategori')
                                  ->withSum('obats', 'stok')
                                  ->having('obats_sum_stok', '>', 0)
                                  ->orderBy('obats_sum_stok', 'desc')
                                  ->limit(6)
                                  ->get();
        
        return view('index', compact(
            'totalObat',
            'totalKategori',
            'totalStok',
            'obatExpired',
            'obatAkanExpired',
            'stokRendah',
            'stokKosong',
            'obatTerbaru',
            'obatPerluPerhatian',
            'topKategori',
            'aktivitasTerbaru',
            'stokPerKategori'
        ));
    }
} 