<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\MpesaService;
use Illuminate\Support\Facades\Log;

class DonationController extends Controller
{
    protected $mpesaService;

    public function __construct(MpesaService $mpesaService)
    {
        $this->mpesaService = $mpesaService;
    }

    public function donate(Request $request)
    {
        $validated = $request->validate([
            'amount' => 'required|numeric|min:1',
            'phone' => 'required|string'
        ]);

        try {
            $response = $this->mpesaService->stkPush($validated['phone'], $validated['amount']);

            // Log response for debugging
            Log::info('M-Pesa STK Push Response', ['response' => $response]);

            if (isset($response['ResponseCode']) && $response['ResponseCode'] == '0') {
                return back()->with('success', 'STK Push sent. Check your phone to complete the payment.');
            } else {
                return back()->with('error', $response['errorMessage'] ?? 'Failed to initiate payment.');
            }
        } catch (\Exception $e) {
            Log::error('M-Pesa donation error: ' . $e->getMessage());
            return back()->with('error', 'Something went wrong. Try again.');
        }
    }
}
