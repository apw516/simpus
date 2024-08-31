<!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-light-teal elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link bg-teal">
      <img src="{{ asset('public/adminlte/dist/img/AdminLTELogo.png')}}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">SIMPUS</span>
    </a>
    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="{{ asset('public/adminlte/dist/img/user2-160x160.jpg') }}" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block">{{ strtoupper(auth()->user()->nama)}}</a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <li class="nav-item">
            <a href="{{ route('dashboard')}}" class="nav-link @if($menu == 'dashboard') active @endif">
              <i class="nav-icon fas fa-th"></i>
              <p>
                Dashboard
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ route('dashboard')}}" class="nav-link @if($menu == 'displayantrian') active @endif">
              <i class="nav-icon fas fa-th"></i>
              <p>
                Display Antrian
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ route('dashboard')}}" class="nav-link @if($menu == 'jadwaldokter') active @endif">
              <i class="nav-icon fas fa-th"></i>
              <p>
                Jadwal Dokter
              </p>
            </a>
          </li>
          <li class="nav-header">REKAMEDIS</li>
          <li class="nav-item">
            <a href="{{ route('pendaftaran')}}" class="nav-link @if($menu == 'pendaftaran') active @endif">
              <i class="nav-icon far fa-image"></i>
              <p>
                Pendaftaran
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ route('riwayatpelayanan')}}" class="nav-link @if($menu == 'riwayat_pelayanan') active @endif">
              <i class="nav-icon far fa-image"></i>
              <p>
                Riwayat Pelayanan
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ route('masterpasien')}}" class="nav-link @if($menu == 'masterpasien') active @endif">
              <i class="nav-icon far fa-image"></i>
              <p>
                Master Pasien
              </p>
            </a>
          </li>
          <li class="nav-header">Dokter</li>
          <li class="nav-item">
            <a href="{{ route('indexdokter')}}" class="nav-link @if($menu == 'indexdokter') active @endif">
              <i class="nav-icon far fa-image"></i>
              <p>
                Data Pasien
              </p>
            </a>
          </li>
          <li class="nav-header">Kasir</li>
          <li class="nav-item">
            <a href="{{ route('indexkasir')}}" class="nav-link @if($menu == 'kasir') active @endif">
              <i class="nav-icon far fa-image"></i>
              <p>
                Data Pasien
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ route('masteruser')}}" class="nav-link @if($menu == '') active @endif">
              <i class="nav-icon far fa-image"></i>
              <p>
                Riwayat Pembayaran
              </p>
            </a>
          </li>
          <li class="nav-header">Farmasi</li>
          <li class="nav-item">
            <a href="{{ route('masteruser')}}" class="nav-link @if($menu == '') active @endif">
              <i class="nav-icon far fa-image"></i>
              <p>
                Data Order Farmasi
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ route('masterobat')}}" class="nav-link @if($menu == 'masterobat') active @endif">
              <i class="nav-icon far fa-image"></i>
              <p>
                Master & Stok Obat
              </p>
            </a>
          </li>
          <li class="nav-header">MANAGEMEN</li>
          <li class="nav-item">
            <a href="{{ route('masterjadwal')}}" class="nav-link @if($menu == 'masterjadwal') active @endif">
              <i class="nav-icon far bi bi-calendar-week-fill"></i>
              <p>
                Master Jadwal Poliklinik
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ route('masterpegawai')}}" class="nav-link @if($menu == 'masterpegawai') active @endif">
              <i class="nav-icon far bi bi-person-square"></i>
              <p>
                Master Pegawai
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ route('masteruser')}}" class="nav-link @if($menu == 'masteruser') active @endif">
              <i class="nav-icon far bi bi-person-gear"></i>
              <p>
                Master User
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ route('masterunit')}}" class="nav-link @if($menu == 'masterunit') active @endif">
              <i class="nav-icon fas bi bi-houses"></i>
              <p>
                Master Unit
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ route('mastertarif')}}" class="nav-link @if($menu == 'mastertarif') active @endif">
              <i class="nav-icon fas bi bi-receipt"></i>
              <p>
                Master Tarif
              </p>
            </a>
          </li>
          <li class="nav-header">Akun</li>
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon far bi bi-info-square text-dark"></i>
              <p class="text">Info</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link" onclick="logout()">
              <i class="nav-icon far bi bi-box-arrow-right text-danger"></i>
              <p>Logout</p>
            </a>
          </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>
