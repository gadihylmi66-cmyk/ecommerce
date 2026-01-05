{{-- ========================================
FILE: resources/views/layouts/app.blade.php
FUNGSI: Template utama yang digunakan semua halaman
======================================== --}}

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
{{-- ↑ Contoh: en_US → en-US --}}

<head>
    <meta charset="utf-8">
    {{-- ↑ Encoding UTF-8 --}}

    <meta name="viewport" content="width=device-width, initial-scale=1">
    {{-- ↑ Responsive layout --}}

    <meta name="csrf-token" content="{{ csrf_token() }}">
    {{-- ↑ CSRF Token untuk keamanan request POST --}}

    <title>@yield('title', config('app.name', 'Toko Online'))</title>

    <link rel="icon" href="{{ asset('favicon.ico') }}">

    {{-- ================= FONT ================= --}}
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link
        href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap"
        rel="stylesheet">

    {{-- ================= BOOTSTRAP ICONS (WAJIB) ================= --}}
    <link
        rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">

    {{-- ================= VITE ASSETS ================= --}}
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])

    {{-- Stack CSS tambahan --}}
    @stack('styles')

    {{-- ================= GLOBAL STYLE ================= --}}
    <style>
        body {
            font-family: 'Inter', 'Nunito', system-ui, sans-serif;
            background-color: #f8fafc;
        }

        main {
            min-height: 100vh;
        }
    </style>
</head>

<body>

    {{-- ================= NAVBAR ================= --}}
    @include('partials.navbar')

    {{-- ================= FLASH MESSAGE ================= --}}
    <div class="container mt-3">
        @include('partials.flash-messages')
    </div>

    {{-- ================= MAIN CONTENT ================= --}}
    <main>
        @yield('content')
    </main>

    {{-- ================= FOOTER ================= --}}
    @include('partials.footer')

    {{-- =====================================================
         WISHLIST AJAX SCRIPT (Modern Fetch API)
         ===================================================== --}}
    <script>
        /**
         * Toggle Wishlist menggunakan Fetch API
         */
        async function toggleWishlist(productId) {
            try {
                const token = document
                    .querySelector('meta[name="csrf-token"]')
                    .getAttribute('content');

                const response = await fetch(`/wishlist/toggle/${productId}`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': token
                    }
                });

                if (response.status === 401) {
                    window.location.href = '/login';
                    return;
                }

                const data = await response.json();

                if (data.status === 'success') {
                    updateWishlistUI(productId, data.added);
                    updateWishlistCounter(data.count);
                    showToast(data.message);
                }
            } catch (error) {
                console.error(error);
                showToast('Terjadi kesalahan sistem', 'error');
            }
        }

        function updateWishlistUI(productId, isAdded) {
            document
                .querySelectorAll(`.wishlist-btn-${productId}`)
                .forEach(btn => {
                    const icon = btn.querySelector('i');

                    if (isAdded) {
                        icon.classList.remove('bi-heart', 'text-secondary');
                        icon.classList.add('bi-heart-fill', 'text-danger');
                    } else {
                        icon.classList.remove('bi-heart-fill', 'text-danger');
                        icon.classList.add('bi-heart', 'text-secondary');
                    }
                });
        }

        function updateWishlistCounter(count) {
            const badge = document.getElementById('wishlist-count');
            if (badge) {
                badge.textContent = count;
                badge.style.display = count > 0 ? 'inline-block' : 'none';
            }
        }
    </script>

    {{-- Stack JS tambahan --}}
    @stack('scripts')

</body>
</html>
