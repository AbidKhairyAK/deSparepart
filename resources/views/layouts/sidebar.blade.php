<?php
  $menus = [
    [
      'name' => 'Pembelian', 'icon' => 'sign-in-alt', 'child' => [
        ['name' => 'Tambah Pembelian', 'link' => '/pembelian/create', 'perm' => 'create-pembelian'],
        ['name' => 'Daftar Pembelian', 'link' => '/pembelian', 'perm' => 'index-pembelian'],
        ['name' => 'Daftar Hutang', 'link' => '/hutang', 'perm' => 'index-hutang'],
        ['name' => 'Daftar Supplier', 'link' => '/supplier', 'perm' => 'index-supplier'],
      ],
    ],
    [
      'name' => 'Penjualan', 'icon' => 'sign-out-alt', 'child' => [
        ['name' => 'Tambah Penjualan', 'link' => '/penjualan/create', 'perm' => 'create-penjualan'],
        ['name' => 'Daftar Penjualan', 'link' => '/penjualan', 'perm' => 'index-penjualan'],
        ['name' => 'Daftar Piutang', 'link' => '/piutang', 'perm' => 'index-piutang'],
        ['name' => 'Daftar Customer', 'link' => '/customer', 'perm' => 'index-customer'],
        ['name' => 'Daftar Retur Penjualan', 'link' => '/retur-penjualan', 'perm' => 'index-retur-penjualan'],
      ],
    ],
    [
      'name' => 'Pembayaran', 'icon' => 'money-bill-wave', 'child' => [
        ['name' => 'Pembayaran Piutang', 'link' => '/pembayaran-piutang/create', 'perm' => 'create-pembayaran-piutang'],
        ['name' => 'Daftar Nota Piutang', 'link' => '/pembayaran-piutang', 'perm' => 'index-pembayaran-piutang'],
        ['name' => 'Pembayaran Hutang', 'link' => '/pembayaran-hutang/create', 'perm' => 'create-pembayaran-hutang'],
        ['name' => 'Daftar Nota Hutang', 'link' => '/pembayaran-hutang', 'perm' => 'index-pembayaran-hutang'],
      ],
    ],
    [
      'name' => 'Barang', 'icon' => 'cubes', 'child' => [
        ['name' => 'Tambah Barang', 'link' => '/barang/create', 'perm' => 'create-barang'],
        ['name' => 'Daftar Barang', 'link' => '/barang', 'perm' => 'index-barang'],
        // ['name' => 'Edit Harga Barang', 'link' => '/barang/multiedit', 'perm' => 'index-pembelian'],
      ],
    ],
    [
      'name' => 'Pengguna', 'icon' => 'users', 'child' => [
        ['name' => 'Tambah Karyawan', 'link' => '/karyawan/create', 'perm' => 'create-karyawan'],
        ['name' => 'Daftar Karyawan', 'link' => '/karyawan', 'perm' => 'index-karyawan'],
        ['name' => 'Tambah Pengguna', 'link' => '/pengguna/create', 'perm' => 'create-pengguna'],
        ['name' => 'Daftar Pengguna', 'link' => '/pengguna', 'perm' => 'index-pengguna'],
        // ['name' => 'Daftar Penjual', 'link' => '/penjual', 'perm' => 'index-pembelian'],
      ],
    ],
    [
      'name' => 'Kendaraan & Komponen', 'icon' => 'car', 'child' => [
        ['name' => 'Tambah Kendaraan', 'link' => '/kendaraan/create', 'perm' => 'create-kendaraan'],
        ['name' => 'Daftar Kendaraan', 'link' => '/kendaraan', 'perm' => 'index-kendaraan'],
        ['name' => 'Tambah Komponen / Part', 'link' => '/komponen/create', 'perm' => 'create-komponen'],
        ['name' => 'Daftar Komponen / Part', 'link' => '/komponen', 'perm' => 'index-komponen'],
      ],
    ],
    [
      'name' => 'Laporan', 'icon' => 'file-invoice-dollar', 'child' => [
        ['name' => 'Laporan Penjualan', 'link' => '/laporan-penjualan', 'perm' => 'index-laporan-penjualan'],
        ['name' => 'Laporan Pembelian', 'link' => '/laporan-pembelian', 'perm' => 'index-laporan-pembelian'],
        ['name' => 'Laporan Kinerja Karyawan', 'link' => '/laporan-kinerja-karyawan', 'perm' => 'index-laporan-kinerja-karyawan'],
        ['name' => 'Laporan Laba Rugi', 'link' => '/laporan-laba-rugi', 'perm' => 'index-laporan-laba-rugi'],
      ],
    ],
    [
      'name' => 'Pengaturan', 'icon' => 'cog', 'child' => [
        ['name' => 'Daftar Jabatan', 'link' => '/jabatan', 'perm' => 'index-jabatan'],
        ['name' => 'Daftar Hak Akses', 'link' => '/hak-akses', 'perm' => 'index-hak-akses'],
        ['name' => 'Enkripsi Angka', 'link' => '/enkripsi', 'perm' => 'index-enkripsi'],
        ['name' => 'Backup & Restore', 'link' => '/backup', 'perm' => 'index-backup'],
      ],
    ],
  ];
?>

<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-secondary sidebar sidebar-dark accordion toggled" id="accordionSidebar">

  <!-- Sidebar - Brand -->
  <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
    <!-- <div class="sidebar-brand-icon" style="transform: rotateY(180deg) rotate(-45deg);">
      <i class="fas fa-plane" style="font-size: 29px;"></i>
    </div> -->
    <div class="sidebar-brand-icon" style="transform: rotateY(180deg)">
      <i class="fas fa-tools mt-2" style="font-size: 29px;"></i>
    </div>
    <div class="sidebar-brand-text mx-2"><sub>Sparepart</sub><p class="m-0">Otomotif</p></div>
  </a>

  <!-- Divider -->
  <hr class="sidebar-divider">

  <!-- Heading -->
  <div class="sidebar-heading">
    Daftar Menu
  </div>

  <!-- Nav Item - Dashboard -->
  <li class="nav-item">
    <a class="nav-link" href="{{ url('/') }}">
      <i class="fas fa-fw fa-home"></i>
      <span>Beranda</span></a>
  </li>

  @foreach($menus as $index => $menu)
    @php
      $checkChild = false;
      foreach($menu['child'] as $child) {
        if(!empty(auth()->user()) && auth()->user()->can($child['perm'])) {
          $checkChild = true;
        }
      }
    @endphp
    @if($checkChild)
      <!-- Nav Item -->
      <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#menu{{ $index }}">
          <i class="fas fa-fw fa-{{ $menu['icon'] }}"></i>
          <span>{{ $menu['name'] }}</span>
        </a>
        <div id="menu{{ $index }}" class="collapse" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">{{ $menu['name'] }}</h6>
            @foreach($menu['child'] as $child)
              @if(!empty(auth()->user()) && auth()->user()->can($child['perm']))
                <a class="collapse-item" href="{{ url($child['link']) }}"><i class="fas fa-{{ strpos($child['link'], 'create') ? 'plus' : 'list' }} text-black-50"></i> {{ $child['name'] }}</a>
              @endif
            @endforeach
          </div>
        </div>
      </li>
    @endif
  @endforeach

  <!-- Divider -->
  <hr class="sidebar-divider d-none d-md-block">

  <!-- Sidebar Toggler (Sidebar) -->
  <div class="text-center d-none d-md-inline">
    <button class="rounded-circle border-0" id="sidebarToggle"></button>
  </div>

</ul>
<!-- End of Sidebar -->