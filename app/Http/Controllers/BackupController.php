<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BackupController extends Controller
{
    public function index()
    {
    	return view('components.backup.index');
    }

    public function create()
    {
    	return view('components.backup.create');
    }

    public function store()
    {
    	return view('components.backup.form');
    }

    public function edit()
    {
    	return view('components.backup.edit');
    }

    public function update()
    {
    	return view('components.backup.form');
    }

    public function destroy()
    {
    	return view('components.backup.index');
    }
}
