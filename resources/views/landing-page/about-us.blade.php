@extends('landing-page.layouts.master')

@section('title', 'About Us – NEMO Tours')

@section('content')

@php
    $primary_color = '#ee212e';
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
            <h1 class="hero-title">About Us</h1>
            <p class="hero-subtitle">{{ $data?->value['short_description'] ?? 'Your Gateway to Unforgettable Underwater Adventures' }}</p>
        </div>
    </div>
</section>

{{-- ===========================
    FOUNDER PROFILE SECTION
============================ --}}
<section id="founder-profile" class="founder-profile-section py-5">
    <div class="container">
        <div class="text-center my-5">
        </div>

        <div class="row align-items-center g-5 mb-5">
            <div class="col-lg-6">
                <div class="founder-content">
                    <h3 class="founder-name">Mr. Hassan</h3>
                    <p class="story-text">
                        Mr. Hassan, the founder of Nemo Tours, brings over 20 years of hands-on
                        experience in diving, rentals, and tourism services across Egypt, with deep
                        specialization in Marsa Alam. He began his journey as a one-man operation,
                        personally managing every aspect of the guest experience—from field
                        operations to customer relations.
                    </p>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="founder-image-wrapper">
                    <img src="{{ asset('public/landing-page/assets/img/hasan_nemo.jpg') }}" 
                         alt="Mr. Hassan - Founder" 
                         class="founder-image">
                </div>
            </div>
        </div>

        <div class="row align-items-center g-5">
            <div class="col-lg-6 order-lg-2">
                <div class="founder-content">
                    <p class="story-text">
                        Throughout his career, Mr. Hassan has also worked as a consultant for
                        multiple tourism and diving centers, contributing his operational insight and
                        market knowledge to help improve service quality and guest satisfaction. His
                        long-standing, direct relationships with travelers, combined with his practical
                        expertise, form the backbone of Nemo Tours’ philosophy and standards today.
                    </p>
                </div>
            </div>
            <div class="col-lg-6 order-lg-1">
                <div class="founder-image-wrapper">
                    <img src="{{ asset('public/landing-page/assets/img/hasan_nemo2.jpg') }}" 
                         alt="Mr. Hassan - Field Operations" 
                         class="founder-image">
                </div>
            </div>
        </div>
    </div>
</section>

{{-- ===========================
    CERTIFICATES SECTION
============================ --}}
<section id="certificates" class="certificates-section py-5">
    <div class="container">
        <div class="text-center mb-5">
            <p class="section-label">Our Achievements</p>
            <h2 class="section-title">Certificates & Accreditations</h2>
            <p class="section-description mx-auto" style="max-width: 700px;">
                Recognized for excellence in tourism and diving services across Egypt.
            </p>
        </div>

        <div id="certificatesCarousel" class="carousel slide" data-bs-ride="carousel" data-bs-interval="3000">
            <div class="carousel-inner">
                {{-- Slide 1 --}}
                <div class="carousel-item active">
                    <div class="row g-4">
                        <div class="col-lg-4 col-md-6">
                            <div class="certificate-card rounded-4 bg-white border-0 shadow-sm h-100">
                                <div class="certificate-image-wrapper">
                                    <img src="{{ asset('public/landing-page/assets/img/certificates/cer1.png') }}" 
                                         alt="Certificate 1" 
                                         class="certificate-image">
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6">
                            <div class="certificate-card rounded-4 bg-white border-0 shadow-sm h-100">
                                <div class="certificate-image-wrapper">
                                    <img src="{{ asset('public/landing-page/assets/img/certificates/cer2.png') }}" 
                                         alt="Certificate 2" 
                                         class="certificate-image">
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6">
                            <div class="certificate-card rounded-4 bg-white border-0 shadow-sm h-100">
                                <div class="certificate-image-wrapper">
                                    <img src="{{ asset('public/landing-page/assets/img/certificates/cer3.png') }}" 
                                         alt="Certificate 3" 
                                         class="certificate-image">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Slide 2 --}}
                <div class="carousel-item">
                    <div class="row g-4">
                        <div class="col-lg-4 col-md-6">
                            <div class="certificate-card rounded-4 bg-white border-0 shadow-sm h-100">
                                <div class="certificate-image-wrapper">
                                    <img src="{{ asset('public/landing-page/assets/img/certificates/cer4.png') }}" 
                                         alt="Certificate 4" 
                                         class="certificate-image">
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6">
                            <div class="certificate-card rounded-4 bg-white border-0 shadow-sm h-100">
                                <div class="certificate-image-wrapper">
                                    <img src="{{ asset('public/landing-page/assets/img/certificates/cer5.png') }}" 
                                         alt="Certificate 5" 
                                         class="certificate-image">
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6">
                            <div class="certificate-card rounded-4 bg-white border-0 shadow-sm h-100">
                                <div class="certificate-image-wrapper">
                                    <img src="{{ asset('public/landing-page/assets/img/certificates/cer6.png') }}" 
                                         alt="Certificate 6" 
                                         class="certificate-image">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Carousel Controls --}}
            <button class="carousel-control-prev" type="button" data-bs-target="#certificatesCarousel" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#certificatesCarousel" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>

            {{-- Carousel Indicators --}}
            <div class="carousel-indicators">
                <button type="button" data-bs-target="#certificatesCarousel" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                <button type="button" data-bs-target="#certificatesCarousel" data-bs-slide-to="1" aria-label="Slide 2"></button>
            </div>
        </div>
    </div>
