<?php

namespace App\Http\Controllers;

use App\Models\Obat;
use App\Models\Kategori;
use App\Models\PemindahanObat;
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
        
        // Status Obat sebagai total unit (bukan jumlah item)
        $statusDipertahankan = Obat::where('status', 'dipertahankan')->sum('stok');
        $statusDimusnahkan   = PemindahanObat::where('jenis', 'pemusnahan')->sum('jumlah');
        $statusDikembalikan  = PemindahanObat::where('jenis', 'pengembalian')->sum('jumlah');
        
        // Alert Statistics (hanya untuk status dipertahankan)
        $obatExpired = Obat::where('status', 'dipertahankan')
                            ->where('tanggal_expired', '<', Carbon::today())
                            ->count();
        $obatAkanExpired = Obat::where('status', 'dipertahankan')
                              ->where('tanggal_expired', '>=', Carbon::today())
                              ->where('tanggal_expired', '<=', Carbon::today()->addDays(90))
                              ->count();
        $stokRendah = Obat::where('stok', '<=', 10)->count();
        $stokKosong = Obat::where('stok', '=', 0)->count();
        
        // Obat Terbaru (5 terakhir)
        $obatTerbaru = Obat::with(['kategori','supplier'])
                          ->latest('created_at')
                          ->limit(5)
                          ->get();
        
        // Obat yang perlu perhatian (expired dalam 7 hari atau stok rendah) - hanya dipertahankan
        $obatPerluPerhatian = Obat::with('kategori')
                                 ->where('status', 'dipertahankan')
                                 ->where(function($query) {
                                     $query->whereBetween('tanggal_expired', [Carbon::today(), Carbon::today()->addDays(7)])
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
        
        // Aktivitas terbaru dari pemindahan obat
        $logPemindahan = PemindahanObat::with(['obat'])
                            ->latest()
                            ->limit(5)
                            ->get()
                            ->map(function($row){
                                $namaObat = $row->obat?->nama_obat ?? $row->obat_nama ?? 'Obat (terhapus)';
                                return [
                                    'action' => $row->jenis === 'pemusnahan' ? 'Obat dimusnahkan' : 'Obat dikembalikan',
                                    'details' => $namaObat.' - '.$row->jumlah.' unit',
                                    'time' => $row->created_at,
                                    'type' => $row->jenis === 'pemusnahan' ? 'danger' : 'info',
                                    'icon' => $row->jenis === 'pemusnahan' ? 'exclamation' : 'clock'
                                ];
                            });
        
        // Aktivitas placeholder lama
        $aktivitasTerbaru = [
            [
                'action' => 'Obat baru ditambahkan',
                'details' => $obatTerbaru->first()->nama_obat ?? 'Tidak ada data',
                'time' => $obatTerbaru->first()->created_at ?? Carbon::now(),
                'type' => 'create',
                'icon' => 'plus'
            ],
        ];
        // Gabungkan log pemindahan + placeholder
        $aktivitasTerbaru = array_merge($logPemindahan->toArray(), $aktivitasTerbaru);
        
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
            'stokPerKategori',
            // status sebagai unit
            'statusDipertahankan',
            'statusDimusnahkan',
            'statusDikembalikan'
        ));
    }
}