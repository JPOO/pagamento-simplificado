<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\{
    RedirectResponse,
    Request
};

/**
 * Controller for authentication
 *
 * @package Controllers
 * @author João Paulo Oliveira da Silva<joao.oliveira@unochapeco.edu.br>
 */
class AuthController extends Controller
{
    /**
     * Return view of dashboard or login
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
     * Validate login with email and password, start session and redirect to dashboard
     *
     * @return RedirectResponse
     */
    public function login(Request $request): RedirectResponse
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
     *
     * @return RedirectResponse
     */
    public function logout(Request $request): RedirectResponse
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }
}
