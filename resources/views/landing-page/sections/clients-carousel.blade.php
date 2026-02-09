{{-- ===========================
    CLIENTS CAROUSEL SECTION
============================ --}}
<section id="clients-carousel" class="clients-carousel-section">
    <div class="container">
        {{-- Section Header --}}
        <div class="carousel-header text-center">
            <div class="carousel-label">
                <span class="label-icon">📸</span>
                Happy Travelers
            </div>
            <h2 class="carousel-title">Memories from Our <span class="title-highlight">Adventures</span></h2>
            <p class="carousel-description">
                See the unforgettable moments our clients experienced during their safari journeys
            </p>
        </div>

        {{-- Carousel --}}
        <div class="carousel-container">
            <div id="clientsCarousel" class="carousel slide carousel-fade" data-bs-ride="carousel" data-bs-interval="4000">
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <div class="carousel-image-wrapper">
                            <img src="{{ asset('public/landing-page/assets/img/clients/٢٠٢٥١٠١٤_١٢١٠٣٨.jpg') }}"
                                class="client-image" alt="Safari Adventure 1">
                            <div class="image-overlay"></div>
                        </div>
                    </div>
                    <div class="carousel-item">
                        <div class="carousel-image-wrapper">
                            <img src="{{ asset('public/landing-page/assets/img/clients/٢٠٢٥١٠٣١_١٠٠٥٢١.jpg') }}"
                                class="client-image" alt="Safari Adventure 2">
                            <div class="image-overlay"></div>
                        </div>
                    </div>
                    <div class="carousel-item">
                        <div class="carousel-image-wrapper">
                            <img src="{{ asset('public/landing-page/assets/img/clients/٢٠٢٥١١٠٣_١١٤٧٣٦.jpg') }}"
                                class="client-image" alt="Safari Adventure 3">
                            <div class="image-overlay"></div>
                        </div>
                    </div>
                    <div class="carousel-item">
                        <div class="carousel-image-wrapper">
                            <img src="{{ asset('public/landing-page/assets/img/clients/٢٠٢٥١١٠٩_١١٣٣١٥.jpg') }}"
                                class="client-image" alt="Safari Adventure 4">
                            <div class="image-overlay"></div>
                        </div>
                    </div>
                    <div class="carousel-item">
                        <div class="carousel-image-wrapper">
                            <img src="{{ asset('public/landing-page/assets/img/clients/٢٠٢٥١٢٠٥_١٤٢٦٣٤.jpg') }}"
                                class="client-image" alt="Safari Adventure 5">
                            <div class="image-overlay"></div>
                        </div>
                    </div>
                    <div class="carousel-item">
                        <div class="carousel-image-wrapper">
                            <img src="{{ asset('public/landing-page/assets/img/clients/٢٠٢٥١٢١٩_٠٧١٠١٣.jpg') }}"
                                class="client-image" alt="Safari Adventure 6">
                            <div class="image-overlay"></div>
                        </div>
                    </div>
                </div>

                {{-- Custom Navigation Arrows --}}
                <button class="carousel-control-prev custom-carousel-control" type="button" data-bs-target="#clientsCarousel" data-bs-slide="prev">
                    <span class="custom-carousel-icon">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                            <path d="M15 18l-6-6 6-6" />
                        </svg>
                    </span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next custom-carousel-control" type="button" data-bs-target="#clientsCarousel" data-bs-slide="next">
                    <span class="custom-carousel-icon">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                            <path d="M9 18l6-6-6-6" />
                        </svg>
                    </span>
                    <span class="visually-hidden">Next</span>
                </button>

                {{-- Carousel Indicators --}}
                <div class="carousel-indicators custom-indicators">
                    <button type="button" data-bs-target="#clientsCarousel" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                    <button type="button" data-bs-target="#clientsCarousel" data-bs-slide-to="1" aria-label="Slide 2"></button>
                    <button type="button" data-bs-target="#clientsCarousel" data-bs-slide-to="2" aria-label="Slide 3"></button>
                    <button type="button" data-bs-target="#clientsCarousel" data-bs-slide-to="3" aria-label="Slide 4"></button>
                    <button type="button" data-bs-target="#clientsCarousel" data-bs-slide-to="4" aria-label="Slide 5"></button>
                    <button type="button" data-bs-target="#clientsCarousel" data-bs-slide-to="5" aria-label="Slide 6"></button>
                </div>
            </div>
        </div>
    </div>
</section>

