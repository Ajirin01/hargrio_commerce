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
                            <a href="shop.html" class="btn btn-secondary me-2">Explore Flour Blends</a>
                            <a href="about.html" class="btn btn-white-outline">Our Story</a>
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

                <!-- Start Column 1 -->
                <div class="col-md-12 col-lg-3 mb-5 mb-lg-0">
                    <h2 class="mb-4 section-title">Flour Blend Series</h2>
                    <p class="mb-4">
                        Our Flour Blend Series introduces carefully developed heritage grain mixes
                        designed for smooth texture, balanced nutrition and easy preparation.
                        Suitable for swallow, stiff porridge, puree and drink applications.
                    </p>
                    <p><a href="shop.html" class="btn">View Products</a></p>

                </div> 
                <!-- End Column 1 -->

                @foreach ($latestProducts as $item)
                    <div class="col-12 col-md-4 col-lg-3 mb-5 mb-md-10">
                        <a class="product-item" href="javascript:void(0);">
                            <img src="{{ asset('site/images/product-1.png') }}" class="img-fluid product-thumbnail">
                            <h3 class="product-title">{{ $item->name }}</h3>
                            <strong class="product-price">From £{{ $item->price }}</strong>

                            <span class="icon-cross add-to-cart" data-id="{{ $item->id }}">
                                <img src="{{ asset('site/images/cross.svg') }}" class="img-fluid">
                            </span>
                        </a>
                    </div>
                @endforeach



                <!-- Start Column 2 -->
                {{-- <div class="col-12 col-md-4 col-lg-3 mb-5 mb-md-0">
                    <a class="product-item" href="cart.html">
                        <img src="{{ asset('site/images/product-1.png') }}" class="img-fluid product-thumbnail">
                        <h3 class="product-title">Milla</h3>
                        <strong class="product-price">From £3.99</strong>


                        <span class="icon-cross">
                            <img src="{{ asset('site/images/cross.svg') }}" class="img-fluid">
                        </span>
                    </a>
                </div>  --}}
                <!-- End Column 2 -->

                <!-- Start Column 3 -->
                {{-- <div class="col-12 col-md-4 col-lg-3 mb-5 mb-md-0">
                    <a class="product-item" href="cart.html">
                        <img src="{{ asset('site/images/product-2.png') }}" class="img-fluid product-thumbnail">
                        <h3 class="product-title">MOAT</h3>
                        <strong class="product-price">From £2.45</strong>


                        <span class="icon-cross">
                            <img src="{{ asset('site/images/cross.svg') }}" class="img-fluid">
                        </span>
                    </a>
                </div> --}}
                <!-- End Column 3 -->

                <!-- Start Column 4 -->
                {{-- <div class="col-12 col-md-4 col-lg-3 mb-5 mb-md-0">
                    <a class="product-item" href="cart.html">
                        <img src="{{ asset('site/images/product-3.png') }}" class="img-fluid product-thumbnail">
                        <h3 class="product-title">NutriCore</h3>
                        <strong class="product-price">Available Soon</strong>


                        <span class="icon-cross">
                            <img src="{{ asset('site/images/cross.svg') }}" class="img-fluid">
                        </span>
                    </a>
                </div> --}}
                <!-- End Column 4 -->

            </div>
        </div>
    </div>
    <!-- End Product Section -->

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
                        <a href="wholesale.html" class="btn btn-primary me-2">Apply for Wholesale</a>
                        <a href="shop.html" class="btn btn-outline-primary">Shop Retail</a>
                    </p>
                </div>
            </div>
        </div>
    </div>
    <!-- End We Help Section -->

    <!-- Start Testimonial Slider -->
    <div class="testimonial-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-7 mx-auto text-center">
                    <h2 class="section-title">Customer Feedback</h2>
                </div>
            </div>

            <div class="row justify-content-center">
                <div class="col-lg-12">
                    <div class="testimonial-slider-wrap text-center">

                        <div id="testimonial-nav">
                            <span class="prev" data-controls="prev"><span class="fa fa-chevron-left"></span></span>
                            <span class="next" data-controls="next"><span class="fa fa-chevron-right"></span></span>
                        </div>

                        <div class="testimonial-slider">
                            
                            <div class="item">
                                <div class="row justify-content-center">
                                    <div class="col-lg-8 mx-auto">

                                        <div class="testimonial-block text-center">
                                            <blockquote class="mb-5">
                                                <p>&ldquo;Milla gives a smooth texture similar to traditional amala but feels lighter and more nutritious.&rdquo;</p>
                                            </blockquote>

                                            <div class="author-info">
                                                <div class="author-pic">
                                                    <img src="{{ asset('site/images/person-1.png') }}" alt="Maria Jones" class="img-fluid">
                                                </div>
                                                <h3 class="font-weight-bold">Maria Jones</h3>
                                                <span class="position d-block mb-3">Retail Customer, London</span>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div> 
                            <!-- END item -->

                            <div class="item">
                                <div class="row justify-content-center">
                                    <div class="col-lg-8 mx-auto">

                                        <div class="testimonial-block text-center">
                                            <blockquote class="mb-5">
                                                <p>&ldquo;MOAT works well for both swallow and blended drinks. Easy to prepare and very filling.&rdquo;</p>
                                            </blockquote>

                                            <div class="author-info">
                                                <div class="author-pic">
                                                    <img src="{{ asset('site/images/person-1.png') }}" alt="Maria Jones" class="img-fluid">
                                                </div>
                                                <h3 class="font-weight-bold">Maria Jones</h3>
                                                <span class="position d-block mb-3">Catering Business Owner</span>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div> 
                            <!-- END item -->

                            <div class="item">
                                <div class="row justify-content-center">
                                    <div class="col-lg-8 mx-auto">

                                        <div class="testimonial-block text-center">
                                            <blockquote class="mb-5">
                                                <p>&ldquo;Great option for customers looking for wheat-free alternatives.&rdquo;</p>
                                            </blockquote>

                                            <div class="author-info">
                                                <div class="author-pic">
                                                    <img src="{{ asset('site/images/person-1.png') }}" alt="Maria Jones" class="img-fluid">
                                                </div>
                                                <h3 class="font-weight-bold">Maria Jones</h3>
                                                <span class="position d-block mb-3">Community Shopper</span>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div> 
                            <!-- END item -->

                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Testimonial Slider -->

    <!-- Start Blog Section -->
    <div class="blog-section">
        <div class="container">
            <div class="row mb-5">
                <div class="col-md-6">
                    <h2 class="section-title">Insights & Education</h2>
                </div>
                <div class="col-md-6 text-start text-md-end">
                    <a href="#" class="more">View All Posts</a>
                </div>
            </div>

            <div class="row">

                <div class="col-12 col-sm-6 col-md-4 mb-4 mb-md-0">
                    <div class="post-entry">
                        <a href="#" class="post-thumbnail"><img src="{{ asset('site/images/post-1.jpg') }}" alt="Image" class="img-fluid"></a>
                        <div class="post-content-entry">
                            <h3><a href="#">Understanding Heritage Grains in Modern Diets</a></h3>
                            <!-- <div class="meta">
                                <span>by <a href="#">Kristin Watson</a></span> <span>on <a href="#">Dec 19, 2021</a></span>
                            </div> -->
                        </div>
                    </div>
                </div>

                <div class="col-12 col-sm-6 col-md-4 mb-4 mb-md-0">
                    <div class="post-entry">
                        <a href="#" class="post-thumbnail"><img src="{{ asset('site/images/post-2.jpg') }}" alt="Image" class="img-fluid"></a>
                        <div class="post-content-entry">
                            <h3><a href="#">Wheat-Free Alternatives for Everyday Cooking</a></h3>
                            <!-- <div class="meta">
                                <span>by <a href="#">Robert Fox</a></span> <span>on <a href="#">Dec 15, 2021</a></span>
                            </div> -->
                        </div>
                    </div>
                </div>

                <div class="col-12 col-sm-6 col-md-4 mb-4 mb-md-0">
                    <div class="post-entry">
                        <a href="#" class="post-thumbnail"><img src="{{ asset('site/images/post-3.jpg') }}" alt="Image" class="img-fluid"></a>
                        <div class="post-content-entry">
                            <h3><a href="#">Preparing Smooth Swallow with Hargrio Heritage Grain Blends</a></h3>
                            <!-- <div class="meta">
                                <span>by <a href="#">Kristin Watson</a></span> <span>on <a href="#">Dec 12, 2021</a></span>
                            </div> -->
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <!-- End Blog Section -->	
    
    <script>
        $(document).ready(function() {
            $('.add-to-cart').click(function() {
                var productId = $(this).data('id');

                $.ajax({
                    url: "/cart/add/" + productId,
                    type: "POST",
                    data: {
                        _token: "{{ csrf_token() }}",
                        quantity: 1
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

                        // If user is not logged in (Laravel returns 401 or 302)
                        if (xhr.status === 401 || xhr.status === 419) {
                            window.location.href = "{{ route('login') }}";
                        } else {
                            alert('Error adding product to cart.');
                        }
                    }
                });
            });
        });
    </script>


@endsection