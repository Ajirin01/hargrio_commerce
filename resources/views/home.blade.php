@extends('layouts.site')
@section('content')

{{-- ========= HERO ========= --}}
<div class="hero hero--enhanced">
    <div class="hero-bg-pattern" aria-hidden="true"></div>
    <div class="container">
        <div class="row justify-content-between align-items-center">
            <div class="col-lg-5">
                <div class="intro-excerpt">
                    <div class="hero-eyebrow animate-fade-up">UK Heritage Grain Co.</div>
                    <h1 class="animate-fade-up delay-1">Heritage Grains <span class="d-block hero-highlight">Made for Modern Living</span></h1>
                    <p class="mb-4 animate-fade-up delay-2">
                        Hargrio Limited is a UK-based food manufacturing company developing
                        nutritious, wheat-free flour blends using heritage and alternative grains.
                        Designed for traditional staple meals and modern kitchens.
                    </p>
                    <p class="animate-fade-up delay-3">
                        <a href="{{ route('shop.index') }}" class="btn btn-secondary me-2">Explore Flour Blends</a>
                        <a href="{{ route('about') }}" class="btn btn-white-outline">Our Story</a>
                    </p>
                </div>
            </div>
            <div class="col-lg-7">
                <div class="hero-img-wrap hero-img-float">
                    <img src="{{ asset('site/images/hargrio_hero.png') }}" class="img-fluid">
                </div>
            </div>
        </div>
    </div>
    <div class="hero-stats-strip">
        <div class="container">
            <div class="row g-0 justify-content-center text-center">
                <div class="col-auto px-4 py-3 hero-stat-item">
                    <span class="hero-stat-num">100%</span>
                    <span class="hero-stat-label">Wheat-Free</span>
                </div>
                <div class="col-auto px-4 py-3 hero-stat-item">
                    <span class="hero-stat-num">3+</span>
                    <span class="hero-stat-label">Heritage Grains</span>
                </div>
                <div class="col-auto px-4 py-3 hero-stat-item">
                    <span class="hero-stat-num">UK</span>
                    <span class="hero-stat-label">Made &amp; Sourced</span>
                </div>
                <div class="col-auto px-4 py-3 hero-stat-item">
                    <span class="hero-stat-num">B2C</span>
                    <span class="hero-stat-label">Retail &amp; Wholesale</span>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- ========= PRODUCT SECTION ========= --}}
<div class="product-section">
    <div class="container">
        <div class="row">
            <div class="col-md-12 col-lg-3 mb-5 mb-lg-0 scroll-reveal">
                <h2 class="mb-4 section-title">{{ optional($firstCategory)->name }}</h2>
                <p class="mb-4">{{ optional($firstCategory)->description }}</p>
                <p><a href="{{ route('shop.index') }}" class="btn">View Products</a></p>
            </div>

            @foreach ($latestProducts as $item)
                <div class="col-12 col-md-4 col-lg-3 mb-5 mb-md-10 scroll-reveal" style="--reveal-delay: {{ $loop->index * 120 }}ms">
                    <div class="product-item">
                        <a href="{{ route('product.show', $item->id) }}">
                            <img src="{{ asset('public/uploads/' . ($item->image ?? 'product-1.png')) }}"
                                class="img-fluid product-thumbnail">
                        </a>
                        <a href="{{ route('product.show', $item->id) }}" class="text-decoration-none">
                            <h3 class="product-title">{{ $item->name }}</h3>
                        </a>
                        @if($item->price)
                            <strong class="product-price">£{{ number_format($item->price, 2) }}</strong>
                        @else
                            <strong class="product-price">Available Soon</strong>
                        @endif
                        <span class="icon-cross"
                            data-bs-toggle="modal"
                            data-bs-target="#productModal{{ $item->id }}"
                            style="cursor:pointer;">
                            <img src="{{ asset('site/images/cross.svg') }}" class="img-fluid">
                        </span>
                    </div>

                    <div class="modal fade" id="productModal{{ $item->id }}" tabindex="-1" aria-hidden="true">
                        <div class="modal-dialog modal-lg modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">{{ $item->name }}</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                </div>
                                <div class="modal-body">
                                    <div class="row g-4">
                                        <div class="col-md-6">
                                            <img src="{{ asset('public/uploads/' . ($item->image ?? 'product-1.png')) }}" class="img-fluid rounded" alt="{{ $item->name }}">
                                        </div>
                                        <div class="col-md-6 d-flex flex-column justify-content-between">
                                            <div>
                                                <p class="price display-6 fw-bold" style="color: #8b670b;" id="modalPrice{{ $item->id }}">
                                                    £{{ $item->price }}
                                                </p>
                                                @if($item->variations && count($item->variations) > 0)
                                                    <select id="modalVariation{{ $item->id }}" class="form-select mb-3" style="width:120px;">
                                                        @foreach($item->variations as $weight => $price)
                                                            <option value="{{ $weight }}" data-price="{{ $price }}">
                                                                {{ $weight }} kg (£{{ number_format($price, 2) }})
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                @endif
                                                <input type="number" id="modalQuantity{{ $item->id }}" class="form-control mb-3" value="1" min="1" style="width:100px; height:38px;">
                                                <button type="button" class="btn btn-primary add-to-cart-modal" data-id="{{ $item->id }}">Add to Cart</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>

