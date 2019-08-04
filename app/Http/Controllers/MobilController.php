<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MobilController extends Controller
{
    public function index()
    {
    	return view('components.mobil.index');
    }

    public function create()
    {
    	return view('components.mobil.create');
    }

    public function store()
    {
    	return view('components.mobil.form');
    }

    public function edit()
    {
    	return view('components.mobil.edit');
    }

    public function update()
    {
    	return view('components.mobil.form');
    }

    public function destroy()
    {
    	return view('components.mobil.index');
    }
}
