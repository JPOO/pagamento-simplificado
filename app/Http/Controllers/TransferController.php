<?php

namespace App\Http\Controllers;

use App\Services\TransferService;
use Illuminate\Http\Request;

class TransferController extends Controller
{
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('new-transfer');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'cpfcnpj' => 'required|string',
            'value' => 'required|string'
        ]);

        $transferService = new TransferService($validated);

        $sendTransfer = $transferService->sendTransfer();

        $transferMessageStatus = $sendTransfer['success'] ? 'success-status' : 'error-status';

        return back()->withInput()->with(
            $transferMessageStatus,
            $sendTransfer['message']
        );
    }
}
