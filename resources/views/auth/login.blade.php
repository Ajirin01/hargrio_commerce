@extends('layouts.guest')

@section('content')

<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-5">

            <div class="card shadow-lg border-0 rounded-4">
                <div class="card-body p-5">

                    <h3 class="text-center mb-4 fw-bold">
                        Welcome Back
                    </h3>

                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form method="POST" action="{{ route('login') }}" id="loginForm">
                        @csrf

                        <!-- Email -->
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

                        <!-- Password -->
                        <div class="mb-3">
                            <label class="form-label">Password</label>
                            <input type="password"
                                name="password"
                                class="form-control @error('password') is-invalid @enderror"
                                required>

                            @error('password')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <!-- Remember -->
                        <div class="mb-3 form-check">
                            <input type="checkbox" name="remember" class="form-check-input">
                            <label class="form-check-label">
                                Remember me
                            </label>
                        </div>

                        <!-- Submit Button -->
                        <div class="d-grid mb-3">
                            <button type="submit" id="loginBtn" class="btn btn-dark btn-lg rounded-3">
                                <span id="btnText">Log In</span>
                                <span id="btnSpinner" class="spinner-border spinner-border-sm ms-2 d-none" role="status"></span>
                            </button>
                        </div>

                        @if (Route::has('password.request'))
                            <div class="text-center">
                                <a href="{{ route('password.request') }}" class="text-decoration-none">
                                    Forgot your password?
                                </a>
                            </div>
                        @endif

                        <a href="{{ route('register') }}" class="text-decoration-none">
                            <div class="text-center mt-3">
                                <span class="text-muted">Don't have an account? Register</span>
                            </div>
                        </a>

                    </form>

                </div>
            </div>

        </div>
    </div>
</div>

<script>
    document.getElementById('loginForm').addEventListener('submit', function () {
        const btn = document.getElementById('loginBtn');
        const spinner = document.getElementById('btnSpinner');
        const text = document.getElementById('btnText');

        btn.disabled = true;
        spinner.classList.remove('d-none');
        text.textContent = 'Logging in...';
    });
</script>


@endsection
