<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class KaryawanController extends Controller
{
    public function index()
    {
    	return view('components.karyawan.index');
    }

    public function create()
    {
    	return view('components.karyawan.create');
    }

    public function store()
    {
    	return view('components.karyawan.form');
    }

    public function edit()
    {
    	return view('components.karyawan.edit');
    }

    public function update()
    {
    	return view('components.karyawan.form');
    }

    public function destroy()
    {
    	return view('components.karyawan.index');
    }
}
