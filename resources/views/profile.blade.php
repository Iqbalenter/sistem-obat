<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Profile User | {{ $user->name }}</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link rel="stylesheet" href="{{ asset('css/custom.css') }}">
  <script src="https://cdn.jsdelivr.net/npm/flowbite@2.4.1/dist/flowbite.min.js"></script>
</head>
<body>
  <!-- Include Aside Navbar -->
  <x-aside_navbar />

  <!-- Main Content -->
  <div class="p-4 sm:ml-64">
    <div class="p-4 rounded-lg mt-14">
      
      <!-- Header -->
      <div class="mb-6">
        <h1 class="text-2xl font-bold text-gray-900 mb-2">
          <svg class="w-8 h-8 inline-block mr-2 text-blue-600" fill="currentColor" viewBox="0 0 20 20">
            <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd"/>
          </svg>
          Profile User
        </h1>
        <p class="text-gray-600">Kelola informasi profile dan akun Anda</p>
      </div>

      <!-- Alert Success -->
      @if(session('success'))
        <div class="mb-6 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
          <strong class="font-bold">Berhasil!</strong>
          <span class="block sm:inline">{{ session('success') }}</span>
        </div>
      @endif

      <!-- Profile Card -->
      <div class="bg-white rounded-lg shadow-lg overflow-hidden">
        <div class="bg-gradient-to-r from-blue-500 to-purple-600 px-6 py-8">
          <div class="flex items-center">
            <div class="bg-white rounded-full p-3 mr-4">
              <svg class="w-12 h-12 text-blue-600" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd"/>
              </svg>
            </div>
            <div class="text-white">
              <h2 class="text-2xl font-bold">{{ $user->name }}</h2>
              <p class="text-blue-100">{{ ucfirst($user->role) }}</p>
            </div>
          </div>
        </div>

        <div class="p-6">
          <!-- Profile Form -->
          <form action="{{ route('profile.update') }}" method="POST" class="space-y-6">
            @csrf
            @method('PUT')

            <!-- Informasi Akun -->
            <div>
              <h3 class="text-lg font-semibold text-gray-900 mb-4 flex items-center">
                <svg class="w-5 h-5 mr-2 text-blue-600" fill="currentColor" viewBox="0 0 20 20">
                  <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-6-3a2 2 0 11-4 0 2 2 0 014 0zm-2 4a5 5 0 00-4.546 2.916A5.986 5.986 0 0010 16a5.986 5.986 0 004.546-2.084A5 5 0 0010 11z" clip-rule="evenodd"/>
                </svg>
                Informasi Akun
              </h3>

              <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Nama Lengkap -->
                <div>
                  <label for="name" class="block text-sm font-medium text-gray-700 mb-2">Nama Lengkap</label>
                  <input type="text" 
                         id="name" 
                         name="name" 
                         value="{{ old('name', $user->name) }}"
                         class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition duration-200"
                         required>
                  @error('name')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                  @enderror
                </div>

                                 <!-- Username -->
                 <div>
                   <label for="username" class="block text-sm font-medium text-gray-700 mb-2">Username</label>
                   <input type="text" 
                          id="username" 
                          name="username" 
                          value="{{ old('username', $user->username) }}"
                          class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition duration-200"
                          required>
                   @error('username')
                     <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                   @enderror
                 </div>

                <!-- Role (Read Only) -->
                <div>
                  <label for="role" class="block text-sm font-medium text-gray-700 mb-2">Role</label>
                  <input type="text" 
                         id="role" 
                         value="{{ ucfirst($user->role) }}"
                         class="w-full px-4 py-3 bg-gray-100 border border-gray-300 rounded-lg cursor-not-allowed"
                         readonly>
                  <p class="mt-1 text-xs text-gray-500">Role tidak dapat diubah oleh user</p>
                </div>

                <!-- Member Since -->
                <div>
                  <label for="created_at" class="block text-sm font-medium text-gray-700 mb-2">Bergabung Sejak</label>
                  <input type="text" 
                         id="created_at" 
                         value="{{ $user->created_at->format('d M Y') }}"
                         class="w-full px-4 py-3 bg-gray-100 border border-gray-300 rounded-lg cursor-not-allowed"
                         readonly>
                </div>
              </div>
            </div>

            <!-- Ubah Password -->
            <div class="border-t pt-6">
              <h3 class="text-lg font-semibold text-gray-900 mb-4 flex items-center">
                <svg class="w-5 h-5 mr-2 text-blue-600" fill="currentColor" viewBox="0 0 20 20">
                  <path fill-rule="evenodd" d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z" clip-rule="evenodd"/>
                </svg>
                Ubah Password
              </h3>
              <p class="text-sm text-gray-600 mb-4">Kosongkan jika tidak ingin mengubah password</p>

              <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Password Baru -->
                <div>
                  <label for="password" class="block text-sm font-medium text-gray-700 mb-2">Password Baru</label>
                  <input type="password" 
                         id="password" 
                         name="password"
                         class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition duration-200"
                         placeholder="Masukkan password baru">
                  @error('password')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                  @enderror
                </div>

                <!-- Konfirmasi Password -->
                <div>
                  <label for="password_confirmation" class="block text-sm font-medium text-gray-700 mb-2">Konfirmasi Password</label>
                  <input type="password" 
                         id="password_confirmation" 
                         name="password_confirmation"
                         class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition duration-200"
                         placeholder="Konfirmasi password baru">
                </div>
              </div>
            </div>

            <!-- Button Actions -->
            <div class="flex justify-end space-x-4 pt-6 border-t">
              <a href="/" 
                 class="px-6 py-3 bg-gray-300 text-gray-700 rounded-lg hover:bg-gray-400 transition duration-200 font-medium">
                Batal
              </a>
              <button type="submit" 
                      class="px-6 py-3 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition duration-200 font-medium flex items-center">
                <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20">
                  <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                </svg>
                Simpan Perubahan
              </button>
            </div>
          </form>
        </div>
      </div>

      <!-- Statistics Card -->
      <div class="mt-8 grid grid-cols-1 md:grid-cols-3 gap-6">
        <div class="bg-white rounded-lg shadow p-6">
          <div class="flex items-center">
            <div class="bg-blue-100 rounded-full p-3 mr-4">
              <svg class="w-6 h-6 text-blue-600" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd"/>
              </svg>
            </div>
            <div>
              <h4 class="text-lg font-semibold text-gray-900">Bergabung</h4>
              <p class="text-gray-600">{{ $user->created_at->diffForHumans() }}</p>
            </div>
          </div>
        </div>

        <div class="bg-white rounded-lg shadow p-6">
          <div class="flex items-center">
            <div class="bg-green-100 rounded-full p-3 mr-4">
              <svg class="w-6 h-6 text-green-600" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
              </svg>
            </div>
            <div>
              <h4 class="text-lg font-semibold text-gray-900">Status</h4>
              <p class="text-green-600 font-medium">Aktif</p>
            </div>
          </div>
        </div>

        <div class="bg-white rounded-lg shadow p-6">
          <div class="flex items-center">
            <div class="bg-purple-100 rounded-full p-3 mr-4">
              <svg class="w-6 h-6 text-purple-600" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-6-3a2 2 0 11-4 0 2 2 0 014 0zm-2 4a5 5 0 00-4.546 2.916A5.986 5.986 0 0010 16a5.986 5.986 0 004.546-2.084A5 5 0 0010 11z" clip-rule="evenodd"/>
              </svg>
            </div>
            <div>
              <h4 class="text-lg font-semibold text-gray-900">Role</h4>
              <p class="text-purple-600 font-medium">{{ ucfirst($user->role) }}</p>
            </div>
          </div>
        </div>
      </div>

    </div>
  </div>

  <script>
    // Auto hide success alert after 3 seconds
    setTimeout(function() {
      const alert = document.querySelector('[role="alert"]');
      if (alert) {
        alert.style.transition = 'opacity 0.5s ease-out';
        alert.style.opacity = '0';
        setTimeout(() => alert.remove(), 500);
      }
    }, 3000);
  </script>
</body>
</html> 