<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class KomponenController extends Controller
{
    public function index()
    {
    	return view('components.komponen.index');
    }

    public function create()
    {
    	return view('components.komponen.create');
    }

    public function store()
    {
    	return view('components.komponen.form');
    }

    public function edit()
    {
    	return view('components.komponen.edit');
    }

    public function update()
    {
    	return view('components.komponen.form');
    }

    public function destroy()
    {
    	return view('components.komponen.index');
    }
}
