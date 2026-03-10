@extends('adminmodule::layouts.master')

@section('title', 'Add Hotel')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-8 offset-md-2">
            <div class="card">
                <div class="card-header"><h4>Add New Hotel</h4></div>
                <div class="card-body">
                    <form action="{{ route('admin.hotels.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label>Name</label>
                            <input type="text" name="name" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label>Description</label>
                            <textarea name="description" class="form-control" rows="4"></textarea>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label>Price</label>
                                <input type="number" name="price" step="0.01" class="form-control" required>
                            </div>
                            <div class="col-md-6 mb-3 d-flex align-items-end">
                                <div class="form-check">
                                    <input type="checkbox" name="is_featured" class="form-check-input" id="featured">
                                    <label class="form-check-label" for="featured">Featured Hotel</label>
                                </div>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label>Main Image</label>
                            <input type="file" name="image" class="form-control">
                        </div>
                        <div class="mb-3">
                            <label>Gallery Images</label>
                            <input type="file" name="gallery[]" class="form-control" multiple>
                        </div>
                        <button type="submit" class="btn btn-primary w-100">Save Hotel</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
