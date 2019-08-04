<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class JabatanController extends Controller
{
    public function index()
    {
    	return view('components.jabatan.index');
    }

    public function create()
    {
    	return view('components.jabatan.create');
    }

    public function store()
    {
    	return view('components.jabatan.form');
    }

    public function edit()
    {
    	return view('components.jabatan.edit');
    }

    public function update()
    {
    	return view('components.jabatan.form');
    }

    public function destroy()
    {
    	return view('components.jabatan.index');
    }
}
