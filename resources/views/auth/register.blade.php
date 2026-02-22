@extends('layouts.guest')

@section('content')

<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-6">

            <div class="card shadow-lg border-0 rounded-4">
                <div class="card-body p-5">

                    <h3 class="text-center mb-4 fw-bold">
                        Create Account
                    </h3>
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif


                    <form method="POST" action="{{ route('register') }}" id="registerForm">
                        @csrf

                        <!-- First Name -->
                        <div class="mb-3">
                            <label class="form-label">First Name</label>
                            <input type="text"
                                   name="first_name"
                                   value="{{ old('first_name') }}"
                                   class="form-control @error('first_name') is-invalid @enderror"
                                   required>

                            @error('first_name')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <!-- Last Name -->
                        <div class="mb-3">
                            <label class="form-label">Last Name</label>
                            <input type="text"
                                   name="last_name"
                                   value="{{ old('last_name') }}"
                                   class="form-control @error('last_name') is-invalid @enderror"
                                   required>

                            @error('last_name')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <!-- Email -->
                        <div class="mb-3">
                            <label class="form-label">Email Address</label>
                            <input type="email"
                                   name="email"
                                   value="{{ old('email') }}"
                                   class="form-control @error('email') is-invalid @enderror"
                                   required>

                            @error('email')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <!-- Phone -->
                        <div class="mb-3">
                            <label class="form-label">Phone Number</label>
                            <input type="text"
                                   name="phone"
                                   value="{{ old('phone') }}"
                                   class="form-control @error('phone') is-invalid @enderror">

                            @error('phone')
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

                        <!-- Confirm Password -->
                        <div class="mb-3">
                            <label class="form-label">Confirm Password</label>
                            <input type="password"
                                   name="password_confirmation"
                                   class="form-control"
                                   required>
                        </div>

                        <!-- Submit -->
                        <div class="d-grid mb-3">
                            <button type="submit" id="registerBtn" class="btn btn-dark btn-lg rounded-3">
                                <span id="registerText">Create Account</span>
                                <span id="registerSpinner"
                                      class="spinner-border spinner-border-sm ms-2 d-none"
                                      role="status"></span>
                            </button>
                        </div>

                        <div class="text-center">
                            <span class="text-muted">Already have an account?</span>
                            <a href="{{ route('login') }}" class="text-decoration-none">
                                Log in
                            </a>
                        </div>

                    </form>

                </div>
            </div>

        </div>
    </div>
</div>

<script>
    document.getElementById('registerForm').addEventListener('submit', function () {
        const btn = document.getElementById('registerBtn');
        const spinner = document.getElementById('registerSpinner');
        const text = document.getElementById('registerText');

        btn.disabled = true;
        spinner.classList.remove('d-none');
        text.textContent = 'Creating account...';
    });
</script>

@endsection
