<nav class="fixed top-0 z-50 w-full nav-custom">
  <div class="px-3 py-3 lg:px-5 lg:pl-3">
    <div class="flex items-center justify-between">
      <div class="flex items-center justify-start rtl:justify-end">
        <button data-drawer-target="logo-sidebar" data-drawer-toggle="logo-sidebar" aria-controls="logo-sidebar" type="button" class="inline-flex items-center p-2 text-sm rounded-lg sm:hidden toggle-button focus:outline-none focus:ring-2 focus:ring-gray-200">
            <span class="sr-only">Open sidebar</span>
            <svg class="w-6 h-6" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
               <path clip-rule="evenodd" fill-rule="evenodd" d="M2 4.75A.75.75 0 012.75 4h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 4.75zm0 10.5a.75.75 0 01.75-.75h7.5a.75.75 0 010 1.5h-7.5a.75.75 0 01-.75-.75zM2 10a.75.75 0 01.75-.75h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 10z"></path>
            </svg>
         </button>
        <a href="/" class="flex ms-2 md:me-24">
          <img src="{{ asset('logo-apotek-png-18-1.png') }}" class="h-8 me-3" alt="Logo" />
          <span class="self-center text-xl font-semibold sm:text-2xl whitespace-nowrap brand-text">APOTEK BERKAH JAYA</span>
        </a>
      </div>
      
      <!-- Notification Bell -->
      <div class="flex items-center">
        <div class="relative">
          <button id="notification-bell" class="relative p-2 mr-3 text-gray-600 hover:text-gray-900 focus:outline-none focus:ring-2 focus:ring-gray-300 rounded-lg transition-all duration-200 hover:bg-gray-100">
            <!-- Bell Icon -->
            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
              <path d="M10 2C7.79086 2 6 3.79086 6 6V7.58579C6 8.11622 5.78929 8.62493 5.41421 9L4.58579 9.82843C3.80474 10.6095 4.34869 12 5.41421 12H14.5858C15.6513 12 16.1953 10.6095 15.4142 9.82843L14.5858 9C14.2107 8.62493 14 8.11622 14 7.58579V6C14 3.79086 12.2091 2 10 2Z"/>
              <path d="M8.5 14C8.5 15.3807 9.61929 16.5 11 16.5C12.3807 16.5 13.5 15.3807 13.5 14H8.5Z"/>
            </svg>
            
            <!-- Badge Counter -->
            @php
              $expiredCount = \App\Models\Obat::where('tanggal_expired', '<', \Carbon\Carbon::today())->count();
              $soonExpiredCount = \App\Models\Obat::where('tanggal_expired', '>=', \Carbon\Carbon::today())
                                                  ->where('tanggal_expired', '<=', \Carbon\Carbon::today()->addDays(7))
                                                  ->count();
              $totalNotifications = $expiredCount + $soonExpiredCount;
            @endphp
            
            @if($totalNotifications > 0)
              <span class="absolute -top-1 -right-1 inline-flex items-center justify-center px-2 py-1 text-xs font-bold leading-none text-white transform translate-x-1/2 -translate-y-1/2 bg-red-500 rounded-full animate-pulse">
                {{ $totalNotifications > 99 ? '99+' : $totalNotifications }}
              </span>
            @endif
          </button>

          <!-- Notification Dropdown -->
          <div id="notification-dropdown" class="hidden absolute right-0 mt-2 w-80 bg-white rounded-lg shadow-lg border border-gray-200 z-50">
            <!-- Header -->
            <div class="px-4 py-3 border-b border-gray-200">
              <div class="flex items-center justify-between">
                <h3 class="text-lg font-semibold text-gray-800">🔔 Notifikasi</h3>
                <span class="text-sm text-gray-500">{{ $totalNotifications }} notifikasi</span>
              </div>
            </div>

            <!-- Notification Content -->
            <div class="max-h-96 overflow-y-auto">
              @if($totalNotifications > 0)
                <!-- Expired Notifications -->
                @if($expiredCount > 0)
                  @php
                    $expiredObats = \App\Models\Obat::with('kategori')
                                                    ->where('tanggal_expired', '<', \Carbon\Carbon::today())
                                                    ->orderBy('tanggal_expired', 'desc')
                                                    ->limit(5)
                                                    ->get();
                  @endphp
                  
                  <div class="px-4 py-2 bg-red-50 border-b border-red-100">
                    <h4 class="text-sm font-medium text-red-800 flex items-center">
                      <span class="w-2 h-2 bg-red-500 rounded-full mr-2 animate-pulse"></span>
                      Obat Kadaluarsa ({{ $expiredCount }})
                    </h4>
                  </div>
                  
                  @foreach($expiredObats as $obat)
                    <div class="px-4 py-3 hover:bg-gray-50 border-b border-gray-100 transition-colors duration-150">
                      <div class="flex items-start space-x-3">
                        <div class="flex-shrink-0">
                          <div class="w-8 h-8 bg-red-100 rounded-full flex items-center justify-center">
                            <svg class="w-4 h-4 text-red-600" fill="currentColor" viewBox="0 0 20 20">
                              <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                            </svg>
                          </div>
                        </div>
                        <div class="flex-1 min-w-0">
                          <p class="text-sm font-medium text-gray-900 truncate">{{ $obat->nama_obat }}</p>
                          <p class="text-xs text-gray-500">{{ $obat->kategori->nama_kategori ?? 'Tidak ada kategori' }}</p>
                          <p class="text-xs text-red-600 font-medium">Expired: {{ $obat->tanggal_expired->format('d M Y') }}</p>
                          <p class="text-xs text-gray-500">Stok: {{ $obat->stok }} unit</p>
                        </div>
                      </div>
                    </div>
                  @endforeach
                @endif

                <!-- Soon Expired Notifications -->
                @if($soonExpiredCount > 0)
                  @php
                    $soonExpiredObats = \App\Models\Obat::with('kategori')
                                                        ->where('tanggal_expired', '>=', \Carbon\Carbon::today())
                                                        ->where('tanggal_expired', '<=', \Carbon\Carbon::today()->addDays(7))
                                                        ->orderBy('tanggal_expired', 'asc')
                                                        ->limit(5)
                                                        ->get();
                  @endphp
                  
                  <div class="px-4 py-2 bg-yellow-50 border-b border-yellow-100">
                    <h4 class="text-sm font-medium text-yellow-800 flex items-center">
                      <span class="w-2 h-2 bg-yellow-500 rounded-full mr-2 animate-pulse"></span>
                      Akan Expired (7 hari) ({{ $soonExpiredCount }})
                    </h4>
                  </div>
                  
                  @foreach($soonExpiredObats as $obat)
                    <div class="px-4 py-3 hover:bg-gray-50 border-b border-gray-100 transition-colors duration-150">
                      <div class="flex items-start space-x-3">
                        <div class="flex-shrink-0">
                          <div class="w-8 h-8 bg-yellow-100 rounded-full flex items-center justify-center">
                            <svg class="w-4 h-4 text-yellow-600" fill="currentColor" viewBox="0 0 20 20">
                              <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd"/>
                            </svg>
                          </div>
                        </div>
                        <div class="flex-1 min-w-0">
                          <p class="text-sm font-medium text-gray-900 truncate">{{ $obat->nama_obat }}</p>
                          <p class="text-xs text-gray-500">{{ $obat->kategori->nama_kategori ?? 'Tidak ada kategori' }}</p>
                          <p class="text-xs text-yellow-600 font-medium">Expired: {{ $obat->tanggal_expired->format('d M Y') }}</p>
                          <p class="text-xs text-gray-500">Stok: {{ $obat->stok }} unit</p>
                        </div>
                      </div>
                    </div>
                  @endforeach
                @endif

                <!-- View All Button -->
                <div class="px-4 py-3 bg-gray-50">
                  <a href="/expired" class="w-full inline-flex items-center justify-center px-4 py-2 text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 rounded-md transition-colors duration-150">
                    <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20">
                      <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-8.293l-3-3a1 1 0 00-1.414 0l-3 3a1 1 0 001.414 1.414L9 9.414V13a1 1 0 102 0V9.414l1.293 1.293a1 1 0 001.414-1.414z" clip-rule="evenodd"/>
                    </svg>
                    Lihat Semua Notifikasi
                  </a>
                </div>
              @else
                <!-- No Notifications -->
                <div class="px-4 py-8 text-center">
                  <svg class="w-12 h-12 mx-auto text-gray-400 mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                  </svg>
                  <p class="text-gray-500 text-sm">🎉 Tidak ada obat yang expired!</p>
                  <p class="text-gray-400 text-xs mt-1">Semua obat dalam kondisi baik</p>
                </div>
              @endif
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</nav>

