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
      
      <!-- User Profile & Notification -->
      <div class="flex items-center space-x-3">
        <!-- User Profile Dropdown -->
        <div class="relative">
          <button id="user-profile-button" class="flex items-center text-sm rounded-full focus:ring-4 focus:ring-gray-300 hover:bg-gray-100 transition-all duration-200 p-2" type="button">
            <div class="bg-blue-600 rounded-full p-2 mr-2">
              <svg class="w-5 h-5 text-white" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd"/>
              </svg>
            </div>
            <div class="text-left">
              <div class="text-sm font-medium text-gray-900">{{ Auth::user()->name }}</div>
              <div class="text-xs text-gray-500">{{ ucfirst(Auth::user()->role) }}</div>
            </div>
            <svg class="w-4 h-4 ml-2 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
              <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"/>
            </svg>
          </button>

          <!-- User Profile Dropdown -->
          <div id="user-profile-dropdown" class="hidden absolute right-0 mt-2 w-64 bg-white rounded-lg shadow-lg border border-gray-200 z-50">
            <!-- User Info Header -->
            <div class="px-4 py-3 border-b border-gray-200 bg-gradient-to-r from-blue-50 to-purple-50">
              <div class="flex items-center">
                <div class="bg-blue-600 rounded-full p-2 mr-3">
                  <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd"/>
                  </svg>
                </div>
                <div>
                  <p class="text-sm font-medium text-gray-900">{{ Auth::user()->name }}</p>
                  <p class="text-xs text-gray-500">{{ Auth::user()->username }}</p>
                  <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-blue-100 text-blue-800 mt-1">
                    {{ ucfirst(Auth::user()->role) }}
                  </span>
                </div>
              </div>
            </div>

            <!-- Menu Items -->
            <div class="py-1">
              <a href="/profile" class="flex items-center px-4 py-3 text-sm text-gray-700 hover:bg-gray-100 transition-colors duration-150">
                <svg class="w-4 h-4 mr-3 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                  <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd"/>
                </svg>
                Lihat Profile
              </a>
              <a href="/profile" class="flex items-center px-4 py-3 text-sm text-gray-700 hover:bg-gray-100 transition-colors duration-150">
                <svg class="w-4 h-4 mr-3 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                  <path fill-rule="evenodd" d="M11.49 3.17c-.38-1.56-2.6-1.56-2.98 0a1.532 1.532 0 01-2.286.948c-1.372-.836-2.942.734-2.106 2.106.54.886.061 2.042-.947 2.287-1.561.379-1.561 2.6 0 2.978a1.532 1.532 0 01.947 2.287c-.836 1.372.734 2.942 2.106 2.106a1.532 1.532 0 012.287.947c.379 1.561 2.6 1.561 2.978 0a1.533 1.533 0 012.287-.947c1.372.836 2.942-.734 2.106-2.106a1.533 1.533 0 01.947-2.287c1.561-.379 1.561-2.6 0-2.978a1.532 1.532 0 01-.947-2.287c.836-1.372-.734-2.942-2.106-2.106a1.532 1.532 0 01-2.287-.947zM10 13a3 3 0 100-6 3 3 0 000 6z" clip-rule="evenodd"/>
                </svg>
                Edit Profile
              </a>
              <div class="border-t border-gray-100"></div>
              <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="flex items-center w-full px-4 py-3 text-sm text-red-600 hover:bg-red-50 transition-colors duration-150">
                  <svg class="w-4 h-4 mr-3 text-red-500" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M3 3a1 1 0 00-1 1v12a1 1 0 102 0V4a1 1 0 00-1-1zm10.293 9.293a1 1 0 001.414 1.414l3-3a1 1 0 000-1.414l-3-3a1 1 0 10-1.414 1.414L14.586 9H7a1 1 0 100 2h7.586l-1.293 1.293z" clip-rule="evenodd"/>
                  </svg>
                  Logout
                </button>
              </form>
            </div>
          </div>
        </div>

        <!-- Notification Bell -->
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
              $threeMonthsExpiredCount = \App\Models\Obat::where('tanggal_expired', '>', \Carbon\Carbon::today()->addDays(7))
                                                          ->where('tanggal_expired', '<=', \Carbon\Carbon::today()->addDays(90))
                                                          ->count();
              $totalNotifications = $expiredCount + $soonExpiredCount + $threeMonthsExpiredCount;
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
                    <a href="/obat" class="block px-4 py-3 hover:bg-red-50 border-b border-gray-100 transition-colors duration-150 cursor-pointer">
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
                          <div class="flex items-center mt-1">
                            <svg class="w-3 h-3 text-gray-400 mr-1" fill="currentColor" viewBox="0 0 20 20">
                              <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"/>
                            </svg>
                            <span class="text-xs text-gray-400">Klik untuk detail</span>
                          </div>
                        </div>
                      </div>
                    </a>
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
                    <a href="/obat" class="block px-4 py-3 hover:bg-yellow-50 border-b border-gray-100 transition-colors duration-150 cursor-pointer">
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
                          @php
                            $daysUntilExpired = \Carbon\Carbon::today()->diffInDays($obat->tanggal_expired);
                          @endphp
                          <p class="text-xs text-yellow-500">{{ $daysUntilExpired }} hari lagi</p>
                          <div class="flex items-center mt-1">
                            <svg class="w-3 h-3 text-gray-400 mr-1" fill="currentColor" viewBox="0 0 20 20">
                              <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"/>
                            </svg>
                            <span class="text-xs text-gray-400">Klik untuk detail</span>
                          </div>
                        </div>
                      </div>
                    </a>
                  @endforeach
                @endif

                <!-- Three Months Expired Notifications -->
                @if($threeMonthsExpiredCount > 0)
                  @php
                    $threeMonthsExpiredObats = \App\Models\Obat::with('kategori')
                                                               ->where('tanggal_expired', '>', \Carbon\Carbon::today()->addDays(7))
                                                               ->where('tanggal_expired', '<=', \Carbon\Carbon::today()->addDays(90))
                                                               ->orderBy('tanggal_expired', 'asc')
                                                               ->limit(5)
                                                               ->get();
                  @endphp
                  
                  <div class="px-4 py-2 bg-blue-50 border-b border-blue-100">
                    <h4 class="text-sm font-medium text-blue-800 flex items-center">
                      <span class="w-2 h-2 bg-blue-500 rounded-full mr-2 animate-pulse"></span>
                      Akan Expired (3 bulan) ({{ $threeMonthsExpiredCount }})
                    </h4>
                  </div>
                  
                                     @foreach($threeMonthsExpiredObats as $obat)
                     <a href="/obat" class="block px-4 py-3 hover:bg-blue-50 border-b border-gray-100 transition-colors duration-150 cursor-pointer">
                       <div class="flex items-start space-x-3">
                         <div class="flex-shrink-0">
                           <div class="w-8 h-8 bg-blue-100 rounded-full flex items-center justify-center">
                             <svg class="w-4 h-4 text-blue-600" fill="currentColor" viewBox="0 0 20 20">
                               <path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd"/>
                             </svg>
                           </div>
                         </div>
                         <div class="flex-1 min-w-0">
                           <p class="text-sm font-medium text-gray-900 truncate">{{ $obat->nama_obat }}</p>
                           <p class="text-xs text-gray-500">{{ $obat->kategori->nama_kategori ?? 'Tidak ada kategori' }}</p>
                           <p class="text-xs text-blue-600 font-medium">Expired: {{ $obat->tanggal_expired->format('d M Y') }}</p>
                           <p class="text-xs text-gray-500">Stok: {{ $obat->stok }} unit</p>
                           @php
                             $daysUntilExpired = \Carbon\Carbon::today()->diffInDays($obat->tanggal_expired);
                           @endphp
                           <p class="text-xs text-blue-500">{{ $daysUntilExpired }} hari lagi</p>
                           <div class="flex items-center mt-1">
                             <svg class="w-3 h-3 text-gray-400 mr-1" fill="currentColor" viewBox="0 0 20 20">
                               <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"/>
                             </svg>
                             <span class="text-xs text-gray-400">Klik untuk detail</span>
                           </div>
                         </div>
                       </div>
                     </a>
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
               <span class="ms-3">Beranda Utama</span>
            </a>
         </li>
         <li>
            <button type="button" class="flex items-center w-full p-2 nav-link" aria-controls="dropdown-example" data-collapse-toggle="dropdown-example">
                  <span class="flex-1 ms-3 text-left rtl:text-right whitespace-nowrap">Obat</span>
                  <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                     <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 4 4 4-4"/>
                  </svg>
            </button>
            <ul id="dropdown-example" class="hidden py-2 space-y-2">
                  <li>
                     <a href="/kategori" class="flex items-center w-full p-2 text-gray-900 transition duration-75 rounded-lg pl-11 group nav-link">Jenis Obat</a>
                  </li>
                  <li>
                     <a href="/obat" class="flex items-center w-full p-2 text-gray-900 transition duration-75 rounded-lg pl-11 group nav-link">Daftar Obat</a>
                  </li>
                  <li>
                     <a href="/supplier" class="flex items-center w-full p-2 text-gray-900 transition duration-75 rounded-lg pl-11 group nav-link">Supplier</a>
                  </li>
            </ul>
         </li>
         <li>
            <a href="/expired" class="flex items-center p-2 rounded-lg nav-link">
               <span class="flex-1 ms-3 whitespace-nowrap">Peringatan Kadaluwarsa</span>
            </a>
         </li>
         <li>
            <a href="/pemindahan" class="flex items-center p-2 rounded-lg nav-link">
               <span class="flex-1 ms-3 whitespace-nowrap">Return/Pengelolaan Limbah</span>
            </a>
         </li>
         @if(Auth::user()->isAdmin() || Auth::user()->isPegawai())
         <li>
            <a href="/laporan" class="flex items-center p-2 rounded-lg nav-link">
               <span class="flex-1 ms-3 whitespace-nowrap">Dashboard Laporan</span>
            </a>
         </li>
         @endif
         <li>
            <a href="/persediaan" class="flex items-center p-2 rounded-lg nav-link">
               <span class="flex-1 ms-3 whitespace-nowrap">Persediaan</span>
            </a>
         </li>
         <li>
            <a href="/profile" class="flex items-center p-2 rounded-lg nav-link">
               <span class="flex-1 ms-3 whitespace-nowrap">Info Pengguna</span>
            </a>
         </li>
         <li>
            <span class="flex ms-3 items-center p-2 rounded-lg font-bold underline nav-link">
               Halo, {{ Auth::user()->name ?? 'Nama User' }}
               <span class="text-xs ml-2 px-2 py-1 rounded-full bg-white text-gray-800">
                  {{ ucfirst(Auth::user()->role ?? 'admin') }}
               </span>
            </span>
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

