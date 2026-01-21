@extends('adminmodule::layouts.master')

@section('title', translate('category_setup'))

@section('content')
    <div class="main-content">
        <div class="container-fluid">
            <div class="row g-3">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="text-capitalize mb-4">{{ translate('add_new_category') }}</h5>
                            <form action="{{ route('admin.categories.store') }}" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="name" class="form-label">{{ translate('name') }}</label>
                                            <input type="text" name="name" class="form-control" id="name" placeholder="{{ translate('category_name') }}" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="parent_id" class="form-label">{{ translate('parent_category') }}</label>
                                            <select name="parent_id" class="form-control js-select" id="parent_id">
                                                <option value="">{{ translate('none') }}</option>
                                                @foreach($parentCategories as $parent)
                                                    <option value="{{ $parent->id }}">{{ $parent->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="image" class="form-label">{{ translate('image') }}</label>
                                            <input type="file" name="image" class="form-control" id="image">
                                        </div>
                                        <div class="mb-3">
                                            <label for="description" class="form-label">{{ translate('description') }}</label>
                                            <textarea name="description" class="form-control" id="description" rows="3" placeholder="{{ translate('description') }}"></textarea>
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

                <div class="col-12">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h5 class="text-capitalize">{{ translate('category_list') }}</h5>
                            <span class="badge badge-primary">{{ $categories->total() }}</span>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-borderless table-thead-bordered table-nowrap table-align-middle card-table">
                                <thead class="thead-light">
                                    <tr>
                                        <th>{{ translate('sl') }}</th>
                                        <th>{{ translate('image') }}</th>
                                        <th>{{ translate('name') }}</th>
                                        <th>{{ translate('parent_category') }}</th>
                                        <th class="text-center">{{ translate('action') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($categories as $key => $category)
                                        <tr>
                                            <td>{{ $categories->firstItem() + $key }}</td>
                                            <td>
                                                <img width="50" class="rounded" src="{{ asset('storage/category/'.$category->image) }}" 
                                                     onerror="this.src='{{ asset('public/assets/admin-module/img/media/upload-file.png') }}'">
                                            </td>
                                            <td>{{ $category->name }}</td>
                                            <td>{{ $category->parent ? $category->parent->name : translate('none') }}</td>
                                            <td>
                                                <div class="d-flex justify-content-center gap-2">
                                                    <a href="{{ route('admin.categories.edit', $category->id) }}" class="btn btn-outline-primary btn-action">
                                                        <i class="bi bi-pencil-fill"></i>
                                                    </a>
                                                    <button type="button" class="btn btn-outline-danger btn-action form-alert" 
                                                            data-id="delete-{{ $category->id }}" 
                                                            data-message="{{ translate('want_to_delete_this_category') }}">
                                                        <i class="bi bi-trash-fill"></i>
                                                    </button>
                                                    <form action="{{ route('admin.categories.delete', $category->id) }}" method="post" id="delete-{{ $category->id }}" class="d-none">
                                                        @csrf
                                                        @method('delete')
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="5" class="text-center">{{ translate('no_data_found') }}</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                        <div class="card-footer">
                            {!! $categories->links() !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