</section>

{{-- ===========================
    ABOUT NEMO TOURS - INTRO
============================ --}}
<section id="about-nemo-intro" class="about-nemo-section py-5 bg-gradient-light">
    <div class="container">
        <div class="row align-items-center g-5">
            <div class="col-lg-7">
                <div class="nemo-content">
                    <p class="section-label">A Legacy of Trust</p>
                    <h2 class="section-title">About Nemo Tours</h2>
                    <p class="story-text mb-4">
                        Nemo Tours is a full-service travel and tourism company delivering
                        comprehensive solutions across all of Egypt. Built on decades of real-world
                        experience, the company is designed to offer seamless, reliable, and
                        personalized travel services under one trusted brand.
                    </p>
                    <div class="experience-badge d-inline-flex align-items-center p-3 rounded-4 bg-white shadow-sm border">
                        <div class="badge-icon me-3 bg-primary text-white rounded-circle d-flex align-items-center justify-content-center" style="width: 50px; height: 50px;">
                            <i class="bi bi-calendar-check-fill fs-4"></i>
                        </div>
                        <div>
                            <h5 class="mb-0 fw-bold">20+ Years</h5>
                            <small class="text-muted">In Tourism Excellence</small>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-5">
                <div class="nemo-intro-card p-5 rounded-5 shadow-lg bg-white border-0 position-relative overflow-hidden">
                    <div class="card-gradient-overlay"></div>
                    <p class="story-text position-relative z-1 mb-0 italic">
                        "Our journey began with a simple goal: to provide every traveler with an authentic Egyptian experience, backed by local expertise and genuine care."
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- ===========================
    OUR SERVICES SECTION
============================ --}}
<section id="our-services" class="our-services-section py-5">
    <div class="container">
        <div class="text-center mb-5">
            <p class="section-label">What We Offer</p>
            <h2 class="section-title">Our Comprehensive Services</h2>
            <p class="section-description mx-auto" style="max-width: 700px;">
                We manage all reservations and travel arrangements within Egypt, ensuring every detail of your journey is handled with precision.
            </p>
        </div>

        <div class="row g-4">
            @php
                $services = [
                    ['icon' => 'bi-building-check', 'title' => 'Accommodation', 'desc' => 'Hotel and apartment bookings across Egypt.', 'color' => '#ee212e'],
                    ['icon' => 'bi-map', 'title' => 'Domestic Travel', 'desc' => 'Travel planning and seamless transportation.', 'color' => '#6ed5f9'],
                    ['icon' => 'bi-airplane', 'title' => 'Airport Transfers', 'desc' => 'Reliable pickups from all Egyptian airports.', 'color' => '#08aaf4'],
                    ['icon' => 'bi-car-front', 'title' => 'Car Rentals', 'desc' => 'Fleet of well-maintained vehicles for your trips.', 'color' => '#ff7d01'],
                    ['icon' => 'bi-water', 'title' => 'Diving Adventures', 'desc' => 'World-class diving trips and equipment rentals.', 'color' => '#ee212e'],
                    ['icon' => 'bi-clock-history', 'title' => '24/7 Support', 'desc' => 'Always here to assist you during your journey.', 'color' => '#6ed5f9'],
                ];
            @endphp

            @foreach($services as $service)
            <div class="col-lg-4 col-md-6">
                <div class="service-v2-card h-100 p-4 rounded-4 bg-white border border-light-subtle shadow-sm transition-all">
                    <div class="service-icon-box mb-3 rounded-3 d-flex align-items-center justify-content-center" style="width: 60px; height: 60px; background: {{ $service['color'] }}; color: white;">
                        <i class="bi {{ $service['icon'] }} fs-3"></i>
                    </div>
                    <h4 class="fw-bold mb-2">{{ $service['title'] }}</h4>
                    <p class="text-muted mb-0 small">{{ $service['desc'] }}</p>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

