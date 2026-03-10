@extends('layouts.site')
@section('content')

{{-- ========= HERO ========= --}}
<section class="hero-v2 position-relative d-flex align-items-center overflow-hidden" style="min-height: 95vh;">

    {{-- ─── Background Image (bokeh grains) ─── --}}
    <img
        src="{{ asset('site/images/hero-grains-bokeh.png') }}"
        alt="Organic ancient grains in warm sunlight"
        class="hero-v2__bg-img"
        style="position:absolute;inset:0;width:100%;height:100%;object-fit:cover;z-index:0;">

    {{-- ─── Layered Gradient Overlay (Z-pattern: top-left dark → mid transparent → bottom-right darker) ─── --}}
    <div class="hero-v2__overlay" style="
        position:absolute;inset:0;z-index:1;
        background:
            linear-gradient(135deg,
                rgba(27, 24, 23, 0.88) 0%,
                rgba(44, 34, 31, 0.55) 40%,
                rgba(92,71,66,0.30) 65%,
                rgba(30,18,14,0.72) 100%
            );
    "></div>

    {{-- ─── Subtle warm-vignette ring ─── --}}
    <div style="position:absolute;inset:0;z-index:1;
        background: radial-gradient(ellipse at center, transparent 50%, rgba(30,18,14,0.45) 100%);
        pointer-events:none;"></div>

    {{-- ─── Noise grain texture overlay ─── --}}
    <div style="position:absolute;inset:0;z-index:1;
        background-image:url(&quot;data:image/svg+xml,%3Csvg viewBox='0 0 200 200' xmlns='http://www.w3.org/2000/svg'%3E%3Cfilter id='n'%3E%3CfeTurbulence type='fractalNoise' baseFrequency='0.75' numOctaves='4' stitchTiles='stitch'/%3E%3C/filter%3E%3Crect width='100%25' height='100%25' filter='url(%23n)'/%3E%3C/svg%3E&quot;);
        opacity:0.04;pointer-events:none;"></div>

    {{-- ─── Main Content ─── --}}
    <div class="container position-relative" style="z-index:3;">
        <div class="row align-items-center g-5">

            {{-- ════ LEFT COLUMN (Z-pattern: top-left → eyes start here) ════ --}}
            <div class="col-lg-7">

                {{-- ── Trust Badge (step 1 of Z) ── --}}
                <div class="hero-v2__trust-bar d-inline-flex align-items-center gap-2 mb-5"
                     style="
                        background:rgba(255,255,255,0.10);
                        backdrop-filter:blur(12px);-webkit-backdrop-filter:blur(12px);
                        border:1px solid rgba(255,255,255,0.18);
                        border-radius:50px;
                        padding:8px 18px 8px 8px;
                        animation: heroFadeUp 0.7s ease both;
                     ">
                    {{-- Three coloured circle icons --}}
                    <div class="d-flex align-items-center gap-1 me-1">
                        <span style="width:26px;height:26px;border-radius:50%;background:#9EBA9B;display:inline-flex;align-items:center;justify-content:center;">
                            <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="#fff" stroke-width="2.5"><path d="M12 2L2 7l10 5 10-5-10-5zM2 17l10 5 10-5M2 12l10 5 10-5"/></svg>
                        </span>
                        <span style="width:26px;height:26px;border-radius:50%;background:#F2E6D8;display:inline-flex;align-items:center;justify-content:center;">
                            <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="#5C4742" stroke-width="2.5"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg>
                        </span>
                        <span style="width:26px;height:26px;border-radius:50%;background:#5C4742;display:inline-flex;align-items:center;justify-content:center;">
                            <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="#F2E6D8" stroke-width="2.5"><path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"/></svg>
                        </span>
                    </div>
                    <span style="font-size:0.72rem;font-weight:700;letter-spacing:1.5px;text-transform:uppercase;color:#fff;opacity:0.92;">
                        10,000+ Families Nourished Naturally
                    </span>
                </div>

                {{-- ── Primary Headline (step 2 of Z – bold, high contrast) ── --}}
                <h1 class="hero-v2__headline text-white text-uppercase mb-0"
                    style="
                        font-family:'Montserrat',sans-serif;
                        font-size:clamp(3.2rem,6.5vw,5.5rem);
                        font-weight:900;
                        line-height:0.9;
                        letter-spacing:-1px;
                        animation: heroFadeUp 0.7s 0.15s ease both;
                    ">
                    Ancient<br>Grains
                </h1>

                {{-- ── Secondary / Italic Sub-headline ── --}}
                <h2 class="hero-v2__sub-headline mb-5"
                    style="
                        font-family:'Montserrat',sans-serif;
                        font-size:clamp(1.8rem,3.5vw,3rem);
                        font-weight:300;
                        font-style:italic;
                        color:rgba(242,230,216,0.92);
                        line-height:1.2;
                        margin-top:0.4rem;
                        animation: heroFadeUp 0.7s 0.28s ease both;
                    ">
                    Modern Wellness
                </h2>

                {{-- ── CTA Button (Deep Chocolate, rounded pill) ── --}}
                <div style="animation: heroFadeUp 0.7s 0.42s ease both;">
                    <a href="{{ route('shop.index') }}"
                       class="hero-v2__cta d-inline-flex align-items-center gap-2 fw-bold rounded-pill"
                       style="
                           background:#5C4742;
                           color:#fff;
                           padding:15px 36px;
                           font-family:'Montserrat',sans-serif;
                           font-size:0.95rem;
                           font-weight:700;
                           letter-spacing:0.5px;
                           text-decoration:none;
                           border:2px solid rgba(255,255,255,0.15);
                           transition:background 0.3s,transform 0.3s,box-shadow 0.3s;
                           box-shadow:0 10px 30px rgba(92,71,66,0.5);
                       "
                       onmouseover="this.style.background='#7a5f58';this.style.transform='translateY(-2px)';this.style.boxShadow='0 16px 40px rgba(92,71,66,0.55)';"
                       onmouseout="this.style.background='#5C4742';this.style.transform='';this.style.boxShadow='0 10px 30px rgba(92,71,66,0.5)';">
                        Explore Our Blends
                        <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
                    </a>
                </div>

            </div>{{-- /left column --}}

            {{-- ════ RIGHT COLUMN (Z-pattern: eyes land here last) ════ --}}
            <div class="col-lg-5 d-flex justify-content-end">

                {{-- ── Glassmorphism Description Box ── --}}
                <div class="hero-v2__glass"
                     style="
                        background:rgba(255,255,255,0.08);
                        backdrop-filter:blur(28px);-webkit-backdrop-filter:blur(28px);
                        border:1px solid rgba(255,255,255,0.20);
                        border-radius:20px;
                        padding:2.5rem 2.75rem;
                        max-width:420px;
                        box-shadow:0 40px 80px rgba(0,0,0,0.25),0 0 0 1px rgba(255,255,255,0.04);
                        animation: heroFadeUp 0.7s 0.35s ease both;
                     ">
                    {{-- small accent label --}}
                    <div class="mb-3 d-flex align-items-center gap-2">
                        <span style="display:inline-block;width:28px;height:2px;background:#9EBA9B;border-radius:2px;"></span>
                        <span style="font-size:0.7rem;font-weight:700;letter-spacing:2px;text-transform:uppercase;color:#9EBA9B;">Since 1875</span>
                    </div>

                    <p style="font-family:'Montserrat',sans-serif;font-size:1.05rem;line-height:1.85;font-weight:300;color:rgba(255,255,255,0.95);margin:0 0 1.5rem;">
                        For over 150 years, we've been crafting premium flour blends from seven ancient grains — bringing the wisdom of traditional stone milling to modern kitchens worldwide.
                    </p>

                    <p style="font-family:'Montserrat',sans-serif;font-size:0.95rem;line-height:1.75;font-weight:300;color:rgba(242,230,216,0.75);margin:0;">
                        Each batch is slow-ground to preserve maximum nutrition, natural flavour, and the heritage of sustainable farming passed down through generations.
                    </p>

                    {{-- Divider + stats row --}}
                    <div class="mt-4 pt-4 d-flex gap-4" style="border-top:1px solid rgba(255,255,255,0.12);">
                        <div class="text-center">
                            <div style="font-family:'Montserrat',sans-serif;font-size:1.6rem;font-weight:800;color:#F2E6D8;line-height:1;">150+</div>
                            <div style="font-size:0.65rem;letter-spacing:1.5px;text-transform:uppercase;color:rgba(255,255,255,0.55);margin-top:3px;">Years Heritage</div>
                        </div>
                        <div style="width:1px;background:rgba(255,255,255,0.12);"></div>
                        <div class="text-center">
                            <div style="font-family:'Montserrat',sans-serif;font-size:1.6rem;font-weight:800;color:#F2E6D8;line-height:1;">7</div>
                            <div style="font-size:0.65rem;letter-spacing:1.5px;text-transform:uppercase;color:rgba(255,255,255,0.55);margin-top:3px;">Ancient Grains</div>
                        </div>
                        <div style="width:1px;background:rgba(255,255,255,0.12);"></div>
                        <div class="text-center">
                            <div style="font-family:'Montserrat',sans-serif;font-size:1.6rem;font-weight:800;color:#F2E6D8;line-height:1;">100%</div>
                            <div style="font-size:0.65rem;letter-spacing:1.5px;text-transform:uppercase;color:rgba(255,255,255,0.55);margin-top:3px;">Organic</div>
                        </div>
                    </div>
                </div>

            </div>{{-- /right column --}}

        </div>{{-- /row --}}
    </div>{{-- /container --}}

    {{-- ─── Scroll hint arrow ─── --}}
    <div style="position:absolute;bottom:2rem;left:50%;transform:translateX(-50%);z-index:3;opacity:0.6;animation:scrollBounce 2s infinite;">
        <svg width="24" height="24" fill="none" stroke="#fff" stroke-width="2" viewBox="0 0 24 24"><path d="M6 9l6 6 6-6"/></svg>
    </div>

    {{-- ─── Hero-specific inline styles & keyframes ─── --}}
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,300;0,700;0,900;1,300&display=swap');

        @keyframes heroFadeUp {
            from { opacity:0; transform:translateY(28px); }
            to   { opacity:1; transform:translateY(0); }
        }
        @keyframes scrollBounce {
            0%,100% { transform:translateX(-50%) translateY(0); }
            50%      { transform:translateX(-50%) translateY(8px); }
        }

        .hero-v2__bg-img { filter: brightness(0.9); }

        /* Ensure glassmorphism box stacks well on mobile */
        @media (max-width: 991.98px) {
            .hero-v2 { min-height: auto !important; padding: 7rem 0 4rem; }
            .hero-v2__glass { max-width: 100% !important; }
            .hero-v2__headline { font-size: 3rem !important; }
            .hero-v2__sub-headline { font-size: 1.8rem !important; }
        }
    </style>

