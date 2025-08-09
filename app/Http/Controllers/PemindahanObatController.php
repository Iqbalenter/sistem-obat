<?php

namespace App\Http\Controllers;

use App\Models\Obat;
use App\Models\Supplier;
use App\Models\PemindahanObat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PemindahanObatController extends Controller
{
    public function index()
    {
        $pemusnahan = PemindahanObat::with(['obat.kategori','supplier'])
            ->where('jenis', 'pemusnahan')
            ->latest()->paginate(10, ['*'], 'pemusnahan_page');
        $pengembalian = PemindahanObat::with(['obat.kategori','supplier'])
            ->where('jenis', 'pengembalian')
            ->latest()->paginate(10, ['*'], 'pengembalian_page');
        // Daftar obat yang sudah kadaluarsa (expired)
        $expiredObats = Obat::with(['kategori','supplier'])
            ->whereDate('tanggal_expired', '<', now()->toDateString())
            ->whereNotIn('status', ['dimusnahkan','dikembalikan'])
            ->orderBy('tanggal_expired', 'asc')
            ->paginate(10, ['*'], 'expired_page');

        return view('pemindahan.index', compact('pemusnahan', 'pengembalian', 'expiredObats'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'obat_id' => 'required|exists:obats,id',
            'jenis' => 'required|in:pemusnahan,pengembalian',
            'jumlah' => 'required|integer|min:1',
            'alasan' => 'nullable|string|max:255',
            'tanggal' => 'required|date',
            'supplier_id' => 'nullable|exists:suppliers,id'
        ]);

        $obat = Obat::findOrFail($request->obat_id);

        if ($request->jumlah > $obat->stok) {
            return back()->withErrors(['jumlah' => 'Jumlah melebihi stok tersedia.'])->withInput();
        }

        DB::transaction(function() use ($request, $obat) {
            // Hitung stok sisa sebelum update
            $sisa = $obat->stok - $request->jumlah;

            PemindahanObat::create([
                'obat_id' => $obat->id,
                'obat_nama' => $obat->nama_obat,
                'kategori_nama' => optional($obat->kategori)->nama_kategori,
                'jenis' => $request->jenis,
                'jumlah' => $request->jumlah,
                'alasan' => $request->alasan,
                'tanggal' => $request->tanggal,
                'supplier_id' => $request->jenis === 'pengembalian' ? ($request->supplier_id ?? $obat->supplier_id) : null,
                'diproses_oleh' => Auth::id(),
            ]);

            // Jika semua stok dipindahkan, hapus obat dari daftar
            if ($sisa <= 0) {
                $obat->delete();
            } else {
                // Update stok dan pertahankan status
                $obat->stok = $sisa;
                if (!in_array($obat->status, ['dimusnahkan','dikembalikan'])) {
                    $obat->status = 'dipertahankan';
                }
                // Simpan supplier asal jika pengembalian dan belum ada
                if ($request->jenis === 'pengembalian' && !$obat->supplier_id && $request->supplier_id) {
                    $obat->supplier_id = $request->supplier_id;
                }
                $obat->save();
            }
        });

        return back()->with('success', 'Data pemindahan berhasil disimpan.');
    }
}
