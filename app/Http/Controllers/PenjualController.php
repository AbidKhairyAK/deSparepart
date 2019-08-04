<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PenjualController extends Controller
{
    public function index()
    {
    	return view('components.penjual.index');
    }

    public function create()
    {
    	return view('components.penjual.create');
    }

    public function store()
    {
    	return view('components.penjual.form');
    }

    public function edit()
    {
    	return view('components.penjual.edit');
    }

    public function update()
    {
    	return view('components.penjual.form');
    }

    public function destroy()
    {
    	return view('components.penjual.index');
    }
}