</section>

{{-- ========= OUR STORY (HERITAGE) ========= --}}
<div class="our-story-section py-5 border-bottom" style="background: var(--bg-cream);" id="our-story">
    <div class="container py-lg-5">
        <div class="row align-items-center">
            
            {{-- Left Column: Vertical Image --}}
            <div class="col-lg-5 mb-5 mb-lg-0 scroll-reveal">
                <div class="position-relative">
                    <img src="{{ asset('site/images/our-story.png') }}" alt="Traditional Milling" class="img-fluid rounded-lg shadow-lg" style="min-height: 600px; object-fit: cover;">
                    <div class="position-absolute bottom-0 start-0 bg-white p-4 rounded-end-4 shadow" style="max-width: 250px;">
                        <span class="display-4 fw-bold font-serif" style="color: var(--brand-primary);">150+</span>
                        <p class="mb-0 small text-muted text-uppercase fw-bold ls-1">Years of Milling Expertise</p>
                    </div>
                </div>
            </div>
            
            {{-- Right Column: Story Text --}}
            <div class="col-lg-6 offset-lg-1 scroll-reveal" style="--reveal-delay: 200ms">
                <h5 class="text-uppercase mb-3" style="color: var(--brand-secondary); letter-spacing: 3px; font-size: 0.8rem; font-weight: 700;">PRESERVING TRADITION NATURALLY</h5>
                <h2 class="display-3 font-serif mb-4" style="color: var(--brand-primary); line-height: 1.1;">
                    Our Story Began<br>
                    <span class="fst-italic fw-normal">In Ancient Fields</span>
                </h2>
                
                <div class="story-content mb-5" style="font-size: 1.1rem; color: #555; line-height: 1.8;">
                    <p class="mb-4">
                        In 1875, our great-great-grandfather built the first mill on the banks of a crystal-clear river, powered by water wheels and driven by a passion for preserving ancient grain varieties. What started as a small family operation has grown into a mission to bring nutrient-dense, heritage flour blends to health-conscious families worldwide.
                    </p>
                    <p>
                        Today, we continue his legacy by sourcing seven ancient grain varieties from sustainable farms, stone-grinding them using traditional methods, and creating flour blends that honor both the past and the future. Every bag carries 150 years of milling expertise and a commitment to your family's wellness.
                    </p>
                </div>
                
                <a href="{{ route('about') }}" class="btn btn-primary px-5 py-3 rounded-pill fw-bold" style="background-color: var(--brand-primary); border-color: var(--brand-primary); color: #fff;">
                    Discover Our Heritage <i class="fas fa-arrow-right ms-2"></i>
                </a>
            </div>
            
        </div>
    </div>
</div>


