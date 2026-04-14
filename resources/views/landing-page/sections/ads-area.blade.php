{{-- ===========================
    ADS AREA SECTION
============================ --}}
<section id="ads-area" class="ads-area-section">
    <div class="container h-100">
        <div class="row h-100 align-items-center">
            <div class="col-4">
                <h3 class="ads-title">ADs Area</h3>
            </div>
            <div class="col-4 text-center">
                <img 
                    src="{{ asset('public/assets/admin-module/img/logo.jpeg') }}" 
                    alt="NEMO Logo" 
                    class="nemo-logo"
                >
            </div>
            <div class="col-4"></div>
        </div>
    </div>
</section>

<style>
    .ads-area-section {
        background-color: #F7F7F7;
        height: 200px;
    }

    .ads-area-section .container, .ads-area-section .row {
        height: 100%;
    }

    .ads-title {
        font-family: 'Volkhov', serif;
        font-size: 2.5rem;
        font-weight: 700;
        color: #0B3D91;
        margin: 0;
    }

    .nemo-logo {
        height: 80px;
        width: auto;
    }

    /* Responsive */
    @media (max-width: 768px) {
        .ads-area-section {
            height: 150px;
        }

        .ads-title {
            font-size: 1.5rem;
        }

        .nemo-logo {
            height: 60px;
        }
    }
</style>
