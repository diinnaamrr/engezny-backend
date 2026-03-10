@extends('adminmodule::layouts.master')

@section('title', 'Edit Hotel')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-8 offset-md-2">
            <div class="card">
                <div class="card-header"><h4>Edit Hotel: {{ $hotel->name }}</h4></div>
                <div class="card-body">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('admin.hotels.update', $hotel->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label>Name</label>
                            <input type="text" name="name" class="form-control" value="{{ $hotel->name }}" required>
                        </div>
                        <div class="mb-3">
                            <label>Description</label>
                            <textarea name="description" class="form-control" rows="4">{{ $hotel->description }}</textarea>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label>Price</label>
                                <input type="number" name="price" step="0.01" class="form-control" value="{{ $hotel->price }}" required>
                            </div>
                            <div class="col-md-6 mb-3 d-flex align-items-end">
                                <div class="form-check">
                                    <input type="checkbox" name="is_featured" class="form-check-input" id="featured" {{ $hotel->is_featured ? 'checked' : '' }}>
                                    <label class="form-check-label" for="featured">Featured Hotel</label>
                                </div>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label>Main Image</label>
                            <input type="file" name="image" class="form-control">
                            @if($hotel->image)
                                <img src="{{ asset('storage/'.$hotel->image) }}" class="mt-2" width="100">
                            @endif
                        </div>
                        <div class="mb-3">
                            <label>Gallery Images</label>
                            <input type="file" name="gallery[]" class="form-control" multiple>
                        </div>
                        <button type="submit" class="btn btn-primary w-100">Update Hotel</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
