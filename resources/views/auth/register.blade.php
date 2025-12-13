@extends('layouts.app')

@section('title')
    انشاء حساب جديد
@endsection


@section('content')
<style>
    body {
        background: linear-gradient(135deg, #007bff 0%, #6f42c1 100%);
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }

    .login-card {
        width: 420px;
        background: #fff;
        border-radius: 15px;
        padding: 40px 30px;
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.2);
        animation: fadeIn 0.6s ease;
    }

    @keyframes fadeIn {
        from {
            opacity: 0;
            transform: translateY(30px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .login-title {
        font-weight: bold;
        color: #007bff;
        text-align: center;
        margin-bottom: 25px;
    }

    .form-label {
        font-weight: 600;
    }

    .btn-login {
        background: #007bff;
        border: none;
        font-weight: 600;
        transition: 0.3s;
    }

    .btn-login:hover {
        background: #0056b3;
        transform: translateY(-2px);
    }

    .text-muted a {
        text-decoration: none;
        color: #007bff;
        font-weight: 500;
    }

    .text-muted a:hover {
        text-decoration: underline;
    }
</style>
<div class="container d-flex justify-content-center align-items-center" style="min-height: 100vh;">
    <div class="col-md-6 col-lg-5">
        <div class="card shadow-lg border-0 rounded-4">


            <div class="card-body p-4">
                <form method="POST" action="{{ route('register') }}">
                    @csrf

                    <!-- Name -->
                    <div class="mb-3">
                        <label for="name" class="form-label fw-semibold">{{ __('Full Name') }}</label>
                        <input id="name" type="text"
                            class="form-control form-control-lg @error('name') is-invalid @enderror"
                            name="name" value="{{ old('name') }}" required autocomplete="name" autofocus
                          >

                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Email -->
                    <div class="mb-3">
                        <label for="email" class="form-label fw-semibold">{{ __('Email Address') }}</label>
                        <input id="email" type="email"
                            class="form-control form-control-lg @error('email') is-invalid @enderror"
                            name="email" value="{{ old('email') }}" required autocomplete="email"
                         >

                        @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Password -->
                    <div class="mb-3">
                        <label for="password" class="form-label fw-semibold">{{ __('Password') }}</label>
                        <input id="password" type="password"
                            class="form-control form-control-lg @error('password') is-invalid @enderror"
                            name="password" required autocomplete="new-password" >

                        @error('password')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Confirm Password -->
                    <div class="mb-4">
                        <label for="password-confirm" class="form-label fw-semibold">{{ __('Confirm Password') }}</label>
                        <input id="password-confirm" type="password" class="form-control form-control-lg"
                            name="password_confirmation" required autocomplete="new-password"
                          >
                    </div>

                    <!-- Submit Button -->
                    <div class="d-grid">
                        <button type="submit" class="btn btn-primary btn-lg rounded-3 fw-bold">
                            {{ __('انشاء حساب جديد') }}
                        </button>
                    </div>

                    <!-- Login Link -->
                    <div class="text-center mt-4">
                        <small class="text-muted">

                            <a href="{{ route('login') }}" class="btn btn-dark btn-lg text-white text-decoration-none w-100">
                                تسجيل الدخول
                            </a>
                        </small>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
