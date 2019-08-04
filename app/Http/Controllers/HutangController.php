<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HutangController extends Controller
{
    public function index()
    {
    	return view('components.hutang.index');
    }

    public function create()
    {
    	return view('components.hutang.create');
    }

    public function store()
    {
    	return view('components.hutang.form');
    }

    public function edit()
    {
    	return view('components.hutang.edit');
    }

    public function update()
    {
    	return view('components.hutang.form');
    }

    public function destroy()
    {
    	return view('components.hutang.index');
    }
}
