<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log; 

class MpesaService
{
    /**
     * Initiates an M-Pesa STK Push.
     *
     * @param string $phone The customer's phone number (2547xxxxxxxx).
     * @param float $amount The amount to be transacted.
     * @param string $accountRef A unique identifier for the transaction (e.g., donation ID).
     * @param string $transactionDesc A description for the transaction.
     * @return array The response from the M-Pesa API.
     */
    public function stkPush($phone, $amount, $accountRef = 'Alumni Donation', $transactionDesc = 'Alumni Donation')
    {
        $timestamp = now()->format('YmdHis');
        // Use env variables for BusinessShortCode and Passkey
        $password = base64_encode(env('MPESA_SHORTCODE') . env('MPESA_PASSKEY') . $timestamp);

        try {
            $response = Http::withToken($this->getAccessToken())->post(
                env('MPESA_STKPUSH_URL', 'https://sandbox.safaricom.co.ke/mpesa/stkpush/v1/processrequest'),
                [
                    "BusinessShortCode" => env('MPESA_SHORTCODE'),
                    "Password" => $password,
                    "Timestamp" => $timestamp,
                    "TransactionType" => "CustomerPayBillOnline",
                    "Amount" => $amount,
                    "PartyA" => $phone,
                    "PartyB" => env('MPESA_SHORTCODE'),
                    "PhoneNumber" => $phone,
                    "CallBackURL" => env('MPESA_CALLBACK_URL'),
                    "AccountReference" => $accountRef, // Pass the unique reference (donation ID)
                    "TransactionDesc" => $transactionDesc,
                ]
            );
            Log::info('M-Pesa STK Push Response:', $response->json());
            return $response->json();
        } catch (\Exception $e) {
            Log::error('M-Pesa STK Push Service Exception:', ['message' => $e->getMessage()]);
            return ['error' => $e->getMessage()];
        }
    }

    /**
     * Retrieves an M-Pesa access token.
     *
     * @return string The access token.
     */
    protected function getAccessToken()
    {
        // Use env variables for consumer key and secret
        $consumerKey = env('MPESA_CONSUMER_KEY');
        $consumerSecret = env('MPESA_CONSUMER_SECRET');

        if (!$consumerKey || !$consumerSecret) {
            Log::error('M-Pesa Access Token: Consumer Key or Secret not set in .env');
            throw new \Exception('M-Pesa Consumer Key or Secret not configured.');
        }

        try {
            $response = Http::withBasicAuth($consumerKey, $consumerSecret)
                ->get(env('MPESA_AUTH_URL', 'https://sandbox.safaricom.co.ke/oauth/v1/generate?grant_type=client_credentials'));

            if ($response->successful() && isset($response['access_token'])) {
                return $response['access_token'];
            } else {
                Log::error('M-Pesa Access Token Failed:', $response->json());
                throw new \Exception('Failed to get M-Pesa access token.');
            }
        } catch (\Exception $e) {
            Log::error('M-Pesa Access Token Service Exception:', ['message' => $e->getMessage()]);
            throw new \Exception('An error occurred while getting M-Pesa access token.');
        }
    }
}
