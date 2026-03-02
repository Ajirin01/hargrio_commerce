@extends('layouts.site')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-8 text-center">

            <div class="card shadow-sm border-0">
                <div class="card-body p-5">

                    <div class="mb-4">
                        <i class="fa fa-times-circle text-danger" style="font-size:60px;"></i>
                    </div>

                    <h2 class="text-danger mb-3">Payment Failed</h2>

                    <p class="text-muted mb-4">
                        Unfortunately, your payment could not be processed.
                        Please check your details or try again.
                    </p>

                    <div class="d-flex justify-content-center gap-3">
                        <a href="{{ route('cart.index') }}" class="btn btn-primary">
                            Return to Cart
                        </a>

                        <a href="{{ route('checkout.index') }}" class="btn btn-outline-secondary">
                            Try Again
                        </a>
                    </div>

                </div>
            </div>

        </div>
    </div>
</div>
@endsection