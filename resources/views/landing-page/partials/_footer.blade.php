<footer class="simple-footer py-5 mt-5">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-md-4 text-start mb-4">
                <img src="{{ asset('public/landing-page/assets/img/footer_logo.png') }}" 
                     alt="Nemo Logo" 
                     class="footer-logo">
            </div>
            <div class="col-md-4 text-start mb-4">
                <h5 class="footer-title">Contact Us</h5>
                <div class="contact-info">
                    <p class="contact-email">Email: <a href="mailto:Hassannemo.hn@gmail.com">Hassannemo.hn@gmail.com</a></p>
                    <div class="contact-phones">
                        <a href="https://wa.me/201092958475" class="contact-link whatsapp" target="_blank"><i class="bi bi-whatsapp"></i> 01092958475</a>
                        <a href="https://wa.me/201208686821" class="contact-link whatsapp" target="_blank"><i class="bi bi-whatsapp"></i> 01208686821</a>
                        <a href="https://wa.me/201020515054" class="contact-link whatsapp" target="_blank"><i class="bi bi-whatsapp"></i> 01020515054</a>
                    </div>
                </div>
            </div>
            <div class="col-md-4 text-center mb-4">
                <h5 class="footer-title">Follow Us</h5>
                <div class="social-links">
                    <a href="https://www.facebook.com/share/1EqWcGtraw/" class="social-link" target="_blank"><i class="bi bi-facebook"></i></a>
                    <a href="https://www.instagram.com/hassannemo1102?igsh=b3Iyc3F4MXRwMXd3" class="social-link" target="_blank"><i class="bi bi-instagram"></i></a>
                </div>
            </div>
        </div>
        <div class="row mt-4">
            <div class="col-12 text-center">
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

    .footer-title {
        font-size: 18px;
        font-weight: 600;
        color: #181E4B;
        margin-bottom: 1rem;
    }

    .footer-logo {
        height: 100px;
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

    .contact-info {
        margin-bottom: 1rem;
    }

    .contact-email {
        margin-bottom: 0.5rem;
        font-size: 14px;
        color: #666;
    }

    .contact-email a {
        color: #3E69AD;
        text-decoration: none;
    }

    .contact-email a:hover {
        text-decoration: underline;
    }

    .contact-phones {
        display: flex;
        justify-content: start;
        gap: 8px;
        flex-wrap: wrap;
    }

    .contact-link {
        display: inline-flex;
        align-items: center;
        gap: 4px;
        padding: 4px 8px;
        border-radius: 12px;
        text-decoration: none;
        font-size: 11px;
        transition: all 0.3s ease;
    }

    .contact-link.whatsapp {
        background-color: #25D366;
        color: white;
    }

    .contact-link.whatsapp:hover {
        background-color: #1da851;
        color: white;
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
        
        .contact-phones {
            flex-direction: row;
            justify-content: center;
        }
    }
</style>