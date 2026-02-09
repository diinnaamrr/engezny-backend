{{-- ===========================
    SAFARI SPECIALS SECTION
============================ --}}
<section id="safari-specials" class="safari-section">
    <div class="container">
        <div class="row g-5 align-items-center">
            {{-- Left Column - Enhanced Image --}}
            <div class="col-lg-6 order-2 order-lg-1">
                <div class="safari-visual-container">
                    {{-- Main Image Card --}}
                    <div class="safari-main-card">
                        <img src="{{ asset('public/landing-page/assets/img/safari_img.jpeg') }}"
                            alt="Safari Adventure"
                            class="safari-main-image">
                    </div>


                    {{-- Decorative Elements --}}
                    <div class="safari-decor-circle safari-decor-1"></div>
                    <div class="safari-decor-circle safari-decor-2"></div>
                </div>
            </div>

            {{-- Right Column - Content --}}
            <div class="col-lg-6 order-1 order-lg-2">
                <div class="safari-content">
                    <div class="safari-label">
                        <span class="label-icon">✨</span>
                        Safari Specials
                    </div>
                    <h2 class="safari-title">
                        Discover Our Safari
                        <span class="title-highlight">Tropical Destinations</span>
                    </h2>
                    <p class="safari-description">
                        Embark on an unforgettable journey through breathtaking landscapes and encounter magnificent wildlife in their natural habitat. Our carefully curated safari experiences offer you the chance to witness nature's most spectacular moments.
                    </p>


                </div>
            </div>
        </div>
    </div>

    {{-- Background Decoration --}}
    <div class="safari-bg-pattern"></div>
</section>

<style>
    /* Safari Section Base */
    .safari-section {
        position: relative;
        padding: 100px 0;
        background: linear-gradient(135deg, #f8f9fa 0%, #ffffff 100%);
        overflow: hidden;
    }

    /* Background Pattern */
    .safari-bg-pattern {
        position: absolute;
        top: 0;
        right: 0;
        width: 50%;
        height: 100%;
        background-image:
            radial-gradient(circle at 20% 50%, rgba(62, 105, 173, 0.03) 0%, transparent 50%),
            radial-gradient(circle at 80% 80%, rgba(24, 30, 75, 0.03) 0%, transparent 50%);
        pointer-events: none;
        z-index: 0;
    }

    .safari-section .container {
        position: relative;
        z-index: 1;
    }

    /* Visual Container */
    .safari-visual-container {
        position: relative;
        padding: 20px;
    }

    /* Main Image Card */
    .safari-main-card {
        position: relative;
        border-radius: 24px;
        overflow: hidden;
        box-shadow:
            0 20px 60px rgba(0, 0, 0, 0.1),
            0 0 0 1px rgba(0, 0, 0, 0.05);
        transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        background: #fff;
    }

    .safari-main-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: linear-gradient(135deg, rgba(62, 105, 173, 0.1) 0%, rgba(24, 30, 75, 0.1) 100%);
        opacity: 0;
        transition: opacity 0.4s ease;
        z-index: 2;
    }

    .safari-main-card:hover {
        transform: translateY(-8px);
        box-shadow:
            0 30px 80px rgba(0, 0, 0, 0.15),
            0 0 0 1px rgba(0, 0, 0, 0.05);
    }

    .safari-main-card:hover::before {
        opacity: 1;
    }

    .safari-main-image {
        width: 100%;
        height: 500px;
        object-fit: cover;
        object-position: center;
        display: block;
        transition: transform 0.6s cubic-bezier(0.4, 0, 0.2, 1);
    }

    .safari-main-card:hover .safari-main-image {
        transform: scale(1.05);
    }



    /* Decorative Circles */
    .safari-decor-circle {
        position: absolute;
        border-radius: 50%;
        z-index: 0;
    }

    .safari-decor-1 {
        width: 120px;
        height: 120px;
        background: linear-gradient(135deg, rgba(62, 105, 173, 0.1), rgba(24, 30, 75, 0.1));
        top: -30px;
        right: -30px;
        animation: float 6s ease-in-out infinite;
    }

    .safari-decor-2 {
        width: 80px;
        height: 80px;
        background: linear-gradient(135deg, rgba(255, 183, 77, 0.1), rgba(255, 152, 0, 0.1));
        bottom: 40px;
        left: -20px;
        animation: float 8s ease-in-out infinite reverse;
    }

    /* Content Styles */
    .safari-content {
        padding: 0 20px;
    }

    .safari-label {
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

    .safari-title {
        font-size: 48px;
        color: #181E4B;
        font-weight: 700;
        line-height: 1.2;
        margin-bottom: 24px;
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

    .safari-description {
        font-size: 17px;
        color: #5E6282;
        line-height: 1.8;
        margin-bottom: 32px;
    }



    /* Animations */
    @keyframes fadeInDown {
        from {
            opacity: 0;
            transform: translateY(-20px);
        }

        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    @keyframes fadeInUp {
        from {
            opacity: 0;
            transform: translateY(20px);
        }

        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    @keyframes float {

        0%,
        100% {
            transform: translateY(0);
        }

        50% {
            transform: translateY(-20px);
        }
    }

    /* Responsive Design */
    @media (max-width: 991px) {
        .safari-section {
            padding: 60px 0;
        }

        .safari-content {
            text-align: center;
            margin-bottom: 40px;
        }


    }

    @media (max-width: 768px) {
        .safari-title {
            font-size: 36px;
        }

        .safari-main-image {
            height: 400px;
        }


    }

    @media (max-width: 576px) {
        .safari-title {
            font-size: 28px;
        }

        .safari-label {
            font-size: 14px;
        }

        .safari-description {
            font-size: 15px;
        }

        .safari-main-image {
            height: 300px;
        }


    }
</style>