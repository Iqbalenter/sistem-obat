<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Supplier</title>
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
                <h1 class="text-3xl font-bold text-gray-900 mb-2">🚛 Manajemen Data Supplier</h1>
                <p class="text-gray-600">Kelola informasi supplier untuk rantai pasokan farmasi Anda</p>
            </div>

            

            <!-- Main Content Card -->
            <div class="bg-white rounded-lg shadow-lg">
                <!-- Header with Add Button -->
                <div class="flex justify-between items-center p-6 border-b border-gray-200">
                    <div>
                        <h2 class="text-xl font-bold text-gray-900">📇 Daftar Supplier</h2>
                        <p class="text-gray-600 text-sm">Kelola informasi supplier dan kontak mereka</p>
                    </div>
                    <button data-modal-target="add-supplier-modal" data-modal-toggle="add-supplier-modal" 
                            class="text-white bg-gradient-to-r from-cyan-500 to-cyan-600 hover:from-cyan-600 hover:to-cyan-700 focus:ring-4 focus:outline-none focus:ring-cyan-300 font-medium rounded-lg text-sm px-6 py-3 text-center shadow-lg transition-all duration-300 transform hover:scale-105">
                        <svg class="w-4 h-4 mr-2 inline" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                        </svg>
                        Tambah Supplier
                    </button>
                </div>

                <!-- Table -->
                <div class="p-6">
                    <div class="overflow-x-auto">
                        <table class="w-full text-sm text-left text-gray-500">
                            <thead class="text-xs text-gray-700 uppercase bg-gradient-to-r from-gray-50 to-gray-100">
                                <tr>
                                    <th scope="col" class="px-6 py-4 font-bold">No</th>
                                    <th scope="col" class="px-6 py-4 font-bold">Nama Supplier</th>
                                    <th scope="col" class="px-6 py-4 font-bold">No Telepon</th>
                                    <th scope="col" class="px-6 py-4 font-bold">Alamat</th>
                                    <th scope="col" class="px-6 py-4 font-bold">Tanggal Dibuat</th>
                                    <th scope="col" class="px-6 py-4 font-bold">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @forelse($suppliers as $index => $supplier)
                                <tr class="hover:bg-gray-50 transition-colors duration-200">
                                    <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                                        <span class="bg-cyan-100 text-cyan-800 px-3 py-1 rounded-full text-xs font-bold">
                                            {{ ($suppliers->currentPage() - 1) * $suppliers->perPage() + $index + 1 }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 font-medium text-gray-900">
                                        <div class="flex items-center">
                                            <div class="w-12 h-12 bg-gradient-to-r from-cyan-100 to-cyan-200 rounded-full flex items-center justify-center mr-4">
                                                <span class="text-cyan-600 font-bold text-lg">{{ substr($supplier->nama_supplier, 0, 1) }}</span>
                                            </div>
                                            <div>
                                                <div class="font-semibold text-gray-900">{{ $supplier->nama_supplier }}</div>
                                                <div class="text-xs text-gray-500">Partner Supplier</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4">
                                        <div class="flex items-center">
                                            <svg class="w-4 h-4 text-green-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                                            </svg>
                                            <span class="bg-gradient-to-r from-green-100 to-green-200 text-green-800 text-xs font-medium px-3 py-1 rounded-full">
                                                {{ $supplier->no_telepon }}
                                            </span>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 max-w-xs">
                                        <div class="flex items-start">
                                            <svg class="w-4 h-4 text-gray-400 mr-2 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                                            </svg>
                                            <div class="text-gray-600 text-sm leading-relaxed" title="{{ $supplier->alamat }}">
                                                {{ Str::limit($supplier->alamat, 60) }}
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 text-gray-600">
                                        <div class="flex flex-col">
                                            <span class="font-medium">{{ $supplier->created_at->format('d/m/Y') }}</span>
                                            <span class="text-xs text-gray-400">{{ $supplier->created_at->format('H:i') }} WIB</span>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4">
                                        <div class="flex space-x-2">
                                            <button data-modal-target="edit-supplier-modal-{{ $supplier->id }}" data-modal-toggle="edit-supplier-modal-{{ $supplier->id }}"
                                                    class="bg-blue-100 hover:bg-blue-200 text-blue-700 p-2 rounded-lg transition-all duration-200 transform hover:scale-110">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                                </svg>
                                            </button>
                                            <button data-modal-target="delete-supplier-modal-{{ $supplier->id }}" data-modal-toggle="delete-supplier-modal-{{ $supplier->id }}"
                                                    class="bg-red-100 hover:bg-red-200 text-red-700 p-2 rounded-lg transition-all duration-200 transform hover:scale-110">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                                </svg>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="6" class="px-6 py-12 text-center">
                                        <div class="flex flex-col items-center">
                                            <svg class="w-16 h-16 text-gray-400 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                                            </svg>
                                            <p class="text-gray-500 text-lg font-medium">Belum ada data supplier</p>
                                            <p class="text-gray-400 text-sm">Klik tombol "Tambah Supplier" untuk menambahkan supplier pertama</p>
                                        </div>
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <!-- Pagination -->
                    @if($suppliers->hasPages())
                        <div class="mt-6 flex justify-center">
                            <div class="bg-white border border-gray-200 rounded-lg shadow-sm">
                                {{ $suppliers->links() }}
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <!-- Add Modal -->
    <div id="add-supplier-modal" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
        <div class="relative p-4 w-full max-w-4xl max-h-full">
            <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                        Tambah Supplier Baru
                    </h3>
                    <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-toggle="add-supplier-modal">
                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                        </svg>
                    </button>
                </div>
                <form class="p-4 md:p-5" action="{{ route('supplier.store') }}" method="POST">
                    @csrf
                    <div class="grid gap-4 mb-4 grid-cols-1">
                        <div>
                            <label for="nama_supplier" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nama Supplier</label>
                            <input type="text" name="nama_supplier" id="nama_supplier" 
                                   class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" 
                                   placeholder="Masukkan nama supplier" required>
                        </div>
                        <div>
                            <label for="no_telepon" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">No Telepon</label>
                            <input type="text" name="no_telepon" id="no_telepon" 
                                   class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" 
                                   placeholder="Masukkan no telepon" required>
                        </div>
                        <div>
                            <label for="alamat" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Alamat</label>
                            <textarea name="alamat" id="alamat" rows="3"
                                      class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" 
                                      placeholder="Masukkan alamat lengkap" required></textarea>
                        </div>
                    </div>
                    <button type="submit" class="text-white inline-flex items-center bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                        <svg class="me-1 -ms-1 w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z" clip-rule="evenodd"></path></svg>
                        Tambah Supplier
                    </button>
                </form>
            </div>
        </div>
    </div>

    <!-- Edit Modals -->
    @foreach($suppliers as $supplier)
    <div id="edit-supplier-modal-{{ $supplier->id }}" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
        <div class="relative p-4 w-full max-w-4xl max-h-full">
            <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                        Edit Supplier
                    </h3>
                    <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-toggle="edit-supplier-modal-{{ $supplier->id }}">
                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                        </svg>
                    </button>
                </div>
                <form class="p-4 md:p-5" action="{{ route('supplier.update', $supplier->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="grid gap-4 mb-4 grid-cols-1">
                        <div>
                            <label for="nama_supplier_edit_{{ $supplier->id }}" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nama Supplier</label>
                            <input type="text" name="nama_supplier" id="nama_supplier_edit_{{ $supplier->id }}" 
                                   value="{{ $supplier->nama_supplier }}"
                                   class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" 
                                   placeholder="Masukkan nama supplier" required>
                        </div>
                        <div>
                            <label for="no_telepon_edit_{{ $supplier->id }}" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">No Telepon</label>
                            <input type="text" name="no_telepon" id="no_telepon_edit_{{ $supplier->id }}" 
                                   value="{{ $supplier->no_telepon }}"
                                   class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" 
                                   placeholder="Masukkan no telepon" required>
                        </div>
                        <div>
                            <label for="alamat_edit_{{ $supplier->id }}" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Alamat</label>
                            <textarea name="alamat" id="alamat_edit_{{ $supplier->id }}" rows="3"
                                      class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" 
                                      placeholder="Masukkan alamat lengkap" required>{{ $supplier->alamat }}</textarea>
                        </div>
                    </div>
                    <button type="submit" class="text-white inline-flex items-center bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                        <svg class="me-1 -ms-1 w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z" clip-rule="evenodd"></path></svg>
                        Update Supplier
                    </button>
                </form>
            </div>
        </div>
    </div>

    <!-- Delete Modal -->
    <div id="delete-supplier-modal-{{ $supplier->id }}" tabindex="-1" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
        <div class="relative p-4 w-full max-w-md max-h-full">
            <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                <button type="button" class="absolute top-3 end-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="delete-supplier-modal-{{ $supplier->id }}">
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                    </svg>
                </button>
                <div class="p-6 text-center">
                    <svg class="mx-auto mb-4 text-gray-400 w-12 h-12 dark:text-gray-200" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 11V6m0 8h.01M19 10a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"/>
                    </svg>
                    <h3 class="mb-5 text-lg font-normal text-gray-500 dark:text-gray-400">Apakah Anda yakin ingin menghapus supplier "{{ $supplier->nama_supplier }}"?</h3>
                    <form action="{{ route('supplier.destroy', $supplier->id) }}" method="POST" class="inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="text-white bg-red-600 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 dark:focus:ring-red-800 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center me-2">
                            Ya, Hapus!
                        </button>
                    </form>
                    <button data-modal-hide="delete-supplier-modal-{{ $supplier->id }}" type="button" class="text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-gray-200 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">
                        Batal
                    </button>
                </div>
            </div>
        </div>
    </div>
    @endforeach

    <script src="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.js"></script>
</body>
</html>