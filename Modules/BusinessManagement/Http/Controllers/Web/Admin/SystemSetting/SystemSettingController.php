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
        $customerAppVersionControlForAndroid = $settings->firstWhere('key_name', CUSTOMER_APP_VERSION_CONTROL_FOR_ANDROID)?->value;
        $customerAppVersionControlForIos = $settings->firstWhere('key_name', CUSTOMER_APP_VERSION_CONTROL_FOR_IOS)?->value;
        $driverAppVersionControlForAndroid = $settings->firstWhere('key_name', DRIVER_APP_VERSION_CONTROL_FOR_ANDROID)?->value;
        $driverAppVersionControlForIos = $settings->firstWhere('key_name', DRIVER_APP_VERSION_CONTROL_FOR_IOS)?->value;
        return view('businessmanagement::admin.system-settings.app-version-setup',
            compact('customerAppVersionControlForAndroid', 'customerAppVersionControlForIos', 'driverAppVersionControlForAndroid', 'driverAppVersionControlForIos'));
    }

    public function appVersionConfig()
    {
        $this->authorize('business_view');

        $settings = $this->systemSettingService->getBy(criteria: ['settings_type' => APP_VERSION]);
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

        return view('businessmanagement::admin.system-settings.app-version-config', [
            'customerConfigJson' => json_encode($customerConfig, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES),
            'driverConfigJson' => json_encode($driverConfig, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES),
        ]);
    }

    public function updateAppVersionSetup(AppVersionSettingStoreOrUpdateRequest $request): Renderable|RedirectResponse
    {
        $this->authorize('business_edit');
        $this->systemSettingService->storeAppVersion($request->validated());
        Toastr::success(SYSTEM_SETTING_UPDATE_200['message']);
        return back();
    }

    public function forceUpdate()
    {
        $this->authorize('business_view');
        $setting = $this->systemSettingService->findOneBy(criteria: [
            'settings_type' => APP_VERSION,
            'key_name' => FORCE_UPDATE_CONFIG
        ]);

        $value = $setting?->value ?? [];
        $maintenance = $value['maintenance'] ?? [];
        $android = $value['android'] ?? [];
        $ios = $value['ios'] ?? [];

        return view('businessmanagement::admin.system-settings.force-update', compact('maintenance', 'android', 'ios'));
    }

    public function updateForceUpdate(Request $request): Renderable|RedirectResponse
    {
        $this->authorize('business_edit');

        $data = $request->validate([
            'maintenance_enabled' => 'nullable|in:0,1',
            'maintenance_message' => 'nullable|string',
            'android_min_version' => 'nullable|string',
            'android_latest_version' => 'nullable|string',
            'android_force_update' => 'nullable|in:0,1',
            'android_update_url' => 'nullable|string',
            'android_blocked_versions' => 'nullable|string',
            'ios_min_version' => 'nullable|string',
            'ios_latest_version' => 'nullable|string',
            'ios_force_update' => 'nullable|in:0,1',
            'ios_update_url' => 'nullable|string',
            'ios_blocked_versions' => 'nullable|string',
        ]);

        $androidBlocked = $this->parseBlockedVersions($data['android_blocked_versions'] ?? '');
        $iosBlocked = $this->parseBlockedVersions($data['ios_blocked_versions'] ?? '');
        $invalid = array_merge(
            $this->invalidVersions($androidBlocked),
            $this->invalidVersions($iosBlocked)
        );
        if (!empty($invalid)) {
            Toastr::error('Blocked versions must be in the format x.y.z (e.g., 1.0.0).');
            return back()->withInput();
        }

        $payload = [
            'maintenance' => [
                'enabled' => isset($data['maintenance_enabled']) ? (int)$data['maintenance_enabled'] : 0,
                'message' => $data['maintenance_message'] ?? '',
            ],
            'android' => [
                'min_version' => $data['android_min_version'] ?? '',
                'latest_version' => $data['android_latest_version'] ?? '',
                'force_update' => isset($data['android_force_update']) ? (int)$data['android_force_update'] : 0,
                'update_url' => $data['android_update_url'] ?? '',
                'blocked_versions' => $androidBlocked,
            ],
            'ios' => [
                'min_version' => $data['ios_min_version'] ?? '',
                'latest_version' => $data['ios_latest_version'] ?? '',
                'force_update' => isset($data['ios_force_update']) ? (int)$data['ios_force_update'] : 0,
                'update_url' => $data['ios_update_url'] ?? '',
                'blocked_versions' => $iosBlocked,
            ],
        ];

        $this->systemSettingService->storeForceUpdateConfig($payload);
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
