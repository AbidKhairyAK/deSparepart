<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LaporanKinerjaKaryawanController extends Controller
{
    public function index()
    {
    	return view('components.laporan-kinerja-karyawan.index');
    }
}
