@extends('landing-page.layouts.master')

@section('title', 'Book Your Tour – NEMO Tours')

@section('content')

<section class="booking-contact-section">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8 text-center">
                <div class="booking-card">
                    <div class="booking-icon">
                        <i class="bi bi-whatsapp"></i>
                    </div>
                    <h1 class="booking-title">Ready to Book Your Adventure?</h1>
                    <p class="booking-description">
                        Contact us on WhatsApp to book your tour and get instant assistance from our travel experts.
                    </p>
                    
                    <div class="contact-options">
                        <div class="whatsapp-contacts">
                            <a href="https://wa.me/201092958475" class="whatsapp-btn" target="_blank">
                                <i class="bi bi-whatsapp"></i>
                                <span>WhatsApp</span>
                                <small>01092958475</small>
                            </a>
                            
                            <a href="https://wa.me/201208686821" class="whatsapp-btn" target="_blank">
                                <i class="bi bi-whatsapp"></i>
                                <span>WhatsApp</span>
                                <small>01208686821</small>
                            </a>
                            
                            <a href="https://wa.me/201020515054" class="whatsapp-btn" target="_blank">
                                <i class="bi bi-whatsapp"></i>
                                <span>WhatsApp</span>
                                <small>01020515054</small>
                            </a>
                        </div>
                    </div>
                    
                    <div class="back-link">
                        <a href="{{ route('home') }}" class="btn-back">
                            <i class="bi bi-arrow-left"></i> Back to Home
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<style>
    .booking-contact-section {
        min-height: 100vh;
        display: flex;
        align-items: center;
        background: linear-gradient(135deg, #f8f9fa 0%, #ffffff 100%);
        padding: 100px 0;
    }

    .booking-card {
        background: white;
        border-radius: 24px;
        padding: 60px 40px;
        box-shadow: 0 20px 60px rgba(0, 0, 0, 0.1);
        max-width: 600px;
        margin: 0 auto;
    }

    .booking-icon {
        width: 100px;
        height: 100px;
        background: linear-gradient(135deg, #25D366, #1da851);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 30px;
        font-size: 48px;
        color: white;
    }

    .booking-title {
        font-size: 36px;
        font-weight: 700;
        color: #181E4B;
        margin-bottom: 20px;
    }

    .booking-description {
        font-size: 18px;
        color: #5E6282;
        line-height: 1.6;
        margin-bottom: 40px;
    }

    .whatsapp-btn {
        display: inline-flex;
        flex-direction: column;
        align-items: center;
        gap: 8px;
        background: linear-gradient(135deg, #25D366, #1da851);
        color: white;
        padding: 24px 40px;
        border-radius: 20px;
        text-decoration: none;
        font-weight: 600;
        font-size: 20px;
        transition: all 0.3s ease;
        margin-bottom: 30px;
        box-shadow: 0 8px 24px rgba(37, 211, 102, 0.3);
    }

    .whatsapp-btn:hover {
        background: linear-gradient(135deg, #1da851, #25D366);
        color: white;
        transform: translateY(-3px);
        box-shadow: 0 12px 32px rgba(37, 211, 102, 0.4);
    }

    .whatsapp-btn i {
        font-size: 32px;
    }

    .whatsapp-btn small {
        font-size: 16px;
        opacity: 0.9;
    }

    .whatsapp-contacts {
        display: flex;
        flex-direction: column;
        gap: 15px;
        margin-bottom: 30px;
    }

    .back-link {
        margin-top: 40px;
        padding-top: 30px;
        border-top: 1px solid #eee;
    }

    .btn-back {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        color: #3E69AD;
        text-decoration: none;
        font-weight: 600;
        transition: all 0.3s ease;
    }

    .btn-back:hover {
        color: #2d5089;
        transform: translateX(-3px);
    }

    @media (max-width: 768px) {
        .booking-card {
            padding: 40px 30px;
        }
        
        .booking-title {
            font-size: 28px;
        }
        
        .booking-description {
            font-size: 16px;
        }
        
        .whatsapp-btn {
            padding: 20px 30px;
            font-size: 18px;
        }
        
        .whatsapp-contacts {
            align-items: center;
        }
    }
</style>

@endsection