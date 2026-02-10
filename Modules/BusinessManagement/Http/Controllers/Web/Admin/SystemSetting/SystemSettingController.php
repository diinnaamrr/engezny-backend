<?php

namespace Modules\BusinessManagement\Http\Controllers\Web\Admin\SystemSetting;

use App\Http\Controllers\BaseController;
use Brian2694\Toastr\Facades\Toastr;
use Exception;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Modules\BusinessManagement\Http\Requests\AppVersionSettingStoreOrUpdateRequest;
use Modules\BusinessManagement\Service\Interface\BusinessSettingServiceInterface;

class SystemSettingController extends BaseController
{
    use AuthorizesRequests;

    protected $systemSettingService;

    public function __construct(BusinessSettingServiceInterface $businessSettingService)
    {
        parent::__construct($businessSettingService);
        $this->systemSettingService = $businessSettingService;
    }

    public function envSetup()
    {
        $this->authorize('business_view');
        return view('businessmanagement::admin.system-settings.environment-setup');
    }

    public function envUpdate(Request $request): Renderable|RedirectResponse
    {
        $this->authorize('business_edit');
        try {
            $env = app()->environmentFilePath();
            try {
                chmod($env, 777);
            } catch (Exception $exception) {

            }
            self::setEnvironmentValue('APP_DEBUG', $request['app_debug'] ?? env('APP_DEBUG'));
            self::setEnvironmentValue('APP_MODE', $request['app_mode'] ?? env('APP_MODE'));
        } catch (\Exception $exception) {
            Toastr::error(DEFAULT_FAIL_200['message']);
            return back();
        }

        Toastr::success(SYSTEM_SETTING_UPDATE_200['message']);
        return back();
    }

    public function appVersionSetup()
    {
        $this->authorize('business_view');
        $settings = $this->systemSettingService->getBy(criteria: ['settings_type' => APP_VERSION]);

        $userSetting = $settings->firstWhere('key_name', 'force_update_config_user')?->value;
        $driverSetting = $settings->firstWhere('key_name', 'force_update_config_driver')?->value;

        $userValue = $this->decodeJsonValue($userSetting);
        $driverValue = $this->decodeJsonValue($driverSetting);

        if (empty($userValue) && empty($driverValue)) {
            $commonSetting = $settings->firstWhere('key_name', FORCE_UPDATE_CONFIG)?->value;
            $commonValue = $this->decodeJsonValue($commonSetting);
            $userValue = $commonValue;
            $driverValue = $commonValue;
        }

        return view('businessmanagement::admin.system-settings.app-version-setup', [
            'maintenance' => $userValue['maintenance'] ?? [],
            'driverMaintenance' => $driverValue['maintenance'] ?? [],
            'userAndroid' => $userValue['android'] ?? [],
            'userIos' => $userValue['ios'] ?? [],
            'driverAndroid' => $driverValue['android'] ?? [],
            'driverIos' => $driverValue['ios'] ?? [],
        ]);
    }

    public function appVersionConfig()
    {
        $this->authorize('business_view');

        $settings = $this->systemSettingService->getBy(criteria: ['settings_type' => APP_VERSION]);

        $userSetting = $settings->firstWhere('key_name', 'force_update_config_user')?->value;
        $driverSetting = $settings->firstWhere('key_name', 'force_update_config_driver')?->value;

        $userValue = $this->decodeJsonValue($userSetting);
        $driverValue = $this->decodeJsonValue($driverSetting);

        if (empty($userValue) && empty($driverValue)) {
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
        } else {
            $customerConfig = $userValue;
            $driverConfig = !empty($driverValue) ? $driverValue : $userValue;
        }

        return view('businessmanagement::admin.system-settings.app-version-config', [
            'customerConfigJson' => json_encode($customerConfig, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES),
            'driverConfigJson' => json_encode($driverConfig, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES),
        ]);
    }

