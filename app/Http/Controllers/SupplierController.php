<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SupplierController extends Controller
{
    public function index()
    {
    	return view('components.supplier.index');
    }

    public function create()
    {
    	return view('components.supplier.create');
    }

    public function store()
    {
    	return view('components.supplier.form');
    }

    public function edit()
    {
    	return view('components.supplier.edit');
    }

    public function update()
    {
    	return view('components.supplier.form');
    }

    public function destroy()
    {
    	return view('components.supplier.index');
    }
}
