@extends('layouts.public')

@section('title', $news->title . ' | LPMi Universitas Kampus')

@section('styles')
<style>
    :root {
        --primary-color: #0f2a44;
        --secondary-color: #1a4a6e;
        --accent-color: #e63946;
        --text-primary: #2d3748;
        --text-secondary: #4a5568;
        --text-muted: #718096;
        --bg-light: #f8fafc;
        --bg-white: #ffffff;
        --border-color: #e2e8f0;
        --shadow-sm: 0 1px 3px rgba(0,0,0,0.12);
        --shadow-md: 0 4px 6px rgba(0,0,0,0.1);
        --shadow-lg: 0 10px 25px rgba(0,0,0,0.05);
        --radius-sm: 4px;
        --radius-md: 8px;
        --radius-lg: 12px;
        --transition: all 0.3s ease;
    }

    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }

    body {
        font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, sans-serif;
        line-height: 1.7;
        color: var(--text-primary);
        background-color: var(--bg-light);
        -webkit-font-smoothing: antialiased;
        -moz-osx-font-smoothing: grayscale;
        overflow-x: hidden;
    }

    a {
        color: var(--primary-color);
        text-decoration: none;
        transition: var(--transition);
    }

    a:hover {
        color: var(--secondary-color);
        text-decoration: underline;
    }

    img {
        max-width: 100%;
        height: auto;
        display: block;
    }

    /* BREADCRUMB */
    .breadcrumb-section {
        background: var(--bg-white);
        border-bottom: 1px solid var(--border-color);
        padding: 0.75rem 0;
        width: 100%;
    }

    .breadcrumb-container {
        width: 100%;
        max-width: 1200px;
        margin: 0 auto;
        padding: 0 20px;
    }

    .breadcrumb-list {
        display: flex;
        align-items: center;
        gap: 0.5rem;
        list-style: none;
        color: var(--text-muted);
        font-size: 0.875rem;
        flex-wrap: wrap;
    }

    .breadcrumb-item:not(:last-child)::after {
        content: '›';
        margin-left: 0.5rem;
        color: var(--text-muted);
    }

    .breadcrumb-link {
        color: var(--text-muted);
        transition: var(--transition);
    }

    .breadcrumb-link:hover {
        color: var(--primary-color);
        text-decoration: none;
    }

    .breadcrumb-current {
        color: var(--primary-color);
        font-weight: 600;
    }

    /* MAIN CONTENT - PERBAIKAN POSISI */
    .main-content {
        padding: 1.5rem 0 3rem;
        width: 100%;
        min-height: auto;
        position: relative;
    }

    .main-container {
        width: 100%;
        max-width: 1200px;
        margin: 0 auto;
        padding: 0 20px;
    }

    /* BACK BUTTON */
    .back-button-wrapper {
        margin: 0 0 1.5rem 0;
    }

    .back-button {
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        background: var(--bg-white);
        color: var(--text-secondary);
        padding: 0.6rem 1.25rem;
        border-radius: var(--radius-md);
        font-weight: 500;
        box-shadow: var(--shadow-sm);
        transition: var(--transition);
        border: 1px solid var(--border-color);
        width: auto;
        font-size: 0.95rem;
    }

    .back-button:hover {
        background: var(--primary-color);
        color: white;
        transform: translateY(-2px);
        box-shadow: var(--shadow-md);
        text-decoration: none;
        border-color: var(--primary-color);
    }

    .back-button span {
        font-size: 1.2rem;
        line-height: 1;
    }

    /* ARTICLE LAYOUT */
    .article-layout {
        display: grid;
        grid-template-columns: 1fr 300px;
        gap: 2rem;
        width: 100%;
        align-items: start;
    }

    /* ARTICLE CARD */
    .article-card {
        background: var(--bg-white);
        border-radius: var(--radius-lg);
        box-shadow: var(--shadow-lg);
        overflow: hidden;
        width: 100%;
        margin-top: 0;
    }

    .article-header {
        padding: 2rem 2rem 0;
    }

    .article-title {
        font-size: 2.25rem;
        font-weight: 800;
        line-height: 1.3;
        color: var(--primary-color);
        margin-bottom: 1.5rem;
        letter-spacing: -0.5px;
        word-break: break-word;
    }

    .article-meta {
        display: flex;
        flex-wrap: wrap;
        gap: 1.5rem;
        padding: 1.25rem 0;
        border-bottom: 1px solid var(--border-color);
        margin-bottom: 2rem;
    }

    .meta-item {
        display: flex;
        align-items: center;
        gap: 0.5rem;
        color: var(--text-muted);
        font-size: 0.875rem;
        flex-wrap: wrap;
    }

    .meta-icon {
        width: 18px;
        height: 18px;
        opacity: 0.7;
        display: inline-flex;
        align-items: center;
        justify-content: center;
    }

    .article-featured-image {
        position: relative;
        margin: 0 2rem 2rem;
        border-radius: var(--radius-md);
        overflow: hidden;
        aspect-ratio: 16/9;
        width: calc(100% - 4rem);
    }

    .article-featured-image img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.5s ease;
    }

    .article-featured-image:hover img {
        transform: scale(1.02);
    }

    .image-caption {
        position: absolute;
        bottom: 0;
        left: 0;
        right: 0;
        background: linear-gradient(transparent, rgba(0,0,0,0.7));
        color: white;
        padding: 1rem;
        font-size: 0.875rem;
        opacity: 0;
        transform: translateY(10px);
        transition: var(--transition);
    }

    .article-featured-image:hover .image-caption {
        opacity: 1;
        transform: translateY(0);
    }

    .article-body {
        padding: 0 2rem 2rem;
        font-size: 1.0625rem;
        line-height: 1.8;
        word-wrap: break-word;
        overflow-wrap: break-word;
    }

    .article-body > * {
        margin-bottom: 1.5rem;
        max-width: 100%;
    }

    .article-body p {
        text-align: justify;
        width: 100%;
        overflow-wrap: break-word;
    }

    .article-body h2 {
        font-size: 1.75rem;
        font-weight: 700;
        color: var(--primary-color);
        margin: 2.5rem 0 1rem;
        padding-bottom: 0.5rem;
        border-bottom: 2px solid var(--border-color);
        word-break: break-word;
    }

    .article-body h3 {
        font-size: 1.375rem;
        font-weight: 600;
        color: var(--secondary-color);
        margin: 2rem 0 1rem;
        word-break: break-word;
    }

    .article-body ul, .article-body ol {
        margin-left: 1.5rem;
        padding-left: 0.5rem;
    }

    .article-body li {
        margin-bottom: 0.75rem;
        word-break: break-word;
    }

    .article-body blockquote {
        border-left: 4px solid var(--primary-color);
        padding: 1.5rem 2rem;
        margin: 2rem 0;
        background: var(--bg-light);
        border-radius: 0 var(--radius-md) var(--radius-md) 0;
        font-style: italic;
        color: var(--text-secondary);
        position: relative;
        width: 100%;
        overflow-x: auto;
    }

    .article-body blockquote::before {
        content: '"';
        font-size: 4rem;
        color: var(--border-color);
        position: absolute;
        top: -1rem;
        left: 1rem;
        font-family: Georgia, serif;
        opacity: 0.5;
    }

    /* SIDEBAR */
    .sidebar {
        display: flex;
        flex-direction: column;
        gap: 1.5rem;
        width: 100%;
    }

    .sidebar-widget {
        background: var(--bg-white);
        border-radius: var(--radius-lg);
        padding: 1.5rem;
        box-shadow: var(--shadow-lg);
        width: 100%;
    }

    .widget-title {
        font-size: 1.25rem;
        font-weight: 700;
        color: var(--primary-color);
        margin-bottom: 1.25rem;
        padding-bottom: 0.75rem;
        border-bottom: 2px solid var(--border-color);
        position: relative;
        word-break: break-word;
    }

    .widget-title::after {
        content: '';
        position: absolute;
        bottom: -2px;
        left: 0;
        width: 60px;
        height: 2px;
        background: var(--accent-color);
    }

    .recent-articles {
        list-style: none;
        width: 100%;
    }

    .recent-article {
        padding: 0.875rem 0;
        border-bottom: 1px solid var(--border-color);
    }

    .recent-article:last-child {
        border-bottom: none;
    }

    .recent-article-link {
        display: block;
        color: var(--text-primary);
        font-weight: 500;
        font-size: 0.9375rem;
        line-height: 1.4;
        transition: var(--transition);
        word-break: break-word;
    }

    .recent-article-link:hover {
        color: var(--primary-color);
        transform: translateX(5px);
        text-decoration: none;
    }

    .recent-article-date {
        display: block;
        font-size: 0.8125rem;
        color: var(--text-muted);
        margin-top: 0.25rem;
    }

    .category-list {
        list-style: none;
        width: 100%;
    }

    .category-item {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 0.75rem 0;
        border-bottom: 1px solid var(--border-color);
    }

    .category-item:last-child {
        border-bottom: none;
    }

    .category-link {
        color: var(--text-secondary);
        transition: var(--transition);
        word-break: break-word;
    }

    .category-link:hover {
        color: var(--primary-color);
        text-decoration: none;
    }

    .category-count {
        background: var(--bg-light);
        color: var(--text-muted);
        padding: 0.25rem 0.5rem;
        border-radius: var(--radius-sm);
        font-size: 0.75rem;
        font-weight: 500;
        white-space: nowrap;
    }

    .btn-primary {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 0.5rem;
        background: var(--primary-color);
        color: white;
        padding: 0.75rem 1.25rem;
        border-radius: var(--radius-md);
        font-weight: 600;
        text-align: center;
        width: 100%;
        border: none;
        cursor: pointer;
        transition: var(--transition);
        margin-top: 0.5rem;
        font-size: 0.95rem;
    }

    .btn-primary:hover {
        background: var(--secondary-color);
        transform: translateY(-2px);
        box-shadow: var(--shadow-md);
        text-decoration: none;
        color: white;
    }

    /* EMPTY STATE */
    .empty-state {
        text-align: center;
        padding: 2rem;
        color: var(--text-muted);
        width: 100%;
    }

    .empty-state-icon {
        font-size: 2rem;
        margin-bottom: 1rem;
        opacity: 0.5;
    }

    /* RESPONSIVE DESIGN */
    @media (max-width: 1024px) {
        .article-layout {
            grid-template-columns: 1fr;
            gap: 2rem;
        }
        
        .sidebar {
            order: 2;
            margin-top: 0;
        }
        
        .article-card {
            order: 1;
        }
    }

    @media (max-width: 768px) {
        .breadcrumb-section {
            padding: 0.5rem 0;
        }
        
        .breadcrumb-container {
            padding: 0 16px;
        }
        
        .breadcrumb-list {
            font-size: 0.8rem;
        }
        
        .main-content {
            padding: 1rem 0 2rem;
        }
        
        .main-container {
            padding: 0 16px;
        }
        
        .back-button-wrapper {
            margin: 0 0 1rem 0;
        }
        
        .back-button {
            padding: 0.5rem 1rem;
            font-size: 0.9rem;
        }
        
        .article-header {
            padding: 1.5rem 1.5rem 0;
        }
        
        .article-title {
            font-size: 1.75rem;
            margin-bottom: 1rem;
        }
        
        .article-meta {
            flex-direction: column;
            gap: 0.5rem;
            padding: 1rem 0;
            margin-bottom: 1.5rem;
        }
        
        .article-featured-image {
            margin: 0 1.5rem 1.5rem;
            width: calc(100% - 3rem);
        }
        
        .article-body {
            padding: 0 1.5rem 1.5rem;
            font-size: 1rem;
        }
        
        .article-body h2 {
            font-size: 1.5rem;
            margin: 2rem 0 0.75rem;
        }
        
        .article-body h3 {
            font-size: 1.25rem;
            margin: 1.5rem 0 0.75rem;
        }
        
        .sidebar-widget {
            padding: 1.25rem;
        }
    }

    @media (max-width: 480px) {
        .breadcrumb-container {
            padding: 0 12px;
        }
        
        .breadcrumb-list {
            font-size: 0.75rem;
            gap: 0.3rem;
        }
        
        .main-content {
            padding: 0.75rem 0 1.5rem;
        }
        
        .main-container {
            padding: 0 12px;
        }
        
        .back-button-wrapper {
            margin: 0 0 0.75rem 0;
        }
        
        .back-button {
            padding: 0.5rem 0.75rem;
            font-size: 0.85rem;
            width: 100%;
            justify-content: center;
        }
        
        .article-header {
            padding: 1.25rem 1.25rem 0;
        }
        
        .article-title {
            font-size: 1.35rem;
            line-height: 1.4;
        }
        
        .meta-item {
            font-size: 0.8rem;
        }
        
        .article-featured-image {
            margin: 0 1.25rem 1.25rem;
            width: calc(100% - 2.5rem);
        }
        
        .image-caption {
            opacity: 1;
            transform: translateY(0);
            font-size: 0.75rem;
            padding: 0.5rem;
        }
        
        .article-body {
            padding: 0 1.25rem 1.25rem;
            font-size: 0.95rem;
        }
        
        .article-body h2 {
            font-size: 1.35rem;
        }
        
        .article-body h3 {
            font-size: 1.15rem;
        }
        
        .article-body blockquote {
            padding: 1rem 1.25rem;
        }
        
        .article-body blockquote::before {
            font-size: 3rem;
            top: -0.5rem;
            left: 0.5rem;
        }
        
        .sidebar-widget {
            padding: 1rem;
        }
        
        .widget-title {
            font-size: 1.1rem;
            margin-bottom: 1rem;
        }
        
        .recent-article-link {
            font-size: 0.85rem;
        }
        
        .recent-article-date {
            font-size: 0.75rem;
        }
        
        .btn-primary {
            padding: 0.6rem 1rem;
            font-size: 0.9rem;
        }
    }

    /* UTILITY CLASSES */
    .sr-only {
        position: absolute;
        width: 1px;
        height: 1px;
        padding: 0;
        margin: -1px;
        overflow: hidden;
        clip: rect(0, 0, 0, 0);
        white-space: nowrap;
        border: 0;
    }

    .text-center {
        text-align: center;
    }

    /* Responsive table */
    .article-body table {
        width: 100%;
        max-width: 100%;
        overflow-x: auto;
        display: block;
        border-collapse: collapse;
        margin: 1rem 0;
    }

    .article-body table td,
    .article-body table th {
        padding: 0.5rem;
        border: 1px solid var(--border-color);
        min-width: 100px;
    }

    /* Responsive iframe */
    .article-body iframe {
        max-width: 100%;
        width: 100%;
        height: auto;
        min-height: 315px;
        border: none;
    }

    @media (max-width: 768px) {
        .article-body iframe {
            min-height: 250px;
        }
    }

    @media (max-width: 480px) {
        .article-body iframe {
            min-height: 200px;
        }
    }
