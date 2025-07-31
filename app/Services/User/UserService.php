<?php

namespace App\Services\User;

use App\Models\User;
use App\Repositories\UserRepository;
use App\Repositories\WalletRepository;
use Illuminate\Support\Facades\Auth;

/**
 * Service for user
 *
 * @package Services
 * @author João Paulo Oliveira da Silva<joao.oliveira@unochapeco.edu.br>
 */
class UserService
{
    /**
     * Insert user and initial wallet
     *
     * @return array
     */
    public function insertUser(array $data): array
    {
        $data['password'] = (new PasswordService())->getEncryptPassword($data['password']);

        $user = (new UserRepository())->save($data);

        if (!$user) {
            return [
                'success' => false,
                'message' => 'Ocorreu um erro ao criar nova conta.'
            ];
        }

        //Create a wallet with initial amount
        $wallet = (new WalletRepository())->save([
            'user_id' => $user->id,
            'amount' => 1000.00
        ]);

        if (!$wallet) {
            return [
                'success' => false,
                'message' => 'Ocorreu um erro ao criar nova conta.'
            ];
        }

        return [
            'success' => true,
            'message' => 'Nova conta criada com sucesso!'
        ];
    }

    /**
     * Return user by cpf-cnpj
     *
     * @return bool
     */
    public function getUserByCpfCnpj(string $cpfcnpj)
    {
        $user = (new UserRepository())->getByCpfCnpj($cpfcnpj);

        if (!$user->isEmpty()) {
            return $user->first();
        }

        return null;
    }

    /**
     * Verify if session user is common or not
     *
     * @return bool
     */
    public function verifyCommonUserSession(): bool
    {
        $type = Auth::user()->role;

        if ($type == User::COMMON_USER) {
            return true;
        }

        return false;
    }
}
