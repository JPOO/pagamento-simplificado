<?php

namespace App\Services\Transfer;

use App\Services\Wallet\WalletService;
use Illuminate\Support\Facades\Auth;

/**
 * Service for execute transfer
 *
 * @package Services
 * @author João Paulo Oliveira da Silva<joao.oliveira@unochapeco.edu.br>
 */
class TransferProcessService
{
    /**
     * Execute transfer process
     *
     * @return array
     */
    public function execute(string $cpfcnpj, float $value): array
    {
        $initialAmountSender = (new WalletService())->getAmount();

        $sendTransfer = (new TransferOperationSendService)->execute(
            Auth::user()->cpfcnpj,
            $value
        );

        if (!$sendTransfer) {
            return [
                'success' => true,
                'message' => 'Ocorreu um erro durante a transferência. Nenhum valor foi enviado.'
            ];
        }

        $receiveTransfer = (new TransferOperationReceiveService)->execute(
            $cpfcnpj,
            $value
        );

        if (!$receiveTransfer) {
            $actualAmountSender = (new WalletService())->getAmount();

            if ($initialAmountSender != $actualAmountSender) {
                $revertTransfer = (new TransferOperationRevertService())->execute(
                    Auth::user()->cpfcnpj,
                    $value
                );

                if (!$revertTransfer) {
                    return [
                        'success' => false,
                        'message' => 'Ocorreu um erro durante a transferência. O valor não foi estornado. Consulte o administrador do sistema.'
                    ];
                }
            }

            return [
                'success' => false,
                'message' => 'Ocorreu um erro durante a transferência. O valor foi estornado.'
            ];
        }

        return [
            'success' => true
        ];
    }
}