<aside id="logo-sidebar" class="fixed top-0 left-0 z-40 w-64 h-screen pt-20 transition-transform -translate-x-full sm:translate-x-0 sidebar-custom" aria-label="Sidebar">
   <div class="h-full px-3 pb-4 overflow-y-auto">
      <ul class="space-y-2 font-medium">
         <li>
            <a href="/" class="flex items-center p-2 rounded-lg nav-link">
               <span class="ms-3">Dashboard</span>
            </a>
         </li>
         <li>
            <button type="button" class="flex items-center w-full p-2 nav-link" aria-controls="dropdown-example" data-collapse-toggle="dropdown-example">
                  <span class="flex-1 ms-3 text-left rtl:text-right whitespace-nowrap">Master Obat</span>
                  <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                     <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 4 4 4-4"/>
                  </svg>
            </button>
            <ul id="dropdown-example" class="hidden py-2 space-y-2">
                  <li>
                     <a href="/kategori" class="flex items-center w-full p-2 text-gray-900 transition duration-75 rounded-lg pl-11 group nav-link">Kategori</a>
                  </li>
                  <li>
                     <a href="/obat" class="flex items-center w-full p-2 text-gray-900 transition duration-75 rounded-lg pl-11 group nav-link">Obat</a>
                  </li>
                  <li>
                     <a href="/supplier" class="flex items-center w-full p-2 text-gray-900 transition duration-75 rounded-lg pl-11 group nav-link">Supplier</a>
                  </li>
            </ul>
         </li>
         <li>
            <a href="/expired" class="flex items-center p-2 rounded-lg nav-link">
               <span class="flex-1 ms-3 whitespace-nowrap">Notifikasi Expired</span>
            </a>
         </li>
         <li>
            <a href="/laporan" class="flex items-center p-2 rounded-lg nav-link">
               <span class="flex-1 ms-3 whitespace-nowrap">Laporan</span>
            </a>
         </li>
         <li>
            <a href="/persediaan" class="flex items-center p-2 rounded-lg nav-link">
               <span class="flex-1 ms-3 whitespace-nowrap">Persediaan</span>
            </a>
         </li>
         <li>
            <span class="flex ms-3 items-center p-2 rounded-lg font-bold underline nav-link">Halo, {{ Auth::user()->name ?? 'Nama User' }}</span>
         </li>
         <li>
            <form action="{{ route('logout') }}" method="POST">
               @csrf
               <button type="submit" class="flex items-center p-2 rounded-lg nav-link w-full text-left">
                  <span class="flex-1 ms-3 whitespace-nowrap">Logout</span>
               </button>
            </form>
         </li>
      </ul>
   </div>
</aside>

<!-- JavaScript for Notification Bell -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    const bellButton = document.getElementById('notification-bell');
    const dropdown = document.getElementById('notification-dropdown');
    
    bellButton.addEventListener('click', function(e) {
        e.stopPropagation();
        dropdown.classList.toggle('hidden');
    });
    
    // Close dropdown when clicking outside
    document.addEventListener('click', function(e) {
        if (!bellButton.contains(e.target) && !dropdown.contains(e.target)) {
            dropdown.classList.add('hidden');
        }
    });
    
    // Prevent dropdown from closing when clicking inside
    dropdown.addEventListener('click', function(e) {
        e.stopPropagation();
    });
});
</script>