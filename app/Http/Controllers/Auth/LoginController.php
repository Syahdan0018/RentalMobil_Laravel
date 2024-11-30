<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function render () {
        if (auth('web')->check()){
            return redirect()->back();
        }
        return view('Auth/Login');
    }

    public function authenticate(Request $request) {
        if (auth('web')->check()){
            return redirect()->back()->withErrors(["auth" => "user was validated"]);
        }
        $credentials = $request->validate([
            'username' => 'string|required',
            'password' => 'string|required|min:6'
        ]);
        if (Auth::attempt($credentials)){
            return redirect()->route('dashboard.admin');
        }
        return redirect()->back()->withErrors([
            'username'=>'this users dont match our records'
        ]);
    }

    public function logout (Request $request): RedirectResponse {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }
}
