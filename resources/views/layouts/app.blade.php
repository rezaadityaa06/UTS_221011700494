<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Katalog produk ramah lingkungan untuk tugas UTS Rekayasa Web.">
    <title>@yield('title', 'Beranda') | BumiBaik</title>
    <link rel="stylesheet" href="{{ asset('Bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/site.css') }}">
</head>
<body class="d-flex flex-column min-vh-100">
<a class="visually-hidden-focusable skip-link" href="#content">Langsung ke konten</a>
<nav class="navbar navbar-expand-md bg-white border-bottom py-3" aria-label="Navigasi utama">
    <div class="container">
        <a class="navbar-brand brand" href="{{ route('home') }}"><span class="brand-mark">B</span> BumiBaik<span class="brand-dot">.</span></a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mainNav" aria-controls="mainNav" aria-expanded="false" aria-label="Buka navigasi"><span class="navbar-toggler-icon"></span></button>
        <div class="collapse navbar-collapse" id="mainNav">
            <ul class="navbar-nav ms-auto align-items-md-center gap-md-3">
                <li class="nav-item"><a class="nav-link {{ request()->routeIs('home') ? 'active fw-bold' : '' }}" href="{{ route('home') }}" @if(request()->routeIs('home')) aria-current="page" @endif>Beranda</a></li>
                <li class="nav-item"><a class="nav-link {{ request()->routeIs('products.*') ? 'active fw-bold' : '' }}" href="{{ route('products.index') }}" @if(request()->routeIs('products.*')) aria-current="page" @endif>Katalog Produk</a></li>
            </ul>
        </div>
    </div>
</nav>
<main id="content" class="flex-grow-1">@yield('content')</main>
<footer class="site-footer py-4 mt-auto">
    <div class="container d-md-flex justify-content-between gap-3">
        <div><strong>BumiBaik.</strong><p class="small mb-0">Katalog produk ramah lingkungan</p></div>
        <div class="small mt-3 mt-md-0 text-md-end">Reza Novyan Aditya<br>NIM 221011700494</div>
    </div>
</footer>
<script src="{{ asset('Bootstrap/js/bootstrap.bundle.min.js') }}"></script>
</body>
</html>
