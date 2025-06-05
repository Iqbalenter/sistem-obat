<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Sistem Obat</title>
    <link href="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.css" rel="stylesheet" />
    <link href="{{ asset('css/custom.css') }}" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
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
        
        <!-- Header Laporan -->
        <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-6 mt-14">
            <div>
                <h1 class="text-3xl font-bold text-gray-900 mb-2">📊 Laporan Sistem Obat</h1>
                <p class="text-gray-600">Dashboard analitik dan laporan komprehensif sistem manajemen obat</p>
            </div>
            <div class="flex items-center space-x-3 mt-4 md:mt-0">
                <button onclick="window.print()" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg flex items-center">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"></path>
                    </svg>
                    Print
                </button>
                <span class="text-sm text-gray-500">{{ Carbon\Carbon::now()->format('d M Y, H:i') }}</span>
            </div>
        </div>

        <!-- Cards Statistik Utama -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-6 gap-4 mb-8">
            <div class="bg-blue-600 rounded-xl shadow-lg p-6 text-white">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-blue-100 text-sm font-medium">Total Obat</p>
                        <p class="text-3xl font-bold">{{ number_format($totalObat) }}</p>
                    </div>
                    <div class="bg-white bg-opacity-20 rounded-full p-3">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path>
                        </svg>
                    </div>
                </div>
            </div>

            <div class="bg-green-600 rounded-xl shadow-lg p-6 text-white">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-green-100 text-sm font-medium">Kategori</p>
                        <p class="text-3xl font-bold">{{ number_format($totalKategori) }}</p>
                    </div>
                    <div class="bg-white bg-opacity-20 rounded-full p-3">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path>
                        </svg>
                    </div>
                </div>
            </div>

            <div class="bg-purple-600 rounded-xl shadow-lg p-6 text-white">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-purple-100 text-sm font-medium">Total Stok</p>
                        <p class="text-3xl font-bold">{{ number_format($totalStok) }}</p>
                    </div>
                    <div class="bg-white bg-opacity-20 rounded-full p-3">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                        </svg>
                    </div>
                </div>
            </div>

            <div class="bg-red-600 rounded-xl shadow-lg p-6 text-white">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-red-100 text-sm font-medium">Telah Expired</p>
                        <p class="text-3xl font-bold">{{ number_format($obatExpired) }}</p>
                    </div>
                    <div class="bg-white bg-opacity-20 rounded-full p-3">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L4.082 16.5c-.77.833.192 2.5 1.732 2.5z"></path>
                        </svg>
                    </div>
                </div>
            </div>

            <div class="bg-yellow-600 rounded-xl shadow-lg p-6 text-white">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-yellow-100 text-sm font-medium">Akan Expired</p>
                        <p class="text-3xl font-bold">{{ number_format($obatAkanExpired) }}</p>
                    </div>
                    <div class="bg-white bg-opacity-20 rounded-full p-3">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                </div>
            </div>

            <div class="bg-orange-600 rounded-xl shadow-lg p-6 text-white">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-orange-100 text-sm font-medium">Stok Rendah</p>
                        <p class="text-3xl font-bold">{{ number_format($stokRendah) }}</p>
                    </div>
                    <div class="bg-white bg-opacity-20 rounded-full p-3">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 17h8m0 0V9m0 8l-8-8-4 4-6-6"></path>
                        </svg>
                    </div>
                </div>
            </div>
        </div>

        <!-- Charts Section -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-8">
            <!-- Chart Kategori -->
            <div class="bg-white rounded-xl shadow-lg p-6">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="text-lg font-semibold text-gray-900">📊 Distribusi Kategori Obat</h3>
                    <div class="bg-blue-100 text-blue-800 text-xs font-medium px-2.5 py-0.5 rounded">Chart</div>
                </div>
                <div class="h-64">
                    <canvas id="chartKategori"></canvas>
                </div>
            </div>

            <!-- Chart Trend Bulanan -->
            <div class="bg-white rounded-xl shadow-lg p-6">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="text-lg font-semibold text-gray-900">📈 Trend Obat Masuk (6 Bulan)</h3>
                    <div class="bg-green-100 text-green-800 text-xs font-medium px-2.5 py-0.5 rounded">Trend</div>
                </div>
                <div class="h-64">
                    <canvas id="chartBulanan"></canvas>
                </div>
            </div>
        </div>

        <!-- Tabel Laporan -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-8">
            <!-- Laporan Kategori -->
            <div class="bg-white rounded-xl shadow-lg overflow-hidden h-fit">
                <div class="px-6 py-4 bg-gradient-to-r from-blue-50 to-indigo-50 border-b">
                    <h3 class="text-lg font-semibold text-gray-900">🏷️ Laporan per Kategori</h3>
                </div>
                <div class="overflow-hidden" style="max-height: 400px; overflow-y: auto;">
                    <table class="w-full table-fixed divide-y divide-gray-200">
                        <thead class="bg-gray-50 sticky top-0">
                            <tr>
                                <th class="w-2/5 px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Kategori</th>
                                <th class="w-1/5 px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Jumlah</th>
                                <th class="w-2/5 px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Total Stok</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200 bg-white">
                            @foreach($laporanKategori as $item)
                            <tr class="hover:bg-gray-50">
                                <td class="px-6 py-4">
                                    <span class="text-sm font-medium text-gray-900 truncate block">{{ $item['nama_kategori'] }}</span>
                                </td>
                                <td class="px-6 py-4">
                                    <span class="text-sm text-gray-900">{{ $item['jumlah_obat'] }} obat</span>
                                </td>
                                <td class="px-6 py-4">
                                    <span class="text-sm font-semibold text-blue-600">{{ number_format($item['total_stok']) }}</span>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Top Stok Terendah -->
            <div class="bg-white rounded-xl shadow-lg overflow-hidden h-fit">
                <div class="px-6 py-4 bg-gradient-to-r from-red-50 to-pink-50 border-b">
                    <h3 class="text-lg font-semibold text-gray-900">⚠️ Top 10 Stok Terendah</h3>
                </div>
                <div class="overflow-hidden" style="max-height: 400px; overflow-y: auto;">
                    <table class="w-full table-fixed divide-y divide-gray-200">
                        <thead class="bg-gray-50 sticky top-0">
                            <tr>
                                <th class="w-2/5 px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Obat</th>
                                <th class="w-2/5 px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Kategori</th>
                                <th class="w-1/5 px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Stok</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200 bg-white">
                            @foreach($topStokRendah as $obat)
                            <tr class="hover:bg-gray-50">
                                <td class="px-6 py-4">
                                    <span class="text-sm font-medium text-gray-900 truncate block">{{ $obat->nama_obat }}</span>
                                </td>
                                <td class="px-6 py-4">
                                    <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full bg-gray-100 text-gray-800">
                                        {{ $obat->kategori->nama_kategori ?? '-' }}
                                    </span>
                                </td>
                                <td class="px-6 py-4">
                                    <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full 
                                        {{ $obat->stok <= 5 ? 'bg-red-100 text-red-800' : 'bg-yellow-100 text-yellow-800' }}">
                                        {{ $obat->stok }}
                                    </span>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Section Expired -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-8">
            <!-- Obat Akan Expired (30 hari) -->
            <div class="bg-white rounded-xl shadow-lg overflow-hidden h-fit">
                <div class="px-6 py-4 bg-gradient-to-r from-yellow-50 to-orange-50 border-b">
                    <h3 class="text-lg font-semibold text-gray-900">⏰ Akan Expired (90 Hari)</h3>
                </div>
                <div class="overflow-hidden" style="max-height: 400px; overflow-y: auto;">
                    @if($obatAkanExpiredSoon->count() > 0)
                        <table class="w-full table-fixed divide-y divide-gray-200">
                            <thead class="bg-gray-50 sticky top-0">
                                <tr>
                                    <th class="w-2/5 px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Obat</th>
                                    <th class="w-1/5 px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Expired</th>
                                    <th class="w-2/5 px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Sisa</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200 bg-white">
                                @foreach($obatAkanExpiredSoon as $obat)
                                    @php
                                        $sisaHari = \Carbon\Carbon::today()->diffInDays($obat->tanggal_expired, false);
                                    @endphp
                                    <tr class="hover:bg-gray-50">
                                        <td class="px-6 py-4">
                                            <span class="text-sm font-medium text-gray-900 truncate block">{{ $obat->nama_obat }}</span>
                                        </td>
                                        <td class="px-6 py-4 text-sm text-gray-500">
                                            {{ $obat->tanggal_expired->format('d/m/Y') }}
                                        </td>
                                        <td class="px-6 py-4">
                                            <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full 
                                                {{ $sisaHari <= 7 ? 'bg-red-100 text-red-800' : 'bg-yellow-100 text-yellow-800' }}">
                                                {{ $sisaHari }} hari
                                            </span>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @else
                        <div class="p-6 text-center">
                            <p class="text-gray-500">Tidak ada obat yang akan expired dalam 30 hari</p>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Top Stok Tertinggi -->
            <div class="bg-white rounded-xl shadow-lg overflow-hidden h-fit">
                <div class="px-6 py-4 bg-gradient-to-r from-green-50 to-emerald-50 border-b">
                    <h3 class="text-lg font-semibold text-gray-900">📈 Top 10 Stok Tertinggi</h3>
                </div>
                <div class="overflow-hidden" style="max-height: 400px; overflow-y: auto;">
                    <table class="w-full table-fixed divide-y divide-gray-200">
                        <thead class="bg-gray-50 sticky top-0">
                            <tr>
                                <th class="w-2/5 px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Obat</th>
                                <th class="w-2/5 px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Kategori</th>
                                <th class="w-1/5 px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Stok</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200 bg-white">
                            @foreach($topStokTinggi as $obat)
                            <tr class="hover:bg-gray-50">
                                <td class="px-6 py-4">
                                    <span class="text-sm font-medium text-gray-900 truncate block">{{ $obat->nama_obat }}</span>
                                </td>
                                <td class="px-6 py-4">
                                    <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full bg-gray-100 text-gray-800">
                                        {{ $obat->kategori->nama_kategori ?? '-' }}
                                    </span>
                                </td>
                                <td class="px-6 py-4">
                                    <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full bg-green-100 text-green-800">
                                        {{ number_format($obat->stok) }}
                                    </span>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Footer Laporan -->
        <div class="bg-white rounded-xl shadow-lg p-6 mb-8">
            <div class="text-center">
                <p class="text-gray-600 text-sm">
                    Laporan dibuat pada {{ Carbon\Carbon::now()->format('d F Y, H:i:s') }} WIB
                </p>
                <p class="text-gray-500 text-xs mt-1">
                    Sistem Manajemen Obat - {{ config('app.name', 'Laravel') }}
                </p>
            </div>
        </div>
    </div>

    <!-- Scripts for Charts -->
    <script>
        // Chart Kategori (Doughnut)
        const ctxKategori = document.getElementById('chartKategori').getContext('2d');
        const chartKategori = new Chart(ctxKategori, {
            type: 'doughnut',
            data: {
                labels: @json($chartKategori['labels']),
                datasets: [{
                    label: 'Jumlah Obat',
                    data: @json($chartKategori['jumlah_obat']),
                    backgroundColor: [
                        '#3B82F6', '#10B981', '#F59E0B', '#EF4444', '#8B5CF6',
                        '#06B6D4', '#84CC16', '#F97316', '#EC4899', '#6B7280'
                    ],
                    borderWidth: 2,
                    borderColor: '#ffffff'
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        position: 'bottom',
                        labels: {
                            padding: 20,
                            usePointStyle: true
                        }
                    }
                }
            }
        });

        // Chart Bulanan (Line)
        const ctxBulanan = document.getElementById('chartBulanan').getContext('2d');
        const chartBulanan = new Chart(ctxBulanan, {
            type: 'line',
            data: {
                labels: @json($chartBulanan['labels'] ?? []),
                datasets: [{
                    label: 'Obat Masuk',
                    data: @json($chartBulanan['data'] ?? []),
                    borderColor: '#10B981',
                    backgroundColor: 'rgba(16, 185, 129, 0.1)',
                    borderWidth: 3,
                    fill: true,
                    tension: 0.4,
                    pointBackgroundColor: '#10B981',
                    pointBorderColor: '#ffffff',
                    pointBorderWidth: 2,
                    pointRadius: 5
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: false
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        grid: {
                            color: '#E5E7EB'
                        }
                    },
                    x: {
                        grid: {
                            color: '#E5E7EB'
                        }
                    }
                }
            }
        });
    </script>

    <script src="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.js"></script>
</body>
</html>