<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PenggunaController extends Controller
{
    public function index()
    {
    	return view('components.pengguna.index');
    }

    public function create()
    {
    	return view('components.pengguna.create');
    }

    public function store()
    {
    	return view('components.pengguna.form');
    }

    public function edit()
    {
    	return view('components.pengguna.edit');
    }

    public function update()
    {
    	return view('components.pengguna.form');
    }

    public function destroy()
    {
    	return view('components.pengguna.index');
    }
}