{{-- ===========================
    THE NEMO PROMISE SECTION
============================ --}}
<section id="nemo-promise" class="py-5 bg-gradient-blue text-white">
    <div class="container">
        <div class="row align-items-center g-5">
            <div class="col-lg-6">
                <div class="promise-content">
                    <!-- <h2 class="section-title text-white">The Nemo Promise</h2> -->
                    <p class="lead mb-4 opacity-75">
                        Whether you are planning a leisure holiday, a diving adventure, or a fully
                        customised itinerary, Nemo Tours provides the flexibility to design your
                        journey around your preferences, budget, and schedule.
                    </p>
                    <!-- <div class="d-flex align-items-center p-4 rounded-4 bg-white bg-opacity-10 backdrop-blur border border-white border-opacity-25">
                        <div class="promise-icon me-4">
                            <i class="bi bi-headset fs-1 text-warning"></i>
                        </div>
                        <div>
                            <h4 class="mb-1 text-white">24/7 Customer Support</h4>
                            <p class="mb-0 opacity-75">Deep operational knowledge and strong local partnerships.</p>
                        </div>
                    </div> -->
                </div>
            </div>
            <div class="col-lg-6 text-center">
                <p class="story-text text-white opacity-90 mb-0">
                    Nemo Tours ensures every detail is handled with precision—allowing guests to explore Egypt with confidence, comfort, and authenticity.
                </p>
            </div>
        </div>
    </div>
</section>

{{-- ===========================
    MISSION & VISION SECTION
============================ --}}
<section id="mission-vision" class="py-5">
    <div class="container">
        <div class="row g-4">
            <div class="col-md-6">
                <div class="mv-card mission-modern p-5 rounded-5 border-0 shadow-lg h-100">
                    <div class="card-icon mb-4"><i class="bi bi-lightning-charge-fill text-primary display-4"></i></div>
                    <h3 class="fw-bold mb-3">Our Mission</h3>
                    <p class="story-text">To deliver authentic, safe, and personalised travel experiences in Egypt by combining local expertise, flexible tour design, and genuine care for our guests.</p>
                </div>
            </div>
            <div class="col-md-6">
                <div class="mv-card vision-modern p-5 rounded-5 border-0 shadow-lg h-100 text-end">
                    <div class="card-icon mb-4"><i class="bi bi-eye-fill text-warning display-4"></i></div>
                    <h3 class="fw-bold mb-3 text-end">Our Vision</h3>
                    <p class="story-text">To become a trusted and preferred tourism brand in Egypt, recognised for customisation, reliability, and unforgettable Red Sea experiences.</p>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- ===========================
    CORE VALUES SECTION (ENHANCED)
============================ --}}
<section id="enhanced-values" class="py-5 bg-gradient-light">
    <div class="container">
        <div class="text-center mb-5">
            <p class="section-label">Our DNA</p>
            <h2 class="section-title">Core Values</h2>
        </div>

        <div class="values-grid">
            @php
                $values = [
                    ['icon' => 'bi-patch-check', 'title' => 'Authenticity', 'desc' => 'Real local experiences, not generic tours.', 'gradient' => 'linear-gradient(135deg, #ee212e 0%, #ff7d01 100%)'],
                    ['icon' => 'bi-mortarboard', 'title' => 'Expertise', 'desc' => 'Built on years of hands-on field knowledge.', 'gradient' => 'linear-gradient(135deg, #6ed5f9 0%, #08aaf4 100%)'],
                    ['icon' => 'bi-sliders', 'title' => 'Flexibility', 'desc' => 'Trips designed around the traveler, not templates.', 'gradient' => 'linear-gradient(135deg, #08aaf4 0%, #ee212e 100%)'],
                    ['icon' => 'bi-shield-lock', 'title' => 'Trust & Safety', 'desc' => 'Clear communication and reliable service.', 'gradient' => 'linear-gradient(135deg, #ff7d01 0%, #6ed5f9 100%)'],
                    ['icon' => 'bi-chat-heart', 'title' => 'Customer-Centric', 'desc' => 'Support before, during, and after every trip.', 'gradient' => 'linear-gradient(135deg, #ee212e 0%, #6ed5f9 100%)'],
                ];
            @endphp

            <div class="row justify-content-center g-4">
                @foreach($values as $val)
                <div class="col-lg-4 col-md-6">
                    <div class="value-v2-card p-4 rounded-4 bg-white border-0 shadow-sm h-100 text-center transition-all">
                        <div class="value-icon-v2 mx-auto mb-3 d-flex align-items-center justify-content-center rounded-circle" style="width: 60px; height: 60px; background: {{ $val['gradient'] }};">
                            <i class="bi {{ $val['icon'] }} text-white fs-4"></i>
                        </div>
                        <h4 class="fw-bold mb-3">{{ $val['title'] }}</h4>
                        <p class="text-muted small mb-0">{{ $val['desc'] }}</p>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</section>



