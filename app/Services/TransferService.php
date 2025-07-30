<?php

namespace App\Services;

use App\Helpers\Number;
use Illuminate\Support\Facades\Auth;

/**
 * Service for execute transfer
 *
 * @package Services
 * @author João Paulo Oliveira da Silva<joao.oliveira@unochapeco.edu.br>
 */
class TransferService
{
    private string $cpfcnpj;

    private float $value;

    public function __construct(array $validated)
    {
        $this->cpfcnpj = $validated['cpfcnpj'];
        $this->value = Number::normalizeStringToNumber($validated['value']);
    }

    public function executeTransfer(): array
    {
        $validated = $this->getValidation();

        if (!$validated['success']) {
            return $validated;
        }

        $processed = $this->processTransfer();

        if (!$processed['success']) {
            return $processed;
        }

        return [
            'success' => true,
            'message' => 'Transferência realizada com sucesso!'
        ];
    }

    private function processTransfer()
    {
        $sendTransfer = SendTransferService::sendTransfer($this->value);

        if (!$sendTransfer) {
            return [
                'success' => true,
                'message' => 'Ocorreu um erro durante a transferência. Nenhum valor foi enviado.'
            ];
        }

        $receiveTransfer = ReceiveTransferService::receiveTransfer(
            $this->cpfcnpj,
            $this->value
        );

        if (!$receiveTransfer) {
            return [
                'success' => false,
                'message' => 'Ocorreu um erro durante a transferência. O valor será retornado.'
            ];
        }
    }

    /*
     * Get all validation
     *
     * @return array
     */
    private function getValidation(): array
    {
        if (!$this->verifyUserHasAuthorizedToTransfer()) {
            return [
                'success' => false,
                'message' => 'Você não tem permissão para realizar transferência.'
            ];
        }

        if (!$this->verifyUserHasAuthorizedToReceive()) {
            return [
                'success' => false,
                'message' => 'Você não pode transferir para este usuário.'
            ];
        }

        if (!$this->verifyMinimumValueToTransfer()) {
            return [
                'success' => false,
                'message' => 'Você deve informar um valor maior que 0.'
            ];
        }

        if (!$this->verifyUserHasEnoghtAmount()) {
            return [
                'success' => false,
                'message' => 'Você não possui saldo suficiente para a transferência.'
            ];
        }

        if (!$this->verifyUserReceiveExist()) {
            return [
                'success' => false,
                'message' => 'Usuário com o CPF/CNPJ não encontrado.'
            ];
        }

        if (!$this->verifyExternalTransferAuthorization()) {
            return [
                'success' => false,
                'message' => 'Transferência não autorizada pelo serviço externo autorizador.'
            ];
        }

        return [
            'success' => true
        ];
    }

    /*
     * Verify if value send is bigger than 0
     *
     * @return bool
     */
    private function verifyMinimumValueToTransfer(): bool
    {
        if (empty($this->value) || (is_numeric($this->value) && (float) $this->value == 0)) {
            return false;
        }

        return true;
    }

    /*
     * Verify if user can transfer to another user
     *
     * @return bool
     */
    private function verifyUserHasAuthorizedToTransfer(): bool
    {
        $repositoryUser = new UserService();

        if ($repositoryUser->verifyCommonUserSession()) {
            return true;
        }

        return false;
    }

    /*
     * Verify user is unauthorized
     *
     * @return bool
     */
    private function verifyUserHasAuthorizedToReceive(): bool
    {
        $unautherized = [
            Auth::user()->cpfcnpj
        ];

        if (in_array($this->cpfcnpj, $unautherized)) {
            return false;
        }

        return true;
    }

    /*
     * Verify if user has enoght money
     *
     * @return bool
     */
    private function verifyUserHasEnoghtAmount(): bool
    {
        $wallet_amount = WalletService::getAmount();

        if ($this->value > $wallet_amount) {
            return false;
        }

        return true;
    }

    /*
     * Verify if user is valid
     *
     * @return bool
     */
    private function verifyUserReceiveExist()
    {
        $user = UserService::getUserByCpfCnpj($this->cpfcnpj);

        if ($user->isEmpty()) {
            return false;
        }

        return true;
    }

    /*
     * Verify if transfer has external authorization
     *
     * @return bool
     */
    private function verifyExternalTransferAuthorization()
    {
        $externalTransfer = ExternalTransferAuthorizationService::hasAuthorization(
            [
                'cpfcnpj' => Auth::user()->cpfcnpj
            ], [
                'cpfcnpj' => $this->cpfcnpj
            ],
            $this->value
        );

        return $externalTransfer;
    }

    private function sedEmail()
    {

    }
}
