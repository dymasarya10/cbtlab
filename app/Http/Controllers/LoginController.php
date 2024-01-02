<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;

class LoginController extends Controller
{
    public function authenticate(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email:dns',
            'password' => 'required'
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            $user = Auth::user();

            // Mengambil nilai kolom 'role'
            $role = $user->role;
            if ($role === 'admin') {
                return redirect(route('admindashboard'));
            } else if($role === 'teacher'){
                return redirect(route('questionlist'));
            }
            else {
                return redirect(route('testlist'));
            }
        }

        return redirect(route('login'))->with('loginError', 'Login Gagal');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect(route('login'));
    }
}
