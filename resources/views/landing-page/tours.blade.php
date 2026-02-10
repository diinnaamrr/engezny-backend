@extends('landing-page.layouts.master')

@section('title', 'All Tours – NEMO Tours')

@section('content')

{{-- Page Header --}}
<section class="page-header">
    <div class="container">
        <h1 class="page-title">Explore Our Tours</h1>
        <p class="page-subtitle">Find your perfect adventure</p>
    </div>
</section>

{{-- Tours Listing --}}
<section class="tours-listing py-5">
    <div class="container">
        @if($tours->count() > 0)
            <div class="row g-4">
                @foreach($tours as $tour)
                    <div class="col-md-6 col-lg-4">
                        <div class="tour-card">
                            <div class="tour-image">
                                <img 
                                    src="{{ $tour->image ? asset('storage/'.$tour->image) : asset('public/landing-page/assets/img/placeholder.jpg') }}" 
                                    alt="{{ $tour->name }}"
                                    class="img-fluid"
                                >
                                @if($tour->is_featured)
                                    <span class="featured-badge">Featured</span>
                                @endif
                            </div>
                            <div class="tour-body">
                                <h3 class="tour-name">{{ $tour->name }}</h3>
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
                <p class="text-muted mt-3">No tours available at the moment.</p>
                <a href="{{ route('home') }}" class="btn btn-primary mt-3">Back to Home</a>
            </div>
        @endif
    </div>
</section>

<style>
    /* Page Header */
    .page-header {
        background: linear-gradient(135deg, #ee212e 0%, #08aaf4 100%);
        padding: 120px 0 80px;
        margin-top: 70px;
        text-align: center;
    }

    .page-title {
        font-size: 3rem;
        font-weight: 700;
        color: white;
        margin-bottom: 1rem;
    }

    .page-subtitle {
        font-size: 1.2rem;
        color: rgba(255, 255, 255, 0.9);
    }

    /* Tour Card Styles */
    .tour-card {
        background: white;
        border-radius: 15px;
        overflow: hidden;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        height: 100%;
    }

    .tour-card:hover {
        transform: translateY(-10px);
        box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15);
    }

    .tour-image {
        position: relative;
        height: 250px;
        overflow: hidden;
    }

    .tour-image img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.3s ease;
    }

    .tour-card:hover .tour-image img {
        transform: scale(1.1);
    }

    .featured-badge {
        position: absolute;
        top: 15px;
        right: 15px;
        background: #ee212e;
        color: white;
        padding: 0.5rem 1rem;
        border-radius: 20px;
        font-size: 0.85rem;
        font-weight: 600;
    }

    .tour-body {
        padding: 1.5rem;
    }

    .tour-name {
        font-size: 1.5rem;
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
        font-size: 1.5rem;
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

    /* Pagination Styling */
    .pagination {
        gap: 0.5rem;
    }

    .page-link {
        color: #ee212e;
        border: 2px solid #ee212e;
        border-radius: 8px;
        padding: 0.5rem 1rem;
        transition: all 0.3s ease;
    }

    .page-link:hover {
        background: #ee212e;
        color: white;
    }

    .page-item.active .page-link {
        background: #ee212e;
        border-color: #ee212e;
    }

    /* Responsive */
    @media (max-width: 768px) {
        .page-title {
            font-size: 2rem;
        }
    }
</style>

@endsection
