@extends('layouts.site')
@section('content')
<div style="padding-bottom: 300px">
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
                        <h1>Checkout</h1>
                    </div>
                </div>
                <div class="col-lg-7"></div>
            </div>
        </div>
    </div>
    <!-- End Hero Section -->

    <form method="POST" action="{{ route('checkout.store') }}" id="checkoutForm">
        @csrf
        <div class="untree_co-section">
            <div class="container">

                @if(session('error'))
                    <div class="alert alert-danger">{{ session('error') }}</div>
                @endif

                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul class="mb-0">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <div class="row">
                    <!-- Billing Details -->
                    <div class="col-md-6 mb-5 mb-md-0">
                        <h2 class="h3 mb-3 text-black">Billing Details</h2>
                        <div class="p-3 p-lg-5 border bg-white">
                            <div class="form-group">
                                <label for="c_country" class="text-black">Country <span class="text-danger">*</span></label>
                                <select id="c_country" name="c_country" class="form-control">
                                    <option value="">Select a country</option>
                                    <option value="UK">United Kingdom</option>
                                    <option value="US">United States</option>
                                </select>
                            </div>
                            <div class="form-group row">
                                <div class="col-md-6">
                                    <label for="c_fname" class="text-black">First Name <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="c_fname" name="c_fname">
                                </div>
                                <div class="col-md-6">
                                    <label for="c_lname" class="text-black">Last Name <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="c_lname" name="c_lname">
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-md-12">
                                    <label for="c_companyname" class="text-black">Company Name </label>
                                    <input type="text" class="form-control" id="c_companyname" name="c_companyname">
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-md-12">
                                    <label for="c_address" class="text-black">Address <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="c_address" name="c_address" placeholder="Street address">
                                </div>
                            </div>
                            <div class="form-group mt-3">
                                <input type="text" class="form-control" placeholder="Apartment, suite, unit etc. (optional)">
                            </div>
                            <div class="form-group row">
                                <div class="col-md-6">
                                    <label for="c_state_country" class="text-black">State / Country <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="c_state_country" name="c_state_country">
                                </div>
                                <div class="col-md-6">
                                    <label for="c_postal_zip" class="text-black">Posta / Zip <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="c_postal_zip" name="c_postal_zip">
                                </div>
                            </div>
                            <div class="form-group row mb-5">
                                <div class="col-md-6">
                                    <label for="c_email_address" class="text-black">Email Address <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="c_email_address" name="c_email_address">
                                </div>
                                <div class="col-md-6">
                                    <label for="c_phone" class="text-black">Phone <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="c_phone" name="c_phone" placeholder="Phone Number">
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Order Summary -->
                    <div class="col-md-6">
                        <div class="row mb-5">
                            <div class="col-md-12">
                                <h2 class="h3 mb-3 text-black">Your Order</h2>
                                <div class="p-3 p-lg-5 border bg-white">

                                    <!-- Promo Code -->
                                    <div class="form-group mb-4 d-flex" id="promo-container">
                                        <input type="text" class="form-control me-2" id="promo_code" name="promo_code" placeholder="Enter promo code" value="{{ session('promo_code') }}">
                                        <button type="button" id="applyPromoBtn" class="btn btn-primary">Apply</button>
                                    </div>

                                    <div id="promoFeedback"></div>

                                    <!-- Order Table -->
                                    <table class="table site-block-order-table mb-3">
                                        <thead>
                                            <th>Product</th>
                                            <th>Total</th>
                                        </thead>
                                        <tbody>
                                        @foreach($cartItems as $item)
                                        <tr>
                                            <td>{{ $item->product->name }} <strong class="mx-2">x</strong> {{ $item->quantity }}</td>
                                            <td>£{{ number_format($item->product->price * $item->quantity, 2) }}</td>
                                        </tr>
                                        @endforeach
                                        </tbody>
                                    </table>

                                    <!-- Totals -->
                                    @php
                                        $subtotal = $cartItems->sum(fn($item) => $item->product->price * $item->quantity);
                                        $discountAmount = session('promo_discount_amount', 0);
                                        $total = $subtotal - $discountAmount;
                                    @endphp

                                    <div class="mb-3">
                                        <p>Subtotal: £<span id="subtotal">{{ number_format($subtotal, 2) }}</span></p>
                                        <p>Discount: -£<span id="discount">{{ number_format($discountAmount, 2) }}</span></p>
                                        <p class="font-weight-bold">Total Payable: £<span id="orderTotal">{{ number_format($total, 2) }}</span></p>
                                    </div>

                                    <input type="hidden" name="final_total" id="final_total" value="{{ $total }}">

                                    <div class="border p-3 mb-3">
                                        <div class="form-group">
                                            <button type="submit" class="btn btn-black btn-lg py-3 btn-block">Proceed to Payment</button>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </form>
</div>

<script>
document.getElementById('applyPromoBtn').addEventListener('click', function() {
    const promoCode = document.getElementById('promo_code').value;
    const token = '{{ csrf_token() }}';

    fetch('{{ route("checkout.applyPromoAjax") }}', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': token
        },
        body: JSON.stringify({ promo_code: promoCode })
    })
    .then(res => res.json())
    .then(data => {
        const feedback = document.getElementById('promoFeedback');
        const subtotal = parseFloat(document.getElementById('subtotal').innerText);

        if(data.success) {
            feedback.innerHTML = `<p class="text-success">${data.message}</p>`;
            // Update discount and total
            document.getElementById('discount').innerText = parseFloat(data.discount || 0).toFixed(2);
            document.getElementById('orderTotal').innerText = parseFloat(data.total).toFixed(2);
            document.getElementById('final_total').value = parseFloat(data.total).toFixed(2);
        } else {
            feedback.innerHTML = `<p class="text-danger">${data.message}</p>`;
            document.getElementById('discount').innerText = '0.00';
            document.getElementById('orderTotal').innerText = subtotal.toFixed(2);
            document.getElementById('final_total').value = subtotal.toFixed(2);
        }
    })
    .catch(err => console.error(err));
});
</script>
@endsection