<!-- JavaScript for Dropdowns -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    // User Profile Dropdown
    const profileButton = document.getElementById('user-profile-button');
    const profileDropdown = document.getElementById('user-profile-dropdown');
    
    // Notification Bell Dropdown
    const bellButton = document.getElementById('notification-bell');
    const notificationDropdown = document.getElementById('notification-dropdown');
    
    // Toggle Profile Dropdown
    profileButton.addEventListener('click', function(e) {
        e.stopPropagation();
        profileDropdown.classList.toggle('hidden');
        // Close notification dropdown when opening profile
        if (notificationDropdown) notificationDropdown.classList.add('hidden');
    });
    
    // Toggle Notification Dropdown
    bellButton.addEventListener('click', function(e) {
        e.stopPropagation();
        notificationDropdown.classList.toggle('hidden');
        // Close profile dropdown when opening notification
        if (profileDropdown) profileDropdown.classList.add('hidden');
    });
    
    // Close dropdowns when clicking outside
    document.addEventListener('click', function(e) {
        // Close profile dropdown
        if (profileButton && profileDropdown && 
            !profileButton.contains(e.target) && !profileDropdown.contains(e.target)) {
            profileDropdown.classList.add('hidden');
        }
        
        // Close notification dropdown
        if (bellButton && notificationDropdown && 
            !bellButton.contains(e.target) && !notificationDropdown.contains(e.target)) {
            notificationDropdown.classList.add('hidden');
        }
    });
    
    // Prevent dropdown from closing when clicking inside (except on specific links)
    if (notificationDropdown) {
        notificationDropdown.addEventListener('click', function(e) {
            // If clicked on a notification link, close the dropdown
            if (e.target.closest('a[href="/obat"]') || e.target.closest('a[href="/expired"]')) {
                notificationDropdown.classList.add('hidden');
            } else {
                e.stopPropagation();
            }
        });
    }
    
    if (profileDropdown) {
        profileDropdown.addEventListener('click', function(e) {
            // Close dropdown when clicking on profile links
            if (e.target.closest('a[href="/profile"]')) {
                profileDropdown.classList.add('hidden');
            }
        });
    }
});
</script>