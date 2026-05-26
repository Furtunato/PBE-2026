<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function showLogin()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $email = $request->email;
        $password = $request->password;
        
        // Verifica as credenciais manualmente
        if ($email === 'admin@safe7.com' && $password === '123456') {
            $user = \App\Models\User::where('email', 'admin@safe7.com')->first();
            if ($user) {
                Auth::login($user);
                return redirect()->to('/');
            }
        }
        
        if ($email === 'professor@safe7.com' && $password === '123456') {
            $user = \App\Models\User::where('email', 'professor@safe7.com')->first();
            if ($user) {
                Auth::login($user);
                return redirect()->to('/professor');
            }
        }
        
        if ($email === 'portaria@safe7.com' && $password === '123456') {
            $user = \App\Models\User::where('email', 'portaria@safe7.com')->first();
            if ($user) {
                Auth::login($user);
                return redirect()->to('/portaria');
            }
        }
        
        return back()->withErrors([
            'email' => 'Email ou senha incorretos.',
        ])->onlyInput('email');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->to('/login');
    }
}