@extends('layouts.guest')

@section('content')

<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-5">

            <div class="card shadow-lg border-0 rounded-4">
                <div class="card-body p-5">

                    <h3 class="text-center mb-4 fw-bold">
                        Forgot Password
                    </h3>

                    <p class="mb-4 text-muted">
                        Enter your email address below and we'll send you a link to reset your password.
                    </p>

                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form method="POST" action="{{ route('password.email') }}" id="forgotForm">
                        @csrf

                        <!-- Email Address -->
                        <div class="mb-3">
                            <label class="form-label">Email Address</label>
                            <input type="email"
                                   name="email"
                                   value="{{ old('email') }}"
                                   class="form-control @error('email') is-invalid @enderror"
                                   required autofocus>

                            @error('email')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <!-- Submit -->
                        <div class="d-grid mb-3">
                            <button type="submit" id="forgotBtn" class="btn btn-dark btn-lg rounded-3">
                                <span id="forgotText">Send Reset Link</span>
                                <span id="forgotSpinner"
                                      class="spinner-border spinner-border-sm ms-2 d-none"
                                      role="status"></span>
                            </button>
                        </div>

                        <div class="text-center">
                            <a href="{{ route('login') }}" class="text-decoration-none">
                                Back to login
                            </a>
                        </div>

                    </form>

                </div>
            </div>

        </div>
    </div>
</div>

<script>
    document.getElementById('forgotForm').addEventListener('submit', function () {
        const btn = document.getElementById('forgotBtn');
        const spinner = document.getElementById('forgotSpinner');
        const text = document.getElementById('forgotText');

        btn.disabled = true;
        spinner.classList.remove('d-none');
        text.textContent = 'Sending...';
    });
</script>

@endsection
