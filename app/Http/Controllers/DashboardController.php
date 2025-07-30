<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

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
        return view('dashboard');
    }
}
