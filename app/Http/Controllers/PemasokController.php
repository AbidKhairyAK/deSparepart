<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PemasokController extends Controller
{
    public function index()
    {
    	return view('components.pemasok.index');
    }

    public function create()
    {
    	return view('components.pemasok.create');
    }

    public function store()
    {
    	return view('components.pemasok.form');
    }

    public function edit()
    {
    	return view('components.pemasok.edit');
    }

    public function update()
    {
    	return view('components.pemasok.form');
    }

    public function destroy()
    {
    	return view('components.pemasok.index');
    }
}
