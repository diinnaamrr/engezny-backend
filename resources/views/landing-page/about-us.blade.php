@extends('landing-page.layouts.master')

@section('title', 'About Us – NEMO Tours')

@section('content')

@php
    $primary_color = '#3E69AD';
    $dark_text = '#181E4B';
    $light_text = '#5E6282';
@endphp

{{-- ===========================
    HERO SECTION
============================ --}}
<section id="about-hero" class="about-hero-section">
    <div class="hero-overlay"></div>
    <div class="container">
        <div class="hero-content text-center">
            <h1 class="hero-title">Discover the Depths with NEMO Tours</h1>
            <p class="hero-subtitle">{{ $data?->value['short_description'] ?? 'Your Gateway to Unforgettable Underwater Adventures' }}</p>
        </div>
    </div>
</section>

{{-- ===========================
    OUR STORY SECTION
============================ --}}
<section id="our-story" class="our-story-section py-5">
    <div class="container">
        <div class="row align-items-center g-5">
            <div class="col-lg-6">
                <div class="story-image-wrapper">
                    <img src="{{ onErrorImage(
                        $data?->value['image'],
                        asset('storage/app/public/business/pages') . '/' . $data?->value['image'],
                        asset('public/landing-page/assets/img/clients/٢٠٢٥١١٠٣_١١٤٧٣٦.jpg'),
                        'business/pages/',
                    ) }}" 
                         alt="NEMO Tours Diving Experience" 
                         class="story-image">
                    <div class="image-decoration"></div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="story-content">
                    <p class="section-label">Who We Are</p>
                    <h2 class="section-title">Our Story</h2>
                    <div class="story-text">
                        {!! $data?->value['long_description'] !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- ===========================
    MISSION & VALUES SECTION
============================ --}}
<section id="mission-values" class="mission-values-section py-5">
    <div class="container">
        <div class="text-center mb-5">
            <p class="section-label">What Drives Us</p>
            <h2 class="section-title">Our Mission & Values</h2>
            <p class="section-description">
                We're committed to sharing the wonders of the underwater world while promoting marine conservation
            </p>
        </div>

        <div class="row g-4">
            {{-- Mission Card --}}
            <div class="col-lg-3 col-md-6">
                <div class="value-card">
                    <div class="value-icon">
                        <i class="bi bi-compass"></i>
                    </div>
                    <h4 class="value-title">Our Mission</h4>
                    <p class="value-text">
                        To share the wonders of the underwater world while promoting marine conservation and sustainable tourism.
                    </p>
                </div>
            </div>

            {{-- Safety Card --}}
            <div class="col-lg-3 col-md-6">
                <div class="value-card">
                    <div class="value-icon">
                        <i class="bi bi-shield-check"></i>
                    </div>
                    <h4 class="value-title">Safety First</h4>
                    <p class="value-text">
                        Professional PADI-certified instructors and top-tier equipment ensure your safety on every dive.
                    </p>
                </div>
            </div>

            {{-- Sustainability Card --}}
            <div class="col-lg-3 col-md-6">
                <div class="value-card">
                    <div class="value-icon">
                        <i class="bi bi-globe"></i>
                    </div>
                    <h4 class="value-title">Sustainability</h4>
                    <p class="value-text">
                        Committed to protecting marine ecosystems for future generations through responsible diving practices.
                    </p>
                </div>
            </div>

            {{-- Excellence Card --}}
            <div class="col-lg-3 col-md-6">
                <div class="value-card">
                    <div class="value-icon">
                        <i class="bi bi-star"></i>
                    </div>
                    <h4 class="value-title">Excellence</h4>
                    <p class="value-text">
                        Personalized service and attention to detail create unforgettable experiences for every guest.
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- ===========================
    WHY CHOOSE US SECTION
============================ --}}
<section id="why-choose-us" class="why-choose-section py-5">
    <div class="container">
        <div class="text-center mb-5">
            <p class="section-label">The NEMO Difference</p>
            <h2 class="section-title">Why Choose <span class="title-highlight">NEMO Tours</span></h2>
        </div>

        <div class="row g-4">
            <div class="col-lg-3 col-md-6">
                <div class="feature-box">
                    <div class="feature-icon-wrapper">
                        <i class="bi bi-people"></i>
                    </div>
                    <h5 class="feature-title">Expert Guides</h5>
                    <p class="feature-text">Local knowledge and years of diving experience</p>
                </div>
            </div>

            <div class="col-lg-3 col-md-6">
                <div class="feature-box">
                    <div class="feature-icon-wrapper">
                        <i class="bi bi-person-check"></i>
                    </div>
                    <h5 class="feature-title">Small Groups</h5>
                    <p class="feature-text">Personalized attention with limited group sizes</p>
                </div>
            </div>

            <div class="col-lg-3 col-md-6">
                <div class="feature-box">
                    <div class="feature-icon-wrapper">
                        <i class="bi bi-gear"></i>
                    </div>
                    <h5 class="feature-title">Premium Equipment</h5>
                    <p class="feature-text">Top-quality, well-maintained diving gear</p>
                </div>
            </div>

            <div class="col-lg-3 col-md-6">
                <div class="feature-box">
                    <div class="feature-icon-wrapper">
                        <i class="bi bi-calendar-check"></i>
                    </div>
                    <h5 class="feature-title">Flexible Packages</h5>
                    <p class="feature-text">Customizable tours to match your preferences</p>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection

@push('style')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
<style>
    /* Hero Section */
    .about-hero-section {
        position: relative;
        height: 60vh;
        min-height: 400px;
        background: linear-gradient(135deg, {{ $primary_color }} 0%, #2d5089 100%);
        background-image: url('{{ asset('public/landing-page/assets/img/hero_bg.jpg') }}');
        background-size: cover;
        background-position: center;
        background-attachment: fixed;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-top: 70px;
    }

    .hero-overlay {
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: linear-gradient(135deg, rgba(62, 105, 173, 0.85) 0%, rgba(45, 80, 137, 0.85) 100%);
    }

    .hero-content {
        position: relative;
        z-index: 2;
        color: white;
    }

    .hero-title {
        font-family: 'Volkhov', serif;
        font-size: 56px;
        font-weight: 700;
        margin-bottom: 20px;
        line-height: 1.2;
    }

    .hero-subtitle {
        font-size: 22px;
        font-weight: 400;
        opacity: 0.95;
    }

    /* Common Section Styles */
    .section-label {
        font-size: 18px;
        color: {{ $primary_color }};
        font-weight: 600;
        margin-bottom: 12px;
    }

    .section-title {
        font-family: 'Volkhov', serif;
        font-size: 48px;
        color: {{ $dark_text }};
        font-weight: 700;
        margin-bottom: 20px;
        line-height: 1.2;
    }

    .section-description {
        font-size: 17px;
        color: {{ $light_text }};
        max-width: 700px;
        margin: 0 auto;
    }

    .title-highlight {
        color: {{ $primary_color }};
        position: relative;
    }

    /* Our Story Section */
    .our-story-section {
        padding: 100px 0;
        background: #fff;
    }

    .story-image-wrapper {
        position: relative;
        border-radius: 24px;
        overflow: hidden;
        box-shadow: 0 20px 60px rgba(0, 0, 0, 0.15);
        width: 100%;
        max-width: 100%;
    }

    .story-image {
        width: 100% !important;
        max-width: 100% !important;
        height: 450px !important;
        object-fit: cover !important;
        display: block !important;
    }

    .image-decoration {
        position: absolute;
        top: -20px;
        right: -20px;
        width: 150px;
        height: 150px;
        background: {{ $primary_color }};
        opacity: 0.2;
        border-radius: 50%;
        z-index: -1;
    }

    .story-content {
        padding-left: 20px;
    }

    .story-text {
        font-size: 17px;
        color: {{ $light_text }};
        line-height: 1.8;
        margin-bottom: 20px;
    }

    /* Mission & Values Section */
    .mission-values-section {
        padding: 100px 0;
        background: linear-gradient(180deg, #ffffff 0%, #f8f9fa 100%);
    }

    .value-card {
        background: white;
        padding: 40px 30px;
        border-radius: 20px;
        text-align: center;
        height: 100%;
        transition: all 0.3s ease;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
    }

    .value-card:hover {
        transform: translateY(-10px);
        box-shadow: 0 20px 50px rgba(62, 105, 173, 0.15);
    }

    .value-icon {
        width: 80px;
        height: 80px;
        background: linear-gradient(135deg, {{ $primary_color }} 0%, #2d5089 100%);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 24px;
        font-size: 36px;
        color: white;
    }

    .value-title {
        font-size: 22px;
        font-weight: 700;
        color: {{ $dark_text }};
        margin-bottom: 16px;
    }

    .value-text {
        font-size: 16px;
        color: {{ $light_text }};
        line-height: 1.7;
        margin: 0;
    }

    /* Why Choose Us Section */
    .why-choose-section {
        padding: 100px 0;
        background: white;
    }

    .feature-box {
        text-align: center;
        padding: 30px 20px;
        transition: all 0.3s ease;
    }

    .feature-box:hover .feature-icon-wrapper {
        background: {{ $primary_color }};
        color: white;
        transform: scale(1.1);
    }

    .feature-icon-wrapper {
        width: 70px;
        height: 70px;
        background: rgba(62, 105, 173, 0.1);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 20px;
        font-size: 32px;
        color: {{ $primary_color }};
        transition: all 0.3s ease;
    }

    .feature-title {
        font-size: 20px;
        font-weight: 700;
        color: {{ $dark_text }};
        margin-bottom: 12px;
    }

    .feature-text {
        font-size: 15px;
        color: {{ $light_text }};
        margin: 0;
    }

    /* Responsive Design */
    @media (max-width: 991px) {
        .hero-title {
            font-size: 42px;
        }

        .hero-subtitle {
            font-size: 18px;
        }

        .section-title {
            font-size: 38px;
        }

        .our-story-section,
        .mission-values-section,
        .why-choose-section {
            padding: 80px 0;
        }

        .story-content {
            padding-left: 0;
            margin-top: 30px;
        }
    }

    @media (max-width: 768px) {
        .about-hero-section {
            height: 50vh;
            min-height: 350px;
        }

        .hero-title {
            font-size: 32px;
        }

        .hero-subtitle {
            font-size: 16px;
        }

        .section-title {
            font-size: 32px;
        }

        .story-image {
            height: 350px;
        }

        .our-story-section,
        .mission-values-section,
        .why-choose-section {
            padding: 60px 0;
        }
    }

    @media (max-width: 576px) {
        .hero-title {
            font-size: 28px;
        }

        .section-title {
            font-size: 28px;
        }

        .value-card {
            padding: 30px 20px;
        }
    }
</style>
@endpush
