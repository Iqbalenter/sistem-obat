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

        <!-- Daftar Obat Expired dengan Aksi Modal -->
        @if(Auth::user()->isAdmin() || Auth::user()->isPegawai())
        <div class="bg-white rounded-lg shadow-lg mb-8">
            <div class="flex justify-between items-center p-6 border-b border-gray-200">
                <div>
                    <h2 class="text-xl font-bold text-gray-900">♻️ Return / Pengelolaan Limbah</h2>
                    <p class="text-gray-600 text-sm">Daftar obat yang telah expired dan perlu tindakan</p>
                </div>
            </div>
            <div class="p-6">
                <div class="overflow-x-auto">
                    <table class="w-full text-sm text-left text-gray-500">
                        <thead class="text-xs text-gray-700 uppercase bg-gradient-to-r from-gray-50 to-gray-100">
                            <tr>
                                <th class="px-6 py-4 font-bold">No</th>
                                <th class="px-6 py-4 font-bold">Nama Obat</th>
                                <th class="px-6 py-4 font-bold">Tanggal Masuk</th>
                                <th class="px-6 py-4 font-bold">Tanggal Expired</th>
                                <th class="px-6 py-4 font-bold">Status</th>
                                <th class="px-6 py-4 font-bold text-right">Tindakan</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @forelse($expiredObats as $index => $o)
                            <tr class="hover:bg-gray-50 transition-colors duration-200">
                                <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                                    <span class="bg-gray-100 text-gray-800 px-3 py-1 rounded-full text-xs font-bold">
                                        {{ ($expiredObats->currentPage() - 1) * $expiredObats->perPage() + $index + 1 }}
                                    </span>
                                </td>
                                <td class="px-6 py-4">
                                    <div class="font-medium text-gray-900">{{ $o->nama_obat }}</div>
                                    <div class="text-xs">
                                        <span class="bg-gradient-to-r from-blue-100 to-blue-200 text-blue-800 text-[10px] font-medium px-2 py-0.5 rounded-full">
                                            {{ $o->kategori->nama_kategori ?? '-' }}
                                        </span>
                                        <span class="ml-2 text-gray-500">Stok: 
                                            <span class="font-semibold {{ $o->stok <= 10 ? 'text-red-600' : 'text-green-600' }}">{{ $o->stok }}</span>
                                        </span>
                                    </div>
                                </td>
                                <td class="px-6 py-4 text-gray-600">{{ optional($o->tanggal_masuk)->format('d/m/Y') }}</td>
                                <td class="px-6 py-4 text-gray-600">{{ optional($o->tanggal_expired)->format('d/m/Y') }}</td>
                                <td class="px-6 py-4">
                                    @php
                                        $expiredAt = $o->tanggal_expired ? \Carbon\Carbon::parse($o->tanggal_expired) : null;
                                        $diffInDays = $expiredAt ? now()->diffInDays($expiredAt, false) : null;
                                    @endphp
                                    @if($o->status === 'dimusnahkan')
                                        <span class="bg-red-100 text-red-800 text-xs font-bold px-3 py-1 rounded-full">Dimusnahkan</span>
                                    @elseif($o->status === 'dikembalikan')
                                        <span class="bg-purple-100 text-purple-800 text-xs font-bold px-3 py-1 rounded-full">Dikembalikan</span>
                                    @else
                                        @if(!is_null($diffInDays) && $diffInDays < 0)
                                            <span class="bg-gradient-to-r from-red-100 to-red-200 text-red-800 text-xs font-bold px-3 py-1 rounded-full">Expired</span>
                                        @else
                                            <span class="bg-gradient-to-r from-yellow-100 to-yellow-200 text-yellow-800 text-xs font-bold px-3 py-1 rounded-full">Akan Diproses</span>
                                        @endif
                                    @endif
                                </td>
                                <td class="px-6 py-4 text-right">
                                    <div class="inline-flex gap-2">
                                        <button type="button"
                                            class="open-modal-destroy bg-red-600 hover:bg-red-700 text-white px-3 py-1.5 rounded-lg shadow transition-all duration-200 transform hover:scale-105 text-xs"
                                            data-obat-id="{{ $o->id }}"
                                            data-obat-nama="{{ $o->nama_obat }}"
                                            data-obat-stok="{{ $o->stok }}">
                                            Musnahkan
                                        </button>
                                        <button type="button"
                                            class="open-modal-return bg-blue-600 hover:bg-blue-700 text-white px-3 py-1.5 rounded-lg shadow transition-all duration-200 transform hover:scale-105 text-xs"
        
                                            data-obat-id="{{ $o->id }}"
                                            data-obat-nama="{{ $o->nama_obat }}"
                                            data-obat-stok="{{ $o->stok }}"
                                            data-supplier-id="{{ $o->supplier_id }}">
                                            Kembalikan
                                        </button>
                                    </div>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="6" class="px-6 py-12 text-center">
                                    <div class="flex flex-col items-center">
                                        <svg class="w-12 h-12 text-gray-400 mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                        </svg>
                                        <p class="text-gray-500 text-sm">Tidak ada obat expired.</p>
                                    </div>
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                @if($expiredObats->hasPages())
                <div class="mt-6 flex justify-center">
                    <div class="bg-white border border-gray-200 rounded-lg shadow-sm">
                        {{ $expiredObats->links() }}
                    </div>
                </div>
                @endif
            </div>
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
                            <thead class="text-xs text-gray-700 uppercase bg-gradient-to-r from-gray-50 to-gray-100">
                                <tr>
                                    <th class="px-6 py-4 font-bold">Tanggal</th>
                                    <th class="px-6 py-4 font-bold">Nama Obat</th>
                                    <th class="px-6 py-4 font-bold">Kategori</th>
                                    <th class="px-6 py-4 font-bold">Jumlah</th>
                                    <th class="px-6 py-4 font-bold">Alasan</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @forelse($pemusnahan as $row)
                                <tr class="hover:bg-gray-50 transition-colors duration-200">
                                    <td class="px-6 py-4 text-gray-600">{{ \Carbon\Carbon::parse($row->tanggal)->format('d/m/Y') }}</td>
                                    <td class="px-6 py-4 font-medium text-gray-900">{{ $row->obat->nama_obat ?? $row->obat_nama ?? '-' }}</td>
                                    <td class="px-6 py-4">
                                        <span class="bg-gradient-to-r from-blue-100 to-blue-200 text-blue-800 text-xs font-medium px-3 py-1 rounded-full">
                                            {{ $row->obat->kategori->nama_kategori ?? $row->kategori_nama ?? '-' }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4"><span class="font-semibold">{{ $row->jumlah }}</span></td>
                                    <td class="px-6 py-4">{{ $row->alasan ?? '-' }}</td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="5" class="px-6 py-12 text-center">
                                        <div class="flex flex-col items-center">
                                            <svg class="w-12 h-12 text-gray-400 mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                            </svg>
                                            <p class="text-gray-500 text-sm">Belum ada data pemusnahan</p>
                                        </div>
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    @if($pemusnahan->hasPages())
                    <div class="mt-6 flex justify-center">
                        <div class="bg-white border border-gray-200 rounded-lg shadow-sm">
                            {{ $pemusnahan->links() }}
                        </div>
                    </div>
                    @endif
                </div>

                <!-- Tabel Pengembalian -->
                <div id="tab-pengembalian" class="tab-content hidden">
                    <div class="overflow-x-auto">
                        <table class="w-full text-sm text-left text-gray-500">
                            <thead class="text-xs text-gray-700 uppercase bg-gradient-to-r from-gray-50 to-gray-100">
                                <tr>
                                    <th class="px-6 py-4 font-bold">Tanggal</th>
                                    <th class="px-6 py-4 font-bold">Nama Obat</th>
                                    <th class="px-6 py-4 font-bold">Kategori</th>
                                    <th class="px-6 py-4 font-bold">Jumlah</th>
                                    <th class="px-6 py-4 font-bold">Supplier</th>
                                    <th class="px-6 py-4 font-bold">Alasan</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @forelse($pengembalian as $row)
                                <tr class="hover:bg-gray-50 transition-colors duration-200">
                                    <td class="px-6 py-4 text-gray-600">{{ \Carbon\Carbon::parse($row->tanggal)->format('d/m/Y') }}</td>
                                    <td class="px-6 py-4 font-medium text-gray-900">{{ $row->obat->nama_obat ?? $row->obat_nama ?? '-' }}</td>
                                    <td class="px-6 py-4">
                                        <span class="bg-gradient-to-r from-blue-100 to-blue-200 text-blue-800 text-xs font-medium px-3 py-1 rounded-full">
                                            {{ $row->obat->kategori->nama_kategori ?? $row->kategori_nama ?? '-' }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4"><span class="font-semibold">{{ $row->jumlah }}</span></td>
                                    <td class="px-6 py-4">{{ $row->supplier->nama_supplier ?? ($row->obat->supplier->nama_supplier ?? '-') }}</td>
                                    <td class="px-6 py-4">{{ $row->alasan ?? '-' }}</td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="6" class="px-6 py-12 text-center">
                                        <div class="flex flex-col items-center">
                                            <svg class="w-12 h-12 text-gray-400 mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                            </svg>
                                            <p class="text-gray-500 text-sm">Belum ada data pengembalian</p>
                                        </div>
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    @if($pengembalian->hasPages())
                    <div class="mt-6 flex justify-center">
                        <div class="bg-white border border-gray-200 rounded-lg shadow-sm">
                            {{ $pengembalian->links() }}
                        </div>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

<script>
// Modal helpers
const modalDestroy = {
    root: null,
    init() {
        this.root = document.getElementById('modal-destroy');
    },
    open(data){
    this.root.classList.remove('hidden');
    this.root.classList.add('flex');
        this.root.querySelector('[data-destroy-obat-name]').textContent = data.nama;
        this.root.querySelector('input[name="obat_id"]').value = data.id;
        this.root.querySelector('input[name="jumlah"]').max = data.stok;
        this.root.querySelector('[data-stok-info]').textContent = `Stok tersedia: ${data.stok}`;
        this.root.querySelector('input[name="tanggal"]').valueAsDate = new Date();
    },
    close(){ this.root.classList.add('hidden'); this.root.classList.remove('flex'); }
};

const modalReturn = {
    root: null,
    init(){ this.root = document.getElementById('modal-return'); },
    open(data){
        this.root.classList.remove('hidden');
        this.root.classList.add('flex');
        this.root.querySelector('[data-return-obat-name]').textContent = data.nama;
        this.root.querySelector('input[name="obat_id"]').value = data.id;
        this.root.querySelector('input[name="jumlah"]').max = data.stok;
        this.root.querySelector('[data-stok-info]').textContent = `Stok tersedia: ${data.stok}`;
        this.root.querySelector('input[name="tanggal"]').valueAsDate = new Date();
        const supplierSelect = this.root.querySelector('select[name="supplier_id"]');
        if (data.supplier_id) supplierSelect.value = data.supplier_id;
    },
    close(){ this.root.classList.add('hidden'); this.root.classList.remove('flex'); }
};

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

// Init modals and bind events
document.addEventListener('DOMContentLoaded', () => {
    modalDestroy.init();
    modalReturn.init();

    document.querySelectorAll('.open-modal-destroy').forEach(btn => {
        btn.addEventListener('click', () => {
            modalDestroy.open({
                id: btn.dataset.obatId,
                nama: btn.dataset.obatNama,
                stok: parseInt(btn.dataset.obatStok || '0', 10)
            });
        });
    });
    document.querySelectorAll('.open-modal-return').forEach(btn => {
        btn.addEventListener('click', () => {
            modalReturn.open({
                id: btn.dataset.obatId,
                nama: btn.dataset.obatNama,
                stok: parseInt(btn.dataset.obatStok || '0', 10),
                supplier_id: btn.dataset.supplierId || ''
            });
        });
    });

    document.querySelectorAll('[data-modal-close]').forEach(btn => {
        btn.addEventListener('click', () => {
            const modal = btn.closest('[data-modal-root]');
            modal.classList.add('hidden');
        });
    });
});
</script>
<script src="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.js"></script>

<!-- Modal: Pemusnahan -->
<div id="modal-destroy" data-modal-root class="hidden fixed inset-0 z-50 items-center justify-center bg-black/50">
    <div class="bg-white rounded-lg shadow w-full max-w-lg">
        <div class="flex items-center justify-between p-4 border-b">
            <h3 class="font-semibold">Musnahkan Obat</h3>
            <button type="button" data-modal-close class="text-gray-400 hover:text-gray-600">✕</button>
        </div>
        <form action="{{ route('pemindahan.store') }}" method="POST" class="p-4">
            @csrf
            <input type="hidden" name="obat_id" value="" />
            <input type="hidden" name="jenis" value="pemusnahan" />
            <div class="space-y-4">
                <p>Anda akan memusnahkan: <span class="font-medium" data-destroy-obat-name></span></p>
                <p class="text-xs text-gray-500" data-stok-info></p>
                <div>
                    <label class="block mb-1 text-sm">Jumlah</label>
                    <input type="number" name="jumlah" min="1" class="w-full border rounded p-2" required />
                </div>
                <div>
                    <label class="block mb-1 text-sm">Tanggal</label>
                    <input type="date" name="tanggal" class="w-full border rounded p-2" required />
                </div>
                <div>
                    <label class="block mb-1 text-sm">Alasan</label>
                    <input type="text" name="alasan" class="w-full border rounded p-2" placeholder="Contoh: Kadaluarsa" />
                </div>
            </div>
            <div class="flex justify-end gap-2 mt-6 border-t pt-4">
                <button type="button" data-modal-close class="px-4 py-2 border rounded">Batal</button>
                <button type="submit" class="px-4 py-2 bg-red-600 hover:bg-red-700 text-white rounded">Musnahkan</button>
            </div>
        </form>
    </div>
    </div>

<!-- Modal: Pengembalian -->
<div id="modal-return" data-modal-root class="hidden fixed inset-0 z-50 items-center justify-center bg-black/50">
    <div class="bg-white rounded-lg shadow w-full max-w-lg">
        <div class="flex items-center justify-between p-4 border-b">
            <h3 class="font-semibold">Kembalikan Obat</h3>
            <button type="button" data-modal-close class="text-gray-400 hover:text-gray-600">✕</button>
        </div>
        <form action="{{ route('pemindahan.store') }}" method="POST" class="p-4">
            @csrf
            <input type="hidden" name="obat_id" value="" />
            <input type="hidden" name="jenis" value="pengembalian" />
            <div class="space-y-4">
                <p>Anda akan mengembalikan: <span class="font-medium" data-return-obat-name></span></p>
                <p class="text-xs text-gray-500" data-stok-info></p>
                <div>
                    <label class="block mb-1 text-sm">Jumlah</label>
                    <input type="number" name="jumlah" min="1" class="w-full border rounded p-2" required />
                </div>
                <div>
                    <label class="block mb-1 text-sm">Tanggal</label>
                    <input type="date" name="tanggal" class="w-full border rounded p-2" required />
                </div>
                <div>
                    <label class="block mb-1 text-sm">Supplier</label>
                    <select name="supplier_id" class="w-full border rounded p-2">
                        <option value="">- Pilih Supplier -</option>
                        @foreach(\App\Models\Supplier::orderBy('nama_supplier')->get() as $s)
                            <option value="{{ $s->id }}">{{ $s->nama_supplier }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label class="block mb-1 text-sm">Alasan</label>
                    <input type="text" name="alasan" class="w-full border rounded p-2" placeholder="Contoh: Kadaluarsa" />
                </div>
            </div>
            <div class="flex justify-end gap-2 mt-6 border-t pt-4">
                <button type="button" data-modal-close class="px-4 py-2 border rounded">Batal</button>
                <button type="submit" class="px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded">Kembalikan</button>
            </div>
        </form>
    </div>
    </div>
</body>
</html>
