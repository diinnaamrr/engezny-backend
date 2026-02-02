@extends('landing-page.layouts.master')

@section('title', 'Portfolio – NEMO Tours')

@section('content')

@php
    $primary_color = '#3E69AD';
    $dark_text = '#181E4B';
    $light_text = '#5E6282';
@endphp

@php
$portfolioGallery = [];
foreach($portfolioData as $item) {
    if($item?->value['status'] == 1) {
        $portfolioGallery[] = [
            'image' => asset('storage/app/public/business/landing-pages/portfolio/' . $item->value['image']),
            'title' => $item->value['title'],
            'description' => $item->value['description']
        ];
    }
}
@endphp

{{-- ===========================
    HERO SECTION
============================ --}}
<section id="portfolio-hero" class="portfolio-hero-section">
    <div class="hero-overlay"></div>
    <div class="container">
        <div class="hero-content text-center">
            <h1 class="hero-title">Our Adventures Gallery</h1>
            <p class="hero-subtitle">{{ $data?->value['short_description'] ?? 'Explore the breathtaking moments captured during our diving expeditions' }}</p>
        </div>
    </div>
</section>

{{-- ===========================
    PORTFOLIO GALLERY SECTION
============================ --}}
<section id="portfolio-gallery" class="portfolio-gallery-section py-5">
    <div class="container">
        <div class="text-center mb-5">
            <p class="section-label">Dive Memories</p>
            <h2 class="section-title">Captured <span class="title-highlight">Moments</span></h2>
            <p class="section-description">
                Every dive tells a story. Browse through our collection of unforgettable underwater experiences
            </p>
        </div>

        <div class="portfolio-grid">
            @foreach($portfolioGallery as $index => $item)
                <div class="portfolio-item" data-index="{{ $index }}">
                    <div class="portfolio-card">
                        <div class="portfolio-image-wrapper">
                            <img src="{{ $item['image'] }}" 
                                 alt="{{ $item['title'] }}" 
                                 class="portfolio-image">
                            <div class="portfolio-overlay">
                                <div class="portfolio-content">
                                    <h4 class="portfolio-title">{{ $item['title'] }}</h4>
                                    <p class="portfolio-description">{{ $item['description'] }}</p>
                                    <button class="view-btn" onclick="openLightbox({{ $index }})">
                                        <i class="bi bi-arrows-fullscreen"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>

{{-- ===========================
    LIGHTBOX MODAL
============================ --}}
<div id="lightbox" class="lightbox" onclick="closeLightbox()">
    <span class="lightbox-close">&times;</span>
    <button class="lightbox-prev" onclick="event.stopPropagation(); changeImage(-1)">
        <i class="bi bi-chevron-left"></i>
    </button>
    <button class="lightbox-next" onclick="event.stopPropagation(); changeImage(1)">
        <i class="bi bi-chevron-right"></i>
    </button>
    <div class="lightbox-content">
        <img id="lightbox-image" src="" alt="">
        <div class="lightbox-caption">
            <h3 id="lightbox-title"></h3>
            <p id="lightbox-description"></p>
        </div>
    </div>
</div>

@endsection

