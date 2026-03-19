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

* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

body {
    overflow-x: hidden;
    width: 100%;
}

/* ===== CONTAINER ===== */
.site-container {
    width: 100%;
    max-width: 1280px;
    margin: 0 auto;
    padding: 0 20px;
}

/* ===== HERO SECTION ===== */
.page-hero {
    background-color: var(--primary);
    background-size: cover;
    background-position: center;
    background-repeat: no-repeat;
    position: relative;
    overflow: hidden;
    width: 100%;
    min-height: 250px;
    display: flex;
    align-items: center;
    padding: 80px 0 40px;
}

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
}

.page-hero-breadcrumb {
    display: flex;
    align-items: center;
    flex-wrap: wrap;
    gap: 6px;
    margin-bottom: 10px;
    font-size: 0.85rem;
    color: #ffffff !important;
    font-weight: 400;
    letter-spacing: 0.02em;
}

.page-hero-breadcrumb a {
    color: rgba(255, 255, 255, 0.8) !important;
    text-decoration: none;
    transition: color 0.2s;
}

.page-hero-breadcrumb a:hover {
    color: var(--gold-light) !important;
}

.page-hero-breadcrumb .separator {
    color: rgba(255, 255, 255, 0.4) !important;
}

.page-hero-breadcrumb .current {
    color: var(--gold-light) !important;
    opacity: 1;
    font-weight: 500;
}

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
    font-size: 2rem;
    font-weight: 600;
    margin: 0;
    letter-spacing: -0.01em;
    line-height: 1.2;
    text-shadow: 0 2px 8px rgba(0,0,0,0.2);
    word-break: break-word;
}

/* ===== PAGE LAYOUT ===== */
.page-layout {
    display: grid;
    grid-template-columns: 1fr;
    gap: 40px;
    width: 100%;
    padding: 30px 0;
}

@media (min-width: 992px) {
    .page-layout {
        grid-template-columns: 2fr 1fr;
    }
}

.page-main {
    min-width: 0;
    width: 100%;
}

/* ===== PAGE CONTENT ===== */
.page-content {
    font-size: 1rem;
    line-height: 1.6;
    color: var(--text-dark);
    max-width: 100%;
    margin: 0 auto;
    word-wrap: break-word;
    overflow-x: hidden;
}

.page-content > * {
    max-width: 100%;
}

.page-content h2 {
    color: var(--primary-dark);
    font-size: 1.8rem;
    font-weight: 600;
    margin: 0 0 25px 0;
    padding-bottom: 0;
    border-bottom: none;
    letter-spacing: -0.01em;
}

/* ===== TABLE STYLE ===== */
.page-content .table-wrapper {
    width: 100%;
    margin: 0 0 30px 0;
    border-radius: 5;
    box-shadow: none;
}

.page-content table {
    width: 100%;
    border-collapse: collapse;
    font-size: 1rem;
    border: 1px solid var(--gray-border);
}

.page-content table th {
    background-color: #f9fafb !important;
    color: var(--text-dark) !important;
    font-weight: 600 !important;
    font-size: 0.95rem;
    letter-spacing: 0.02em;
    text-transform: uppercase;
    padding: 16px 20px !important;
    border: 1px solid var(--gray-border) !important;
    white-space: nowrap;
    text-align: left;
}

.page-content table td {
    padding: 14px 20px !important;
    border: 1px solid var(--gray-border) !important;
    vertical-align: middle !important;
    color: var(--text-light);
    font-size: 0.95rem;
}

.page-content table td:first-child {
    color: var(--text-dark);
    font-weight: 500;
}

.page-content table td:last-child {
    color: var(--primary);
    font-weight: 500;
    text-decoration: underline;
    text-decoration-color: rgba(201, 168, 76, 0.3);
    text-underline-offset: 3px;
    cursor: pointer;
    transition: var(--transition);
}

.page-content table td:last-child:hover {
    color: var(--gold-dark);
    text-decoration-color: var(--gold);
}

.page-content table tbody tr:nth-child(even) {
    background-color: transparent;
}

.page-content table tbody tr:hover {
    background-color: #f9fafb !important;
}

/* ===== EMPTY STATE - KONTEN HALAMAN ===== */
.empty-state-content {
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    padding: 64px 32px;
    text-align: center;
    border: 2px dashed var(--gray-border);
    border-radius: 10px;
    background-color: var(--off-white);
    gap: 16px;
}