</style>
@endsection

@section('content')
<!-- BREADCRUMB SECTION -->
<section class="breadcrumb-section">
    <div class="breadcrumb-container">
        <ol class="breadcrumb-list" itemscope itemtype="https://schema.org/BreadcrumbList">
            <li class="breadcrumb-item" itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">
                <a href="/" class="breadcrumb-link" itemprop="item">
                    <span itemprop="name">Beranda</span>
                </a>
                <meta itemprop="position" content="1" />
            </li>
            <li class="breadcrumb-item" itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">
                <a href="{{ route('public.news.index') }}" class="breadcrumb-link" itemprop="item">
                    <span itemprop="name">Berita</span>
                </a>
                <meta itemprop="position" content="2" />
            </li>
            <li class="breadcrumb-item" itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">
                <span class="breadcrumb-current" itemprop="name">
                    {{ \Illuminate\Support\Str::limit($news->title, 50) }}
                </span>
                <meta itemprop="position" content="3" />
            </li>
        </ol>
    </div>
</section>

<!-- MAIN CONTENT SECTION -->
<main class="main-content">
    <div class="main-container">
        <!-- BACK BUTTON -->
        <div class="back-button-wrapper">
            <a href="{{ route('public.news.index') }}" class="back-button" aria-label="Kembali ke halaman berita">
                <span aria-hidden="true">←</span> Kembali ke Daftar Berita
            </a>
        </div>

        <!-- ARTICLE LAYOUT -->
        <div class="article-layout">
            <!-- ARTICLE CONTENT (UTAMA) -->
            <article class="article-card" itemscope itemtype="https://schema.org/NewsArticle">
                <meta itemprop="datePublished" content="{{ $news->created_at->toIso8601String() }}">
                <meta itemprop="dateModified" content="{{ $news->updated_at->toIso8601String() }}">
                
                <header class="article-header">
                    <h1 class="article-title" itemprop="headline">{{ $news->title }}</h1>
                    
                    <div class="article-meta">
                        <div class="meta-item" itemprop="dateCreated">
                            <span class="meta-icon" aria-hidden="true">📅</span>
                            <time datetime="{{ $news->created_at->toIso8601String() }}">
                                {{ $news->created_at->translatedFormat('l, d F Y') }}
                            </time>
                        </div>
                        <div class="meta-item" itemprop="author" itemscope itemtype="https://schema.org/Person">
                            <span class="meta-icon" aria-hidden="true">👤</span>
                            <span itemprop="name">{{ $news->user->name ?? 'Tim Redaksi LPM' }}</span>
                        </div>
                        <div class="meta-item">
                            <span class="meta-icon" aria-hidden="true">🏷️</span>
                            <span itemprop="articleSection">Berita Kampus</span>
                        </div>
                        <div class="meta-item reading-time" id="readingTime"></div>
                    </div>
                </header>

                @if($news->image)
                <figure class="article-featured-image" itemprop="image" itemscope itemtype="https://schema.org/ImageObject">
                    <img src="{{ asset('storage/'.$news->image) }}" 
                         alt="{{ $news->title }}"
                         loading="lazy"
                         itemprop="contentUrl"
                         onerror="this.src='https://images.unsplash.com/photo-1588681664899-f142ff2dc9b1?ixlib=rb-4.0.3&auto=format&fit=crop&w=1200&q=80';
                                  this.alt='Gambar tidak tersedia';">
                    <figcaption class="image-caption" itemprop="caption">
                        {{ $news->title }}
                    </figcaption>
                </figure>
                @endif

                <div class="article-body" itemprop="articleBody">
                    {!! nl2br(e($news->content)) !!}
                </div>
            </article>

            <!-- SIDEBAR (KANAN) -->
            <aside class="sidebar" aria-label="Sidebar Berita">
                <!-- Berita Terbaru -->
                <div class="sidebar-widget">
                    <h2 class="widget-title">Berita Terkini</h2>
                    
                    @if(isset($recentNews) && count($recentNews) > 0)
                        <ul class="recent-articles">
                            @foreach($recentNews as $recent)
                                @if($recent->id != $news->id)
                                    <li class="recent-article">
                                        <a href="{{ route('public.news.show', $recent) }}" 
                                           class="recent-article-link"
                                           itemprop="relatedLink">
                                            {{ \Illuminate\Support\Str::limit($recent->title, 70) }}
                                            <time class="recent-article-date" datetime="{{ $recent->created_at->toIso8601String() }}">
                                                {{ $recent->created_at->translatedFormat('d M Y') }}
                                            </time>
                                        </a>
                                    </li>
                                @endif
                            @endforeach
                        </ul>
                        
                        <a href="{{ route('public.news.index') }}" class="btn-primary">
                            Lihat Semua Berita
                        </a>
                    @else
                        <div class="empty-state">
                            <div class="empty-state-icon" aria-hidden="true">📰</div>
                            <p>Tidak ada berita lainnya</p>
                        </div>
                    @endif
                </div>

                <!-- Kategori -->
                @if(isset($categories) && count($categories) > 0)
                <div class="sidebar-widget">
                    <h2 class="widget-title">Kategori Berita</h2>
                    <ul class="category-list">
                        @foreach($categories as $category)
                            <li class="category-item">
                                <a href="{{ route('public.news.index', ['category' => $category->slug]) }}" 
                                   class="category-link"
                                   itemprop="genre">
                                    {{ $category->name }}
                                </a>
                                <span class="category-count">{{ $category->news_count ?? 0 }}</span>
                            </li>
                        @endforeach
                    </ul>
                </div>
                @endif

                <!-- Call to Action -->
                <div class="sidebar-widget text-center">
                    <h2 class="widget-title">Ikuti Kami</h2>
                    <p class="mb-3">Dapatkan update terbaru dari LPM Universitas Kampus</p>
                    <a href="https://instagram.com/lpm_universitas" 
                       target="_blank" 
                       rel="noopener noreferrer"
                       class="btn-primary">
                        <span aria-hidden="true">📷</span> Follow Instagram
                    </a>
                </div>
            </aside>
        </div>
    </div>
