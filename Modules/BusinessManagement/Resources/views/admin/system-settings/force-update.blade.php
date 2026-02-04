@extends('adminmodule::layouts.master')

@section('title', 'Force Update')

@section('content')
    <div class="content container-fluid">
        <h2 class="fs-22 mb-4 text-capitalize">{{ translate('system_settings') }}</h2>

        <div class="mb-4">
            @include('businessmanagement::admin.system-settings.partials._system-settings-inline')
        </div>

        <form action="{{route('admin.business.force-update.update')}}" method="post" id="forceUpdateForm">
            @csrf
            <div class="card border-0 mb-4">
                <div class="card-body">
                    <div class="mb-3">
                        <h5 class="fw-semibold mb-2">Force Update</h5>
                        <div class="fs-12">
                            Enter values below and the JSON preview will update automatically.
                        </div>
                    </div>

                    <div class="card border-0 mb-3">
                        <div class="card-body">
                            <h6 class="fw-semibold mb-3">Maintenance</h6>
                            <div class="row g-3">
                                <div class="col-md-4">
                                    <label class="form-label">Enabled</label>
                                    <select name="maintenance_enabled" id="maintenance_enabled"
                                            class="form-select">
                                        <option value="0" {{ ($maintenance['enabled'] ?? 0) ? '' : 'selected' }}>False</option>
                                        <option value="1" {{ ($maintenance['enabled'] ?? 0) ? 'selected' : '' }}>True</option>
                                    </select>
                                </div>
                                <div class="col-md-8">
                                    <label class="form-label">Message</label>
                                    <input type="text" name="maintenance_message" id="maintenance_message"
                                           class="form-control" placeholder="التطبيق تحت الصيانة"
                                           value="{{ $maintenance['message'] ?? '' }}">
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="mb-4">
                        <h6 class="fw-semibold mb-3">Android</h6>
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label">Min Version</label>
                                <input type="text" name="android_min_version"
                                       id="android_min_version"
                                       class="form-control" placeholder="1.0.0"
                                       value="{{ $android['min_version'] ?? '' }}">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Latest Version</label>
                                <input type="text" name="android_latest_version"
                                       id="android_latest_version"
                                       class="form-control" placeholder="1.0.5"
                                       value="{{ $android['latest_version'] ?? '' }}">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Force Update</label>
                                <select name="android_force_update" id="android_force_update"
                                        class="form-select">
                                    <option value="0" {{ ($android['force_update'] ?? 0) ? '' : 'selected' }}>False</option>
                                    <option value="1" {{ ($android['force_update'] ?? 0) ? 'selected' : '' }}>True</option>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Update URL</label>
                                <input type="text" name="android_update_url"
                                       id="android_update_url"
                                       class="form-control" placeholder="https://play.google.com/store"
                                       value="{{ $android['update_url'] ?? '' }}">
                            </div>
                        </div>
                    </div>

                    <div class="mb-4">
                        <h6 class="fw-semibold mb-3">iOS</h6>
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label">Min Version</label>
                                <input type="text" name="ios_min_version"
                                       id="ios_min_version"
                                       class="form-control" placeholder="1.0.0"
                                       value="{{ $ios['min_version'] ?? '' }}">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Latest Version</label>
                                <input type="text" name="ios_latest_version"
                                       id="ios_latest_version"
                                       class="form-control" placeholder="1.0.4"
                                       value="{{ $ios['latest_version'] ?? '' }}">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Force Update</label>
                                <select name="ios_force_update" id="ios_force_update"
                                        class="form-select">
                                    <option value="0" {{ ($ios['force_update'] ?? 0) ? '' : 'selected' }}>False</option>
                                    <option value="1" {{ ($ios['force_update'] ?? 0) ? 'selected' : '' }}>True</option>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Update URL</label>
                                <input type="text" name="ios_update_url"
                                       id="ios_update_url"
                                       class="form-control" placeholder="https://apps.apple.com"
                                       value="{{ $ios['update_url'] ?? '' }}">
                            </div>
                        </div>
                    </div>

                    <div class="d-flex justify-content-end mt-4">
                        <button type="{{env('APP_MODE')!='demo'?'submit':'button'}}"
                                class="btn btn-primary text-uppercase btn-lg call-demo">Save</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection

@push('script')
    <script>
        "use strict";

        document.addEventListener('DOMContentLoaded', function () {
        });
    </script>
@endpush
