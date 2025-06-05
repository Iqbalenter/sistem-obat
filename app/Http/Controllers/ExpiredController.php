<?php

namespace App\Http\Controllers;

use App\Models\Obat;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ExpiredController extends Controller
{
    public function index()
    {
        $today = Carbon::today();
        $threeMonthsFromNow = Carbon::today()->addMonths(3);
        
        // Obat yang sudah expired
        $expiredObats = Obat::with('kategori')
            ->where('tanggal_expired', '<', $today)
            ->orderBy('tanggal_expired', 'asc')
            ->get();
        
        // Obat yang akan expired dalam 3 bulan
        $willExpireObats = Obat::with('kategori')
            ->where('tanggal_expired', '>=', $today)
            ->where('tanggal_expired', '<=', $threeMonthsFromNow)
            ->orderBy('tanggal_expired', 'asc')
            ->get();
        
        // Gabungkan kedua koleksi dan tambahkan status
        $expiredObats->map(function($obat) {
            $obat->status = 'Telah Expired';
            $obat->status_class = 'bg-red-100 text-red-800 border-red-300';
            return $obat;
        });
        
        $willExpireObats->map(function($obat) {
            $obat->status = 'Akan Expired';
            $obat->status_class = 'bg-yellow-100 text-yellow-800 border-yellow-300';
            return $obat;
        });
        
        // Gabungkan dan urutkan berdasarkan tanggal expired
        $allObats = $expiredObats->concat($willExpireObats)->sortBy('tanggal_expired');
        
        // Statistik
        $totalExpired = $expiredObats->count();
        $totalWillExpire = $willExpireObats->count();
        $totalObats = $allObats->count();
        
        return view('expired', compact('allObats', 'totalExpired', 'totalWillExpire', 'totalObats'));
    }
} 