{{-- ========= PRODUCT SECTION ========= --}}
<div class="product-section bg-white pt-5">
    <div class="container">
        <div class="row text-center scroll-reveal">
            <div class="col-12" style="max-width: 800px; margin: 0 auto;">
                <div class="d-inline-flex align-items-center mb-3" style="color: #79a175; font-size: 0.85rem; font-weight: 600; font-family: var(--font-family-sans-alt); letter-spacing: 1px; text-transform: uppercase;">
                    <svg class="me-2" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="3" width="18" height="18" rx="2" ry="2"></rect><line x1="3" y1="9" x2="21" y2="9"></line><line x1="9" y1="21" x2="9" y2="9"></line></svg>
                    OUR COLLECTION IN 3 PHASES
                </div>
                <h2 class="display-4 fw-bold mb-4" style="color: #0b1528; line-height: 1.1; font-family: var(--font-family-sans-alt);">
                    Crafted from<br>
                    <span style="color: #79a175;">Several Ancient Grains</span>
                </h2>
                <p class="text-muted" style="font-size: 1.1rem; line-height: 1.7; color: #5c6270 !important;">
                    Each blend is carefully formulated to bring out the unique flavors and nutritional benefits of heritage grains, stone-ground to perfection using time-honored milling techniques.
                </p>
            </div>
        </div>

        <div class="row justify-content-center">

            @foreach ($latestProducts as $item)
                @php 
                    $isComingSoon = empty($item->price) || !$item->available || ($item->category && $item->category->status === 'inactive'); 
                @endphp
                <div class="col-12 col-md-4 col-lg-3 mb-5 mb-md-10 scroll-reveal" style="--reveal-delay: {{ $loop->index * 120 }}ms">
                    <div class="product-item rounded p-4 h-100 d-flex flex-column align-items-center position-relative" style="background: var(--brand-light); border: 1px solid #eaeaea; overflow: hidden;">
                        
                        @if($isComingSoon)
                            <!-- Dark Overlay for Coming Soon -->
                            <div class="position-absolute w-100 h-100 top-0 start-0 d-flex flex-column align-items-center justify-content-center" style="background: rgba(0,0,0,0.55); backdrop-filter: blur(2px); cursor: not-allowed; z-index: 10;">
                                <svg width="50" height="50" viewBox="0 0 24 24" fill="none" stroke="#ffffff" stroke-width="2" style="margin-bottom: 15px;"><rect x="3" y="11" width="18" height="11" rx="2" ry="2"></rect><path d="M7 11V7a5 5 0 0 1 10 0v4"></path></svg>
                                <h4 class="text-white fw-bold m-0" style="font-family: var(--font-family-sans-alt);">Coming Soon</h4>
                            </div>
                        @endif

                        <a href="{{ $isComingSoon ? 'javascript:void(0);' : route('product.show', $item->id) }}" class="mb-4 overflow-hidden rounded-circle" style="width: 200px; height: 200px; display: block;">
                            <img src="{{ asset('public/uploads/' . ($item->image ?? 'product-1.png')) }}"
                                class="img-fluid product-thumbnail w-100 h-100" style="object-fit: cover; border-radius: 0; box-shadow: none;">
                        </a>
                        <a href="{{ $isComingSoon ? 'javascript:void(0);' : route('product.show', $item->id) }}" class="text-decoration-none text-center">
                            <h3 class="product-title font-serif">{{ $item->name }}</h3>
                        </a>
                        <p class="text-muted small text-center px-2 mb-4 flex-grow-1">{{ \Illuminate\Support\Str::limit($item->short_description ?? 'Premium stone-ground flour naturally rich in nutrients.', 60) }}</p>

                        <div class="mt-auto w-100 text-center">
                            @if(!$isComingSoon)
                                <strong class="product-price d-block mb-3" style="font-size: 1.25rem;">£{{ number_format($item->price, 2) }}</strong>
                                <button class="btn btn-outline-primary btn-sm rounded-pill px-4" data-bs-toggle="modal" data-bs-target="#productModal{{ $item->id }}">Learn More</button>
                            @else
                                <strong class="product-price d-block mb-3 text-muted">Available Soon</strong>
                                <a href="{{ route('contact') }}" class="btn btn-outline-secondary btn-sm rounded-pill px-4" style="font-family: var(--font-family-sans-alt);">Notify Me</a>
                            @endif
                        </div>
                        <span class="icon-cross d-none"></span>
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
                                                <p class="price display-6 fw-bold" style="color: var(--brand-secondary);" id="modalPrice{{ $item->id }}">
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
    @foreach($otherCategories as $index => $category)
    <div class="product-section py-5 {{ $index % 2 == 0 ? 'bg-white' : '' }}" {!! $index % 2 != 0 ? 'style="background: var(--bg-choc);"' : '' !!}>
        <div class="container py-4">
            <div class="row mb-5 text-center scroll-reveal">
                @php
                    $isCategoryComingSoon = $category->status === 'inactive' || ($category->products->count() > 0 && $category->products->filter(function($p) { return empty($p->price) || !$p->available; })->count() == $category->products->count());
                @endphp
                <div class="col-12 z-1">
                    <div class="d-inline-flex align-items-center mb-4 px-4 py-2 rounded-pill" style="background: rgba(245,245,245,0.7); border: 1px solid rgba(0,0,0,0.05); box-shadow: 0 4px 15px rgba(0,0,0,0.02);">
                        <svg class="me-2" width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" style="color: #9da3ad;"><path d="M11 2v9a2 2 0 0 1-2 2H6m5-11v11a2 2 0 0 1-2 2H6m5-13V2"/><path d="M18 21v-4a2 2 0 0 0-2-2h-2v6h4z"/><path d="M16 15V2.5A.5.5 0 0 0 15.5 2H14"/></svg>
                        <span class="fw-bold fs-4 ms-1" style="color: #8c929a; font-family: var(--font-family-sans-alt);">{{ $category->name }}</span>
                        @if($isCategoryComingSoon)
                            <span class="badge rounded-pill ms-3 bg-opacity-75" style="background-color: #79a175; font-size: 0.8rem; font-family: var(--font-family-sans-alt); padding: 0.5rem 0.9rem;">Coming Soon</span>
                        @endif
                    </div>
                </div>
            </div>
            
            <div class="row justify-content-center">
                @forelse ($category->products as $item)
                    @php $isComingSoon = empty($item->price) || !$item->available || $category->status === 'inactive'; @endphp
                    <div class="col-12 col-md-4 col-lg-3 mb-5 mb-md-10 scroll-reveal" style="--reveal-delay: {{ $loop->index * 120 }}ms">
                        <div class="product-item rounded-lg p-0 h-100 d-flex flex-column position-relative" style="background: #fff; border: 1px solid rgba(0,0,0,0.05); box-shadow: 0 10px 30px rgba(0,0,0,0.03); overflow: hidden;">
                            
                            @if($isComingSoon)
                                <!-- Dark Overlay for Coming Soon -->
                                <div class="position-absolute w-100 h-100 top-0 start-0 d-flex flex-column align-items-center justify-content-center" style="background: rgba(0,0,0,0.55); backdrop-filter: blur(2px); cursor: not-allowed; z-index: 10;">
                                    <svg width="50" height="50" viewBox="0 0 24 24" fill="none" stroke="#ffffff" stroke-width="2" style="margin-bottom: 15px;"><rect x="3" y="11" width="18" height="11" rx="2" ry="2"></rect><path d="M7 11V7a5 5 0 0 1 10 0v4"></path></svg>
                                    <h4 class="text-white fw-bold m-0" style="font-family: var(--font-family-sans-alt);">Coming Soon</h4>
                                </div>
                            @endif

                            <div class="image-wrapper position-relative w-100" style="padding-top: 100%;">
                                <a href="{{ $isComingSoon ? 'javascript:void(0);' : route('product.show', $item->id) }}" class="position-absolute top-0 start-0 w-100 h-100">
                                    <img src="{{ asset('public/uploads/' . ($item->image ?? 'product-1.png')) }}"
                                        class="img-fluid w-100 h-100" style="object-fit:cover;">
                                </a>
                                @if(!$isComingSoon && isset($item->is_new) && $item->is_new)
                                    <div class="position-absolute top-0 start-0 m-3 px-3 py-1 bg-white rounded-pill text-uppercase fw-bold z-2" style="font-size: 0.7rem; letter-spacing: 1px; color: var(--brand-primary); box-shadow: 0 5px 15px rgba(0,0,0,0.1);">New</div>
                                @endif
                            </div>

                            <div class="p-4 d-flex flex-column flex-grow-1 text-center <?php echo $isComingSoon ? 'opacity-50' : ''; ?>">
                                <a href="{{ $isComingSoon ? 'javascript:void(0);' : route('product.show', $item->id) }}" class="text-decoration-none">
                                    <h3 class="product-title font-serif mb-2" style="font-size: 1.5rem; color: var(--brand-primary);">{{ $item->name }}</h3>
                                </a>
                                <p class="text-muted small mt-2 mb-4 flex-grow-1" style="line-height: 1.6;">{{ \Illuminate\Support\Str::limit($item->short_description ?? 'Authentic heritage grains stone-ground to perfection.', 80) }}</p>
                                
                                <div class="mt-auto w-100">
                                    <a href="{{ $isComingSoon ? 'javascript:void(0);' : route('product.show', $item->id) }}" class="btn btn-primary w-100 rounded-pill py-2 fw-medium" style="background-color: var(--brand-primary); border-color: var(--brand-primary); font-family: var(--font-family-sans-alt); font-size: 0.9rem;">Learn More</a>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-12 text-center">
                        <p class="text-muted mt-4">We are currently crafting new products for this collection.</p>
                    </div>
                @endforelse
            </div>
        </div>
    </div>
    @endforeach
