@extends('adminmodule::layouts.master')

@section('title', 'Manage Hotels')

@section('content')
<div class="container-fluid">
    <div class="row g-3">
        <div class="col-12">
            <div class="card">
                <div class="card-header d-flex flex-wrap justify-content-between align-items-center gap-3">
                    <h5 class="text-capitalize">{{ translate('Hotel List') }}</h5>
                    <div class="d-flex align-items-center gap-3">
                        <a href="{{ route('admin.hotels.create') }}" class="btn btn-primary">
                            <i class="bi bi-plus"></i> {{ translate('Add Hotel') }}
                        </a>
                    </div>
                </div>

                <div class="table-responsive">
                    <table class="table table-borderless table-thead-bordered table-nowrap table-align-middle card-table">
                        <thead class="thead-light">
                            <tr>
                                <th>{{ translate('Image') }}</th>
                                <th>{{ translate('Name') }}</th>
                                <th>{{ translate('Price') }}</th>
                                <th>{{ translate('Featured') }}</th>
                                <th class="text-center">{{ translate('Action') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($hotels as $hotel)
                            <tr>
                                <td>
                                    <img src="{{ $hotel->image ? asset('storage/app/public/'.$hotel->image) : asset('public/assets/admin-module/img/media/upload-file.png') }}" 
                                         onerror="this.src='{{ asset('public/assets/admin-module/img/media/upload-file.png') }}'" 
                                         width="50" class="rounded">
                                </td>
                                <td>{{ $hotel->name }}</td>
                                <td>{{ getCurrencyFormat($hotel->price) }}</td>
                                <td>
                                    <span class="badge {{ $hotel->is_featured ? 'badge-success' : 'badge-secondary' }}">
                                        {{ $hotel->is_featured ? translate('Yes') : translate('No') }}
                                    </span>
                                </td>
                                <td>
                                    <div class="d-flex justify-content-center gap-2">
                                        <a href="{{ route('admin.hotels.edit', $hotel->id) }}" class="btn btn-outline-primary btn-action">
                                            <i class="bi bi-pencil-fill"></i>
                                        </a>
                                        <button type="button" class="btn btn-outline-danger btn-action" 
                                                onclick="if(confirm('{{ translate('Are you sure?') }}')) document.getElementById('delete-{{ $hotel->id }}').submit()">
                                            <i class="bi bi-trash-fill"></i>
                                        </button>
                                        <form action="{{ route('admin.hotels.delete', $hotel->id) }}" method="POST" id="delete-{{ $hotel->id }}" class="d-none">
                                            @csrf @method('DELETE')
                                        </form>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="card-footer">
                    {{ $hotels->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