{{-- ========= OTHER CATEGORIES ========= --}}
@if($otherCategories->count())
    <div class="product-tabs-section">
        <div class="container">
            <h2 class="section-title mb-4 text-center scroll-reveal">Explore More Products</h2>
            <div class="d-flex justify-content-center flex-wrap mb-4 scroll-reveal" id="productTabs">
                @foreach($otherCategories as $index => $category)
                    <button class="category-btn {{ $index == 0 ? 'active' : '' }}"
                            data-bs-toggle="tab"
                            data-bs-target="#category-{{ $category->id }}"
                            type="button" style="margin-left: 10px">
                        {{ $category->name }}
                    </button>
                @endforeach
            </div>
            <div class="tab-content" id="productTabsContent">
                @foreach($otherCategories as $index => $category)
                    <div class="tab-pane fade {{ $index == 0 ? 'show active' : '' }}" id="category-{{ $category->id }}">
                        <div class="row">
                            <div class="col-md-12 col-lg-3 mb-5 mb-lg-0">
                                <h2 class="mb-4 section-title">{{ $category->name }}</h2>
                                <p class="mb-4">{{ $category->description }}</p>
                            </div>
                            @forelse ($category->products as $item)
                                <div class="col-12 col-md-4 col-lg-3 mb-5 mb-md-10">
                                    <div class="product-item position-relative text-center">
                                        <div class="image-wrapper position-relative">
                                            <a href="javascript:void(0)">
                                                <img src="{{ asset('public/uploads/' . ($item->image ?? 'product-1.png')) }}"
                                                    class="img-fluid product-thumbnail blurred">
                                            </a>
                                            <div class="product-overlay d-flex justify-content-center align-items-center">
                                                <i class="fas fa-lock lock-icon"></i>
                                            </div>
                                        </div>
                                        <a href="javascript:void(0)" class="text-decoration-none text-center">
                                            <h3 class="product-title">{{ $item->name }}</h3>
                                        </a>
                                        <p class="text-muted text-center">{{ substr($item->short_description, 0, 100) }}...</p>
                                        <p class="text-center"><a href="{{ route('shop.index') }}" class="btn">Coming Soon...</a></p>
                                    </div>
                                </div>
                            @empty
                                <div class="col-12 text-center">
                                    <img src="{{ asset('site/images/not_found.jpg') }}" alt="No products found" class="img-fluid" style="max-width: 300px; margin-top: -150px;">
                                    <p class="text-muted mt-3">No products available in this category.</p>
                                </div>
                            @endforelse
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endif

{{-- ========= WHY HARGRIO ========= --}}
<div class="why-choose-section">
    <div class="container">
        <div class="row justify-content-between">
            <div class="col-lg-6">
                <h2 class="section-title scroll-reveal">Why Hargrio</h2>
                <p class="scroll-reveal">
                    We transform under-commercialised heritage grains into high-quality,
                    wheat-free and easy-to-prepare food products suitable for households,
                    retailers and catering businesses across the UK.
                </p>
                <div class="row my-5">
                    <div class="col-6 col-md-6 scroll-reveal" style="--reveal-delay: 0ms">
                        <div class="feature feature--enhanced">
                            <div class="icon">
                                <svg width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M12 3v18"/><path d="M8 6c0 2 4 2 4 4s-4 2-4 4"/><path d="M16 6c0 2-4 2-4 4s4 2 4 4"/>
                                </svg>
                            </div>
                            <h3>Wheat-Free &amp; Heritage Grain Based</h3>
                            <p>Carefully formulated flour blends using teff, millet and oat.</p>
                        </div>
                    </div>
                    <div class="col-6 col-md-6 scroll-reveal" style="--reveal-delay: 100ms">
                        <div class="feature feature--enhanced">
                            <div class="icon">
                                <svg width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M3 12h18"/><path d="M5 12a7 7 0 0 0 14 0"/><path d="M12 5v3"/>
                                </svg>
                            </div>
                            <h3>Designed for Traditional &amp; Modern Cooking</h3>
                            <p>Suitable for swallow, stiff porridge, puree and blended drinks.</p>
                        </div>
                    </div>
                    <div class="col-6 col-md-6 scroll-reveal" style="--reveal-delay: 200ms">
                        <div class="feature feature--enhanced">
                            <div class="icon">
                                <svg width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M12 3l7 4v5c0 5-3.5 7.5-7 9-3.5-1.5-7-4-7-9V7l7-4z"/><path d="M9 12l2 2 4-4"/>
                                </svg>
                            </div>
                            <h3>Nutritionally Considered</h3>
                            <p>Source of fibre, plant-based protein and essential minerals.</p>
                        </div>
                    </div>
                    <div class="col-6 col-md-6 scroll-reveal" style="--reveal-delay: 300ms">
                        <div class="feature feature--enhanced">
                            <div class="icon">
                                <svg width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M3 9l9-6 9 6"/><path d="M4 10h16v10H4z"/><path d="M9 21V12h6v9"/>
                                </svg>
                            </div>
                            <h3>Built for Scale</h3>
                            <p>Manufactured for home use, retail distribution and wholesale supply.</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-5 scroll-reveal" style="--reveal-delay: 150ms">
                <div class="img-wrap">
                    <img src="{{ asset('site/images/why-choose-us-img.jpg') }}" alt="Image" class="img-fluid">
                </div>
            </div>
        </div>
    </div>