@endif

{{-- ========= BENEFITS ========= --}}
<div class="benefits-section py-5" style="background: var(--bg-sage);">
    <div class="container py-5">
        <div class="row mb-5 text-center scroll-reveal">
            <div class="col-12 z-1">
                <h5 class="text-uppercase mb-3" style="color: var(--brand-secondary); letter-spacing: 2px; font-size: 0.75rem; font-family: var(--font-family-sans-alt); font-weight: 600;">TRANSFORM YOUR HEALTH</h5>
                <h2 class="display-5 font-serif mb-4" style="color: var(--brand-primary);">Why <span class="fst-italic">Ancient Grains</span></h2>
            </div>
        </div>
        <div class="row justify-content-center text-center">
            <!-- Card 1 -->
            <div class="col-12 col-md-4 mb-4 mb-md-0 scroll-reveal" style="--reveal-delay: 0ms">
                <div class="benefit-card p-4 p-lg-5 rounded-lg h-100 d-flex flex-column align-items-center" style="background: #fff; box-shadow: 0 10px 30px rgba(0,0,0,0.03);">
                    <div class="icon mb-4 d-inline-flex justify-content-center align-items-center" style="width: 70px; height: 70px; background: rgba(158,186,155,0.1); color: var(--brand-secondary); border-radius: 50%;">
                        <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><path d="M12 2v20M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"/></svg>
                    </div>
                    <h3 class="font-serif fw-bold mb-3" style="color: var(--brand-primary); font-size: 1.5rem;">Nutrient Dense</h3>
                    <p class="text-muted" style="font-size: 1rem; line-height: 1.6;">Rich in fiber, essential minerals, and plant-based protein for sustained energy and wellbeing.</p>
                </div>
            </div>
            <!-- Card 2 -->
            <div class="col-12 col-md-4 mb-4 mb-md-0 scroll-reveal" style="--reveal-delay: 100ms">
                <div class="benefit-card p-4 p-lg-5 rounded-lg h-100 d-flex flex-column align-items-center" style="background: #fff; box-shadow: 0 10px 30px rgba(0,0,0,0.03);">
                    <div class="icon mb-4 d-inline-flex justify-content-center align-items-center" style="width: 70px; height: 70px; background: rgba(158,186,155,0.1); color: var(--brand-secondary); border-radius: 50%;">
                        <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><path d="M2 12A10 10 0 1 1 22 12A10 10 0 1 1 2 12" /><path d="M12 2a15.3 15.3 0 0 1 4 10 15.3 15.3 0 0 1-4 10 15.3 15.3 0 0 1-4-10 15.3 15.3 0 0 1 4-10z"/><path d="M2 12h20"/></svg>
                    </div>
                    <h3 class="font-serif fw-bold mb-3" style="color: var(--brand-primary); font-size: 1.5rem;">Sustainable Farming</h3>
                    <p class="text-muted" style="font-size: 1rem; line-height: 1.6;">Resilient crops that require less water and support soil health for future generations.</p>
                </div>
            </div>
            <!-- Card 3 -->
            <div class="col-12 col-md-4 scroll-reveal" style="--reveal-delay: 200ms">
                <div class="benefit-card p-4 p-lg-5 rounded-lg h-100 d-flex flex-column align-items-center" style="background: #fff; box-shadow: 0 10px 30px rgba(0,0,0,0.03);">
                    <div class="icon mb-4 d-inline-flex justify-content-center align-items-center" style="width: 70px; height: 70px; background: rgba(158,186,155,0.1); color: var(--brand-secondary); border-radius: 50%;">
                        <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><circle cx="12" cy="12" r="10"/><path d="M12 2a14.5 14.5 0 0 0 0 20 14.5 14.5 0 0 0 0-20"/><path d="M2 12h20"/></svg>
                    </div>
                    <h3 class="font-serif fw-bold mb-3" style="color: var(--brand-primary); font-size: 1.5rem;">Stone Ground</h3>
                    <p class="text-muted" style="font-size: 1rem; line-height: 1.6;">Traditionally milled to preserve the maximum nutritional value and rich, complex flavors.</p>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- ========= TRUST / VALIDATION ========= --}}
