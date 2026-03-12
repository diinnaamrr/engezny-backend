{{-- ===========================
    FEATURED TOURS SECTION
============================ --}}
<section id="featured-tours" class="featured-tours-section py-5">
    <div class="container mt-5">
        <div class="text-center mb-5">
            <p class="section-subtitle-small">Trips</p>
            <h2 class="section-title-large mt-4">Our Trips</h2>
        </div>

        @if($featuredTours->count() > 0)
            <div class="row g-4 px-1">
                @foreach($featuredTours as $tour)
                    <div class="col-lg-3 col-md-6">
                        <div class="tour-card-new">
                            <div class="tour-image-wrapper">
                                <img 
                                    src="{{ $tour->image ? asset('storage/app/public/'.$tour->image) : asset('public/landing-page/assets/img/placeholder.jpg') }}" 
                                    alt="{{ $tour->name }}"
                                    class="tour-image"
                                >
                            </div>
                            <div class="tour-content">
                                <h4 class="tour-name">{{ $tour->name }}</h4>
                                <div class="tour-info">
                                    <span class="tour-date">
                                        {{ $tour->departure_date ? $tour->departure_date->format('d') : '14' }}-{{ $tour->return_date ? $tour->return_date->format('d M') : '29 June' }}
                                    </span>
                                    <span class="separator">|</span>
                                    <span class="tour-price">${{ number_format($tour->price, 2) }}</span>
                                </div>
                                <div class="tour-footer">
                                    <a href="{{ route('tour.details', $tour->id) }}" class="details-link">
                                        <span class="details-icon-wrapper">
                                            <i class="bi bi-arrow-right-short"></i>
                                        </span>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="text-center mt-5">
                <a href="{{ route('tours') }}" class="btn-see-all">
                    See All
                </a>
            </div>
        @else
            <div class="text-center py-5">
                <p class="text-muted">No featured tours available at the moment.</p>
            </div>
        @endif
    </div>
</section>

<style>
    .featured-tours-section {
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

    .tour-card-new {
        background: #fff;
        border-radius: 20px;
        padding: 15px;
        box-shadow: 0px 100px 80px rgba(0, 0, 0, 0.02), 0px 64.8148px 46.8519px rgba(0, 0, 0, 0.0151852), 0px 38.5185px 25.4815px rgba(0, 0, 0, 0.0121481), 0px 20px 13px rgba(0, 0, 0, 0.01), 0px 8.14815px 6.51852px rgba(0, 0, 0, 0.00785185), 0px 1.85185px 3.14815px rgba(0, 0, 0, 0.00481481);
        transition: transform 0.3s ease;
        height: 100%;
        display: flex;
        flex-direction: column;
    }

    .tour-card-new:hover {
        transform: translateY(-10px);
    }

    .tour-image-wrapper {
        width: 100%;
        height: 200px;
        overflow: hidden;
        border-radius: 20px;
        margin-bottom: 15px;
    }

    .tour-image {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .tour-content {
        padding: 0 5px 10px 5px;
        flex-grow: 1;
        display: flex;
        flex-direction: column;
    }

    .tour-name {
        font-size: 18px;
        font-weight: 600;
        margin-bottom: 10px;
        color: #5E6282;
    }

    .tour-info {
        font-size: 16px;
        color: #5E6282;
        margin-bottom: 15px;
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .separator {
        color: #5E6282;
        opacity: 0.5;
    }

    .tour-price {
        font-weight: 600;
    }

    .tour-footer {
        margin-top: auto;
        display: flex;
        justify-content: flex-start;
    }

    .details-icon-wrapper {
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

    .details-icon-wrapper:hover {
        background-color: #ee212e;
        color: #fff;
    }

    .details-icon-wrapper i {
        font-size: 20px;
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

    /* Responsive */
    @media (max-width: 768px) {
        .section-title-large {
            font-size: 35px;
        }
        
        .tour-card-new {
            margin-bottom: 20px;
        }
    }
</style>