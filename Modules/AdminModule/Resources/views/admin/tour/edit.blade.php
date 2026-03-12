@extends('adminmodule::layouts.master')

@section('title', translate('edit_tour'))

@section('content')
    <div class="main-content">
        <div class="container-fluid">
            <div class="row g-3">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="text-capitalize mb-4">{{ translate('edit_tour') }}</h5>
                            <form action="{{ route('admin.tours.update', $tour->id) }}" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="name" class="form-label">{{ translate('name') }}</label>
                                            <input type="text" name="name" class="form-control" id="name" value="{{ $tour->name }}" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="category_id" class="form-label">{{ translate('category') }}</label>
                                            <select name="category_id" class="form-control js-select" id="category_id" required>
                                                @foreach($categories as $category)
                                                    <option value="{{ $category->id }}" {{ $tour->category_id == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="mb-3">
                                            <label for="price" class="form-label">{{ translate('price') }}</label>
                                            <input type="number" step="0.01" name="price" class="form-control" id="price" value="{{ $tour->price }}" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="destination" class="form-label">{{ translate('destination') }}</label>
                                            <input type="text" name="destination" class="form-control" id="destination" value="{{ $tour->destination }}">
                                        </div>
                                        <div class="mb-3">
                                            <label for="departure_place" class="form-label">{{ translate('departure_place') }}</label>
                                            <input type="text" name="departure_place" class="form-control" id="departure_place" value="{{ $tour->departure_place }}">
                                        </div>
                                        <div class="mb-3">
                                            <label for="rating" class="form-label">{{ translate('rating') }}</label>
                                            <input type="number" step="0.1" min="0" max="5" name="rating" class="form-control" id="rating" value="{{ $tour->rating }}">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="image" class="form-label">{{ translate('main_image') }}</label>
                                            <input type="file" name="image" class="form-control" id="image">
                                            <div class="mt-2">
                                                <img width="100" class="rounded" src="{{ asset('storage/app/public/'.$tour->image) }}" 
                                                     onerror="this.src='{{ asset('public/assets/admin-module/img/media/upload-file.png') }}'">
                                            </div>
                                        </div>
                                        <div class="mb-3">
                                            <label for="gallery" class="form-label">{{ translate('gallery_images') }}</label>
                                            <input type="file" name="gallery[]" class="form-control" id="gallery" multiple>
                                            <div class="mt-2 d-flex flex-wrap gap-2">
                                                @if($tour->gallery)
                                                    @foreach($tour->gallery as $img)
                                                        <img width="60" class="rounded" src="{{ asset('storage/app/public/'.$img) }}">
                                                    @endforeach
                                                @endif
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label for="departure_date" class="form-label">{{ translate('departure_date') }}</label>
                                                    <input type="date" name="departure_date" class="form-control" id="departure_date" value="{{ $tour->departure_date ? $tour->departure_date->format('Y-m-d') : '' }}">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label for="return_date" class="form-label">{{ translate('return_date') }}</label>
                                                    <input type="date" name="return_date" class="form-control" id="return_date" value="{{ $tour->return_date ? $tour->return_date->format('Y-m-d') : '' }}">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="mb-3 d-flex align-items-center gap-2">
                                            <input type="checkbox" name="is_featured" id="is_featured" class="form-check-input" value="1" {{ $tour->is_featured ? 'checked' : '' }}>
                                            <label for="is_featured" class="form-check-label">{{ translate('is_featured') }}</label>
                                        </div>
                                        <div class="mb-3">
                                            <label for="gallery_text" class="form-label">{{ translate('gallery_text') }}</label>
                                            <textarea name="gallery_text" class="form-control" id="gallery_text" rows="2">{{ $tour->gallery_text }}</textarea>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="mb-3">
                                            <label for="description" class="form-label">{{ translate('description') }}</label>
                                            <textarea name="description" class="form-control" id="description" rows="5">{{ $tour->description }}</textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="d-flex justify-content-end gap-3">
                                    <a href="{{ route('admin.tours.index') }}" class="btn btn-secondary">{{ translate('cancel') }}</a>
                                    <button type="submit" class="btn btn-primary">{{ translate('update') }}</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
