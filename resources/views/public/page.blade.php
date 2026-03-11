@extends('layouts.public')

@section('title', $page->title)

@section('styles')
<style>
/* ===== VARIABLES ===== */
:root {
    --primary: #0a2a44;
    --primary-dark: #051a2b;
    --primary-light: #1e3a5f;
    --gold: #c9a84c;
    --gold-light: #e5c76b;
    --gold-dark: #b08a35;
    --text-dark: #1f2937;
    --text-light: #4b5563;
    --white: #ffffff;
    --off-white: #f8fafc;
    --gray-border: #e2e8f0;
    --gray-light: #f3f4f6;
    --transition: all 0.3s ease;
}

/* ===== CONTAINER ===== */
.site-container {
    width: 100%;
    max-width: 1280px;
    margin: 0 auto;
    padding: 0 20px;
}

@media (max-width: 640px) {
    .site-container {
        padding: 0 16px;
    }
}

/* ===== HERO SECTION ===== */
.page-hero {
    background-color: var(--primary);
    background-size: cover;
    background-position: center;
    background-repeat: no-repeat;
    position: relative;
    overflow: hidden;
    min-height: 420px;
    display: flex;
    align-items: center;
    padding: 160px 0 80px;
}

/* Overlay gelap */
.page-hero::before {
    content: '';
    position: absolute;
    inset: 0;
    background: linear-gradient(
        105deg,
        rgba(5, 26, 43, 0.92) 0%,
        rgba(10, 42, 68, 0.80) 60%,
        rgba(10, 42, 68, 0.60) 100%
    );
    z-index: 0;
}

/* Garis emas bawah */
.page-hero::after {
    content: '';
    position: absolute;
    bottom: 0;
    left: 0;
    right: 0;
    height: 3px;
    background: linear-gradient(90deg, var(--gold-dark), var(--gold-light), var(--gold-dark));
    z-index: 2;
}

.page-hero-content {
    position: relative;
    z-index: 1;
    width: 100%;
    text-align: left;
    padding: 20px 0;
}

/* Breadcrumb */
.page-hero-breadcrumb {
    display: flex;
    align-items: center;
    flex-wrap: wrap;
    gap: 6px;
    margin-bottom: 12px;
    font-size: 0.78rem;
    color: #ffffff !important;
    font-weight: 500;
    letter-spacing: 0.03em;
}

.page-hero-breadcrumb a {
    color: #ffffff !important;
    text-decoration: none;
    transition: color 0.2s;
}

.page-hero-breadcrumb a:hover {
    color: var(--gold-light);
}

.page-hero-breadcrumb .separator {
    color: #ffffff !important;
    opacity: 0.6;
}

.page-hero-breadcrumb .current {
    color: #ffffff !important;
    opacity: 0.85;
}

/* Garis aksen kiri */
.page-hero-title-wrap {
    display: flex;
    align-items: center;
    gap: 16px;
}

.page-hero-title-wrap::before {
    content: '';
    display: block;
    width: 4px;
    height: 100%;
    min-height: 36px;
    background: linear-gradient(to bottom, var(--gold-light), var(--gold-dark));
    border-radius: 4px;
    flex-shrink: 0;
}

.page-hero-title {
    color: #ffffff !important;
    font-size: 1.9rem;
    font-weight: 700;
    margin: 0;
    letter-spacing: -0.01em;
    line-height: 1.25;
    text-shadow: 0 2px 12px rgba(0,0,0,0.35);
    word-break: break-word;
}

/* ===== PAGE LAYOUT ===== */
.page-layout {
    display: grid;
    grid-template-columns: 1fr;
    gap: 40px;
}

@media (min-width: 992px) {
    .page-layout {
        grid-template-columns: 2fr 1fr;
    }
}

/* MAIN CONTENT */
.page-main {
    min-width: 0;
    width: 100%;
}

/* SIDEBAR */
.page-sidebar {
    position: relative;
    width: 100%;
}

/* ===== PAGE CONTENT ===== */
.page-content {
    font-size: 1rem;
    line-height: 1.8;
    color: var(--text-dark);
    max-width: 100%;
    margin: 0 auto;
    word-wrap: break-word;
}

