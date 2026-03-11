@extends('layouts.site')

@section('content')
    <!-- Start Hero Section -->
    <div class="hero position-relative overflow-hidden">
        {{-- Background Image (bokeh grains) --}}
        <img src="{{ asset('site/images/hero-grains-bokeh.png') }}" class="hero-bg-img" style="position:absolute;inset:0;width:100%;height:100%;object-fit:cover;z-index:0;filter:brightness(0.35);">
        {{-- Layered Gradient Overlay --}}
        <div class="hero-overlay-gradient" style="position:absolute;inset:0;z-index:1;background:linear-gradient(135deg, rgba(27, 24, 23, 0.95) 0%, rgba(44, 34, 31, 0.65) 40%, rgba(92,71,66,0.55) 65%, rgba(30,18,14,0.85) 100%);"></div>
        {{-- Noise grain --}}
        <div style="position:absolute;inset:0;z-index:1;background-image:url(&quot;data:image/svg+xml,%3Csvg viewBox='0 0 200 200' xmlns='http://www.w3.org/2000/svg'%3E%3Cfilter id='n'%3E%3CfeTurbulence type='fractalNoise' baseFrequency='0.75' numOctaves='4' stitchTiles='stitch'/%3E%3C/filter%3E%3Crect width='100%25' height='100%25' filter='url(%23n)'/%3E%3C/svg%3E&quot;);opacity:0.04;pointer-events:none;"></div>
        <div class="container position-relative" style="z-index:3;">
            <div class="row justify-content-between">
                <div class="col-lg-5">
                    <div class="intro-excerpt">
                        <h1>Shop</h1>
                    </div>
                </div>
                <div class="col-lg-7"></div>
            </div>
        </div>
    </div>
    <!-- End Hero Section -->

    <div class="untree_co-section product-section before-footer-section">
        <div class="container">
            <!-- Category Filter Row -->
            <div class="row mb-5 justify-content-center text-center">
                <div class="col-12">
                    <div class="d-flex flex-wrap justify-content-center gap-2">
                        <a href="{{ route('shop.index') }}" class="btn {{ !isset($currentCategory) ? 'btn-primary' : 'btn-outline-primary' }} rounded-pill px-4">All Products</a>
                        @foreach($categories as $category)
                            <a href="{{ route('shop.index', ['category' => $category->id]) }}" class="btn {{ (isset($currentCategory) && $currentCategory->id == $category->id) ? 'btn-primary' : 'btn-outline-primary' }} rounded-pill px-4">
                                {{ $category->name }}
                            </a>
                        @endforeach
                    </div>
                </div>
            </div>

            @if(isset($searchTerm) && $searchTerm)
                <div class="row mb-4">
                    <div class="col-12 text-center">
                        <h4 class="font-serif" style="color: var(--brand-primary);">Search Results for "{{ $searchTerm }}"</h4>
                    </div>
                </div>
            @endif

            <div class="row">
                @forelse($products as $product)
                    @php $isComingSoon = empty($product->price) || !$product->available; @endphp
                    <div class="col-12 col-md-4 mb-5">
                        <div class="product-item position-relative overflow-hidden">
                            @if($isComingSoon)
                                <!-- Dark Overlay for Coming Soon -->
                                <div class="position-absolute w-100 h-100 top-0 start-0 d-flex flex-column align-items-center justify-content-center" style="background: rgba(0,0,0,0.55); backdrop-filter: blur(2px); cursor: not-allowed; z-index: 10; border-radius: inherit;">
                                    <svg width="50" height="50" viewBox="0 0 24 24" fill="none" stroke="#ffffff" stroke-width="2" style="margin-bottom: 15px;"><rect x="3" y="11" width="18" height="11" rx="2" ry="2"></rect><path d="M7 11V7a5 5 0 0 1 10 0v4"></path></svg>
                                    <h4 class="text-white fw-bold m-0" style="font-family: var(--font-family-sans-alt);">Coming Soon</h4>
                                </div>
                            @endif

                            <!-- Image links to product detail -->
                            <a href="{{ route('product.show', $product->id) }}">
                                <img src="{{ asset('public/uploads/' . ($product->image ?? 'product-1.png')) }}" 
                                    class="img-fluid product-thumbnail">
                            </a>

                            <!-- Title also links to product detail -->
                            <a href="{{ route('product.show', $product->id) }}" class="text-decoration-none">
                                <h3 class="product-title">{{ $product->name }}</h3>
                            </a>

                            @if($product->price)
                                <strong class="product-price">
                                    £{{ number_format($product->price, 2) }}
                                </strong>
                            @else
                                <strong class="product-price">Available Soon</strong>
                            @endif

                            <!-- Cross icon opens modal -->
                            <span class="icon-cross" 
                                data-bs-toggle="modal"
                                data-bs-target="#productModal{{ $product->id }}"
                                style="cursor:pointer;">
                                <img src="{{ asset('site/images/cross.svg') }}" 
                                    class="img-fluid">
                            </span>

                        </div>

                        <!-- Product Modal -->
                        <div class="modal fade" id="productModal{{ $product->id }}" tabindex="-1" aria-labelledby="productModalLabel{{ $product->id }}" aria-hidden="true">
                            <div class="modal-dialog modal-lg modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="productModalLabel{{ $product->id }}">{{ $product->name }}</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="row g-4">
                                            <div class="col-md-6">
                                                <img src="{{ asset('public/uploads/' . $product->image) }}" 
                                                     class="img-fluid rounded" alt="{{ $product->name }}">
                                            </div>
                                            <div class="col-md-6 d-flex flex-column justify-content-between">
                                                <div>
                                                    <p class="price display-6 fw-bold" style="color: #8b670b;" id="modalPrice{{ $product->id }}">
                                                        £{{ number_format($product->price, 2) }}
                                                    </p>

                                                    @if($product->variations && count($product->variations) > 0)
                                                        <select id="modalVariation{{ $product->id }}" class="form-select mb-3" style="width:120px;">
                                                            @foreach($product->variations as $weight => $price)
                                                                <option value="{{ $weight }}" data-price="{{ $price }}">
                                                                    {{ $weight }} kg (£{{ number_format($price, 2) }})
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                    @endif

                                                    <input type="number"
                                                           id="modalQuantity{{ $product->id }}"
                                                           class="form-control mb-3"
                                                           value="1"
                                                           min="1"
                                                           style="width:100px; height:38px;">

                                                    <button type="button"
                                                            class="btn btn-primary add-to-cart-modal"
                                                            data-id="{{ $product->id }}">
                                                        Add to Cart
                                                    </button>
                                                </div>
                                            </div>
                                        </div>

                                        @if($product->short_description || $product->long_description)
                                            <div class="mt-3">
                                                @if($product->short_description)
                                                    <p class="text-muted">{{ $product->short_description }}</p>
                                                @endif
                                                @if($product->long_description)
                                                    <p class="text-secondary">{{ $product->long_description }}</p>
                                                @endif
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- End Modal -->
                    </div>
                @empty
                    <div class="col-12 text-center py-5">
                        <h5 class="text-muted font-serif">No products found matching your search criteria.</h5>
                        <p class="text-muted mb-4">Try adjusting your search or browse our categories.</p>
                        <a href="{{ route('shop.index') }}" class="btn btn-primary rounded-pill px-4">Clear Search</a>
                    </div>
                @endforelse
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
            @foreach($products as $product)
                $('#modalVariation{{ $product->id }}').on('change', function() {
                    var selected = $(this).find(':selected');
                    var price = selected.data('price');
                    $('#modalPrice{{ $product->id }}').text('£' + parseFloat(price).toFixed(2));
                });
            @endforeach

        });
    </script>
    @endauth

@endsection