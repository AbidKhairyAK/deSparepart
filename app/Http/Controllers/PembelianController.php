<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PembelianController extends Controller
{
    public function index()
    {
    	return view('components.pembelian.index');
    }

    public function create()
    {
    	return view('components.pembelian.create');
    }

    public function store()
    {
    	return view('components.pembelian.form');
    }

    public function edit()
    {
    	return view('components.pembelian.edit');
    }

    public function update()
    {
    	return view('components.pembelian.form');
    }

    public function destroy()
    {
    	return view('components.pembelian.index');
    }
}
