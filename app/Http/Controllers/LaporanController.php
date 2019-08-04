<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LaporanController extends Controller
{
    public function index()
    {
    	return view('components.laporan.index');
    }

    public function create()
    {
    	return view('components.laporan.create');
    }

    public function store()
    {
    	return view('components.laporan.form');
    }

    public function edit()
    {
    	return view('components.laporan.edit');
    }

    public function update()
    {
    	return view('components.laporan.form');
    }

    public function destroy()
    {
    	return view('components.laporan.index');
    }
}
