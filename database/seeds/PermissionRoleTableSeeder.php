<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Model\Permission;
use App\Model\Role;

class PermissionRoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('permission_role')->truncate();
        
        $actions = ["Index", "Create", "Detail", "Edit", "Delete"];
        $exceptions = [
        	[],
        	['Jabatan', 'Enkripsi', 'Hak Akses', 'Backup', 'Karyawan', 'Pengguna', 'Beranda', 'Laporan Penjualan', 'Laporan Pembelian', 'Laporan Kinerja Karyawan', 'Laporan Laba Rugi'],
        	['Jabatan', 'Enkripsi', 'Hak Akses', 'Backup', 'Karyawan', 'Pengguna', 'Kendaraan', 'Komponen', 'Barang', 'Beranda', 'Laporan Penjualan', 'Laporan Pembelian', 'Laporan Kinerja Karyawan', 'Laporan Laba Rugi'],
        	['Jabatan', 'Enkripsi', 'Hak Akses', 'Backup', 'Karyawan', 'Pengguna', 'Pembelian', 'Hutang', 'Supplier', 'Penjualan', 'Piutang', 'Customer', 'Pembayaran Piutang', 'Pembayaran Hutang', 'Pembayaran Piutang', 'Karyawan', 'Pengguna', 'Beranda', 'Laporan Penjualan', 'Laporan Pembelian', 'Laporan Kinerja Karyawan', 'Laporan Laba Rugi'],
        ];

    	$excp = [[]];
        foreach ($exceptions as $i => $exception) {
        	foreach ($exception as $x => $menu) {
        		foreach ($actions as $y => $act) {
        			$excp[$i][] = str_slug($act." ".$menu);
        		}
        	}
        	$permissions = Permission::orderBy('id')->whereNotIn('slug', $excp[$i])->pluck('id');
        	Role::find(($i+1))->permissions()->sync($permissions);
        }
    }
}
