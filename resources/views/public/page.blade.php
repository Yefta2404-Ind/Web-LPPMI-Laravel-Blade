@extends('layouts.public')

@section('title', $page->title)

@push('styles')
<style>
/* ===== HERO PAGE ===== */
.page-hero {
    background-color: var(--primary);
    background-size: cover;
    background-position: center;
    padding: 80px 0;
    position: relative;
    overflow: hidden;
}

/* Overlay gelap agar teks terbaca */
.page-hero::before {
    content: '';
    position: absolute;
    inset: 0;
    background: linear-gradient(135deg, rgba(5,26,43,0.82) 0%, rgba(10,42,68,0.65) 100%);
    z-index: 0;
}

/* Garis emas bawah */
.page-hero::after {
    content: '';
    position: absolute;
    bottom: 0; left: 0; right: 0;
    height: 3px;
    background: linear-gradient(90deg, var(--gold-dark), var(--gold-light), var(--gold-dark));
    z-index: 1;
}

/* Dekorasi lingkaran */
.page-hero-decor {
    position: absolute;
    top: -80px; right: -80px;
    width: 350px; height: 350px;
    border-radius: 50%;
    border: 60px solid rgba(255,255,255,0.04);
    pointer-events: none;
    z-index: 0;
}

.page-hero-content {
    position: relative;
    z-index: 1;
}

.page-hero-label {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    font-size: 0.7rem;
    font-weight: 700;
    letter-spacing: 0.12em;
    text-transform: uppercase;
    color: var(--gold-light);
    margin-bottom: 12px;
}

.page-hero-label::before {
    content: '';
    width: 20px; height: 2px;
    background: var(--gold-light);
    border-radius: 2px;
}

.page-hero h1 {
    color: #ffffff !important;
    font-size: 2.4rem;
    font-weight: 700;
    margin: 0;
    letter-spacing: -0.02em;
    line-height: 1.2;
}

.page-breadcrumb {
    display: flex;
    align-items: center;
    gap: 8px;
    margin-top: 16px;
    font-size: 0.82rem;
    color: rgba(255,255,255,0.6);
    flex-wrap: wrap;
}

.page-breadcrumb a {
    color: rgba(255,255,255,0.6);
    text-decoration: none;
    transition: color 0.2s;
}

.page-breadcrumb a:hover { color: var(--gold-light); }
.page-breadcrumb .separator { color: rgba(255,255,255,0.3); }
.page-breadcrumb .current { color: var(--gold-light); }

/* ===== PAGE CONTENT ===== */
.page-content {
    font-size: 0.97rem;
    line-height: 1.8;
    color: #374151;
}

/* ===== TABLE ===== */
.page-content table {
    width: 100% !important;
    border-collapse: collapse !important;
    margin: 24px 0 !important;
}

.page-content table td,
.page-content table th {
    border: 1px solid #dee2e6 !important;
    padding: 10px 14px !important;
    vertical-align: top !important;
}

/* Hormati inline style alignment dari TinyMCE */
.page-content table td[style*="text-align: center"] { text-align: center !important; }
.page-content table td[style*="text-align: right"]  { text-align: right !important; }
.page-content table td[style*="text-align: left"]   { text-align: left !important; }

/* Jika ada <thead><th> */
.page-content table thead th {
    background-color: #0a2a44 !important;
    color: #ffffff !important;
    font-weight: 600 !important;
}

/* Jika tidak ada thead — baris pertama tbody dijadikan header */
.page-content table tbody tr:first-child td {
    background-color: #0a2a44 !important;
    color: #ffffff !important;
    font-weight: 600 !important;
}

/* Baris genap */
.page-content table tbody tr:nth-child(even) td {
    background-color: #f8f9fa !important;
}

/* Hover */
.page-content table tbody tr:not(:first-child):hover td {
    background-color: #eef2f6 !important;
}

/* Baris pertama tetap gelap saat hover */
.page-content table tbody tr:first-child:hover td {
    background-color: #0a2a44 !important;
}

/* ===== IMAGES ===== */
.page-content img {
    max-width: 100% !important;
    height: auto !important;
    border-radius: 8px;
    margin: 10px 0;
}

/* ===== HEADINGS ===== */
.page-content h1,
.page-content h2,
.page-content h3,
.page-content h4 {
    color: #0a2a44;
    margin-top: 28px;
    margin-bottom: 12px;
}

/* ===== LINKS ===== */
.page-content a {
    color: #2563eb;
    text-decoration: underline;
}

.page-content a:hover { color: #1e3a5f; }

/* ===== LIST ===== */
.page-content ul,
.page-content ol {
    padding-left: 24px;
    margin-bottom: 16px;
}

.page-content li { margin-bottom: 6px; }

/* ===== RESPONSIVE ===== */
@media (max-width: 767px) {
    .page-hero { padding: 50px 0; }
    .page-hero h1 { font-size: 1.7rem; }

    .page-content table {
        display: block;
        overflow-x: auto;
        -webkit-overflow-scrolling: touch;
    }
}
</style>
@endpush

@section('content')

{{-- Hero Section — background image di inline style agar asset() diproses Blade --}}
<div class="page-hero" style="background-image: url('{{ asset('images/hero.jpg') }}')">
    <div class="page-hero-decor"></div>
    <div class="site-container">
        <div class="page-hero-content">
            <div class="page-hero-label">Halaman</div>
            <h1>{{ $page->title }}</h1>
            <div class="page-breadcrumb">
                <a href="/"><i class="fas fa-home me-1"></i>Beranda</a>
                <span class="separator">/</span>
                <span class="current">{{ $page->title }}</span>
            </div>
        </div>
    </div>
</div>

{{-- Konten --}}
<div class="site-container py-5">
    <div class="page-content">
        {!! $page->content !!}
    </div>
</div>

@endsection