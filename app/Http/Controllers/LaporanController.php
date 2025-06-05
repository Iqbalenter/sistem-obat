<?php

namespace App\Http\Controllers;

use App\Models\Obat;
use App\Models\Kategori;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LaporanController extends Controller
{
    public function index(Request $request)
    {
        // Periode laporan (default bulan ini)
        $periode = $request->get('periode', 'bulan_ini');
        $tanggal_mulai = $request->get('tanggal_mulai');
        $tanggal_selesai = $request->get('tanggal_selesai');
        
        // Set tanggal berdasarkan periode
        switch ($periode) {
            case 'hari_ini':
                $start = Carbon::today();
                $end = Carbon::today();
                break;
            case 'minggu_ini':
                $start = Carbon::now()->startOfWeek();
                $end = Carbon::now()->endOfWeek();
                break;
            case 'bulan_ini':
                $start = Carbon::now()->startOfMonth();
                $end = Carbon::now()->endOfMonth();
                break;
            case 'tahun_ini':
                $start = Carbon::now()->startOfYear();
                $end = Carbon::now()->endOfYear();
                break;
            case 'custom':
                $start = $tanggal_mulai ? Carbon::parse($tanggal_mulai) : Carbon::now()->startOfMonth();
                $end = $tanggal_selesai ? Carbon::parse($tanggal_selesai) : Carbon::now()->endOfMonth();
                break;
            default:
                $start = Carbon::now()->startOfMonth();
                $end = Carbon::now()->endOfMonth();
        }
        
        // Statistik Umum
        $totalObat = Obat::count();
        $totalKategori = Kategori::count();
        $totalStok = Obat::sum('stok');
        $obatExpired = Obat::where('tanggal_expired', '<', Carbon::today())->count();
        $obatAkanExpired = Obat::where('tanggal_expired', '>=', Carbon::today())
                              ->where('tanggal_expired', '<=', Carbon::today()->addMonths(3))
                              ->count();
        $stokRendah = Obat::where('stok', '<=', 10)->count();
        
        // Laporan berdasarkan Kategori
        $laporanKategori = Kategori::withCount('obats')
                                  ->with(['obats' => function($query) {
                                      $query->select('kategori_id', DB::raw('SUM(stok) as total_stok'));
                                      $query->groupBy('kategori_id');
                                  }])
                                  ->get()
                                  ->map(function($kategori) {
                                      return [
                                          'nama_kategori' => $kategori->nama_kategori,
                                          'jumlah_obat' => $kategori->obats_count,
                                          'total_stok' => $kategori->obats->sum('stok') ?? 0
                                      ];
                                  });
        
        // Top 10 Obat dengan Stok Tertinggi
        $topStokTinggi = Obat::with('kategori')
                            ->orderBy('stok', 'desc')
                            ->limit(10)
                            ->get();
        
        // Top 10 Obat dengan Stok Terendah
        $topStokRendah = Obat::with('kategori')
                            ->where('stok', '>', 0)
                            ->orderBy('stok', 'asc')
                            ->limit(10)
                            ->get();
        
        // Obat yang akan expired dalam 90 hari
        $obatAkanExpiredSoon = Obat::with('kategori')
                                  ->where('tanggal_expired', '>=', Carbon::today())
                                  ->where('tanggal_expired', '<=', Carbon::today()->addDays(90))
                                  ->orderBy('tanggal_expired', 'asc')
                                  ->get();
        
        // Obat yang sudah expired
        $obatSudahExpired = Obat::with('kategori')
                               ->where('tanggal_expired', '<', Carbon::today())
                               ->orderBy('tanggal_expired', 'desc')
                               ->limit(10)
                               ->get();
        
        // Data untuk Chart Kategori (untuk Chart.js)
        $chartKategori = [
            'labels' => $laporanKategori->pluck('nama_kategori')->toArray(),
            'jumlah_obat' => $laporanKategori->pluck('jumlah_obat')->toArray(),
            'total_stok' => $laporanKategori->pluck('total_stok')->toArray()
        ];
        
        // Data obat berdasarkan bulan masuk (6 bulan terakhir)
        $chartBulanan = [];
        for ($i = 5; $i >= 0; $i--) {
            $month = Carbon::now()->subMonths($i);
            $count = Obat::whereYear('tanggal_masuk', $month->year)
                         ->whereMonth('tanggal_masuk', $month->month)
                         ->count();
            $chartBulanan['labels'][] = $month->format('M Y');
            $chartBulanan['data'][] = $count;
        }
        
        return view('laporan', compact(
            'totalObat',
            'totalKategori', 
            'totalStok',
            'obatExpired',
            'obatAkanExpired',
            'stokRendah',
            'laporanKategori',
            'topStokTinggi',
            'topStokRendah',
            'obatAkanExpiredSoon',
            'obatSudahExpired',
            'chartKategori',
            'chartBulanan',
            'periode',
            'tanggal_mulai',
            'tanggal_selesai'
        ));
    }
} 