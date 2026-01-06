{{-- ================================================
FILE: resources/views/home.blade.php
FUNGSI: Halaman utama website
================================================ --}}

@extends('layouts.app')

@section('title', 'Beranda')

@section('content')

<style>
/* ===== GLOBAL ===== */
.section-title {
    font-weight: 700;
    letter-spacing: -.5px;
}

/* ===== HERO ===== */
.hero {
    background: linear-gradient(135deg, #4f46e5, #06b6d4);
    color: white;
    position: relative;
    overflow: hidden;
}

.hero::after {
    content: '';
    position: absolute;
    width: 400px;
    height: 400px;
    background: rgba(255,255,255,.15);
    border-radius: 50%;
    top: -100px;
    right: -100px;
}

.hero img {
    animation: float 4s ease-in-out infinite;
}

@keyframes float {
    0%,100% { transform: translateY(0); }
    50% { transform: translateY(-10px); }
}

/* ===== CATEGORY ===== */
.category-card {
    transition: .3s;
    border-radius: 16px;
}

.category-card:hover {
    transform: translateY(-6px);
    box-shadow: 0 15px 30px rgba(0,0,0,.1);
}

/* ===== PRODUCT ===== */
.product-wrapper {
    transition: .3s;
}

.product-wrapper:hover {
    transform: translateY(-5px);
}

/* ===== PROMO ===== */
.promo-card {
    border-radius: 20px;
    position: relative;
    overflow: hidden;
}

.promo-card::after {
    content: '';
    position: absolute;
    width: 200px;
    height: 200px;
    background: rgba(255,255,255,.2);
    border-radius: 50%;
    bottom: -80px;
    right: -80px;
}
</style>

{{-- HERO --}}
<section class="hero py-5">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6">
                <span class="badge bg-light text-primary mb-3">✨ Belanja Aman & Terpercaya</span>
                <h1 class="display-5 fw-bold mb-3">
                    Belanja Online<br>Lebih Mudah & Cepat
                </h1>
                <p class="lead opacity-75 mb-4">
                    Produk berkualitas, harga terbaik, dan pengiriman cepat ke seluruh Indonesia.
                </p>
                <a href="{{ route('catalog.index') }}" class="btn btn-light btn-lg rounded-pill px-4">
                    <i class="bi bi-bag-check me-2"></i> Mulai Belanja
                </a>
            </div>
            <div class="col-lg-6 d-none d-lg-block text-center">
                <img src="{{ asset('images/cable_tester-removebg-preview.png') }}" class="img-fluid" style="max-height:420px;">
            </div>
        </div>
    </div>
</section>

{{-- KATEGORI --}}
<section class="py-5">
    <div class="container">
        <h2 class="section-title text-center mb-4">Kategori Populer</h2>
        <div class="row g-4">
            @foreach($categories as $category)
            <div class="col-6 col-md-4 col-lg-2">
                <a href="{{ route('catalog.index',['category'=>$category->slug]) }}" class="text-decoration-none">
                    <div class="card category-card border-0 shadow-sm text-center h-100">
                        <div class="card-body">
                            <img src="{{ $category->image_url }}" class="rounded-circle mb-3"
                                width="80" height="80" style="object-fit:cover;">
                            <h6 class="mb-1">{{ $category->name }}</h6>
                            <small class="text-muted">{{ $category->products_count }} Produk</small>
                        </div>
                    </div>
                </a>
            </div>
            @endforeach
        </div>
    </div>
</section>

{{-- PRODUK UNGGULAN --}}
<section class="py-5 bg-light">
    <div class="container">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="section-title mb-0">🔥 Produk Unggulan</h2>
            <a href="{{ route('catalog.index') }}" class="btn btn-outline-primary rounded-pill">
                Lihat Semua <i class="bi bi-arrow-right"></i>
            </a>
        </div>
        <div class="row g-4">
            @foreach($featuredProducts as $product)
            <div class="col-6 col-md-4 col-lg-3 product-wrapper">
                @include('partials.product-card', ['product'=>$product])
            </div>
            @endforeach
        </div>
    </div>
</section>

{{-- PROMO --}}
<section class="py-5">
    <div class="container">
        <div class="row g-4">
            <div class="col-md-6">
                <div class="promo-card card bg-warning border-0 h-100">
                    <div class="card-body">
                        <h3 class="fw-bold">⚡ Flash Sale</h3>
                        <p>Diskon hingga <strong>50%</strong> untuk produk pilihan</p>
                        <a href="#" class="btn btn-dark rounded-pill">Lihat Promo</a>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="promo-card card bg-info text-white border-0 h-100">
                    <div class="card-body">
                        <h3 class="fw-bold">🎁 Member Baru</h3>
                        <p>Dapatkan voucher <strong>Rp50.000</strong></p>
                        <a href="{{ route('register') }}" class="btn btn-light rounded-pill">
                            Daftar Sekarang
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- PRODUK TERBARU --}}
<section class="py-5">
    <div class="container">
        <h2 class="section-title text-center mb-4">🆕 Produk Terbaru</h2>
        <div class="row g-4">
            @foreach($latestProducts as $product)
            <div class="col-6 col-md-4 col-lg-3 product-wrapper">
                @include('partials.product-card', ['product'=>$product])
            </div>
            @endforeach
        </div>
    </div>
</section>

@endsection
