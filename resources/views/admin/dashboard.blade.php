{{-- ================================================
     FILE: resources/views/admin/dashboard.blade.php
     FUNGSI: Dashboard admin dengan statistik
     ================================================ --}}

@extends('layouts.admin')

@section('title', 'Dashboard')
@section('title', 'Dashboard')
@section('page-title', 'Dashboard')

@push('styles')
    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@latest/dist/style.css" rel="stylesheet" />
    <style>
    .glass-card {
    background: rgba(255, 255, 255, 0.08);
    backdrop-filter: blur(12px);
    -webkit-backdrop-filter: blur(12px);
    border-radius: 16px;
    border: 1px solid rgba(255, 255, 255, 0.15);
    box-shadow: 0 8px 32px rgba(0, 0, 0, 0.25);
    color: #fff;
}

.stat-icon {
    width: 52px;
    height: 52px;
    display: flex;
    align-items: center;
    justify-content: center;
    border-radius: 14px;
    background: rgba(13, 110, 253, 0.25);
}

.hover-lift {
    transition: all 0.3s ease;
}

.hover-lift:hover {
    transform: translateY(-4px);
    box-shadow: 0 14px 40px rgba(0, 0, 0, 0.45);
}

    .stat-card {
        background: linear-gradient(145deg, rgba(255,255,255,0.06), rgba(255,255,255,0.02));
        backdrop-filter: blur(14px);
        border-radius: 18px;
        transition: all .3s ease;
        position: relative;
        overflow: hidden;
    }

    .stat-card::after {
        content: '';
        position: absolute;
        inset: 0;
        background: linear-gradient(120deg, transparent, rgba(56,189,248,.25), transparent);
        opacity: 0;
        transition: opacity .3s;
    }

    .stat-card:hover {
        transform: translateY(-6px);
        box-shadow: 0 12px 30px rgba(56,189,248,.25);
    }

    .stat-card:hover::after {
        opacity: 1;
    }

    .stat-icon {
        width: 52px;
        height: 52px;
        border-radius: 14px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 22px;
    }

    .trend-up {
        color: #22c55e;
        font-size: 12px;
    }

    .trend-down {
        color: #ef4444;
        font-size: 12px;
    }

    .glass-card {
        background: rgba(255,255,255,0.04);
        backdrop-filter: blur(16px);
        border-radius: 20px;
        border: 1px solid rgba(255,255,255,0.06);
    }

    table tbody tr:hover {
        background: rgba(56,189,248,0.08);
    }

    .order-bar {
    background: rgba(255,255,255,0.06);
    border-radius: 16px;
    padding: 16px 18px;
    margin-bottom: 12px;
    display: flex;
    align-items: center;
    justify-content: space-between;
    transition: all .25s ease;
    border-left: 6px solid transparent;
    }

    .order-bar:hover {
        transform: translateX(6px);
        background: rgba(56,189,248,0.12);
    }
    
    .order-left {
        flex: 1;
    }
    
    .order-number {
        font-weight: 600;
    }
    
    .order-meta {
        font-size: 13px;
        color: #94a3b8;
    }
    
    .order-amount {
        font-weight: 600;
    }
    
    .order-status {
        min-width: 120px;
        text-align: right;
    }
    
    .order-date {
        font-size: 12px;
        color: #94a3b8;
    }

