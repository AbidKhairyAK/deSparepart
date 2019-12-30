<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Faker\Factory;
use App\Model\Inventaris;

class LaporanLabaRugiController extends Controller
{
    public function index()
    {
    	$tipe = request()->get('tipe');
    	$waktu = request()->get('waktu');

    	if (!$tipe || !$waktu) {
    		$now = date('Y-m', strtotime('-1 month'));
    		return redirect("/laporan-laba-rugi?tipe=perbulan&waktu={$now}");
    	}

        // nanti pake cronjob
        // $this->recountPerbulan();

    	$data['laba'] = DB::table('laba')
    				->where('tipe', $tipe)
    				->where('tanggal_awal', 'like', $waktu.'%')
    				->first();

        $data['chart'] = $this->chart($tipe, $waktu);

    	return view('components.laporan-laba-rugi.index', $data);
    }

    public function chart($tipe, $waktu)
    {
        if ($tipe == 'perbulan') {
            $model = DB::table('laba')
                        ->where('tipe', $tipe)
                        ->where('tanggal_awal', '<=', "{$waktu}-01 00:00:00")
                        ->skip(0)
                        ->take(8)
                        ->select(DB::raw("
                            CONCAT(MONTH(tanggal_awal),'-',YEAR(tanggal_awal)) as groups,
                            CONCAT(MONTHNAME(tanggal_awal),' ',YEAR(tanggal_awal)) as label,
                            SUM(laba_kotor) as data,
                            tanggal_awal
                        "));
        } else if ($tipe == 'pertahun') {
            $model = DB::table('laba')
                        ->where('tipe', $tipe)
                        ->where('tanggal_awal', '<=', "{$waktu}-01-01 00:00:00")
                        ->skip(0)
                        ->take(4)
                        ->select(DB::raw("
                            YEAR(tanggal_awal) as groups,
                            YEAR(tanggal_awal) as label,
                            SUM(laba_kotor) as data,
                            tanggal_awal
                        "));
        }

        $model = $model->groupBy('groups')->orderBy('tanggal_awal', 'desc')->get();

        $res['label'] = [];
        $res['data'] = [];

        foreach ($model as $i => $m) {
            $res['label'][$i] = $m->label;
            $res['data'][$i] = $m->data;
        }

        return $res;
    }

    public function recountPerbulan()
    {
        $y = date('Y');
        $m = date('m');

        $total_penjualan    = DB::table('penjualan')->whereYear('created_at', $y)->whereMonth('created_at', $m)->sum('total');
        $total_pembelian    = DB::table('pembelian')->whereYear('created_at', $y)->whereMonth('created_at', $m)->sum('total');

        if ($total_penjualan > 0 || $total_pembelian > 0) {

            $retur_penjualan    = DB::table('retur_penjualan')->whereYear('created_at', $y)->whereMonth('created_at', $m);
            $retur_penjualan    = $retur_penjualan->sum('dikembalikan') + $retur_penjualan->sum('dilunaskan');
            $retur_pembelian    = DB::table('retur_pembelian')->whereYear('created_at', $y)->whereMonth('created_at', $m);
            $retur_pembelian    = $retur_pembelian->sum('dikembalikan') + $retur_pembelian->sum('dilunaskan');

            $penjualan_bersih   = $total_penjualan - $retur_penjualan;
            $pembelian_bersih   = $total_pembelian - $retur_pembelian;

            $id_barang          = DB::table('barang')->pluck('id');
            $persediaan_awal    = 0;
            $persediaan_akhir   = 0;

            foreach ($id_barang as $idb) {
                $mo = $m < 10 ? '0'.$m : $m;

                $persediaan_awal += Inventaris::has('inventaris_detail')
                                            ->where('barang_id', $idb)
                                            ->where('tanggal', '<', "{$y}-{$mo}-01 00:00:00")
                                            ->orderBy('tanggal', 'desc')
                                            ->first()
                                            ->inventaris_detail()
                                            ->sum('inv_total');

                $persediaan_akhir += Inventaris::has('inventaris_detail')
                                            ->where('barang_id', $idb)
                                            ->where('tanggal', '<', date('Y-m-t', strtotime("{$y}-{$mo}-01"))." 23:59:59")
                                            ->orderBy('tanggal', 'desc')
                                            ->first()
                                            ->inventaris_detail()
                                            ->sum('inv_total');
            }

            $persediaan_siap_jual   = $pembelian_bersih + $persediaan_awal;
            $hpp                    = $persediaan_siap_jual - $persediaan_akhir;
            $laba_kotor             = $penjualan_bersih - $hpp;

            DB::table('laba')->updateOrInsert(
                [
                    'tanggal_awal'          => $y.'-'.$m.'-01 00:00:00',
                    'tanggal_akhir'         => date('Y-m-t H:i:s', strtotime($y.'-'.$m.'-01')),
                    'tipe'                  => 'perbulan',
                ],
                [
                    'total_penjualan'       => $total_penjualan,
                    'retur_penjualan'       => $retur_penjualan,
                    'penjualan_bersih'      => $penjualan_bersih,
                    'total_pembelian'       => $total_pembelian,
                    'retur_pembelian'       => $retur_pembelian,
                    'pembelian_bersih'      => $pembelian_bersih,
                    'persediaan_awal'       => $persediaan_awal,
                    'persediaan_siap_jual'  => $persediaan_siap_jual,
                    'persediaan_akhir'      => $persediaan_akhir,
                    'hpp'                   => $hpp,
                    'laba_kotor'            => $laba_kotor,
                ]
            );
        }
    }
}
