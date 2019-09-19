<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HakAksesController extends Controller
{
    public function index()
    {
    	return view('components.hak-akses.index');
    }

    public function create()
    {
    	return view('components.hak-akses.create');
    }

    public function store()
    {
    	return view('components.hak-akses.form');
    }

    public function edit()
    {
    	return view('components.hak-akses.edit');
    }

    public function update()
    {
    	return view('components.hak-akses.form');
    }

    public function destroy()
    {
    	return view('components.hak-akses.index');
    }
}
