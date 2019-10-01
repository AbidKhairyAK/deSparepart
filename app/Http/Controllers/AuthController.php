<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Model\User;

class AuthController extends Controller
{
    public function loginForm()
    {
    	return view('auth.login');
    }

    public function login(Request $request)
    {
    	if (Auth::attempt(['email' => $request->email, 'password' => $request->password, 'status' => 1], $request->remember)) {
    		User::find( auth()->user()->id )->update(['last_login' => now()]);
    	    return redirect()->intended('/beranda');
    	}
    	return redirect()->back()->with('err', 'Email atau password salah! <br> Mungkin akun anda nonaktif!');
    }

    public function logout()
    {
    	Auth::logout();

    	return redirect('/login');
    }
}
