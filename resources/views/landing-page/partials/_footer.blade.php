<footer class="simple-footer py-4">
    <div class="container">
        <div class="row align-items-center flex-column gap-4">
            <div class="col-md-4 text-center">
                <img src="{{ asset('public/landing-page/assets/img/footer_logo.png') }}" 
                     alt="Nemo Logo" 
                     class="footer-logo">
            </div>
            <div class="col-md-4 text-center">
                <div class="social-links">
                    <a href="#" class="social-link"><i class="bi bi-facebook"></i></a>
                    <a href="#" class="social-link"><i class="bi bi-twitter"></i></a>
                    <a href="#" class="social-link"><i class="bi bi-instagram"></i></a>
                    <a href="#" class="social-link"><i class="bi bi-linkedin"></i></a>
                </div>
            </div>
            <div class="col-md-4 text-center">
                <p class="copyright-text">Copyright © Nemo2026. All Rights Reserved.</p>
            </div>
        </div>
    </div>
</footer>

<style>
    .simple-footer {
        background-color: #f8f9fa;
        border-top: 1px solid #e9ecef;
    }

    .footer-logo {
        height: 40px;
    }

    .social-links {
        display: flex;
        justify-content: center;
        gap: 15px;
    }

    .social-link {
        display: flex;
        align-items: center;
        justify-content: center;
        width: 40px;
        height: 40px;
        background-color: #3E69AD;
        color: white;
        border-radius: 50%;
        text-decoration: none;
        transition: all 0.3s ease;
    }

    .social-link:hover {
        background-color: #2d5089;
        color: white;
        transform: translateY(-2px);
    }

    .copyright-text {
        margin: 0;
        color: #666;
        font-size: 14px;
    }

    @media (max-width: 768px) {
        .simple-footer .row > div {
            text-align: center !important;
            margin-bottom: 20px;
        }
        
        .simple-footer .row > div:last-child {
            margin-bottom: 0;
        }
    }
</style>