<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RoleController extends Controller
{
    public function index()
    {
    	return view('components.role.index');
    }

    public function create()
    {
    	return view('components.role.create');
    }

    public function store()
    {
    	return view('components.role.form');
    }

    public function edit()
    {
    	return view('components.role.edit');
    }

    public function update()
    {
    	return view('components.role.form');
    }

    public function destroy()
    {
    	return view('components.role.index');
    }
}
