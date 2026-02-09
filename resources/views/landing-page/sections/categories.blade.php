{{-- ===========================
    CATEGORIES SECTION
============================ --}}
<section id="categories" class="categories-section py-5">
    <div class="container">
        <div class="text-center mb-5">
            <p class="section-subtitle-small">Explore</p>
            <h2 class="section-title-large mt-4">Tour Categories</h2>
        </div>

        <div class="row g-4">
            @php
                $categories = \App\Models\Category::whereNull('parent_id')->with('children')->get();
            @endphp
            
            @foreach($categories as $category)
                <div class="col-lg-4 col-md-6">
                    <div class="category-card">
                        <div class="category-image-wrapper">
                            @if($category->image)
                                <img src="{{ asset('storage/'.$category->image) }}" alt="{{ $category->name }}" class="category-image">
                            @else
                                <div class="category-icon-fallback">
                                    <i class="bi bi-compass"></i>
                                </div>
                            @endif
                        </div>
                        <div class="category-content">
                            <h4 class="category-name">{{ $category->name }}</h4>
                            <p class="category-description">{{ $category->description ?? 'Discover amazing tours in this category' }}</p>
                            <div class="category-meta">
                                @php
                                    $tourCount = \App\Models\Tour::where('category_id', $category->id)->count();
                                    $childrenCount = $category->children->count();
                                @endphp
                                <span class="tour-count">{{ $tourCount }} Tours</span>
                                @if($childrenCount > 0)
                                    <span class="subcategory-count">{{ $childrenCount }} Subcategories</span>
                                @endif
                            </div>
                            <a href="{{ route('category.tours', $category->id) }}" class="category-link">
                                Explore <i class="bi bi-arrow-right"></i>
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>

<style>
    .categories-section {
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

    .category-card {
        background: #fff;
        border-radius: 20px;
        overflow: hidden;
        box-shadow: 0 8px 30px rgba(0, 0, 0, 0.08);
        transition: all 0.4s ease;
        height: 100%;
        display: flex;
        flex-direction: column;
    }

    .category-card:hover {
        transform: translateY(-8px);
        box-shadow: 0 20px 50px rgba(0, 0, 0, 0.15);
    }

    .category-image-wrapper {
        width: 100%;
        height: 200px;
        overflow: hidden;
        position: relative;
    }

    .category-image {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.4s ease;
    }

    .category-card:hover .category-image {
        transform: scale(1.05);
    }

    .category-icon-fallback {
        width: 100%;
        height: 100%;
        background: linear-gradient(135deg, #ee212e, #08aaf4);
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-size: 48px;
    }

    .category-content {
        padding: 30px;
        flex-grow: 1;
        display: flex;
        flex-direction: column;
        text-align: center;
    }

    .category-name {
        font-size: 24px;
        font-weight: 700;
        color: #181E4B;
        margin-bottom: 15px;
    }

    .category-description {
        font-size: 16px;
        color: #5E6282;
        line-height: 1.6;
        margin-bottom: 20px;
    }

    .category-meta {
        display: flex;
        justify-content: center;
        gap: 15px;
        margin-bottom: 25px;
        flex-wrap: wrap;
    }

    .tour-count, .subcategory-count {
        background: rgba(62, 105, 173, 0.1);
        color: #ee212e;
        padding: 5px 15px;
        border-radius: 20px;
        font-size: 14px;
        font-weight: 600;
    }

    .category-link {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        background: #ee212e;
        color: white;
        padding: 12px 25px;
        border-radius: 25px;
        text-decoration: none;
        font-weight: 600;
        transition: all 0.3s ease;
    }

    .category-link:hover {
        background: #08aaf4;
        color: white;
        transform: translateX(5px);
    }

    @media (max-width: 768px) {
        .section-title-large {
            font-size: 36px;
        }
        
        .category-card {
            padding: 20px;
        }
        
        .category-name {
            font-size: 20px;
        }
    }
</style>