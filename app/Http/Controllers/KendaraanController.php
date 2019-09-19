<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class KendaraanController extends Controller
{
    public function index()
    {
    	return view('components.kendaraan.index');
    }

    public function create()
    {
    	return view('components.kendaraan.create');
    }

    public function store()
    {
    	return view('components.kendaraan.form');
    }

    public function edit()
    {
    	return view('components.kendaraan.edit');
    }

    public function update()
    {
    	return view('components.kendaraan.form');
    }

    public function destroy()
    {
    	return view('components.kendaraan.index');
    }
}
