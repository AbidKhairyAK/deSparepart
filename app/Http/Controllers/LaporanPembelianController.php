<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LaporanPembelianController extends Controller
{
    public function index()
    {
    	return view('components.laporan-pembelian.index');
    }
}
