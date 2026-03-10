<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class WhySMSService
{
    protected ?array $config;

    public function __construct()
    {
        $this->config = $this->getConfig();
    }

    public function isEnabled(): bool
    {
        return true;
    }

    public function sendSMS($mobile, $message): string
    {
        try {
            $apiToken = trim($this->apiToken);
            $senderId = $this->senderId;

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
            'register' => "Welcome to Sham AlEzz! Your verification code is: {$otp}\nThis code expires in 5 minutes. Please do not share this code.",
            'forget_password' => "Sham AlEzz: Use code {$otp} to reset your password.\nThis code expires in 5 minutes. If you didn't request this, please ignore.",
            'login' => "Sham AlEzz: Your login code is: {$otp}\nValid for 5 minutes.",
        ];

        $message = $messages[$type] ?? $messages['register'];

        return $this->sendSMS($mobile, $message);
    }

    protected function getConfig(): ?array
    {
        $setting = configSettings('whysms', 'sms_config');

        if (!$setting || is_null($setting->live_values)) {
            return null;
        }

        $values = json_decode($setting->live_values, true);

        return is_array($values) ? $values : null;
    }
}
