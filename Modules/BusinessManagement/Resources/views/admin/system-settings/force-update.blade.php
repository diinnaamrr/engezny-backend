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
                            <h6 class="fw-semibold mb-3">Meta</h6>
                            <div class="row g-3">
                                <div class="col-md-4">
                                    <label class="form-label">Updated At</label>
                                    <input type="text" name="meta_updated_at" id="meta_updated_at"
                                           class="form-control" placeholder="2025-08-08T10:30:00Z"
                                           value="{{ $meta['updated_at'] ?? '' }}">
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label">Updated By</label>
                                    <input type="text" name="meta_updated_by" id="meta_updated_by"
                                           class="form-control" placeholder="admin@example.com"
                                           value="{{ $meta['updated_by'] ?? '' }}">
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label">Change Reason</label>
                                    <input type="text" name="meta_change_reason" id="meta_change_reason"
                                           class="form-control" placeholder="Hotfix: block 5.2.7"
                                           value="{{ $meta['change_reason'] ?? '' }}">
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="mb-4">
                        <h6 class="fw-semibold mb-3">Android</h6>
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label">Exact Blocked Version</label>
                                <input type="text" name="android_exact_blocked_version"
                                       id="android_exact_blocked_version"
                                       class="form-control" placeholder="5.2.7"
                                       value="{{ $android['exact_blocked_version'] ?? '' }}">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Min Supported Version</label>
                                <input type="text" name="android_min_supported_version"
                                       id="android_min_supported_version"
                                       class="form-control" placeholder="5.3.0"
                                       value="{{ $android['min_supported_version'] ?? '' }}">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Maintenance Mode</label>
                                <select name="android_maintenance_mode" id="android_maintenance_mode"
                                        class="form-select">
                                    <option value="0" {{ ($android['maintenance_mode'] ?? 0) ? '' : 'selected' }}>False</option>
                                    <option value="1" {{ ($android['maintenance_mode'] ?? 0) ? 'selected' : '' }}>True</option>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Maintenance Message</label>
                                <input type="text" name="android_maintenance_message"
                                       id="android_maintenance_message"
                                       class="form-control" placeholder="Scheduled maintenance."
                                       value="{{ $android['maintenance_message'] ?? '' }}">
                            </div>
                        </div>
                    </div>

                    <div class="mb-4">
                        <h6 class="fw-semibold mb-3">iOS</h6>
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label">Exact Blocked Version</label>
                                <input type="text" name="ios_exact_blocked_version"
                                       id="ios_exact_blocked_version"
                                       class="form-control" placeholder="5.2.7"
                                       value="{{ $ios['exact_blocked_version'] ?? '' }}">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Min Supported Version</label>
                                <input type="text" name="ios_min_supported_version"
                                       id="ios_min_supported_version"
                                       class="form-control" placeholder="5.4.0"
                                       value="{{ $ios['min_supported_version'] ?? '' }}">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Maintenance Mode</label>
                                <select name="ios_maintenance_mode" id="ios_maintenance_mode"
                                        class="form-select">
                                    <option value="0" {{ ($ios['maintenance_mode'] ?? 0) ? '' : 'selected' }}>False</option>
                                    <option value="1" {{ ($ios['maintenance_mode'] ?? 0) ? 'selected' : '' }}>True</option>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Maintenance Message</label>
                                <input type="text" name="ios_maintenance_message"
                                       id="ios_maintenance_message"
                                       class="form-control" placeholder="Maintenance in progress."
                                       value="{{ $ios['maintenance_message'] ?? '' }}">
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