    public function updateAppVersionSetup(Request $request): Renderable|RedirectResponse
    {
        $this->authorize('business_edit');
        $this->systemSettingService->storeAppVersion($request->validated());
        Toastr::success(SYSTEM_SETTING_UPDATE_200['message']);
        return back();
    }

public function forceUpdate()
{
    $this->authorize('business_view');

    $userSetting = $this->systemSettingService->findOneBy([
        'settings_type' => APP_VERSION,
        'key_name' => 'force_update_config_user'
    ]);

    $driverSetting = $this->systemSettingService->findOneBy([
        'settings_type' => APP_VERSION,
        'key_name' => 'force_update_config_driver'
    ]);

    // تحويل JSON string إلى array
    $userValue = $this->decodeJsonValue($userSetting?->value);
    $driverValue = $this->decodeJsonValue($driverSetting?->value);

    // fallback لو البيانات فاضية
    if (empty($userValue) && empty($driverValue)) {
        $commonSetting = $this->systemSettingService->findOneBy([
            'settings_type' => APP_VERSION,
            'key_name' => 'force_update_config'
        ]);

        $commonValue = $this->decodeJsonValue($commonSetting?->value);
        $userValue = $commonValue;
        $driverValue = $commonValue;
    }

    return view('businessmanagement::admin.system-settings.app-version-setup', [
        'maintenance' => $userValue['maintenance'] ?? [],
        'driverMaintenance' => $driverValue['maintenance'] ?? [],
        'userAndroid' => $userValue['android'] ?? [],
        'userIos' => $userValue['ios'] ?? [],
        'driverAndroid' => $driverValue['android'] ?? [],
        'driverIos' => $driverValue['ios'] ?? [],
    ]);
}

private function decodeJsonValue($value): array
{
    if (is_string($value)) {
        $decoded = json_decode($value, true);
        return is_array($decoded) ? $decoded : [];
    }
    return is_array($value) ? $value : [];
}


  public function updateForceUpdate(Request $request): Renderable|RedirectResponse
{
    $this->authorize('business_edit');

    $data = $request->validate([
        'maintenance_enabled_user' => 'nullable|in:0,1',
        'maintenance_message_user' => 'nullable|string',
        'maintenance_enabled_driver' => 'nullable|in:0,1',
        'maintenance_message_driver' => 'nullable|string',
        
        // User Android
        'user_android_minimum_version' => 'nullable|regex:/^\d+\.\d+\.\d+$/',
        'user_android_latest_version' => 'nullable|regex:/^\d+\.\d+\.\d+$/',
        'user_android_force_update' => 'nullable|in:0,1',
        'user_android_download_url' => 'nullable|url',
        'user_android_blocked_versions' => 'nullable|string',
        
        // User iOS
        'user_ios_minimum_version' => 'nullable|regex:/^\d+\.\d+\.\d+$/',
        'user_ios_latest_version' => 'nullable|regex:/^\d+\.\d+\.\d+$/',
        'user_ios_force_update' => 'nullable|in:0,1',
        'user_ios_download_url' => 'nullable|url',
        'user_ios_blocked_versions' => 'nullable|string',
        
        // Driver Android
        'driver_android_minimum_version' => 'nullable|regex:/^\d+\.\d+\.\d+$/',
        'driver_android_latest_version' => 'nullable|regex:/^\d+\.\d+\.\d+$/',
        'driver_android_force_update' => 'nullable|in:0,1',
        'driver_android_download_url' => 'nullable|url',
        'driver_android_blocked_versions' => 'nullable|string',
        
        // Driver iOS
        'driver_ios_minimum_version' => 'nullable|regex:/^\d+\.\d+\.\d+$/',
        'driver_ios_latest_version' => 'nullable|regex:/^\d+\.\d+\.\d+$/',
        'driver_ios_force_update' => 'nullable|in:0,1',
        'driver_ios_download_url' => 'nullable|url',
        'driver_ios_blocked_versions' => 'nullable|string',
    ]);

    // Parse blocked versions لكل نوع
    $userAndroidBlocked = $this->parseBlockedVersions($data['user_android_blocked_versions'] ?? '');
    $userIosBlocked = $this->parseBlockedVersions($data['user_ios_blocked_versions'] ?? '');
    $driverAndroidBlocked = $this->parseBlockedVersions($data['driver_android_blocked_versions'] ?? '');
    $driverIosBlocked = $this->parseBlockedVersions($data['driver_ios_blocked_versions'] ?? '');
    
    $invalid = array_merge(
        $this->invalidVersions($userAndroidBlocked),
        $this->invalidVersions($userIosBlocked),
        $this->invalidVersions($driverAndroidBlocked),
        $this->invalidVersions($driverIosBlocked)
    );
    
    if (!empty($invalid)) {
        Toastr::error('Blocked versions must be in the format x.y.z (e.g., 1.0.0).');
        return back()->withInput();
    }

    // إعدادات Maintenance لكل نوع
    $maintenanceUserData = [
        'enabled' => isset($data['maintenance_enabled_user']) ? (int)$data['maintenance_enabled_user'] : 0,
        'message' => $data['maintenance_message_user'] ?? '',
    ];
    $maintenanceDriverData = [
        'enabled' => isset($data['maintenance_enabled_driver']) ? (int)$data['maintenance_enabled_driver'] : 0,
        'message' => $data['maintenance_message_driver'] ?? '',
    ];

    // حفظ User settings
    $userPayload = [
        'maintenance' => $maintenanceUserData,
        'android' => [
            'minimum_version' => $data['user_android_minimum_version'] ?? '',
            'latest_version' => $data['user_android_latest_version'] ?? '',
            'force_update' => isset($data['user_android_force_update']) ? (int)$data['user_android_force_update'] : 0,
            'blocked_versions' => $userAndroidBlocked,
            'update_url' => $data['user_android_download_url'] ?? '',
        ],
        'ios' => [
            'minimum_version' => $data['user_ios_minimum_version'] ?? '',
            'latest_version' => $data['user_ios_latest_version'] ?? '',
            'force_update' => isset($data['user_ios_force_update']) ? (int)$data['user_ios_force_update'] : 0,
            'blocked_versions' => $userIosBlocked,
            'update_url' => $data['user_ios_download_url'] ?? '',
        ]
    ];

    // حفظ Driver settings
    $driverPayload = [
        'maintenance' => $maintenanceDriverData,
        'android' => [
            'minimum_version' => $data['driver_android_minimum_version'] ?? '',
            'latest_version' => $data['driver_android_latest_version'] ?? '',
            'force_update' => isset($data['driver_android_force_update']) ? (int)$data['driver_android_force_update'] : 0,
            'blocked_versions' => $driverAndroidBlocked,
            'update_url' => $data['driver_android_download_url'] ?? '',
        ],
        'ios' => [
            'minimum_version' => $data['driver_ios_minimum_version'] ?? '',
            'latest_version' => $data['driver_ios_latest_version'] ?? '',
            'force_update' => isset($data['driver_ios_force_update']) ? (int)$data['driver_ios_force_update'] : 0,
            'blocked_versions' => $driverIosBlocked,
            'update_url' => $data['driver_ios_download_url'] ?? '',
        ]
    ];

$this->systemSettingService->storeForceUpdateConfig($userPayload, $driverPayload);
    Toastr::success(SYSTEM_SETTING_UPDATE_200['message']);
    return back();
}
    private function parseBlockedVersions(string $raw): array
    {
        $parts = preg_split('/[\s,]+/', $raw, -1, PREG_SPLIT_NO_EMPTY);
        $parts = array_map('trim', $parts ?: []);
        $parts = array_filter($parts, fn ($v) => $v !== '');
        return array_values(array_unique($parts));
    }

