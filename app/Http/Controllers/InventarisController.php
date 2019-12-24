<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Inventaris;

class InventarisController extends Controller
{
    public function api()
    {
    	$id = request()->get('id');
    	$invs = Inventaris::with('inventaris_detail:inventaris_id,inv_stok')
    						->select('id', 'penjualan_detail_id', 'pembelian_detail_id', 'trx_qty')
    						->where('barang_id', $id)
    						->oldest('tanggal')
    						->get();

    	return response()->json($invs);
    }
}
