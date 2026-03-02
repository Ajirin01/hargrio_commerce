@extends('layouts.site')

@section('content')
<div style="margin-bottom: 150px">
    <div class="hero py-4 bg-light">
        <div class="container text-center">
            <h1 class="display-5" style="color: #8b670b;">{{ $product->name }}</h1>
        </div>
    </div>

    <div class="untree_co-section product-detail-section py-5">
        <div class="container">
            <div class="row g-4">
                <!-- Product Images -->
                <div class="col-md-6">
                    <div class="product-image-card p-3 border rounded shadow-sm">
                        <img src="{{ asset('site/images/'.$product->image) }}" class="img-fluid rounded" alt="{{ $product->name }}">
                    </div>
                </div>

                <!-- Product Info -->
                <div class="col-md-6 d-flex flex-column justify-content-between">
                    <div>
                        <h2 class="fw-bold">{{ $product->name }}</h2>
                        {{-- <p class="price display-6 text-success fw-bold" id="productPrice">£{{ number_format($product->price, 2) }}</p> --}}
                        <p class="price display-6 fw-bold" id="productPrice" style="color: #8b670b;">£{{ number_format($product->price, 2) }}</p>
                        <!-- Tabs for Description / Preparation -->
                        <ul class="nav nav-tabs mb-3" id="productTab" role="tablist">
                            <li class="nav-item" role="presentation">
                                <button class="nav-link active" id="description-tab" data-bs-toggle="tab" data-bs-target="#description" type="button" role="tab" aria-controls="description" aria-selected="true">
                                    Description
                                </button>
                            </li>
                            @if($product->preparation_instructions)
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="preparation-tab" data-bs-toggle="tab" data-bs-target="#preparation" type="button" role="tab" aria-controls="preparation" aria-selected="false">
                                    Preparation
                                </button>
                            </li>
                            @endif
                        </ul>
                        <div class="tab-content mb-4" id="productTabContent">
                            <div class="tab-pane fade show active" id="description" role="tabpanel" aria-labelledby="description-tab">
                                @if($product->short_description)
                                    <p class="text-muted">{{ $product->short_description }}</p>
                                @endif
                                @if($product->long_description)
                                    <p class="text-secondary">{{ $product->long_description }}</p>
                                @endif
                            </div>
                            @if($product->preparation_instructions)
                            <div class="tab-pane fade" id="preparation" role="tabpanel" aria-labelledby="preparation-tab">
                                <p>{{ $product->preparation_instructions }}</p>
                            </div>
                            @endif
                        </div>

                        <!-- Product Variations & Add to Cart -->
                        <div class="d-flex align-items-start gap-3 mb-3">

                            @if($product->variations && count($product->variations) > 0)
                                <select id="variation" class="form-select" style="width:120px;">
                                    @foreach($product->variations as $weight => $price)
                                        <option value="{{ $weight }}" data-price="{{ $price }}">
                                            {{ $weight }} kg (+£{{ number_format($price, 2) }})
                                        </option>
                                    @endforeach
                                </select>
                            @endif

                            <input type="number" 
                                id="quantity" 
                                class="form-control" 
                                value="1" 
                                min="1" 
                                style="width:100px; height:38px;">

                            <button type="button"
                                    class="btn add-to-cart-detail"
                                    data-id="{{ $product->id }}"
                                    style="height:38px; padding: 0px 20px">
                                Add to Cart
                            </button>

                        </div>

                        @if(session('success'))
                            <div class="alert alert-success mt-3">
                                {{ session('success') }}
                            </div>
                        @endif

                        <!-- Preparation Link Button -->
                        @if($product->preparation_link)
                            <a href="{{ $product->preparation_link }}" target="_blank" class="btn btn-outline-primary mt-2">
                                View Full Preparation Instructions
                            </a>
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