</div>

{{-- ========= PROMOTIONS ========= --}}
@if($promotions->count())
    <div id="promotionCarousel" class="carousel slide promo-carousel" data-bs-ride="carousel" data-bs-interval="6000">
        <div class="carousel-inner">
            @foreach($promotions as $key => $promotion)
                <div class="carousel-item {{ $key == 0 ? 'active' : '' }}">
                    <div class="promo-banner-slide">
                        <div class="promo-deco promo-deco--1" aria-hidden="true"></div>
                        <div class="promo-deco promo-deco--2" aria-hidden="true"></div>
                        <div class="promo-deco promo-deco--3" aria-hidden="true"></div>
                        <div class="container">
                            <div class="row align-items-center">
                                <div class="col-lg-8 col-md-10 mx-auto text-center">
                                    <div class="promo-badge-pill">
                                        <span class="promo-pulse" aria-hidden="true"></span>
                                        Limited Time Offer
                                    </div>
                                    <h2 class="promo-heading">{{ $promotion->title }}</h2>
                                    <div class="promo-body">
                                        @php $desc = $promotion->description; @endphp
                                        {!! $desc !!}
                                    </div>
                                    <div class="mt-4">
                                        <a href="{{ route('shop.index') }}" class="btn btn-promo">
                                            Shop Now
                                            <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        @if($promotions->count() > 1)
            <div class="carousel-indicators promo-indicators">
                @foreach($promotions as $key => $promotion)
                    <button type="button" data-bs-target="#promotionCarousel" data-bs-slide-to="{{ $key }}"
                        class="{{ $key == 0 ? 'active' : '' }}" aria-label="Slide {{ $key + 1 }}"></button>
                @endforeach
            </div>
            <button class="carousel-control-prev promo-carousel-btn" type="button" data-bs-target="#promotionCarousel" data-bs-slide="prev">
                <svg width="22" height="22" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path d="M15 18l-6-6 6-6"/></svg>
            </button>
            <button class="carousel-control-next promo-carousel-btn" type="button" data-bs-target="#promotionCarousel" data-bs-slide="next">
                <svg width="22" height="22" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path d="M9 18l6-6-6-6"/></svg>
            </button>
        @endif
    </div>
@endif

{{-- ========= WHOLESALE & RETAIL ========= --}}
<div class="we-help-section">
    <div class="container">
        <div class="row justify-content-between">
            <div class="col-lg-7 mb-5 mb-lg-0 scroll-reveal">
                <div class="imgs-grid">
                    <div class="grid grid-1"><img src="{{ asset('site/images/img-grid-1.jpg') }}" alt="Hargrio grain product"></div>
                    <div class="grid grid-2"><img src="{{ asset('site/images/img-grid-2.jpg') }}" alt="Heritage grain flour"></div>
                    <div class="grid grid-3"><img src="{{ asset('site/images/img-grid-3.jpg') }}" alt="Wholesale flour supply"></div>
                </div>
            </div>
            <div class="col-lg-5 ps-lg-5 scroll-reveal" style="--reveal-delay: 150ms">
                <h2 class="section-title mb-4">WHOLESALE &amp; RETAIL</h2>
                <p>Hargrio flour blends are available for both retail customers and approved wholesale partners.
                    We supply households, retailers, catering businesses and distributors
                    across the UK with scalable, high-quality heritage grain products.
                </p>
                <ul class="list-unstyled custom-list my-4">
                    <li>Retail packs available in 1kg, 2kg and 5kg sizes</li>
                    <li>Competitive wholesale pricing for approved partners</li>
                    <li>Suitable for supermarkets, ethnic stores and catering businesses</li>
                    <li>Reliable supply with stock-level monitoring</li>
                </ul>
                <p>
                    <a href="javascript:void(0)" class="btn btn-primary me-2"
                        data-bs-toggle="modal" data-bs-target="#wholesaleModal">
                        Apply for Wholesale
                    </a>
                    <a href="{{ route('shop.index') }}" class="btn btn-outline-primary">Shop Retail</a>
                </p>
            </div>
        </div>
    </div>