<div class="trust-validation-section position-relative py-5">
    <div class="container py-lg-5">
        <div class="row align-items-center">
            <!-- Left Side: Large Image -->
            <div class="col-lg-6 mb-5 mb-lg-0 scroll-reveal text-center text-lg-start">
                <div class="image-wrapper position-relative d-inline-block" style="border-radius: 20px; overflow: hidden; box-shadow: 0 20px 50px rgba(0,0,0,0.15);">
                    <img src="{{ asset('site/images/family.png') }}" alt="Quality Grains" class="img-fluid" style="object-fit: cover; max-height: 600px;">
                </div>
            </div>
            <!-- Right Side: Content Box overlapping the image slightly -->
            <div class="col-lg-6 position-relative scroll-reveal" style="--reveal-delay: 150ms; z-index: 2;">
                <div class="content-box p-4 p-md-5 rounded-lg" style="background: rgba(255, 255, 255, 0.95); backdrop-filter: blur(10px); box-shadow: 0 25px 50px rgba(0,0,0,0.08); border: 1px solid rgba(0,0,0,0.05); transform: translateX(-5%);">
                    <h5 class="text-uppercase mb-3" style="color: var(--brand-secondary); letter-spacing: 2px; font-size: 0.75rem; font-family: var(--font-family-sans-alt); font-weight: 600;">OUR COMMITMENT</h5>
                    <h2 class="display-5 font-serif mb-4" style="color: var(--brand-primary);"><span class="fst-italic">Uncompromising</span> Standards</h2>
                    
                    <ul class="list-unstyled mt-4">
                        <li class="d-flex align-items-start mb-4">
                            <div class="icon-wrap me-3 mt-1" style="color: var(--brand-secondary);">
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/></svg>
                            </div>
                            <div>
                                <h4 class="font-serif fw-bold mb-1" style="font-size: 1.25rem;">Certified Organic</h4>
                                <p class="text-muted small mb-0">Sourced exclusively from farms committed to organic practices without synthetic pesticides.</p>
                            </div>
                        </li>
                        <li class="d-flex align-items-start mb-4">
                            <div class="icon-wrap me-3 mt-1" style="color: var(--brand-secondary);">
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/></svg>
                            </div>
                            <div>
                                <h4 class="font-serif fw-bold mb-1" style="font-size: 1.25rem;">Farm to Table Traceability</h4>
                                <p class="text-muted small mb-0">Every batch is fully traceable to its field of origin for complete transparency.</p>
                            </div>
                        </li>
                        <li class="d-flex align-items-start">
                            <div class="icon-wrap me-3 mt-1" style="color: var(--brand-secondary);">
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/></svg>
                            </div>
                            <div>
                                <h4 class="font-serif fw-bold mb-1" style="font-size: 1.25rem;">Small-Batch Milled</h4>
                                <p class="text-muted small mb-0">Stone-ground in limited runs to protect flavor profiles and volatile nutrients.</p>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- ========= PREPARATION GUIDE ========= --}}
<div class="preparation-section py-5" style="background: var(--bg-choc); overflow-x: hidden;">
    <div class="container py-lg-5">
        <div class="row mb-5 text-center scroll-reveal">
            <div class="col-12" >
                <h5 class="text-uppercase mb-3" style="color: var(--brand-secondary); letter-spacing: 2px; font-size: 0.75rem; font-family: var(--font-family-sans-alt); font-weight: 600;">Preparation Guide</h5>
                <h1 class="text-uppercase mb-3" style="font-size: 4rem; font-family: var(--font-family-sans-alt); padding: 20px 0; font-weight: 600; color: black; text-transform: capitalize !important; line-height: 1;">How to Use<br>Ancient Grain Flour</h1>
                <div style="width: 80%; margin: auto;">
                    <p class="display-5 mb-4" style="color: var(--brand-primary); font-size: 1.3rem;">Baking with ancient grains is easy once you understand a few simple adjustments. Follow our guide for perfect results every time.</p>
                </div>
            </div>
        </div>
        
        <!-- Step 1 (Image Right) -->
        <div class="row align-items-center mb-5 py-4 scroll-reveal">
            <div class="col-md-6 order-1 order-md-1 mb-4 mb-md-0 position-relative">
                <div class="rounded-lg overflow-hidden mx-auto" style="width: 100%; height: 300px; box-shadow: 0 15px 30px rgba(0,0,0,0.1);">
                    <img src="{{ asset('site/images/choose.png') }}" class="img-fluid w-100 h-100" style="object-fit: cover;">
                </div>
            </div>
            <div class="col-md-6 order-2 order-md-2 pe-md-5">
                <span class="d-block mb-2" style="font-size: 4rem; color: rgba(158,186,155,0.3); line-height: 1;">01</span>
                <h3 class="fw-bold mb-3" style="color: var(--brand-primary); font-size: 2rem;">Choose Your Blend</h3>
                <p class="text-muted" style="font-size: 1.1rem; line-height: 1.8;">Select the appropriate heritage flour blend for your recipe. Nutrient-dense varieties like Milla require different considerations than our lighter multi-grain mixes. Familiarize yourself with the tasting notes.</p>
            </div>
        </div>
        
        <!-- Step 2 (Image Left) -->
        <div class="row align-items-center mb-5 py-4 scroll-reveal">
            <div class="col-md-6 ps-md-5">
                <span class="d-block mb-" style="font-size: 4rem; color: rgba(158,186,155,0.3); line-height: 1;">02</span>
                <h3 class="fw-bold mb-3" style="color: var(--brand-primary); font-size: 2rem;">Adjust Liquid Content</h3>
                <p class="text-muted" style="font-size: 1.1rem; line-height: 1.8;">Ancient grains naturally absorb more hydration than conventional wheat. When adapting your favorite recipes, increase your liquid volume by 10-15% and allow the dough to rest longer for full absorption.</p>
            </div>
            <div class="col-md-6 mb-4 mb-md-0 position-relative">
                <div class="rounded-lg overflow-hidden mx-auto" style="width: 100%; height: 300px; box-shadow: 0 15px 30px rgba(0,0,0,0.1);">
                    <img src="{{ asset('site/images/adjust.png') }}" class="img-fluid w-100 h-100" style="object-fit: cover;">
                </div>
            </div>
        </div>

        <!-- Step 3 (Image Right) -->
        <div class="row align-items-center py-4 scroll-reveal">
            <div class="col-md-6 order-1 order-md-2 pe-md-5">
                <span class="d-block mb-2" style="font-size: 4rem; color: rgba(158,186,155,0.3); line-height: 1;">03</span>
                <h3 class="fw-bold mb-3" style="color: var(--brand-primary); font-size: 2rem;">Let Dough Rest</h3>
                <p class="text-muted" style="font-size: 1.1rem; line-height: 1.8;">Ancient grains benefit from a longer hydration period. Allow your dough to rest 20-30 minutes after mixing for optimal texture and easier handling.</p>
            </div>
            <div class="col-md-6 order-2 order-md-1 mb-4 mb-md-0 position-relative">
                <div class="rounded-lg overflow-hidden mx-auto" style="width: 100%; height: 300px; box-shadow: 0 15px 30px rgba(0,0,0,0.1);">
                    <img src="{{ asset('site/images/rest.png') }}" class="img-fluid w-100 h-100" style="object-fit: cover;">
                </div>
            </div>
        </div>

        <!-- Step 4 (Image Right) -->
        <div class="row align-items-center py-4 scroll-reveal">
            <div class="col-md-6 order-2 order-md-2 mb-4 mb-md-0 position-relative">
                <div class="rounded-lg overflow-hidden mx-auto" style="width: 100%%; height: 300px; box-shadow: 0 15px 30px rgba(0,0,0,0.1);">
                    <img src="{{ asset('site/images/enjoy.png') }}" class="img-fluid w-100 h-100" style="object-fit: cover;">
                </div>
            </div>
            <div class="col-md-6 order-1 order-md-1 pe-md-5">
                <span class="d-block mb-2" style="font-size: 4rem; color: rgba(158,186,155,0.3); line-height: 1;">04</span>
                <h3 class="fw-bold mb-3" style="color: var(--brand-primary); font-size: 2rem;">Bake and Enjoy</h3>
                <p class="text-muted" style="font-size: 1.1rem; line-height: 1.8;">Bake at slightly lower temperatures to protect the delicate oils present in the stone-ground germ. The result is a richer, more complex flavor profile with a deeply satisfying crust and crumb structure.</p>
            </div>
            
        </div>
    </div>