</style>
@endpush
@section('content')
    {{-- Stats Cards --}}
    {{-- Data $stats dikirim dari Admin/DashboardController --}}
    <div class="row g-4 mb-4">
    {{-- Total Revenue --}}
        <div class="col-sm-6 col-xl-3">
        <div class="stat-card p-4 h-100">
            <div class="d-flex justify-content-between">
                <div>
                    <small class="text-white">Total Pendapatan</small>
                    <h4 class="mt-1 mb-1 text-white">
                        Rp {{ number_format($stats['total_revenue'], 0, ',', '.') }}
                    </h4>
                    <span class="trend-up">
                        <i class="bi bi-arrow-up"></i> +12% bulan ini
                    </span>
                </div>
                <div class="stat-icon bg-success bg-opacity-20 text-white">
                    <i class="bi bi-wallet2"></i>
                </div>
            </div>
        </div>
        </div>

    {{-- Orders --}}
        <div class="col-sm-6 col-xl-3">
        <div class="stat-card p-4 h-100">
            <div class="d-flex justify-content-between">
                <div>
                    <small class="text-white">Total Pesanan</small>
                    <h4 class="mt-1 mb-1 text-white">{{ $stats['total_orders'] }}</h4>
                    <span class="trend-up">
                        <i class="bi bi-graph-up"></i> Aktif
                    </span>
                </div>
                <div class="stat-icon bg-primary bg-opacity-20 text-white">
                    <i class="bi bi-bag-check"></i>
                </div>
            </div>
        </div>
        </div>

    {{-- Pending --}}
        <div class="col-sm-6 col-xl-3">
        <div class="stat-card p-4 h-100">
            <div class="d-flex justify-content-between">
                <div>
                    <small class="text-white">Perlu Diproses</small>
                    <h4 class="mt-1 mb-1 text-white">{{ $stats['pending_orders'] }}</h4>
                    <span class="trend-down">
                        <i class="bi bi-clock"></i> Menunggu
                    </span>
                </div>
                <div class="stat-icon bg-warning bg-opacity-20 text-white">
                    <i class="bi bi-hourglass-split"></i>
                </div>
            </div>
        </div>
        </div>

    {{-- Stock --}}
        <div class="col-sm-6 col-xl-3">
            <div class="stat-card p-4 h-100">
                <div class="d-flex justify-content-between">
                    <div>
                        <small class="text-white">Stok Menipis</small>
                        <h4 class="mt-1 mb-1 text-white">{{ $stats['low_stock'] }}</h4>
                        <span class="trend-down">
                            <i class="bi bi-exclamation-triangle"></i> Perlu restock
                        </span>
                    </div>
                    <div class="stat-icon bg-danger bg-opacity-20 text-white">
                        <i class="bi bi-box2-heart"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="row g-4">
        {{-- Recent Orders --}}
        <div class="col-lg-8">
            <div class="glass-card p-4">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h5 class="mb-0 text-white">Pesanan Terbaru</h5>
                    <a href="{{ route('admin.orders.index') }}" class="btn btn-sm btn-outline-info">
                        Lihat Semua
                    </a>
                </div>
        
                @foreach($recentOrders as $order)
                    <a href="{{ route('admin.orders.show', $order) }}" class="text-decoration-none text-white">
                        <div class="order-bar border-{{ $order->status_color }}">
                            {{-- Kiri --}}
                            <div class="order-left">
                                <div class="order-number">
                                    #{{ $order->order_number }}
                                </div>
                                <div class="order-meta">
                                    {{ $order->user->name }} •
                                    Rp {{ number_format($order->total_amount, 0, ',', '.') }}
                                </div>
                            </div>
        
                            {{-- Kanan --}}
                            <div class="order-status">
                                <span class="badge rounded-pill bg-{{ $order->status_color }}">
                                    {{ ucfirst($order->status) }}
                                </span>
                                <div class="order-date mt-1">
                                    {{ $order->created_at->diffForHumans() }}
                                </div>
                            </div>
                        </div>
                    </a>
                @endforeach
        
                @if($recentOrders->isEmpty())
                    <div class="text-center text-muted py-4">
                        Belum ada pesanan
                    </div>
                @endif
            </div>
        </div>


        {{-- Quick Actions --}}
        <div class="col-lg-4">
          <div class="glass-card p-4">
            <h5 class="mb-3 text-white">Aksi Cepat</h5>

            <div class="d-grid gap-2">
               <a href="" class="btn btn-primary">
                   <i class="bi bi-plus-circle me-2"></i> Tambah Produk
               </a>
               <a href="" class="btn btn-outline-info">
                   <i class="bi bi-folder-plus me-2"></i> Kelola Kategori
               </a>
               <a href="{{ route('admin.reports.sales') }}" class="btn btn-outline-primary">
                            <i class="bi bi-file-earmark-bar-graph me-2"></i> Lihat Laporan
               </a>
              {{-- <ul class="nav flex-column sidebar position-relative">
    <li class="nav-item">
        <a href="{{ route('admin.reports.sales') }}"
           class="nav-link d-flex align-items-center">
            <i class="bi bi-graph-up me-2"></i>
            Laporan Penjualan
        </a>
    </li>
</ul> --}}
            </div>
          </div>
        </div>

    </div>
    <div class="row g-4 mb-4">
        {{-- 1. Stats Cards Grid --}}

        {{-- Revenue Card --}}
        <div class="col-sm-6 col-xl-3">
            <div class="card border-0 shadow-sm border-start border-4 border-success h-100">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <p class="text-muted text-uppercase fw-semibold mb-1" style="font-size: 0.8rem">Total Pendapatan</p>
                            <h4 class="fw-bold mb-0 text-success">
                                Rp {{ number_format($stats['total_revenue'], 0, ',', '.') }}
                            </h4>
                        </div>
                        <div class="bg-success bg-opacity-10 p-3 rounded">
                            <i class="bi bi-wallet2 text-success fs-3"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Pending Action Card --}}
        <div class="col-sm-6 col-xl-3">
            <div class="card border-0 shadow-sm border-start border-4 border-warning h-100">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <p class="text-muted text-uppercase fw-semibold mb-1" style="font-size: 0.8rem">Perlu Diproses</p>
                            <h4 class="fw-bold mb-0 text-warning">
                                {{ $stats['pending_orders'] }}
                            </h4>
                        </div>
                        <div class="bg-warning bg-opacity-10 p-3 rounded">
                            <i class="bi bi-box-seam text-warning fs-3"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Low Stock Card --}}
        <div class="col-sm-6 col-xl-3">
            <div class="card border-0 shadow-sm border-start border-4 border-danger h-100">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <p class="text-muted text-uppercase fw-semibold mb-1" style="font-size: 0.8rem">Stok Menipis</p>
                            <h4 class="fw-bold mb-0 text-danger">
                                {{ $stats['low_stock'] }}
                            </h4>
                        </div>
                        <div class="bg-danger bg-opacity-10 p-3 rounded">
                            <i class="bi bi-exclamation-triangle text-danger fs-3"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Total Products --}}
