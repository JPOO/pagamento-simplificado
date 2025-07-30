<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Contracts\View\View;

class AuthController extends Controller
{
    /**
     * Returns view of dashboard or login
     *
     * @return View
     */
    public function index(): View
    {
        if (Auth::user()) {
            return redirect('dashboard');
        }

        return view('login');
    }

    /**
     * Validate login with email and password and start session
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

    /**
     * Finish session and redirect to login
     */
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }
}