{{-- ===========================
    CALL TO ACTION SECTION
============================ --}}
<section id="about-cta" class="py-5 mb-5">
    <div class="container">
        <div class="cta-box p-5 rounded-5 text-center shadow-lg position-relative overflow-hidden" style="background: linear-gradient(135deg, #08aaf4 0%, #6ed5f9 100%);">
            <div class="cta-decoration"></div>
            <div class="position-relative z-1">
                <p class="text-white text-uppercase fw-bold mb-2 tracking-wider">Ready for your adventure?</p>
                <h2 class="display-5 text-white fw-bold mb-4">Contact us directly</h2>
                <div class="d-flex flex-column flex-md-row align-items-center justify-content-center gap-3">
                    <a href="https://wa.me/201092958475" target="_blank" class="btn btn-light btn-lg px-5 py-3 rounded-pill fw-bold text-primary shadow-sm">
                        <i class="bi bi-whatsapp me-2"></i> 01092958475
                    </a>
                    <a href="{{ route('contact-us') }}" class="btn btn-outline-light btn-lg px-5 py-3 rounded-pill fw-bold">
                        Learn More
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

<style>
    .cta-box {
        border: none;
    }
    .cta-decoration {
        position: absolute;
        top: -50px;
        right: -50px;
        width: 200px;
        height: 200px;
        background: rgba(255, 255, 255, 0.1);
        border-radius: 50%;
    }
    .tracking-wider {
        letter-spacing: 2px;
    }
</style>

