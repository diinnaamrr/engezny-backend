resources/views/landing-page/about-us.blade.php
@php($primary_color = '#08aaf4')

<header id="main-header" class="sticky-top shadow-none">
    <nav class="navbar navbar-expand-lg px-3 py-3 fixed-top" id="nemo-navbar">
        <div class="container">

            {{-- Logo --}}
            <a class="navbar-brand d-flex align-items-center py-0" href="{{ route('home') }}">
                <img
                    src="{{asset('public/landing-page/assets/img/footer_logo.png')}}"
                    alt="NEMO Logo"
                    class="img-fluid rounded-3"
                    style="height: 60px; transition: height 0.3s ease; ">
            </a>

            {{-- Hamburger --}}
            <button
                class="navbar-toggler border-0 shadow-none"
                type="button"
                data-bs-toggle="collapse"
                data-bs-target="#landingNavbar"
                aria-controls="landingNavbar"
                aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            {{-- Menu --}}
            <div class="collapse navbar-collapse" id="landingNavbar">
                <ul class="navbar-nav mx-auto gap-lg-4 mt-3 mt-lg-0">
                    {{-- Nav Links --}}
                    <li class="nav-item">
                        <a class="nav-link fw-normal text-base" href="{{ route('home') }}">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link fw-normal text-base" href="{{ route('about-us') }}">About us</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link fw-normal text-base" href="{{ route('portfolio') }}">Portfolio</a>
                    </li>

                    {{-- Get in Touch Button (Mobile) --}}
                    <li class="nav-item d-lg-none">
                        <a class="btn w-100 mt-2 text-white fw-bold gear-btn-mobile" href="{{ route('contact-us') }}"
                            style="background-color: #6ed5f9;">
                            Get in Touch
                        </a>
                    </li>
                </ul>

                {{-- Get in Touch Button (Desktop) --}}
                <div class="d-none d-lg-block">
                    <a href="{{ route('contact-us') }}"
                        class="btn fw-bold px-4 py-2 gear-btn">
                        Get in Touch
                    </a>
                </div>
            </div>
        </div>
    </nav>
</header>

{{-- Navbar Scripts --}}
<script>
    const primaryColor = '{{ $primary_color }}';
    const navbar = document.getElementById('nemo-navbar');
    const navLinks = navbar.querySelectorAll('.nav-link');
    const desktopBtn = navbar.querySelector('.gear-btn');
    const mobileBtn = navbar.querySelector('.gear-btn-mobile');

    // Scroll Effect Functionality
    function handleScroll() {
        if (window.scrollY > 50) {
            navbar.classList.add('scrolled');
        } else {
            navbar.classList.remove('scrolled');
        }
    }

    window.addEventListener('scroll', handleScroll);
    document.addEventListener('DOMContentLoaded', handleScroll);

    // Smooth Scrolling
    document.addEventListener('DOMContentLoaded', () => {
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function(e) {
                const href = this.getAttribute('href');
                const target = document.querySelector(href);
                if (target) {
                    e.preventDefault();
                    let offset = 0;
                    if (href !== '#home') {
                        offset = navbar.offsetHeight + 10;
                    }
                    window.scrollTo({
                        top: target.offsetTop - offset,
                        behavior: 'smooth'
                    });

                    // Close mobile menu
                    if (window.innerWidth < 992 && navbar.classList.contains('show')) {
                        const bsCollapse = new bootstrap.Collapse(document.getElementById('landingNavbar'), {
                            toggle: false
                        });
                        bsCollapse.hide();
                    }
                }
            });
        });
    });
</script>

<style>
    /* Base Styles for Header */
    #nemo-navbar {
        background-color: white;
        transition: all 0.3s ease;
        padding-top: 0.75rem !important;
        padding-bottom: 0.75rem !important;
    }

    .navbar-toggler-icon {
        background-image: url("data:image/svg+xml,%3csvg viewBox='0 0 30 30' xmlns='http://www.w3.org/2000/svg'%3e%3cpath stroke='{{ str_replace('#', '%23', $primary_color) }}' stroke-width='2' stroke-linecap='round' stroke-miterlimit='10' d='M4 7h22M4 15h22M4 23h22'/%3e%3c/svg%3e");
        border: 1px solid {{ $primary_color }};
        border-radius: 4px;
        transition: all 0.3s ease;
    }

    .nav-link {
        color: {{ $primary_color }} !important;
        font-size: 1rem;
        position: relative;
        padding-bottom: 0.5rem !important;
        transition: color 0.3s ease;
    }

    /* Hover Effect - Thick Bottom Border */
    .nav-link::after {
        content: '';
        position: absolute;
        bottom: 0;
        left: 0;
        width: 0;
        height: 3px;
        background-color: {{ $primary_color }};
        transition: width 0.3s ease;
    }

    .nav-link:hover::after {
        width: 100%;
    }

    /* Get in Touch Button */
    .gear-btn {
        background-color: #ff7d01;
        color: white !important;
        border: 2px solid #ff7d01;
        transition: all 0.3s ease;
    }

    .gear-btn:hover {
        background-color: transparent;
        color: #ff7d01 !important;
    }

    /* Scrolled State */
    #nemo-navbar.scrolled {
        background-color: {{ $primary_color }} !important;
        box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15) !important;
    }

    #nemo-navbar.scrolled .nav-link {
        color: white !important;
    }

    #nemo-navbar.scrolled .nav-link::after {
        background-color: white;
    }

    #nemo-navbar.scrolled .navbar-toggler-icon {
        background-image: url("data:image/svg+xml,%3csvg viewBox='0 0 30 30' xmlns='http://www.w3.org/2000/svg'%3e%3cpath stroke='white' stroke-width='2' stroke-linecap='round' stroke-miterlimit='10' d='M4 7h22M4 15h22M4 23h22'/%3e%3c/svg%3e");
        border-color: white;
    }

    #nemo-navbar.scrolled .gear-btn {
        background-color: white;
        color: {{ $primary_color }} !important;
        border-color: white;
    }

    #nemo-navbar.scrolled .gear-btn:hover {
        background-color: transparent;
        color: white !important;
    }

    /* Mobile Menu */
    .navbar-collapse.show {
        background-color: white;
        padding: 15px;
        border-radius: 10px;
        margin-top: 10px;
        box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.1) !important;
    }

    #nemo-navbar.scrolled .navbar-collapse.show {
        background-color: {{ $primary_color }};
    }

    /* Text Base Size */
    .text-base {
        font-size: 1rem;
    }
</style>