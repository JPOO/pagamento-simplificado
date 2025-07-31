<?php

namespace App\Http\Controllers;

use App\Services\Wallet\WalletService;
use Illuminate\Contracts\View\View;

/**
 * Controller for dashboard
 *
 * @package Controllers
 * @author João Paulo Oliveira da Silva<joao.oliveira@unochapeco.edu.br>
 */
class DashboardController extends Controller
{
    /**
     * Return view of dashboard
     *
     * @return View
     */
    public function index(): View
    {
        $amount = (new WalletService())->getAmount();

        return view('dashboard')
            ->with('amount', $amount);
    }
}
