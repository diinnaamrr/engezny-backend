@extends('landing-page.layouts.master')

@section('title', 'NEMO Tours – Enjoy Every Moment')

@section('content')

{{-- ===========================
    HERO SECTION
============================ --}}
<section id="hero" class="hero-section">
    <div class="hero-overlay"></div>
    <div class="hero-content">
        <div class="container">
            <div class="row justify-content-start">
                <div class="col-lg-8">
                    <h1 class="hero-title">
                        With <span class="nemo-brand">NEMO</span> enjoy every moment in your trip!
                    </h1>
                    
                    {{-- Search Bar --}}
                    <div class="search-container mt-5">
                        <div class="search-wrapper">
                            <input 
                                type="text" 
                                class="search-input" 
                                placeholder="Where to?"
                            >
                            <button class="search-btn">
                                <i class="bi bi-search"></i> Search
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- ===========================
    FEATURED TOURS SECTION
============================ --}}
<section id="featured-tours" class="py-5">
    <div class="container">
        <div class="text-center mb-5">
            <h2 class="section-title">Featured Tours</h2>
            <p class="section-subtitle">Discover our handpicked selection of amazing destinations</p>
        </div>

        @if($featuredTours->count() > 0)
            <div class="row g-4">
                @foreach($featuredTours as $tour)
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

            <div class="text-center mt-5">
                <a href="{{ route('tours') }}" class="btn btn-outline-primary btn-lg">
                    View All Tours <i class="bi bi-arrow-right"></i>
                </a>
            </div>
        @else
            <div class="text-center py-5">
                <p class="text-muted">No featured tours available at the moment.</p>
            </div>
        @endif
    </div>
</section>

<style>
    /* Hero Section Styles */
    .hero-section {
        position: relative;
        height: 100vh;
        background-image: url('{{ asset('public/landing-page/assets/img/hero_bg.jpg') }}');
        background-size: cover;
        background-position: center;
        background-repeat: no-repeat;
        display: flex;
        align-items: center;
    }

    .hero-overlay {
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: rgba(0, 0, 0, 0.4);
    }

    .hero-content {
        position: relative;
        z-index: 2;
        width: 100%;
        margin-top: 80px;
    }

    .hero-title {
        font-size: 3.5rem;
        font-weight: 700;
        color: white;
        line-height: 1.2;
        margin-bottom: 2rem;
    }

    .nemo-brand {
        color: #3E69AD;
    }

    /* Search Container */
    .search-container {
        max-width: 600px;
    }

    .search-wrapper {
        background: #F3F3F399;
        backdrop-filter: blur(10px);
        border-radius: 50px;
        padding: 0.5rem;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    .search-input {
        flex: 1;
        border: none;
        background: transparent;
        padding: 0.75rem 1.5rem;
        font-size: 1.1rem;
        color: #333;
        outline: none;
    }

    .search-input::placeholder {
        color: #666;
    }

    .search-btn {
        background: #3E69AD;
        color: white;
        border: none;
        border-radius: 50px;
        padding: 0.75rem 2rem;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.3s ease;
        white-space: nowrap;
    }

    .search-btn:hover {
        background: #2d5089;
        transform: translateY(-2px);
    }

    /* Featured Tours Section */
    .section-title {
        font-size: 2.5rem;
        font-weight: 700;
        color: #333;
    }

    .section-subtitle {
        font-size: 1.1rem;
        color: #666;
    }

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
        background: #3E69AD;
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
        color: #3E69AD;
    }

    .tour-date {
        color: #666;
        font-size: 0.9rem;
    }

    .btn-primary {
        background: #3E69AD;
        border: none;
        padding: 0.75rem;
        font-weight: 600;
        transition: all 0.3s ease;
    }

    .btn-primary:hover {
        background: #2d5089;
        transform: translateY(-2px);
    }

    .btn-outline-primary {
        color: #3E69AD;
        border: 2px solid #3E69AD;
        padding: 0.75rem 2rem;
        font-weight: 600;
        transition: all 0.3s ease;
    }

    .btn-outline-primary:hover {
        background: #3E69AD;
        color: white;
        transform: translateY(-2px);
    }

    /* Responsive */
    @media (max-width: 768px) {
        .hero-title {
            font-size: 2.5rem;
        }

        .search-wrapper {
            flex-direction: column;
            border-radius: 20px;
        }

        .search-btn {
            width: 100%;
            border-radius: 20px;
        }
    }
</style>

@endsection
