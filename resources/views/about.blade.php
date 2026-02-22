@extends('layouts.site')

@section('content')
    <!-- Start Hero Section -->
        <div class="hero">
            <div class="container">
                <div class="row justify-content-between">
                    <div class="col-lg-5">
                        <div class="intro-excerpt">
                            <h1>About Hargrio Limited</h1>
                            <p class="mb-4">
                                Hargrio Limited is a UK-based food manufacturing and food services company
                                specialising in heritage and alternative grain products. We develop nutritious,
                                wheat-free flour blends and staple foods designed for both traditional and
                                modern cooking.
                            </p>
                            <p>
                                <a href="shop.html" class="btn btn-secondary me-2">Shop Products</a>
                                <a href="contact.html" class="btn btn-white-outline">Partner With Us</a>
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
                    <h2 class="section-title mb-4">Who We Are</h2>
                    <p>
                    Hargrio Limited is a food innovation company focused on transforming
                    under-commercialised heritage and alternative grains into high-quality,
                    easy-to-prepare staple food products. Our flour blends are carefully
                    developed to be wheat-free, nutritious and culturally relevant,
                    serving households, retailers and catering businesses across the UK.
                    </p>
                    <p>
                    In addition to manufacturing, Hargrio operates cooking and food
                    demonstration activities that showcase practical preparation methods,
                    helping customers understand and confidently use our products.
                    </p>
                </div>
            </div>
        </div>
    </div>
    <!-- End We Help Section -->

    <div class="section bg-light">
        <div class="container">
            <div class="row">

                <div class="col-lg-6 mb-4 mt-4">
                    <h2 class="section-title">Our Mission</h2>
                    <p>
                    To develop and supply nutritious heritage and alternative grain food
                    products that make healthy staple foods accessible, convenient and
                    culturally relevant for modern consumers. We aim to transform
                    under-commercialised grains into high-quality, wheat-free and
                    easy-to-prepare products while supporting customer understanding
                    through practical food preparation and cooking activities.
                    </p>
                </div>

                <div class="col-lg-6 mb-4 mt-4">
                    <h2 class="section-title">Our Vision</h2>
                    <p>
                    To become a leading heritage grain food brand recognised for adapting
                    traditional staple foods to modern lifestyles and wider markets.
                    Hargrio seeks to build a trusted and scalable brand that connects
                    cultural food heritage with innovation, supports healthier eating,
                    and increases the commercial value of alternative grains across the UK
                    and internationally.
                    </p>
                </div>

            </div>
        </div>
    </div>
    

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
@endsection