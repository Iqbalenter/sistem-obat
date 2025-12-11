<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Obat</title>
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

        @if ($errors->any())
            <div class="mb-4 mt-14 p-4 text-red-800 border border-red-300 rounded-lg bg-red-50" role="alert">
                <ul class="list-disc list-inside">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        
        <div class="mt-14">
            <!-- Welcome Header -->
            <div class="mb-8">
                <h1 class="text-3xl font-bold text-gray-900 mb-2">💊 Manajemen Data Obat</h1>
                <p class="text-gray-600">Kelola semua data obat dalam sistem farmasi Anda</p>
            </div>

            <!-- Statistics Cards -->
            <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
                <div class="bg-blue-600 rounded-lg shadow-lg p-6 text-white">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-blue-100 text-sm font-medium">Total Obat</p>
                            <p class="text-3xl font-bold">{{ $obats->total() }}</p>
                        </div>
                        <div class="bg-blue-500 rounded-full p-3">
                            <svg class="w-8 h-8 text-blue-100" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 8.172V5L8 4z"/>
                            </svg>
                        </div>
                    </div>
                </div>

                <div class="bg-green-600 rounded-lg shadow-lg p-6 text-white">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-green-100 text-sm font-medium">Stok Normal</p>
                            <p class="text-3xl font-bold">{{ $obats->where('stok', '>', 10)->count() }}</p>
                        </div>
                        <div class="bg-green-500 rounded-full p-3">
                            <svg class="w-8 h-8 text-green-100" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                        </div>
                    </div>
                </div>

                <div class="bg-yellow-600 rounded-lg shadow-lg p-6 text-white">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-yellow-100 text-sm font-medium">Stok Rendah</p>
                            <p class="text-3xl font-bold">{{ $obats->where('stok', '<=', 10)->count() }}</p>
                        </div>
                        <div class="bg-yellow-500 rounded-full p-3">
                            <svg class="w-8 h-8 text-yellow-100" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.664-.833-2.464 0L4.34 16.5c-.77.833.192 2.5 1.732 2.5z"/>
                            </svg>
                        </div>
                    </div>
                </div>

                <div class="bg-purple-600 rounded-lg shadow-lg p-6 text-white">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-purple-100 text-sm font-medium">Total Stok</p>
                            <p class="text-3xl font-bold">{{ number_format($obats->sum('stok')) }}</p>
                        </div>
                        <div class="bg-purple-500 rounded-full p-3">
                            <svg class="w-8 h-8 text-purple-100" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
                            </svg>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Main Content Card -->
            <div class="bg-white rounded-lg shadow-lg">
                <!-- Header with Add Button + Search -->
                <div class="flex gap-3 p-6 border-b border-gray-200 flex-row items-center justify-between">
                    <div>
                        <h2 class="text-xl font-bold text-gray-900">📋 Daftar Obat</h2>
                        <p class="text-gray-600 text-sm">Kelola data obat Anda dengan mudah</p>
                    </div>
                    <div class="flex flex-col gap-2 sm:flex-row sm:items-center sm:gap-3 w-full lg:w-auto">
                        <form action="{{ route('obat.index') }}" method="GET" class="w-full sm:w-80">
                            <label for="search" class="sr-only">Cari obat</label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                    <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-4.35-4.35m0 0A7.5 7.5 0 1010.5 18.5c1.93 0 3.68-.71 5-1.85z"></path>
                                    </svg>
                                </div>
                                <input type="text" id="search" name="search" value="{{ $search ?? '' }}"
                                       class="bg-white border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 pr-10 py-2.5"
                                       placeholder="Cari nama obat...">
                                @if(!empty($search))
                                    <a href="{{ route('obat.index') }}" class="absolute inset-y-0 right-0 flex items-center pr-5 text-gray-400 hover:text-gray-600">
                                        ✕
                                    </a>
                                @endif
                            </div>
                        </form>
                        @if(Auth::user()->isAdmin() || Auth::user()->isPegawai())
                        <button data-modal-target="add-obat-modal" data-modal-toggle="add-obat-modal" 
                                class="inline-flex items-center justify-center gap-2 text-white bg-gradient-to-r from-blue-500 to-blue-600 hover:from-blue-600 hover:to-blue-700 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 shadow-md transition-all duration-200">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                            </svg>
                            Tambah Obat
                        </button>
                        @else
                        <div class="text-sm text-gray-500 bg-gray-100 px-4 py-2 rounded-lg">
                            <span class="font-medium">Mode Lihat Saja</span>
                            <p class="text-xs">Anda dapat melihat dan mencari data</p>
                        </div>
                        @endif
                    </div>
                </div>

                <!-- Informasi Sistem Slot Container -->
                <div class="mb-4 p-4 bg-gradient-to-r from-blue-50 to-indigo-50 border border-blue-200 rounded-lg">
                    <div class="flex items-center">
                        <div class="flex-shrink-0">
                            <svg class="w-5 h-5 text-blue-600" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"/>
                            </svg>
                        </div>
                        <div class="ml-3">
                            <p class="text-sm text-blue-800">
                                <span class="font-medium">Sistem Slot Container:</span> 
                                Setiap halaman menampilkan obat dalam slot 1-20. Setiap block berisi maksimal 20 slot container untuk memudahkan pengelolaan lokasi obat.
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Table -->
                <div class="p-6">
                    <div class="overflow-x-auto">
                        <table class="w-full text-sm text-left text-gray-500">
                            <thead class="text-xs text-gray-700 uppercase bg-gradient-to-r from-gray-50 to-gray-100">
                                <tr>
                                    <th scope="col" class="px-6 py-4 font-bold">Slot Container</th>
                                    <th scope="col" class="px-6 py-4 font-bold">Gambar</th>
                                    <th scope="col" class="px-6 py-4 font-bold">Nama Obat</th>
                                    <th scope="col" class="px-6 py-4 font-bold">Kategori</th>
                                    <th scope="col" class="px-6 py-4 font-bold">Supplier</th>
                                    <th scope="col" class="px-6 py-4 font-bold">Tanggal Masuk</th>
                                    <th scope="col" class="px-6 py-4 font-bold">Tanggal Expired</th>
                                    <th scope="col" class="px-6 py-4 font-bold">Stok</th>
                                    <th scope="col" class="px-6 py-4 font-bold">Status</th>
                                    <th scope="col" class="px-6 py-4 font-bold">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @forelse($obats as $index => $obat)
                                <tr class="hover:bg-gray-50 transition-colors duration-200">
                                    <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                                        <span class="bg-gradient-to-r from-purple-100 to-purple-200 text-purple-800 px-3 py-1 rounded-full text-xs font-bold">
                                            Slot {{ (($loop->iteration - 1) % 20) + 1 }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4">
                                        @if($obat->gambar)
                                            <img src="{{ asset('storage/' . $obat->gambar) }}" 
                                                 alt="{{ $obat->nama_obat }}" 
                                                 class="w-16 h-16 object-cover rounded-lg shadow-md border border-gray-200 hover:scale-110 transition-transform duration-200 cursor-pointer"
                                                 onclick="showImageModal('{{ asset('storage/' . $obat->gambar) }}', '{{ $obat->nama_obat }}')">
                                        @else
                                            <div class="w-16 h-16 bg-gray-200 rounded-lg flex items-center justify-center">
                                                <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                                </svg>
                                            </div>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 font-medium text-gray-900">{{ $obat->nama_obat }}</td>
                                    <td class="px-6 py-4">
                                        <span class="bg-gradient-to-r from-blue-100 to-blue-200 text-blue-800 text-xs font-medium px-3 py-1 rounded-full">
                                            {{ $obat->kategori->nama_kategori ?? 'Kategori Tidak Ditemukan' }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4">
                                        <span class="bg-gradient-to-r from-purple-100 to-purple-200 text-purple-800 text-xs font-medium px-3 py-1 rounded-full">
                                            {{ $obat->supplier->nama_supplier ?? '-' }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 text-gray-600">{{ $obat->tanggal_masuk->format('d/m/Y') }}</td>
                                    <td class="px-6 py-4 text-gray-600">{{ $obat->tanggal_expired->format('d/m/Y') }}</td>
                                    <td class="px-6 py-4">
                                        <span class="font-bold text-lg {{ $obat->stok <= 10 ? 'text-red-600' : 'text-green-600' }}">
                                            {{ $obat->stok }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4">
                                        @php
                                            $today = now();
                                            $expired = $obat->tanggal_expired;
                                            $diffInDays = $today->diffInDays($expired, false);
                                        @endphp
                                        
                                        @if($obat->status === 'dimusnahkan')
                                            <span class="bg-red-100 text-red-800 text-xs font-bold px-3 py-1 rounded-full">Dimusnahkan</span>
                                        @elseif($obat->status === 'dikembalikan')
                                            <span class="bg-purple-100 text-purple-800 text-xs font-bold px-3 py-1 rounded-full">Dikembalikan</span>
                                        @else
                                            @if($diffInDays < 0)
                                                <span class="bg-gradient-to-r from-red-100 to-red-200 text-red-800 text-xs font-bold px-3 py-1 rounded-full">
                                                    💀 Expired (Dipertahankan)
                                                </span>
                                            @elseif($diffInDays <= 30)
                                                <span class="bg-gradient-to-r from-yellow-100 to-yellow-200 text-yellow-800 text-xs font-bold px-3 py-1 rounded-full">
                                                    ⚠️ Akan Expired (Dipertahankan)
                                                </span>
                                            @else
                                                <span class="bg-gradient-to-r from-green-100 to-green-200 text-green-800 text-xs font-bold px-3 py-1 rounded-full">
                                                    ✅ Normal (Dipertahankan)
                                                </span>
                                            @endif
                                        @endif
                                    </td>
                                    <td class="px-6 py-4">
                                        @if(Auth::user()->isAdmin() || Auth::user()->isPegawai())
                                        <div class="flex space-x-2">
                                            <button data-modal-target="edit-obat-modal-{{ $obat->id }}" data-modal-toggle="edit-obat-modal-{{ $obat->id }}"
                                                    class="bg-blue-100 hover:bg-blue-200 text-blue-700 p-2 rounded-lg transition-all duration-200 transform hover:scale-110">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                                </svg>
                                            </button>
                                            <button data-modal-target="delete-obat-modal-{{ $obat->id }}" data-modal-toggle="delete-obat-modal-{{ $obat->id }}"
                                                    class="bg-red-100 hover:bg-red-200 text-red-700 p-2 rounded-lg transition-all duration-200 transform hover:scale-110">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                                </svg>
                                            </button>
                                        </div>
                                        @else
                                        <div class="text-center">
                                            <span class="text-xs text-gray-400 bg-gray-100 px-3 py-1 rounded-full">
                                                👁️ Mode Lihat
                                            </span>
                                        </div>
                                        @endif
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="10" class="px-6 py-12 text-center">
                                        <div class="flex flex-col items-center">
                                            <svg class="w-16 h-16 text-gray-400 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                            </svg>
                                            <p class="text-gray-500 text-lg font-medium">Belum ada data obat</p>
                                            <p class="text-gray-400 text-sm">Klik tombol "Tambah Obat" untuk menambahkan data pertama</p>
                                        </div>
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <!-- Pagination -->
                    @if($obats->hasPages())
                        <div class="mt-6 flex justify-center">
                            <div class="bg-white border border-gray-200 rounded-lg shadow-sm">
                                {{ $obats->links() }}
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    @if(Auth::user()->isAdmin() || Auth::user()->isPegawai())
    <!-- Add Modal -->
    <div id="add-obat-modal" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
        <div class="relative p-4 w-full max-w-4xl max-h-full">
            <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                        Tambah Obat Baru
                    </h3>
                    <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-toggle="add-obat-modal">
                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                        </svg>
                    </button>
                </div>
                <form class="p-4 md:p-5" action="{{ route('obat.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="grid gap-4 mb-4 grid-cols-2">
                        <div class="col-span-2">
                            <label for="nama_obat" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nama Obat</label>
                            <input type="text" name="nama_obat" id="nama_obat" 
                                   class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" 
                                   placeholder="Masukkan nama obat" required>
                        </div>
                        <div class="col-span-2">
                            <label for="gambar" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                📷 Gambar Obat <span class="text-gray-500 text-xs">(Opsional, Max: 2MB)</span>
                            </label>
                            <div class="flex items-center justify-center w-full">
                                <label for="gambar" class="flex flex-col items-center justify-center w-full h-32 border-2 border-gray-300 border-dashed rounded-lg cursor-pointer bg-gray-50 hover:bg-gray-100">
                                    <div class="flex flex-col items-center justify-center pt-5 pb-6">
                                        <svg class="w-8 h-8 mb-2 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"></path>
                                        </svg>
                                        <p class="mb-1 text-sm text-gray-500"><span class="font-semibold">Klik untuk upload</span> atau drag & drop</p>
                                        <p class="text-xs text-gray-500">PNG, JPG, JPEG, GIF, WEBP (MAX. 2MB)</p>
                                    </div>
                                    <input id="gambar" name="gambar" type="file" class="hidden" accept="image/*" onchange="previewImage(event, 'preview-add')" />
                                </label>
                            </div>
                            <div id="preview-add" class="mt-2 hidden">
                                <img src="" alt="Preview" class="w-full h-48 object-cover rounded-lg border border-gray-300">
                            </div>
                        </div>
                        <div>
                            <label for="kategori_id" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Kategori</label>
                            <select name="kategori_id" id="kategori_id" 
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" required>
                                <option value="">Pilih Kategori</option>
                                @foreach($kategoris as $kategori)
                                    <option value="{{ $kategori->id }}">{{ $kategori->nama_kategori }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div>
                            <label for="supplier_id" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Supplier</label>
                            <select name="supplier_id" id="supplier_id" 
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                                <option value="">Pilih Supplier (opsional)</option>
                                @foreach($suppliers as $supplier)
                                    <option value="{{ $supplier->id }}">{{ $supplier->nama_supplier }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div>
                            <label for="stok" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Stok</label>
                            <input type="number" name="stok" id="stok" min="0"
                                   class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" 
                                   placeholder="0" required>
                        </div>
                        <div>
                            <label for="tanggal_masuk" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Tanggal Masuk</label>
                            <input type="date" name="tanggal_masuk" id="tanggal_masuk" 
                                   class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" 
                                   required>
                        </div>
                        <div>
                            <label for="tanggal_expired" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Tanggal Expired</label>
                            <input type="date" name="tanggal_expired" id="tanggal_expired" 
                                   class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" 
                                   required>
                        </div>
                    </div>
                    <button type="submit" class="text-white inline-flex items-center bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                        <svg class="me-1 -ms-1 w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z" clip-rule="evenodd"></path></svg>
                        Tambah Obat
                    </button>
                </form>
            </div>
        </div>
    </div>

    <!-- Edit Modals -->
    @foreach($obats as $obat)
    <div id="edit-obat-modal-{{ $obat->id }}" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
        <div class="relative p-4 w-full max-w-4xl max-h-full">
            <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                        Edit Obat
                    </h3>
                    <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-toggle="edit-obat-modal-{{ $obat->id }}">
                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                        </svg>
                    </button>
                </div>
                <form class="p-4 md:p-5" action="{{ route('obat.update', $obat->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="grid gap-4 mb-4 grid-cols-2">
                        <div class="col-span-2">
                            <label for="nama_obat_edit_{{ $obat->id }}" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nama Obat</label>
                            <input type="text" name="nama_obat" id="nama_obat_edit_{{ $obat->id }}" 
                                   value="{{ $obat->nama_obat }}"
                                   class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" 
                                   placeholder="Masukkan nama obat" required>
                        </div>
                        <div class="col-span-2">
                            <label for="gambar_edit_{{ $obat->id }}" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                📷 Gambar Obat <span class="text-gray-500 text-xs">(Opsional, Max: 2MB)</span>
                            </label>
                            @if($obat->gambar)
                            <div class="mb-3">
                                <p class="text-xs text-gray-600 mb-1">Gambar saat ini:</p>
                                <img src="{{ asset('storage/' . $obat->gambar) }}" alt="Current" class="w-32 h-32 object-cover rounded-lg border border-gray-300">
                            </div>
                            @endif
                            <div class="flex items-center justify-center w-full">
                                <label for="gambar_edit_{{ $obat->id }}" class="flex flex-col items-center justify-center w-full h-32 border-2 border-gray-300 border-dashed rounded-lg cursor-pointer bg-gray-50 hover:bg-gray-100">
                                    <div class="flex flex-col items-center justify-center pt-5 pb-6">
                                        <svg class="w-8 h-8 mb-2 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"></path>
                                        </svg>
                                        <p class="mb-1 text-sm text-gray-500"><span class="font-semibold">Klik untuk upload gambar baru</span></p>
                                        <p class="text-xs text-gray-500">PNG, JPG, JPEG, GIF, WEBP (MAX. 2MB)</p>
                                    </div>
                                    <input id="gambar_edit_{{ $obat->id }}" name="gambar" type="file" class="hidden" accept="image/*" onchange="previewImage(event, 'preview-edit-{{ $obat->id }}')" />
                                </label>
                            </div>
                            <div id="preview-edit-{{ $obat->id }}" class="mt-2 hidden">
                                <img src="" alt="Preview" class="w-full h-48 object-cover rounded-lg border border-gray-300">
                            </div>
                        </div>
                        <div>
                            <label for="kategori_id_edit_{{ $obat->id }}" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Kategori</label>
                            <select name="kategori_id" id="kategori_id_edit_{{ $obat->id }}" 
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" required>
                                <option value="">Pilih Kategori</option>
                                @foreach($kategoris as $kategori)
                                    <option value="{{ $kategori->id }}" {{ $obat->kategori_id == $kategori->id ? 'selected' : '' }}>
                                        {{ $kategori->nama_kategori }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div>
                            <label for="supplier_id_edit_{{ $obat->id }}" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Supplier</label>
                            <select name="supplier_id" id="supplier_id_edit_{{ $obat->id }}" 
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                                <option value="">Pilih Supplier (opsional)</option>
                                @foreach($suppliers as $supplier)
                                    <option value="{{ $supplier->id }}" {{ $obat->supplier_id == $supplier->id ? 'selected' : '' }}>
                                        {{ $supplier->nama_supplier }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div>
                            <label for="stok_edit_{{ $obat->id }}" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Stok</label>
                            <input type="number" name="stok" id="stok_edit_{{ $obat->id }}" min="0"
                                   value="{{ $obat->stok }}"
                                   class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" 
                                   placeholder="0" required>
                        </div>
                        <div>
                            <label for="tanggal_masuk_edit_{{ $obat->id }}" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Tanggal Masuk</label>
                            <input type="date" name="tanggal_masuk" id="tanggal_masuk_edit_{{ $obat->id }}" 
                                   value="{{ $obat->tanggal_masuk->format('Y-m-d') }}"
                                   class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" 
                                   required>
                        </div>
                        <div>
                            <label for="tanggal_expired_edit_{{ $obat->id }}" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Tanggal Expired</label>
                            <input type="date" name="tanggal_expired" id="tanggal_expired_edit_{{ $obat->id }}" 
                                   value="{{ $obat->tanggal_expired->format('Y-m-d') }}"
                                   class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-505 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" 
                                   required>
                        </div>
                    </div>
                    <button type="submit" class="text-white inline-flex items-center bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                        <svg class="me-1 -ms-1 w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z" clip-rule="evenodd"></path></svg>
                        Update Obat
                    </button>
                </form>
            </div>
        </div>
    </div>

    <!-- Delete Modal -->
    <div id="delete-obat-modal-{{ $obat->id }}" tabindex="-1" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
        <div class="relative p-4 w-full max-w-md max-h-full">
            <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                <button type="button" class="absolute top-3 end-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="delete-obat-modal-{{ $obat->id }}">
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                    </svg>
                </button>
                <div class="p-6 text-center">
                    <svg class="mx-auto mb-4 text-gray-400 w-12 h-12 dark:text-gray-200" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 11V6m0 8h.01M19 10a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"/>
                    </svg>
                    <h3 class="mb-5 text-lg font-normal text-gray-500 dark:text-gray-400">Apakah Anda yakin ingin menghapus obat "{{ $obat->nama_obat }}"?</h3>
                    <form action="{{ route('obat.destroy', $obat->id) }}" method="POST" class="inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="text-white bg-red-600 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 dark:focus:ring-red-800 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center me-2">
                            Ya, Hapus!
                        </button>
                    </form>
                    <button data-modal-hide="delete-obat-modal-{{ $obat->id }}" type="button" class="text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-gray-200 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">
                        Batal
                    </button>
                </div>
            </div>
        </div>
    </div>
    @endforeach
    @endif

    <!-- Modal Zoom Gambar -->
    <div id="image-modal" class="hidden fixed inset-0 z-50 items-center justify-center bg-black/80" onclick="closeImageModal()">
        <div class="relative max-w-4xl max-h-full p-4">
            <button onclick="closeImageModal()" class="absolute top-2 right-2 text-white bg-red-600 hover:bg-red-700 rounded-full p-2 z-10">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                </svg>
            </button>
            <img id="modal-image" src="" alt="" class="max-w-full max-h-screen object-contain rounded-lg">
            <p id="modal-title" class="text-white text-center mt-2 text-lg font-semibold"></p>
        </div>
    </div>

    <script>
        // Preview image sebelum upload
        function previewImage(event, previewId) {
            const file = event.target.files[0];
            const preview = document.getElementById(previewId);
            const img = preview.querySelector('img');
            
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    img.src = e.target.result;
                    preview.classList.remove('hidden');
                }
                reader.readAsDataURL(file);
            } else {
                preview.classList.add('hidden');
            }
        }

        // Show image modal zoom
        function showImageModal(imageSrc, title) {
            const modal = document.getElementById('image-modal');
            const modalImage = document.getElementById('modal-image');
            const modalTitle = document.getElementById('modal-title');
            
            modalImage.src = imageSrc;
            modalTitle.textContent = title;
            modal.classList.remove('hidden');
            modal.classList.add('flex');
        }

        // Close image modal
        function closeImageModal() {
            const modal = document.getElementById('image-modal');
            modal.classList.add('hidden');
            modal.classList.remove('flex');
        }
    </script>

    <script src="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.js"></script>
</body>
</html>