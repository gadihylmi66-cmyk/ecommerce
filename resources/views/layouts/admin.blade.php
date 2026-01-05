{{-- ================================================
     FILE: resources/views/layouts/admin.blade.php
     FUNGSI: Master layout untuk halaman admin
     ================================================ --}}

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title') - Admin Panel</title>

    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
    body {
    font-family: 'Inter', sans-serif;
    min-height: 100vh;

    background: radial-gradient(circle at 20% 20%, #003975, transparent 40%),
                radial-gradient(circle at 80% 80%, #000000, transparent 40%),
                linear-gradient(120deg, #020617, #020617);

    background-size: 200% 200%;
    animation: gradientMove 18s ease infinite;
    }
    
    @keyframes gradientMove {
        0% {
            background-position: 0% 50%;
        }
        50% {
            background-position: 100% 50%;
        }
        100% {
            background-position: 0% 50%;
        }
    }


    /* Sidebar */
    .sidebar {
        min-height: 100vh;
        background: rgba(15, 23, 42, 0.7);
        backdrop-filter: blur(18px);
        border-right: 1px solid rgba(255,255,255,0.08);
        box-shadow: inset -1px 0 0 rgba(255,255,255,0.05);
    }

    .sidebar a {
        text-decoration: none;
    }

    .sidebar .nav-link {
        color: rgba(255,255,255,0.65);
        padding: 12px 18px;
        border-radius: 12px;
        margin: 6px 12px;
        display: flex;
        align-items: center;
        gap: 10px;
        transition: all .25s ease;
    }

    .sidebar .nav-link:hover {
        background: rgba(56, 189, 248, 0.15);
        color: #fff;
        transform: translateX(4px);
        box-shadow: 0 0 12px rgba(56,189,248,.4);
    }

    .sidebar .nav-link.active {
        background: linear-gradient(135deg, #38bdf8, #6366f1);
        color: #ffffff;
        box-shadow: 0 0 18px rgba(99,102,241,.6);
    }

    .sidebar .nav-link i {
        font-size: 1.1rem;
    }

    /* Brand */
    .sidebar .border-bottom {
        border-color: rgba(255,255,255,0.1) !important;
    }

    /* Topbar */
    header {
        background: rgba(83, 7, 135, 0.6);
        backdrop-filter: blur(16px);
        border-bottom: 1px solid rgba(255,255,255,0.08);
        color: #000000;
    }

    header h4 {
        font-weight: 600;
        letter-spacing: .3px;
    }

    /* Main content */
    main {
        background: rgba(255,255,255,0.03);
        border-radius: 18px;
        box-shadow: inset 0 0 0 1px rgba(255,255,255,0.04);
    }

    /* Badge */
    .badge {
        border-radius: 999px;
        padding: 5px 10px;
        font-size: 11px;
    }

    /* User card */
    .sidebar img {
        border: 2px solid #38bdf8;
        box-shadow: 0 0 10px rgba(56,189,248,.6);
    }

    /* Buttons */
    .btn-outline-secondary {
        border-color: rgba(255,255,255,0.3);
        color: #fff;
    }

    .btn-outline-secondary:hover {
        background: #38bdf8;
        border-color: #38bdf8;
        color: #020617;
    }

    .btn-outline-danger:hover {
        box-shadow: 0 0 10px rgba(239,68,68,.6);
    }
</style>

    @stack('styles')
</head>
<body class="bg-light">
    <div class="d-flex">
        {{-- Sidebar --}}
        <div class="sidebar d-flex flex-column" style="width: 260px;">
            {{-- Brand --}}
            <div class="p-3 border-bottom border-secondary">
                <a href="{{ route('admin.dashboard') }}" class="text-white text-decoration-none d-flex align-items-center">
                    <i class="bi bi-shop fs-4 me-2"></i>
                    <span class="fs-5 fw-bold">Admin Panel</span>
                </a>
            </div>

            {{-- Navigation --}}
            <nav class="flex-grow-1 py-3">
                <ul class="nav flex-column">
                    <li class="nav-item">
                        <a href="{{ route('admin.dashboard') }}"
                           class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                            <i class="bi bi-speedometer2 me-2"></i> Dashboard
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="{{ route('admin.products.index') }}"
                           class="nav-link {{ request()->routeIs('admin.products.*') ? 'active' : '' }}">
                            <i class="bi bi-box-seam me-2"></i> Produk
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="{{ route('admin.categories.index') }}"
                           class="nav-link {{ request()->routeIs('admin.categories.*') ? 'active' : '' }}">
                            <i class="bi bi-folder me-2"></i> Kategori
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="{{ route('admin.orders.index') }}"
                           class="nav-link {{ request()->routeIs('admin.orders.*') ? 'active' : '' }}">
                            <i class="bi bi-receipt me-2"></i> Pesanan
                            {{-- Logic PHP di View ini hanya untuk contoh.
                                 Best Practice: Gunakan View Composer atau inject variable dari Controller.
                                 Jangan query database langsung di Blade view di production app! --}}
                            @php
                                $pendingCount = \App\Models\Order::where('status', 'pending')
                                    ->where('payment_status', 'paid')->count();
                            @endphp
                            @if($pendingCount > 0)
                                <span class="badge bg-warning text-dark ms-auto">{{ $pendingCount }}</span>
                            @endif
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href=""
                           class="nav-link {{ request()->routeIs('admin.users.*') ? 'active' : '' }}">
                            <i class="bi bi-people me-2"></i> Pengguna
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href=" {{ route('admin.reports.sales') }}"
                           class="nav-link {{ request()->routeIs('admin.reports.sales*') ? 'active' : '' }}">
                            <i class="b bi-graph-up me-2"></i> Laporan Penjualan
                        </a>
                    </li>
                </ul>
            </nav>

            {{-- User Info --}}
            <div class="p-3 border-top border-secondary">
                <div class="d-flex align-items-center text-white">
                    <img src="{{ auth()->user()->avatar_url }}"
                         class="rounded-circle me-2" width="36" height="36">
                    <div class="flex-grow-1">
                        <div class="small fw-medium">{{ auth()->user()->name }}</div>
                        <div class="small text-muted">Administrator</div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Main Content --}}
        <div class="flex-grow-1">
            {{-- Top Bar --}}
            <header class=" shadow-sm py-3 px-4 d-flex justify-content-between align-items-center">
                <h4 class="mb-0 text-white">@yield('page-title', 'Dashboard')</h4>
                <div class="d-flex align-items-center">
                    <a href="{{ route('home') }}" class="btn btn-outline-secondary btn-sm me-2" target="_blank">
                        <i class="bi bi-box-arrow-up-right me-1"></i> Lihat Toko
                    </a>
                    <form method="POST" action="{{ route('logout') }}" class="d-inline">
                        @csrf
                        <button type="submit" class="btn btn-outline-danger btn-sm">
                            <i class="bi bi-box-arrow-right me-1"></i> Logout
                        </button>
                    </form>
                </div>
            </header>

            {{-- Flash Messages --}}
            <div class="px-4 pt-3">
                @include('partials.flash-messages')
            </div>

            {{-- Page Content --}}
            <main class="p-4">
                @yield('content')
            </main>
        </div>
    </div>

    @stack('scripts')
</body>
</html>