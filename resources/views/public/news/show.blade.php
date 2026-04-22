@extends('layouts.public')

@section('title', $news->title . ' | Universitas Kampus')

@section('styles')
<style>
    :root {
        --primary: #0a2463;
        --primary-dark: #061a4a;
        --primary-light: #1e3a8a;
        --gold: #c9a03d;
        --gold-light: #e8c97a;
        --gold-dark: #b88b2a;
        --gray-50: #f8fafc;
        --gray-100: #f1f5f9;
        --gray-200: #e2e8f0;
        --gray-600: #475569;
        --gray-700: #334155;
        --gray-800: #1e293b;
        --shadow-sm: 0 1px 2px 0 rgb(0 0 0 / 0.05);
        --shadow-md: 0 4px 6px -1px rgb(0 0 0 / 0.1);
        --shadow-lg: 0 10px 15px -3px rgb(0 0 0 / 0.1);
        --shadow-xl: 0 20px 25px -5px rgb(0 0 0 / 0.1);
        --transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    }

    /* ===== BREADCRUMB ===== */
    .news-breadcrumb {
        background: linear-gradient(135deg, var(--gray-50) 0%, #ffffff 100%);
        border-bottom: 1px solid var(--gray-200);
        padding: 16px 0;
        position: relative;
        overflow: hidden;
    }

    .news-breadcrumb::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 3px;
        background: linear-gradient(90deg, var(--gold), var(--primary), var(--gold));
    }

    .news-breadcrumb-list {
        display: flex;
        align-items: center;
        gap: 8px;
        list-style: none;
        font-size: 0.85rem;
        color: var(--gray-600);
        flex-wrap: wrap;
        margin: 0;
        padding: 0;
    }

    .news-breadcrumb-list li:not(:last-child)::after {
        content: '›';
        margin-left: 8px;
        color: var(--gray-400);
        font-size: 1rem;
    }

    .news-breadcrumb-list a {
        color: var(--gray-600);
        text-decoration: none;
        transition: var(--transition);
    }

    .news-breadcrumb-list a:hover {
        color: var(--primary);
    }

    .news-breadcrumb-list .current {
        color: var(--primary);
        font-weight: 600;
    }

    /* ===== WRAPPER ===== */
    .news-detail-wrapper {
        padding: 48px 0 80px;
        background: var(--gray-50);
    }

    /* ===== BACK BUTTON ===== */
    .news-back-btn {
        display: inline-flex;
        align-items: center;
        gap: 10px;
        color: var(--gray-600);
        font-size: 0.875rem;
        font-weight: 500;
        text-decoration: none;
        margin-bottom: 32px;
        padding: 8px 16px;
        background: white;
        border-radius: 40px;
        box-shadow: var(--shadow-sm);
        transition: var(--transition);
    }

    .news-back-btn i {
        font-size: 0.875rem;
        transition: transform 0.2s ease;
    }

    .news-back-btn:hover {
        color: white;
        background: var(--primary);
        transform: translateX(-4px);
        box-shadow: var(--shadow-md);
        text-decoration: none;
    }

    .news-back-btn:hover i {
        transform: translateX(-4px);
    }

    /* ===== GRID ===== */
    .news-detail-grid {
        display: grid;
        grid-template-columns: 1fr 320px;
        gap: 40px;
        align-items: start;
    }

    /* ===== ARTICLE ===== */
    .news-article {
        background: #fff;
        border-radius: 20px;
        overflow: hidden;
        box-shadow: var(--shadow-lg);
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        animation: fadeInUp 0.6s ease-out;
    }

    .news-article:hover {
        box-shadow: var(--shadow-xl);
    }

    @keyframes fadeInUp {
        from {
            opacity: 0;
            transform: translateY(30px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .news-category-bar {
        background: linear-gradient(135deg, var(--primary) 0%, var(--primary-dark) 100%);
        padding: 14px 32px;
        display: flex;
        align-items: center;
        gap: 12px;
        flex-wrap: wrap;
    }

    .news-category-dot {
        width: 8px;
        height: 8px;
        border-radius: 50%;
        background: var(--gold);
        flex-shrink: 0;
        animation: pulse 2s infinite;
    }

    @keyframes pulse {
        0%, 100% { opacity: 1; transform: scale(1); }
        50% { opacity: 0.5; transform: scale(1.2); }
    }

    .news-category-tag {
        font-size: 0.75rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.1em;
        color: var(--gold-light);
    }

    .news-category-date {
        font-size: 0.75rem;
        color: rgba(255,255,255,0.7);
        margin-left: auto;
        letter-spacing: 0.03em;
    }

    .news-article-inner {
        padding: 40px 48px 48px;
    }

    @media (max-width: 768px) {
        .news-article-inner {
            padding: 28px 24px 32px;
        }
    }

    @media (max-width: 480px) {
        .news-article-inner {
            padding: 20px 20px 24px;
        }
    }

    .news-article-title {
        font-size: 2.25rem;
        font-weight: 800;
        line-height: 1.3;
        color: var(--gray-800);
        margin-bottom: 20px;
        word-break: break-word;
        letter-spacing: -0.02em;
        background: linear-gradient(135deg, var(--gray-800) 0%, var(--primary) 100%);
        background-clip: text;
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
    }

    @media (max-width: 768px) {
        .news-article-title {
            font-size: 1.75rem;
        }
    }

    @media (max-width: 480px) {
        .news-article-title {
            font-size: 1.5rem;
        }
    }

    .news-title-rule {
        width: 60px;
        height: 4px;
        background: linear-gradient(90deg, var(--gold), var(--gold-dark));
        border: none;
        margin: 0 0 24px 0;
        border-radius: 2px;
        animation: slideIn 0.8s ease-out;
    }

    @keyframes slideIn {
        from {
            width: 0;
            opacity: 0;
        }
        to {
            width: 60px;
            opacity: 1;
        }
    }

    .news-article-meta {
        display: flex;
        flex-wrap: wrap;
        gap: 24px;
        margin-bottom: 28px;
        padding-bottom: 20px;
        border-bottom: 1px solid var(--gray-200);
    }

    .news-meta-item {
        display: flex;
        align-items: center;
        gap: 8px;
        font-size: 0.875rem;
        transition: var(--transition);
    }

    .news-meta-item i {
        color: var(--gold-dark);
        font-size: 0.875rem;
    }

    .news-meta-item span {
        color: var(--gray-600);
    }

    .news-meta-item:hover {
        transform: translateX(2px);
    }

    /* ===== FEATURED IMAGE ===== */
    .news-featured-image {
        margin-bottom: 32px;
        border-radius: 16px;
        overflow: hidden;
        position: relative;
        cursor: pointer;
    }

    .news-featured-image img {
        width: 100%;
        height: auto;
        display: block;
        max-height: 500px;
        object-fit: cover;
        transition: transform 0.5s ease;
    }

    .news-featured-image:hover img {
        transform: scale(1.05);
    }

    .news-featured-image::after {
        content: '🔍';
        position: absolute;
        bottom: 16px;
        right: 16px;
        background: rgba(0,0,0,0.6);
        color: white;
        padding: 8px 12px;
        border-radius: 30px;
        font-size: 0.875rem;
        opacity: 0;
        transition: var(--transition);
        pointer-events: none;
    }

    .news-featured-image:hover::after {
        opacity: 1;
    }

    /* ===== GALLERY ===== */
    .news-gallery-section {
        margin: 32px 0;
        padding: 20px;
        background: var(--gray-50);
        border-radius: 16px;
    }

    .news-gallery-title {
        font-size: 0.9rem;
        font-weight: 600;
        color: var(--primary);
        margin-bottom: 16px;
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .news-gallery-title i {
        font-size: 1.1rem;
        animation: rotate 0.5s ease;
    }

    @keyframes rotate {
        from { transform: rotate(0deg); }
        to { transform: rotate(360deg); }
    }

    .news-gallery-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(140px, 1fr));
        gap: 16px;
    }

    @media (max-width: 480px) {
        .news-gallery-grid {
            grid-template-columns: repeat(auto-fill, minmax(100px, 1fr));
            gap: 12px;
        }
    }

    .news-gallery-item {
        cursor: pointer;
        border-radius: 12px;
        overflow: hidden;
        position: relative;
        transition: var(--transition);
    }

    .news-gallery-item img {
        width: 100%;
        height: 110px;
        object-fit: cover;
        display: block;
        transition: transform 0.3s ease;
    }

    @media (max-width: 480px) {
        .news-gallery-item img {
            height: 90px;
        }
    }

    .news-gallery-item:hover {
        transform: translateY(-4px);
        box-shadow: var(--shadow-lg);
    }

    .news-gallery-item:hover img {
        transform: scale(1.1);
    }

    .news-gallery-item::after {
        content: '🔍';
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%) scale(0);
        background: rgba(0,0,0,0.7);
        color: white;
        padding: 6px 10px;
        border-radius: 30px;
        font-size: 0.75rem;
        transition: transform 0.2s ease;
        pointer-events: none;
    }

    .news-gallery-item:hover::after {
        transform: translate(-50%, -50%) scale(1);
    }

    /* ===== ARTICLE BODY ===== */
    .news-article-body {
        font-size: 1rem;
        line-height: 1.8;
        color: var(--gray-700);
        word-break: break-word;
        overflow-wrap: break-word;
    }

    .news-article-body p {
        margin-bottom: 20px;
        text-align: justify;
        animation: fadeIn 0.5s ease-out;
    }

    @keyframes fadeIn {
        from { opacity: 0; }
        to { opacity: 1; }
    }

    .news-article-body h2 {
        font-size: 1.5rem;
        font-weight: 700;
        color: var(--primary);
        margin: 36px 0 16px;
        padding-bottom: 12px;
        border-bottom: 2px solid var(--gray-200);
        position: relative;
    }

    .news-article-body h2::before {
        content: '';
        position: absolute;
        bottom: -2px;
        left: 0;
        width: 60px;
        height: 2px;
        background: var(--gold);
    }

    .news-article-body h3 {
        font-size: 1.25rem;
        font-weight: 600;
        color: var(--primary-light);
        margin: 28px 0 12px;
    }

    .news-article-body ul, 
    .news-article-body ol {
        margin: 20px 0 20px 24px;
        padding-left: 0;
    }

    .news-article-body li {
        margin-bottom: 8px;
        transition: var(--transition);
    }

    .news-article-body li:hover {
        transform: translateX(4px);
        color: var(--primary);
    }

    .news-article-body img {
        max-width: 100%;
        border-radius: 12px;
        margin: 24px 0;
        box-shadow: var(--shadow-md);
        transition: var(--transition);
    }

    .news-article-body img:hover {
        transform: scale(1.02);
        box-shadow: var(--shadow-lg);
    }

    .news-article-body blockquote {
        margin: 32px 0;
        padding: 20px 28px 20px 32px;
        border-left: 4px solid var(--gold);
        background: linear-gradient(135deg, var(--gray-50) 0%, #ffffff 100%);
        color: var(--gray-600);
        font-style: italic;
        border-radius: 0 16px 16px 0;
        position: relative;
        overflow: hidden;
    }

    .news-article-body blockquote::before {
        content: '"';
        position: absolute;
        top: -20px;
        left: 16px;
        font-size: 80px;
        color: var(--gold);
        opacity: 0.2;
        font-family: serif;
    }

    .news-article-body table {
        width: 100%;
        border-collapse: collapse;
        margin: 28px 0;
        overflow-x: auto;
        display: block;
        font-size: 0.9rem;
        border-radius: 12px;
        overflow: hidden;
        box-shadow: var(--shadow-sm);
    }

    .news-article-body table td,
    .news-article-body table th {
        padding: 12px 16px;
        border: 1px solid var(--gray-200);
    }

    .news-article-body table thead th {
        background: linear-gradient(135deg, var(--primary) 0%, var(--primary-dark) 100%);
        color: #fff;
        font-weight: 600;
    }

    .news-article-body table tbody tr:hover {
        background: var(--gray-50);
        transition: var(--transition);
    }

    /* ===== SHARE SECTION ===== */
    .news-share-section {
        margin-top: 40px;
        padding-top: 32px;
        border-top: 2px solid var(--gray-200);
        text-align: center;
    }

    .news-share-title {
        font-size: 0.875rem;
        color: var(--gray-600);
        margin-bottom: 16px;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.1em;
    }

    .news-share-buttons {
        display: flex;
        gap: 12px;
        justify-content: center;
        flex-wrap: wrap;
    }

    .news-share-btn {
        padding: 10px 20px;
        background: var(--gray-100);
        border-radius: 40px;
        text-decoration: none;
        color: var(--gray-700);
        font-size: 0.875rem;
        font-weight: 500;
        transition: var(--transition);
        display: inline-flex;
        align-items: center;
        gap: 8px;
    }

    .news-share-btn i {
        font-size: 1rem;
    }

    .news-share-btn:hover {
        transform: translateY(-2px);
        text-decoration: none;
    }

    .news-share-btn:nth-child(1):hover {
        background: #1877f2;
        color: white;
    }

    .news-share-btn:nth-child(2):hover {
            background: #1da1f2;
            color: white;
        }

    .news-share-btn:nth-child(3):hover {
        background: #25d366;
        color: white;
    }

    /* ===== SIDEBAR ===== */
    .news-sidebar {
        display: flex;
        flex-direction: column;
        gap: 28px;
        animation: fadeInUp 0.6s ease-out 0.2s both;
    }

    .news-sidebar-widget {
        background: #fff;
        border-radius: 20px;
        overflow: hidden;
        box-shadow: var(--shadow-md);
        transition: var(--transition);
    }

    .news-sidebar-widget:hover {
        transform: translateY(-4px);
        box-shadow: var(--shadow-lg);
    }

    .news-widget-header {
        background: linear-gradient(135deg, var(--gray-50) 0%, #ffffff 100%);
        border-bottom: 2px solid var(--gray-200);
        padding: 16px 20px;
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .news-widget-header-line {
        width: 4px;
        height: 20px;
        background: linear-gradient(135deg, var(--gold), var(--gold-dark));
        border-radius: 2px;
        flex-shrink: 0;
    }

    .news-widget-title {
        font-size: 0.8rem;
        font-weight: 800;
        text-transform: uppercase;
        letter-spacing: 0.1em;
        color: var(--primary);
        margin: 0;
    }

    .news-widget-body {
        padding: 4px 0;
    }

    .news-recent-item {
        padding: 14px 20px;
        border-bottom: 1px solid var(--gray-100);
        transition: var(--transition);
    }

    .news-recent-item:last-child {
        border-bottom: none;
    }

    .news-recent-item:hover {
        background: var(--gray-50);
        transform: translateX(4px);
    }

    .news-recent-link {
        display: block;
        color: var(--gray-700);
        font-size: 0.875rem;
        font-weight: 600;
        line-height: 1.45;
        text-decoration: none;
        word-break: break-word;
        transition: var(--transition);
    }

    .news-recent-link:hover {
        color: var(--primary);
        text-decoration: none;
    }

    .news-recent-date {
        display: block;
        font-size: 0.7rem;
        color: var(--gray-400);
        margin-top: 6px;
        font-weight: 400;
    }

    .news-all-btn {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 10px;
        background: linear-gradient(135deg, var(--primary) 0%, var(--primary-dark) 100%);
        color: #fff;
        padding: 12px 24px;
        font-size: 0.8rem;
        font-weight: 700;
        letter-spacing: 0.07em;
        text-transform: uppercase;
        text-decoration: none;
        margin: 16px 20px 20px;
        border-radius: 40px;
        transition: var(--transition);
    }

    .news-all-btn:hover {
        transform: translateY(-2px);
        box-shadow: var(--shadow-md);
        color: #fff;
        text-decoration: none;
    }

    .news-all-btn i {
        transition: transform 0.2s ease;
    }

    .news-all-btn:hover i {
        transform: translateX(4px);
    }

    .news-cat-item {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 12px 20px;
        border-bottom: 1px solid var(--gray-100);
        transition: var(--transition);
    }

    .news-cat-item:last-child {
        border-bottom: none;
    }

    .news-cat-item:hover {
        background: var(--gray-50);
        transform: translateX(4px);
    }

    .news-cat-link {
        color: var(--gray-700);
        font-size: 0.875rem;
        text-decoration: none;
        transition: var(--transition);
        font-weight: 500;
    }

    .news-cat-link:hover {
        color: var(--primary);
        text-decoration: none;
    }

    .news-cat-count {
        background: linear-gradient(135deg, var(--gray-100) 0%, var(--gray-200) 100%);
        color: var(--gray-600);
        padding: 3px 10px;
        border-radius: 20px;
        font-size: 0.7rem;
        font-weight: 700;
    }

    /* ===== LIGHTBOX ===== */
    .lightbox {
        display: none;
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0,0,0,0.96);
        z-index: 1000;
        cursor: pointer;
        align-items: center;
        justify-content: center;
        animation: fadeIn 0.3s ease;
    }

    .lightbox.active {
        display: flex;
    }

    .lightbox img {
        max-width: 90%;
        max-height: 90%;
        object-fit: contain;
        animation: zoomIn 0.3s ease;
    }

    @keyframes zoomIn {
        from {
            opacity: 0;
            transform: scale(0.9);
        }
        to {
            opacity: 1;
            transform: scale(1);
        }
    }

    .lightbox-close {
        position: absolute;
        top: 24px;
        right: 32px;
        color: white;
        font-size: 2rem;
        cursor: pointer;
        background: none;
        border: none;
        transition: var(--transition);
    }

    .lightbox-close:hover {
        transform: rotate(90deg);
        color: var(--gold);
    }

    .lightbox-prev, 
    .lightbox-next {
        position: absolute;
        top: 50%;
        transform: translateY(-50%);
        background: rgba(255,255,255,0.1);
        color: white;
        border: none;
        padding: 1rem 1.25rem;
        cursor: pointer;
        font-size: 1.25rem;
        border-radius: 50%;
        transition: var(--transition);
        backdrop-filter: blur(10px);
    }

    .lightbox-prev:hover, 
    .lightbox-next:hover {
        background: var(--gold);
        transform: translateY(-50%) scale(1.1);
    }

    .lightbox-prev {
        left: 24px;
    }

    .lightbox-next {
        right: 24px;
    }

    .lightbox-counter {
        position: absolute;
        bottom: 24px;
        left: 0;
        right: 0;
        text-align: center;
        color: white;
        font-size: 0.875rem;
        background: rgba(0,0,0,0.5);
        display: inline-block;
        width: auto;
        margin: 0 auto;
        padding: 6px 16px;
        border-radius: 30px;
        backdrop-filter: blur(10px);
        width: fit-content;
    }

    /* ===== RESPONSIVE ===== */
    @media (max-width: 1024px) {
        .news-detail-grid {
            grid-template-columns: 1fr;
            gap: 32px;
        }
        .news-sidebar {
            order: 2;
        }
        .news-article {
            order: 1;
        }
    }

    @media (max-width: 768px) {
        .news-detail-wrapper {
            padding: 32px 0 60px;
        }
        .news-category-bar {
            padding: 12px 24px;
        }
        .news-category-date {
            margin-left: 0;
            width: 100%;
            margin-top: 6px;
        }
        .news-article-meta {
            gap: 16px;
        }
    }

    @media (max-width: 480px) {
        .news-detail-wrapper {
            padding: 20px 0 40px;
        }
        .news-article-meta {
            flex-direction: column;
            gap: 10px;
        }
        .news-article-body {
            font-size: 0.9rem;
        }
        .lightbox-prev,
        .lightbox-next {
            padding: 0.75rem 1rem;
        }
        .lightbox-prev {
            left: 12px;
        }
        .lightbox-next {
            right: 12px;
        }
    }

    /* ===== SCROLL REVEAL ===== */
    .scroll-reveal {
        opacity: 0;
        transform: translateY(30px);
        transition: opacity 0.6s ease, transform 0.6s ease;
    }

    .scroll-reveal.revealed {
        opacity: 1;
        transform: translateY(0);
    }
</style>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
@endsection

@section('content')

{{-- Breadcrumb --}}
<div class="news-breadcrumb">
    <div class="site-container">
        <ol class="news-breadcrumb-list">
            <li><a href="/"><i class="fas fa-home"></i> Beranda</a></li>
            <li><a href="{{ route('public.news.index') }}">Berita</a></li>
            <li><span class="current">{{ \Illuminate\Support\Str::limit($news->title, 50) }}</span></li>
        </ol>
    </div>
</div>

<div class="news-detail-wrapper">
    <div class="site-container">

        <a href="{{ route('public.news.index') }}" class="news-back-btn">
            <i class="fas fa-arrow-left"></i> Kembali ke Daftar Berita
        </a>

        <div class="news-detail-grid">

            {{-- Artikel --}}
            <article class="news-article scroll-reveal">
                <div class="news-category-bar">
                    <span class="news-category-dot"></span>
                    <span class="news-category-tag">
                        @if($news->category)
                            {{ $news->category->name }}
                        @else
                            Berita Kampus
                        @endif
                    </span>
                    <span class="news-category-date">{{ $news->created_at->translatedFormat('d F Y') }}</span>
                </div>

                <div class="news-article-inner">
                    <h1 class="news-article-title">{{ $news->title }}</h1>
                    <hr class="news-title-rule">

                    <div class="news-article-meta">
                        <div class="news-meta-item">
                            <i class="far fa-calendar-alt"></i>
                            <span>{{ $news->created_at->translatedFormat('l, d F Y') }}</span>
                        </div>
                        <div class="news-meta-item">
                            <i class="far fa-clock"></i>
                            @php
                                $cleanContent = html_entity_decode($news->content, ENT_QUOTES, 'UTF-8');
                                $cleanContent = html_entity_decode($cleanContent, ENT_QUOTES, 'UTF-8');
                                $cleanContent = strip_tags($cleanContent);
                                $wordCount = str_word_count($cleanContent);
                                $readingTime = ceil($wordCount / 200);
                            @endphp
                            <span>{{ $readingTime }} menit membaca</span>
                        </div>
                        <div class="news-meta-item">
                            <i class="far fa-user"></i>
                            <span>{{ $news->user->name ?? 'Tim Redaksi' }}</span>
                        </div>
                    </div>

                    {{-- Featured Image (gambar pertama) --}}
                    @php
                        $firstImage = $news->images->first();
                    @endphp
                    @if($firstImage)
                    <div class="news-featured-image" onclick="openLightbox(0)">
                        <img src="{{ Storage::url($firstImage->path) }}"
                             alt="{{ $news->title }}"
                             loading="lazy">
                    </div>
                    @elseif($news->image)
                    <div class="news-featured-image" onclick="openLightbox(0)">
                        <img src="{{ Storage::url($news->image) }}"
                             alt="{{ $news->title }}"
                             loading="lazy">
                    </div>
                    @endif

                    {{-- Gallery untuk gambar tambahan --}}
                    @if($news->images->count() > 1)
                    <div class="news-gallery-section scroll-reveal">
                        <div class="news-gallery-title">
                            <i class="fas fa-images"></i>
                            Galeri Foto ({{ $news->images->count() }} gambar)
                        </div>
                        <div class="news-gallery-grid" id="galleryGrid">
                            @foreach($news->images as $index => $image)
                                <div class="news-gallery-item" onclick="event.stopPropagation(); openLightbox({{ $index }})">
                                    <img src="{{ Storage::url($image->path) }}" alt="Gambar {{ $index + 1 }}">
                                </div>
                            @endforeach
                        </div>
                    </div>
                    @endif

                    {{-- Konten TinyMCE --}}
                    <div class="news-article-body scroll-reveal">
                        @php
                            $decodedContent = html_entity_decode($news->content, ENT_QUOTES, 'UTF-8');
                            $decodedContent = html_entity_decode($decodedContent, ENT_QUOTES, 'UTF-8');
                        @endphp
                        {!! $decodedContent !!}
                    </div>
                </div>
            </article>

            {{-- Sidebar --}}
            <aside class="news-sidebar">
                <div class="news-sidebar-widget scroll-reveal">
                    <div class="news-widget-header">
                        <div class="news-widget-header-line"></div>
                        <h2 class="news-widget-title">Berita Terkini</h2>
                    </div>
                    <div class="news-widget-body">
                        @if(isset($recentNews) && count($recentNews) > 0)
                            @foreach($recentNews as $recent)
                                <div class="news-recent-item">
                                    <a href="{{ route('public.news.show', $recent->id) }}" class="news-recent-link">
                                        {{ \Illuminate\Support\Str::limit($recent->title, 65) }}
                                        <time class="news-recent-date">
                                            <i class="far fa-calendar-alt"></i> {{ $recent->created_at->translatedFormat('d M Y') }}
                                        </time>
                                    </a>
                                </div>
                            @endforeach
                            <a href="{{ route('public.news.index') }}" class="news-all-btn">
                                Semua Berita <i class="fas fa-arrow-right"></i>
                            </a>
                        @else
                            <div style="padding: 28px 20px; color: var(--gray-400); font-size: 0.875rem; text-align: center;">
                                <i class="far fa-newspaper" style="font-size: 2rem; margin-bottom: 12px; display: block;"></i>
                                Tidak ada berita lainnya
                            </div>
                        @endif
                    </div>
                </div>

                @if(isset($categories) && count($categories) > 0)
                <div class="news-sidebar-widget scroll-reveal">
                    <div class="news-widget-header">
                        <div class="news-widget-header-line"></div>
                        <h2 class="news-widget-title">Kategori</h2>
                    </div>
                    <div class="news-widget-body">
                        @foreach($categories as $category)
                        <div class="news-cat-item">
                            <a href="{{ route('public.news.index', ['category' => $category->slug]) }}"
                               class="news-cat-link">
                                <i class="fas fa-tag" style="font-size: 0.7rem; margin-right: 6px;"></i>
                                {{ $category->name }}
                            </a>
                            <span class="news-cat-count">{{ $category->news_count ?? 0 }}</span>
                        </div>
                        @endforeach
                    </div>
                </div>
                @endif
            </aside>

        </div>
    </div>
</div>

{{-- Lightbox --}}
<div id="lightbox" class="lightbox" onclick="closeLightbox()">
    <button class="lightbox-close" onclick="event.stopPropagation(); closeLightbox()">&times;</button>
    <button class="lightbox-prev" onclick="event.stopPropagation(); prevImage()">❮</button>
    <img id="lightboxImg" src="" alt="">
    <button class="lightbox-next" onclick="event.stopPropagation(); nextImage()">❯</button>
    <div class="lightbox-counter" id="lightboxCounter"></div>
</div>

<script>
    // Kumpulkan semua URL gambar dari gallery
    let galleryImages = @json($news->images->map(fn($img) => Storage::url($img->path)));
    
    // Jika ada featured image yang belum termasuk dalam gallery
    @if($firstImage && !$news->images->contains('id', $firstImage->id))
        @php
            $featuredUrl = Storage::url($firstImage->path);
        @endphp
        if (!galleryImages.includes('{{ $featuredUrl }}')) {
            galleryImages = ['{{ $featuredUrl }}', ...galleryImages];
        }
    @elseif($news->image && !$news->images->contains('path', $news->image))
        @php
            $featuredUrl = Storage::url($news->image);
        @endphp
        if (!galleryImages.includes('{{ $featuredUrl }}')) {
            galleryImages = ['{{ $featuredUrl }}', ...galleryImages];
        }
    @endif

    let currentIndex = 0;
    const lightbox = document.getElementById('lightbox');
    const lightboxImg = document.getElementById('lightboxImg');
    const lightboxCounter = document.getElementById('lightboxCounter');

    function openLightbox(index) {
        if (!galleryImages.length) return;
        currentIndex = index;
        updateLightboxImage();
        lightbox.classList.add('active');
        document.body.style.overflow = 'hidden';
    }

    function closeLightbox() {
        lightbox.classList.remove('active');
        document.body.style.overflow = '';
    }

    function updateLightboxImage() {
        if (galleryImages[currentIndex]) {
            lightboxImg.src = galleryImages[currentIndex];
            lightboxCounter.textContent = `${currentIndex + 1} / ${galleryImages.length}`;
        }
    }

    function prevImage() {
        if (!galleryImages.length) return;
        currentIndex = (currentIndex - 1 + galleryImages.length) % galleryImages.length;
        updateLightboxImage();
    }

    function nextImage() {
        if (!galleryImages.length) return;
        currentIndex = (currentIndex + 1) % galleryImages.length;
        updateLightboxImage();
    }

    // Keyboard navigation
    document.addEventListener('keydown', function(e) {
        if (!lightbox.classList.contains('active')) return;
        
        if (e.key === 'Escape') {
            closeLightbox();
        } else if (e.key === 'ArrowLeft') {
            prevImage();
        } else if (e.key === 'ArrowRight') {
            nextImage();
        }
    });

    // Scroll Reveal Animation
    const scrollRevealElements = document.querySelectorAll('.scroll-reveal');
    
    const observerOptions = {
        threshold: 0.1,
        rootMargin: '0px 0px -50px 0px'
    };
    
    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('revealed');
                observer.unobserve(entry.target);
            }
        });
    }, observerOptions);
    
    scrollRevealElements.forEach(element => {
        observer.observe(element);
    });

    // Prevent gallery click from bubbling to featured image
    document.querySelectorAll('.news-gallery-item').forEach(item => {
        item.addEventListener('click', (e) => {
            e.stopPropagation();
        });
    });
</script>
@endsection