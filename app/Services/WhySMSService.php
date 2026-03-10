<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class WhySMSService
{
 

    public function isEnabled(): bool
    {
        return true;
    }

    public function sendSMS($mobile, $message): string
    {
        try {
            $apiToken = '1046|WGTMJFtNKsY2oZheN06qL1cviTrZjGBYX6AX0mSP1823eed6';
            $senderId = 'EasyTech';

            $cleanPhone = ltrim((string)$mobile, '+');

            Log::info('Attempting to send SMS via WhySMS', [
                'phone' => $cleanPhone,
            ]);

            $response = Http::withHeaders([
                'Accept' => 'application/json',
                'Content-Type' => 'application/json',
            ])->post('https://bulk.whysms.com/api/http/sms/send', [
                'api_token' => $apiToken,
                'recipient' => $cleanPhone,
                'sender_id' => $senderId,
                'type' => 'plain',
                'message' => $message,
            ]);

            Log::info('WhySMS Response', [
                'status' => $response->status(),
                'body' => $response->body(),
            ]);

            if ($response->successful()) {
                $responseData = $response->json();
                if (($responseData['status'] ?? null) === 'success') {
                    return 'success';
                }
            }

            return 'error';
        } catch (\Exception $e) {
            Log::error('WhySMS Error', [
                'error' => $e->getMessage(),
                'phone' => $mobile,
            ]);

            return 'error';
        }
    }

    public function sendOTP($mobile, $otp, $type = 'register'): string
    {
        $messages = [
            'register' => "Welcome to  NEMO ! Your verification code is: {$otp}\nThis code expires in 5 minutes. Please do not share this code.",
            'forget_password' => "NEMO : Use code {$otp} to reset your password.\nThis code expires in 5 minutes. If you didn't request this, please ignore.",
            'login' => "NEMO: Your login code is: {$otp}\nValid for 5 minutes.",
        ];

        $message = $messages[$type] ?? $messages['register'];

        return $this->sendSMS($mobile, $message);
    }
}
