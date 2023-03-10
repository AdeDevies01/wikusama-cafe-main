<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\LoginRequest;

class AuthController extends Controller {
    public function index() {
        return view('auth.index');
    }

    public function authenticate(LoginRequest $request) {
        $credentials = $request->only('username', 'password');

        if (Auth::attempt($credentials)) {
            $this->storeActivityLog('login', 'Masuk ke dalam aplikasi');
            
            if (Auth::user()->role == 'administrator') {
                return redirect()->intended('admin');
            } else if (Auth::user()->role == 'manager') {
                return redirect()->intended('manager');
            }
            return redirect()->intended('cashier');
        }

        return redirect('login')->with('error', 'Username atau password salah!');
    }

    public function logout() {
        $this->storeActivityLog('logout', 'Keluar dari aplikasi');
        Auth::logout();
        return redirect()->route('auth.index');
    }
}
