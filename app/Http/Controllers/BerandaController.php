<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Penjualan;

class BerandaController extends Controller
{
    public function index()
    {
    	return view('components.beranda.index');
    }
}
