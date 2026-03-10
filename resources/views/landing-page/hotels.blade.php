@extends('landing-page.layouts.master')

@section('title', 'NEMO Tours – Discover Best Hotels')

@section('content')

{{-- ===========================
    BREADCRUMB SECTION
============================ --}}
<section class="breadcrumb-section py-5" style="background: linear-gradient(rgba(0,0,0,0.5), rgba(0,0,0,0.5)), url('{{ asset('public/landing-page/assets/img/hero-bg.jpg') }}'); background-size: cover; background-position: center; margin-top: 80px;">
    <div class="container py-4 text-center">
        <h1 class="text-white fw-bold display-4">All Hotels</h1>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb justify-content-center mb-0">
                <li class="breadcrumb-item"><a href="{{ route('home') }}" class="text-white text-decoration-none">Home</a></li>
                <li class="breadcrumb-item active text-white" aria-current="page">Hotels</li>
            </ol>
        </nav>
    </div>
</section>

{{-- ===========================
    HOTELS LIST SECTION
============================ --}}
<section class="hotels-list-section py-5">
    <div class="container my-5">
        @if($hotels->count() > 0)
            <div class="row g-4">
                @foreach($hotels as $hotel)
                    <div class="col-lg-3 col-md-6">
                        <div class="hotel-card-new h-100">
                            <div class="hotel-image-wrapper">
                                <img 
                                    src="{{ $hotel->image ? asset('storage/'.$hotel->image) : asset('public/landing-page/assets/img/placeholder.jpg') }}" 
                                    alt="{{ $hotel->name }}"
                                    class="hotel-image"
                                >
                            </div>
                            <div class="hotel-content">
                                <h4 class="hotel-name">{{ $hotel->name }}</h4>
                                <p class="hotel-description">
                                    {{ Str::limit($hotel->description, 70) }}
                                </p>
                                <div class="hotel-footer">
                                    <div class="hotel-price-info">
                                        <span class="price-value">{{ getCurrencyFormat($hotel->price) }}</span>
                                    </div>
                                    <a href="https://wa.me/{{ $business_phone ?? '123456789' }}?text={{ urlencode('I am interested in booking: ' . $hotel->name) }}" 
                                       target="_blank" class="whatsapp-details-link">
                                        <span class="whatsapp-icon-wrapper">
                                            <i class="bi bi-whatsapp"></i>
                                        </span>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div class="text-center py-5">
                <div class="mb-4">
                    <i class="bi bi-building-exclamation display-1 text-muted"></i>
                </div>
                <h3>No hotels found</h3>
                <p class="text-muted">We couldn't find any hotels at the moment. Please check back later.</p>
                <a href="{{ route('home') }}" class="btn-see-all mt-3">Back to Home</a>
            </div>
        @endif
    </div>
</section>

<style>
    .hotel-card-new {
        background: #fff;
        border-radius: 20px;
        padding: 15px;
        box-shadow: 0px 10px 30px rgba(0,0,0,0.05);
        transition: transform 0.3s ease;
        display: flex;
        flex-direction: column;
    }

    .hotel-card-new:hover {
        transform: translateY(-10px);
    }

    .hotel-image-wrapper {
        width: 100%;
        height: 200px;
        overflow: hidden;
        border-radius: 20px;
        margin-bottom: 15px;
    }

    .hotel-image {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .hotel-content {
        padding: 0 5px 10px 5px;
        flex-grow: 1;
        display: flex;
        flex-direction: column;
    }

    .hotel-name {
        font-size: 18px;
        font-weight: 600;
        margin-bottom: 10px;
        color: #5E6282;
    }

    .hotel-description {
        font-size: 14px;
        color: #5E6282;
        margin-bottom: 15px;
        line-height: 1.5;
        flex-grow: 1;
    }

    .hotel-footer {
        margin-top: auto;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .price-value {
        font-size: 16px;
        font-weight: 600;
        color: #5E6282;
    }

    .whatsapp-icon-wrapper {
        display: flex;
        align-items: center;
        justify-content: center;
        width: 35px;
        height: 35px;
        background-color: #F5F5F5;
        border-radius: 50%;
        color: #181E4B;
        transition: all 0.3s ease;
    }

    .whatsapp-icon-wrapper:hover {
        background-color: #25d366;
        color: #fff;
    }

    .btn-see-all {
        display: inline-block;
        background-color: #ee212e;
        color: #fff;
        padding: 12px 35px;
        border-radius: 10px;
        font-weight: 600;
        text-decoration: none;
        transition: all 0.3s ease;
    }

    .btn-see-all:hover {
        background-color: #08aaf4;
        color: #fff;
        transform: translateY(-3px);
    }
</style>

@endsection
