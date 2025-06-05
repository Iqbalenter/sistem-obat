<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Persediaan</title>
    <link href="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.css" rel="stylesheet" />
    <link href="{{ asset('css/custom.css') }}" rel="stylesheet" />
    @vite([])
</head>
<body class="bg-gray-100">
    @include('components.aside_navbar')

    <div class="p-4 sm:ml-64">
        @if(session('success'))
            <div class="mb-4 mt-14 p-4 text-green-800 border border-green-300 rounded-lg bg-green-50" role="alert">
                <span class="font-medium">{{ session('success') }}</span>
            </div>
        @endif
        
        <!-- Statistik Cards -->
        <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-6 mt-14">
            <div class="bg-white rounded-lg shadow p-6">
                <div class="flex items-center">
                    <div class="p-3 rounded-full bg-blue-100 text-blue-600">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path>
                        </svg>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm font-medium text-gray-600">Total Obat</p>
                        <p class="text-2xl font-semibold text-blue-600">{{ $totalObats }}</p>
                    </div>
                </div>
            </div>
            
            <div class="bg-white rounded-lg shadow p-6">
                <div class="flex items-center">
                    <div class="p-3 rounded-full bg-red-100 text-red-600">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L4.082 16.5c-.77.833.192 2.5 1.732 2.5z"></path>
                        </svg>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm font-medium text-gray-600">Stok Rendah</p>
                        <p class="text-2xl font-semibold text-red-600">{{ $totalStokRendah }}</p>
                    </div>
                </div>
            </div>
            
            <div class="bg-white rounded-lg shadow p-6">
                <div class="flex items-center">
                    <div class="p-3 rounded-full bg-green-100 text-green-600">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path>
                    </svg>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm font-medium text-gray-600">Kategori</p>
                        <p class="text-2xl font-semibold text-green-600">{{ $totalKategori }}</p>
                    </div>
                </div>
            </div>
            
            <div class="bg-white rounded-lg shadow p-6">
                <div class="flex items-center">
                    <div class="p-3 rounded-full bg-purple-100 text-purple-600">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                    </svg>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm font-medium text-gray-600">Total Stok</p>
                        <p class="text-2xl font-semibold text-purple-600">{{ number_format($totalStokSemua) }}</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Form Search & Filter -->
        <div class="bg-white rounded-lg shadow mb-6">
            <div class="px-6 py-4 bg-gray-50 border-b rounded-t-lg">
                <h3 class="text-lg font-medium text-gray-900">Pencarian & Filter Persediaan</h3>
            </div>
            <div class="p-6">
                <form method="GET" action="{{ route('persediaan') }}" class="grid grid-cols-1 md:grid-cols-4 gap-4">
                    <!-- Search Input -->
                    <div>
                        <label for="search" class="block text-sm font-medium text-gray-700 mb-2">Cari Nama Obat</label>
                        <div class="relative">
                            <input type="text" 
                                   id="search" 
                                   name="search" 
                                   value="{{ $search }}"
                                   placeholder="Masukkan nama obat..."
                                   class="w-full pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                                </svg>
                            </div>
                        </div>
                    </div>

                    <!-- Filter Kategori -->
                    <div>
                        <label for="kategori" class="block text-sm font-medium text-gray-700 mb-2">Filter Kategori</label>
                        <select name="kategori" id="kategori" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                            <option value="">Semua Kategori</option>
                            @foreach($kategoris as $kategori)
                                <option value="{{ $kategori->id }}" {{ $kategori_filter == $kategori->id ? 'selected' : '' }}>
                                    {{ $kategori->nama_kategori }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Filter Stok -->
                    <div>
                        <label for="stok" class="block text-sm font-medium text-gray-700 mb-2">Filter Stok</label>
                        <select name="stok" id="stok" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                            <option value="">Semua Stok</option>
                            <option value="low" {{ $stok_filter == 'low' ? 'selected' : '' }}>Stok Rendah (≤10)</option>
                            <option value="medium" {{ $stok_filter == 'medium' ? 'selected' : '' }}>Stok Sedang (11-50)</option>
                            <option value="high" {{ $stok_filter == 'high' ? 'selected' : '' }}>Stok Tinggi (>50)</option>
                        </select>
                    </div>

                    <!-- Buttons -->
                    <div class="flex items-end space-x-2">
                        <button type="submit" class="flex-1 bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg transition duration-200 flex items-center justify-center">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                            </svg>
                            Cari
                        </button>
                        <a href="{{ route('persediaan') }}" class="flex-1 bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded-lg transition duration-200 flex items-center justify-center">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path>
                    </svg>
                            Reset
                        </a>
                    </div>
                </form>
            </div>
        </div>

        <!-- Tabel Persediaan Obat -->
        <div class="bg-white rounded-lg shadow overflow-hidden">
            <div class="px-6 py-4 bg-gray-50 border-b">
                <div class="flex justify-between items-center">
                    <div>
                        <h3 class="text-lg font-medium text-gray-900">Data Persediaan Obat</h3>
                        <p class="text-sm text-gray-600">
                            @if($search || $kategori_filter || $stok_filter)
                                Menampilkan {{ $obats->count() }} dari {{ $obats->total() }} obat
                                @if($search) - Pencarian: "{{ $search }}" @endif
                            @else
                                Total {{ $obats->total() }} obat tersedia
                            @endif
                        </p>
                    </div>
                    <div class="text-sm text-gray-500">
                        Halaman {{ $obats->currentPage() }} dari {{ $obats->lastPage() }}
                    </div>
                </div>
            </div>
            
            @if($obats->count() > 0)
                <div class="overflow-hidden overflow-x-auto">
                    <table class="w-full table-fixed divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="w-12 px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">No</th>
                                <th class="w-1/4 px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama Obat</th>
                                <th class="w-1/6 px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Kategori</th>
                                <th class="w-1/6 px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tanggal Masuk</th>
                                <th class="w-1/6 px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tanggal Expired</th>
                                <th class="w-16 px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Stok</th>
                                <th class="w-1/6 px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status Stok</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach($obats as $index => $obat)
                                <tr class="hover:bg-gray-50">
                                    <td class="px-6 py-4 text-sm text-gray-900">
                                        {{ ($obats->currentPage() - 1) * $obats->perPage() + $index + 1 }}
                                    </td>
                                    <td class="px-6 py-4">
                                        <div class="text-sm font-medium text-gray-900 truncate">{{ $obat->nama_obat }}</div>
                                    </td>
                                    <td class="px-6 py-4">
                                        <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full bg-gray-100 text-gray-800">
                                            {{ $obat->kategori->nama_kategori ?? '-' }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 text-sm text-gray-500">
                                        {{ $obat->tanggal_masuk->format('d/m/Y') }}
                                    </td>
                                    <td class="px-6 py-4 text-sm text-gray-500">
                                        {{ $obat->tanggal_expired->format('d/m/Y') }}
                                    </td>
                                    <td class="px-6 py-4">
                                        <span class="text-lg font-semibold {{ $obat->stok <= 10 ? 'text-red-600' : ($obat->stok <= 50 ? 'text-yellow-600' : 'text-green-600') }}">
                                            {{ $obat->stok }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4">
                                        @if($obat->stok <= 10)
                                            <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full bg-red-100 text-red-800 border border-red-300">
                                                Stok Rendah
                                            </span>
                                        @elseif($obat->stok <= 50)
                                            <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full bg-yellow-100 text-yellow-800 border border-yellow-300">
                                                Stok Sedang
                                            </span>
                                        @else
                                            <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full bg-green-100 text-green-800 border border-green-300">
                                                Stok Aman
                                            </span>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                
                <!-- Pagination -->
                <div class="px-6 py-4 bg-gray-50 border-t">
                    {{ $obats->withQueryString()->links() }}
                </div>
            @else
                <div class="px-6 py-12 text-center">
                    <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 48 48">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                    </svg>
                    <h3 class="mt-2 text-sm font-medium text-gray-900">Tidak ada obat ditemukan</h3>
                    <p class="mt-1 text-sm text-gray-500">
                        @if($search || $kategori_filter || $stok_filter)
                            Coba ubah kriteria pencarian atau filter Anda.
                        @else
                            Belum ada data obat yang tersedia.
                        @endif
                    </p>
                    @if($search || $kategori_filter || $stok_filter)
                        <div class="mt-6">
                            <a href="{{ route('persediaan') }}" class="inline-flex items-center px-4 py-2 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700">
                                Reset Filter
                            </a>
                        </div>
                    @endif
            </div>
            @endif
        </div>
        </div>


    <script src="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.js"></script>
</body>
</html>