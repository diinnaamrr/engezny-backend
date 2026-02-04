<?php

namespace Modules\BusinessManagement\Http\Controllers\Api\New;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;
use Modules\BusinessManagement\Service\Interface\BusinessSettingServiceInterface;
use Modules\BusinessManagement\Service\Interface\ExternalConfigurationServiceInterface;

class ConfigurationController extends Controller
{
    protected $externalConfigurationService;
    protected $businessSettingService;

    public function __construct(ExternalConfigurationServiceInterface $externalConfigurationService,BusinessSettingServiceInterface $businessSettingService)
    {
        $this->externalConfigurationService = $externalConfigurationService;
        $this->businessSettingService = $businessSettingService;
    }

    public function getConfiguration()
    {
        $cta = $this->businessSettingService->findOneBy(criteria: ['key_name' => CTA, 'settings_type' => LANDING_PAGES_SETTINGS]);

        $configs = [
            'business_name' => businessConfig('business_name', BUSINESS_INFORMATION)?->value ?? "DriveMond",
            'logo' => businessConfig('header_logo', BUSINESS_INFORMATION)?->value ? asset(businessConfig('header_logo', BUSINESS_INFORMATION)?->value) : asset('public/assets/admin-module/img/logo.png'),
            'app_url_android' => $cta?->value && $cta?->value['play_store']['user_download_link'] ? $cta?->value['play_store']['user_download_link'] : "",
            'app_url_ios' => $cta?->value && $cta?->value['app_store']['user_download_link'] ? $cta?->value['app_store']['user_download_link'] : "",
        ];
        return response()->json($configs);
    }

    public function updateConfiguration(Request $request)
    {
        $this->externalConfigurationService->updateExternalConfiguration(data: $request->all());
        return response()->json(['message' => 'Configuration updated successfully.']);
    }

    public function getExternalConfiguration(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'mart_base_url' => 'required',
            'mart_token' => 'required',
            'drivemond_token' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['status' => false]);
        }
        $activationMode = externalConfig('activation_mode')?->value;
        $martBaseUrl = externalConfig('mart_base_url')?->value;
        $martToken = externalConfig('mart_token')?->value;
        $systemSelfToken = externalConfig('system_self_token')?->value;
        if ($activationMode == 1 && $request->mart_base_url == $martBaseUrl && $request->mart_token == $martToken && $request->drivemond_token == $systemSelfToken) {
            return response()->json(['status' => true]);
        }

        return response()->json(['status' => false]);
    }

    public function getAppVersionConfig()
    {
        $settings = $this->businessSettingService->getBy(criteria: ['settings_type' => APP_VERSION]);
        $customerAppVersionControlForAndroid = $settings->firstWhere('key_name', CUSTOMER_APP_VERSION_CONTROL_FOR_ANDROID)?->value;
        $customerAppVersionControlForIos = $settings->firstWhere('key_name', CUSTOMER_APP_VERSION_CONTROL_FOR_IOS)?->value;
        $driverAppVersionControlForAndroid = $settings->firstWhere('key_name', DRIVER_APP_VERSION_CONTROL_FOR_ANDROID)?->value;
        $driverAppVersionControlForIos = $settings->firstWhere('key_name', DRIVER_APP_VERSION_CONTROL_FOR_IOS)?->value;

        $customerConfig = [
            'android' => [
                'minimum_app_version' => $customerAppVersionControlForAndroid['minimum_app_version'] ?? '',
                'app_url' => $customerAppVersionControlForAndroid['app_url'] ?? '',
            ],
            'ios' => [
                'minimum_app_version' => $customerAppVersionControlForIos['minimum_app_version'] ?? '',
                'app_url' => $customerAppVersionControlForIos['app_url'] ?? '',
            ],
        ];

        $driverConfig = [
            'android' => [
                'minimum_app_version' => $driverAppVersionControlForAndroid['minimum_app_version'] ?? '',
                'app_url' => $driverAppVersionControlForAndroid['app_url'] ?? '',
            ],
            'ios' => [
                'minimum_app_version' => $driverAppVersionControlForIos['minimum_app_version'] ?? '',
                'app_url' => $driverAppVersionControlForIos['app_url'] ?? '',
            ],
        ];

        return response()->json([
            'customer' => $customerConfig,
            'driver' => $driverConfig,
        ]);
    }

    public function getForceUpdateConfig()
    {
        $setting = $this->businessSettingService->findOneBy(criteria: [
            'settings_type' => APP_VERSION,
            'key_name' => FORCE_UPDATE_CONFIG
        ]);

        if ($setting?->value) {
            $value = $setting->value;
            $value['maintenance']['enabled'] = (bool)($value['maintenance']['enabled'] ?? false);
            $value['android']['force_update'] = (bool)($value['android']['force_update'] ?? false);
            $value['ios']['force_update'] = (bool)($value['ios']['force_update'] ?? false);
            $value['android']['blocked_versions'] = array_values((array)($value['android']['blocked_versions'] ?? []));
            $value['ios']['blocked_versions'] = array_values((array)($value['ios']['blocked_versions'] ?? []));

            return response()->json([
                'success' => true,
                'data' => $value,
            ]);
        }

        return response()->json([
            'success' => true,
            'data' => [
                'maintenance' => [
                    'enabled' => false,
                    'message' => '',
                ],
                'android' => [
                    'min_version' => '',
                    'latest_version' => '',
                    'force_update' => false,
                    'update_url' => '',
                    'blocked_versions' => [],
                ],
                'ios' => [
                    'min_version' => '',
                    'latest_version' => '',
                    'force_update' => false,
                    'update_url' => '',
                    'blocked_versions' => [],
                ],
            ],
        ]);
    }

}
