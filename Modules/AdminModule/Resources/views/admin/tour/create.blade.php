@extends('adminmodule::layouts.master')

@section('title', translate('add_new_tour'))

@section('content')
    <div class="main-content">
        <div class="container-fluid">
            <div class="row g-3">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="text-capitalize mb-4">{{ translate('add_new_tour') }}</h5>
                            <form action="{{ route('admin.tours.store') }}" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="name" class="form-label">{{ translate('name') }}</label>
                                            <input type="text" name="name" class="form-control" id="name" placeholder="{{ translate('tour_name') }}" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="category_id" class="form-label">{{ translate('category') }}</label>
                                            <select name="category_id" class="form-control js-select" id="category_id" required>
                                                <option value="" disabled selected>{{ translate('select_category') }}</option>
                                                @foreach($categories as $category)
                                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="mb-3">
                                            <label for="price" class="form-label">{{ translate('price') }}</label>
                                            <input type="number" step="0.01" name="price" class="form-control" id="price" placeholder="{{ translate('price') }}" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="destination" class="form-label">{{ translate('destination') }}</label>
                                            <input type="text" name="destination" class="form-control" id="destination" placeholder="{{ translate('destination') }}">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="image" class="form-label">{{ translate('main_image') }}</label>
                                            <input type="file" name="image" class="form-control" id="image">
                                        </div>
                                        <div class="mb-3">
                                            <label for="gallery" class="form-label">{{ translate('gallery_images') }}</label>
                                            <input type="file" name="gallery[]" class="form-control" id="gallery" multiple>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label for="departure_date" class="form-label">{{ translate('departure_date') }}</label>
                                                    <input type="date" name="departure_date" class="form-control" id="departure_date">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label for="return_date" class="form-label">{{ translate('return_date') }}</label>
                                                    <input type="date" name="return_date" class="form-control" id="return_date">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="mb-3 d-flex align-items-center gap-2">
                                            <input type="checkbox" name="is_featured" id="is_featured" class="form-check-input">
                                            <label for="is_featured" class="form-check-label">{{ translate('is_featured') }}</label>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="mb-3">
                                            <label for="description" class="form-label">{{ translate('description') }}</label>
                                            <textarea name="description" class="form-control" id="description" rows="5" placeholder="{{ translate('description') }}"></textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="d-flex justify-content-end gap-3">
                                    <button type="reset" class="btn btn-secondary">{{ translate('reset') }}</button>
                                    <button type="submit" class="btn btn-primary">{{ translate('submit') }}</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
