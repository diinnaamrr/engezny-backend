@extends('landing-page.layouts.master')

@section('title', $tour->name . ' – NEMO Tours')

@section('content')

{{-- Tour Hero Section --}}
<section class="tour-hero">
    <div class="tour-hero-image">
        <img 
            src="{{ $tour->image ? asset('storage/'.$tour->image) : asset('public/landing-page/assets/img/placeholder.jpg') }}" 
            alt="{{ $tour->name }}"
            class="img-fluid w-100"
        >
    </div>
    <div class="tour-hero-overlay">
        <div class="container">
            <div class="tour-hero-content">
                <h1 class="tour-hero-title">{{ $tour->name }}</h1>
                @if($tour->destination)
                    <p class="tour-hero-location">
                        <i class="bi bi-geo-alt-fill"></i> {{ $tour->destination }}
                    </p>
                @endif
            </div>
        </div>
    </div>
</section>

{{-- Tour Details Section --}}
<section class="tour-details py-5">
    <div class="container">
        <div class="row g-4">
            {{-- Main Content --}}
            <div class="col-lg-8">
                {{-- Tour Info --}}
                <div class="tour-info-card mb-4">
                    <h2 class="section-title">Tour Overview</h2>
                    <p class="tour-description">
                        {{ $tour->description ?? 'No description available for this tour.' }}
                    </p>
                </div>

                {{-- Tour Details Grid --}}
                <div class="tour-details-grid mb-4">
                    <div class="detail-item">
                        <i class="bi bi-calendar-event"></i>
                        <div>
                            <h6>Departure Date</h6>
                            <p>{{ $tour->departure_date ? $tour->departure_date->format('F d, Y') : 'TBA' }}</p>
                        </div>
                    </div>
                    <div class="detail-item">
                        <i class="bi bi-calendar-check"></i>
                        <div>
                            <h6>Return Date</h6>
                            <p>{{ $tour->return_date ? $tour->return_date->format('F d, Y') : 'TBA' }}</p>
                        </div>
                    </div>
                    <div class="detail-item">
                        <i class="bi bi-geo-alt"></i>
                        <div>
                            <h6>Departure Place</h6>
                            <p>{{ $tour->departure_place ?? 'TBA' }}</p>
                        </div>
                    </div>
                    @if($tour->rating)
                        <div class="detail-item">
                            <i class="bi bi-star-fill"></i>
                            <div>
                                <h6>Rating</h6>
                                <p>{{ $tour->rating }} / 5.0</p>
                            </div>
                        </div>
                    @endif
                </div>

                {{-- Gallery --}}
                @if($tour->gallery && count($tour->gallery) > 0)
                    <div class="tour-gallery mb-4">
                        <h2 class="section-title">Gallery</h2>
                        @if($tour->gallery_text)
                            <p class="gallery-text">{{ $tour->gallery_text }}</p>
                        @endif
                        <div class="row g-3">
                            @foreach($tour->gallery as $image)
                                <div class="col-md-4">
                                    <div class="gallery-item">
                                        <img 
                                            src="{{ asset('storage/'.$image) }}" 
                                            alt="Gallery Image"
                                            class="img-fluid"
                                        >
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif
            </div>

            {{-- Sidebar --}}
            <div class="col-lg-4">
                {{-- Price Card --}}
                <div class="price-card">
                    <div class="price-header">
                        <h3 class="price-title">Tour Price</h3>
                        <div class="price-amount">${{ number_format($tour->price, 2) }}</div>
                        <p class="price-subtitle">per person</p>
                    </div>
                    <div class="price-body">
                        @if($tour->is_featured)
                            <div class="featured-tag mb-3">
                                <i class="bi bi-star-fill"></i> Featured Tour
                            </div>
                        @endif
                        <a href="{{ route('book.tour') }}" class="btn btn-primary w-100 btn-lg">
                            Book Now
                        </a>
                        

                        <a href="{{ route('tours') }}" class="btn btn-outline-secondary w-100 mt-2">
                            <i class="bi bi-arrow-left"></i> Back to Tours
                        </a>
                    </div>
                </div>

                {{-- Category Info --}}
                @if($tour->category)
                    <div class="category-card mt-4">
                        <h4 class="category-title">Category</h4>
                        <p class="category-name">{{ $tour->category->name }}</p>
                        @if($tour->category->description)
                            <p class="category-description">{{ $tour->category->description }}</p>
                        @endif
                    </div>
                @endif
            </div>
        </div>
    </div>
