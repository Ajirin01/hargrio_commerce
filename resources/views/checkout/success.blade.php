@extends('layouts.site')

@section('content')
<div class="untree_co-section">
    <div class="container">
        <div class="row">
            <div class="col-md-12 text-center pt-5">

                <span class="display-3 thankyou-icon text-success">
                    <svg width="1em" height="1em" viewBox="0 0 16 16" 
                        class="bi bi-cart-check mb-5" fill="currentColor" 
                        xmlns="http://www.w3.org/2000/svg">

                        <path fill-rule="evenodd"
                            d="M11.354 5.646a.5.5 0 0 1 0 .708l-3 3a.5.5 0 0 1-.708 0l-1.5-1.5a.5.5 0 1 1 .708-.708L8 8.293l2.646-2.647a.5.5 0 0 1 .708 0z"/>

                        <path fill-rule="evenodd"
                            d="M0 1.5A.5.5 0 0 1 .5 1H2a.5.5 0 0 1 .485.379L2.89 3H14.5a.5.5 0 0 1 .491.592l-1.5 8A.5.5 0 0 1 13 12H4a.5.5 0 0 1-.491-.408L2.01 3.607 1.61 2H.5a.5.5 0 0 1-.5-.5zM3.102 4l1.313 7h8.17l1.313-7H3.102z"/>
                    </svg>
                </span>

                <h2 class="display-4 text-black">Payment Successful!</h2>

                <p class="lead mb-3">
                    Thank you for your order 🎉
                </p>

                @if(!empty($order_id))
                    <p class="mb-4">
                        Your Order Number: 
                        <strong>#{{ $order_id }}</strong>
                    </p>
                @endif

                <div class="d-flex justify-content-center gap-3">
                    <a href="{{ route('shop.index') }}" class="btn btn-outline-black btn-sm">
                        Continue Shopping
                    </a>

                    <a href="{{ route('orders.show', $order_id) }}" 
                       class="btn btn-primary btn-sm">
                        View Order
                    </a>
                </div>

            </div>
        </div>
    </div>
</div>

@endsection