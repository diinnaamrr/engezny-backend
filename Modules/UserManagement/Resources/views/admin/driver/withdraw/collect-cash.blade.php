@extends('adminmodule::layouts.master')

@section('title', translate('Cash_Collect'))

@section('content')
<!-- Main Content -->
<div class="main-content">
    <div class="container-fluid">
        <h2 class="fs-22 mb-3">
            {{ translate('driver') }}  {{$driver?->first_name . ' ' . $driver?->last_name}}
        </h2>

        <div class="row g-3 mb-3">
            <div class="col-md-4">
                <div class="card h-100">
                    <div class="card-body">
                        <p class="text-muted mb-1">{{ translate('collectable_cash') }}</p>
                        <h3 class="fw-bold mb-0">{{ getCurrencyFormat($collectableAmount ?? 0) }}</h3>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card h-100">
                    <div class="card-body">
                        <p class="text-muted mb-1">{{ translate('driver_max_commission_limit') }}</p>
                        <h3 class="fw-bold mb-0">{{ getCurrencyFormat($maxCommissionLimit ?? 0) }}</h3>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card h-100">
                    <div class="card-body">
                        <p class="text-muted mb-1">{{ translate('commission_due_status') }}</p>
                        <h3 class="fw-bold mb-0">
                            @if($isCommissionBlocked ?? false)
                                <span class="badge bg-danger">{{ translate('blocked') }}</span>
                            @else
                                <span class="badge bg-success">{{ translate('active') }}</span>
                            @endif
                        </h3>
                    </div>
                </div>
            </div>
        </div>

        <div class="card mb-30">
            <form action="{{route('admin.driver.cash.collect', ['id' => $driver?->id])}}" method="post">
                @csrf
                <div class="card-body">
                    <div class="mb-4">
                        <label for="amount" class="mb-2">{{translate('amount')}}</label>
                        <input id="amount" type="number" step="0.01" class="form-control" name="amount"
                               max="{{ $collectableAmount ?? 0 }}" value="{{ old('amount') }}">
                        @if(($collectableAmount ?? 0) > 0)
                            <small class="text-muted">{{ translate('maximum_collectable_amount') }}: {{ getCurrencyFormat($collectableAmount) }}</small>
                        @endif
                    </div>
                    <div class="d-flex justify-content-end gap-2">
                        @if(($collectableAmount ?? 0) > 0)
                            <button type="button" class="btn btn-outline-primary"
                                    onclick="document.getElementById('amount').value='{{ $collectableAmount }}'; this.closest('form').submit();">
                                {{ translate('collect_all_commission') }}
                            </button>
                        @endif
                        <button type="submit" class="btn btn-primary">{{translate('submit')}}</button>
                    </div>
                </div>
            </form>
        </div>
        <div class="card mb-30">
            <div class="card-body">

                <div class="table-responsive mt-3">
                    <table class="table table-borderless align-middle">
                        <thead class="table-light align-middle">
                        <tr>
                            <th class="text-capitalize">{{translate('transaction_ID')}}</th>
                            <th class="text-capitalize">{{translate('transaction_date')}}</th>
                            <th class="">{{translate('debit')}}</th>
                            <th class="">{{translate('credit')}}</th>
                            <th class="">{{translate('balance')}}</th>
                        </tr>
                        </thead>
                        <tbody>
                            @forelse($transactions as $transaction)
                                <tr class="">
                                    <td>{{$transaction->id}}</td>
                                    <td class="">{{date('Y-m-d h:i A',strtotime($transaction->created_at))}}</td>
                                    <td class="">{{$transaction->debit}}</td>
                                    <td class="">{{$transaction->credit}}</td>
                                    <td class="">{{$transaction->balance}}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7">
                                        <div class="d-flex flex-column justify-content-center align-items-center gap-2 py-3">
                                            <img src="{{ asset('public/assets/admin-module/img/empty-icons/no-data-found.svg') }}" alt="" width="100">
                                            <p class="text-center">{{translate('no_data_available')}}</p>
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>

                </div>
                <div class="d-flex justify-content-end">
                    {{$transactions->links()}}
                </div>
            </div>
        </div>

    </div>
</div>
<!-- End Main Content -->
@endsection
