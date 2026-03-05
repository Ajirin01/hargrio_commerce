@extends('layouts.site')
@section('content')
    <!-- Start Hero Section -->
    <div class="hero">
        <div class="container">
            <div class="row justify-content-between">
                <div class="col-lg-5">
                    <div class="intro-excerpt">
                        <h1>Heritage Grains <span class="d-block">Made for Modern Living</span></h1>

                        <p class="mb-4">
                            Hargrio Limited is a UK-based food manufacturing company developing
                            nutritious, wheat-free flour blends using heritage and alternative grains.
                            Designed for traditional staple meals and modern kitchens.
                        </p>

                        <p>
                            <a href="{{ route('shop.index') }}" class="btn btn-secondary me-2">Explore Flour Blends</a>
                            <a href="{{ route('about') }}" class="btn btn-white-outline">Our Story</a>
                        </p>
                    </div>
                </div>
                <div class="col-lg-7">
                    <div class="hero-img-wrap">
                        <img src="{{ asset('site/images/hargrio_hero.png') }}" class="img-fluid">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Hero Section -->

    <!-- Start Product Section -->
    <div class="product-section">
        <div class="container">
            <div class="row">

                <!-- Column 1: Info -->
                <div class="col-md-12 col-lg-3 mb-5 mb-lg-0">
                    <h2 class="mb-4 section-title">{{ $firstCategory->name }}</h2>
                    <p class="mb-4">
                        {{ $firstCategory->description }}
                    </p>
                    <p><a href="{{ route('shop.index') }}" class="btn">View Products</a></p>
                </div> 

                <!-- Products -->
                @foreach ($latestProducts as $item)
                    <div class="col-12 col-md-4 col-lg-3 mb-5 mb-md-10">
                        <div class="product-item">

                            <!-- Image links to product detail -->
                            <a href="{{ route('product.show', $item->id) }}">
                                <img src="{{ asset('public/uploads/' . ($item->image ?? 'product-1.png')) }}" 
                                    class="img-fluid product-thumbnail">
                            </a>

                            <!-- Title also links to product detail -->
                            <a href="{{ route('product.show', $item->id) }}" class="text-decoration-none">
                                <h3 class="product-title">{{ $item->name }}</h3>
                            </a>

                            @if($item->price)
                                <strong class="product-price">
                                    £{{ number_format($item->price, 2) }}
                                </strong>
                            @else
                                <strong class="product-price">Available Soon</strong>
                            @endif

                            <!-- Cross icon opens modal -->
                            <span class="icon-cross" 
                                data-bs-toggle="modal"
                                data-bs-target="#productModal{{ $item->id }}"
                                style="cursor:pointer;">
                                <img src="{{ asset('site/images/cross.svg') }}" 
                                    class="img-fluid">
                            </span>

                        </div>

                        <!-- Product Modal -->
                        <div class="modal fade" id="productModal{{ $item->id }}" tabindex="-1" aria-labelledby="productModalLabel{{ $item->id }}" aria-hidden="true">
                            <div class="modal-dialog modal-lg modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="productModalLabel{{ $item->id }}">{{ $item->name }}</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
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

                                                    <input type="number"
                                                        id="modalQuantity{{ $item->id }}"
                                                        class="form-control mb-3"
                                                        value="1"
                                                        min="1"
                                                        style="width:100px; height:38px;">

                                                    <button type="button"
                                                            class="btn btn-primary add-to-cart-modal"
                                                            data-id="{{ $item->id }}">
                                                        Add to Cart
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- End Modal -->

                    </div>
                @endforeach

            </div>
        </div>
    </div>
    <!-- End Product Section -->

    {{-- Other Categories Section --}}
    @if($otherCategories->count())
        <div class="product-tabs-section">
            <div class="container">
                <h2 class="section-title mb-4 text-center">Explore More Products</h2>

                <!-- Tabs as buttons -->
                <div class="d-flex justify-content-center flex-wrap mb-4" id="productTabs">
                    @foreach($otherCategories as $index => $category)
                        <button class="category-btn {{ $index == 0 ? 'active' : '' }}" 
                                data-bs-toggle="tab" 
                                data-bs-target="#category-{{ $category->id }}" 
                                type="button" style="margin-left: 10px">
                            {{ $category->name }}
                        </button>
                    @endforeach
                </div>

                <!-- Tab Content -->
                <div class="tab-content" id="productTabsContent">
                    @foreach($otherCategories as $index => $category)
                        <div class="tab-pane fade {{ $index == 0 ? 'show active' : '' }}" 
                            id="category-{{ $category->id }}">
                            <div class="row">

                                <!-- Column 1: Info -->
                                <div class="col-md-12 col-lg-3 mb-5 mb-lg-0">
                                    <h2 class="mb-4 section-title">{{ $category->name }}</h2>
                                    <p class="mb-4">
                                        {{ $category->description }}
                                    </p>
                                </div> 

                                <!-- Products -->
                                @forelse ($category->products as $item)
                                    <div class="col-12 col-md-4 col-lg-3 mb-5 mb-md-10">
                                        <div class="product-item position-relative text-center">
                                            <!-- Image Wrapper -->
                                            <div class="image-wrapper position-relative">

                                                <!-- Blurred Image -->
                                                <a href="javascript:void(0)">
                                                    <img src="{{ asset('public/uploads/' . ($item->image ?? 'product-1.png')) }}" 
                                                        class="img-fluid product-thumbnail blurred">
                                                </a>

                                                <!-- Overlay -->
                                                <div class="product-overlay d-flex justify-content-center align-items-center">
                                                    <i class="fas fa-lock lock-icon"></i>
                                                </div>

                                            </div>

                                            <!-- Title -->
                                            <a href="javascript:void(0)" class="text-decoration-none text-center">
                                                <h3 class="product-title">{{ $item->name }}</h3>
                                            </a>

                                            <p class="text-muted text-center">
                                                {{ substr($item->short_description, 0, 100) }}...
                                            </p>

                                            <p class="text-center">
                                                <a href="{{ route('shop.index') }}" class="btn">Coming Soon...</a>
                                            </p>

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

    <!-- Start Why Choose Us Section -->
    <div class="why-choose-section">
        <div class="container">
            <div class="row justify-content-between">
                <div class="col-lg-6">
                    <h2 class="section-title">Why Hargrio</h2>
                    <p>
                        We transform under-commercialised heritage grains into high-quality,
                        wheat-free and easy-to-prepare food products suitable for households,
                        retailers and catering businesses across the UK.
                    </p>

                    <div class="row my-5">
                        <div class="col-6 col-md-6">
                            <div class="feature">
                                <div class="icon">
                                    <svg width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M12 3v18"/>
                                        <path d="M8 6c0 2 4 2 4 4s-4 2-4 4"/>
                                        <path d="M16 6c0 2-4 2-4 4s4 2 4 4"/>
                                    </svg>
                                </div>
                                <h3>Wheat-Free & Heritage Grain Based</h3>
                                <p>Carefully formulated flour blends using teff, millet and oat.</p>
                            </div>
                        </div>

                        <div class="col-6 col-md-6">
                            <div class="feature">
                                <div class="icon">
                                    <svg width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M3 12h18"/>
                                        <path d="M5 12a7 7 0 0 0 14 0"/>
                                        <path d="M12 5v3"/>
                                    </svg>
                                </div>
                                <h3>Designed for Traditional & Modern Cooking</h3>
                                <p>Suitable for swallow, stiff porridge, puree and blended drinks.</p>
                            </div>
                        </div>

                        <div class="col-6 col-md-6">
                            <div class="feature">
                                <div class="icon">
                                    <svg width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M12 3l7 4v5c0 5-3.5 7.5-7 9-3.5-1.5-7-4-7-9V7l7-4z"/>
                                        <path d="M9 12l2 2 4-4"/>
                                    </svg>
                                </div>
                                <h3>Nutritionally Considered</h3>
                                <p>Source of fibre, plant-based protein and essential minerals.</p>
                            </div>
                        </div>

                        <div class="col-6 col-md-6">
                            <div class="feature">
                                <div class="icon">
                                    <svg width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M3 9l9-6 9 6"/>
                                        <path d="M4 10h16v10H4z"/>
                                        <path d="M9 21V12h6v9"/>
                                    </svg>
                                </div>
                                <h3>Built for Scale</h3>
                                <p>Manufactured for home use, retail distribution and wholesale supply.</p>
                            </div>
                        </div>

                    </div>
                </div>

                <div class="col-lg-5">
                    <div class="img-wrap">
                        <img src="{{ asset('site/images/why-choose-us-img.jpg') }}" alt="Image" class="img-fluid">
                    </div>
                </div>

            </div>
        </div>
    </div>
    <!-- End Why Choose Us Section -->

    @if($promotions->count())
        <div id="promotionCarousel" class="carousel slide mb-5" data-bs-ride="carousel">
            <div class="carousel-inner">

                @foreach($promotions as $key => $promotion)
                <div class="carousel-item {{ $key == 0 ? 'active' : '' }}">
                    <div class="d-flex justify-content-center align-items-center" style="background: #f5f0e1; min-height: 400px;">
                        <div class="text-center p-4">
                            <h2 class="mb-3">{{ $promotion->title }}</h2>

                            @php
                                $desc = $promotion->description;
                            @endphp

                            
                            {!! $desc !!}
                            

                            <div class="mt-3">
                                <a href="{{ route('shop.index') }}" class="btn btn-primary">Shop Now</a>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach

            </div>

            {{-- Carousel Controls --}}
            <button class="carousel-control-prev" type="button" data-bs-target="#promotionCarousel" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#promotionCarousel" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>
    @endif

    <!-- Start We Help Section -->
    <div class="we-help-section">
        <div class="container">
            <div class="row justify-content-between">
                <div class="col-lg-7 mb-5 mb-lg-0">
                    <div class="imgs-grid">
                        <div class="grid grid-1"><img src="{{ asset('site/images/img-grid-1.jpg') }}" alt="Untree.co"></div>
                        <div class="grid grid-2"><img src="{{ asset('site/images/img-grid-2.jpg') }}" alt="Untree.co"></div>
                        <div class="grid grid-3"><img src="{{ asset('site/images/img-grid-3.jpg') }}" alt="Untree.co"></div>
                    </div>
                </div>
                <div class="col-lg-5 ps-lg-5">
                    <h2 class="section-title mb-4">WHOLESALE & RETAIL</h2>
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
                        <a href="javascript:void(0)" 
                            class="btn btn-primary me-2"
                            data-bs-toggle="modal" 
                            data-bs-target="#wholesaleModal">
                            Apply for Wholesale
                        </a>
                        <a href="{{ route('shop.index') }}" class="btn btn-outline-primary">Shop Retail</a>
                    </p>
                </div>
            </div>
        </div>
    </div>
    <!-- End We Help Section -->

    <!-- Start FAQ Section -->
    <section id="faq" class="faq-section py-5">
        <div class="container">

            <div class="text-center mb-5">
                <h2 class="section-title">Frequently Asked Questions</h2>
                <p class="text-muted">
                    Everything you need to know about our heritage flour blends, ordering, and preparation.
                </p>
            </div>

            <div class="accordion" id="faqAccordion">

                <!-- FAQ 1 -->
                <div class="accordion-item mb-3">
                    <h2 class="accordion-header">
                        <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#faq1">
                            What makes MOAT and Milla different from regular flour?
                        </button>
                    </h2>
                    <div id="faq1" class="accordion-collapse collapse show" data-bs-parent="#faqAccordion">
                        <div class="accordion-body">
                            MOAT and Milla are heritage-inspired flour blends developed to provide a smoother texture, better nutrition profile, and easier digestion compared to many modern refined flours. They are carefully formulated to retain more natural nutrients while maintaining excellent cooking performance.
                        </div>
                    </div>
                </div>

                <!-- FAQ 2 -->
                <div class="accordion-item mb-3">
                    <h2 class="accordion-header">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq2">
                            Can I substitute MOAT or Milla in my regular recipes?
                        </button>
                    </h2>
                    <div id="faq2" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                        <div class="accordion-body">
                            Yes. We recommend starting by replacing 25–50% of your usual flour with MOAT or Milla, then adjusting as needed. Because our blends absorb moisture differently, slight adjustments to liquid ratios may be required.
                        </div>
                    </div>
                </div>

                <!-- FAQ 3 -->
                <div class="accordion-item mb-3">
                    <h2 class="accordion-header">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq3">
                            How should I store your flour blends?
                        </button>
                    </h2>
                    <div id="faq3" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                        <div class="accordion-body">
                            Store in an airtight container in a cool, dry place. For extended freshness beyond three months, refrigeration or freezing in a sealed container is recommended.
                        </div>
                    </div>
                </div>

                <!-- FAQ 4 -->
                <div class="accordion-item mb-3">
                    <h2 class="accordion-header">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq4">
                            Are your products suitable for wheat-free diets?
                        </button>
                    </h2>
                    <div id="faq4" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                        <div class="accordion-body">
                            Some of our blends are formulated as wheat-free alternatives. Please check the individual product description for full ingredient details to ensure suitability for your dietary needs.
                        </div>
                    </div>
                </div>

                <!-- FAQ 5 -->
                <div class="accordion-item mb-3">
                    <h2 class="accordion-header">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq5">
                            Do you offer wholesale or bulk pricing?
                        </button>
                    </h2>
                    <div id="faq5" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                        <div class="accordion-body">
                            Yes. We provide wholesale pricing for retailers, catering businesses, and distributors. Please contact us directly to discuss bulk quantities and delivery arrangements.
                        </div>
                    </div>
                </div>

                <!-- FAQ 6 -->
                <div class="accordion-item mb-3">
                    <h2 class="accordion-header">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq6">
                            What is your return policy?
                        </button>
                    </h2>
                    <div id="faq6" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                        <div class="accordion-body">
                            We stand behind the quality of our products. If you are not satisfied with your purchase, please contact us within 30 days and our team will assist you.
                        </div>
                    </div>
                </div>

                <!-- FAQ 7 -->
                <div class="accordion-item mb-3">
                    <h2 class="accordion-header">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq7">
                            How long does shipping take?
                        </button>
                    </h2>
                    <div id="faq7" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                        <div class="accordion-body">
                            Orders are typically processed within 1–2 business days. Delivery times vary depending on location but usually arrive within 3–5 working days.
                        </div>
                    </div>
                </div>

            </div>

            <div class="text-center mt-5">
                <h4 class="mb-3">Still Have Questions?</h4>
                <p class="text-muted mb-4">
                    Our team is happy to help with any questions about our products or your order.
                </p>
                <a href="{{ route('contact') }}" class="btn btn-primary px-4">Contact Us</a>
            </div>

        </div>
    </section>
    <!-- End FAQ Section -->

    <!-- Start Blog Section -->
    <div class="blog-section">
        <div class="container">
            <div class="row mb-5">
                <div class="col-md-6">
                    <h2 class="section-title">Recipes & Wellness Stories</h2>
                </div>
                <div class="col-md-6 text-start text-md-end">
                    <a href="#" class="more">View All Posts</a>
                </div>
            </div>

            <div class="row">

                @forelse($posts as $post)
                    <div class="col-12 col-sm-6 col-md-4 mb-4">
                        <div class="post-entry">
                            
                            <a href="{{ route('blog.show', $post->slug) }}" class="post-thumbnail">
                                <img src="{{ asset('public/' . ($post->feature_image ?? 'post-1.jpg')) }}" 
                                    alt="{{ $post->title }}" 
                                    class="img-fluid">
                            </a>

                            <div class="post-content-entry">
                                <h3>
                                    <a href="{{ route('blog.show', $post->slug) }}">
                                        {{ $post->title }}
                                    </a>
                                </h3>

                                <p class="text-muted">
                                    {{ \Illuminate\Support\Str::limit($post->excerpt, 100) }}
                                </p>
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
    <!-- End Blog Section -->	



    <!-- Wholesale Modal -->
    <div class="modal fade" id="wholesaleModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content rounded-4 border-0">

                <div class="modal-header border-0 pb-0">
                    <h3 class="modal-title fw-bold">Request Wholesale Information</h3>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body p-4 p-lg-5">

                    <p class="text-muted mb-4">
                        Fill out the form below and our wholesale team will contact you within 24 hours.
                    </p>

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
                            <button type="submit" class="btn btn-primary px-5 py-2">
                                Submit Wholesale Inquiry
                            </button>
                        </div>

                    </form>

                </div>
            </div>
        </div>
    </div>
    
    @auth
    <script>
        $(document).ready(function() {

            // Add to cart from modal
            $('.add-to-cart-modal').click(function() {
                var productId = $(this).data('id');
                var quantity = $('#modalQuantity' + productId).val();
                var variation = $('#modalVariation' + productId).length ? $('#modalVariation' + productId).val() : null;

                addToCart(productId, quantity, variation);
            });

            function addToCart(productId, quantity, variation = null) {
                $.ajax({
                    url: "{{ url('cart/add') }}/" + productId,
                    type: "POST",
                    data: {
                        _token: "{{ csrf_token() }}",
                        quantity: quantity,
                        variation: variation
                    },
                    success: function(response) {
                        alert(response.message);
                        if(response.cart_count !== undefined){
                            if($('#cart-count').length){
                                $('#cart-count').text(response.cart_count);
                            } else {
                                $('.nav-link[href="{{ route('cart.index') }}"]').append(
                                    '<span id="cart-count" class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">'
                                    + response.cart_count +
                                    '</span>'
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

            // Update modal price when variation changes
            @foreach($latestProducts as $item)
                $('#modalVariation{{ $item->id }}').on('change', function() {
                    var selected = $(this).find(':selected');
                    var price = selected.data('price');
                    $('#modalPrice{{ $item->id }}').text('£' + parseFloat(price).toFixed(2));
                });
            @endforeach

        });
    </script>
    @endauth


    <style>
        .promotion-banner .banner-content {
            background: linear-gradient(to right, #fff8f0, #f0e6d6);
            box-shadow: 0 4px 15px rgba(0,0,0,0.1);
            position: relative;
        }
        .promotion-banner img,
        .promotion-banner video {
            max-width: 100%;
            margin-top: 15px;
        }

        /* Category buttons */
        .category-btn {
            background-color: #8b670b; /* your primary button color */
            color: #fff;
            border: none;
            padding: 10px 25px;
            margin: 5px;
            border-radius: 25px;
            font-weight: 500;
            cursor: pointer;
            transition: 0.3s;
        }

        .category-btn:hover {
            background-color: #a07c23; /* slightly lighter shade on hover */
        }

        .category-btn.active {
            background-color: #d4af37; /* highlight active category */
            color: #000;
        }

        /* Make all tab panes position absolute and fade in/out */
        .tab-pane {
            opacity: 0;
            transform: translateY(20px); /* slide up on show */
            transition: opacity 0.4s ease, transform 0.4s ease;
            display: none; /* hide by default */
        }

        /* Show active tab with fade + slide */
        .tab-pane.show.active {
            opacity: 1;
            transform: translateY(0);
            display: block;
        }

        .image-wrapper {
            position: relative;
            overflow: hidden;
            border-radius: 8px
        }

        /* Blur effect */
        .blurred {
            filter: blur(4px);
            transform: scale(1.05);
        }

        /* Overlay */
        .product-overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.45);
        }

        /* Lock icon styling */
        .lock-icon {
            font-size: 40px;
            color: #ffffff;
        }
    </style>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const buttons = document.querySelectorAll('.category-btn');
            const tabs = document.querySelectorAll('.tab-pane');

            buttons.forEach(btn => {
                btn.addEventListener('click', function() {
                    // Remove active from all buttons
                    buttons.forEach(b => b.classList.remove('active'));
                    this.classList.add('active');

                    // Hide all tab panes
                    tabs.forEach(tab => tab.classList.remove('show', 'active'));

                    // Show selected tab
                    const target = document.querySelector(this.getAttribute('data-bs-target'));
                    target.classList.add('show', 'active');
                });
            });
        });
    </script>
@endsection