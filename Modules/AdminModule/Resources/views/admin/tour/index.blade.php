@extends('adminmodule::layouts.master')

@section('title', translate('tour_list'))

@section('content')
    <div class="main-content">
        <div class="container-fluid">
            <div class="row g-3">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header d-flex flex-wrap justify-content-between align-items-center gap-3">
                            <h5 class="text-capitalize">{{ translate('tour_list') }}</h5>
                            <div class="d-flex align-items-center gap-3">
                                <span class="badge badge-primary">{{ $tours->total() }}</span>
                                <a href="{{ route('admin.tours.create') }}" class="btn btn-primary">
                                    <i class="bi bi-plus"></i> {{ translate('add_new_tour') }}
                                </a>
                            </div>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-borderless table-thead-bordered table-nowrap table-align-middle card-table">
                                <thead class="thead-light">
                                    <tr>
                                        <th>{{ translate('sl') }}</th>
                                        <th>{{ translate('image') }}</th>
                                        <th>{{ translate('name') }}</th>
                                        <th>{{ translate('category') }}</th>
                                        <th>{{ translate('price') }}</th>
                                        <th>{{ translate('featured') }}</th>
                                        <th class="text-center">{{ translate('action') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($tours as $key => $tour)
                                        <tr>
                                            <td>{{ $tours->firstItem() + $key }}</td>
                                            <td>
                                                <img width="50" class="rounded" src="{{ asset('storage/app/public/tour/'.$tour->image) }}" 
                                                     onerror="this.src='{{ asset('public/assets/admin-module/img/media/upload-file.png') }}'">
                                            </td>
                                            <td>{{ $tour->name }}</td>
                                            <td>{{ $tour->category ? $tour->category->name : translate('n/a') }}</td>
                                            <td>{{ getCurrencyFormat($tour->price) }}</td>
                                            <td>
                                                <span class="badge {{ $tour->is_featured ? 'badge-success' : 'badge-secondary' }}">
                                                    {{ $tour->is_featured ? translate('yes') : translate('no') }}
                                                </span>
                                            </td>
                                            <td>
                                                <div class="d-flex justify-content-center gap-2">
                                                    <a href="{{ route('admin.tours.show', $tour->id) }}" class="btn btn-outline-info btn-action">
                                                        <i class="bi bi-eye-fill"></i>
                                                    </a>
                                                    <a href="{{ route('admin.tours.edit', $tour->id) }}" class="btn btn-outline-primary btn-action">
                                                        <i class="bi bi-pencil-fill"></i>
                                                    </a>
                                                    <button type="button" class="btn btn-outline-danger btn-action form-alert" 
                                                            data-id="delete-{{ $tour->id }}" 
                                                            data-message="{{ translate('want_to_delete_this_tour') }}">
                                                        <i class="bi bi-trash-fill"></i>
                                                    </button>
                                                    <form action="{{ route('admin.tours.delete', $tour->id) }}" method="post" id="delete-{{ $tour->id }}" class="d-none">
                                                        @csrf
                                                        @method('delete')
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="7" class="text-center">{{ translate('no_data_found') }}</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                        <div class="card-footer">
                            {!! $tours->links() !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