</div>

{{-- ========= FAQ ========= --}}
<section id="faq" class="faq-section">
    <div class="faq-section__inner">
        <div class="container">

            <div class="text-center mb-5 scroll-reveal">
                <div class="faq-eyebrow">Got Questions?</div>
                <h2 class="section-title faq-title">Frequently Asked Questions</h2>
                <p class="faq-subtitle">
                    Everything you need to know about our heritage flour blends, ordering, and preparation.
                </p>
            </div>

            @php
                $faqs = [
                    ['q' => 'What makes MOAT and Milla different from regular flour?',
                     'a' => 'MOAT and Milla are heritage-inspired flour blends developed to provide a smoother texture, better nutrition profile, and easier digestion compared to many modern refined flours. They are carefully formulated to retain more natural nutrients while maintaining excellent cooking performance.'],
                    ['q' => 'Can I substitute MOAT or Milla in my regular recipes?',
                     'a' => 'Yes. We recommend starting by replacing 25–50% of your usual flour with MOAT or Milla, then adjusting as needed. Because our blends absorb moisture differently, slight adjustments to liquid ratios may be required.'],
                    ['q' => 'How should I store your flour blends?',
                     'a' => 'Store in an airtight container in a cool, dry place. For extended freshness beyond three months, refrigeration or freezing in a sealed container is recommended.'],
                    ['q' => 'Are your products suitable for wheat-free diets?',
                     'a' => 'Some of our blends are formulated as wheat-free alternatives. Please check the individual product description for full ingredient details to ensure suitability for your dietary needs.'],
                    ['q' => 'Do you offer wholesale or bulk pricing?',
                     'a' => 'Yes. We provide wholesale pricing for retailers, catering businesses, and distributors. Please contact us directly to discuss bulk quantities and delivery arrangements.'],
                    ['q' => 'What is your return policy?',
                     'a' => 'We stand behind the quality of our products. If you are not satisfied with your purchase, please contact us within 30 days and our team will assist you.'],
                    ['q' => 'How long does shipping take?',
                     'a' => 'Orders are typically processed within 1–2 business days. Delivery times vary depending on location but usually arrive within 3–5 working days.'],
                ];
                $leftFaqs  = array_values(array_filter($faqs, fn($k) => $k % 2 === 0, ARRAY_FILTER_USE_KEY));
                $rightFaqs = array_values(array_filter($faqs, fn($k) => $k % 2 !== 0, ARRAY_FILTER_USE_KEY));
            @endphp

            <div class="row g-4">
                <div class="col-lg-6 scroll-reveal">
                    @foreach($leftFaqs as $i => $faq)
                        <div class="faq-card {{ $i === 0 ? 'faq-card--open' : '' }}">
                            <button class="faq-card__question" aria-expanded="{{ $i === 0 ? 'true' : 'false' }}">
                                <span class="faq-card__num">{{ str_pad($i + 1, 2, '0', STR_PAD_LEFT) }}</span>
                                <span class="faq-card__text">{{ $faq['q'] }}</span>
                                <span class="faq-card__icon" aria-hidden="true">
                                    <svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path d="M6 9l6 6 6-6"/></svg>
                                </span>
                            </button>
                            <div class="faq-card__answer">
                                <p>{{ $faq['a'] }}</p>
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="col-lg-6 scroll-reveal" style="--reveal-delay: 120ms">
                    @foreach($rightFaqs as $i => $faq)
                        <div class="faq-card">
                            <button class="faq-card__question" aria-expanded="false">
                                <span class="faq-card__num">{{ str_pad($i + 1, 2, '0', STR_PAD_LEFT) }}</span>
                                <span class="faq-card__text">{{ $faq['q'] }}</span>
                                <span class="faq-card__icon" aria-hidden="true">
                                    <svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path d="M6 9l6 6 6-6"/></svg>
                                </span>
                            </button>
                            <div class="faq-card__answer">
                                <p>{{ $faq['a'] }}</p>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

            <div class="text-center mt-5 scroll-reveal">
                <div class="faq-cta-card">
                    <div class="faq-cta-icon">&#128172;</div>
                    <h4 class="mb-2">Still Have Questions?</h4>
                    <p class="mb-4">Our team is happy to help with any questions about our products or your order.</p>
                    <a href="{{ route('contact') }}" class="btn btn-primary px-4">Contact Us</a>
                </div>
            </div>

        </div>
    </div>
</section>

