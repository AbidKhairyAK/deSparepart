<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BarangController extends Controller
{
    public function index()
    {
    	return view('components.barang.index');
    }

    public function create()
    {
    	return view('components.barang.create');
    }

    public function store()
    {
    	return view('components.barang.form');
    }

    public function edit()
    {
    	return view('components.barang.edit');
    }

    public function update()
    {
    	return view('components.barang.form');
    }

    public function destroy()
    {
    	return view('components.barang.index');
    }
}
