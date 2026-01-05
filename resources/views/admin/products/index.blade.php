@extends('layouts.admin')

@section('title', 'Daftar Produk')

@push('styles')
<style>
    /* ===== GLASS CARD ===== */
.glass-table {
    background: linear-gradient(
        135deg,
        rgba(255,255,255,0.08),
        rgba(255,255,255,0.02)
    );
    backdrop-filter: blur(14px);
    -webkit-backdrop-filter: blur(14px);
    border-radius: 18px;
    border: 1px solid rgba(255,255,255,.15);
    box-shadow: 0 20px 50px rgba(0,0,0,.45);
    overflow: hidden;
}

/* ===== TABLE RESET ===== */
.glass-table-inner {
    background: transparent;
    color: #e5e7eb;
}

.glass-table-inner thead th {
    background: rgba(255,255,255,.05);
    color: #c7d2fe;
    font-weight: 600;
    border-bottom: 1px solid rgba(255,255,255,.12);
}

/* ===== ROW ===== */
.glass-table-inner tbody tr {
    background: transparent;
    transition: all .25s ease;
}

.glass-table-inner tbody tr:hover {
    background: rgba(99,102,241,.18);
    transform: scale(1.003);
}

/* ===== CELL ===== */
.glass-table-inner td,
.glass-table-inner th {
    border-color: rgba(255,255,255,.08);
    vertical-align: middle;
}

/* ===== STATUS ===== */
.status-pill {
    padding: 6px 14px;
    border-radius: 999px;
    font-size: 12px;
    font-weight: 600;
}

.status-pill.active {
    background: rgba(34,197,94,.25);
    color: #22c55e;
}

.status-pill.inactive {
    background: rgba(148,163,184,.25);
    color: #94a3b8;
}

/* ===== ACTION BUTTON ===== */
.btn-action {
    padding: 6px 12px;
    border-radius: 10px;
    font-size: 12px;
    background: transparent;
    border: 1px solid transparent;
    transition: .25s;
}

.btn-action.info {
    color: #38bdf8;
    border-color: #38bdf8;
}

.btn-action.warning {
    color: #fbbf24;
    border-color: #fbbf24;
}

.btn-action.danger {
    color: #ef4444;
    border-color: #ef4444;
}

.btn-action:hover {
    color: #fff;
    transform: translateY(-1px);
}

    .page-title {
        color: #fff;
        font-weight: 600;
    }

    .glass-card {
        background: rgba(255,255,255,0.05);
        backdrop-filter: blur(18px);
        border-radius: 20px;
        border: 1px solid rgba(255,255,255,0.08);
        box-shadow: 0 10px 30px rgba(0,0,0,.5);
    }

    .form-control,
    .form-select {
        background: rgba(255,255,255,0.06);
        border: 1px solid rgba(255,255,255,0.12);
        color: #fff;
    }

    .form-control::placeholder {
        color: #94a3b8;
    }

    .form-control:focus,
    .form-select:focus {
        background: rgba(255,255,255,0.08);
        border-color: #6366f1;
        box-shadow: 0 0 0 2px rgba(99,102,241,.35);
        color: #fff;
    }

    .btn-primary {
        background: linear-gradient(135deg, #6366f1, #8b5cf6);
        border: none;
    }

    .btn-primary:hover {
        box-shadow: 0 0 16px rgba(139,92,246,.6);
    }

    .btn-info {
        background: rgba(56,189,248,0.15);
        border: 1px solid #38bdf8;
        color: #38bdf8;
    }

    .btn-warning {
        background: rgba(251,191,36,0.15);
        border: 1px solid #fbbf24;
        color: #fbbf24;
    }

    .btn-danger {
        background: rgba(239,68,68,0.15);
        border: 1px solid #ef4444;
        color: #ef4444;
    }

    .btn-info:hover,
    .btn-warning:hover,
    .btn-danger:hover {
        color: #fff;
    }
</style>
@endpush

@section('content')

{{-- Header --}}
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2 class="page-title">Daftar Produk</h2>
    <a href="{{ route('admin.products.create') }}" class="btn btn-primary">
        <i class="bi bi-plus-circle me-1"></i> Tambah Produk
    </a>
</div>

{{-- Filter --}}
<form method="GET" class="row g-2 mb-4 glass-card p-3">
    <div class="col-md-4">
        <input type="text" name="search" class="form-control"
            placeholder="Cari produk..." value="{{ request('search') }}">
    </div>

    <div class="col-md-4">
        <select name="category" class="form-select">
            <option value="">Semua Kategori</option>
            @foreach($categories as $category)
                <option value="{{ $category->id }}"
                    {{ request('category') == $category->id ? 'selected' : '' }}>
                    {{ $category->name }}
                </option>
            @endforeach
        </select>
    </div>

    <div class="col-md-2">
        <button class="btn btn-outline-info w-100">Filter</button>
    </div>
</form>

{{-- Table --}}
<div class="glass-table">
    <div class="table-responsive">
        <table class="table table-hover align-middle mb-0 glass-table-inner">
            <thead>
                <tr>
                    <th>Gambar</th>
                    <th>Nama</th>
                    <th>Kategori</th>
                    <th>Harga</th>
                    <th>Stok</th>
                    <th>Status</th>
                    <th width="160">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($products as $product)
                <tr>
                    <td class="text-center">
                        <img src="{{ $product->primaryImage?->image_url ?? asset('img/no-image.png') }}"
                             class="rounded" width="55">
                    </td>
                    <td class="fw-semibold">{{ $product->name }}</td>
                    <td class="text-muted">{{ $product->category->name }}</td>
                    <td>Rp {{ number_format($product->price) }}</td>
                    <td>{{ $product->stock }}</td>
                    <td>
                        <span class="status-pill {{ $product->is_active ? 'active' : 'inactive' }}">
                            {{ $product->is_active ? 'Aktif' : 'Nonaktif' }}
                        </span>
                    </td>
                   <td>
                        <a href="{{ route('admin.products.show', $product) }}" class="btn btn-sm btn-info">Detail</a>
                        <a href="{{ route('admin.products.edit', $product) }}" class="btn btn-sm btn-warning">Edit</a>
                        <form action="{{ route('admin.products.destroy', $product) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger">Hapus</button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="7" class="text-center py-5 text-muted">
                        Data produk kosong
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>


{{-- Pagination --}}
<div class="mt-4">
    {{ $products->links('pagination::bootstrap-5') }}
</div>

@endsection
