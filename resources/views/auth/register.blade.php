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
    <div class="col-md-9 col-lg-7">

        <div class="card auth-card border-0">

            {{-- HEADER --}}
            <div class="auth-header">
                <h3 class="fw-bold mb-1">Buat Akun Baru 🚀</h3>
                <p class="mb-0 opacity-75">
                    Daftar untuk mulai berbelanja
                </p>
            </div>

            {{-- BODY --}}
            <div class="auth-body">
                <form method="POST" action="{{ route('register') }}">
                    @csrf

                    {{-- NAME --}}
                    <div class="mb-3">
                        <label for="name" class="form-label fw-semibold">
                            Nama Lengkap
                        </label>

                        <input id="name"
                               type="text"
                               class="form-control @error('name') is-invalid @enderror"
                               name="name"
                               value="{{ old('name') }}"
                               required
                               autofocus>

                        @error('name')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>

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
                               required>

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

                    {{-- CONFIRM PASSWORD --}}
                    <div class="mb-3">
                        <label for="password-confirm" class="form-label fw-semibold">
                            Konfirmasi Password
                        </label>

                        <input id="password-confirm"
                               type="password"
                               class="form-control"
                               name="password_confirmation"
                               required>
                    </div>

                    {{-- BUTTON REGISTER --}}
                    <div class="d-grid mb-4">
                        <button type="submit" class="btn btn-primary btn-auth">
                            Register
                        </button>
                    </div>

                    {{-- DIVIDER --}}
                    <div class="position-relative my-4 text-center">
                        <hr>
                        <span class="position-absolute top-50 start-50 translate-middle bg-white px-3 text-muted">
                            atau daftar dengan
                        </span>
                    </div>

                    {{-- GOOGLE REGISTER --}}
                    <div class="d-grid mb-3">
                        <a href="{{ route('auth.google') }}"
                           class="btn btn-outline-danger btn-auth">
                            <i class="bi bi-google me-2"></i>
                            Daftar dengan Google
                        </a>
                    </div>

                    {{-- LOGIN LINK --}}
                    <p class="text-center mb-0">
                        Sudah punya akun?
                        <a href="{{ route('login') }}"
                           class="fw-bold text-decoration-none">
                            Login
                        </a>
                    </p>

                </form>
            </div>

        </div>
    </div>
</div>

@endsection