</div>

{{-- ========= LEAD MAGNET ========= --}}
<div class="lead-magnet-section position-relative py-5" style="background-color: var(--brand-secondary); color: var(--brand-light); overflow: hidden; width: 90%; border-radius: 20px; margin: 0 auto; margin-bottom: 100px;">
    <div class="position-absolute" style="top: -50%; left: -10%; width: 50vw; height: 50vw; background: rgba(255,255,255,0.05); border-radius: 50%;"></div>
    <div class="position-absolute" style="bottom: -50%; right: -10%; width: 40vw; height: 40vw; background: rgba(30,20,15,0.1); border-radius: 50%;"></div>
    
    <div class="container py-lg-5 position-relative z-1 text-center scroll-reveal">
        <h2 class="display-4 font-serif fw-bold mb-4">Need More Baking Tips?</h2>
        <p class="lead mb-5 mx-auto" style="max-width: 600px; font-weight: 300; opacity: 0.9;">Join our community of artisanal bakers and health-conscious foodies. Get our free digital guide to mastering ancient grains.</p>
        <button class="btn px-5 py-3 rounded-pill fw-bold text-uppercase" style="background-color: #ffffff; color: var(--brand-primary); border: 2px solid #ffffff; letter-spacing: 1px; font-size: 0.95rem; box-shadow: 0 15px 30px rgba(0,0,0,0.15); transition: transform 0.3s ease;" onmouseover="this.style.transform='scale(1.05)'" onmouseout="this.style.transform='scale(1.0)'">
            Download Recipe Guide
            <svg class="ms-2" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/><polyline points="7 10 12 15 17 10"/><line x1="12" y1="15" x2="12" y2="3"/></svg>
        </button>
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

{{-- ========= WHOLESALE INQUIRY ========= --}}
<div class="wholesale-section py-5" id="wholesale" style="background: var(--bg-sage);">
    <div class="container py-lg-5">
        <div class="row align-items-center">
            <div class="col-lg-5 mb-5 mb-lg-0 scroll-reveal">
                <h5 class="text-uppercase mb-3" style="color: var(--brand-secondary); letter-spacing: 2px; font-size: 0.75rem; font-family: var(--font-family-sans-alt); font-weight: 600;">PARTNER WITH US</h5>
                <h2 class="display-5 font-serif mb-4" style="color: var(--brand-primary);"><span class="fst-italic">Wholesale</span> Inquiries</h2>
                <p class="text-muted mb-4" style="font-size: 1.1rem; line-height: 1.8;">Bring the nutritional power of authentic heritage grains to your bakery, restaurant, or retail store. Apply for a wholesale account and our B2B team will connect with you shortly.</p>
                <div class="mt-4 mb-5">
                    <button type="button" class="btn btn-primary rounded-pill px-5 py-3 fw-bold shadow-sm" data-bs-toggle="modal" data-bs-target="#wholesaleModal" style="background-color: var(--brand-primary); border-color: var(--brand-primary); letter-spacing: 1px;">
                        Apply for Wholesale
                    </button>
                </div>
                <div class="d-flex align-items-center border-top pt-4" style="border-color: rgba(0,0,0,0.05) !important;">
                    <img src="{{ asset('site/images/hargrio_favicon.png') }}" width="50" height="50" alt="Hargrio Seal" class="rounded-circle me-3" style="box-shadow: 0 5px 15px rgba(0,0,0,0.05); background: #fff; padding: 2px;">
                    <div>
                        <p class="fw-bold mb-0 text-dark" style="font-family: var(--font-family-sans-alt); font-size: 0.95rem;">Hargrio Commercial Division</p>
                        <p class="small text-muted mb-0">sales@hargrio.co.uk</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 offset-lg-1 scroll-reveal" style="--reveal-delay: 150ms">
                <div class="position-relative">
                    <div class="position-absolute" style="top: -20px; right: -20px; width: 100%; height: 100%; border: 2px dashed rgba(158,186,155,0.2); border-radius: 20px; z-index: 0;"></div>
                    <img src="{{ asset('site/images/img-grid-1.jpg') }}" alt="Wholesale Ingredients" class="img-fluid rounded-lg position-relative z-1" style="box-shadow: 0 20px 50px rgba(0,0,0,0.08); width: 100%; object-fit: cover; aspect-ratio: 4/3;">
                </div>
            </div>
        </div>
    </div>
</div>

{{-- ========= VISUAL JOURNEY (GALLERY) ========= --}}
<div class="gallery-section py-5" style="background: var(--bg-choc);">
    <div class="container-fluid px-4 py-lg-5">
        <div class="row text-center mb-5 scroll-reveal">
            <div class="col-12 z-1">
                <h5 class="text-uppercase mb-3" style="color: var(--brand-secondary); letter-spacing: 2px; font-size: 0.75rem; font-family: var(--font-family-sans-alt); font-weight: 600;">FROM FIELD TO TABLE</h5>
                <h2 class="display-5 font-serif mb-4" style="color: var(--brand-primary);"><span class="fst-italic">A Visual</span> Journey</h2>
            </div>
        </div>
        <div class="row g-2 g-md-3">
            @if(isset($galleryImages) && $galleryImages->count() > 0)
                @foreach($galleryImages as $index => $image)
                    <div class="col-6 col-md-3 scroll-reveal" style="--reveal-delay: {{ $index * 100 }}ms">
                        <div class="overflow-hidden rounded-lg h-100 position-relative">
                            <img src="{{ asset('public/uploads/' . $image->image_path) }}" alt="{{ $image->title ?? 'Visual Journey' }}" class="img-fluid w-100 h-100" style="object-fit:cover; min-height: 250px; transition: transform 0.5s ease;" onmouseover="this.style.transform='scale(1.05)'" onmouseout="this.style.transform='scale(1)'">
                        </div>
                    </div>
                @endforeach
            @else
                {{-- Fallback images if database is empty --}}
                <div class="col-6 col-md-3 scroll-reveal" style="--reveal-delay: 0ms">
                    <div class="overflow-hidden rounded-lg h-100">
                        <img src="{{ asset('site/images/img-grid-1.jpg') }}" class="img-fluid w-100 h-100" style="object-fit:cover; min-height: 250px; transition: transform 0.5s ease;" onmouseover="this.style.transform='scale(1.05)'" onmouseout="this.style.transform='scale(1)'">
                    </div>
                </div>
                <div class="col-6 col-md-3 scroll-reveal" style="--reveal-delay: 100ms">
                    <div class="overflow-hidden rounded-lg h-100">
                        <img src="{{ asset('site/images/product-1.png') }}" class="img-fluid w-100 h-100 bg-light" style="object-fit:cover; min-height: 250px; transition: transform 0.5s ease;" onmouseover="this.style.transform='scale(1.05)'" onmouseout="this.style.transform='scale(1)'">
                    </div>
                </div>
                <div class="col-6 col-md-3 scroll-reveal" style="--reveal-delay: 200ms">
                    <div class="overflow-hidden rounded-lg h-100">
                        <img src="{{ asset('site/images/img-grid-2.jpg') }}" class="img-fluid w-100 h-100" style="object-fit:cover; min-height: 250px; transition: transform 0.5s ease;" onmouseover="this.style.transform='scale(1.05)'" onmouseout="this.style.transform='scale(1)'">
                    </div>
                </div>
                <div class="col-6 col-md-3 scroll-reveal" style="--reveal-delay: 300ms">
                    <div class="overflow-hidden rounded-lg h-100">
                        <img src="{{ asset('site/images/img-grid-3.jpg') }}" class="img-fluid w-100 h-100" style="object-fit:cover; min-height: 250px; transition: transform 0.5s ease;" onmouseover="this.style.transform='scale(1.05)'" onmouseout="this.style.transform='scale(1)'">
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>