/* ===== IMPROVED TABLE STYLES ===== */
.page-content table {
    width: 100% !important;
    border-collapse: collapse !important;
    margin: 30px 0 !important;
    border-radius: 8px;
    overflow: hidden;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
    font-size: 0.95rem;
}

.page-content table th,
.page-content table td {
    border: 1px solid var(--gray-border) !important;
    padding: 12px 15px !important;
    vertical-align: top !important;
}

.page-content table th {
    background-color: var(--primary) !important;
    color: var(--white) !important;
    font-weight: 600 !important;
    font-size: 0.95rem;
    letter-spacing: 0.02em;
    white-space: nowrap;
}

/* Hapus styling khusus untuk baris pertama tbody */
.page-content table tbody tr:first-child td {
    background-color: transparent !important;
    color: inherit !important;
    font-weight: normal !important;
}

/* Styling untuk baris genap */
.page-content table tbody tr:nth-child(even) {
    background-color: var(--off-white);
}

.page-content table tbody tr:hover {
    background-color: #edf2f7 !important;
    transition: var(--transition);
}

/* Styling untuk sel dengan alignment */
.page-content table td[style*="text-align: center"],
.page-content table th[style*="text-align: center"] {
    text-align: center !important;
}

.page-content table td[style*="text-align: right"],
.page-content table th[style*="text-align: right"] {
    text-align: right !important;
}

.page-content table td[style*="text-align: left"],
.page-content table th[style*="text-align: left"] {
    text-align: left !important;
}

/* Table container untuk responsive */
.table-responsive {
    width: 100%;
    overflow-x: auto;
    -webkit-overflow-scrolling: touch;
    margin: 20px 0;
    border-radius: 8px;
}

.table-responsive table {
    margin: 0 !important;
}

/* Styling untuk tabel di mobile */
@media (max-width: 768px) {
    .page-content table {
        font-size: 0.85rem;
    }
    
    .page-content table th,
    .page-content table td {
        padding: 10px 12px !important;
        white-space: normal;
        min-width: 120px;
    }
    
    /* Untuk tabel yang lebar, beri scroll horizontal */
    .page-content table {
        display: block;
        overflow-x: auto;
        -webkit-overflow-scrolling: touch;
        white-space: nowrap;
    }
    
    .page-content table tbody,
    .page-content table thead,
    .page-content table tr,
    .page-content table th,
    .page-content table td {
        white-space: nowrap;
    }
    
    /* Tabel kecil tetap normal */
    .page-content table:not(.wide-table) {
        display: table;
        white-space: normal;
    }
}

@media (max-width: 576px) {
    .page-content table th,
    .page-content table td {
        padding: 8px 10px !important;
        font-size: 0.8rem;
        min-width: 100px;
    }
}

/* ===== IMAGES ===== */
.page-content img {
    max-width: 100% !important;
    height: auto !important;
    border-radius: 12px;
    margin: 20px 0;
    box-shadow: 0 4px 16px rgba(0, 0, 0, 0.1);
}

@media (min-width: 768px) {
    .page-content img.align-left {
        margin-right: 20px;
        float: left;
        max-width: 50%;
    }
    
    .page-content img.align-right {
        margin-left: 20px;
        float: right;
        max-width: 50%;
    }
}

@media (max-width: 767px) {
    .page-content img.align-left,
    .page-content img.align-right {
        float: none;
        margin: 20px 0;
        width: 100%;
        max-width: 100%;
    }
}

/* ===== HEADINGS ===== */
.page-content h1 {
    color: var(--primary-dark);
    font-size: 2.2rem;
    margin-top: 40px;
    margin-bottom: 16px;
    font-weight: 700;
    letter-spacing: -0.02em;
    word-break: break-word;
}

.page-content h2 {
    color: var(--primary);
    font-size: 1.8rem;
    margin-top: 36px;
    margin-bottom: 14px;
    font-weight: 600;
    padding-bottom: 8px;
    border-bottom: 2px solid rgba(201, 168, 76, 0.3);
    word-break: break-word;
}

.page-content h3 {
    color: var(--primary-light);
    font-size: 1.4rem;
    margin-top: 28px;
    margin-bottom: 12px;
    font-weight: 600;
    word-break: break-word;
}

.page-content h4 {
    color: var(--text-dark);
    font-size: 1.2rem;
    margin-top: 24px;
    margin-bottom: 10px;
    font-weight: 600;
    word-break: break-word;
}

