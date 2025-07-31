<?php

namespace App\Http\Controllers;

use App\Services\User\UserService;
use Illuminate\Http\{RedirectResponse, Request};

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
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => 'required|min:2|max:200|string',
            'email' => 'required|email|string|unique:users',
            'cpfcnpj' => 'required|string|unique:users',
            'password' => 'required|min:8|max:200|string',
            'role' => 'required|min:1|max:1',
        ]);

        $userService = new UserService();
        $insertUser = $userService->insertUser($validated);

        $insertMessageStatus = $insertUser['success'] ? 'success-status' : 'error-status';

        return back()->withInput()->with(
            $insertMessageStatus,
            $insertUser['message']
        );
    }
}
