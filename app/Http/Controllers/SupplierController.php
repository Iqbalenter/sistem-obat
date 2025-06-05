<?php

namespace App\Http\Controllers;

use App\Models\Supplier;
use Illuminate\Http\Request;

class SupplierController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $suppliers = Supplier::latest()->paginate(10);
        return view('supplier', compact('suppliers'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('supplier.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama_supplier' => 'required|string|max:255',
            'no_telepon' => 'required|string|max:20',
            'alamat' => 'required|string'
        ], [
            'nama_supplier.required' => 'Nama supplier wajib diisi',
            'nama_supplier.max' => 'Nama supplier maksimal 255 karakter',
            'no_telepon.required' => 'No telepon wajib diisi',
            'no_telepon.max' => 'No telepon maksimal 20 karakter',
            'alamat.required' => 'Alamat wajib diisi'
        ]);

        Supplier::create([
            'nama_supplier' => $request->nama_supplier,
            'no_telepon' => $request->no_telepon,
            'alamat' => $request->alamat
        ]);

        return redirect()->route('supplier.index')->with('success', 'Supplier berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $supplier = Supplier::findOrFail($id);
        return view('supplier.show', compact('supplier'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $supplier = Supplier::findOrFail($id);
        return view('supplier.edit', compact('supplier'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $supplier = Supplier::findOrFail($id);
        
        $request->validate([
            'nama_supplier' => 'required|string|max:255',
            'no_telepon' => 'required|string|max:20',
            'alamat' => 'required|string'
        ], [
            'nama_supplier.required' => 'Nama supplier wajib diisi',
            'nama_supplier.max' => 'Nama supplier maksimal 255 karakter',
            'no_telepon.required' => 'No telepon wajib diisi',
            'no_telepon.max' => 'No telepon maksimal 20 karakter',
            'alamat.required' => 'Alamat wajib diisi'
        ]);

        $supplier->update([
            'nama_supplier' => $request->nama_supplier,
            'no_telepon' => $request->no_telepon,
            'alamat' => $request->alamat
        ]);

        return redirect()->route('supplier.index')->with('success', 'Supplier berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $supplier = Supplier::findOrFail($id);
        $supplier->delete();

        return redirect()->route('supplier.index')->with('success', 'Supplier berhasil dihapus!');
    }
}
