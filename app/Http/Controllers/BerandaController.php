<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class BerandaController extends Controller
{
    public function index()
    {
    	$range_from = request()->get('range_from');
    	$range_to = request()->get('range_to');

    	if (!$range_from || !$range_to) {
    		$past = date('Y-m-d', strtotime('-7 month'));
    		$now = date('Y-m-d');

    		return redirect("/beranda?range_from={$past}&range_to={$now}");
    	}

    	$penjualan = DB::table('penjualan')->whereBetween('created_at', [$range_from." 00:00:01", $range_to." 23:59:59"]);
    	$pembelian = DB::table('pembelian')->whereBetween('created_at', [$range_from." 00:00:01", $range_to." 23:59:59"]);

    	$data['total_penjualan'] = $penjualan->sum('total');
    	$data['total_pembelian'] = $pembelian->sum('total');
    	$data['total_profit'] = $data['total_penjualan'] - $data['total_pembelian'];

        $data['chart_penjualan'] = $this->chart($penjualan, $range_from, $range_to);
        $data['chart_pembelian'] = $this->chart($pembelian, $range_from, $range_to);

        $data['limit'] = DB::table('barang')->whereColumn('stok', '<', 'limit')->get();

    	return view('components.beranda.index', $data);
    }

    public function chart($model, $from, $to)
    {
        $interval = strtotime($to) - strtotime($from);

        if ($interval < 1814400) {
            $model = $model
                ->select(DB::raw("
                    CONCAT(DAY(created_at),'-',MONTH(created_at)) as groups,
                    CONCAT(DAY(created_at),' ',MONTHNAME(created_at)) as label,
                    SUM(total) as data,
                    created_at
                "));
        } else if ($interval < 12960000) {
            $model = $model
                ->select(DB::raw("
                    CONCAT(WEEK(created_at),'-',YEAR(created_at)) as groups,
                    CONCAT('Week ',WEEK(created_at),' ',YEAR(created_at)) as label,
                    SUM(total) as data,
                    created_at
                "));
        } else if ($interval < 63936000) {
            $model = $model
                ->select(DB::raw("
                    CONCAT(MONTH(created_at),'-',YEAR(created_at)) as groups,
                    CONCAT(MONTHNAME(created_at),' ',YEAR(created_at)) as label,
                    SUM(total) as data,
                    created_at
                "));
        } else {
            $model = $model
                ->select(DB::raw("
                    YEAR(created_at) as groups,
                    YEAR(created_at) as label,
                    SUM(total) as data,
                    created_at
                "));
        }

        $model = $model->groupBy('groups')->orderBy('created_at')->get();

        $res['label'] = [];
        $res['data'] = [];

        foreach ($model as $i => $m) {
            $res['label'][$i] = $m->label;
            $res['data'][$i] = $m->data;
        }

        return $res;
    }

}
