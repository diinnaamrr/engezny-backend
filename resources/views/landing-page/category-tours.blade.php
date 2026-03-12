@extends('landing-page.layouts.master')

@section('title', $category->name . ' Tours – NEMO Tours')

@section('content')

{{-- Page Header --}}
<section class="category-header">
    @if($category->image)
        <div class="category-header-image">
            <img src="{{ asset('storage/app/public/'.$category->image) }}" alt="{{ $category->name }}" class="img-fluid w-100">
        </div>
    @endif
    <div class="category-header-overlay">
        <div class="container">
            <h1 class="category-title">{{ $category->name }}</h1>
            <p class="category-subtitle">{{ $category->description ?? 'Explore amazing tours in this category' }}</p>
        </div>
    </div>
</section>

{{-- Subcategories (if any) --}}
@if($category->children->count() > 0)
<section class="subcategories-section py-4">
    <div class="container">
        <h3 class="subcategories-title">Subcategories</h3>
        <div class="row g-3">
            @foreach($category->children as $subcategory)
                <div class="col-lg-3 col-md-4 col-sm-6">
                    <a href="{{ route('category.tours', $subcategory->id) }}" class="subcategory-card">
                        <h5 class="subcategory-name">{{ $subcategory->name }}</h5>
                        <span class="subcategory-count">
                            {{ \App\Models\Tour::where('category_id', $subcategory->id)->count() }} Tours
                        </span>
                    </a>
                </div>
            @endforeach
        </div>
    </div>
</section>
@endif

{{-- Tours Listing --}}
<section class="category-tours py-5">
    <div class="container">
        <h3 class="tours-title">{{ $category->name }} Tours</h3>
        
        @if($tours->count() > 0)
            <div class="row g-4">
                @foreach($tours as $tour)
                    <div class="col-lg-4 col-md-6">
                        <div class="tour-card">
                            <div class="tour-image">
                                <img 
                                    src="{{ $tour->image ? asset('storage/app/public/'.$tour->image) : asset('public/landing-page/assets/img/placeholder.jpg') }}" 
                                    alt="{{ $tour->name }}"
                                    class="img-fluid"
                                >
                            </div>
                            <div class="tour-body">
                                <h4 class="tour-name">{{ $tour->name }}</h4>
                                @if($tour->destination)
                                    <p class="tour-destination">
                                        <i class="bi bi-geo-alt"></i> {{ $tour->destination }}
                                    </p>
                                @endif
                                <div class="tour-meta">
                                    <span class="tour-price">${{ number_format($tour->price, 2) }}</span>
                                    @if($tour->departure_date)
                                        <span class="tour-date">
                                            <i class="bi bi-calendar"></i> {{ $tour->departure_date->format('M d, Y') }}
                                        </span>
                                    @endif
                                </div>
                                <a href="{{ route('tour.details', $tour->id) }}" class="btn btn-primary w-100 mt-3">
                                    View Details
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            {{-- Pagination --}}
            <div class="mt-5 d-flex justify-content-center">
                {{ $tours->links() }}
            </div>
        @else
            <div class="text-center py-5">
                <i class="bi bi-inbox" style="font-size: 4rem; color: #ccc;"></i>
                <p class="text-muted mt-3">No tours available in this category.</p>
                <a href="{{ route('home') }}" class="btn btn-primary mt-3">Back to Home</a>
            </div>
        @endif
    </div>
</section>

<style>
    .category-header {
        position: relative;
        height: 400px;
        margin-top: 70px;
        overflow: hidden;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .category-header-image {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        z-index: 1;
    }

    .category-header-image img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .category-header-overlay {
        position: relative;
        z-index: 2;
        background: rgba(0, 0, 0, 0.5);
        width: 100%;
        height: 100%;
        display: flex;
        align-items: center;
        justify-content: center;
        text-align: center;
    }

    .category-title {
        font-size: 3rem;
        font-weight: 700;
        color: white;
        margin-bottom: 1rem;
    }

    .category-subtitle {
        font-size: 1.2rem;
        color: rgba(255, 255, 255, 0.9);
    }

    .subcategories-section {
        background-color: #f8f9fa;
    }

    .subcategories-title {
        font-size: 1.5rem;
        font-weight: 700;
        color: #181E4B;
        margin-bottom: 1.5rem;
    }

    .subcategory-card {
        display: block;
        background: white;
        padding: 20px;
        border-radius: 15px;
        text-decoration: none;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.08);
        transition: all 0.3s ease;
        text-align: center;
    }

    .subcategory-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.15);
        text-decoration: none;
    }

    .subcategory-name {
        font-size: 1.1rem;
        font-weight: 600;
        color: #181E4B;
        margin-bottom: 0.5rem;
    }

    .subcategory-count {
        font-size: 0.9rem;
        color: #ee212e;
        font-weight: 500;
    }

    .tours-title {
        font-size: 2rem;
        font-weight: 700;
        color: #181E4B;
        margin-bottom: 2rem;
    }

    .tour-card {
        background: white;
        border-radius: 15px;
        overflow: hidden;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
        transition: transform 0.3s ease;
        height: 100%;
    }

    .tour-card:hover {
        transform: translateY(-10px);
    }

    .tour-image {
        height: 250px;
        overflow: hidden;
    }

    .tour-image img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .tour-body {
        padding: 1.5rem;
    }

    .tour-name {
        font-size: 1.3rem;
        font-weight: 700;
        color: #333;
        margin-bottom: 0.5rem;
    }

    .tour-destination {
        color: #666;
        margin-bottom: 1rem;
    }

    .tour-meta {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding-top: 1rem;
        border-top: 1px solid #eee;
    }

    .tour-price {
        font-size: 1.3rem;
        font-weight: 700;
        color: #ee212e;
    }

    .tour-date {
        color: #666;
        font-size: 0.9rem;
    }

    .btn-primary {
        background: #ee212e;
        border: none;
        padding: 0.75rem;
        font-weight: 600;
        transition: all 0.3s ease;
    }

    .btn-primary:hover {
        background: #08aaf4;
        transform: translateY(-2px);
    }

    @media (max-width: 768px) {
        .category-title {
            font-size: 2rem;
        }
        
        .tours-title {
            font-size: 1.5rem;
        }
    }
</style>

@endsection