<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Services\PasswordService;
use Illuminate\Http\{
    RedirectResponse,
    Request
};
use Illuminate\Validation\ValidationException;

/**
 * Controller for user
 *
 * @package Controllers
 * @author João Paulo Oliveira da Silva<joao.oliveira@unochapeco.edu.br>
 */
class UserController extends Controller
{
    /**
     * Return view of new user
     */
    public function create()
    {
        return view('new-user');
    }

    /**
     * Validate new user and return message status
     *
     * @return RedirectResponse
     */
    public function store(Request $request, User $user, PasswordService $passwordService): RedirectResponse
    {
        $validated = $request->validate([
            'name' => 'required|min:2|max:200|string',
            'email' => 'required|email|string|unique:users',
            'cpfcnpj' => 'required|string|unique:users',
            'password' => 'required|min:8|max:200|string',
            'type' => 'required|min:1|max:1',
        ]);

        try {
            $user = $user->fill($validated);
            $user->password = $passwordService->getHashPassword($validated['password']);

            $user->save();

            return back()->with('success-status', 'Nova conta criada com sucesso!');
        } catch (\Exception $e) {

            return back()->with('error-status', 'Ocorreu um erro ao criar nova conta.');
        }
    }
}
