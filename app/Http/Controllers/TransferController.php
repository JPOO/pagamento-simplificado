<?php

namespace App\Http\Controllers;

use App\Services\Transfer\TransferService;
use Illuminate\Contracts\View\View;
use Illuminate\Http\{RedirectResponse, Request};

/**
 * Controller for transference
 *
 * @package Controllers
 * @author João Paulo Oliveira da Silva<joao.oliveira@unochapeco.edu.br>
 */
class TransferController extends Controller
{
    /**
     * Return view of new transference
     *
     * @return View
     */
    public function create(): View
    {
        return view('new-transfer');
    }

    /**
     * Validate transference with cpf-cnpj and value and return message status
     *
     * @return RedirectResponse
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'cpfcnpj' => 'required|string',
            'value' => 'required|string'
        ]);

        $transferService = new TransferService($validated);
        $sendTransfer = $transferService->execute();

        $transferMessageStatus = $sendTransfer['success'] ? 'success-status' : 'error-status';

        return back()->withInput()->with(
            $transferMessageStatus,
            $sendTransfer['message']
        );
    }
}
