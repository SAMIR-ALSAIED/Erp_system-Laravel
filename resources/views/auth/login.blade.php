@extends('layouts.app')

@section('title')
    تسجيل الدخول
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

<div class="container d-flex justify-content-center align-items-center vh-100">
    <div class="login-card">
        <h3 class="login-title">تسجيل الدخول</h3>

        <form method="POST" action="{{ route('login') }}">
            @csrf

            {{-- Email --}}
            <div dir="rtl" class="mb-3">
                <label for="email" class="form-label">{{ __('الايميل') }}</label>
                <input id="email" type="email"
                       class="form-control @error('email') is-invalid @enderror"
                       name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                @error('email')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            {{-- Password --}}
            <div dir="rtl" class="mb-3">
                <label for="password" class="form-label">{{ __('الباسورد') }}</label>
                <input id="password" type="password"
                       class="form-control @error('password') is-invalid @enderror"
                       name="password" required autocomplete="current-password">

                @error('password')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            {{-- Remember Me --}}
            <div dir="rtl" class="form-check mb-3">
                <input dir="rtl" class="form-check-input float-end ms-2" type="checkbox" name="remember" id="remember"
                       {{ old('remember') ? 'checked' : '' }}>
                <label class="form-check-label" for="remember">
                    {{ __('تذكرنى ') }}
                </label>
            </div>

            {{-- Submit --}}
            <div class="d-grid mb-3">
                <button type="submit" class="btn btn-login btn-lg text-white">
                    {{ __('تسجيل الدخول') }}
                </button>
            </div>

            {{-- Links --}}
            <div class="text-center text-muted">

                <p class="mt-3 mb-0">

                    <a  class="btn btn-dark btn-lg text-white text-decoration-none w-100" href="{{ route('register') }}">{{ __('انشاء حساب') }}</a>
                </p>
            </div>
        </form>
    </div>
</div>
@endsection
