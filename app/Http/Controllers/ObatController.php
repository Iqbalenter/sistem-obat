<?php

namespace App\Http\Controllers;

use App\Models\Obat;
use App\Models\Kategori;
use App\Models\Supplier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ObatController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->query('search');

        $query = Obat::with(['kategori','supplier'])->latest();

        if (!empty($search)) {
            $query->where('nama_obat', 'like', '%' . $search . '%');
        }

        $obats = $query->paginate(10)->withQueryString();
        $kategoris = Kategori::all();
        $suppliers = Supplier::all();
        return view('obat', compact('obats', 'kategoris', 'suppliers', 'search'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $kategoris = Kategori::all();
        $suppliers = Supplier::all();
        return view('obat.create', compact('kategoris','suppliers'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama_obat' => 'required|string|max:255',
            'tanggal_masuk' => 'required|date',
            'kategori_id' => 'required|exists:kategoris,id',
            'supplier_id' => 'nullable|exists:suppliers,id',
            'tanggal_expired' => 'required|date|after:tanggal_masuk',
            'stok' => 'required|integer|min:0',
            'gambar' => 'nullable|image|mimes:jpeg,jpg,png,gif,webp|max:2048' // Validasi gambar
        ], [
            'nama_obat.required' => 'Nama obat wajib diisi',
            'nama_obat.max' => 'Nama obat maksimal 255 karakter',
            'tanggal_masuk.required' => 'Tanggal masuk wajib diisi',
            'tanggal_masuk.date' => 'Format tanggal masuk tidak valid',
            'kategori_id.required' => 'Kategori wajib dipilih',
            'kategori_id.exists' => 'Kategori yang dipilih tidak valid',
            'supplier_id.exists' => 'Supplier yang dipilih tidak valid',
            'tanggal_expired.required' => 'Tanggal expired wajib diisi',
            'tanggal_expired.date' => 'Format tanggal expired tidak valid',
            'tanggal_expired.after' => 'Tanggal expired harus setelah tanggal masuk',
            'stok.required' => 'Stok wajib diisi',
            'stok.integer' => 'Stok harus berupa angka',
            'stok.min' => 'Stok tidak boleh kurang dari 0',
            'gambar.image' => 'File harus berupa gambar',
            'gambar.mimes' => 'Gambar harus berformat: jpeg, jpg, png, gif, atau webp',
            'gambar.max' => 'Ukuran gambar maksimal 2MB'
        ]);

        // Handle upload gambar
        $gambarPath = null;
        if ($request->hasFile('gambar')) {
            $gambar = $request->file('gambar');
            $fileName = time() . '_' . uniqid() . '.' . $gambar->getClientOriginalExtension();
            $gambarPath = $gambar->storeAs('obat', $fileName, 'public');
        }

        Obat::create([
            'nama_obat' => $request->nama_obat,
            'tanggal_masuk' => $request->tanggal_masuk,
            'kategori_id' => $request->kategori_id,
            'supplier_id' => $request->supplier_id,
            'tanggal_expired' => $request->tanggal_expired,
            'stok' => $request->stok,
            'status' => 'dipertahankan',
            'gambar' => $gambarPath,
        ]);

        return redirect()->route('obat.index')->with('success', 'Obat berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $obat = Obat::with(['kategori','supplier'])->findOrFail($id);
        return view('obat.show', compact('obat'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $obat = Obat::findOrFail($id);
        $kategoris = Kategori::all();
        $suppliers = Supplier::all();
        return view('obat.edit', compact('obat', 'kategoris','suppliers'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $obat = Obat::findOrFail($id);
        
        $request->validate([
            'nama_obat' => 'required|string|max:255',
            'tanggal_masuk' => 'required|date',
            'kategori_id' => 'required|exists:kategoris,id',
            'supplier_id' => 'nullable|exists:suppliers,id',
            'tanggal_expired' => 'required|date|after:tanggal_masuk',
            'stok' => 'required|integer|min:0',
            'gambar' => 'nullable|image|mimes:jpeg,jpg,png,gif,webp|max:2048'
        ], [
            'nama_obat.required' => 'Nama obat wajib diisi',
            'nama_obat.max' => 'Nama obat maksimal 255 karakter',
            'tanggal_masuk.required' => 'Tanggal masuk wajib diisi',
            'tanggal_masuk.date' => 'Format tanggal masuk tidak valid',
            'kategori_id.required' => 'Kategori wajib dipilih',
            'kategori_id.exists' => 'Kategori yang dipilih tidak valid',
            'supplier_id.exists' => 'Supplier yang dipilih tidak valid',
            'tanggal_expired.required' => 'Tanggal expired wajib diisi',
            'tanggal_expired.date' => 'Format tanggal expired tidak valid',
            'tanggal_expired.after' => 'Tanggal expired harus setelah tanggal masuk',
            'stok.required' => 'Stok wajib diisi',
            'stok.integer' => 'Stok harus berupa angka',
            'stok.min' => 'Stok tidak boleh kurang dari 0',
            'gambar.image' => 'File harus berupa gambar',
            'gambar.mimes' => 'Gambar harus berformat: jpeg, jpg, png, gif, atau webp',
            'gambar.max' => 'Ukuran gambar maksimal 2MB'
        ]);

        // Handle upload gambar baru
        $gambarPath = $obat->gambar; // Tetap gunakan gambar lama
        if ($request->hasFile('gambar')) {
            // Hapus gambar lama jika ada
            if ($obat->gambar && Storage::disk('public')->exists($obat->gambar)) {
                Storage::disk('public')->delete($obat->gambar);
            }
            
            // Upload gambar baru
            $gambar = $request->file('gambar');
            $fileName = time() . '_' . uniqid() . '.' . $gambar->getClientOriginalExtension();
            $gambarPath = $gambar->storeAs('obat', $fileName, 'public');
        }

        $obat->update([
            'nama_obat' => $request->nama_obat,
            'tanggal_masuk' => $request->tanggal_masuk,
            'kategori_id' => $request->kategori_id,
            'supplier_id' => $request->supplier_id,
            'tanggal_expired' => $request->tanggal_expired,
            'stok' => $request->stok,
            'gambar' => $gambarPath,
        ]);

        // Jaga status tetap valid jika belum dipindahkan semua
        if ($obat->stok > 0 && !in_array($obat->status, ['dimusnahkan','dikembalikan'])) {
            $obat->status = 'dipertahankan';
            $obat->save();
        }

        return redirect()->route('obat.index')->with('success', 'Obat berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $obat = Obat::findOrFail($id);
        
        // Hapus gambar jika ada
        if ($obat->gambar && Storage::disk('public')->exists($obat->gambar)) {
            Storage::disk('public')->delete($obat->gambar);
        }
        
        $obat->delete();

        return redirect()->route('obat.index')->with('success', 'Obat berhasil dihapus!');
    }
}
