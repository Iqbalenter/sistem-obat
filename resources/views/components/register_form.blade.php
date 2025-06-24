<form action="{{ route('register.store') }}" method="POST" class="max-w-sm mx-auto">
  @csrf
  <div class="mb-5">
    <label for="name" class="block mb-2 text-sm font-medium text-gray-900">Nama Lengkap</label>
    <input type="text" id="name" name="name" class="bg-green-50 border border-green-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2.5" placeholder="Masukkan nama lengkap" value="{{ old('name') }}" required />
    @error('name')
      <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
    @enderror
  </div>
  <div class="mb-5">
    <label for="username" class="block mb-2 text-sm font-medium text-gray-900">Username</label>
    <input type="text" id="username" name="username" class="bg-green-50 border border-green-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2.5" placeholder="Masukkan username" value="{{ old('username') }}" required />
    @error('username')
      <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
    @enderror
  </div>
  <div class="mb-5">
    <label for="password" class="block mb-2 text-sm font-medium text-gray-900">Password</label>
    <input type="password" id="password" name="password" class="bg-green-50 border border-green-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2.5" placeholder="Minimal 8 karakter" required />
    @error('password')
      <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
    @enderror
  </div>
  <div class="mb-5">
    <label for="password_confirmation" class="block mb-2 text-sm font-medium text-gray-900">Konfirmasi Password</label>
    <input type="password" id="password_confirmation" name="password_confirmation" class="bg-green-50 border border-green-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2.5" placeholder="Ulangi password" required />
    @error('password_confirmation')
      <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
    @enderror
  </div>
  <div class="mb-5">
    <label for="role" class="block mb-2 text-sm font-medium text-gray-900">Role/Jabatan</label>
    <select id="role" name="role" class="bg-green-50 border border-green-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2.5" required>
      <option value="">Pilih Role</option>
      <option value="admin" {{ old('role') == 'admin' ? 'selected' : '' }}>Admin (Akses Penuh)</option>
      <option value="pegawai" {{ old('role') == 'pegawai' ? 'selected' : '' }}>Pegawai (Akses Terbatas)</option>
    </select>
    @error('role')
      <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
    @enderror
    <p class="mt-1 text-xs text-gray-500">
      <strong>Admin:</strong> Dapat menambah, edit, dan hapus data<br>
      <strong>Pegawai:</strong> Hanya dapat melihat dan mencari data
    </p>
  </div>
  <div class="flex items-center justify-center mb-5">
    <button type="submit" class="text-white bg-green-800 hover:bg-green-900 focus:ring-4 focus:outline-none focus:ring-green-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center">Submit</button>
  </div>
  <div class="flex items-center justify-center">
    <span>Sudah punya akun? <a href="/login" class="text-sm underline text-gray-400 hover:text-gray-900">Login</a></span>
  </div>
</form>
