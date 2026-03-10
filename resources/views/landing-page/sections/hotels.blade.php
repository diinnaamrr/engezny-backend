<section id="hotels" class="hotels-section py-5">
    <div class="container mt-5">
        <div class="text-center mb-5">
            <p class="section-subtitle-small">Hotels</p>
            <h2 class="section-title-large mt-4">Discover Best Hotels</h2>
        </div>

        @if(isset($hotels) && $hotels->count() > 0)
            <div class="row g-4 px-1">
                @foreach($hotels as $hotel)
                    <div class="col-lg-4 col-md-6">
                        <div class="hotel-card-new">
                            <div class="hotel-image-wrapper">
                                <img 
                                    src="{{ $hotel->image ? asset('storage/'.$hotel->image) : asset('public/landing-page/assets/img/placeholder.jpg') }}" 
                                    alt="{{ $hotel->name }}"
                                    class="hotel-image"
                                >
                            </div>
                            <div class="hotel-content">
                                <h4 class="hotel-name">{{ $hotel->name }}</h4>
                                <p class="hotel-description">
                                    {{ Str::limit($hotel->description, 120) }}
                                </p>
                                <div class="hotel-footer">
                                    <div class="hotel-price-info">
                                        <span class="price-label">{{ translate('Price') }}</span>
                                        <span class="price-value">{{ getCurrencyFormat($hotel->price) }}</span>
                                    </div>
                                    <a href="https://wa.me/{{ $business_phone ?? '123456789' }}?text={{ urlencode('I am interested in booking: ' . $hotel->name) }}" 
                                       target="_blank" class="btn-whatsapp-rounded">
                                        <i class="bi bi-whatsapp"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div class="text-center py-5">
                <p class="text-muted">{{ translate('No hotels available at the moment.') }}</p>
            </div>
        @endif
    </div>
</section>

<style>
    .hotels-section {
        background-color: #fff;
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
    }

    .hotel-card-new {
        background: #fff;
        border-radius: 20px;
        padding: 15px;
        box-shadow: 0px 100px 80px rgba(0, 0, 0, 0.02), 0px 64.8148px 46.8519px rgba(0, 0, 0, 0.0151852), 0px 38.5185px 25.4815px rgba(0, 0, 0, 0.0121481), 0px 20px 13px rgba(0, 0, 0, 0.01), 0px 8.14815px 6.51852px rgba(0, 0, 0, 0.00785185), 0px 1.85185px 3.14815px rgba(0, 0, 0, 0.00481481);
        transition: transform 0.3s ease;
        height: 100%;
        display: flex;
        flex-direction: column;
    }

    .hotel-card-new:hover {
        transform: translateY(-10px);
    }

    .hotel-image-wrapper {
        width: 100%;
        height: 220px;
        overflow: hidden;
        border-radius: 20px;
        margin-bottom: 15px;
    }

    .hotel-image {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .hotel-content {
        padding: 0 5px 10px 5px;
        flex-grow: 1;
        display: flex;
        flex-direction: column;
    }

    .hotel-name {
        font-size: 20px;
        font-weight: 700;
        margin-bottom: 10px;
        color: #181E4B;
    }

    .hotel-description {
        font-size: 15px;
        color: #5E6282;
        margin-bottom: 20px;
        line-height: 1.6;
    }

    .hotel-footer {
        margin-top: auto;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .hotel-price-info {
        display: flex;
        flex-direction: column;
    }

    .price-label {
        font-size: 12px;
        color: #5E6282;
        text-transform: uppercase;
        letter-spacing: 1px;
    }

    .price-value {
        font-size: 18px;
        font-weight: 700;
        color: #ee212e;
    }

    .btn-whatsapp-rounded {
        display: flex;
        align-items: center;
        justify-content: center;
        width: 45px;
        height: 45px;
        background-color: #25d366;
        color: #fff;
        border-radius: 50%;
        font-size: 20px;
        text-decoration: none;
        transition: all 0.3s ease;
        box-shadow: 0px 10px 20px rgba(37, 211, 102, 0.2);
    }

    .btn-whatsapp-rounded:hover {
        background-color: #128c7e;
        color: #fff;
        transform: scale(1.1);
        box-shadow: 0px 15px 25px rgba(37, 211, 102, 0.3);
    }

    @media (max-width: 768px) {
        .section-title-large {
            font-size: 35px;
        }
        
        .hotel-card-new {
            margin-bottom: 20px;
        }
    }
</style>
