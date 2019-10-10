<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PermissionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	$menus = ['Pembelian', 'Hutang', 'Supplier', 'Penjualan', 'Piutang', 'Customer', 'Pembayaran Piutang', 'Pembayaran Hutang', 'Pembayaran Piutang', 'Barang', 'Karyawan', 'Pengguna', 'Kendaraan', 'Komponen', 'Jabatan', 'Enkripsi', 'Hak Akses', 'Backup'];
    	$actions = ["Index", "Create", "Detail", "Edit", "Delete"];
    	$specials = ['Beranda', 'Laporan Penjualan', 'Laporan Pembelian', 'Laporan Kinerja Karyawan', 'Laporan Laba Rugi'];

    	for ($i=0; $i < count($menus); $i++) { 
    		for ($x=0; $x < count($actions); $x++) { 
    			$permission = $actions[$x]." ".$menus[$i];
    			$data[] = [
    				"name" => $permission,
    				"slug" => str_slug($permission),
    			];
    		}
    	}

    	for ($y=0; $y < count($specials); $y++) { 
			$special_permission = "Index ".$specials[$y];
    		$data[] = 
    		[
				"name" => $special_permission,
				"slug" => str_slug($special_permission),
			];
    	}

        DB::table('permissions')->truncate();
        DB::table('permissions')->insert($data);
    }
}
