<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PembayaranHutangController extends Controller
{
    public function index()
    {
    	return view('components.pembayaran-hutang.index');
    }

    public function create()
    {
    	return view('components.pembayaran-hutang.create');
    }

    public function store()
    {
    	return view('components.pembayaran-hutang.form');
    }

    public function edit()
    {
    	return view('components.pembayaran-hutang.edit');
    }

    public function update()
    {
    	return view('components.pembayaran-hutang.form');
    }

    public function destroy()
    {
    	return view('components.pembayaran-hutang.index');
    }
}
