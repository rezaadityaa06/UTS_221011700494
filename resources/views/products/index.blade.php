@extends('layouts.app')

@section('title', 'Katalog Produk')

@section('content')
<section class="catalog-heading py-5">
    <div class="container">
        <span class="eyebrow">TEMUKAN PILIHANMU</span>
        <h1 class="display-5 fw-bold mt-2">Katalog Produk</h1>
        <p class="text-secondary mb-0">
            Lihat material, harga, dan detail setiap produk dalam satu tempat.
        </p>
    </div>
</section>

<section class="container py-4 pb-5">
    <form
        action="{{ route('products.index') }}"
        method="GET"
        class="filter-panel mb-4"
    >
        <div class="row g-3 align-items-end">
            <div class="col-md-9">
                <label for="q" class="form-label fw-semibold">
                    Cari nama atau material
                </label>
                <input
                    type="search"
                    id="q"
                    name="q"
                    class="form-control"
                    value="{{ request('q') }}"
                    placeholder="Misalnya: bambu atau tumbler"
                    maxlength="100"
                >
            </div>

            <div class="col-md-3 d-flex gap-2">
                <button
                    class="btn btn-success flex-grow-1"
                    type="submit"
                >
                    Terapkan
                </button>
                <a
                    href="{{ route('products.index') }}"
                    class="btn btn-outline-secondary"
                >
                    Reset
                </a>
            </div>
        </div>
    </form>

    @if($errors->any())
        <div class="alert alert-warning" role="alert">
            {{ $errors->first() }}
        </div>
    @endif

    <p class="small text-secondary mb-4">
        Menampilkan {{ $products->count() }} produk.
    </p>

    <div class="row g-4">
        @forelse($products as $product)
            @include('components.product-card', ['product' => $product])
        @empty
            <div class="col-12">
                <div class="empty-state text-center py-5">
                    <h2 class="h4">Produk belum ditemukan</h2>
                    <p class="text-secondary">
                        Coba kata kunci lain atau hapus filter pencarian.
                    </p>
                    <a
                        href="{{ route('products.index') }}"
                        class="btn btn-success"
                    >
                        Lihat semua produk
                    </a>
                </div>
            </div>
        @endforelse
    </div>
</section>
@endsection