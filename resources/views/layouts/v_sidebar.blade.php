 <div class="leftside-menu">

     <!-- LOGO -->
     <a href="index.html" class="logo text-center logo-light">
         <span class="logo-lg">
             <img src="{{ asset('template') }}/assets/images/logo.png" alt="" height="16">
         </span>
         <span class="logo-sm">
             <img src="{{ asset('template') }}/assets/images/logo_sm.png" alt="" height="16">
         </span>
     </a>

     <!-- LOGO -->
     <a href="index.html" class="logo text-center logo-dark">
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
                 <a href="/" class="side-nav-link">
                     <i class="uil-home-alt"></i>
                     <span> Dashboards </span>
                 </a>
             </li>
             <li class="side-nav-title side-nav-item">Master Data Target</li>
             <li class="side-nav-item">
                 <a data-bs-toggle="collapse" href="#sidebarTasks" aria-expanded="false" aria-controls="sidebarTasks"
                     class="side-nav-link">
                     <i class="uil-key-skeleton-alt"></i>
                     <span>Master Data Target </span>
                     <span class="menu-arrow"></span>
                 </a>
                 <div class="collapse" id="sidebarTasks">
                     <ul class="side-nav-second-level">
                         <li>
                             <a href="/rekening">Daftar Rekening</a>
                         </li>
                         <li>
                             <a href="/data_target">Data Target</a>
                         </li>
                     </ul>
                 </div>
             </li>


             <li class="side-nav-title side-nav-item">Entry Transaksi Harian</li>
             <li class="side-nav-item active">
                 <a href="/trans_harian" class="side-nav-link">
                     <i class="uil-book-medical"></i>
                     <span> Entry Transaksi Harian </span>
                 </a>
             </li>
         </ul>

         <!-- End Sidebar -->

         <div class="clearfix"></div>

     </div>
     <!-- Sidebar -left -->

 </div>
