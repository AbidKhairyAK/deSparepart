<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PenjualanController extends Controller
{
    public function index()
    {
    	return view('components.penjualan.index');
    }

    public function create()
    {
    	return view('components.penjualan.create');
    }

    public function store()
    {
    	return view('components.penjualan.form');
    }

    public function edit()
    {
    	return view('components.penjualan.edit');
    }

    public function update()
    {
    	return view('components.penjualan.form');
    }

    public function destroy()
    {
    	return view('components.penjualan.index');
    }
}
