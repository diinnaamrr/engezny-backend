{{-- ===========================
    HOW IT WORKS SECTION
============================ --}}
<section id="how-it-works" class="how-it-works-section py-5 my-5">
    <div class="container">
        <div class="text-center mb-5">
            <p class="section-subtitle-small">Fast & Easy</p>
            <h2 class="section-title-large mt-4">Get Your Favourite<br>Resort Bookings</h2>
        </div>

        <div class="row g-4 justify-content-center">
            {{-- Step 1 --}}
            <div class="col-lg-4 col-md-6">
                <div class="step-card" data-step="1">
                    <div class="step-icon-wrapper">
                        <div class="step-icon">
                            <i class="bi bi-geo-alt"></i>
                        </div>
                        <div class="step-number">01</div>
                    </div>
                    <div class="step-content">
                        <h4 class="step-title">Choose Destination</h4>
                        <p class="step-description">Select your dream destination from our curated list of amazing locations</p>
                    </div>
                    <div class="step-decoration step-decoration-1"></div>
                </div>
            </div>

            {{-- Step 2 --}}
            <div class="col-lg-4 col-md-6">
                <div class="step-card" data-step="2">
                    <div class="step-icon-wrapper">
                        <div class="step-icon">
                            <i class="bi bi-calendar-check"></i>
                        </div>
                        <div class="step-number">02</div>
                    </div>
                    <div class="step-content">
                        <h4 class="step-title">Check Availability</h4>
                        <p class="step-description">Verify dates and availability for your preferred resort and dates</p>
                    </div>
                    <div class="step-decoration step-decoration-2"></div>
                </div>
            </div>

            {{-- Step 3 --}}
            <div class="col-lg-4 col-md-6">
                <div class="step-card" data-step="3">
                    <div class="step-icon-wrapper">
                        <div class="step-icon">
                            <i class="bi bi-airplane"></i>
                        </div>
                        <div class="step-number">03</div>
                    </div>
                    <div class="step-content">
                        <h4 class="step-title">Let's Go</h4>
                        <p class="step-description">Book your perfect getaway and start your amazing adventure</p>
                    </div>
                    <div class="step-decoration step-decoration-3"></div>
                </div>
            </div>
        </div>
    </div>

    {{-- Background Elements --}}
    <div class="bg-shape bg-shape-1"></div>
    <div class="bg-shape bg-shape-2"></div>
</section>

<style>
    .how-it-works-section {
        background: linear-gradient(135deg, #f8f9fa 0%, #ffffff 100%);
        position: relative;
        overflow: hidden;
    }

    .section-subtitle-small {
        font-size: 18px;
        color: #ee212e;
        font-weight: 600;
        margin-bottom: 0.5rem;
    }

    .section-title-large {
        font-family: 'Volkhov', serif;
        font-size: 50px;
        color: #181E4B;
        font-weight: 700;
        line-height: 1.2;
    }

    .step-card {
        background: #fff;
        border-radius: 24px;
        padding: 40px 30px;
        text-align: center;
        position: relative;
        box-shadow: 0 10px 40px rgba(0, 0, 0, 0.08);
        transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        overflow: hidden;
        height: 100%;
    }

    .step-card:hover {
        transform: translateY(-10px);
        box-shadow: 0 20px 60px rgba(0, 0, 0, 0.15);
    }

    .step-icon-wrapper {
        position: relative;
        margin-bottom: 30px;
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .step-icon {
        width: 80px;
        height: 80px;
        background: linear-gradient(135deg, #ee212e, #08aaf4);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-size: 32px;
        position: relative;
        z-index: 2;
        transition: all 0.4s ease;
    }

    .step-card:hover .step-icon {
        transform: scale(1.1);
        box-shadow: 0 10px 30px rgba(62, 105, 173, 0.3);
    }

    .step-number {
        position: absolute;
        top: -10px;
        right: -10px;
        width: 30px;
        height: 30px;
        background: #FFB700;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 14px;
        font-weight: 700;
        color: white;
        z-index: 3;
        animation: pulse 2s infinite;
    }

    .step-content {
        position: relative;
        z-index: 2;
    }

    .step-title {
        font-size: 20px;
        font-weight: 700;
        color: #181E4B;
        margin-bottom: 15px;
    }

    .step-description {
        font-size: 16px;
        color: #5E6282;
        line-height: 1.6;
        margin: 0;
    }

    .step-decoration {
        position: absolute;
        border-radius: 50%;
        opacity: 0.1;
        transition: all 0.4s ease;
    }

    .step-decoration-1 {
        width: 120px;
        height: 120px;
        background: linear-gradient(135deg, #ee212e, #08aaf4);
        top: -20px;
        right: -20px;
    }

    .step-decoration-2 {
        width: 100px;
        height: 100px;
        background: linear-gradient(135deg, #FFB700, #FF8C00);
        bottom: -15px;
        left: -15px;
    }

    .step-decoration-3 {
        width: 140px;
        height: 140px;
        background: linear-gradient(135deg, #00D4AA, #00B894);
        top: -25px;
        left: -25px;
    }

    .step-card:hover .step-decoration {
        opacity: 0.2;
        transform: scale(1.2);
    }

    /* Background Shapes */
    .bg-shape {
        position: absolute;
        border-radius: 50%;
        z-index: 0;
    }

    .bg-shape-1 {
        width: 200px;
        height: 200px;
        background: linear-gradient(135deg, rgba(62, 105, 173, 0.05), rgba(24, 30, 75, 0.05));
        top: 10%;
        left: -5%;
        animation: float 8s ease-in-out infinite;
    }

    .bg-shape-2 {
        width: 150px;
        height: 150px;
        background: linear-gradient(135deg, rgba(255, 183, 0, 0.05), rgba(255, 140, 0, 0.05));
        bottom: 15%;
        right: -3%;
        animation: float 6s ease-in-out infinite reverse;
    }

    /* Animations */
    @keyframes pulse {
        0%, 100% {
            transform: scale(1);
        }
        50% {
            transform: scale(1.1);
        }
    }

    @keyframes float {
        0%, 100% {
            transform: translateY(0);
        }
        50% {
            transform: translateY(-20px);
        }
    }

    /* Responsive */
    @media (max-width: 768px) {
        .section-title-large {
            font-size: 36px;
        }
        
        .step-card {
            padding: 30px 20px;
            margin-bottom: 30px;
        }
        
        .step-icon {
            width: 60px;
            height: 60px;
            font-size: 24px;
        }
    }

    @media (max-width: 576px) {
        .section-title-large {
            font-size: 28px;
        }
        
        .step-title {
            font-size: 18px;
        }
        
        .step-description {
            font-size: 14px;
        }
    }
</style>