<div class="col-sm-6 col-xl-3">
        <div class="stat-card p-4 h-100">
            <div class="d-flex justify-content-between">
                <div>
                    <small class="text-white">Total Produk</small>
                    <h4 class="mt-1 mb-1 text-white">{{ $stats['total_products'] }}</h4>
                    <span class="trend-down">
                        <i class="bi bi-clock"></i> Menunggu
                    </span>
                </div>
                <div class="stat-icon bg-warning bg-opacity-20 text-white">
                    <i class="bi bi-hourglass-split"></i>
                </div>
            </div>
        </div>
        </div>

    </div>

    <div class="row g-4">
        {{-- 2. Revenue Chart --}}
        <div class="col-lg-8">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-header bg-white py-3">
                    <h5 class="card-title mb-0">Grafik Penjualan (7 Hari)</h5>
                </div>
                <div class="card-body">
                    <canvas id="revenueChart" height="100"></canvas>
                </div>
            </div>
        </div>

        {{-- 3. Recent Orders --}}
        <div class="col-lg-4">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-header bg-white py-3">
                    <h5 class="card-title mb-0">Pesanan Terbaru</h5>
                </div>
                <div class="card-body p-0">
                    <div class="list-group list-group-flush">
                        @foreach($recentOrders as $order)
                            <div class="list-group-item d-flex justify-content-between align-items-center px-4 py-3">
                                <div>
                                    <div class="fw-bold text-primary">#{{ $order->order_number }}</div>
                                    <small class="text-muted">{{ $order->user->name }}</small>
                                </div>
                                <div class="text-end">
                                    <div class="fw-bold">Rp {{ number_format($order->total_amount, 0, ',', '.') }}</div>
                                    <span class="badge rounded-pill
                                        {{ $order->payment_status == 'paid' ? 'bg-success bg-opacity-10 text-success' : 'bg-secondary bg-opacity-10 text-secondary' }}">
                                        {{ ucfirst($order->status) }}
                                    </span>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
                <div class="card-footer bg-white text-center py-3">
                    <a href="{{ route('admin.orders.index') }}" class="text-decoration-none fw-bold">
                        Lihat Semua Pesanan &rarr;
                    </a>
                </div>
            </div>
        </div>
    </div>

    {{-- 4. Top Selling Products --}}
    <div class="card border-0 shadow-sm mt-4">
        <div class="card-header bg-white py-3">
            <h5 class="card-title mb-0">Produk Terlaris</h5>
        </div>
        <div class="card-body">
            <div class="row g-4">
                @foreach($topProducts as $product)
                    <div class="col-6 col-md-2 text-center">
                        <div class="card h-100 border-0 hover-shadow transition">
                            <img src="{{ $product->image_url }}" class="card-img-top rounded mb-2" style="max-height: 100px; object-fit: cover;">
                            <h6 class="card-title text-truncate" style="font-size: 0.9rem">{{ $product->name }}</h6>
                            <small class="text-muted">{{ $product->sold }} terjual</small>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    {{-- Script Chart.js --}}
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        const ctx = document.getElementById('revenueChart').getContext('2d');

        // Data dari Controller (Blade to JS)
        const labels = {!! json_encode($revenueChart->pluck('date')) !!};
        const data = {!! json_encode($revenueChart->pluck('total')) !!};

        new Chart(ctx, {
            type: 'line', // Jenis grafik: Line chart
            data: {
                labels: labels,
                datasets: [{
                    label: 'Pendapatan (Rp)',
                    data: data,
                    borderColor: '#0d6efd', // Bootstrap Primary Color
                    backgroundColor: 'rgba(13, 110, 253, 0.1)',
                    borderWidth: 2,
                    tension: 0.3, // Membuat garis sedikit melengkung (smooth)
                    fill: true,
                    pointRadius: 4,
                    pointHoverRadius: 6
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false, // Penting agar Chart menyesuaikan container
                plugins: {
                    legend: { display: false },
                    tooltip: {
                        callbacks: {
                            label: function(context) {
                                // Format Tooltip jadi Rupiah
                                return 'Rp ' + new Intl.NumberFormat('id-ID').format(context.raw);
                            }
                        }
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        grid: { borderDash: [2, 4] },
                        ticks: {
                            callback: function(value) {
                                return 'Rp ' + new Intl.NumberFormat('id-ID', { notation: "compact" }).format(value);
                            }
                        }
                    },
                    x: {
                        grid: { display: false }
                    }
                }
            }
        });
    </script>
@endsection