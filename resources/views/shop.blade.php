@extends('layouts.site')

@section('content')
    <!-- Start Hero Section -->
    <div class="hero">
        <div class="container">
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
            <div class="row">
                @foreach($products as $product)
                    <div class="col-12 col-md-4 mb-5">
                        <div class="product-item">

    <!-- Image links to product detail -->
    <a href="{{ route('product.show', $product->id) }}">
        <img src="{{ asset('site/images/' . ($product->image ?? 'product-1.png')) }}" 
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
                                                <img src="{{ asset('site/images/' . $product->image) }}" 
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
                                                                    {{ $weight }} kg (+£{{ number_format($price, 2) }})
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
                @endforeach
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