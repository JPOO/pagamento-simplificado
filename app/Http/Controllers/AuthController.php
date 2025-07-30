<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (Auth::user()) {
            return redirect('dashboard');
        }

        return view('login');
    }

    /**
     * Display a listing of the resource.
     */
    public function login(Request $request)
    {
        $validated = $request->validate([
            'email' => 'required|email|string',
            'password' => 'required|string'
        ]);

        if (Auth::attempt($validated)) {
            $request->session()->regenerate();

            return redirect()->route('dashboard');
        } else {
            return back()->withInput()->with('status', 'A combinação de e-mail e senha está incorreta.');
        }
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }
}
