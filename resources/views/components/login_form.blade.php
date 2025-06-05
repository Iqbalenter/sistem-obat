<form action="{{ route('login.authenticate') }}" method="POST" class="max-w-sm mx-auto">
  @csrf
  <div class="mb-5">
    <label for="username" class="block mb-2 text-sm font-medium text-gray-900">Username</label>
    <input type="text" id="username" name="username" class="bg-green-50 border border-green-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2.5" placeholder="Masukkan username" value="{{ old('username') }}" required />
    @error('username')
      <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
    @enderror
  </div>
  <div class="mb-5">
    <label for="password" class="block mb-2 text-sm font-medium text-gray-900">Password</label>
    <input type="password" id="password" name="password" class="bg-green-50 border border-green-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2.5" required />
    @error('password')
      <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
    @enderror
  </div>
  <div class="flex items-start mb-5">
    <div class="flex items-center h-5">
      <input id="remember" name="remember" type="checkbox" value="1" class="w-4 h-4 border border-green-300 rounded-sm bg-green-50 focus:ring-3 focus:ring-green-300" />
    </div>
    <label for="remember" class="ms-2 text-sm font-medium text-gray-900">Remember me</label>
  </div>
  <div class="flex items-center justify-center mb-5">
    <button type="submit" class="text-white bg-green-800 hover:bg-green-900 focus:ring-4 focus:outline-none focus:ring-green-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center">Submit</button>
  </div>
  <div class="flex items-center justify-center">
    <a href="/register" class="text-sm underline text-gray-400 hover:text-gray-900">Buat Akun</a>
  </div>
</form>
