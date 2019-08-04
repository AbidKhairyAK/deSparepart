<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PelangganController extends Controller
{
    public function index()
    {
    	return view('components.pelanggan.index');
    }

    public function create()
    {
    	return view('components.pelanggan.create');
    }

    public function store()
    {
    	return view('components.pelanggan.form');
    }

    public function edit()
    {
    	return view('components.pelanggan.edit');
    }

    public function update()
    {
    	return view('components.pelanggan.form');
    }

    public function destroy()
    {
    	return view('components.pelanggan.index');
    }
}
