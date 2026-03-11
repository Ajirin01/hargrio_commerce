@extends('layouts.site')

@section('content')
<div style="margin-bottom: 100px">
    <!-- Start Hero Section -->
    <div class="hero position-relative overflow-hidden pt-5 pb-5">
        {{-- Background Image (bokeh grains) --}}
        <img src="{{ asset('site/images/hero-grains-bokeh.png') }}" class="hero-bg-img" style="position:absolute;inset:0;width:100%;height:100%;object-fit:cover;z-index:0;filter:brightness(0.35);">
        {{-- Layered Gradient Overlay --}}
        <div class="hero-overlay-gradient" style="position:absolute;inset:0;z-index:1;background:linear-gradient(135deg, rgba(27, 24, 23, 0.95) 0%, rgba(44, 34, 31, 0.65) 40%, rgba(92,71,66,0.55) 65%, rgba(30,18,14,0.85) 100%);"></div>
        {{-- Noise grain --}}
        <div style="position:absolute;inset:0;z-index:1;background-image:url(&quot;data:image/svg+xml,%3Csvg viewBox='0 0 200 200' xmlns='http://www.w3.org/2000/svg'%3E%3Cfilter id='n'%3E%3CfeTurbulence type='fractalNoise' baseFrequency='0.75' numOctaves='4' stitchTiles='stitch'/%3E%3C/filter%3E%3Crect width='100%25' height='100%25' filter='url(%23n)'/%3E%3C/svg%3E&quot;);opacity:0.04;pointer-events:none;"></div>
        <div class="container position-relative text-center mt-5" style="z-index:3;">
            <h1 class="display-5 font-serif text-white fw-bold animate-fade-up">{{ $product->name }}</h1>
        </div>
    </div>
    <!-- End Hero Section -->

    <div class="untree_co-section product-detail-section py-5">
        <div class="container">
            <div class="row g-5 align-items-start">
                <!-- Product Images -->
                <div class="col-md-6 scroll-reveal" style="--reveal-delay: 0ms">
                    <div class="product-image-card p-3 p-md-4 rounded-4 shadow-sm" style="border: 1px solid #eaeaea; background: #fff;">
                        <img src="{{ asset('public/uploads/'.$product->image) }}" class="img-fluid rounded-4" style="object-fit:cover; width:100%;" alt="{{ $product->name }}">
                    </div>
                </div>

                <!-- Product Info -->
                <div class="col-md-6 d-flex flex-column justify-content-between scroll-reveal" style="--reveal-delay: 100ms">
                    <div>
                        <h2 class="fw-bold font-serif mb-2" style="color: var(--brand-primary);">{{ $product->name }}</h2>
                        <p class="price display-6 font-serif fw-bold mb-2" id="productPrice" style="color: var(--brand-gold);">£{{ number_format($product->price, 2) }}</p>

                        <div class="d-flex align-items-center mb-4">
                            @if($product->stock > 0)
                                <span class="badge rounded-pill bg-success px-3 py-2 fw-medium"><i class="fas fa-check-circle me-1"></i> In Stock</span>
                            @else
                                <span class="badge rounded-pill bg-danger px-3 py-2 fw-medium"><i class="fas fa-times-circle me-1"></i> Out of Stock</span>
                            @endif
                        </div>

                        <!-- Tabs for Description / Preparation -->
                        <ul class="nav nav-pills mb-4 pb-2 border-bottom" id="productTab" role="tablist">
                            <li class="nav-item" role="presentation">
                                <button class="nav-link active rounded-pill px-4 fw-medium" id="description-tab" data-bs-toggle="pill" data-bs-target="#description" type="button" role="tab" aria-controls="description" aria-selected="true" style="transition: all 0.2s;">
                                    Description
                                </button>
                            </li>
                            @if($product->preparation_instructions)
                            <li class="nav-item ms-2" role="presentation">
                                <button class="nav-link rounded-pill px-4 fw-medium" id="preparation-tab" data-bs-toggle="pill" data-bs-target="#preparation" type="button" role="tab" aria-controls="preparation" aria-selected="false" style="transition: all 0.2s;">
                                    Preparation
                                </button>
                            </li>
                            @endif
                        </ul>
                        <style>
                            .nav-pills .nav-link { color: var(--brand-primary); background: transparent; }
                            .nav-pills .nav-link:hover { background: rgba(92, 71, 66, 0.05); }
                            .nav-pills .nav-link.active { background-color: var(--brand-primary) !important; color: #fff; }
                        </style>
                        <div class="tab-content mb-5" id="productTabContent">
                            <div class="tab-pane fade show active" id="description" role="tabpanel" aria-labelledby="description-tab">
                                @if($product->short_description)
                                    <p class="text-muted">{{ $product->short_description }}</p>
                                @endif
                                @if($product->long_description)
                                    <p class="text-secondary">{!! $product->long_description !!}</p>
                                @endif
                            </div>
                            @if($product->preparation_instructions)
                            <div class="tab-pane fade" id="preparation" role="tabpanel" aria-labelledby="preparation-tab">
                                <p class="text-secondary lh-lg">{{ $product->preparation_instructions }}</p>
                            </div>
                            @endif
                        </div>

                        <!-- Product Variations & Add to Cart -->
                        <div class="p-4 rounded-4" style="background: var(--brand-light); border: 1px solid #eaeaea;">
                            <div class="d-flex flex-wrap align-items-end gap-3 mb-3">
                                
                                @if($product->variations && count($product->variations) > 0)
                                    <div class="flex-grow-1" style="max-width: 180px;">
                                        <label class="form-label small fw-bold text-muted text-uppercase mb-1" style="letter-spacing: 0.5px;">Size</label>
                                        <select id="variation" class="form-select form-select-lg border-0 shadow-sm" style="border-radius: 10px; font-size: 0.95rem;">
                                    @foreach($product->variations as $weight => $price)
                                        <option value="{{ $weight }}" data-price="{{ $price }}">
                                            {{ $weight }} kg (£{{ number_format($price, 2) }})
                                        </option>
                                    @endforeach
                                        </select>
                                    </div>
                                @endif

                                <div>
                                    <label class="form-label small fw-bold text-muted text-uppercase mb-1" style="letter-spacing: 0.5px;">Quantity</label>
                                    <input type="number" 
                                        id="quantity" 
                                        class="form-control form-control-lg border-0 shadow-sm text-center fw-medium" 
                                        value="1" 
                                        min="1" 
                                        style="width:80px; border-radius: 10px; font-size: 1rem;">
                                </div>

                                <div class="mt-3 mt-md-0 flex-grow-1 text-md-end">
                                    <button type="button"
                                            class="btn btn-primary add-to-cart-detail rounded-pill px-4 py-2 fw-bold shadow-sm w-100 placeholder-wave"
                                            data-id="{{ $product->id }}"
                                            style="background-color: var(--brand-primary); border-color: var(--brand-primary); transition: all 0.3s; height: 50px;">
                                        <i class="fas fa-shopping-cart me-2"></i> Add to Cart
                                    </button>
                                </div>
                            </div>
                            
                            @if(session('success'))
                                <div class="alert alert-success border-0 rounded-3 shadow-sm mt-3 mb-0">
                                    <i class="fas fa-check-circle me-2"></i> {{ session('success') }}
                                </div>
                            @endif
                        </div>

                        <!-- Preparation Link Button -->
                        @if($product->preparation_link)
                            <div class="mt-4">
                                <a href="{{ $product->preparation_link }}" target="_blank" class="btn rounded-pill px-4 py-2 fw-medium" style="background-color: transparent !important; color: var(--brand-primary) !important; border: 1.5px solid var(--brand-primary); transition: all 0.3s;" onmouseover="this.style.backgroundColor='var(--brand-primary)'; this.style.color='#ffffff';" onmouseout="this.style.backgroundColor='transparent'; this.style.color='var(--brand-primary)';">
                                    <i class="fas fa-external-link-alt me-2"></i> View Full Preparation Instructions
                                </a>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
$(document).ready(function() {

    $('.add-to-cart-detail').click(function() {

        var productId = $(this).data('id');
        var quantity = $('#quantity').val();
        var variation = $('#variation').length ? $('#variation').val() : null;

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

    });

});
</script>
<script>
$(document).ready(function() {

    const priceEl = $('#productPrice');
    const variationSelect = $('#variation');
    const defaultPrice = {{ $product->price }};

    if (variationSelect.length) {

        function updatePrice() {

            const selected = variationSelect.find(':selected');
            const variationPrice = selected.data('price');

            if (variationPrice !== undefined) {
                priceEl.text('£' + parseFloat(variationPrice).toFixed(2));
            } else {
                priceEl.text('£' + parseFloat(defaultPrice).toFixed(2));
            }
        }

        // Update when dropdown changes
        variationSelect.on('change', updatePrice);

        // Set correct price on page load
        updatePrice();
    }

});
</script>
@endsection