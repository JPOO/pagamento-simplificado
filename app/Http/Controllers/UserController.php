<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Services\PasswordService;
use Illuminate\Validation\ValidationException;

class UserController extends Controller
{
    /**
     * Return form for new user in system
     */
    public function create()
    {
        return view('new-user');
    }

    /**
     * Create new user in system
     */
    public function store(Request $request, User $user, PasswordService $passwordService)
    {
        $validated = $request->validate([
            'name' => 'required|min:2|max:200|string',
            'email' => 'required|email|string|unique:users',
            'cpfcnpj' => 'required|string',
            'password' => 'required|min:8|max:200|string',
            'type' => 'required|min:1|max:1',
        ]);

        try {
            $user = $user->fill($validated);
            $user->password = $passwordService->hashPassword($validated['password']);

            $user->save();

            return back()->with('success-status', 'Nova conta criada com sucesso!');
        } catch (\Exception $e) {

            return back()->with('error-status', 'Ocorreu um erro ao criar nova conta.');
        }
    }
}
