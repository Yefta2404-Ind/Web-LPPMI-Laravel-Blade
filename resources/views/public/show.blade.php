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

    .container {
        max-width: 1200px;
        margin: 0 auto;
        padding: 0 24px;
    }

    /* BREADCRUMB */
    .breadcrumb {
        background: var(--bg-white);
        padding: 1rem 0;
        border-bottom: 1px solid var(--border-color);
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
    }

    .breadcrumb-link {
        color: var(--text-muted);
    }

    .breadcrumb-link:hover {
        color: var(--primary-color);
    }

    .breadcrumb-current {
        color: var(--primary-color);
        font-weight: 600;
    }

    /* MAIN CONTENT */
    .main-content {
        padding: 2rem 0 4rem;
        min-height: calc(100vh - 200px);
    }

    .article-layout {
        display: grid;
        grid-template-columns: 1fr 300px;
        gap: 3rem;
    }

    /* ARTICLE STYLES */
    .article-card {
        background: var(--bg-white);
        border-radius: var(--radius-lg);
        box-shadow: var(--shadow-lg);
        overflow: hidden;
    }

    .article-header {
        padding: 2.5rem 2.5rem 0;
    }

    .article-title {
        font-size: 2.25rem;
        font-weight: 800;
        line-height: 1.2;
        color: var(--primary-color);
        margin-bottom: 1.5rem;
        letter-spacing: -0.5px;
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
    }

    .meta-icon {
        width: 16px;
        height: 16px;
        opacity: 0.7;
    }

    .article-featured-image {
        position: relative;
        margin: 0 2.5rem 2.5rem;
        border-radius: var(--radius-md);
        overflow: hidden;
        aspect-ratio: 16/9;
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
        padding: 0 2.5rem 2.5rem;
        font-size: 1.0625rem;
        line-height: 1.8;
    }

    .article-body > * {
        margin-bottom: 1.5rem;
    }

    .article-body p {
        text-align: justify;
    }

    .article-body h2 {
        font-size: 1.75rem;
        font-weight: 700;
        color: var(--primary-color);
        margin: 2.5rem 0 1rem;
        padding-bottom: 0.5rem;
        border-bottom: 2px solid var(--border-color);
    }

    .article-body h3 {
        font-size: 1.375rem;
        font-weight: 600;
        color: var(--secondary-color);
        margin: 2rem 0 1rem;
    }

    .article-body ul, .article-body ol {
        margin-left: 1.5rem;
    }

    .article-body li {
        margin-bottom: 0.75rem;
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
    }

    .article-body blockquote::before {
        content: '"';
        font-size: 4rem;
        color: var(--border-color);
        position: absolute;
        top: -1rem;
        left: 1rem;
        font-family: Georgia, serif;
    }

    /* SIDEBAR */
    .sidebar {
        display: flex;
        flex-direction: column;
        gap: 1.5rem;
    }

    .sidebar-widget {
        background: var(--bg-white);
        border-radius: var(--radius-lg);
        padding: 1.5rem;
        box-shadow: var(--shadow-lg);
    }

    .widget-title {
        font-size: 1.25rem;
        font-weight: 700;
        color: var(--primary-color);
        margin-bottom: 1.25rem;
        padding-bottom: 0.75rem;
        border-bottom: 2px solid var(--border-color);
        position: relative;
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
    }

    .btn-primary {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 0.5rem;
        background: var(--primary-color);
        color: white;
        padding: 0.875rem 1.5rem;
        border-radius: var(--radius-md);
        font-weight: 600;
        text-align: center;
        width: 100%;
        border: none;
        cursor: pointer;
        transition: var(--transition);
        margin-top: 1rem;
    }

    .btn-primary:hover {
        background: var(--secondary-color);
        transform: translateY(-2px);
        box-shadow: var(--shadow-md);
        text-decoration: none;
        color: white;
    }

    /* BACK BUTTON */
    .back-button {
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        background: var(--bg-white);
        color: var(--text-secondary);
        padding: 0.75rem 1.25rem;
        border-radius: var(--radius-md);
        font-weight: 500;
        margin-bottom: 2rem;
        box-shadow: var(--shadow-sm);
        transition: var(--transition);
        border: 1px solid var(--border-color);
    }

    .back-button:hover {
        background: var(--primary-color);
        color: white;
        transform: translateY(-2px);
        box-shadow: var(--shadow-md);
        text-decoration: none;
        border-color: var(--primary-color);
    }

    /* EMPTY STATE */
    .empty-state {
        text-align: center;
        padding: 2rem;
        color: var(--text-muted);
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
        
        .article-title {
            font-size: 2rem;
        }
        
        .sidebar {
            order: -1;
        }
    }

    @media (max-width: 768px) {
        .container {
            padding: 0 16px;
        }

        .article-header,
        .article-featured-image,
        .article-body {
            padding-left: 1.5rem;
            padding-right: 1.5rem;
        }

        .article-title {
            font-size: 1.75rem;
        }

        .article-meta {
            flex-direction: column;
            gap: 0.75rem;
        }

        .main-content {
            padding: 1.5rem 0 3rem;
        }
        
        .article-featured-image {
            margin: 0 1.5rem 1.5rem;
        }
    }

    @media (max-width: 480px) {
        .article-title {
            font-size: 1.5rem;
        }
        
        .article-body {
            font-size: 1rem;
            padding: 1rem;
        }
        
        .article-body h2 {
            font-size: 1.5rem;
        }
        
        .article-body h3 {
            font-size: 1.25rem;
        }
        
        .breadcrumb-list {
            font-size: 0.75rem;
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

    .mt-4 {
        margin-top: 2rem;
    }

    .mb-3 {
        margin-bottom: 1.5rem;
    }
    
    .loading {
        opacity: 0.7;
        pointer-events: none;
    }
</style>
@endsection

@section('content')
<!-- BREADCRUMB -->
<nav class="breadcrumb" aria-label="Breadcrumb">
    <div class="container">
        <ol class="breadcrumb-list">
            <li class="breadcrumb-item">
                <a href="/" class="breadcrumb-link">Beranda</a>
            </li>
            <li class="breadcrumb-item">
                <a href="{{ route('home') }}" class="breadcrumb-link">Berita</a>
            </li>
            <li class="breadcrumb-item">
                <span class="breadcrumb-current">{{ \Illuminate\Support\Str::limit($news->title, 50) }}</span>
            </li>
        </ol>
    </div>
</nav>

<!-- MAIN CONTENT -->
<main class="main-content">
    <div class="container">
        <a href="{{ route('home') }}" class="back-button" aria-label="Kembali ke halaman berita">
            ← Kembali ke Daftar Berita
        </a>

        <div class="article-layout">
            <!-- ARTICLE CONTENT -->
            <article class="article-card">
                <header class="article-header">
                    <h1 class="article-title">{{ $news->title }}</h1>
                    
                    <div class="article-meta">
                        <div class="meta-item">
                            <span class="meta-icon">📅</span>
                            <time datetime="{{ $news->created_at->toIso8601String() }}">
                                {{ $news->created_at->translatedFormat('l, d F Y') }}
                            </time>
                        </div>
                        <div class="meta-item">
                            <span class="meta-icon">👤</span>
                            <span>{{ $news->user->name ?? 'Tim Redaksi LPM' }}</span>
                        </div>
                        <div class="meta-item">
                            <span class="meta-icon">🏷️</span>
                            <span>Berita Kampus</span>
                        </div>
                    </div>
                </header>

                @if($news->image)
                <figure class="article-featured-image">
                    <img src="{{ asset('storage/'.$news->image) }}" 
                         alt="{{ $news->title }}"
                         loading="lazy"
                         onerror="this.src='https://images.unsplash.com/photo-1588681664899-f142ff2dc9b1?ixlib=rb-4.0.3&auto=format&fit=crop&w=1200&q=80'">
                    <figcaption class="image-caption">
                        {{ $news->title }}
                    </figcaption>
                </figure>
                @endif

                <div class="article-body">
                    {!! nl2br(e($news->content)) !!}
                </div>
            </article>

            <!-- SIDEBAR -->
            <aside class="sidebar" aria-label="Sidebar">
                <!-- Berita Terbaru -->
                <div class="sidebar-widget">
                    <h2 class="widget-title">Berita Terkini</h2>
                    
                    @if(isset($recentNews) && count($recentNews) > 0)
                        <ul class="recent-articles">
                            @foreach($recentNews as $recent)
                                @if($recent->id != $news->id)
                                    <li class="recent-article">
                                        <a href="{{ route('public.news.show', $recent) }}" 
                                           class="recent-article-link">
                                            {{ \Illuminate\Support\Str::limit($recent->title, 70) }}
                                            <time class="recent-article-date" datetime="{{ $recent->created_at->toIso8601String() }}">
                                                {{ $recent->created_at->translatedFormat('d M Y') }}
                                            </time>
                                        </a>
                                    </li>
                                @endif
                            @endforeach
                        </ul>
                    @else
                        <div class="empty-state">
                            <div class="empty-state-icon">📰</div>
                            <p>Tidak ada berita lainnya</p>
                        </div>
                    @endif
                    
                    <a href="{{ route('public.news.index') }}" class="breadcrumb-link">Berita</a>
                </div>

                <!-- Kategori -->
                @if(isset($categories) && count($categories) > 0)
                <div class="sidebar-widget">
                    <h2 class="widget-title">Kategori Berita</h2>
                    <ul class="category-list">
                        @foreach($categories as $category)
                            <li class="category-item">
                                <a href="{{ route('home', ['category' => $category->slug]) }}" class="category-link">{{ $category->name }}</a>
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
                    <a href="https://instagram.com/lpm_universitas" target="_blank" class="btn-primary">
                        <span>📷</span> Follow Instagram
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
        // Calculate reading time
        function calculateReadingTime() {
            const articleBody = document.querySelector('.article-body');
            if (articleBody) {
                const text = articleBody.textContent;
                const wordCount = text.trim().split(/\s+/).length;
                const readingTime = Math.ceil(wordCount / 200);
                
                const metaContainer = document.querySelector('.article-meta');
                if (metaContainer && readingTime > 0) {
                    const readingTimeElement = document.createElement('div');
                    readingTimeElement.className = 'meta-item';
                    readingTimeElement.innerHTML = `<span class="meta-icon">⏱️</span> ${readingTime} menit baca`;
                    metaContainer.appendChild(readingTimeElement);
                }
            }
        }

        // Lazy loading for images
        function lazyLoadImages() {
            const images = document.querySelectorAll('img[loading="lazy"]');
            
            const imageObserver = new IntersectionObserver((entries, observer) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        const img = entry.target;
                        img.src = img.dataset.src || img.src;
                        img.classList.remove('loading');
                        observer.unobserve(img);
                    }
                });
            });

            images.forEach(img => {
                img.classList.add('loading');
                imageObserver.observe(img);
            });
        }

        // Add smooth scrolling for anchor links
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                const target = document.querySelector(this.getAttribute('href'));
                if (target) {
                    target.scrollIntoView({
                        behavior: 'smooth',
                        block: 'start'
                    });
                }
            });
        });

        // Initialize functions
        calculateReadingTime();
        lazyLoadImages();

        // Add copy link functionality
        const shareButtons = document.querySelectorAll('.share-btn');
        shareButtons.forEach(button => {
            button.addEventListener('click', function(e) {
                e.preventDefault();
                const url = window.location.href;
                
                if (navigator.share) {
                    navigator.share({
                        title: document.title,
                        url: url
                    });
                } else {
                    navigator.clipboard.writeText(url).then(() => {
                        alert('Link berita berhasil disalin!');
                    });
                }
            });
        });

        // Handle image error
        document.querySelectorAll('img').forEach(img => {
            img.addEventListener('error', function() {
                this.src = 'https://images.unsplash.com/photo-1588681664899-f142ff2dc9b1?ixlib=rb-4.0.3&auto=format&fit=crop&w=1200&q=80';
                this.alt = 'Gambar tidak tersedia';
            });
        });
    });
</script>
@endsection