.empty-state-content .empty-icon {
    width: 64px;
    height: 64px;
    background-color: #eef2f7;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    margin-bottom: 4px;
}

.empty-state-content .empty-icon svg {
    width: 30px;
    height: 30px;
    color: #94a3b8;
    stroke: #94a3b8;
}

.empty-state-content .empty-title {
    font-size: 1.05rem;
    font-weight: 600;
    color: var(--text-dark);
    margin: 0;
}

.empty-state-content .empty-desc {
    font-size: 0.92rem;
    color: var(--text-light);
    margin: 0;
    max-width: 340px;
    line-height: 1.6;
}

/* ===== EMPTY STATE - TABEL ===== */
.table-empty-row td {
    text-align: center !important;
    padding: 40px 20px !important;
}

.table-empty-inner {
    display: flex;
    flex-direction: column;
    align-items: center;
    gap: 10px;
    color: var(--text-light);
}

.table-empty-inner svg {
    width: 36px;
    height: 36px;
    stroke: #cbd5e1;
}

.table-empty-inner span {
    font-size: 0.92rem;
    color: var(--text-light);
    font-style: italic;
}

/* ===== EMPTY STATE - SIDEBAR ===== */
.sidebar-empty {
    display: flex;
    flex-direction: column;
    align-items: center;
    gap: 10px;
    padding: 32px 20px;
    text-align: center;
    color: var(--text-light);
}

.sidebar-empty svg {
    width: 32px;
    height: 32px;
    stroke: #cbd5e1;
    margin-bottom: 4px;
}

.sidebar-empty span {
    font-size: 0.88rem;
    color: var(--text-light);
    font-style: italic;
    line-height: 1.5;
}

/* ===== NOTIF ALERT (opsional, jika mau pakai alert bar) ===== */
.alert-info {
    display: flex;
    align-items: flex-start;
    gap: 14px;
    background-color: #eff6ff;
    border: 1px solid #bfdbfe;
    border-left: 4px solid #3b82f6;
    border-radius: 6px;
    padding: 16px 20px;
    margin-bottom: 24px;
}

.alert-info svg {
    width: 20px;
    height: 20px;
    stroke: #3b82f6;
    flex-shrink: 0;
    margin-top: 2px;
}

.alert-info .alert-text {
    font-size: 0.93rem;
    color: #1e40af;
    line-height: 1.5;
}

.alert-info .alert-text strong {
    font-weight: 600;
    display: block;
    margin-bottom: 2px;
}

/* ===== SIDEBAR NEWS ===== */
.sidebar-news {
    background: var(--white);
    padding: 0;
    border-radius: 0;
    height: fit-content;
    max-width: 100%;
    border: 1px solid var(--gray-border);
}

.sidebar-title {
    font-size: 1.2rem;
    font-weight: 600;
    border-bottom: 1px solid var(--gray-border);
    padding: 16px 20px;
    margin: 0;
    color: var(--primary-dark);
    word-break: break-word;
    background-color: #f9fafb;
    text-transform: uppercase;
    letter-spacing: 0.02em;
}

.sidebar-news-list {
    list-style: none;
    padding: 0;
    margin: 0;
    max-width: 100%;
}