</main>
@endsection

@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        'use strict';

        // Hitung waktu baca
        function calculateReadingTime() {
            const articleBody = document.querySelector('.article-body');
            const readingTimeElement = document.getElementById('readingTime');
            
            if (articleBody && readingTimeElement) {
                const text = articleBody.textContent || '';
                const words = text.trim().split(/\s+/).filter(word => word.length > 0);
                const wordCount = words.length;
                const readingTime = Math.ceil(wordCount / 200); // 200 kata per menit
                
                if (readingTime > 0) {
                    readingTimeElement.innerHTML = `
                        <span class="meta-icon" aria-hidden="true">⏱️</span>
                        <span>${readingTime} menit baca</span>
                    `;
                }
            }
        }

        // Lazy loading images
        function lazyLoadImages() {
            const images = document.querySelectorAll('img[loading="lazy"]');
            
            if ('IntersectionObserver' in window) {
                const imageObserver = new IntersectionObserver((entries, observer) => {
                    entries.forEach(entry => {
                        if (entry.isIntersecting) {
                            const img = entry.target;
                            img.classList.remove('loading');
                            observer.unobserve(img);
                        }
                    });
                }, {
                    rootMargin: '50px 0px',
                    threshold: 0.1
                });

                images.forEach(img => {
                    img.classList.add('loading');
                    imageObserver.observe(img);
                });
            }
        }

        // Handle responsive tables
        function handleResponsiveTables() {
            const articleBody = document.querySelector('.article-body');
            if (articleBody) {
                const tables = articleBody.querySelectorAll('table');
                tables.forEach(table => {
                    const wrapper = document.createElement('div');
                    wrapper.style.cssText = `
                        overflow-x: auto;
                        max-width: 100%;
                        margin: 1rem 0;
                        -webkit-overflow-scrolling: touch;
                    `;
                    table.parentNode.insertBefore(wrapper, table);
                    wrapper.appendChild(table);
                });
            }
        }

        // Handle image errors
        function handleImageErrors() {
            document.querySelectorAll('img').forEach(img => {
                img.addEventListener('error', function() {
                    this.src = 'https://images.unsplash.com/photo-1588681664899-f142ff2dc9b1?ixlib=rb-4.0.3&auto=format&fit=crop&w=1200&q=80';
                    this.alt = 'Gambar tidak tersedia';
                });
            });
        }

        // Handle responsive iframes
        function handleResponsiveIframes() {
            const articleBody = document.querySelector('.article-body');
            if (articleBody) {
                const iframes = articleBody.querySelectorAll('iframe');
                iframes.forEach(iframe => {
                    const wrapper = document.createElement('div');
                    wrapper.style.cssText = `
                        position: relative;
                        width: 100%;
                        padding-bottom: 56.25%; /* 16:9 aspect ratio */
                        height: 0;
                        overflow: hidden;
                        margin: 1rem 0;
                    `;
                    
                    iframe.style.cssText = `
                        position: absolute;
                        top: 0;
                        left: 0;
                        width: 100%;
                        height: 100%;
                        border: none;
                    `;
                    
                    iframe.parentNode.insertBefore(wrapper, iframe);
                    wrapper.appendChild(iframe);
                });
            }
        }

        // Initialize all functions
        calculateReadingTime();
        lazyLoadImages();
        handleResponsiveTables();
        handleImageErrors();
        handleResponsiveIframes();
    });
</script>
@endsection