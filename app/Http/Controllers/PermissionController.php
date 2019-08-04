<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PermissionController extends Controller
{
    public function index()
    {
    	return view('components.permission.index');
    }

    public function create()
    {
    	return view('components.permission.create');
    }

    public function store()
    {
    	return view('components.permission.form');
    }

    public function edit()
    {
    	return view('components.permission.edit');
    }

    public function update()
    {
    	return view('components.permission.form');
    }

    public function destroy()
    {
    	return view('components.permission.index');
    }
}
