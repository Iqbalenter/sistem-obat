<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Pemusnahan & Pengembalian</title>
    <link href="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.css" rel="stylesheet" />
    <link href="{{ asset('css/custom.css') }}" rel="stylesheet" />
    @vite([])
</head>
<body class="bg-gray-100">
@include('components.aside_navbar')
<div class="p-4 sm:ml-64">

    @if(session('success'))
        <div class="mb-4 mt-14 p-4 text-green-800 border border-green-300 rounded-lg bg-green-50">{{ session('success') }}</div>
    @endif
    @if ($errors->any())
        <div class="mb-4 mt-14 p-4 text-red-800 border border-red-300 rounded-lg bg-red-50">
            <ul class="list-disc list-inside">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="mt-14">
        <h1 class="text-3xl font-bold text-gray-900 mb-6">🧾 Pemusnahan & Pengembalian Obat</h1>

        <!-- Form Aksi Pemindahan -->
        @if(Auth::user()->isAdmin() || Auth::user()->isPegawai())
        <div class="bg-white rounded-lg shadow p-6 mb-8">
            <h2 class="text-lg font-semibold mb-4">Form Pemindahan</h2>
            <form action="{{ route('pemindahan.store') }}" method="POST" class="grid grid-cols-1 md:grid-cols-6 gap-4">
                @csrf
                <div class="md:col-span-2">
                    <label class="block mb-2 text-sm font-medium">Pilih Obat</label>
                    <select name="obat_id" class="w-full border rounded-lg p-2.5">
                        @foreach(\App\Models\Obat::with('kategori','supplier')->orderBy('nama_obat')->get() as $o)
                            <option value="{{ $o->id }}">{{ $o->nama_obat }} (Stok: {{ $o->stok }})</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label class="block mb-2 text-sm font-medium">Jenis</label>
                    <select name="jenis" id="jenis" class="w-full border rounded-lg p-2.5">
                        <option value="pemusnahan">Pemusnahan</option>
                        <option value="pengembalian">Pengembalian</option>
                    </select>
                </div>
                <div>
                    <label class="block mb-2 text-sm font-medium">Jumlah</label>
                    <input type="number" name="jumlah" min="1" class="w-full border rounded-lg p-2.5" placeholder="0" required />
                </div>
                <div>
                    <label class="block mb-2 text-sm font-medium">Tanggal</label>
                    <input type="date" name="tanggal" class="w-full border rounded-lg p-2.5" required />
                </div>
                <div class="md:col-span-2">
                    <label class="block mb-2 text-sm font-medium">Supplier (untuk pengembalian)</label>
                    <select name="supplier_id" class="w-full border rounded-lg p-2.5">
                        <option value="">- Pilih Supplier -</option>
                        @foreach(\App\Models\Supplier::orderBy('nama_supplier')->get() as $s)
                            <option value="{{ $s->id }}">{{ $s->nama_supplier }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="md:col-span-6">
                    <label class="block mb-2 text-sm font-medium">Alasan</label>
                    <input type="text" name="alasan" class="w-full border rounded-lg p-2.5" placeholder="Contoh: Kadaluarsa, Rusak, dsb" />
                </div>
                <div class="md:col-span-6 text-right">
                    <button class="px-5 py-2.5 bg-blue-600 hover:bg-blue-700 text-white rounded-lg">Simpan</button>
                </div>
            </form>
        </div>
        @endif

        <!-- Tabs List -->
        <div class="bg-white rounded-lg shadow">
            <div class="border-b p-4 flex gap-2">
                <button data-tab="tab-pemusnahan" class="tab-btn px-4 py-2 rounded bg-gray-100">Pemusnahan</button>
                <button data-tab="tab-pengembalian" class="tab-btn px-4 py-2 rounded">Pengembalian</button>
            </div>
            <div class="p-4">
                <!-- Tabel Pemusnahan -->
                <div id="tab-pemusnahan" class="tab-content block">
                    <div class="overflow-x-auto">
                        <table class="w-full text-sm text-left text-gray-500">
                            <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                                <tr>
                                    <th class="px-6 py-3">Tanggal</th>
                                    <th class="px-6 py-3">Nama Obat</th>
                                    <th class="px-6 py-3">Kategori</th>
                                    <th class="px-6 py-3">Jumlah</th>
                                    <th class="px-6 py-3">Alasan</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($pemusnahan as $row)
                                <tr class="bg-white border-b">
                                    <td class="px-6 py-4">{{ \Carbon\Carbon::parse($row->tanggal)->format('d/m/Y') }}</td>
                                    <td class="px-6 py-4">{{ $row->obat->nama_obat }}</td>
                                    <td class="px-6 py-4">{{ $row->obat->kategori->nama_kategori ?? '-' }}</td>
                                    <td class="px-6 py-4">{{ $row->jumlah }}</td>
                                    <td class="px-6 py-4">{{ $row->alasan ?? '-' }}</td>
                                </tr>
                                @empty
                                <tr><td colspan="5" class="px-6 py-6 text-center text-gray-500">Belum ada data pemusnahan</td></tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    <div class="mt-4">{{ $pemusnahan->links() }}</div>
                </div>

                <!-- Tabel Pengembalian -->
                <div id="tab-pengembalian" class="tab-content hidden">
                    <div class="overflow-x-auto">
                        <table class="w-full text-sm text-left text-gray-500">
                            <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                                <tr>
                                    <th class="px-6 py-3">Tanggal</th>
                                    <th class="px-6 py-3">Nama Obat</th>
                                    <th class="px-6 py-3">Kategori</th>
                                    <th class="px-6 py-3">Jumlah</th>
                                    <th class="px-6 py-3">Supplier</th>
                                    <th class="px-6 py-3">Alasan</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($pengembalian as $row)
                                <tr class="bg-white border-b">
                                    <td class="px-6 py-4">{{ \Carbon\Carbon::parse($row->tanggal)->format('d/m/Y') }}</td>
                                    <td class="px-6 py-4">{{ $row->obat->nama_obat }}</td>
                                    <td class="px-6 py-4">{{ $row->obat->kategori->nama_kategori ?? '-' }}</td>
                                    <td class="px-6 py-4">{{ $row->jumlah }}</td>
                                    <td class="px-6 py-4">{{ $row->supplier->nama_supplier ?? ($row->obat->supplier->nama_supplier ?? '-') }}</td>
                                    <td class="px-6 py-4">{{ $row->alasan ?? '-' }}</td>
                                </tr>
                                @empty
                                <tr><td colspan="6" class="px-6 py-6 text-center text-gray-500">Belum ada data pengembalian</td></tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    <div class="mt-4">{{ $pengembalian->links() }}</div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
// Tabs simple
const btns = document.querySelectorAll('.tab-btn');
const tabs = document.querySelectorAll('.tab-content');
btns.forEach(btn => btn.addEventListener('click', () => {
    btns.forEach(b => b.classList.remove('bg-gray-100'));
    tabs.forEach(t => t.classList.add('hidden'));
    const target = document.getElementById(btn.dataset.tab);
    btn.classList.add('bg-gray-100');
    target.classList.remove('hidden');
}));
</script>
<script src="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.js"></script>
</body>
</html>
