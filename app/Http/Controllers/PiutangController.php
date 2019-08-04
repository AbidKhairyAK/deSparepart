<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PiutangController extends Controller
{
    public function index()
    {
    	return view('components.piutang.index');
    }

    public function create()
    {
    	return view('components.piutang.create');
    }

    public function store()
    {
    	return view('components.piutang.form');
    }

    public function edit()
    {
    	return view('components.piutang.edit');
    }

    public function update()
    {
    	return view('components.piutang.form');
    }

    public function destroy()
    {
    	return view('components.piutang.index');
    }
}
