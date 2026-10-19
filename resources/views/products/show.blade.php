@extends('layouts.app')
@section('title', $product->name)
@section('content')
<section class="container py-4 py-lg-5">
    <nav aria-label="Breadcrumb"><ol class="breadcrumb small mb-4"><li class="breadcrumb-item"><a href="{{ route('home') }}">Beranda</a></li><li class="breadcrumb-item"><a href="{{ route('products.index') }}">Katalog</a></li><li class="breadcrumb-item active" aria-current="page">{{ $product->name }}</li></ol></nav>
    <div class="row g-4 g-lg-5 align-items-start">
        <div class="col-lg-6"><div class="detail-image"><img class="img-fluid w-100" src="{{ asset($product->image) }}" alt="Foto {{ $product->name }}" width="800" height="600"></div></div>
        <div class="col-lg-6">
            <span class="badge badge-soft rounded-pill mb-3">{{ $product->material }}</span>
            <h1 class="display-6 fw-bold mb-3">{{ $product->name }}</h1>
            <p class="price fs-2 fw-bold mb-4">Rp{{ number_format((float) $product->price, 0, ',', '.') }}</p>
            <h2 class="h5 fw-bold">Tentang produk</h2><p class="text-secondary lh-lg">{{ $product->description }}</p>
            <div class="spec-panel my-4"><h2 class="h6 fw-bold mb-3">Informasi produk</h2><dl class="row mb-0"><dt class="col-5">Material</dt><dd class="col-7">{{ $product->eco_rating }}/5</dd><dt class="col-5">Data</dt><dd class="col-7">Referensi IKEA Indonesia</dd></dl></div>
            @if($source = config('catalog_sources.'.$product->name))
            @endif
            <a class="btn btn-success rounded-pill px-4" href="{{ route('products.index') }}">&larr; Kembali ke katalog</a>
        </div>
    </div>
</section>
@endsection
