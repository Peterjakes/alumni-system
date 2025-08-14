<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\MpesaService;
use App\Models\MPesaDonation;
use Illuminate\Support\Facades\Log; // Import Log facade

class MPesaDonationController extends Controller
{
    protected $mpesa;

    public function __construct(MpesaService $mpesa)
    {
        $this->mpesa = $mpesa;
    }

    public function index()
    {
        // Fetch donations with their associated user for display
        $donations = MPesaDonation::with('user')->latest()->paginate(10);
        return view('backend.donations.index', compact('donations'));
    }

    public function create()
    {
        return view('frontend.donations.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255', // Added name validation
            'amount' => 'required|numeric|min:1|max:70000', // M-Pesa limit
            'phone' => [
                'required',
                'regex:/^(254[17]\d{8}|[17]\d{8})$/', // Accept both 254xxxxxxxxx and xxxxxxxxx formats
            ],
        ], [
            'phone.regex' => 'Please enter a valid Safaricom number (e.g., 712345678 or 254712345678)',
        ]);

        $phone = $request->phone;
        if (strlen($phone) === 9 && preg_match('/^[17]\d{8}$/', $phone)) {
            $phone = '254' . $phone; // Prepend 254 for 9-digit numbers
        }

        try {
            // Store in database before initiating STK push
            $donation = MPesaDonation::create([
                'user_id' => auth()->id(),
                'name' => $request->name, // Store donor name
                'amount' => $request->amount,
                'phone' => $phone, // Use formatted phone number
                'status' => 'pending',
                // transaction_id will be updated by the callback
            ]);

            // Pass the donation ID as AccountReference for callback matching
            $response = $this->mpesa->stkPush($phone, $request->amount, $donation->id); // Use formatted phone

            if (isset($response['ResponseCode']) && $response['ResponseCode'] == '0') {
                // Store CheckoutRequestID to match with callback
                $donation->update(['checkout_request_id' => $response['CheckoutRequestID']]);
                return redirect()->back()->with('success', 'Payment request sent to your phone. Please complete the transaction.');
            } else {
                // If STK push initiation fails, mark donation as failed
                $donation->update(['status' => 'failed']);
                Log::error('M-Pesa STK Push failed to initiate:', $response);
                return redirect()->back()->with('error', 'Failed to initiate payment. Please try again.');
            }
        } catch (\Exception $e) {
            Log::error('M-Pesa STK Push exception:', ['message' => $e->getMessage(), 'trace' => $e->getTraceAsString()]);
            return redirect()->back()->with('error', 'An error occurred. Please try again.');
        }
    }

    /**
     * Handles the M-Pesa STK Push callback.
     * This method is called by Safaricom's Daraja API.
     * It updates the status of the donation based on the callback response.
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function callback(Request $request)
    {
        // Log the entire callback request for debugging
        Log::info('M-Pesa Callback Received:', $request->all());

        $body = $request->json('Body');

        if (isset($body['stkCallback'])) {
            $stkCallback = $body['stkCallback'];
            $checkoutRequestId = $stkCallback['CheckoutRequestID'];
            $resultCode = $stkCallback['ResultCode'];
            $resultDesc = $stkCallback['ResultDesc'];

            // Find the donation using the CheckoutRequestID
            $donation = MPesaDonation::where('checkout_request_id', $checkoutRequestId)->first();

            if ($donation) {
                if ($resultCode == 0) {
                    // Transaction was successful
                    $transactionId = null;
                    $mpesaReceiptNumber = null;

                    // Extract MpesaReceiptNumber from CallbackMetadata if available
                    if (isset($stkCallback['CallbackMetadata']['Item'])) {
                        foreach ($stkCallback['CallbackMetadata']['Item'] as $item) {
                            if ($item['Name'] == 'MpesaReceiptNumber') {
                                $mpesaReceiptNumber = $item['Value'];
                            }
                            // You can extract other details like Balance, TransactionDate if needed
                        }
                    }

                    $donation->update([
                        'status' => 'completed',
                        'transaction_id' => $mpesaReceiptNumber, // Store the M-Pesa receipt number
                    ]);
                    Log::info("M-Pesa Donation {$donation->id} completed. Receipt: {$mpesaReceiptNumber}");
                } else {
                    // Transaction failed or was cancelled
                    $donation->update([
                        'status' => 'failed',
                        'transaction_id' => 'FAILED_' . $resultCode, // Store error code
                    ]);
                    Log::warning("M-Pesa Donation {$donation->id} failed. ResultCode: {$resultCode}, Desc: {$resultDesc}");
                }
            } else {
                Log::error("M-Pesa Callback: Donation not found for CheckoutRequestID: {$checkoutRequestId}");
            }
        } else {
            Log::error('M-Pesa Callback: Invalid STK Callback structure.', $body);
        }

        // Always return a success response to M-Pesa to avoid retries
        return response()->json(['ResultCode' => 0, 'ResultDesc' => 'Callback received successfully']);
    }
}
