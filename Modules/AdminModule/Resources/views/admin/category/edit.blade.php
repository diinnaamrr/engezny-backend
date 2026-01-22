@extends('adminmodule::layouts.master')

@section('title', translate('edit_category'))

@section('content')
    <div class="main-content">
        <div class="container-fluid">
            <div class="row g-3">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="text-capitalize mb-4">{{ translate('edit_category') }}</h5>
                            <form action="{{ route('admin.categories.update', $category->id) }}" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="name" class="form-label">{{ translate('name') }}</label>
                                            <input type="text" name="name" class="form-control" id="name" value="{{ $category->name }}" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="parent_id" class="form-label">{{ translate('parent_category') }}</label>
                                            <select name="parent_id" class="form-control js-select" id="parent_id">
                                                <option value="">{{ translate('none') }}</option>
                                                @foreach($parentCategories as $parent)
                                                    <option value="{{ $parent->id }}" {{ $category->parent_id == $parent->id ? 'selected' : '' }}>{{ $parent->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="image" class="form-label">{{ translate('image') }}</label>
                                            <input type="file" name="image" class="form-control" id="image">
                                            <div class="mt-2">
                                                <img width="100" class="rounded" src="{{ asset('storage/'.$category->image) }}" 
                                                     onerror="this.src='{{ asset('public/assets/admin-module/img/media/upload-file.png') }}'">
                                            </div>
                                        </div>
                                        <div class="mb-3">
                                            <label for="description" class="form-label">{{ translate('description') }}</label>
                                            <textarea name="description" class="form-control" id="description" rows="3">{{ $category->description }}</textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="d-flex justify-content-end gap-3">
                                    <a href="{{ route('admin.categories.index') }}" class="btn btn-secondary">{{ translate('cancel') }}</a>
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
