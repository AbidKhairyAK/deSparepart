<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Inventaris;

class InventarisController extends Controller
{
    public function api()
    {
    	$invs = Inventaris::with('inventaris_detail')
    						->where('barang_id', 1)
    						->whereNotNull('pembelian_detail_id')
    						->orderBy('tanggal')
    						->get();

    	return response()->json($invs);
    }
}
