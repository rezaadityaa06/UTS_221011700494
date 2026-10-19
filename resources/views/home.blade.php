@extends('layouts.app')
@section('title', 'Beranda')
@section('content')
<section class="hero-section">
    <div class="container py-5">
        <div class="row align-items-center g-5 py-lg-3">
            <div class="col-lg-6">
                <span class="eyebrow">KATALOG PRODUK RAMAH LINGKUNGAN</span>
                <h1 class="display-4 fw-bold my-4">Pilihan kecil.<br><span class="text-green">Kebiasaan lebih baik.</span></h1>
                <p class="lead text-secondary mb-4">Kenali produk pakai ulang dan material alternatif untuk menemani aktivitas sehari-hari.</p>
                <a href="{{ route('products.index') }}" class="btn btn-success btn-lg rounded-pill px-4">Jelajahi katalog <span aria-hidden="true">&rarr;</span></a>
                <div class="d-flex flex-wrap gap-4 mt-4 small text-secondary"><span><strong class="text-dark">{{ $productCount }}</strong> produk pilihan</span><span>Material dan harga transparan</span></div>
            </div>
            <div class="col-lg-6"><img class="hero-image img-fluid" src="{{ asset('assets/images/hero-eco.svg') }}" alt="Ilustrasi koleksi tas pakai ulang, botol, dan tanaman" width="900" height="700"></div>
        </div>
    </div>
</section>
<section class="container py-5">
    <div class="d-flex flex-wrap justify-content-between align-items-end gap-3 mb-4">
        <div><span class="eyebrow">MULAI DARI SINI</span><h2 class="fw-bold mt-2 mb-0">Kenalan dengan produk ramah lingkungan</h2></div>
        <a class="text-green fw-semibold" href="{{ route('products.index') }}">Lihat semua produk &rarr;</a>
    </div>
    <div class="row g-4">@forelse($featuredProducts as $product) @include('components.product-card', ['product' => $product]) @empty <p>Belum ada produk. Jalankan seeder untuk mengisi katalog.</p> @endforelse</div>
</section>
@endsection
