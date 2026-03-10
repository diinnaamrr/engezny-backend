@extends('adminmodule::layouts.master')

@section('title', 'Manage Hotels')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>Hotels</h2>
        <a href="{{ route('admin.hotels.create') }}" class="btn btn-primary">Add Hotel</a>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="card">
        <div class="table-responsive">
            <table class="table align-middle">
                <thead>
                    <tr>
                        <th>Image</th>
                        <th>Name</th>
                        <th>Price</th>
                        <th>Featured</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($hotels as $hotel)
                    <tr>
                        <td>
                            <img src="{{ $hotel->image ? asset('storage/'.$hotel->image) : asset('public/assets/admin/img/160x160/img1.jpg') }}" width="50" class="rounded">
                        </td>
                        <td>{{ $hotel->name }}</td>
                        <td>{{ number_format($hotel->price, 2) }}</td>
                        <td>{{ $hotel->is_featured ? 'Yes' : 'No' }}</td>
                        <td>
                            <a href="{{ route('admin.hotels.edit', $hotel->id) }}" class="btn btn-sm btn-info">Edit</a>
                            <form action="{{ route('admin.hotels.delete', $hotel->id) }}" method="POST" class="d-inline">
                                @csrf @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
                            </form>
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
@endsection
