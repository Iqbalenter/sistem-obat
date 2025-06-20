<?php

namespace App\Http\Controllers;

use App\Models\Obat;
use App\Models\Kategori;
use Illuminate\Http\Request;

class ObatController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $obats = Obat::with('kategori')->latest()->paginate(10);
        $kategoris = Kategori::all();
        return view('obat', compact('obats', 'kategoris'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $kategoris = Kategori::all();
        return view('obat.create', compact('kategoris'));
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
            'tanggal_expired' => 'required|date|after:tanggal_masuk',
            'stok' => 'required|integer|min:0'
        ], [
            'nama_obat.required' => 'Nama obat wajib diisi',
            'nama_obat.max' => 'Nama obat maksimal 255 karakter',
            'tanggal_masuk.required' => 'Tanggal masuk wajib diisi',
            'tanggal_masuk.date' => 'Format tanggal masuk tidak valid',
            'kategori_id.required' => 'Kategori wajib dipilih',
            'kategori_id.exists' => 'Kategori yang dipilih tidak valid',
            'tanggal_expired.required' => 'Tanggal expired wajib diisi',
            'tanggal_expired.date' => 'Format tanggal expired tidak valid',
            'tanggal_expired.after' => 'Tanggal expired harus setelah tanggal masuk',
            'stok.required' => 'Stok wajib diisi',
            'stok.integer' => 'Stok harus berupa angka',
            'stok.min' => 'Stok tidak boleh kurang dari 0'
        ]);

        Obat::create([
            'nama_obat' => $request->nama_obat,
            'tanggal_masuk' => $request->tanggal_masuk,
            'kategori_id' => $request->kategori_id,
            'tanggal_expired' => $request->tanggal_expired,
            'stok' => $request->stok
        ]);

        return redirect()->route('obat.index')->with('success', 'Obat berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $obat = Obat::with('kategori')->findOrFail($id);
        return view('obat.show', compact('obat'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $obat = Obat::findOrFail($id);
        $kategoris = Kategori::all();
        return view('obat.edit', compact('obat', 'kategoris'));
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
            'tanggal_expired' => 'required|date|after:tanggal_masuk',
            'stok' => 'required|integer|min:0'
        ], [
            'nama_obat.required' => 'Nama obat wajib diisi',
            'nama_obat.max' => 'Nama obat maksimal 255 karakter',
            'tanggal_masuk.required' => 'Tanggal masuk wajib diisi',
            'tanggal_masuk.date' => 'Format tanggal masuk tidak valid',
            'kategori_id.required' => 'Kategori wajib dipilih',
            'kategori_id.exists' => 'Kategori yang dipilih tidak valid',
            'tanggal_expired.required' => 'Tanggal expired wajib diisi',
            'tanggal_expired.date' => 'Format tanggal expired tidak valid',
            'tanggal_expired.after' => 'Tanggal expired harus setelah tanggal masuk',
            'stok.required' => 'Stok wajib diisi',
            'stok.integer' => 'Stok harus berupa angka',
            'stok.min' => 'Stok tidak boleh kurang dari 0'
        ]);

        $obat->update([
            'nama_obat' => $request->nama_obat,
            'tanggal_masuk' => $request->tanggal_masuk,
            'kategori_id' => $request->kategori_id,
            'tanggal_expired' => $request->tanggal_expired,
            'stok' => $request->stok
        ]);

        return redirect()->route('obat.index')->with('success', 'Obat berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $obat = Obat::findOrFail($id);
        $obat->delete();

        return redirect()->route('obat.index')->with('success', 'Obat berhasil dihapus!');
    }
}
