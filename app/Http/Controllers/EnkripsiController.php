<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class EnkripsiController extends Controller
{
    public function index()
    {
    	return view('components.enkripsi.index');
    }

    public function create()
    {
    	return view('components.enkripsi.create');
    }

    public function store()
    {
    	return view('components.enkripsi.form');
    }

    public function edit()
    {
    	return view('components.enkripsi.edit');
    }

    public function update()
    {
    	return view('components.enkripsi.form');
    }

    public function destroy()
    {
    	return view('components.enkripsi.index');
    }
}