    private function invalidVersions(array $versions): array
    {
        $invalid = [];
        foreach ($versions as $version) {
            if (!preg_match('/^\d+\.\d+\.\d+$/', $version)) {
                $invalid[] = $version;
            }
        }
        return $invalid;
    }


    public function dbIndex(): Renderable
    {
        $this->authorize('business_view');
        $db_name = env('DB_DATABASE');
        $tables = DB::select('SHOW TABLES');
        $tables = collect($tables)->flatten()->pluck('Tables_in_' . $db_name)->toArray();

        $filter_tables = array("banner_setups", "channel_conversations", "channel_lists", "channel_users",
            "conversation_files", "coupon_setups", "coupon_setup_vehicle_category", "discount_setups", "discount_setup_vehicle_category",
            "failed_jobs", "fare_biddings", "module_accesses", "notification_settings", "parcels", "parcel_categories", "parcel_fares",
            "parcel_fares_parcel_weights", "parcel_weights", "social_links", "trip_fares", "trip_requests", "trip_routes", "trip_status"
        , "vehicles", "vehicle_brands", "vehicle_categories", "vehicle_category_zone", "vehicle_models");

        $tables = array_intersect($tables, $filter_tables);

        return view('businessmanagement::admin.system-settings.clean-database', compact('tables'));

    }

    public function cleanDb(Request $request): RedirectResponse|Renderable
    {
        $this->authorize('business_edit');
        $tables = (array)$request['tables'];
        if (count($tables) < 1) {
            Toastr::error(NO_CHANGES_FOUND['message']);
            return back();
        }

        try {
            DB::transaction(function () use ($tables) {
                foreach ($tables as $table) {
                    DB::table($table)->delete();
                }
            });
        } catch (\Exception $exception) {
            Toastr::error(DEFAULT_FAIL_200['message']);
            return back();
        }

        Toastr::success(DEFAULT_DELETE_200['message']);
        return back();
    }


    private static function setEnvironmentValue($key, $value)
    {
        $env = app()->environmentFilePath();

        try {
            chmod($env, 777);
        } catch (Exception $exception) {

        }
        $str = file_get_contents($env);

        if (is_bool(env($key))) {
            $oldValue = var_export(env($key), true);
        } else {
            $oldValue = env($key);
        }
        if (str_contains($str, $key)) {
            $str = str_replace("{$key}={$oldValue}", "{$key}={$value}", $str);

        } else {
            $str .= "{$key}={$value}\n";
        }
        $file = fopen(base_path('.env'), 'w');
        fwrite($file, $str);
        fclose($file);

        return $value;
    }
}