{{-- ========= BLOG ========= --}}
<div class="blog-section">
    <div class="container">
        <div class="row mb-5 scroll-reveal">
            <div class="col-md-6">
                <h2 class="section-title">Recipes &amp; Wellness Stories</h2>
            </div>
            <div class="col-md-6 text-start text-md-end">
                <a href="{{ route('blog.index') }}" class="more">View All Posts</a>
            </div>
        </div>
        <div class="row">
            @forelse($posts as $post)
                <div class="col-12 col-sm-6 col-md-4 mb-4 scroll-reveal" style="--reveal-delay: {{ $loop->index * 120 }}ms">
                    <div class="post-entry post-entry--enhanced">
                        <a href="{{ route('blog.show', $post->slug) }}" class="post-thumbnail">
                            <img src="{{ asset('public/' . ($post->feature_image ?? 'post-1.jpg')) }}"
                                alt="{{ $post->title }}"
                                class="img-fluid">
                        </a>
                        <div class="post-content-entry">
                            <h3>
                                <a href="{{ route('blog.show', $post->slug) }}">{{ $post->title }}</a>
                            </h3>
                            <p class="text-muted">{{ \Illuminate\Support\Str::limit($post->excerpt, 100) }}</p>
                            <a href="{{ route('blog.show', $post->slug) }}" class="post-read-more">Read More &rarr;</a>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12 text-center">
                    <p class="text-muted">No blog posts available at the moment.</p>
                </div>
            @endforelse
        </div>
    </div>
</div>

{{-- ========= WHOLESALE MODAL ========= --}}
<div class="modal fade" id="wholesaleModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content rounded-4 border-0">
            <div class="modal-header border-0 pb-0">
                <h3 class="modal-title fw-bold">Request Wholesale Information</h3>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body p-4 p-lg-5">
                <p class="text-muted mb-4">Fill out the form below and our wholesale team will contact you within 24 hours.</p>
                <form method="POST" action="{{ route('wholesale.inquiry') }}">
                    @csrf
                    <div class="row g-4">
                        <div class="col-md-6">
                            <label class="form-label">Business Name *</label>
                            <input type="text" name="business_name" class="form-control" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Contact Name *</label>
                            <input type="text" name="contact_name" class="form-control" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Email Address *</label>
                            <input type="email" name="email" class="form-control" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Phone Number *</label>
                            <input type="tel" name="phone" class="form-control" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Business Type *</label>
                            <select name="business_type" class="form-select" required>
                                <option value="">Select business type</option>
                                <option value="bakery">Bakery</option>
                                <option value="restaurant">Restaurant</option>
                                <option value="retail">Retail Store</option>
                                <option value="distributor">Distributor</option>
                                <option value="other">Other</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Estimated Monthly Volume *</label>
                            <select name="volume" class="form-select" required>
                                <option value="">Select volume range</option>
                                <option value="50-100">50–100 kg</option>
                                <option value="100-500">100–500 kg</option>
                                <option value="500-1000">500–1,000 kg</option>
                                <option value="1000+">1,000+ kg</option>
                            </select>
                        </div>
                        <div class="col-12">
                            <label class="form-label">Additional Information</label>
                            <textarea name="message" rows="4" class="form-control" maxlength="500"></textarea>
                            <small class="text-muted">Maximum 500 characters</small>
                        </div>
                    </div>
                    <div class="mt-4 text-center">
                        <button type="submit" class="btn btn-primary px-5 py-2">Submit Wholesale Inquiry</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

{{-- ========= CART SCRIPT (auth only) ========= --}}
@auth
<script>
    $(document).ready(function() {
        $('.add-to-cart-modal').click(function() {
            var productId = $(this).data('id');
            var quantity  = $('#modalQuantity' + productId).val();
            var variation = $('#modalVariation' + productId).length ? $('#modalVariation' + productId).val() : null;
            addToCart(productId, quantity, variation);
        });

        function addToCart(productId, quantity, variation) {
            $.ajax({
                url: "{{ url('cart/add') }}/" + productId,
                type: "POST",
                data: { _token: "{{ csrf_token() }}", quantity: quantity, variation: variation },
                success: function(response) {
                    alert(response.message);
                    if (response.cart_count !== undefined) {
                        if ($('#cart-count').length) {
                            $('#cart-count').text(response.cart_count);
                        } else {
                            $('.nav-link[href="{{ route('cart.index') }}"]').append(
                                '<span id="cart-count" class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">'
                                + response.cart_count + '</span>'
                            );
                        }
                    }
                },
                error: function(xhr) {
                    if (xhr.status === 401 || xhr.status === 419) {
                        window.location.href = "{{ route('login') }}";
                    } else {
                        alert('Error adding product to cart.');
                    }
                }
            });
        }

        @foreach($latestProducts as $item)
            $('#modalVariation{{ $item->id }}').on('change', function() {
                $('#modalPrice{{ $item->id }}').text('£' + parseFloat($(this).find(':selected').data('price')).toFixed(2));
            });
        @endforeach
    });