{{-- ========= VALUE PROPOSITION BAR ========= --}}
<div class="value-prop-bar py-4 border-top border-bottom" style="background-color: var(--bg-cream); border-color: rgba(0,0,0,0.05) !important;">
    <div class="container">
        <div class="row justify-content-center text-center">
            <div class="col-md-4 mb-3 mb-md-0 d-flex align-items-center justify-content-center">
                <div class="icon me-3" style="color: var(--brand-secondary);">
                    <svg width="24" height="24" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M5 12l5 5L20 7"/></svg>
                </div>
                <span class="fw-bold text-uppercase" style="letter-spacing: 1px; font-size: 0.85rem; color: var(--brand-primary); font-family: var(--font-family-sans-alt);">Free shipping on orders over £75</span>
            </div>
            <div class="col-md-4 mb-3 mb-md-0 d-flex align-items-center justify-content-center">
                <div class="icon me-3" style="color: var(--brand-secondary);">
                    <svg width="24" height="24" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><rect x="3" y="11" width="18" height="11" rx="2" ry="2"/><path d="M7 11V7a5 5 0 0110 0v4"/></svg>
                </div>
                <span class="fw-bold text-uppercase" style="letter-spacing: 1px; font-size: 0.85rem; color: var(--brand-primary); font-family: var(--font-family-sans-alt);">Secure Payment Processing</span>
            </div>
            <div class="col-md-4 d-flex align-items-center justify-content-center">
                <div class="icon me-3" style="color: var(--brand-secondary);">
                    <svg width="24" height="24" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M14 9V5a3 3 0 0 0-3-3l-4 9v11h11.28a2 2 0 0 0 2-1.7l1.38-9a2 2 0 0 0-2-2.3zM7 22H4a2 2 0 0 1-2-2v-7a2 2 0 0 1 2-2h3"/></svg>
                </div>
                <span class="fw-bold text-uppercase" style="letter-spacing: 1px; font-size: 0.85rem; color: var(--brand-primary); font-family: var(--font-family-sans-alt);">100% Satisfaction Guarantee</span>
            </div>
        </div>
    </div>
</div>

{{-- ========= FAQ ========= --}}
<section id="faq" class="faq-section bg-white py-5">
    <div class="faq-section__inner py-5">
        <div class="container">

            <div class="text-center mb-5 scroll-reveal">
                <h5 class="text-uppercase fw-bold mb-3" style="color: var(--brand-secondary); letter-spacing: 2px; font-size: 0.85rem;">GOT QUESTIONS?</h5>
                <h2 class="display-6 font-serif faq-title mb-4" style="color: var(--brand-primary);">Frequently <span class="fst-italic">Asked</span> Questions</h2>
                <p class="faq-subtitle mx-auto text-muted" style="max-width: 600px; font-size: 1.1rem; line-height: 1.8;">
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
                <div class="faq-cta-card p-5 rounded-lg mx-auto" style="max-width: 700px; background: var(--bg-cream); border: 1px solid rgba(92,71,66,0.1);">
                    <div class="faq-cta-icon mb-3 fs-1" style="color: var(--brand-secondary);"><i class="fas fa-headset"></i></div>
                    <h4 class="mb-3 font-serif fw-bold" style="color: var(--brand-primary);">Still Have Questions?</h4>
                    <p class="mb-4 text-muted">Our team is happy to help with any questions about our products or your order.</p>
                    <a href="{{ route('contact') }}" class="btn btn-primary rounded-pill px-4 py-2">Contact Us</a>
                </div>
            </div>

        </div>
    </div>
</section>