/* ===== LINKS ===== */
.page-content a {
    color: var(--primary);
    text-decoration: underline;
    text-decoration-color: rgba(201, 168, 76, 0.4);
    text-underline-offset: 2px;
    transition: var(--transition);
    word-break: break-word;
}

.page-content a:hover {
    color: var(--gold-dark);
    text-decoration-color: var(--gold);
}

/* ===== LIST ===== */
.page-content ul,
.page-content ol {
    padding-left: 28px;
    margin-bottom: 20px;
}

.page-content li {
    margin-bottom: 8px;
    word-break: break-word;
}

.page-content ul li::marker {
    color: var(--gold);
}

.page-content ol li::marker {
    color: var(--primary);
    font-weight: 600;
}

/* ===== BLOCKQUOTE ===== */
.page-content blockquote {
    margin: 30px 0;
    padding: 20px 30px;
    background: linear-gradient(to right, var(--off-white), transparent);
    border-left: 5px solid var(--gold);
    border-radius: 0 12px 12px 0;
    font-style: italic;
    color: var(--text-light);
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
    word-break: break-word;
}

@media (max-width: 576px) {
    .page-content blockquote {
        padding: 15px 20px;
    }
}

/* ===== SIDEBAR NEWS ===== */
.sidebar-news {
    background: var(--gray-light);
    padding: 24px;
    border-radius: 8px;
    height: fit-content;
}

.sidebar-title {
    font-size: 1.25rem;
    font-weight: 700;
    border-bottom: 3px solid var(--primary);
    padding-bottom: 12px;
    margin-bottom: 20px;
    color: var(--primary-dark);
    word-break: break-word;
}

.sidebar-news-list {
    list-style: none;
    padding: 0;
    margin: 0;
}

.sidebar-news-list li {
    padding: 12px 0;
    border-bottom: 1px solid var(--gray-border);
}

.sidebar-news-list li:last-child {
    border-bottom: none;
}

.sidebar-news-list a {
    text-decoration: none;
    color: var(--text-dark);
    font-size: 0.95rem;
    line-height: 1.5;
    display: block;
    transition: var(--transition);
    word-break: break-word;
}

.sidebar-news-list a:hover {
    color: var(--primary);
    transform: translateX(5px);
}

/* Empty state sidebar */
.sidebar-news .text-muted {
    color: var(--text-light);
    font-style: italic;
    padding: 12px 0;
    margin: 0;
}

/* ===== SPACING UTILITIES ===== */
.py-5 {
    padding-top: 3rem;
    padding-bottom: 3rem;
}

@media (max-width: 768px) {
    .py-5 {
        padding-top: 2rem;
        padding-bottom: 2rem;
    }
}

/* ===== RESPONSIVE BREAKPOINTS ===== */
@media (max-width: 1200px) {
    .page-hero-title {
        font-size: 1.8rem;
    }
    
    .page-content h1 {
        font-size: 2rem;
    }
    
    .page-content h2 {
        font-size: 1.7rem;
    }
}

@media (max-width: 992px) {
    .page-hero {
        padding: 140px 0 70px;
        min-height: 360px;
    }
    
    .page-hero-title {
        font-size: 1.65rem;
    }
    
    .page-content h1 {
        font-size: 1.9rem;
    }
    
    .page-content h2 {
        font-size: 1.6rem;
    }
    
    .sidebar-news {
        padding: 20px;
    }
}

@media (max-width: 768px) {
    .page-hero {
        padding: 120px 0 60px;
        min-height: 300px;
    }
    
    .page-hero-title {
        font-size: 1.5rem;
    }
    
    .page-hero-title-wrap::before {
        min-height: 32px;
    }
    
    .page-content {
        font-size: 0.95rem;
    }
    
    .page-content h1 {
        font-size: 1.8rem;
        margin-top: 30px;
    }
    
    .page-content h2 {
        font-size: 1.5rem;
        margin-top: 28px;
    }
    
    .page-content h3 {
        font-size: 1.3rem;
    }
    
    .page-layout {
        gap: 30px;
    }
    
    .sidebar-title {
        font-size: 1.1rem;
    }
}

