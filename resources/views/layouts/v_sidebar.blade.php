 <div class="leftside-menu">

     <!-- LOGO -->
     <a href="/" class="logo text-center logo-light">
         <span class="logo-lg">
             <img src="{{ asset('template') }}/assets/images/logo/logo-ayam.png" alt="" height="67px">
         </span>
         <span class="logo-sm">
             <img src="{{ asset('template') }}/assets/images/logo/logo-ayam.png" alt="" height="67px">
         </span>
     </a>

     <!-- LOGO -->
     <a href="/" class="logo text-center logo-dark">
         <span class="logo-lg">
             <img src="{{ asset('template') }}/assets/images/logo-dark.png" alt="" height="16">
         </span>
         <span class="logo-sm">
             <img src="{{ asset('template') }}/assets/images/logo_sm_dark.png" alt="" height="16">
         </span>
     </a>

     <div class="h-100" id="leftside-menu-container" data-simplebar>

         <!--- Sidemenu -->
         {{-- Admin --}}

         <ul class="side-nav">

             <li class="side-nav-item active">
                 <a href="/admin/home" class="side-nav-link">
                     <i class="uil-home-alt"></i>
                     <span> Dashboards </span>
                 </a>
             </li>
             <li class="side-nav-title side-nav-item">Menu Master</li>
             <li class="side-nav-item">
                 <a data-bs-toggle="collapse" href="#sidebarTasks" aria-expanded="false" aria-controls="sidebarTasks"
                     class="side-nav-link">
                     <i class="uil-key-skeleton-alt"></i>
                     <span>Menu Master </span>
                     <span class="menu-arrow"></span>
                 </a>
                 <div class="collapse" id="sidebarTasks">
                     <ul class="side-nav-second-level">
                         <li>
                             <a href="/pembeli">Pembeli</a>
                         </li>
                         <li>
                             <a href="/produk_ayam">Produk Ayam</a>
                         </li>
                         <li>
                             <a href="/karyawan">Karyawan</a>
                         </li>
                     </ul>
                 </div>
             </li>
             <li class="side-nav-title side-nav-item">Transaksi</li>
             <li class="side-nav-item">
                 <a data-bs-toggle="collapse" href="#transaksi" aria-expanded="false" aria-controls="sidebarTasks"
                     class="side-nav-link">
                     <i class='uil uil-money-withdrawal'></i>
                     <span>Transaksi</span>
                     <span class="menu-arrow"></span>
                 </a>
                 <div class="collapse" id="transaksi">
                     <ul class="side-nav-second-level">
                         <li>
                             <a href="/transaksi_pembeli">Transaksi Pembeli</a>
                         </li>
                     </ul>
                 </div>
             </li>
             <li class="side-nav-title side-nav-item">Pengiriman</li>
             <li class="side-nav-item">
                 <a data-bs-toggle="collapse" href="#pengiriman" aria-expanded="false" aria-controls="sidebarTasks"
                     class="side-nav-link">
                     <i class='mdi mdi-truck-fast-outline'></i>
                     <span>Pengiriman</span>
                     <span class="menu-arrow"></span>
                 </a>
                 <div class="collapse" id="pengiriman">
                     <ul class="side-nav-second-level">
                         <li>
                             <a href="/pengiriman_barang">Pengiriman Barang</a>
                         </li>
                     </ul>
                 </div>
             </li>
             <li class="side-nav-title side-nav-item">Laporan</li>
             <li class="side-nav-item">
                 <a data-bs-toggle="collapse" href="#lap" aria-expanded="false" aria-controls="sidebarTasks"
                     class="side-nav-link">
                     <i class='mdi mdi-calendar-sync-outline'></i>
                     <span>Laporan</span>
                     <span class="menu-arrow"></span>
                 </a>
                 <div class="collapse" id="lap">
                     <ul class="side-nav-second-level">
                         <li>
                             <a href="/laporan">Laporan</a>
                         </li>
                     </ul>
                 </div>
             </li>
         </ul>

         <!-- End Sidebar -->

         <div class="clearfix"></div>

     </div>
     <!-- Sidebar -left -->

 </div>
