<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Sistem Manajemen Obat</title>
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

        @if(session('error'))
            <div class="mb-4 mt-14 p-4 text-red-800 border border-red-300 rounded-lg bg-red-50" role="alert">
                <span class="font-medium">{{ session('error') }}</span>
            </div>
        @endif
        
        <div class="mt-14">
            <!-- Welcome Header -->
            <div class="mb-8">
                <h1 class="text-3xl font-bold text-gray-900 mb-2">Dashboard Sistem Manajemen Obat 💊</h1>
                <p class="text-gray-600">Selamat datang kembali! Berikut adalah ringkasan sistem Anda hari ini.</p>
                
                <!-- Info Sistem Slot Container -->
                <div class="mt-4 p-4 bg-gradient-to-r from-indigo-50 to-blue-50 border border-indigo-200 rounded-lg">
                    <div class="flex items-center">
                        <div class="flex-shrink-0">
                            <svg class="w-6 h-6 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
                            </svg>
                        </div>
                        <div class="ml-3">
                            <h3 class="text-lg font-semibold text-indigo-900">🗃️ Sistem Slot Container Aktif</h3>
                            <p class="text-sm text-indigo-700">
                                Sistem telah diperbarui menggunakan <span class="font-semibold">Slot Container 1-20</span> per block untuk menggantikan nomor antrian. 
                                Setiap halaman menampilkan maksimal 20 slot container untuk memudahkan manajemen lokasi obat.
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Statistics Cards -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
                <!-- Total Obat (kembali seperti semula) -->
                <div class="bg-blue-600 rounded-lg shadow-lg p-6 text-white">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-blue-100 text-sm font-medium">Total Obat</p>
                            <p class="text-3xl font-bold">{{ number_format($totalObat) }}</p>
                        </div>
                        <div class="bg-blue-500 rounded-full p-3">
                            <svg class="w-8 h-8 text-blue-100" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 8.172V5L8 4z"/>
                            </svg>
                        </div>
                    </div>
                </div>

                <!-- Total Kategori -->
                <div class="bg-green-600 rounded-lg shadow-lg p-6 text-white">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-green-100 text-sm font-medium">Total Kategori</p>
                            <p class="text-3xl font-bold">{{ number_format($totalKategori) }}</p>
                        </div>
                        <div class="bg-green-500 rounded-full p-3">
                            <svg class="w-8 h-8 text-green-100" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"/>
                            </svg>
                        </div>
                    </div>
                </div>

                <!-- Total Stok -->
                <div class="bg-purple-600 rounded-lg shadow-lg p-6 text-white">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-purple-100 text-sm font-medium">Total Stok</p>
                            <p class="text-3xl font-bold">{{ number_format($totalStok) }}</p>
                        </div>
                        <div class="bg-purple-500 rounded-full p-3">
                            <svg class="w-8 h-8 text-purple-100" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
                            </svg>
                        </div>
                    </div>
                </div>

                <!-- Stok Rendah -->
                <div class="bg-red-600 rounded-lg shadow-lg p-6 text-white">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-red-100 text-sm font-medium">Stok Rendah</p>
                            <p class="text-3xl font-bold">{{ number_format($stokRendah) }}</p>
                        </div>
                        <div class="bg-red-500 rounded-full p-3">
                            <svg class="w-8 h-8 text-red-100" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.664-.833-2.464 0L4.34 16.5c-.77.833.192 2.5 1.732 2.5z"/>
                            </svg>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Status Obat (ditampilkan terpisah, bukan digabung) -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                <div class="bg-white rounded-lg shadow p-6 border-l-4 border-blue-500">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-gray-500 text-sm font-medium">Dipertahankan</p>
                            <p class="text-3xl font-bold text-gray-900">{{ number_format($statusDipertahankan ?? 0) }}</p>
                        </div>
                        <div class="bg-blue-100 rounded-full p-3">
                            <svg class="w-7 h-7 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                        </div>
                    </div>
                </div>
                <div class="bg-white rounded-lg shadow p-6 border-l-4 border-red-500">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-gray-500 text-sm font-medium">Dimusnahkan</p>
                            <p class="text-3xl font-bold text-gray-900">{{ number_format($statusDimusnahkan ?? 0) }}</p>
                        </div>
                        <div class="bg-red-100 rounded-full p-3">
                            <svg class="w-7 h-7 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        </div>
                    </div>
                </div>
                <div class="bg-white rounded-lg shadow p-6 border-l-4 border-purple-500">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-gray-500 text-sm font-medium">Dikembalikan</p>
                            <p class="text-3xl font-bold text-gray-900">{{ number_format($statusDikembalikan ?? 0) }}</p>
                        </div>
                        <div class="bg-purple-100 rounded-full p-3">
                            <svg class="w-7 h-7 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h11M9 21V3m7 7l5-5m0 0l-5-5m5 5H13"/></svg>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Alert Cards -->
            @if($obatExpired > 0 || $obatAkanExpired > 0 || $stokKosong > 0)
            <div class="mb-8">
                <h2 class="text-xl font-bold text-gray-900 mb-4">🚨 Peringatan Sistem</h2>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    @if($obatExpired > 0)
                    <div class="bg-red-50 border border-red-200 rounded-lg p-4">
                        <div class="flex items-center">
                            <div class="bg-red-100 rounded-full p-2 mr-3">
                                <svg class="w-5 h-5 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                            </div>
                            <div>
                                <p class="text-red-800 font-semibold">{{ $obatExpired }} Obat Expired</p>
                                <p class="text-red-600 text-sm">Segera ditangani!</p>
                            </div>
                        </div>
                    </div>
                    @endif

                    @if($obatAkanExpired > 0)
                    <div class="bg-yellow-50 border border-yellow-200 rounded-lg p-4">
                        <div class="flex items-center">
                            <div class="bg-yellow-100 rounded-full p-2 mr-3">
                                <svg class="w-5 h-5 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                            </div>
                            <div>
                                <p class="text-yellow-800 font-semibold">{{ $obatAkanExpired }} Akan Expired</p>
                                <p class="text-yellow-600 text-sm">Dalam 90 hari</p>
                            </div>
                        </div>
                    </div>
                    @endif

                    @if($stokKosong > 0)
                    <div class="bg-orange-50 border border-orange-200 rounded-lg p-4">
                        <div class="flex items-center">
                            <div class="bg-orange-100 rounded-full p-2 mr-3">
                                <svg class="w-5 h-5 text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"/>
                                </svg>
                            </div>
                            <div>
                                <p class="text-orange-800 font-semibold">{{ $stokKosong }} Stok Kosong</p>
                                <p class="text-orange-600 text-sm">Perlu restock</p>
                            </div>
                        </div>
                    </div>
                    @endif
                </div>
            </div>
            @endif



            <!-- Bottom Content Grid -->
            <div class="grid grid-cols-1 lg:grid-cols-2 xl:grid-cols-3 gap-8">
                

                <!-- Top Kategori -->
                <div class="bg-white rounded-lg shadow-lg p-6">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4">🏆 Top Kategori</h3>
                    @if($topKategori->count() > 0)
                        <div class="space-y-4">
                            @foreach($topKategori as $index => $kategori)
                            <div class="flex items-center">
                                <div class="w-8 h-8 rounded-full flex items-center justify-center mr-3 
                                    {{ $index == 0 ? 'bg-yellow-100 text-yellow-800' : ($index == 1 ? 'bg-gray-100 text-gray-800' : ($index == 2 ? 'bg-orange-100 text-orange-800' : 'bg-blue-100 text-blue-800')) }}">
                                    <span class="text-sm font-bold">{{ $index + 1 }}</span>
                                </div>
                                <div class="flex-1">
                                    <p class="font-medium text-gray-900 text-sm">{{ $kategori->nama_kategori }}</p>
                                    <div class="flex items-center mt-1">
                                        <div class="flex-1 bg-gray-200 rounded-full h-2 mr-2">
                                            <div class="bg-blue-500 h-2 rounded-full" style="width: {{ min(100, ($kategori->obats_count / $topKategori->first()->obats_count) * 100) }}%"></div>
                                        </div>
                                        <span class="text-xs text-gray-600">{{ $kategori->obats_count }} obat</span>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    @else
                        <div class="text-center py-8">
                            <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"/>
                            </svg>
                            <p class="mt-2 text-sm text-gray-500">Belum ada kategori</p>
                        </div>
                    @endif
                </div>

                <!-- Aktivitas Terbaru -->
                <div class="bg-white rounded-lg shadow-lg p-6">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4">📋 Aktivitas Terbaru</h3>
                    <div class="space-y-4">
                        @foreach($aktivitasTerbaru as $aktivitas)
                        <div class="flex items-start">
                            <div class="w-8 h-8 rounded-full flex items-center justify-center mr-3 
                                {{ $aktivitas['type'] == 'create' ? 'bg-green-100' : ($aktivitas['type'] == 'warning' ? 'bg-yellow-100' : 'bg-red-100') }}">
                                @if($aktivitas['icon'] == 'plus')
                                    <svg class="w-4 h-4 {{ $aktivitas['type'] == 'create' ? 'text-green-600' : ($aktivitas['type'] == 'warning' ? 'text-yellow-600' : 'text-red-600') }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                                    </svg>
                                @elseif($aktivitas['icon'] == 'exclamation')
                                    <svg class="w-4 h-4 {{ $aktivitas['type'] == 'create' ? 'text-green-600' : ($aktivitas['type'] == 'warning' ? 'text-yellow-600' : 'text-red-600') }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.664-.833-2.464 0L4.34 16.5c-.77.833.192 2.5 1.732 2.5z"/>
                                    </svg>
                                @else
                                    <svg class="w-4 h-4 {{ $aktivitas['type'] == 'create' ? 'text-green-600' : ($aktivitas['type'] == 'warning' ? 'text-yellow-600' : 'text-red-600') }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                    </svg>
                                @endif
                            </div>
                            <div class="flex-1">
                                <p class="text-sm font-medium text-gray-900">{{ $aktivitas['action'] }}</p>
                                <p class="text-xs text-gray-600 mt-1">{{ $aktivitas['details'] }}</p>
                                <p class="text-xs text-gray-400 mt-1">{{ \Carbon\Carbon::parse($aktivitas['time'])->diffForHumans() }}</p>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>

            <!-- Footer Stats -->
            <div class="mt-8 bg-white rounded-lg shadow-lg p-6">
                <h3 class="text-lg font-semibold text-gray-900 mb-4">📊 Ringkasan Stok per Kategori</h3>
                @if($stokPerKategori->count() > 0)
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                    @foreach($stokPerKategori as $kategori)
                    <div class="bg-gray-50 rounded-lg p-4">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="font-medium text-gray-900">{{ $kategori->nama_kategori }}</p>
                                <p class="text-2xl font-bold text-blue-600">{{ number_format($kategori->obats_sum_stok) }}</p>
                                <p class="text-sm text-gray-600">Total Stok</p>
                            </div>
                            <div class="bg-blue-100 rounded-full p-3">
                                <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
                                </svg>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
                @else
                <div class="text-center py-8">
                    <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
                    </svg>
                    <p class="mt-2 text-sm text-gray-500">Belum ada data stok</p>
                </div>
                @endif
            </div>
        </div>
    </div>



    <script src="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.js"></script>
</body>
</html>