@push('style')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
<style>
    /* Gradient Backgrounds */
    .bg-gradient-light {
        background: linear-gradient(135deg, #f8fbff 0%, #ffffff 100%);
    }

    .bg-gradient-blue {
        background: linear-gradient(135deg, {{ $primary_color }} 0%, #08aaf4 100%);
    }

    /* Hero Section */
    .about-hero-section {
        position: relative;
        height: 50vh;
        min-height: 400px;
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
        background: linear-gradient(135deg, rgba(62, 105, 173, 0.4) 0%, rgba(45, 80, 137, 0.4) 100%);
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
        color: white;
    }

    .hero-subtitle {
        font-size: 22px;
        font-weight: 400;
        opacity: 0.95;
        color: white;
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
        font-size: 44px;
        color: {{ $dark_text }};
        font-weight: 700;
        margin-bottom: 20px;
        line-height: 1.2;
    }

    .story-text {
        font-size: 17px;
        color: {{ $light_text }};
        line-height: 1.8;
    }

    /* Founder Profile */
    .founder-image-wrapper {
        border-radius: 24px;
        overflow: hidden;
        box-shadow: 0 20px 60px rgba(0, 0, 0, 0.1);
    }

    .founder-image {
        width: 100%;
        height: 400px;
        object-fit: cover;
        transition: transform 0.5s ease;
    }

    .founder-image:hover { transform: scale(1.05); }

    .founder-name {
        font-family: 'Volkhov', serif;
        font-size: 32px;
        color: {{ $dark_text }};
        margin-bottom: 20px;
        position: relative;
    }

    .founder-name::after {
        content: '';
        position: absolute; bottom: -10px; left: 0;
        width: 60px; height: 3px; background: {{ $primary_color }};
    }

    /* Nemo Intro Card */
    .nemo-intro-card {
        background: white;
        min-height: 250px;
        display: flex;
        align-items: center;
        justify-content: center;
        text-align: center;
        border-radius: 40px !important;
        transition: all 0.5s ease;
    }

    .experience-badge {
        border-radius: 25px !important;
        transition: all 0.5s ease;
    }

    .card-gradient-overlay {
        position: absolute; top: 0; left: 0; width: 100%; height: 100%;
        background: linear-gradient(135deg, rgba(62, 105, 173, 0.05) 0%, rgba(255, 122, 80, 0.05) 100%);
    }

    /* Service V2 Card */
    .service-v2-card {
        border-radius: 30px !important;
        transition: all 0.5s cubic-bezier(0.4, 0, 0.2, 1) !important;
        border: 1px solid rgba(0,0,0,0.05) !important;
    }

    .service-v2-card:hover {
        transform: translateY(-10px);
        background: linear-gradient(135deg, #ffffff 0%, rgba(62, 105, 173, 0.05) 100%);
        border-color: {{ $primary_color }} !important;
        box-shadow: 0 15px 35px rgba(62, 105, 173, 0.1) !important;
    }

    /* Mission/Vision Modern */
    .mission-modern { 
        background: linear-gradient(135deg, #ffffff 0%, rgba(62, 105, 173, 0.08) 100%); 
        border-radius: 40px !important;
        transition: all 0.5s ease;
    }
    .vision-modern { 
        background: linear-gradient(135deg, #ffffff 0%, rgba(255, 122, 80, 0.08) 100%); 
        border-radius: 40px !important;
        transition: all 0.5s ease;
    }

    /* Value V2 Card */
    .value-v2-card {
        border-radius: 30px !important;
        transition: all 0.5s cubic-bezier(0.4, 0, 0.2, 1) !important;
        border: 1px solid rgba(0,0,0,0.05) !important;
    }

    .value-v2-card:hover {
        transform: translateY(-10px);
        box-shadow: 0 20px 45px rgba(62, 105, 173, 0.15) !important;
        border-color: {{ $primary_color }} !important;
    }

    .gradient-icon-bg {
        width: 60px; height: 60px;
        background: linear-gradient(135deg, {{ $primary_color }} 0%, #ff7d01 100%);
    }

    .backdrop-blur { backdrop-filter: blur(10px); }

    /* Certificates Section */
    .certificates-section {
        background: linear-gradient(135deg, #f8fbff 0%, #ffffff 100%);
    }

    .certificates-section .carousel-inner {
        padding: 20px 10px 50px 10px; /* Add padding to prevent clipping on hover */
    }

    .certificate-card {
        border-radius: 30px !important;
        transition: all 0.5s cubic-bezier(0.4, 0, 0.2, 1) !important;
        border: 1px solid rgba(0,0,0,0.05) !important;
    }

    .certificate-card:hover {
        transform: translateY(-10px);
        box-shadow: 0 20px 45px rgba(62, 105, 173, 0.15) !important;
        border-color: {{ $primary_color }} !important;
    }

    .certificate-image-wrapper {
        border-radius: 20px;
        overflow: hidden;
        background: transparent;
        height: 450px;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .certificate-image {
        width: 100%;
        height: 100%;
        object-fit: contain;
        transition: transform 0.5s ease;
    }

    .certificate-card:hover .certificate-image {
        transform: scale(1.05);
    }

    /* Custom Carousel Controls */
    .carousel-control-prev,
    .carousel-control-next {
        width: 50px;
        height: 50px;
        background: {{ $primary_color }};
        border-radius: 50%;
        top: 50%;
        transform: translateY(-50%);
        opacity: 0.8;
        transition: all 0.3s ease;
    }

    .carousel-control-prev {
        left: -25px;
    }

    .carousel-control-next {
        right: -25px;
    }

    .carousel-control-prev:hover,
    .carousel-control-next:hover {
        opacity: 1;
        background: #2d5089;
    }

    .carousel-control-prev-icon,
    .carousel-control-next-icon {
        width: 20px;
        height: 20px;
    }

    .carousel-indicators {
        margin-bottom: -40px;
    }

    .carousel-indicators button {
        width: 12px;
        height: 12px;
        border-radius: 50%;
        background-color: {{ $primary_color }};
        opacity: 0.5;
        transition: all 0.3s ease;
    }

    .carousel-indicators button.active {
        opacity: 1;
        transform: scale(1.2);
    }

    /* Responsive */
    @media (max-width: 991px) {
        .hero-title { font-size: 42px; }
        .section-title { font-size: 36px; }
    }

    @media (max-width: 768px) {
        .hero-title { font-size: 32px; }
        .section-title { font-size: 30px; }
    }
</style>
@endpush