@media (max-width: 576px) {
    .page-hero {
        padding: 100px 0 50px;
        min-height: 240px;
    }
    
    .page-hero-title {
        font-size: 1.35rem;
    }
    
    .page-hero-title-wrap::before {
        min-height: 28px;
        width: 3px;
    }
    
    .page-hero-breadcrumb {
        font-size: 0.7rem;
    }
    
    .page-content h1 {
        font-size: 1.6rem;
    }
    
    .page-content h2 {
        font-size: 1.4rem;
    }
    
    .page-content h3 {
        font-size: 1.2rem;
    }
    
    .page-content h4 {
        font-size: 1.1rem;
    }
    
    .sidebar-news {
        padding: 16px;
    }
    
    .sidebar-news-list a {
        font-size: 0.9rem;
    }
    
    .sidebar-news-list li {
        padding: 10px 0;
    }
}

@media (max-width: 375px) {
    .page-hero-title {
        font-size: 1.2rem;
    }
    
    .page-hero-title-wrap::before {
        min-height: 24px;
    }
    
    .page-content h1 {
        font-size: 1.4rem;
    }
    
    .page-content h2 {
        font-size: 1.3rem;
    }
    
    .page-content h3 {
        font-size: 1.1rem;
    }
    
    .page-content {
        font-size: 0.9rem;
    }
}

/* ===== PRINT STYLES ===== */
@media print {
    .page-hero {
        background: none;
        padding: 20px 0;
        min-height: auto;
    }
    
    .page-hero::before,
    .page-hero::after {
        display: none;
    }
    
    .page-hero-title {
        color: var(--primary-dark) !important;
        text-shadow: none;
    }
    
    .page-content {
        color: #000;
    }
    
    .page-content a {
        text-decoration: none;
        color: #000;
    }
    
    .page-content table {
        box-shadow: none;
        border: 1px solid #ddd;
    }
    
    .page-content table th {
        background-color: #f0f0f0 !important;
        color: #000 !important;
    }
    
    .page-sidebar {
        display: none;
    }
    
    .page-layout {
        grid-template-columns: 1fr;
    }
}

/* ===== ACCESSIBILITY ===== */
@media (prefers-reduced-motion: reduce) {
    *,
    *::before,
    *::after {
        animation-duration: 0.01ms !important;
        animation-iteration-count: 1 !important;
        transition-duration: 0.01ms !important;
        scroll-behavior: auto !important;
    }
}

/* Focus styles for better accessibility */
a:focus-visible,
button:focus-visible {
    outline: 2px solid var(--gold);
    outline-offset: 2px;
}

/* High contrast mode support */
@media (forced-colors: active) {
    .page-hero::before {
        background: none;
    }
    
    .page-hero-title-wrap::before {
        background: CanvasText;
    }
}
</style>
@endsection

@section('content')
<div class="page-hero" style="background-image: url('{{ asset('images/hero.jpg') }}')">
    <div class="site-container">
        <div class="page-hero-content">
            {{-- Breadcrumb dengan responsive wrap --}}
            <div class="page-hero-breadcrumb">
                <a href="/">BERANDA</a>
                <span class="separator">›</span>
                <span class="current">{{ $page->title }}</span>
            </div>

            {{-- Judul dengan aksen garis --}}
            <div class="page-hero-title-wrap">
                <h1 class="page-hero-title">{{ $page->title }}</h1>
            </div>
        </div>
    </div>
</div>

{{-- Konten Utama --}}
<main class="site-container py-5">
    <div class="page-layout">
        {{-- KONTEN UTAMA --}}
        <div class="page-main">
            <article class="page-content">
                {!! $page->content !!}
            </article>
        </div>

        {{-- SIDEBAR BERITA --}}
        <aside class="page-sidebar">
            <div class="sidebar-news">
                <h3 class="sidebar-title">BERITA TERKINI</h3>

                @if(!empty($latestNews) && count($latestNews) > 0)
                    <ul class="sidebar-news-list">
                        @foreach($latestNews as $news)
                        <li>
                            <a href="/news/{{ $news->id }}">
                                {{ $news->title }}
                            </a>
                        </li>
                        @endforeach
                    </ul>
                @else
                    <p class="text-muted">Belum ada berita terbaru.</p>
                @endif
            </div>
        </aside>
    </div>
</main>
@endsection