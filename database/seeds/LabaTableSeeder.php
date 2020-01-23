<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory;
use App\Model\Inventaris;

class LabaTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
		$this->command->getOutput()->progressStart(1);

	    DB::table('laba')->truncate();

        // perbulan
        $oldest	= DB::table('pembelian')->oldest()->first()->created_at;
        $startM = date('m', strtotime($oldest));
        $endM 	= date('m');
        $startY = date('Y', strtotime($oldest));
        $endY 	= date('Y');

        for ($y=$startY; $y <= $endY; $y++) { 
        	$sM = $y == $startY ? $startM : 1;
        	$eM = $y == $endY ? $endM : 12;

        	for ($m=$sM; $m <= $eM; $m++) { 
        		$this->perbulan($y, $m, $startY, $startM);
        	}

        	$this->pertahun($y, $startY);
        }
		$this->command->getOutput()->progressFinish();

    }

    public function perbulan($y, $m, $startY, $startM)
    {
    	$mo = $m < 10 ? '0'.$m : $m;

		// $total_penjualan	= DB::table('inventaris')->where('tanggal', 'like', "{$y}-{$mo}%")->whereNotNull('penjualan_detail_id')->sum('trx_total');
  //       $total_pembelian    = DB::table('inventaris')->where('tanggal', 'like', "{$y}-{$mo}%")->whereNotNull('pembelian_detail_id')->sum('trx_total');

        $total_penjualan    = DB::table('penjualan')->where('created_at', 'like', "{$y}-{$mo}%")->sum('total');
        $total_pembelian    = DB::table('pembelian')->where('created_at', 'like', "{$y}-{$mo}%")->sum('total');

		$retur_penjualan 	= DB::table('retur_penjualan')->where('created_at', 'like', "{$y}-{$mo}%")->sum('dikembalikan');
		$retur_pembelian	= DB::table('retur_pembelian')->where('created_at', 'like', "{$y}-{$mo}%")->sum('dikembalikan');

		$penjualan_bersih 	= $total_penjualan - $retur_penjualan;
		$pembelian_bersih 	= $total_pembelian - $retur_pembelian;

		$id_barang 			= DB::table('barang')->pluck('id');
		$persediaan_awal 	= 0;
		$persediaan_akhir 	= 0;

		foreach ($id_barang as $idb) {
			$mob = $y == $startY && $mo == $startM ? $mo + 1 : $mo;

			$persediaan_awal += Inventaris::has('inventaris_detail')
										->where('barang_id', $idb)
										->where('tanggal', '<', "{$y}-{$mob}-01 00:00:00")
										->orderBy('tanggal', 'desc')
										->first()
										->inventaris_detail()
										->sum('inv_total');

			$persediaan_akhir += Inventaris::has('inventaris_detail')
										->where('barang_id', $idb)
										->where('tanggal', '<', date('Y-m-t', strtotime("{$y}-{$mob}-01"))." 23:59:59")
										->orderBy('tanggal', 'desc')
										->first()
										->inventaris_detail()
										->sum('inv_total');
		}

		$persediaan_siap_jual	= $pembelian_bersih + $persediaan_awal;
		$hpp 					= $persediaan_siap_jual - $persediaan_akhir;
		$laba_kotor				= $penjualan_bersih - $hpp;

		DB::table('laba')->insert([
			'total_penjualan'		=> $total_penjualan,
			'retur_penjualan'		=> $retur_penjualan,
			'penjualan_bersih'		=> $penjualan_bersih,
			'total_pembelian'		=> $total_pembelian,
			'retur_pembelian'		=> $retur_pembelian,
			'pembelian_bersih'		=> $pembelian_bersih,
			'persediaan_awal'		=> $persediaan_awal,
			'persediaan_siap_jual'	=> $persediaan_siap_jual,
			'persediaan_akhir'		=> $persediaan_akhir,
			'hpp'					=> $hpp,
			'laba_kotor'			=> $laba_kotor,
			'tanggal_awal'			=> $y.'-'.$mo.'-01 00:00:00',
			'tanggal_akhir'			=> date('Y-m-t H:i:s', strtotime($y.'-'.$mo.'-01')),
			'tipe'					=> 'perbulan',
		]);

		$this->command->getOutput()->progressAdvance();
    }

    public function pertahun($y, $startY)
    {
		$total_penjualan	= DB::table('penjualan')->where('created_at', 'like', "{$y}%")->sum('total');
		$total_pembelian 	= DB::table('pembelian')->where('created_at', 'like', "{$y}%")->sum('total');

		if ($total_penjualan > 0 || $total_pembelian > 0) {

    		$retur_penjualan 	= DB::table('retur_penjualan')->where('created_at', 'like', "{$y}%")->sum('dikembalikan');
    		$retur_pembelian	= DB::table('retur_pembelian')->where('created_at', 'like', "{$y}%")->sum('dikembalikan');

    		$penjualan_bersih 	= $total_penjualan - $retur_penjualan;
    		$pembelian_bersih 	= $total_pembelian - $retur_pembelian;

    		$id_barang 			= DB::table('barang')->pluck('id');
    		$persediaan_awal 	= 0;
    		$persediaan_akhir 	= 0;

    		foreach ($id_barang as $idb) {
    			$mob = $y == $startY ? '02': '01';

    			$persediaan_awal += Inventaris::has('inventaris_detail')
    										->where('barang_id', $idb)
    										->where('tanggal', '<', "{$y}-{$mob}-01 00:00:00")
    										->orderBy('tanggal', 'desc')
    										->first()
    										->inventaris_detail()
    										->sum('inv_total');

    			$persediaan_akhir += Inventaris::has('inventaris_detail')
    										->where('barang_id', $idb)
    										->where('tanggal', '<', date('Y-m-t', strtotime("{$y}-12-01"))." 23:59:59")
    										->orderBy('tanggal', 'desc')
    										->first()
    										->inventaris_detail()
    										->sum('inv_total');
    		}

    		$persediaan_siap_jual	= $pembelian_bersih + $persediaan_awal;
    		$hpp 					= $persediaan_siap_jual - $persediaan_akhir;
    		$laba_kotor				= $penjualan_bersih - $hpp;

    		DB::table('laba')->insert([
    			'total_penjualan'		=> $total_penjualan,
    			'retur_penjualan'		=> $retur_penjualan,
    			'penjualan_bersih'		=> $penjualan_bersih,
    			'total_pembelian'		=> $total_pembelian,
    			'retur_pembelian'		=> $retur_pembelian,
    			'pembelian_bersih'		=> $pembelian_bersih,
    			'persediaan_awal'		=> $persediaan_awal,
    			'persediaan_siap_jual'	=> $persediaan_siap_jual,
    			'persediaan_akhir'		=> $persediaan_akhir,
    			'hpp'					=> $hpp,
    			'laba_kotor'			=> $laba_kotor,
    			'tanggal_awal'			=> $y.'-01-01 00:00:00',
    			'tanggal_akhir'			=> date('Y-m-t H:i:s', strtotime($y.'-12-01')),
    			'tipe'					=> 'pertahun',
    		]);

			$this->command->getOutput()->progressAdvance();
		}
    }
}