</script>
@endauth

{{-- ========= STYLES ========= --}}
<style>
/* --- Keyframes --- */
@keyframes fadeUp {
    from { opacity: 0; transform: translateY(30px); }
    to   { opacity: 1; transform: translateY(0); }
}
@keyframes floatBob {
    0%, 100% { transform: translateY(0); }
    50%       { transform: translateY(-14px); }
}
@keyframes shimmerText {
    0%   { background-position: -200% center; }
    100% { background-position:  200% center; }
}
@keyframes pulseRing {
    0%   { transform: scale(0.8); opacity: 1; }
    100% { transform: scale(2.2); opacity: 0; }
}
@keyframes rotateSlow {
    from { transform: rotate(0deg); }
    to   { transform: rotate(360deg); }
}

/* --- Scroll Reveal --- */
.scroll-reveal {
    opacity: 0;
    transform: translateY(28px);
    transition: opacity 0.65s ease, transform 0.65s ease;
    transition-delay: var(--reveal-delay, 0ms);
}
.scroll-reveal.revealed {
    opacity: 1;
    transform: translateY(0);
}

/* --- Hero --- */
.hero--enhanced { position: relative; overflow: hidden; }
.hero-bg-pattern {
    position: absolute; inset: 0; pointer-events: none;
    background-image:
        radial-gradient(circle at 15% 85%, rgba(249,191,41,0.09) 0%, transparent 45%),
        radial-gradient(circle at 85% 15%, rgba(139,103,11,0.13) 0%, transparent 45%);
}
.hero-eyebrow {
    display: inline-block;
    background: rgba(249,191,41,0.12);
    color: #f9bf29;
    border: 1px solid rgba(249,191,41,0.3);
    font-size: 11px; font-weight: 600;
    letter-spacing: 1.8px; text-transform: uppercase;
    padding: 5px 14px; border-radius: 20px; margin-bottom: 18px;
}
.animate-fade-up { animation: fadeUp 0.7s ease forwards; opacity: 0; }
.delay-1 { animation-delay: 0.15s; }
.delay-2 { animation-delay: 0.30s; }
.delay-3 { animation-delay: 0.45s; }
.hero-highlight {
    background: linear-gradient(90deg, #f9bf29 0%, #e8a800 50%, #f9bf29 100%);
    background-size: 200% auto;
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
    animation: shimmerText 3s linear infinite;
}
.hero-img-float img { animation: floatBob 5s ease-in-out infinite; }

/* Hero stats strip */
.hero-stats-strip {
    background: rgba(255,255,255,0.06);
    border-top: 1px solid rgba(255,255,255,0.1);
    margin-top: 3rem;
}
.hero-stat-item {
    border-right: 1px solid rgba(255,255,255,0.1);
    min-width: 110px;
}
.hero-stat-item:last-child { border-right: none; }
.hero-stat-num {
    display: block; font-size: 22px; font-weight: 800;
    color: #f9bf29; line-height: 1.1;
}
.hero-stat-label {
    display: block; font-size: 10px;
    color: rgba(255,255,255,0.45);
    text-transform: uppercase; letter-spacing: 1px; margin-top: 3px;
}

/* --- Promo Banner --- */
.promo-banner-slide {
    background: linear-gradient(135deg, #1f130c 0%, #3d2409 45%, #6b4a0e 100%);
    padding: 80px 0;
    position: relative; overflow: hidden;
}
.promo-deco { position: absolute; border-radius: 50%; pointer-events: none; }
.promo-deco--1 {
    width: 420px; height: 420px;
    background: radial-gradient(circle, rgba(249,191,41,0.11) 0%, transparent 70%);
    top: -100px; right: -80px;
    animation: rotateSlow 25s linear infinite;
}
.promo-deco--2 {
    width: 260px; height: 260px;
    background: radial-gradient(circle, rgba(139,103,11,0.2) 0%, transparent 70%);
    bottom: -70px; left: -50px;
}
.promo-deco--3 {
    width: 160px; height: 160px;
    border: 2px solid rgba(249,191,41,0.15);
    top: 50%; right: 12%;
    transform: translateY(-50%);
    animation: rotateSlow 35s linear infinite reverse;
}
.promo-badge-pill {
    display: inline-flex; align-items: center; gap: 8px;
    background: rgba(249,191,41,0.14);
    border: 1px solid rgba(249,191,41,0.35);
    color: #f9bf29; font-size: 11px; font-weight: 600;
    letter-spacing: 1.2px; text-transform: uppercase;
    padding: 6px 16px; border-radius: 50px; margin-bottom: 20px;
}
.promo-pulse {
    display: inline-block; width: 8px; height: 8px;
    background: #f9bf29; border-radius: 50%; position: relative;
}
.promo-pulse::before {
    content: ''; position: absolute; inset: -3px;
    border-radius: 50%; border: 1px solid #f9bf29;
    animation: pulseRing 1.6s ease-out infinite;
}
.promo-heading {
    color: #fff;
    font-size: clamp(1.8rem, 4vw, 2.8rem);
    font-weight: 800; line-height: 1.2; margin-bottom: 16px;
}
.promo-body { color: rgba(255,255,255,0.72); font-size: 16px; line-height: 1.75; }
.promo-body p { color: rgba(255,255,255,0.72); margin-bottom: 0.5rem; }
.btn-promo {
    display: inline-flex; align-items: center; gap: 8px;
    background: #f9bf29; color: #1f130c !important;
    font-weight: 700; padding: 14px 32px;
    border-radius: 50px; border: none;
    transition: all 0.3s ease; text-decoration: none;
}
.btn-promo:hover {
    background: #e8a800;
    transform: translateY(-2px);
    box-shadow: 0 8px 22px rgba(249,191,41,0.35);
}
.promo-carousel-btn {
    position: absolute; top: 50%; transform: translateY(-50%);
    background: rgba(255,255,255,0.1); border: 1px solid rgba(255,255,255,0.2);
    border-radius: 50%; width: 46px; height: 46px;
    display: flex; align-items: center; justify-content: center;
    color: white; transition: background 0.3s; z-index: 10; opacity: 1;
}
.promo-carousel-btn:hover { background: rgba(255,255,255,0.25); color: white; }
.promo-carousel-btn.carousel-control-prev { left: 20px; }
.promo-carousel-btn.carousel-control-next { right: 20px; }
.promo-carousel-btn .carousel-control-prev-icon,
.promo-carousel-btn .carousel-control-next-icon { display: none; }
.promo-indicators { bottom: 18px; gap: 6px; }
.promo-indicators button {
    width: 24px; height: 4px; border-radius: 2px;
    background: rgba(255,255,255,0.35); border: none;
    transition: all 0.3s; padding: 0;
}
.promo-indicators button.active { background: #f9bf29; width: 42px; }

/* --- FAQ --- */
.faq-section { background: #fff; }
.faq-section__inner {
    padding: 80px 0;
    background: linear-gradient(180deg, #faf8f4 0%, #fff 100%);
    position: relative; overflow: hidden;
}
.faq-section__inner::before {
    content: ''; position: absolute;
    top: -80px; left: 50%; transform: translateX(-50%);
    width: 700px; height: 700px;
    background: radial-gradient(circle, rgba(249,191,41,0.06) 0%, transparent 60%);
    pointer-events: none;
}
.faq-eyebrow {
    display: inline-block; color: #8b670b;
    font-size: 12px; font-weight: 600;
    letter-spacing: 2px; text-transform: uppercase; margin-bottom: 12px;
}
.faq-eyebrow::after {
    content: ''; display: block; width: 30px; height: 2px;
    background: #f9bf29; margin: 6px auto 0;
}
.faq-title { font-size: clamp(1.5rem, 3vw, 2.2rem); font-weight: 800; margin-bottom: 12px; }
.faq-subtitle { color: #999; max-width: 520px; margin: 0 auto; font-size: 15px; }

.faq-card {
    background: #fff;
    border: 1px solid #ede8df;
    border-radius: 12px; margin-bottom: 14px; overflow: hidden;
    transition: box-shadow 0.3s, border-color 0.3s;
}
.faq-card:hover { box-shadow: 0 4px 20px rgba(139,103,11,0.1); border-color: rgba(249,191,41,0.4); }
.faq-card--open { border-color: rgba(249,191,41,0.5); box-shadow: 0 4px 20px rgba(139,103,11,0.12); }

.faq-card__question {
    width: 100%; background: none; border: none;
    padding: 18px 20px; display: flex; align-items: center;
    gap: 14px; text-align: left; cursor: pointer;
    transition: background 0.2s;
}
.faq-card__question:hover { background: rgba(249,191,41,0.04); }

.faq-card__num {
    flex-shrink: 0; width: 32px; height: 32px;
    background: linear-gradient(135deg, #f9bf29, #e8a800);
    border-radius: 8px; display: flex; align-items: center;
    justify-content: center; font-size: 11px; font-weight: 800;
    color: #1f130c; letter-spacing: 0.5px;
}
.faq-card__text { flex: 1; font-size: 14px; font-weight: 600; color: #2f2f2f; line-height: 1.4; }
.faq-card__icon { flex-shrink: 0; color: #8b670b; transition: transform 0.35s ease; display: flex; }
.faq-card--open .faq-card__icon { transform: rotate(180deg); }

.faq-card__answer {
    max-height: 0; overflow: hidden;
    transition: max-height 0.4s ease, padding 0.3s ease;
    padding: 0 20px 0 66px;
}
.faq-card--open .faq-card__answer { max-height: 300px; padding: 0 20px 18px 66px; }
.faq-card__answer p { font-size: 14px; color: #6a6a6a; line-height: 1.75; margin: 0; }

.faq-cta-card {
    background: linear-gradient(135deg, #1f130c, #3d2409);
    border-radius: 20px; padding: 40px 32px;
    max-width: 460px; margin: 0 auto;
}
.faq-cta-icon { font-size: 34px; margin-bottom: 12px; }
.faq-cta-card h4 { color: #fff; font-weight: 700; }
.faq-cta-card p { color: rgba(255,255,255,0.6); }
.faq-cta-card .btn-primary {
    background: #f9bf29; border-color: #f9bf29;
    color: #1f130c; font-weight: 700;
}
.faq-cta-card .btn-primary:hover { background: #e8a800; border-color: #e8a800; }

/* --- Feature cards --- */
.feature--enhanced { padding: 14px; border-radius: 12px; transition: background 0.3s; }
.feature--enhanced:hover { background: rgba(249,191,41,0.06); }

/* --- Blog cards --- */
.post-entry--enhanced {
    border-radius: 12px; overflow: hidden; background: #fff;
    box-shadow: 0 2px 12px rgba(0,0,0,0.06);
    transition: box-shadow 0.3s, transform 0.3s;
}
.post-entry--enhanced:hover { transform: translateY(-6px); box-shadow: 0 12px 32px rgba(0,0,0,0.12); }
.post-entry--enhanced .post-thumbnail { display: block; overflow: hidden; }
.post-entry--enhanced .post-thumbnail img {
    transition: transform 0.5s ease; width: 100%; height: 200px; object-fit: cover;
}
.post-entry--enhanced:hover .post-thumbnail img { transform: scale(1.06); }
.post-entry--enhanced .post-content-entry { padding: 20px; }
.post-read-more {
    display: inline-block; color: #8b670b;
    font-size: 13px; font-weight: 600;
    text-decoration: none; margin-top: 8px;
}
.post-read-more:hover { color: #f9bf29; text-decoration: none; }

/* --- Category tabs --- */
.category-btn {
    background-color: #8b670b; color: #fff; border: none;
    padding: 10px 25px; margin: 5px; border-radius: 25px;
    font-weight: 500; cursor: pointer; transition: 0.3s;
}
.category-btn:hover { background-color: #a07c23; }
.category-btn.active { background-color: #d4af37; color: #000; }
.tab-pane { opacity: 0; transform: translateY(20px); transition: opacity 0.4s ease, transform 0.4s ease; display: none; }
.tab-pane.show.active { opacity: 1; transform: translateY(0); display: block; }

/* --- Other category product overlay --- */
.image-wrapper { position: relative; overflow: hidden; border-radius: 8px; }
.blurred { filter: blur(4px); transform: scale(1.05); }
.product-overlay { position: absolute; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0,0,0,0.45); }
.lock-icon { font-size: 40px; color: #fff; }
</style>

{{-- ========= JS: Scroll Reveal + FAQ + Tabs ========= --}}
<script>
document.addEventListener('DOMContentLoaded', function () {

    /* Scroll reveal */
    var observer = new IntersectionObserver(function(entries) {
        entries.forEach(function(entry) {
            if (entry.isIntersecting) {
                entry.target.classList.add('revealed');
                observer.unobserve(entry.target);
            }
        });
    }, { threshold: 0.1, rootMargin: '0px 0px -40px 0px' });
    document.querySelectorAll('.scroll-reveal').forEach(function(el) { observer.observe(el); });

    /* FAQ accordion */
    document.querySelectorAll('.faq-card__question').forEach(function(btn) {
        btn.addEventListener('click', function() {
            var card   = this.closest('.faq-card');
            var isOpen = card.classList.contains('faq-card--open');
            document.querySelectorAll('.faq-card--open').forEach(function(c) {
                c.classList.remove('faq-card--open');
                c.querySelector('.faq-card__question').setAttribute('aria-expanded', 'false');
            });
            if (!isOpen) {
                card.classList.add('faq-card--open');
                this.setAttribute('aria-expanded', 'true');
            }
        });
    });

    /* Category tabs */
    var catBtns = document.querySelectorAll('.category-btn');
    var tabPanes = document.querySelectorAll('.tab-pane');
    catBtns.forEach(function(btn) {
        btn.addEventListener('click', function() {
            catBtns.forEach(function(b) { b.classList.remove('active'); });
            this.classList.add('active');
            tabPanes.forEach(function(t) { t.classList.remove('show', 'active'); });
            var target = document.querySelector(btn.getAttribute('data-bs-target'));
            if (target) target.classList.add('show', 'active');
        });
    });

});
</script>

@endsection