</section>

<style>
    /* Tour Hero */
    .tour-hero {
        position: relative;
        height: 500px;
        margin-top: 70px;
        overflow: hidden;
    }

    .tour-hero-image {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
    }

    .tour-hero-image img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .tour-hero-overlay {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: linear-gradient(to top, rgba(0,0,0,0.7) 0%, rgba(0,0,0,0.3) 100%);
        display: flex;
        align-items: flex-end;
        padding-bottom: 3rem;
    }

    .tour-hero-title {
        font-size: 3rem;
        font-weight: 700;
        color: white;
        margin-bottom: 0.5rem;
    }

    .tour-hero-location {
        font-size: 1.3rem;
        color: rgba(255, 255, 255, 0.9);
        margin: 0;
    }

    /* Tour Info Card */
    .tour-info-card {
        background: white;
        padding: 2rem;
        border-radius: 15px;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
    }

    .section-title {
        font-size: 2rem;
        font-weight: 700;
        color: #333;
        margin-bottom: 1.5rem;
    }

    .tour-description {
        font-size: 1.1rem;
        line-height: 1.8;
        color: #666;
    }

    /* Tour Details Grid */
    .tour-details-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
        gap: 1.5rem;
    }

    .detail-item {
        background: white;
        padding: 1.5rem;
        border-radius: 15px;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
        display: flex;
        align-items: center;
        gap: 1rem;
    }

    .detail-item i {
        font-size: 2rem;
        color: #ee212e;
    }

    .detail-item h6 {
        font-weight: 600;
        color: #666;
        margin-bottom: 0.25rem;
        font-size: 0.9rem;
    }

    .detail-item p {
        margin: 0;
        font-weight: 600;
        color: #333;
    }

    /* Gallery */
    .tour-gallery {
        background: white;
        padding: 2rem;
        border-radius: 15px;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
    }

    .gallery-text {
        color: #666;
        margin-bottom: 1.5rem;
    }

    .gallery-item {
        border-radius: 10px;
        overflow: hidden;
        height: 200px;
    }

    .gallery-item img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.3s ease;
    }

    .gallery-item:hover img {
        transform: scale(1.1);
    }

    /* Price Card */
    .price-card {
        background: white;
        border-radius: 15px;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
        overflow: hidden;
        position: sticky;
        top: 100px;
    }

    .price-header {
        background: linear-gradient(135deg, #ee212e 0%, #08aaf4 100%);
        color: white;
        padding: 2rem;
        text-align: center;
    }

    .price-title {
        font-size: 1.2rem;
        margin-bottom: 1rem;
        font-weight: 600;
    }

    .price-amount {
        font-size: 3rem;
        font-weight: 700;
        margin-bottom: 0.5rem;
    }

    .price-subtitle {
        font-size: 1rem;
        opacity: 0.9;
        margin: 0;
    }

    .price-body {
        padding: 2rem;
    }

    .featured-tag {
        background: #fff3cd;
        color: #856404;
        padding: 0.75rem;
        border-radius: 8px;
        text-align: center;
        font-weight: 600;
    }

    .btn-primary {
        background: #ee212e;
        border: none;
        padding: 1rem;
        font-weight: 600;
        transition: all 0.3s ease;
    }

    .btn-primary:hover {
        background: #08aaf4;
        transform: translateY(-2px);
    }

    .btn-outline-secondary {
        color: #666;
        border: 2px solid #ddd;
        padding: 0.75rem;
        font-weight: 600;
        transition: all 0.3s ease;
    }

    .btn-outline-secondary:hover {
        background: #f8f9fa;
        border-color: #999;
    }

    /* Category Card */
    .category-card {
        background: white;
        padding: 1.5rem;
        border-radius: 15px;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
    }

    .category-title {
        font-size: 1.2rem;
        font-weight: 700;
        color: #333;
        margin-bottom: 1rem;
    }

    .category-name {
        font-size: 1.1rem;
        font-weight: 600;
        color: #ee212e;
        margin-bottom: 0.5rem;
    }

    .category-description {
        color: #666;
        font-size: 0.95rem;
        margin: 0;
    }

    /* Responsive */
    @media (max-width: 768px) {
        .tour-hero {
            height: 350px;
        }

        .tour-hero-title {
            font-size: 2rem;
        }

        .price-card {
            position: static;
        }
    }
</style>

@endsection
