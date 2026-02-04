@extends('adminmodule::layouts.master')

@section('title', translate('app_version') . ' JSON')

@section('content')
    <div class="content container-fluid">
        <h2 class="fs-22 mb-4 text-capitalize">{{ translate('system_settings') }}</h2>

        <div class="mb-4">
            @include('businessmanagement::admin.system-settings.partials._system-settings-inline')
        </div>

        <div class="card border-0">
            <div class="card-body">
                <div class="mb-3">
                    <h5 class="fw-semibold mb-2">{{ translate('app_version') }} JSON</h5>
                    <div class="fs-12">
                        {{ translate('Setup the minimum App versions in which the system will be compatible') }}
                    </div>
                </div>

                <ul class="nav nav-tabs mb-3" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active" id="customer-tab" data-bs-toggle="tab"
                                data-bs-target="#customer-pane" type="button" role="tab"
                                aria-controls="customer-pane" aria-selected="true">
                            {{ translate('Customer') }}
                        </button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="driver-tab" data-bs-toggle="tab"
                                data-bs-target="#driver-pane" type="button" role="tab"
                                aria-controls="driver-pane" aria-selected="false">
                            {{ translate('Driver') }}
                        </button>
                    </li>
                </ul>

                <div class="tab-content">
                    <div class="tab-pane fade show active" id="customer-pane" role="tabpanel"
                         aria-labelledby="customer-tab">
                        <div class="bg-F6F6F6 p-3 rounded">
                            <pre class="mb-0"><code class="language-json">{{ $customerConfigJson }}</code></pre>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="driver-pane" role="tabpanel" aria-labelledby="driver-tab">
                        <div class="bg-F6F6F6 p-3 rounded">
                            <pre class="mb-0"><code class="language-json">{{ $driverConfigJson }}</code></pre>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
