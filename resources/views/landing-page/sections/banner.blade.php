{{-- ===========================
    BANNER SECTION
============================ --}}
<section id="banner" class="banner-section">
    <div class="banner-content">
        <h2 class="banner-text">Let's make your<br>next holiday amazing</h2>
    </div>
</section>

<style>
    .banner-section {
        width: 100%;
        height: 600px;
        background-image: url('{{ asset("public/landing-page/assets/img/banner_img1.jpg") }}');
        background-size: cover;
        background-position: center;
        background-repeat: no-repeat;
        display: flex;
        align-items: center;
        position: relative;
    }

    .banner-section::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: rgba(0, 0, 0, 0.4);
    }

    .banner-content {
        position: relative;
        z-index: 2;
        width: 100%;
        display: flex;
        justify-content: flex-start;
        padding-left: 10%;
    }

    .banner-text {
        font-size: 50px;
        color: white;
        font-weight: 700;
        line-height: 1.2;
        margin: 0;
    }

    @media (max-width: 768px) {
        .banner-section {
            height: 300px;
        }
        
        .banner-text {
            font-size: 36px;
        }
        
        .banner-content {
            padding-left: 5%;
        }
    }

    @media (max-width: 576px) {
        .banner-text {
            font-size: 28px;
        }
    }
</style>