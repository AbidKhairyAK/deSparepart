<?php
  $menus = [
    [
      'name' => 'Pembelian', 'icon' => 'sign-in-alt', 'child' => [
        ['name' => 'Tambah Pembelian', 'link' => '/pembelian/create'],
        ['name' => 'Daftar Pembelian', 'link' => '/pembelian'],
        ['name' => 'Daftar Hutang', 'link' => '/hutang'],
        ['name' => 'Daftar Pemasok', 'link' => '/pemasok'],
      ],
    ],
    [
      'name' => 'Penjualan', 'icon' => 'sign-out-alt', 'child' => [
        ['name' => 'Tambah Penjualan', 'link' => '/penjualan/create'],
        ['name' => 'Daftar Penjualan', 'link' => '/penjualan'],
        ['name' => 'Daftar Piutang', 'link' => '/piutang'],
        ['name' => 'Daftar Pelanggan', 'link' => '/pelanggan'],
      ],
    ],
    [
      'name' => 'Pembayaran', 'icon' => 'money-bill-wave', 'child' => [
        ['name' => 'Pembayaran Piutang', 'link' => '/pembayaran-piutang/create'],
        ['name' => 'Daftar Nota Piutang', 'link' => '/pembayaran-piutang'],
        ['name' => 'Pembayaran Hutang', 'link' => '/pembayaran-hutang/create'],
        ['name' => 'Daftar Nota Hutang', 'link' => '/pembayaran-hutang'],
      ],
    ],
    [
      'name' => 'Barang', 'icon' => 'cubes', 'child' => [
        ['name' => 'Tambah Barang', 'link' => '/barang/create'],
        ['name' => 'Daftar Barang', 'link' => '/barang'],
        // ['name' => 'Edit Harga Barang', 'link' => '/barang/multiedit'],
      ],
    ],
    [
      'name' => 'Pengguna', 'icon' => 'users', 'child' => [
        ['name' => 'Tambah Karyawan', 'link' => '/karyawan/create'],
        ['name' => 'Daftar Karyawan', 'link' => '/karyawan'],
        ['name' => 'Tambah Pengguna', 'link' => '/pengguna/create'],
        ['name' => 'Daftar Pengguna', 'link' => '/pengguna'],
        // ['name' => 'Daftar Penjual', 'link' => '/penjual'],
      ],
    ],
    [
      'name' => 'Kendaraan & Komponen', 'icon' => 'car', 'child' => [
        ['name' => 'Tambah Kendaraan', 'link' => '/kendaraan/create'],
        ['name' => 'Daftar Kendaraan', 'link' => '/kendaraan'],
        ['name' => 'Tambah Komponen / Part', 'link' => '/komponen/create'],
        ['name' => 'Daftar Komponen / Part', 'link' => '/komponen'],
      ],
    ],
    [
      'name' => 'Laporan', 'icon' => 'file-invoice-dollar', 'child' => [
        ['name' => 'Laporan Penjualan', 'link' => '/laporan-penjualan'],
        ['name' => 'Laporan Pembelian', 'link' => '/laporan-pembelian'],
        ['name' => 'Laporan Kinerja Karyawan', 'link' => '/laporan-kinerja-karyawan'],
        ['name' => 'Laporan Laba Rugi', 'link' => '/laporan-laba-rugi'],
      ],
    ],
    [
      'name' => 'Pengaturan', 'icon' => 'cog', 'child' => [
        ['name' => 'Daftar Jabatan', 'link' => '/jabatan'],
        ['name' => 'Daftar Hak Akses', 'link' => '/hak-akses'],
        ['name' => 'Enkripsi Angka', 'link' => '/enkripsi'],
        ['name' => 'Backup & Restore', 'link' => '/backup'],
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
            <a class="collapse-item" href="{{ url($child['link']) }}">{{ $child['name'] }}</a>
          @endforeach
        </div>
      </div>
    </li>
  @endforeach

  <!-- Divider -->
  <hr class="sidebar-divider d-none d-md-block">

  <!-- Sidebar Toggler (Sidebar) -->
  <div class="text-center d-none d-md-inline">
    <button class="rounded-circle border-0" id="sidebarToggle"></button>
  </div>

</ul>
<!-- End of Sidebar -->