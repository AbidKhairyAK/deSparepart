<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LaporanLabaRugiController extends Controller
{
    public function index()
    {
    	return view('components.laporan-laba-rugi.index');
    }
}