.sidebar-news-list li {
    padding: 14px 20px;
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

/* ===== SPACING UTILITIES ===== */
.py-5 {
    padding-top: 2rem;
    padding-bottom: 2rem;
}

/* ===== RESPONSIVE ===== */
@media (max-width: 1200px) {
    .page-hero-title { font-size: 1.9rem; }
    .page-content h2 { font-size: 1.7rem; }
}

@media (max-width: 992px) {
    .page-hero { padding: 70px 0 35px; min-height: 220px; }
    .page-hero-title { font-size: 1.8rem; }
    .page-hero-title-wrap::before { min-height: 34px; }
    .page-content h2 { font-size: 1.6rem; }
    .page-content table th,
    .page-content table td { padding: 12px 16px !important; }
    .empty-state-content { padding: 48px 24px; }
}

@media (max-width: 768px) {
    .page-hero { padding: 60px 0 30px; min-height: 200px; }
    .page-hero-title { font-size: 1.6rem; }
    .page-hero-title-wrap::before { min-height: 32px; }
    .page-hero-breadcrumb { font-size: 0.8rem; }
    .page-content h2 { font-size: 1.5rem; margin-bottom: 20px; }
    .page-content table { font-size: 0.9rem; }
    .page-content table th,
    .page-content table td { padding: 10px 14px !important; }
    .page-layout { gap: 30px; }
    .sidebar-title { font-size: 1.1rem; padding: 14px 16px; }
    .sidebar-news-list li { padding: 12px 16px; }
    .empty-state-content { padding: 40px 20px; }
}

@media (max-width: 576px) {
    .page-hero { padding: 50px 0 25px; min-height: 180px; }
    .page-hero-title { font-size: 1.4rem; }
    .page-hero-title-wrap::before { min-height: 28px; width: 3px; }
    .page-hero-breadcrumb { font-size: 0.75rem; }
    .page-content h2 { font-size: 1.4rem; }
    .page-content table { font-size: 0.85rem; }
    .page-content table th,
    .page-content table td { padding: 8px 12px !important; }
    .sidebar-title { font-size: 1rem; padding: 12px 14px; }
    .sidebar-news-list li { padding: 10px 14px; }
    .sidebar-news-list a { font-size: 0.9rem; }
    .empty-state-content { padding: 32px 16px; }
    .empty-state-content .empty-icon { width: 52px; height: 52px; }
}

@media (max-width: 375px) {
    .page-hero-title { font-size: 1.3rem; }
    .page-hero-title-wrap::before { min-height: 24px; }
    .page-content h2 { font-size: 1.3rem; }
    .page-content table th,
    .page-content table td { padding: 6px 10px !important; font-size: 0.8rem; }
}

@media (max-height: 600px) and (orientation: landscape) {
    .page-hero { min-height: 160px; padding: 40px 0 20px; }
    .page-hero-title { font-size: 1.3rem; }
    .page-hero-title-wrap::before { min-height: 26px; }
}

@media print {
    .page-hero { background: none; padding: 20px 0; min-height: auto; }
    .page-hero::before, .page-hero::after { display: none; }
    .page-hero-title { color: var(--primary-dark) !important; text-shadow: none; }
    .page-content h2 { color: var(--primary-dark); }
    .page-content table { border: 1px solid #ddd; box-shadow: none; }
    .page-content table th { background-color: #f0f0f0 !important; color: #000 !important; }
    .page-sidebar { display: none; }
    .page-layout { grid-template-columns: 1fr; }
}

@media (prefers-reduced-motion: reduce) {
    *, *::before, *::after {
        animation-duration: 0.01ms !important;
        animation-iteration-count: 1 !important;
        transition-duration: 0.01ms !important;
        scroll-behavior: auto !important;
    }
}

a:focus-visible,
button:focus-visible {
    outline: 2px solid var(--gold);
    outline-offset: 2px;
}
</style>
@endsection

@section('content')
<div class="page-hero" style="background-image: url('{{ asset('images/hero.jpg') }}')">
    <div class="site-container">
        <div class="page-hero-content">
            {{-- Breadcrumb --}}
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

                {{-- CASE 1: Tidak ada konten sama sekali --}}
                @if(empty($page->content))
                    <div class="empty-state-content">
                        <div class="empty-icon">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z" />
                            </svg>
                        </div>
                        <p class="empty-title">Konten belum tersedia</p>
                        <p class="empty-desc">Halaman ini sedang dalam proses pembuatan. Silakan kembali lagi nanti.</p>
                    </div>

                {{-- CASE 2: Ada konten, tampilkan seperti biasa --}}
                @else
                    {!! $page->content !!}
                @endif

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
                    {{-- Empty state sidebar --}}
                    <div class="sidebar-empty">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 7.5h1.5m-1.5 3h1.5m-7.5 3h7.5m-7.5 3h7.5m3-9h3.375c.621 0 1.125.504 1.125 1.125V18a2.25 2.25 0 01-2.25 2.25M16.5 7.5V18a2.25 2.25 0 002.25 2.25M16.5 7.5V4.875c0-.621-.504-1.125-1.125-1.125H4.125C3.504 3.75 3 4.254 3 4.875V18a2.25 2.25 0 002.25 2.25h13.5M6 7.5h3v3H6v-3z" />
                        </svg>
                        <span>Belum ada berita terbaru saat ini.</span>
                    </div>
                @endif
            </div>
        </aside>

    </div>
</main>
@endsection