{{-- ========= BLOG ========= --}}
<div class="blog-section py-5" style="background: var(--bg-sage);">
    <div class="container py-4">
        <div class="row align-items-end mb-5 scroll-reveal">
            <div class="col-md-6">
                <h5 class="text-uppercase fw-bold mb-2" style="color: var(--brand-secondary); letter-spacing: 2px; font-size: 0.85rem;">JOURNAL</h5>
                <h2 class="display-6 font-serif" style="color: var(--brand-primary);"><span class="fst-italic">Recipes</span> &amp; Wellness Stories</h2>
            </div>
            <div class="col-md-6 text-start text-md-end">
                <a href="{{ route('blog.index') }}" class="btn btn-outline-primary rounded-pill px-4 py-2 mt-3">View All Posts</a>
            </div>
        </div>
        <div class="row">
            @forelse($posts as $post)
                <div class="col-12 col-sm-6 col-md-4 mb-4 scroll-reveal" style="--reveal-delay: {{ $loop->index * 120 }}ms">
                    <div class="post-entry post-entry--enhanced rounded-lg overflow-hidden h-100 d-flex flex-column" style="background: #fff; border: 1px solid #eaeaea; transition: transform 0.3s ease, box-shadow 0.3s ease;">
                        <a href="{{ route('blog.show', $post->slug) }}" class="post-thumbnail d-block overflow-hidden" style="height: 240px;">
                            <img src="{{ asset('public/' . ($post->feature_image ?? 'post-1.jpg')) }}"
                                alt="{{ $post->title }}"
                                class="img-fluid w-100 h-100" style="object-fit: cover; transition: transform 0.5s ease;">
                        </a>
                        <div class="post-content-entry p-4 d-flex flex-column flex-grow-1">
                            <h3 class="mb-3 font-serif" style="font-size: 1.25rem;">
                                <a href="{{ route('blog.show', $post->slug) }}" class="text-decoration-none text-dark">{{ $post->title }}</a>
                            </h3>
                            <p class="text-muted small mb-4 flex-grow-1" style="line-height: 1.6;">{{ \Illuminate\Support\Str::limit($post->excerpt, 100) }}</p>
                            <a href="{{ route('blog.show', $post->slug) }}" class="post-read-more text-uppercase fw-bold mt-auto" style="color: var(--brand-secondary); font-size: 0.85rem; letter-spacing: 1px;">Read More &rarr;</a>
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
        radial-gradient(circle at 15% 85%, rgba(158,186,155,0.09) 0%, transparent 45%),
        radial-gradient(circle at 85% 15%, rgba(158,186,155,0.13) 0%, transparent 45%);
}
.hero-eyebrow {
    display: inline-block;
    background: rgba(158,186,155,0.12);
    color: #9EBA9B;
    border: 1px solid rgba(158,186,155,0.4);
    font-size: 11px; font-weight: 600;
    letter-spacing: 1.8px; text-transform: uppercase;
    padding: 5px 14px; border-radius: 20px; margin-bottom: 18px;
}
.animate-fade-up { animation: fadeUp 0.7s ease forwards; opacity: 0; }
.delay-1 { animation-delay: 0.15s; }
.delay-2 { animation-delay: 0.30s; }
.delay-3 { animation-delay: 0.45s; }
.hero-highlight {
    background: linear-gradient(90deg, #9EBA9B 0%, #7aaa77 50%, #9EBA9B 100%);
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
    color: #9EBA9B; line-height: 1.1;
}
.hero-stat-label {
    display: block; font-size: 10px;
    color: rgba(255,255,255,0.45);
    text-transform: uppercase; letter-spacing: 1px; margin-top: 3px;
}

/* --- Promo Banner --- */
.promo-banner-slide {
    background: linear-gradient(135deg, #5C4742 0%, #3d2e2b 45%, #7a5850 100%);
    padding: 80px 0;
    position: relative; overflow: hidden;
}
.promo-deco { position: absolute; border-radius: 50%; pointer-events: none; }
.promo-deco--1 {
    width: 420px; height: 420px;
    background: radial-gradient(circle, rgba(158,186,155,0.11) 0%, transparent 70%);
    top: -100px; right: -80px;
    animation: rotateSlow 25s linear infinite;
}
.promo-deco--2 {
    width: 260px; height: 260px;
    background: radial-gradient(circle, rgba(158,186,155,0.2) 0%, transparent 70%);
    bottom: -70px; left: -50px;
}
.promo-deco--3 {
    width: 160px; height: 160px;
    border: 2px solid rgba(158,186,155,0.15);
    top: 50%; right: 12%;
    transform: translateY(-50%);
    animation: rotateSlow 35s linear infinite reverse;
}
.promo-badge-pill {
    display: inline-flex; align-items: center; gap: 8px;
    background: rgba(158,186,155,0.14);
    border: 1px solid rgba(158,186,155,0.35);
    color: #9EBA9B; font-size: 11px; font-weight: 600;
    letter-spacing: 1.2px; text-transform: uppercase;
    padding: 6px 16px; border-radius: 50px; margin-bottom: 20px;
}
.promo-pulse {
    display: inline-block; width: 8px; height: 8px;
    background: #9EBA9B; border-radius: 50%; position: relative;
}
.promo-pulse::before {
    content: ''; position: absolute; inset: -3px;
    border-radius: 50%; border: 1px solid #9EBA9B;
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
    background: #9EBA9B; color: #5C4742 !important;
    font-weight: 700; padding: 14px 32px;
    border-radius: 50px; border: none;
    transition: all 0.3s ease; text-decoration: none;
}
.btn-promo:hover {
    background: #7aaa77;
    transform: translateY(-2px);
    box-shadow: 0 8px 22px rgba(158,186,155,0.35);
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
.promo-indicators button.active { background: #9EBA9B; width: 42px; }

/* --- FAQ --- */
.faq-section { background: #fff; }
.faq-section__inner {
    padding: 80px 0;
    background: linear-gradient(180deg, #F9F7F7 0%, #fff 100%);
    position: relative; overflow: hidden;
}
.faq-section__inner::before {
    content: ''; position: absolute;
    top: -80px; left: 50%; transform: translateX(-50%);
    width: 700px; height: 700px;
    background: radial-gradient(circle, rgba(158,186,155,0.06) 0%, transparent 60%);
    pointer-events: none;
}
.faq-eyebrow {
    display: inline-block; color: var(--brand-secondary);
    font-size: 12px; font-weight: 600;
    letter-spacing: 2px; text-transform: uppercase; margin-bottom: 12px;
}
.faq-eyebrow::after {
    content: ''; display: block; width: 30px; height: 2px;
    background: #9EBA9B; margin: 6px auto 0;
}
.faq-title { font-size: clamp(1.5rem, 3vw, 2.2rem); font-weight: 800; margin-bottom: 12px; }
.faq-subtitle { color: #999; max-width: 520px; margin: 0 auto; font-size: 15px; }

.faq-card {
    background: #fff;
    border: 1px solid #ede8df;
    border-radius: 12px; margin-bottom: 14px; overflow: hidden;
    transition: box-shadow 0.3s, border-color 0.3s;
}
.faq-card:hover { box-shadow: 0 4px 20px rgba(158,186,155,0.1); border-color: rgba(158,186,155,0.4); }
.faq-card--open { border-color: rgba(158,186,155,0.5); box-shadow: 0 4px 20px rgba(158,186,155,0.12); }

.faq-card__question {
    width: 100%; background: none; border: none;
    padding: 18px 20px; display: flex; align-items: center;
    gap: 14px; text-align: left; cursor: pointer;
    transition: background 0.2s;
}
.faq-card__question:hover { background: rgba(158,186,155,0.04); }

.faq-card__num {
    flex-shrink: 0; width: 32px; height: 32px;
    background: linear-gradient(135deg, #9EBA9B, #7aaa77);
    border-radius: 8px; display: flex; align-items: center;
    justify-content: center; font-size: 11px; font-weight: 800;
    color: #5C4742; letter-spacing: 0.5px;
}
.faq-card__text { flex: 1; font-size: 14px; font-weight: 600; color: #2f2f2f; line-height: 1.4; }
.faq-card__icon { flex-shrink: 0; color: var(--brand-secondary); transition: transform 0.35s ease; display: flex; }
.faq-card--open .faq-card__icon { transform: rotate(180deg); }

.faq-card__answer {
    max-height: 0; overflow: hidden;
    transition: max-height 0.4s ease, padding 0.3s ease;
    padding: 0 20px 0 66px;
}
.faq-card--open .faq-card__answer { max-height: 300px; padding: 0 20px 18px 66px; }
.faq-card__answer p { font-size: 14px; color: #6a6a6a; line-height: 1.75; margin: 0; }

.faq-cta-card {
    background: linear-gradient(135deg, #5C4742, #3d2e2b);
    border-radius: 20px; padding: 40px 32px;
    max-width: 460px; margin: 0 auto;
}
.faq-cta-icon { font-size: 34px; margin-bottom: 12px; }
.faq-cta-card h4 { color: #fff; font-weight: 700; }
.faq-cta-card p { color: rgba(255,255,255,0.6); }
.faq-cta-card .btn-primary {
    background: #9EBA9B; border-color: #9EBA9B;
    color: #5C4742; font-weight: 700;
}
.faq-cta-card .btn-primary:hover { background: #7aaa77; border-color: #7aaa77; }

/* --- Feature cards --- */
.feature--enhanced { padding: 14px; border-radius: 12px; transition: background 0.3s; }
.feature--enhanced:hover { background: rgba(158,186,155,0.06); }

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
    display: inline-block; color: var(--brand-secondary);
    font-size: 13px; font-weight: 600;
    text-decoration: none; margin-top: 8px;
}
.post-read-more:hover { color: #9EBA9B; text-decoration: none; }


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


});
</script>

@endsection
