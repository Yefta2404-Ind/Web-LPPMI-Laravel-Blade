@extends('layouts.public')

@section('title', $news->title . ' | LPPMI Universitas Gunung Kidul')

@section('styles')
<style>
    .news-breadcrumb {
        background: #fff;
        border-bottom: 1px solid #e8edf2;
        padding: 11px 0;
    }

    .news-breadcrumb-list {
        display: flex;
        align-items: center;
        gap: 4px;
        list-style: none;
        font-size: 0.8rem;
        color: #94a3b8;
        flex-wrap: wrap;
    }

    .news-breadcrumb-list li:not(:last-child)::after {
        content: '/';
        margin-left: 4px;
        color: #cbd5e0;
    }

    .news-breadcrumb-list a { color: #94a3b8; text-decoration: none; }
    .news-breadcrumb-list a:hover { color: var(--primary); }
    .news-breadcrumb-list .current { color: var(--primary); font-weight: 600; }

    /* ===== WRAPPER ===== */
    .news-detail-wrapper { padding: 32px 0 72px; }

    .news-back-btn {
        display: inline-flex;
        align-items: center;
        gap: 7px;
        color: #64748b;
        font-size: 0.82rem;
        font-weight: 500;
        text-decoration: none;
        margin-bottom: 28px;
        letter-spacing: 0.02em;
        transition: color 0.2s;
    }

    .news-back-btn i { font-size: 0.75rem; }
    .news-back-btn:hover { color: var(--primary); text-decoration: none; }

    /* ===== GRID ===== */
    .news-detail-grid {
        display: grid;
        grid-template-columns: 1fr 280px;
        gap: 36px;
        align-items: start;
    }

    /* ===== ARTICLE ===== */
    .news-article {
        background: #fff;
        border-radius: 4px;
        border: 1px solid #e8edf2;
        overflow: hidden;
    }

    .news-category-bar {
        background: var(--primary);
        padding: 10px 28px;
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .news-category-dot {
        width: 4px; height: 4px;
        border-radius: 50%;
        background: var(--gold);
        flex-shrink: 0;
    }

    .news-category-tag {
        font-size: 0.7rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.1em;
        color: var(--gold-light);
    }

    .news-category-date {
        font-size: 0.7rem;
        color: rgba(255,255,255,0.5);
        margin-left: auto;
        letter-spacing: 0.03em;
    }

    .news-article-inner { padding: 32px 36px 36px; }

    .news-article-title {
        font-size: 1.75rem;
        font-weight: 700;
        line-height: 1.35;
        color: #0f2235;
        margin-bottom: 16px;
        word-break: break-word;
        letter-spacing: -0.02em;
    }

    .news-title-rule {
        width: 44px;
        height: 3px;
        background: var(--gold);
        border: none;
        margin: 0 0 20px 0;
        border-radius: 2px;
    }

    .news-article-meta {
        display: flex;
        flex-wrap: wrap;
        gap: 20px;
        margin-bottom: 24px;
        padding-bottom: 18px;
        border-bottom: 1px solid #f1f5f9;
    }

    .news-meta-item {
        display: flex;
        align-items: center;
        gap: 6px;
        font-size: 0.8rem;
    }

    .news-meta-item i { color: var(--gold-dark); font-size: 0.72rem; }
    .news-meta-item span { color: #64748b; }

    .news-featured-image {
        margin-bottom: 28px;
        border-radius: 4px;
        overflow: hidden;
        border: 1px solid #e8edf2;
    }

    .news-featured-image img {
        width: 100%;
        height: auto;
        display: block;
        max-height: 480px;
        object-fit: cover;
    }

    .news-article-body {
        font-size: 0.975rem;
        line-height: 1.9;
        color: #374151;
        word-break: break-word;
        overflow-wrap: break-word;
    }

    .news-article-body p { margin-bottom: 18px; text-align: justify; }
    .news-article-body h2 { font-size: 1.3rem; font-weight: 700; color: var(--primary); margin: 28px 0 10px; padding-bottom: 8px; border-bottom: 1px solid #e8edf2; }
    .news-article-body h3 { font-size: 1.1rem; font-weight: 600; color: #1e3a5f; margin: 22px 0 8px; }
    .news-article-body ul, .news-article-body ol { margin-left: 22px; margin-bottom: 18px; }
    .news-article-body li { margin-bottom: 6px; }
    .news-article-body img { max-width: 100%; border-radius: 4px; margin: 16px 0; }

    .news-article-body blockquote {
        margin: 24px 0;
        padding: 16px 20px 16px 24px;
        border-left: 3px solid var(--gold);
        background: #fafbfc;
        color: #4a5568;
        font-style: italic;
        border-radius: 0 4px 4px 0;
    }

    .news-article-body table {
        width: 100%;
        border-collapse: collapse;
        margin: 20px 0;
        overflow-x: auto;
        display: block;
        font-size: 0.9rem;
    }

    .news-article-body table td,
    .news-article-body table th { padding: 10px 14px; border: 1px solid #e2e8f0; }

    .news-article-body table thead th {
        background: var(--primary);
        color: #fff;
        font-weight: 600;
    }

    /* ===== SIDEBAR ===== */
    .news-sidebar { display: flex; flex-direction: column; gap: 20px; }

    .news-sidebar-widget {
        background: #fff;
        border: 1px solid #e8edf2;
        border-radius: 4px;
        overflow: hidden;
    }

    .news-widget-header {
        background: #f8fafc;
        border-bottom: 1px solid #e8edf2;
        padding: 11px 18px;
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .news-widget-header-line {
        width: 3px; height: 13px;
        background: var(--gold);
        border-radius: 2px;
        flex-shrink: 0;
    }

    .news-widget-title {
        font-size: 0.72rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.09em;
        color: var(--primary);
        margin: 0;
    }

    .news-widget-body { padding: 4px 0; }

    .news-recent-item {
        padding: 11px 18px;
        border-bottom: 1px solid #f5f7fa;
        transition: background 0.15s;
    }

    .news-recent-item:last-child { border-bottom: none; }
    .news-recent-item:hover { background: #fafbfc; }

    .news-recent-link {
        display: block;
        color: #374151;
        font-size: 0.84rem;
        font-weight: 500;
        line-height: 1.45;
        text-decoration: none;
        word-break: break-word;
    }

    .news-recent-link:hover { color: var(--primary); text-decoration: none; }

    .news-recent-date {
        display: block;
        font-size: 0.7rem;
        color: #b0bec5;
        margin-top: 3px;
        font-weight: 400;
    }

    .news-all-btn {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 7px;
        background: var(--primary);
        color: #fff;
        padding: 10px 20px;
        font-size: 0.75rem;
        font-weight: 700;
        letter-spacing: 0.07em;
        text-transform: uppercase;
        text-decoration: none;
        margin: 12px 18px 18px;
        border-radius: 3px;
        transition: background 0.2s;
    }

    .news-all-btn:hover { background: #1e3a5f; color: #fff; text-decoration: none; }

    .news-cat-item {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 10px 18px;
        border-bottom: 1px solid #f5f7fa;
        transition: background 0.15s;
    }

    .news-cat-item:last-child { border-bottom: none; }
    .news-cat-item:hover { background: #fafbfc; }

    .news-cat-link {
        color: #374151;
        font-size: 0.84rem;
        text-decoration: none;
        transition: color 0.15s;
    }

    .news-cat-link:hover { color: var(--primary); }

    .news-cat-count {
        background: #eef2f6;
        color: #94a3b8;
        padding: 2px 8px;
        border-radius: 10px;
        font-size: 0.68rem;
        font-weight: 700;
    }

    /* ===== RESPONSIVE ===== */
    @media (max-width: 1024px) {
        .news-detail-grid { grid-template-columns: 1fr; }
        .news-sidebar { order: 2; }
        .news-article { order: 1; }
    }

    @media (max-width: 768px) {
        .news-detail-wrapper { padding: 20px 0 48px; }
        .news-article-inner { padding: 22px 20px 24px; }
        .news-article-title { font-size: 1.45rem; }
        .news-category-bar { padding: 9px 20px; }
    }

    @media (max-width: 480px) {
        .news-detail-wrapper { padding: 14px 0 36px; }
        .news-article-inner { padding: 18px 16px 20px; }
        .news-article-title { font-size: 1.2rem; }
        .news-article-meta { flex-direction: column; gap: 7px; }
        .news-article-body { font-size: 0.93rem; }
        .news-category-bar { padding: 9px 16px; }
    }
</style>
@endsection

@section('content')

{{-- Breadcrumb --}}
<div class="news-breadcrumb">
    <div class="site-container">
        <ol class="news-breadcrumb-list">
            <li><a href="/">Beranda</a></li>
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
            <article class="news-article">
                <div class="news-category-bar">
                    <span class="news-category-dot"></span>
                    <span class="news-category-tag">Berita Kampus</span>
                    <span class="news-category-date">{{ $news->created_at->translatedFormat('d F Y') }}</span>
                </div>

                <div class="news-article-inner">
                    <h1 class="news-article-title">{{ $news->title }}</h1>
                    <hr class="news-title-rule">

                    <div class="news-article-meta">
                        <div class="news-meta-item">
                            <i class="far fa-calendar"></i>
                            <span>{{ $news->created_at->translatedFormat('l, d F Y') }}</span>
                        </div>
                        <div class="news-meta-item">
                            <i class="far fa-user"></i>
                            <span>{{ $news->user->name ?? 'Tim Redaksi' }}</span>
                        </div>
                    </div>

                    @if($news->image)
                    <div class="news-featured-image">
                        <img src="{{ asset('storage/'.$news->image) }}"
                             alt="{{ $news->title }}"
                             loading="lazy"
                             onerror="this.parentElement.style.display='none'">
                    </div>
                    @endif

                    <div class="news-article-body">
                        {!! nl2br(e($news->content)) !!}
                    </div>
                </div>
            </article>

            {{-- Sidebar --}}
            <aside class="news-sidebar">
                <div class="news-sidebar-widget">
                    <div class="news-widget-header">
                        <div class="news-widget-header-line"></div>
                        <h2 class="news-widget-title">Berita Terkini</h2>
                    </div>
                    <div class="news-widget-body">
                        @if(isset($recentNews) && count($recentNews) > 0)
                            @foreach($recentNews as $recent)
                                @if($recent->id != $news->id)
                                <div class="news-recent-item">
                                    <a href="{{ route('public.news.show', $recent) }}" class="news-recent-link">
                                        {{ \Illuminate\Support\Str::limit($recent->title, 65) }}
                                        <time class="news-recent-date">
                                            {{ $recent->created_at->translatedFormat('d M Y') }}
                                        </time>
                                    </a>
                                </div>
                                @endif
                            @endforeach
                            <a href="{{ route('public.news.index') }}" class="news-all-btn">
                                Semua Berita <i class="fas fa-arrow-right"></i>
                            </a>
                        @else
                            <div style="padding:20px 18px;color:#b0bec5;font-size:0.85rem;text-align:center;">
                                Tidak ada berita lainnya
                            </div>
                        @endif
                    </div>
                </div>

                @if(isset($categories) && count($categories) > 0)
                <div class="news-sidebar-widget">
                    <div class="news-widget-header">
                        <div class="news-widget-header-line"></div>
                        <h2 class="news-widget-title">Kategori</h2>
                    </div>
                    <div class="news-widget-body">
                        @foreach($categories as $category)
                        <div class="news-cat-item">
                            <a href="{{ route('public.news.index', ['category' => $category->slug]) }}"
                               class="news-cat-link">{{ $category->name }}</a>
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

@endsection