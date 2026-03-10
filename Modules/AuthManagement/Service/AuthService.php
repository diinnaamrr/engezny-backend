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
        $expires_at = env('APP_MODE') == 'live' ? 3 : 1000;
        $attributes = [
            'phone_or_email' => $user->phone,
            'otp' => $otp,
            'expires_at' => Carbon::now()->addMinutes($expires_at),
        ];
        $verification = $this->otpVerificationRepository->findOneBy(['phone_or_email' => $user->phone]);
        if ($verification) {
            $verification->delete();
        }
        $this->otpVerificationRepository->create(data: $attributes);
        return $otp;
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