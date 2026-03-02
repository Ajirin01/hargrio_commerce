@extends('layouts.site')
@section('content')
    <!-- Start Hero Section -->
    <div class="hero position-relative">
        <!-- Overlay -->
        <div class="hero-overlay position-absolute top-0 start-0 w-100 h-100"></div>

        <div class="container">
            <div class="row justify-content-between">
                <div class="col-lg-5">
                    <div class="intro-excerpt text-white">
                        <h1>Cart</h1>
                    </div>
                </div>
                <div class="col-lg-7">
                    <!-- optional image/content -->
                </div>
            </div>
        </div>
    </div>
    <!-- End Hero Section -->


    

    <div class="untree_co-section before-footer-section">
        <div class="container">
            <div class="row mb-5">
            {{-- <form class="col-md-12" method="post"> --}}
                <div class="site-blocks-table">
                <table class="table">
                    <thead>
                    <tr>
                        <th class="product-thumbnail">Image</th>
                        <th class="product-name">Product</th>
                        <th class="product-price">Price</th>
                        <th class="product-quantity">Quantity</th>
                        <th class="product-total">Total</th>
                        <th class="product-remove">Remove</th>
                    </tr>
                    </thead>
                    <tbody>
                        @if($cartItems && count($cartItems) > 0)

                            @php $subtotal = 0; @endphp

                            @foreach($cartItems as $id => $details)

                                @php 
                                    $total = $details['price'] * $details['quantity'];
                                    $subtotal += $total;
                                @endphp

                                <tr>
                                    <td class="product-thumbnail">
                                        <img src="{{ asset('storage/'.$details['image']) }}" 
                                            alt="Image" class="img-fluid" width="80">
                                    </td>

                                    <td class="product-name">
                                        <h2 class="h5 text-black">{{ $details['name'] }}</h2>
                                    </td>

                                    <td>£{{ number_format($details['price'], 2) }}</td>

                                    <td>
                                        <form action="{{ route('cart.update') }}" method="POST">
                                            @csrf
                                            @method('PATCH')
                                            <input type="hidden" name="id" value="{{ $id }}">

                                            <div class="input-group mb-3 d-flex align-items-center quantity-container" style="max-width: 120px;">
                                                
                                                <button type="submit" name="action" value="decrease" class="btn btn-outline-black">−</button>

                                                <input type="text" name="quantity"
                                                    class="form-control text-center"
                                                    value="{{ $details['quantity'] }}" readonly>

                                                <button type="submit" name="action" value="increase" class="btn btn-outline-black">+</button>
                                            </div>
                                        </form>
                                    </td>

                                    <td>£{{ number_format($total, 2) }}</td>

                                    <td>
                                        <form action="{{ route('cart.remove', $id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <input type="hidden" name="id" value="{{ $id }}">
                                            <button class="btn btn-black btn-sm">X</button>
                                        </form>
                                    </td>
                                </tr>

                            @endforeach

                        @else

                        <tr>
                            <td colspan="6" class="text-center">Your cart is empty.</td>
                        </tr>

                        @endif
                    </tbody>

                </table>
                </div>
            {{-- </form> --}}
            </div>
    
            <div class="row">
            <div class="col-md-6">
                <div class="row mb-5">
                {{-- <div class="col-md-6 mb-3 mb-md-0">
                    <button class="btn btn-black btn-sm btn-block">Update Cart</button>
                </div> --}}
                <div class="col-md-6">
                    <a href="{{ url('shop') }}"><button class="btn btn-outline-black btn-sm btn-block">Continue Shopping</button></a>
                </div>
                </div>
                <!-- <div class="row">
                <div class="col-md-12">
                    <label class="text-black h4" for="coupon">Coupon</label>
                    <p>Enter your coupon code if you have one.</p>
                </div>
                <div class="col-md-8 mb-3 mb-md-0">
                    <input type="text" class="form-control py-3" id="coupon" placeholder="Coupon Code">
                </div>
                <div class="col-md-4">
                    <button class="btn btn-black">Apply Coupon</button>
                </div>
                </div> -->
            </div>
            <div class="col-md-6 pl-5">
                <div class="row justify-content-end">
                <div class="col-md-7">
                    <div class="row">
                    <div class="col-md-12 text-right border-bottom mb-5">
                        <h3 class="text-black h4 text-uppercase">Cart Totals</h3>
                    </div>
                    </div>
                    <div class="row mb-3">
                    <div class="col-md-6">
                        <span class="text-black">Subtotal</span>
                    </div>
                    <div class="col-md-6 text-right">
                        <strong class="text-black">
                            £{{ isset($subtotal) ? number_format($subtotal, 2) : '0.00' }}
                        </strong>

                    </div>
                    </div>
                    <div class="row mb-5">
                    <div class="col-md-6">
                        <span class="text-black">Total</span>
                    </div>
                    <div class="col-md-6 text-right">
                        <strong class="text-black">
                            £{{ isset($subtotal) ? number_format($subtotal, 2) : '0.00' }}
                        </strong>

                    </div>
                    </div>
    
                    <div class="row">
                    <div class="col-md-12">
                        <button class="btn btn-black btn-lg py-3 btn-block" onclick="window.location='{{ url('checkout') }}'">Proceed To Checkout</button>
                    </div>
                    </div>
                </div>
                </div>
            </div>
            </div>
        </div>
    </div>
@endsection