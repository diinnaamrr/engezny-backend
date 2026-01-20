@extends('adminmodule::layouts.master')

@section('title', translate('tour_details'))

@section('content')
    <div class="main-content">
        <div class="container-fluid">
            <div class="row g-3">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h5 class="text-capitalize">{{ translate('tour_details') }}</h5>
                            <a href="{{ route('admin.tours.index') }}" class="btn btn-primary">
                                <i class="bi bi-arrow-left"></i> {{ translate('back_to_list') }}
                            </a>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="mb-4">
                                        <img class="img-fluid rounded w-100" src="{{ asset('storage/app/public/tour/'.$tour->image) }}" 
                                             onerror="this.src='{{ asset('public/assets/admin-module/img/media/upload-file.png') }}'">
                                    </div>
                                    <div class="d-flex flex-wrap gap-2">
                                        @if($tour->gallery)
                                            @foreach($tour->gallery as $img)
                                                <img width="80" class="rounded" src="{{ asset('storage/app/public/tour/gallery/'.$img) }}">
                                            @endforeach
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-8">
                                    <div class="d-flex justify-content-between align-items-start mb-3">
                                        <div>
                                            <h3 class="mb-1">{{ $tour->name }}</h3>
                                            <span class="badge badge-info">{{ $tour->category ? $tour->category->name : translate('no_category') }}</span>
                                        </div>
                                        <div class="text-end">
                                            <h4 class="text-primary mb-0">{{ getCurrencyFormat($tour->price) }}</h4>
                                            @if($tour->is_featured)
                                                <span class="badge badge-success mt-1">{{ translate('featured') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                    
                                    <div class="row mb-4">
                                        <div class="col-sm-6">
                                            <div class="d-flex flex-column gap-1">
                                                <span class="text-muted">{{ translate('destination') }}</span>
                                                <span class="fw-bold">{{ $tour->destination ?? translate('n/a') }}</span>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="d-flex flex-column gap-1">
                                                <span class="text-muted">{{ translate('departure_place') }}</span>
                                                <span class="fw-bold">{{ $tour->departure_place ?? translate('n/a') }}</span>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row mb-4">
                                        <div class="col-sm-6">
                                            <div class="d-flex flex-column gap-1">
                                                <span class="text-muted">{{ translate('departure_date') }}</span>
                                                <span class="fw-bold">{{ $tour->departure_date ? $tour->departure_date->format('d M, Y') : translate('n/a') }}</span>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="d-flex flex-column gap-1">
                                                <span class="text-muted">{{ translate('return_date') }}</span>
                                                <span class="fw-bold">{{ $tour->return_date ? $tour->return_date->format('d M, Y') : translate('n/a') }}</span>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="mb-4">
                                        <h6 class="text-capitalize mb-2">{{ translate('description') }}</h6>
                                        <p class="text-justify">{{ $tour->description ?? translate('no_description_available') }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
