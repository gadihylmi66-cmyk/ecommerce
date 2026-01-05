@extends('layouts.app')

@section('content')

<style>
    body {
        background: linear-gradient(135deg, #4f46e5, #06b6d4);
    }

    .auth-card {
        border-radius: 20px;
        overflow: hidden;
        box-shadow: 0 25px 50px rgba(0,0,0,.15);
    }

    .auth-header {
        background: linear-gradient(135deg, #6366f1, #0ea5e9);
        color: white;
        padding: 2rem;
        text-align: center;
    }

    .auth-body {
        padding: 2rem;
        background: #ffffff;
    }

    .form-control {
        border-radius: 12px;
    }

    .btn-auth {
        border-radius: 999px;
        padding: .6rem 1.5rem;
    }
</style>

<div class="container min-vh-100 d-flex align-items-center justify-content-center">
    <div class="col-md-8 col-lg-6">

        <div class="card auth-card border-0">

            {{-- HEADER --}}
            <div class="auth-header">
                <h3 class="fw-bold mb-1">Selamat Datang 👋</h3>
                <p class="mb-0 opacity-75">Silakan login untuk melanjutkan</p>
            </div>

            {{-- BODY --}}
            <div class="auth-body">
                <form method="POST" action="{{ route('login') }}">
                    @csrf

                    {{-- EMAIL --}}
                    <div class="mb-3">
                        <label for="email" class="form-label fw-semibold">
                            Email Address
                        </label>

                        <input id="email"
                               type="email"
                               class="form-control @error('email') is-invalid @enderror"
                               name="email"
                               value="{{ old('email') }}"
                               required
                               autofocus>

                        @error('email')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>

                    {{-- PASSWORD --}}
                    <div class="mb-3">
                        <label for="password" class="form-label fw-semibold">
                            Password
                        </label>

                        <input id="password"
                               type="password"
                               class="form-control @error('password') is-invalid @enderror"
                               name="password"
                               required>

                        @error('password')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>

                    {{-- REMEMBER --}}
                    <div class="mb-3 form-check">
                        <input class="form-check-input"
                               type="checkbox"
                               name="remember"
                               id="remember"
                               {{ old('remember') ? 'checked' : '' }}>

                        <label class="form-check-label" for="remember">
                            Remember Me
                        </label>
                    </div>

                    {{-- BUTTON --}}
                    <div class="d-grid mb-3">
                        <button type="submit" class="btn btn-primary btn-auth">
                            Login
                        </button>
                    </div>

                    {{-- FORGOT --}}
                    @if (Route::has('password.request'))
                        <div class="text-center">
                            <a class="text-decoration-none" href="{{ route('password.request') }}">
                                Lupa password?
                            </a>
                        </div>
                    @endif

                </form>
            </div>

        </div>
    </div>
</div>

@endsection
