@extends('adminmodule::layouts.master')

@section('title', translate('app_version_Setup'))

@push('css_or_js')
@endpush

@section('content')

    <!-- Main Content -->
    <div class="content container-fluid">
        <!-- Page Title -->
        <h2 class="fs-22 mb-4 text-capitalize">{{ translate('system_settings') }}</h2>
        <!-- End Page Title -->

        <!-- Inlile Menu -->
        <div class="mb-4">
            @include('businessmanagement::admin.system-settings.partials._system-settings-inline')
        </div>
        <!-- End Inlile Menu -->

       

        <form action="{{ route('admin.business.force-update.update') }}" method="post" id="appVersion">
            @csrf
            
            <!-- User App Version Control -->
            <div class="card border-0 mb-4">
                <div class="card-body">
                    <div class="d-flex flex-column gap-3">
                        <div class="mb-2">
                            <h5 class="fw-semibold text-capitalize mb-2">{{ translate('User_App_Version_Control') }}</h5>
                            <div class="fs-12">
                                {{ translate('Setup the minimum App versions in which the system will be compatible') }}
                            </div>
                        </div>

                        <!-- User Maintenance -->
                        <div class="card border-0">
                            <div class="card-body">
                                <div class="d-flex flex-column gap-3">
                                    <div class="mb-2">
                                        <h6 class="fw-semibold text-capitalize mb-2">{{ translate('Maintenance_Mode') }}</h6>
                                        <div class="fs-12">
                                            {{ translate('Control app maintenance mode for users') }}
                                        </div>
                                    </div>
                                    <div class="row g-3">
                                        <div class="col-md-4">
                                            <label class="form-label">{{ translate('Enabled') }}</label>
                                            <select name="maintenance_enabled_user" class="form-select">
                                                <option value="0" {{ ($maintenance['enabled'] ?? 0) ? '' : 'selected' }}>False</option>
                                                <option value="1" {{ ($maintenance['enabled'] ?? 0) ? 'selected' : '' }}>True</option>
                                            </select>
                                        </div>
                                        <div class="col-md-8">
                                            <label class="form-label">{{ translate('Message') }}</label>
                                            <input type="text" name="maintenance_message_user"
                                                   class="form-control" placeholder="{{ translate('App is under maintenance') }}"
                                                   value="{{ $maintenance['message'] ?? '' }}">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- For Android -->
                        <div class="card border-0">
                            <div class="card-body">
                                <h5 class="fw-semibold d-flex align-items-center gap-2 mb-4">
                                    <img src="{{ asset('public/assets/admin-module/img/svg/android.svg') }}" class="svg"
                                         alt="{{ translate('Android logo') }}">
                                    {{ translate('For Android') }}
                                </h5>
                                <div class="row gap-md-0 gap-4">
                                    <!-- Minimum Version -->
                                    <div class="col-md-4">
                                        <div class="">
                                            <h6 class="fw-semibold text-capitalize mb-2">
                                                {{ translate('Minimum_App_Version') }}
                                            </h6>
                                            <div class="fs-12 mb-2">
                                                {{ translate("Set minimum Android app version") }}
                                            </div>
                                            <input type="text" name="user_android_minimum_version"
                                                   pattern="^\d+\.\d+\.\d+$"
                                                   title="Format: 1.0.0 or 2.1.5 or 3.0.1"
                                                   value="{{ $userAndroid['minimum_version'] ?? '' }}"
                                                   class="form-control" placeholder="Ex: 1.0.0">
                                            @error('user_android_minimum_version')
                                                <div class="text-danger fs-12">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <!-- Latest Version -->
                                    <div class="col-md-4">
                                        <div class="">
                                            <h6 class="fw-semibold text-capitalize mb-2">
                                                {{ translate('Latest_App_Version') }}
                                            </h6>
                                            <div class="fs-12 mb-2">
                                                {{ translate("Set latest Android app version") }}
                                            </div>
                                            <input type="text" name="user_android_latest_version"
                                                   pattern="^\d+\.\d+\.\d+$"
                                                   title="Format: 1.0.0 or 2.1.5 or 3.0.1"
                                                   value="{{ $userAndroid['latest_version'] ?? '' }}"
                                                   class="form-control" placeholder="Ex: 1.1.0">
                                            @error('user_android_latest_version')
                                                <div class="text-danger fs-12">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <!-- Download URL -->
                                    <div class="col-md-4">
                                        <div class="">
                                            <h6 class="fw-semibold text-capitalize mb-2">
                                                {{ translate('Download_URL') }}
                                            </h6>
                                            <div class="fs-12 mb-2">
                                                {{ translate('Enter Android app download URL') }}
                                            </div>
                                            <input type="url" name="user_android_download_url"
                                                   value="{{ $userAndroid['update_url'] ?? '' }}"
                                                   class="form-control" placeholder="https://play.google.com/store/apps/details?id=...">
                                        </div>
                                    </div>

                                    <!-- Force Update -->
                                    <div class="col-md-4 mt-3">
                                        <div class="">
                                            <h6 class="fw-semibold text-capitalize mb-2">
                                                {{ translate('Force_Update') }}
                                            </h6>
                                            <div class="fs-12 mb-2">
                                                {{ translate('Enable force update for users') }}
                                            </div>
                                            <select name="user_android_force_update" class="form-select">
                                                <option value="0" {{ ($userAndroid['force_update'] ?? 0) ? '' : 'selected' }}>False</option>
                                                <option value="1" {{ ($userAndroid['force_update'] ?? 0) ? 'selected' : '' }}>True</option>
                                            </select>
                                        </div>
                                    </div>

                                    <!-- Blocked Versions -->
                                    <div class="col-md-8 mt-3">
                                        <div class="">
                                            <h6 class="fw-semibold text-capitalize mb-2">
                                                {{ translate('Blocked_Versions') }}
                                            </h6>
                                            <div class="fs-12 mb-2">
                                                {{ translate('Enter versions to block (comma separated or one per line)') }}
                                            </div>
                                            <textarea name="user_android_blocked_versions" class="form-control" rows="3"
                                                      placeholder="1.0.0, 1.0.1 or one per line">{{ isset($userAndroid['blocked_versions']) ? implode("\n", (array)$userAndroid['blocked_versions']) : '' }}</textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- For iOS -->
                        <div class="card border-0 mt-4">
                            <div class="card-body">
                                <h5 class="fw-semibold d-flex align-items-center gap-2 mb-4">
                                    <img src="{{ asset('public/assets/admin-module/img/svg/apple.svg') }}" class="svg"
                                         alt="{{ translate('iOS logo') }}">
                                    {{ translate('For iOS') }}
                                </h5>
                                <div class="row gap-md-0 gap-4">
                                    <!-- Minimum Version -->
                                    <div class="col-md-4">
                                        <div class="">
                                            <h6 class="fw-semibold text-capitalize mb-2">
                                                {{ translate('Minimum_App_Version') }}
                                            </h6>
                                            <div class="fs-12 mb-2">
                                                {{ translate("Set minimum iOS app version") }}
                                            </div>
                                            <input type="text" name="user_ios_minimum_version"
                                                   pattern="^\d+\.\d+\.\d+$"
                                                   title="Format: 1.0.0 or 2.1.5 or 3.0.1"
                                                   value="{{ $userIos['minimum_version'] ?? '' }}"
                                                   class="form-control" placeholder="Ex: 1.0.0">
                                            @error('user_ios_minimum_version')
                                                <div class="text-danger fs-12">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <!-- Latest Version -->
                                    <div class="col-md-4">
                                        <div class="">
                                            <h6 class="fw-semibold text-capitalize mb-2">
                                                {{ translate('Latest_App_Version') }}
                                            </h6>
                                            <div class="fs-12 mb-2">
                                                {{ translate("Set latest iOS app version") }}
                                            </div>
                                            <input type="text" name="user_ios_latest_version"
                                                   pattern="^\d+\.\d+\.\d+$"
                                                   title="Format: 1.0.0 or 2.1.5 or 3.0.1"
                                                   value="{{ $userIos['latest_version'] ?? '' }}"
                                                   class="form-control" placeholder="Ex: 1.1.0">
                                            @error('user_ios_latest_version')
                                                <div class="text-danger fs-12">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <!-- Download URL -->
                                    <div class="col-md-4">
                                        <div class="">
                                            <h6 class="fw-semibold text-capitalize mb-2">
                                                {{ translate('Download_URL') }}
                                            </h6>
                                            <div class="fs-12 mb-2">
                                                {{ translate('Enter iOS app download URL') }}
                                            </div>
                                            <input type="url" name="user_ios_download_url"
                                                   value="{{ $userIos['update_url'] ?? '' }}"
                                                   class="form-control" placeholder="https://apps.apple.com/app/id...">
                                        </div>
                                    </div>

                                    <!-- Force Update -->
                                    <div class="col-md-4 mt-3">
                                        <div class="">
                                            <h6 class="fw-semibold text-capitalize mb-2">
                                                {{ translate('Force_Update') }}
                                            </h6>
                                            <div class="fs-12 mb-2">
                                                {{ translate('Enable force update for users') }}
                                            </div>
                                            <select name="user_ios_force_update" class="form-select">
                                                <option value="0" {{ ($userIos['force_update'] ?? 0) ? '' : 'selected' }}>False</option>
                                                <option value="1" {{ ($userIos['force_update'] ?? 0) ? 'selected' : '' }}>True</option>
                                            </select>
                                        </div>
                                    </div>

                                    <!-- Blocked Versions -->
                                    <div class="col-md-8 mt-3">
                                        <div class="">
                                            <h6 class="fw-semibold text-capitalize mb-2">
                                                {{ translate('Blocked_Versions') }}
                                            </h6>
                                            <div class="fs-12 mb-2">
                                                {{ translate('Enter versions to block (comma separated or one per line)') }}
                                            </div>
                                            <textarea name="user_ios_blocked_versions" class="form-control" rows="3"
                                                      placeholder="1.0.0, 1.0.1 or one per line">{{ isset($userIos['blocked_versions']) ? implode("\n", (array)$userIos['blocked_versions']) : '' }}</textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Driver App Version Control -->
            <div class="card border-0 mt-4">
                <div class="card-body">
                    <div class="d-flex flex-column gap-3">
                        <div class="mb-2">
                            <h5 class="fw-semibold text-capitalize mb-2">
                                {{ translate('Driver_App_Version_Control') }}
                            </h5>
                            <div class="fs-12">
                                {{ translate('Setup the minimum App versions in which the system will be compatible') }}
                            </div>
                        </div>

                        <!-- Driver Maintenance -->
                        <div class="card border-0">
                            <div class="card-body">
                                <div class="d-flex flex-column gap-3">
                                    <div class="mb-2">
                                        <h6 class="fw-semibold text-capitalize mb-2">{{ translate('Maintenance_Mode') }}</h6>
                                        <div class="fs-12">
                                            {{ translate('Control app maintenance mode for drivers') }}
                                        </div>
                                    </div>
                                    <div class="row g-3">
                                        <div class="col-md-4">
                                            <label class="form-label">{{ translate('Enabled') }}</label>
                                            <select name="maintenance_enabled_driver" class="form-select">
                                                <option value="0" {{ ($driverMaintenance['enabled'] ?? 0) ? '' : 'selected' }}>False</option>
                                                <option value="1" {{ ($driverMaintenance['enabled'] ?? 0) ? 'selected' : '' }}>True</option>
                                            </select>
                                        </div>
                                        <div class="col-md-8">
                                            <label class="form-label">{{ translate('Message') }}</label>
                                            <input type="text" name="maintenance_message_driver"
                                                   class="form-control" placeholder="{{ translate('App is under maintenance') }}"
                                                   value="{{ $driverMaintenance['message'] ?? '' }}">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- For Android -->
                        <div class="card border-0">
                            <div class="card-body">
                                <h5 class="fw-semibold d-flex align-items-center gap-2 mb-4">
                                    <img src="{{ asset('public/assets/admin-module/img/svg/android.svg') }}" class="svg"
                                         alt="{{ translate('Android logo') }}">
                                    {{ translate('For Android') }}
                                </h5>
                                <div class="row gap-md-0 gap-4">
                                    <!-- Minimum Version -->
                                    <div class="col-md-4">
                                        <div class="">
                                            <h6 class="fw-semibold text-capitalize mb-2">
                                                {{ translate('Minimum_App_Version') }}
                                            </h6>
                                            <div class="fs-12 mb-2">
                                                {{ translate("Set minimum Android app version") }}
                                            </div>
                                            <input type="text" name="driver_android_minimum_version"
                                                   pattern="^\d+\.\d+\.\d+$"
                                                   title="Format: 1.0.0 or 2.1.5 or 3.0.1"
                                                   value="{{ $driverAndroid['minimum_version'] ?? '' }}"
                                                   class="form-control" placeholder="Ex: 1.0.0">
                                            @error('driver_android_minimum_version')
                                                <div class="text-danger fs-12">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <!-- Latest Version -->
                                    <div class="col-md-4">
                                        <div class="">
                                            <h6 class="fw-semibold text-capitalize mb-2">
                                                {{ translate('Latest_App_Version') }}
                                            </h6>
                                            <div class="fs-12 mb-2">
                                                {{ translate("Set latest Android app version") }}
                                            </div>
                                            <input type="text" name="driver_android_latest_version"
                                                   pattern="^\d+\.\d+\.\d+$"
                                                   title="Format: 1.0.0 or 2.1.5 or 3.0.1"
                                                   value="{{ $driverAndroid['latest_version'] ?? '' }}"
                                                   class="form-control" placeholder="Ex: 1.1.0">
                                            @error('driver_android_latest_version')
                                                <div class="text-danger fs-12">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <!-- Download URL -->
                                    <div class="col-md-4">
                                        <div class="">
                                            <h6 class="fw-semibold text-capitalize mb-2">
                                                {{ translate('Download_URL') }}
                                            </h6>
                                            <div class="fs-12 mb-2">
                                                {{ translate('Enter Android app download URL') }}
                                            </div>
                                            <input type="url" name="driver_android_download_url"
                                                   value="{{ $driverAndroid['update_url'] ?? '' }}"
                                                   class="form-control" placeholder="https://play.google.com/store/apps/details?id=...">
                                        </div>
                                    </div>

                                    <!-- Force Update -->
                                    <div class="col-md-4 mt-3">
                                        <div class="">
                                            <h6 class="fw-semibold text-capitalize mb-2">
                                                {{ translate('Force_Update') }}
                                            </h6>
                                            <div class="fs-12 mb-2">
                                                {{ translate('Enable force update') }}
                                            </div>
                                            <select name="driver_android_force_update" class="form-select">
                                                <option value="0" {{ ($driverAndroid['force_update'] ?? 0) ? '' : 'selected' }}>False</option>
                                                <option value="1" {{ ($driverAndroid['force_update'] ?? 0) ? 'selected' : '' }}>True</option>
                                            </select>
                                        </div>
                                    </div>

                                    <!-- Blocked Versions -->
                                    <div class="col-md-8 mt-3">
                                        <div class="">
                                            <h6 class="fw-semibold text-capitalize mb-2">
                                                {{ translate('Blocked_Versions') }}
                                            </h6>
                                            <div class="fs-12 mb-2">
                                                {{ translate('Enter versions to block (comma separated or one per line)') }}
                                            </div>
                                            <textarea name="driver_android_blocked_versions" class="form-control" rows="3"
                                                      placeholder="1.0.0, 1.0.1 or one per line">{{ isset($driverAndroid['blocked_versions']) ? implode("\n", (array)$driverAndroid['blocked_versions']) : '' }}</textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- For iOS -->
                        <div class="card border-0 mt-4">
                            <div class="card-body">
                                <h5 class="fw-semibold d-flex align-items-center gap-2 mb-4">
                                    <img src="{{ asset('public/assets/admin-module/img/svg/apple.svg') }}" class="svg"
                                         alt="{{ translate('iOS logo') }}">
                                    {{ translate('For iOS') }}
                                </h5>
                                <div class="row gap-md-0 gap-4">
                                    <!-- Minimum Version -->
                                    <div class="col-md-4">
                                        <div class="">
                                            <h6 class="fw-semibold text-capitalize mb-2">
                                                {{ translate('Minimum_App_Version') }}
                                            </h6>
                                            <div class="fs-12 mb-2">
                                                {{ translate("Set minimum iOS app version") }}
                                            </div>
                                            <input type="text" name="driver_ios_minimum_version"
                                                   pattern="^\d+\.\d+\.\d+$"
                                                   title="Format: 1.0.0 or 2.1.5 or 3.0.1"
                                                   value="{{ $driverIos['minimum_version'] ?? '' }}"
                                                   class="form-control" placeholder="Ex: 1.0.0">
                                            @error('driver_ios_minimum_version')
                                                <div class="text-danger fs-12">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <!-- Latest Version -->
                                    <div class="col-md-4">
                                        <div class="">
                                            <h6 class="fw-semibold text-capitalize mb-2">
                                                {{ translate('Latest_App_Version') }}
                                            </h6>
                                            <div class="fs-12 mb-2">
                                                {{ translate("Set latest iOS app version") }}
                                            </div>
                                            <input type="text" name="driver_ios_latest_version"
                                                   pattern="^\d+\.\d+\.\d+$"
                                                   title="Format: 1.0.0 or 2.1.5 or 3.0.1"
                                                   value="{{ $driverIos['latest_version'] ?? '' }}"
                                                   class="form-control" placeholder="Ex: 1.1.0">
                                            @error('driver_ios_latest_version')
                                                <div class="text-danger fs-12">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <!-- Download URL -->
                                    <div class="col-md-4">
                                        <div class="">
                                            <h6 class="fw-semibold text-capitalize mb-2">
                                                {{ translate('Download_URL') }}
                                            </h6>
                                            <div class="fs-12 mb-2">
                                                {{ translate('Enter iOS app download URL') }}
                                            </div>
                                            <input type="url" name="driver_ios_download_url"
                                                   value="{{ $driverIos['update_url'] ?? '' }}"
                                                   class="form-control" placeholder="https://apps.apple.com/app/id...">
                                        </div>
                                    </div>

                                    <!-- Force Update -->
                                    <div class="col-md-4 mt-3">
                                        <div class="">
                                            <h6 class="fw-semibold text-capitalize mb-2">
                                                {{ translate('Force_Update') }}
                                            </h6>
                                            <div class="fs-12 mb-2">
                                                {{ translate('Enable force update') }}
                                            </div>
                                            <select name="driver_ios_force_update" class="form-select">
                                                <option value="0" {{ ($driverIos['force_update'] ?? 0) ? '' : 'selected' }}>False</option>
                                                <option value="1" {{ ($driverIos['force_update'] ?? 0) ? 'selected' : '' }}>True</option>
                                            </select>
                                        </div>
                                    </div>

                                    <!-- Blocked Versions -->
                                    <div class="col-md-8 mt-3">
                                        <div class="">
                                            <h6 class="fw-semibold text-capitalize mb-2">
                                                {{ translate('Blocked_Versions') }}
                                            </h6>
                                            <div class="fs-12 mb-2">
                                                {{ translate('Enter versions to block (comma separated or one per line)') }}
                                            </div>
                                            <textarea name="driver_ios_blocked_versions" class="form-control" rows="3"
                                                      placeholder="1.0.0, 1.0.1 or one per line">{{ isset($driverIos['blocked_versions']) ? implode("\n", (array)$driverIos['blocked_versions']) : '' }}</textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="d-flex justify-content-end mt-4">
                <button type="{{ env('APP_MODE') != 'demo' ? 'submit' : 'button' }}"
                        class="btn btn-primary text-uppercase btn-lg call-demo">{{ translate('save') }}</button>
            </div>
        </form>
    </div>
    <!-- End Main Content -->

@endsection

