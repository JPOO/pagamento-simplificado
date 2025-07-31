<?php

namespace App\Services\Transfer;

use App\Helpers\Number;
use App\Repositories\TransferRepository;
use App\Services\MailService;
use App\Services\User\UserService;
use App\Services\Wallet\WalletService;
use Illuminate\Support\Facades\Auth;

/**
 * Service for external transfer authorization
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

    /**
     * Execute transfer
     *
     * @return array
     */
    public function execute(): array
    {
        $validated = $this->getValidation();

        if (!$validated['success']) {
            return $validated;
        }

        $processed = (new TransferProcessService())
            ->execute($this->cpfcnpj, $this->value);

        if (!$processed['success']) {
            return $processed;
        }

        $this->insertTransfer(
            $this->cpfcnpj,
            $this->value
        );

        $this->sendEmailToUserReceive();

        return [
            'success' => true,
            'message' => 'Transferência realizada com sucesso!'
        ];
    }

    /**
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
                'message' => 'Você deve informar um valor maior que R$ 0,00.'
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

    /**
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

    /**
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

    /**
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

    /**
     * Verify if user has enoght money
     *
     * @return bool
     */
    private function verifyUserHasEnoghtAmount(): bool
    {
        $wallet_amount = (new WalletService())->getAmount();

        if ($this->value > $wallet_amount) {
            return false;
        }

        return true;
    }

    /**
     * Verify if user is valid
     *
     * @return bool
     */
    private function verifyUserReceiveExist()
    {
        $user = (new UserService())->getUserByCpfCnpj($this->cpfcnpj);

        if (empty($user)) {
            return false;
        }

        return true;
    }

    /**
     * Verify if transfer has external authorization
     *
     * @return bool
     */
    private function verifyExternalTransferAuthorization()
    {
        $externalTransfer = (new ExternalTransferAuthorizationService())->hasAuthorization(
            [
                'cpfcnpj' => Auth::user()->cpfcnpj
            ], [
            'cpfcnpj' => $this->cpfcnpj
        ],
            $this->value
        );

        return $externalTransfer;
    }

    /**
    * Insert transfer
    *
    * @return array
    */
    private function insertTransfer(string $cpfcnpj, float $value): void
    {
        $user = (new UserService())->getUserByCpfCnpj($cpfcnpj);

        (new TransferRepository())->save([
            'user_id_send' => Auth::user()->id,
            'user_id_receive' => $user->id,
            'value' => $value
        ]);
    }

    /**
    * Simulate email to send
    *
    * @return bool
    */
    private function sendEmailToUserReceive(): void
    {
        $user = (new UserService())->getUserByCpfCnpj($this->cpfcnpj);

        (new MailService())->send([
            'to' => $user->email,
            'name' => $user->name,
            'subject' => 'Nova transferência recebida',
            'message' => 'Você recebeu uma transferência de R$ ' . $this->value . ' de ' . Auth::user()->nome
        ]);
    }
}
