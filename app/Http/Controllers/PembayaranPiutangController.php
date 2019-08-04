<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PembayaranPiutangController extends Controller
{
    public function index()
    {
    	return view('components.pembayaran-piutang.index');
    }

    public function create()
    {
    	return view('components.pembayaran-piutang.create');
    }

    public function store()
    {
    	return view('components.pembayaran-piutang.form');
    }

    public function edit()
    {
    	return view('components.pembayaran-piutang.edit');
    }

    public function update()
    {
    	return view('components.pembayaran-piutang.form');
    }

    public function destroy()
    {
    	return view('components.pembayaran-piutang.index');
    }
}
