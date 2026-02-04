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
        $meta = $value['meta'] ?? [];
        $android = $value['android'] ?? [];
        $ios = $value['ios'] ?? [];

        return view('businessmanagement::admin.system-settings.force-update', compact('meta', 'android', 'ios'));
    }

    public function updateForceUpdate(Request $request): Renderable|RedirectResponse
    {
        $this->authorize('business_edit');

        $data = $request->validate([
            'meta_updated_at' => 'nullable|string',
            'meta_updated_by' => 'nullable|string',
            'meta_change_reason' => 'nullable|string',
            'android_exact_blocked_version' => 'nullable|string',
            'android_min_supported_version' => 'nullable|string',
            'android_maintenance_mode' => 'nullable|in:0,1',
            'android_maintenance_message' => 'nullable|string',
            'ios_exact_blocked_version' => 'nullable|string',
            'ios_min_supported_version' => 'nullable|string',
            'ios_maintenance_mode' => 'nullable|in:0,1',
            'ios_maintenance_message' => 'nullable|string',
        ]);

        $payload = [
            'meta' => [
                'updated_at' => $data['meta_updated_at'] ?? '',
                'updated_by' => $data['meta_updated_by'] ?? '',
                'change_reason' => $data['meta_change_reason'] ?? '',
            ],
            'android' => [
                'exact_blocked_version' => $data['android_exact_blocked_version'] ?? '',
                'min_supported_version' => $data['android_min_supported_version'] ?? '',
                'maintenance_mode' => isset($data['android_maintenance_mode']) ? (int)$data['android_maintenance_mode'] : 0,
                'maintenance_message' => $data['android_maintenance_message'] ?? '',
            ],
            'ios' => [
                'exact_blocked_version' => $data['ios_exact_blocked_version'] ?? '',
                'min_supported_version' => $data['ios_min_supported_version'] ?? '',
                'maintenance_mode' => isset($data['ios_maintenance_mode']) ? (int)$data['ios_maintenance_mode'] : 0,
                'maintenance_message' => $data['ios_maintenance_message'] ?? '',
            ],
        ];

        $this->systemSettingService->storeForceUpdateConfig($payload);
        Toastr::success(SYSTEM_SETTING_UPDATE_200['message']);
        return back();
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
