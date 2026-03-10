<?php

namespace Modules\AuthManagement\Service;

use App\Service\BaseService;
use App\Services\WhySMSService;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Modules\BusinessManagement\Repository\SettingRepositoryInterface;
use Modules\Gateways\Traits\SmsGateway;
use Modules\UserManagement\Repository\OtpVerificationRepositoryInterface;
use Modules\UserManagement\Repository\UserRepositoryInterface;

class AuthService extends BaseService implements Interface\AuthServiceInterface
{
    use SmsGateway;

    protected $userRepository;
    protected $otpVerificationRepository;
    protected $settingRepository;
    protected WhySMSService $whySMSService;

    public function __construct(UserRepositoryInterface $userRepository, OtpVerificationRepositoryInterface $otpVerificationRepository, SettingRepositoryInterface $settingRepository, WhySMSService $whySMSService)
    {
        parent::__construct($userRepository);
        $this->userRepository = $userRepository;
        $this->otpVerificationRepository = $otpVerificationRepository;
        $this->settingRepository = $settingRepository;
        $this->whySMSService = $whySMSService;
    }

    public function checkClientRoute($request)
    {
        $route = str_contains($request->route()?->getPrefix(), 'customer');
        if ($route) {
            $user = $this->userRepository->findOneBy(criteria: ['phone' => $request->phone_or_email, 'user_type' => CUSTOMER]);
        } else {
            $user = $this->userRepository->findOneBy(criteria: ['phone' => $request->phone_or_email, 'user_type' => DRIVER]);
        }
        return $user;
    }

    private function generateOtp($user, $otp)
    {
        try {
            $expires_at = env('APP_MODE') == 'live' ? 3 : 1000;
            $attributes = [
                'phone_or_email' => $user->phone,
                'otp' => (string)$otp,
                'expires_at' => Carbon::now()->addMinutes($expires_at),
            ];
            
            \Log::info('=== Starting OTP Generation ===', [
                'phone' => $user->phone,
                'otp' => (string)$otp,
                'expires_at' => $attributes['expires_at'],
            ]);
            
            // Delete old OTP
            $verification = $this->otpVerificationRepository->findOneBy(['phone_or_email' => $user->phone]);
            if ($verification) {
                \Log::info('Deleting old OTP', ['id' => $verification->id, 'old_otp' => $verification->otp]);
                $this->otpVerificationRepository->delete($verification->id);
                \Log::info('Old OTP deleted successfully');
            }
            
            // Create new OTP
            \Log::info('Creating new OTP with attributes', $attributes);
            $created = $this->otpVerificationRepository->create(data: $attributes);
            
            if (!$created) {
                \Log::error('OTP Creation Failed - returned null');
                return $otp;
            }
            
            \Log::info('=== OTP Created Successfully ===', [
                'id' => $created->id,
                'phone_or_email' => $created->phone_or_email,
                'otp_stored' => $created->otp,
                'expires_at' => $created->expires_at,
            ]);
            
            return $otp;
        } catch (\Exception $e) {
            \Log::error('=== OTP Generation Exception ===', [
                'error' => $e->getMessage(),
                'file' => $e->getFile(),
                'line' => $e->getLine(),
                'trace' => $e->getTraceAsString(),
            ]);
            throw $e;
        }
    }

    public function updateLoginUser(string|int $id, array $data): ?Model
    {
        return $this->userRepository->update(id: $id, data: $data);
    }


    public function sendOtpToClient($user, $type = null)
    {
        if ($type == 'trip') {
            $otp = env('APP_MODE') == 'live' ? rand(1000, 9999) : '0000';
            if (self::send($user->phone, $otp) == "not_found") {
                return $this->generateOtp($user, '0000');
            }
            return $this->generateOtp($user, $otp);
        } 
        
        $otp = rand(100000, 999999); 

        if (in_array($type, ['register', 'forget_password'], true) && $this->whySMSService->isEnabled()) {
            if ($this->whySMSService->sendOTP($user->phone, $otp, $type) === 'success') {
                return $this->generateOtp($user, $otp);
            }
        }

        self::send($user->phone, $otp);
        return $this->generateOtp($user, $otp);

    }
}
