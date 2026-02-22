@extends('layouts.guest')

@section('content')

<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-5">

            <div class="card shadow-lg border-0 rounded-4">
                <div class="card-body p-5">

                    <h3 class="text-center mb-4 fw-bold">
                        Reset Password
                    </h3>

                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form method="POST" action="{{ route('password.store') }}" id="resetForm">
                        @csrf

                        <!-- Password Reset Token -->
                        <input type="hidden" name="token" value="{{ $request->route('token') }}">

                        <!-- Email Address -->
                        <div class="mb-3">
                            <label class="form-label">Email Address</label>
                            <input type="email"
                                   name="email"
                                   value="{{ old('email', $request->email) }}"
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
                            <label class="form-label">New Password</label>
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
                            <label class="form-label">Confirm New Password</label>
                            <input type="password"
                                   name="password_confirmation"
                                   class="form-control"
                                   required>
                        </div>

                        <!-- Submit -->
                        <div class="d-grid mb-3">
                            <button type="submit" id="resetBtn" class="btn btn-dark btn-lg rounded-3">
                                <span id="resetText">Reset Password</span>
                                <span id="resetSpinner"
                                      class="spinner-border spinner-border-sm ms-2 d-none"
                                      role="status"></span>
                            </button>
                        </div>

                    </form>

                </div>
            </div>

        </div>
    </div>
</div>

<script>
    document.getElementById('resetForm').addEventListener('submit', function () {
        const btn = document.getElementById('resetBtn');
        const spinner = document.getElementById('resetSpinner');
        const text = document.getElementById('resetText');

        btn.disabled = true;
        spinner.classList.remove('d-none');
        text.textContent = 'Resetting...';
    });
</script>

@endsection
