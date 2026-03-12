<section id="hotels" class="hotels-section py-5">
    <div class="container mt-5">
        <div class="text-center mb-5">
            <p class="section-subtitle-small">Hotels</p>
            <h2 class="section-title-large mt-4">Discover Best Hotels</h2>
        </div>

        @if(isset($hotels) && $hotels->count() > 0)
            <div class="row g-4 px-1">
                @foreach($hotels as $hotel)
                    <div class="col-lg-3 col-md-6">
                        <div class="hotel-card-new">
                            <div class="hotel-image-wrapper">
                                <img 
                                    src="{{ $hotel->image ? asset('storage/app/public/'.$hotel->image) : asset('public/landing-page/assets/img/placeholder.jpg') }}" 
                                    alt="{{ $hotel->name }}"
                                    class="hotel-image"
                                >
                            </div>
                            <div class="hotel-content">
                                <h4 class="hotel-name">{{ $hotel->name }}</h4>
                                <p class="hotel-description">
                                    {{ Str::limit($hotel->description, 70) }}
                                </p>
                                <div class="hotel-footer">
                                    <div class="hotel-price-info">
                                        <span class="price-value">{{ getCurrencyFormat($hotel->price) }}</span>
                                    </div>
                                    <a href="https://wa.me/{{ $business_phone ?? '123456789' }}?text={{ urlencode('I am interested in booking: ' . $hotel->name) }}" 
                                       target="_blank" class="whatsapp-details-link">
                                        <span class="whatsapp-icon-wrapper">
                                            <i class="bi bi-whatsapp"></i>
                                        </span>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="text-center mt-5">
                <a href="{{ route('hotels.list') }}" class="btn-see-all">
                    See All
                </a>
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
        height: 200px;
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
        font-size: 18px;
        font-weight: 600;
        margin-bottom: 10px;
        color: #5E6282;
    }

    .hotel-description {
        font-size: 14px;
        color: #5E6282;
        margin-bottom: 15px;
        line-height: 1.5;
        flex-grow: 1;
    }

    .hotel-footer {
        margin-top: auto;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .price-value {
        font-size: 16px;
        font-weight: 600;
        color: #5E6282;
    }

    .whatsapp-icon-wrapper {
        display: flex;
        align-items: center;
        justify-content: center;
        width: 35px;
        height: 35px;
        background-color: #F5F5F5;
        border-radius: 50%;
        color: #181E4B;
        transition: all 0.3s ease;
    }

    .whatsapp-icon-wrapper:hover {
        background-color: #25d366;
        color: #fff;
    }

    .whatsapp-icon-wrapper i {
        font-size: 18px;
    }

    .btn-see-all {
        display: inline-block;
        background-color: #ee212e;
        color: #fff;
        padding: 12px 35px;
        border-radius: 10px;
        font-weight: 600;
        text-decoration: none;
        transition: all 0.3s ease;
        box-shadow: 0px 20px 35px rgba(62, 105, 173, 0.15);
    }

    .btn-see-all:hover {
        background-color: #08aaf4;
        color: #fff;
        transform: translateY(-3px);
        box-shadow: 0px 25px 45px rgba(62, 105, 173, 0.25);
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
