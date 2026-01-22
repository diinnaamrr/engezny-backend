{{-- ===========================
    HERO SECTION
============================ --}}
<section id="hero" class="hero-section">
    <div class="hero-overlay"></div>
    <div class="hero-content">
        <div class="container">
            <div class="row justify-content-start">
                <div class="col-lg-8">
                    {{-- Zigzag Decoration --}}
                    <img
                        src="{{ asset('public/landing-page/assets/img/zigzag.svg') }}"
                        alt="Decoration"
                        class="zigzag-decoration mb-3">

                    <h1 class="hero-title">
                        With <span class="nemo-brand">NEMO</span> enjoy every moment in your trip!
                    </h1>

                    {{-- Search Bar --}}
                    <div class="search-container mt-5">
                        <div class="search-wrapper px-3 py-2">
                            <input
                                type="text"
                                class="search-input"
                                placeholder="Where to?">
                            <button class="search-btn">
                                Search
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Scroll Indicator --}}
    <div class="scroll-indicator">
        <img
            src="{{ asset('public/landing-page/assets/img/Scroll.svg') }}"
            alt="Scroll Down"
            class="scroll-svg"
        />
    </div>
</section>

<style>
    /* Hero Section Styles */
    .hero-section {
        position: relative;
        height: 100vh;
        background-image: url('{{ asset('public/landing-page/assets/img/hero_bg2.jpg') }}');
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
        font-size: 60px;
        padding-right: 15rem;
    }

    .nemo-brand {
        color: #3E69AD;
    }

    .zigzag-decoration {
        width: 80px;
        height: auto;
        opacity: 0.9;
    }

    /* Scroll Indicator */
    .scroll-indicator {
        position: absolute;
        bottom: 0;
        left: 0;
        width: 250px;
        height: 125px;
        overflow: hidden;
        z-index: 3;
    }

    .scroll-svg {
        width: 100%;
        height: auto;
        position: absolute;
        bottom: 0;
        left: 0;
        top: 15%;
        animation: scrollBounce 2s ease-in-out infinite;
    }

    @keyframes scrollBounce {

        0%,
        100% {
            transform: translateY(0);
        }

        50% {
            transform: translateY(-5px);
        }
    }

    /* Search Container */
    .search-container {
        max-width: 600px;
    }

    .search-wrapper {
        background: #F3F3F399;
        backdrop-filter: blur(10px);
        border-radius: 5px;
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
        border-radius: 5px;
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

    /* Responsive */
    @media (max-width: 768px) {
        .hero-title {
            font-size: 40px;
            padding-right: 5rem;
        }

        .search-wrapper {
            flex-direction: column;
            border-radius: 10px;
        }

        .search-btn {
            width: 100%;
            border-radius: 20px;
        }

        .scroll-indicator {
            width: 120px;
            height: 60px;
        }
    }
</style>