<style>
    /* Section Base */
    .clients-carousel-section {
        padding: 100px 0;
        background: linear-gradient(180deg, #ffffff 0%, #f8f9fa 100%);
        position: relative;
        overflow: hidden;
    }

    /* Section Header */
    .carousel-header {
        margin-bottom: 60px;
    }

    .carousel-label {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        font-size: 16px;
        color: #ee212e;
        font-weight: 600;
        margin-bottom: 16px;
        padding: 8px 20px;
        background: rgba(62, 105, 173, 0.1);
        border-radius: 50px;
    }

    .label-icon {
        font-size: 18px;
    }

    .carousel-title {
        font-size: 48px;
        color: #181E4B;
        font-weight: 700;
        line-height: 1.2;
        margin-bottom: 16px;
    }

    .title-highlight {
        color: #ee212e;
        position: relative;
        display: inline-block;
    }

    .title-highlight::after {
        content: '';
        position: absolute;
        bottom: 8px;
        left: 0;
        right: 0;
        height: 12px;
        background: rgba(62, 105, 173, 0.2);
        z-index: -1;
    }

    .carousel-description {
        font-size: 17px;
        color: #5E6282;
        max-width: 600px;
        margin: 0 auto;
    }

    /* Carousel Container */
    .carousel-container {
        max-width: 1000px;
        margin: 0 auto;
        position: relative;
    }

    /* Carousel Image Wrapper */
    .carousel-image-wrapper {
        position: relative;
        width: 100%;
        height: 600px;
        border-radius: 24px;
        overflow: hidden;
        box-shadow:
            0 20px 60px rgba(0, 0, 0, 0.15),
            0 0 0 1px rgba(0, 0, 0, 0.05);
    }

    .client-image {
        width: 100%;
        height: 100%;
        object-fit: cover;
        object-position: center;
        display: block;
    }

    .image-overlay {
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: linear-gradient(180deg,
                rgba(0, 0, 0, 0) 0%,
                rgba(0, 0, 0, 0.1) 100%);
        pointer-events: none;
    }

    /* Carousel Fade Effect */
    .carousel-fade .carousel-item {
        opacity: 0;
        transition: opacity 0.8s ease-in-out;
    }

    .carousel-fade .carousel-item.active {
        opacity: 1;
    }

    /* Custom Navigation Controls */
    .custom-carousel-control {
        width: 56px;
        height: 56px;
        background: #fff;
        border-radius: 50%;
        box-shadow: 0 8px 24px rgba(0, 0, 0, 0.15);
        opacity: 1;
        transition: all 0.3s ease;
        top: 50%;
        transform: translateY(-50%);
    }

    .custom-carousel-control:hover {
        background: #ee212e;
        box-shadow: 0 12px 32px rgba(62, 105, 173, 0.3);
    }

    .custom-carousel-control:hover .custom-carousel-icon svg {
        stroke: #fff;
    }

    .carousel-control-prev {
        left: -28px;
    }

    .carousel-control-next {
        right: -28px;
    }

    .custom-carousel-icon {
        display: flex;
        align-items: center;
        justify-content: center;
        width: 100%;
        height: 100%;
    }

    .custom-carousel-icon svg {
        stroke: #ee212e;
        transition: stroke 0.3s ease;
    }

    /* Custom Indicators */
    .custom-indicators {
        bottom: -50px;
        margin-bottom: 0;
    }

    .custom-indicators button {
        width: 12px;
        height: 12px;
        border-radius: 50%;
        background-color: #d0d0d0;
        border: none;
        opacity: 1;
        margin: 0 6px;
        transition: all 0.3s ease;
    }

    .custom-indicators button.active {
        width: 32px;
        border-radius: 6px;
        background-color: #ee212e;
    }

    .custom-indicators button:hover {
        background-color: #ee212e;
    }

    /* Responsive Design */
    @media (max-width: 1200px) {
        .carousel-control-prev {
            left: 10px;
        }

        .carousel-control-next {
            right: 10px;
        }
    }

    @media (max-width: 991px) {
        .clients-carousel-section {
            padding: 80px 0;
        }

        .carousel-title {
            font-size: 40px;
        }

        .carousel-image-wrapper {
            height: 500px;
        }
    }

    @media (max-width: 768px) {
        .clients-carousel-section {
            padding: 60px 0;
        }

        .carousel-header {
            margin-bottom: 40px;
        }

        .carousel-title {
            font-size: 32px;
        }

        .carousel-description {
            font-size: 16px;
        }

        .carousel-image-wrapper {
            height: 400px;
            border-radius: 16px;
        }

        .custom-carousel-control {
            width: 44px;
            height: 44px;
        }

        .custom-carousel-icon svg {
            width: 20px;
            height: 20px;
        }
    }

    @media (max-width: 576px) {
        .carousel-title {
            font-size: 28px;
        }

        .carousel-label {
            font-size: 14px;
        }

        .carousel-image-wrapper {
            height: 350px;
        }

        .custom-carousel-control {
            width: 40px;
            height: 40px;
        }

        .carousel-control-prev {
            left: 5px;
        }

        .carousel-control-next {
            right: 5px;
        }

        .custom-indicators {
            bottom: -40px;
        }

        .custom-indicators button {
            width: 8px;
            height: 8px;
            margin: 0 4px;
        }

        .custom-indicators button.active {
            width: 24px;
        }
    }

    @media (max-width: 400px) {
        .carousel-image-wrapper {
            height: 280px;
        }
    }
</style>