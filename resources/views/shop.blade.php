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
                <div class="col-lg-7">
                    
                </div>
            </div>
        </div>
    </div>
    <!-- End Hero Section -->

    <div class="untree_co-section product-section before-footer-section">
        <div class="container">
            <div class="row">
                @foreach($products as $product)
                    <div class="col-12 col-md-4 mb-5">
                        <a href="javascript:void(0);" 
                        class="product-item add-to-cart"
                        data-id="{{ $product->id }}">

                            <img src="{{ asset('site/images/' . ($product->image ?? 'site/images/product-1.png')) }}" 
                                class="img-fluid product-thumbnail">

                            <h3 class="product-title">{{ $product->name }}</h3>

                            @if($product->price)
                                <strong class="product-price">
                                    £{{ number_format($product->price, 2) }}
                                </strong>
                            @else
                                <strong class="product-price">Available Soon</strong>
                            @endif

                            <span class="icon-cross">
                                <img src="{{ asset('site/images/cross.svg') }}" 
                                    class="img-fluid">
                            </span>

                        </a>
                    </div>
                @endforeach
            </div>
        </div>
    </div>


    @auth
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
    @endauth

@endsection