@push('style')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
<style>
    /* Hero Section */
    .portfolio-hero-section {
        position: relative;
        height: 50vh;
        min-height: 350px;
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
        font-size: 52px;
        font-weight: 700;
        margin-bottom: 20px;
        line-height: 1.2;
    }

    .hero-subtitle {
        font-size: 20px;
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
        margin: 0 auto 60px;
    }

    .title-highlight {
        color: {{ $primary_color }};
        position: relative;
    }

    /* Portfolio Gallery Section */
    .portfolio-gallery-section {
        padding: 100px 0;
        background: linear-gradient(180deg, #ffffff 0%, #f8f9fa 100%);
    }

    .portfolio-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 24px;
    }

    .portfolio-item {
        opacity: 0;
        animation: fadeInUp 0.6s ease forwards;
    }

    .portfolio-item:nth-child(1) { animation-delay: 0.1s; }
    .portfolio-item:nth-child(2) { animation-delay: 0.2s; }
    .portfolio-item:nth-child(3) { animation-delay: 0.3s; }
    .portfolio-item:nth-child(4) { animation-delay: 0.4s; }
    .portfolio-item:nth-child(5) { animation-delay: 0.5s; }
    .portfolio-item:nth-child(6) { animation-delay: 0.6s; }

    @keyframes fadeInUp {
        from {
            opacity: 0;
            transform: translateY(30px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .portfolio-card {
        height: 100%;
        border-radius: 20px;
        overflow: hidden;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
        transition: all 0.4s ease;
        background: white;
    }

    .portfolio-card:hover {
        transform: translateY(-8px);
        box-shadow: 0 20px 50px rgba(62, 105, 173, 0.2);
    }

    .portfolio-image-wrapper {
        position: relative;
        width: 100% !important;
        aspect-ratio: 4/3;
        overflow: hidden;
        max-width: 100% !important;
    }

    .portfolio-image {
        width: 100% !important;
        height: 100% !important;
        max-width: 100% !important;
        object-fit: cover !important;
        transition: transform 0.4s ease;
    }

    .portfolio-card:hover .portfolio-image {
        transform: scale(1.1);
    }

    .portfolio-overlay {
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: linear-gradient(180deg, 
            rgba(62, 105, 173, 0) 0%, 
            rgba(62, 105, 173, 0.7) 50%,
            rgba(62, 105, 173, 0.95) 100%);
        display: flex;
        align-items: flex-end;
        padding: 30px;
        opacity: 0;
        transition: opacity 0.4s ease;
    }

    .portfolio-card:hover .portfolio-overlay {
        opacity: 1;
    }

    .portfolio-content {
        color: white;
        transform: translateY(20px);
        transition: transform 0.4s ease;
    }

    .portfolio-card:hover .portfolio-content {
        transform: translateY(0);
    }

    .portfolio-title {
        font-size: 22px;
        font-weight: 700;
        margin-bottom: 8px;
        color: white;
    }

    .portfolio-description {
        font-size: 15px;
        margin-bottom: 15px;
        opacity: 0.95;
    }

    .view-btn {
        background: white;
        color: {{ $primary_color }};
        border: none;
        width: 40px;
        height: 40px;
        border-radius: 50%;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        font-size: 18px;
        cursor: pointer;
        transition: all 0.3s ease;
    }

    .view-btn:hover {
        background: {{ $primary_color }};
        color: white;
        transform: scale(1.1);
    }

    /* Lightbox Styles */
    .lightbox {
        display: none;
        position: fixed;
        z-index: 9999;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0, 0, 0, 0.95);
        align-items: center;
        justify-content: center;
    }

    .lightbox.active {
        display: flex;
    }

    .lightbox-close {
        position: absolute;
        top: 30px;
        right: 40px;
        font-size: 50px;
        color: white;
        cursor: pointer;
        z-index: 10001;
        transition: color 0.3s ease;
    }

    .lightbox-close:hover {
        color: {{ $primary_color }};
    }

    .lightbox-prev,
    .lightbox-next {
        position: absolute;
        top: 50%;
        transform: translateY(-50%);
        background: rgba(255, 255, 255, 0.2);
        color: white;
        border: none;
        width: 60px;
        height: 60px;
        border-radius: 50%;
        font-size: 24px;
        cursor: pointer;
        transition: all 0.3s ease;
        z-index: 10001;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .lightbox-prev:hover,
    .lightbox-next:hover {
        background: {{ $primary_color }};
    }

    .lightbox-prev {
        left: 40px;
    }

    .lightbox-next {
        right: 40px;
    }

    .lightbox-content {
        max-width: 90%;
        max-height: 90%;
        text-align: center;
    }

    #lightbox-image {
        max-width: 100%;
        max-height: 70vh;
        border-radius: 12px;
        box-shadow: 0 20px 60px rgba(0, 0, 0, 0.5);
    }

    .lightbox-caption {
        color: white;
        margin-top: 20px;
    }

    #lightbox-title {
        font-size: 28px;
        font-weight: 700;
        margin-bottom: 10px;
    }

    #lightbox-description {
        font-size: 18px;
        opacity: 0.9;
    }

    /* Responsive Design */
    @media (max-width: 991px) {
        .portfolio-grid {
            grid-template-columns: repeat(2, 1fr);
            gap: 20px;
        }

        .hero-title {
            font-size: 40px;
        }

        .section-title {
            font-size: 38px;
        }

        .portfolio-gallery-section {
            padding: 80px 0;
        }
    }

    @media (max-width: 768px) {
        .portfolio-hero-section {
            height: 40vh;
            min-height: 300px;
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

        .portfolio-gallery-section {
            padding: 60px 0;
        }

        .lightbox-prev,
        .lightbox-next {
            width: 50px;
            height: 50px;
            font-size: 20px;
        }

        .lightbox-prev {
            left: 20px;
        }

        .lightbox-next {
            right: 20px;
        }

        .lightbox-close {
            top: 20px;
            right: 20px;
            font-size: 40px;
        }

        #lightbox-title {
            font-size: 22px;
        }

        #lightbox-description {
            font-size: 16px;
        }
    }

    @media (max-width: 576px) {
        .portfolio-grid {
            grid-template-columns: 1fr;
            gap: 16px;
        }

        .hero-title {
            font-size: 28px;
        }

        .section-title {
            font-size: 28px;
        }

        .portfolio-overlay {
            opacity: 1;
            background: linear-gradient(180deg, 
                rgba(62, 105, 173, 0) 0%, 
                rgba(62, 105, 173, 0.85) 100%);
        }

        .portfolio-content {
            transform: translateY(0);
        }
    }
</style>
@endpush

@push('script')
<script>
    const portfolioData = @json($portfolioGallery);
    let currentImageIndex = 0;

    function openLightbox(index) {
        currentImageIndex = index;
        updateLightboxContent();
        document.getElementById('lightbox').classList.add('active');
        document.body.style.overflow = 'hidden';
    }

    function closeLightbox() {
        document.getElementById('lightbox').classList.remove('active');
        document.body.style.overflow = 'auto';
    }

    function changeImage(direction) {
        currentImageIndex += direction;
        if (currentImageIndex < 0) {
            currentImageIndex = portfolioData.length - 1;
        } else if (currentImageIndex >= portfolioData.length) {
            currentImageIndex = 0;
        }
        updateLightboxContent();
    }

    function updateLightboxContent() {
        const item = portfolioData[currentImageIndex];
        document.getElementById('lightbox-image').src = '{{ asset('') }}' + item.image;
        document.getElementById('lightbox-title').textContent = item.title;
        document.getElementById('lightbox-description').textContent = item.description;
    }

    // Keyboard navigation
    document.addEventListener('keydown', function(e) {
        const lightbox = document.getElementById('lightbox');
        if (lightbox.classList.contains('active')) {
            if (e.key === 'Escape') {
                closeLightbox();
            } else if (e.key === 'ArrowLeft') {
                changeImage(-1);
            } else if (e.key === 'ArrowRight') {
                changeImage(1);
            }
        }
    });
</script>
@endpush
