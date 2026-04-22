@extends('layouts.public')

@section('title', 'Berita | Universitas Kampus')

@section('styles')
<link href="https://fonts.googleapis.com/css2?family=Inter:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;1,400&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
<style>
    :root {
        --primary: #0a2463;
        --primary-dark: #061a4a;
        --primary-light: #1e3a8a;
        --gold: #c9a03d;
        --gold-light: #f0d896;
        --gold-dark: #b88b2a;
        --gray-50: #f8fafc;
        --gray-100: #f1f5f9;
        --gray-200: #e2e8f0;
        --gray-300: #cbd5e1;
        --gray-400: #94a3b8;
        --gray-500: #64748b;
        --gray-600: #475569;
        --gray-700: #334155;
        --gray-800: #1e293b;
        --gray-900: #0f172a;
        --shadow-sm: 0 1px 2px 0 rgb(0 0 0 / 0.05);
        --shadow-md: 0 4px 6px -1px rgb(0 0 0 / 0.1);
        --shadow-lg: 0 10px 15px -3px rgb(0 0 0 / 0.1);
        --shadow-xl: 0 20px 25px -5px rgb(0 0 0 / 0.1);
        --transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    }

    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }

    body {
        font-family: 'Inter', sans-serif;
        background: linear-gradient(135deg, var(--gray-50) 0%, #ffffff 100%);
        color: var(--gray-800);
    }

    /* Container */
    .news-container {
        max-width: 1200px;
        margin: 0 auto;
        padding: 2rem 1.5rem;
    }

    @media (max-width: 768px) {
        .news-container {
            padding: 1.5rem 1rem;
        }
    }

    /* Hero Header */
    .news-hero {
        background: linear-gradient(135deg, var(--primary) 0%, var(--primary-dark) 100%);
        border-radius: 24px;
        padding: 2rem 2rem;
        margin-bottom: 2rem;
        position: relative;
        overflow: hidden;
        animation: fadeInDown 0.6s ease-out;
    }

    .news-hero::before {
        content: '';
        position: absolute;
        top: -50%;
        right: -20%;
        width: 300px;
        height: 300px;
        background: radial-gradient(circle, rgba(255,255,255,0.1) 0%, transparent 70%);
        border-radius: 50%;
    }

    .news-hero::after {
        content: '';
        position: absolute;
        bottom: -30%;
        left: -10%;
        width: 250px;
        height: 250px;
        background: radial-gradient(circle, rgba(201,160,61,0.1) 0%, transparent 70%);
        border-radius: 50%;
    }

    @keyframes fadeInDown {
        from {
            opacity: 0;
            transform: translateY(-30px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .hero-content {
        position: relative;
        z-index: 1;
        display: flex;
        justify-content: space-between;
        align-items: center;
        flex-wrap: wrap;
        gap: 1rem;
    }

    .hero-text h1 {
        font-size: 1.8rem;
        font-weight: 700;
        color: white;
        margin-bottom: 0.25rem;
        letter-spacing: -0.02em;
    }

    .hero-text p {
        color: rgba(255,255,255,0.8);
        font-size: 0.9rem;
    }

    .hero-badge {
        background: rgba(255,255,255,0.2);
        backdrop-filter: blur(10px);
        padding: 0.5rem 1.25rem;
        border-radius: 40px;
        font-size: 0.8rem;
        font-weight: 600;
        color: var(--gold-light);
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    @media (max-width: 640px) {
        .news-hero {
            padding: 1.5rem;
        }
        .hero-text h1 {
            font-size: 1.4rem;
        }
    }

    /* Search Section */
    .search-section {
        margin-bottom: 2rem;
        animation: fadeInUp 0.6s ease-out 0.1s both;
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

    .search-wrapper {
        position: relative;
        max-width: 500px;
    }

    .search-wrapper i {
        position: absolute;
        left: 1rem;
        top: 50%;
        transform: translateY(-50%);
        color: var(--gray-400);
        font-size: 1rem;
        transition: var(--transition);
        pointer-events: none;
    }

    .search-wrapper input {
        width: 100%;
        padding: 0.9rem 1rem 0.9rem 2.75rem;
        border: 2px solid var(--gray-200);
        border-radius: 60px;
        font-family: 'Inter', sans-serif;
        font-size: 0.9rem;
        transition: var(--transition);
        background: white;
        box-shadow: var(--shadow-sm);
    }

    .search-wrapper input:focus {
        outline: none;
        border-color: var(--gold);
        box-shadow: 0 0 0 3px rgba(201, 160, 61, 0.1);
    }

    .search-wrapper input:focus + i {
        color: var(--gold);
    }

    /* Info Stats */
    .info-stats {
        background: white;
        padding: 0.75rem 1.25rem;
        margin-bottom: 2rem;
        border-radius: 60px;
        display: flex;
        justify-content: space-between;
        align-items: center;
        flex-wrap: wrap;
        gap: 0.75rem;
        box-shadow: var(--shadow-sm);
        border: 1px solid var(--gray-200);
        animation: fadeInUp 0.6s ease-out 0.15s both;
    }

    .stats-page {
        display: flex;
        align-items: center;
        gap: 0.5rem;
        font-size: 0.85rem;
        color: var(--gray-600);
    }

    .stats-page i {
        color: var(--gold);
        font-size: 0.85rem;
    }

    .stats-page span {
        font-weight: 600;
        color: var(--primary);
    }

    .stats-limit {
        background: linear-gradient(135deg, var(--primary) 0%, var(--primary-dark) 100%);
        color: white;
        padding: 0.3rem 1rem;
        border-radius: 60px;
        font-size: 0.7rem;
        font-weight: 600;
        letter-spacing: 0.03em;
    }

    /* News Grid */
    .news-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(340px, 1fr));
        gap: 1.5rem;
        min-height: 400px;
    }

    @media (max-width: 768px) {
        .news-grid {
            grid-template-columns: 1fr;
            gap: 1rem;
        }
    }

    /* Card */
    .news-card {
        background: white;
        border-radius: 20px;
        overflow: hidden;
        text-decoration: none;
        color: inherit;
        transition: var(--transition);
        box-shadow: var(--shadow-md);
        border: 1px solid var(--gray-200);
        display: flex;
        flex-direction: column;
        height: 100%;
        animation: fadeInUp 0.5s ease-out;
        animation-fill-mode: both;
    }

    .news-card:nth-child(1) { animation-delay: 0.05s; }
    .news-card:nth-child(2) { animation-delay: 0.1s; }
    .news-card:nth-child(3) { animation-delay: 0.15s; }
    .news-card:nth-child(4) { animation-delay: 0.2s; }
    .news-card:nth-child(5) { animation-delay: 0.25s; }

    .news-card:hover {
        transform: translateY(-6px);
        box-shadow: var(--shadow-xl);
        border-color: var(--gold);
    }

    .card-header {
        padding: 1rem 1.25rem 0.5rem 1.25rem;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .card-date {
        font-size: 0.7rem;
        color: var(--gray-500);
        display: flex;
        align-items: center;
        gap: 0.4rem;
        background: var(--gray-100);
        padding: 0.25rem 0.75rem;
        border-radius: 20px;
    }

    .card-date i {
        font-size: 0.65rem;
    }

    .reading-time {
        font-size: 0.7rem;
        color: var(--gray-400);
        display: flex;
        align-items: center;
        gap: 0.3rem;
    }

    .card-body {
        padding: 0.25rem 1.25rem 1rem;
        flex: 1;
    }

    .card-title {
        font-size: 1.1rem;
        font-weight: 700;
        color: var(--gray-800);
        margin-bottom: 0.75rem;
        line-height: 1.4;
        transition: var(--transition);
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }

    .news-card:hover .card-title {
        color: var(--primary);
    }

    .card-excerpt {
        font-size: 0.85rem;
        color: var(--gray-600);
        line-height: 1.5;
        display: -webkit-box;
        -webkit-line-clamp: 3;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }

    .card-footer {
        padding: 1rem 1.25rem;
        border-top: 1px solid var(--gray-200);
        display: flex;
        justify-content: space-between;
        align-items: center;
        background: var(--gray-50);
    }

    .read-link {
        color: var(--primary);
        font-size: 0.8rem;
        font-weight: 600;
        display: flex;
        align-items: center;
        gap: 0.5rem;
        transition: var(--transition);
    }

    .read-link i {
        font-size: 0.7rem;
        transition: transform 0.2s ease;
    }

    .news-card:hover .read-link i {
        transform: translateX(4px);
    }

    .card-category {
        font-size: 0.7rem;
        color: var(--gold-dark);
        font-weight: 600;
    }

    /* Empty States */
    .empty-state {
        text-align: center;
        padding: 3rem 2rem;
        background: white;
        border-radius: 20px;
        border: 2px dashed var(--gray-300);
        grid-column: 1 / -1;
        animation: fadeInUp 0.5s ease-out;
    }

    .empty-state i {
        font-size: 3.5rem;
        color: var(--gray-300);
        margin-bottom: 1rem;
    }

    .empty-state h3 {
        color: var(--gray-700);
        margin-bottom: 0.5rem;
        font-size: 1.2rem;
    }

    .empty-state p {
        color: var(--gray-500);
        font-size: 0.85rem;
    }

    .empty-search {
        text-align: center;
        padding: 3rem 2rem;
        background: white;
        border-radius: 20px;
        border: 2px dashed var(--gray-300);
        margin-top: 1rem;
        animation: fadeInUp 0.3s ease-out;
    }

    .empty-search i {
        font-size: 3rem;
        color: var(--gray-400);
        margin-bottom: 1rem;
    }

    .empty-search h3 {
        color: var(--gray-700);
        margin-bottom: 0.5rem;
    }

    .empty-search p {
        color: var(--gray-500);
    }

    /* Pagination */
    .pagination-wrapper {
        margin-top: 2.5rem;
        text-align: center;
        animation: fadeInUp 0.6s ease-out 0.2s both;
    }

    .pagination-info {
        margin-bottom: 1rem;
        font-size: 0.85rem;
        color: var(--gray-500);
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 0.5rem;
    }

    .pagination-info i {
        color: var(--gold);
    }

    .pagination-pages {
        display: flex;
        justify-content: center;
        gap: 0.5rem;
        flex-wrap: wrap;
    }

    .page-item {
        padding: 0.6rem 1rem;
        min-width: 42px;
        border: 2px solid var(--gray-200);
        background: white;
        color: var(--gray-700);
        text-decoration: none;
        border-radius: 12px;
        font-weight: 600;
        transition: var(--transition);
        display: inline-flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
    }

    .page-item:hover:not(.disabled):not(.active) {
        background: var(--gray-100);
        border-color: var(--gold);
        transform: translateY(-2px);
    }

    .page-item.active {
        background: linear-gradient(135deg, var(--primary) 0%, var(--primary-dark) 100%);
        border-color: var(--primary);
        color: white;
    }

    .page-item.disabled {
        opacity: 0.5;
        pointer-events: none;
        background: var(--gray-100);
    }

    /* Scroll to Top */
    .scroll-top {
        position: fixed;
        bottom: 2rem;
        right: 2rem;
        width: 44px;
        height: 44px;
        background: linear-gradient(135deg, var(--primary) 0%, var(--primary-dark) 100%);
        color: white;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        opacity: 0;
        visibility: hidden;
        transition: var(--transition);
        box-shadow: var(--shadow-lg);
        z-index: 100;
        border: none;
        font-size: 1.1rem;
    }

    .scroll-top.show {
        opacity: 1;
        visibility: visible;
    }

    .scroll-top:hover {
        transform: translateY(-4px);
        background: var(--gold);
    }

    /* Responsive */
    @media (max-width: 480px) {
        .news-card {
            border-radius: 16px;
        }
        .card-header, .card-body, .card-footer {
            padding-left: 1rem;
            padding-right: 1rem;
        }
        .stats-page {
            font-size: 0.75rem;
        }
        .page-item {
            padding: 0.5rem 0.85rem;
            min-width: 38px;
            font-size: 0.85rem;
        }
    }
</style>
@endsection

@section('content')
<div class="news-container">
    <!-- Hero Header -->
    <div class="news-hero">
        <div class="hero-content">
            <div class="hero-text">
                <h1>
                    <i class="fas fa-graduation-cap"></i> Berita Kampus
                </h1>
                <p>Informasi terbaru seputar kegiatan dan prestasi Universitas Kampus</p>
            </div>
            <div class="hero-badge">
                <i class="fas fa-layer-group"></i>
                <span>Maksimal 5 berita per halaman</span>
            </div>
        </div>
    </div>

    <!-- Search Section -->
    <div class="search-section">
        <div class="search-wrapper">
            <i class="fas fa-search"></i>
            <input type="text" id="search" placeholder="Cari berita berdasarkan judul atau konten...">
        </div>
    </div>

    <!-- Info Stats -->
    <div class="info-stats">
        <div class="stats-page">
            <i class="fas fa-chart-simple"></i>
            <span>Halaman {{ $news->currentPage() }}</span>
            <span>dari {{ $news->lastPage() }}</span>
        </div>
        <div class="stats-limit">
            <i class="fas fa-newspaper"></i> {{ $news->count() }} / 5 Berita
        </div>
    </div>

    <!-- News Grid -->
    <div id="newsGrid" class="news-grid">
        @forelse($news as $item)
            <a href="{{ route('public.news.show', $item) }}" class="news-card" 
               data-title="{{ strtolower($item->title) }}" 
               data-content="{{ strtolower(strip_tags($item->content)) }}">
                <div class="card-header">
                    <div class="card-date">
                        <i class="far fa-calendar-alt"></i>
                        <span>{{ $item->created_at->translatedFormat('d M Y') }}</span>
                    </div>
                    <div class="reading-time">
                        <i class="far fa-clock"></i>
                        <span>{{ ceil(str_word_count(strip_tags($item->content)) / 200) }} min</span>
                    </div>
                </div>
                <div class="card-body">
                    <h3 class="card-title">{{ Str::limit($item->title, 65) }}</h3>
                    <p class="card-excerpt">{{ Str::limit(strip_tags($item->content), 110) }}</p>
                </div>
                <div class="card-footer">
                    <span class="read-link">
                        Baca selengkapnya <i class="fas fa-arrow-right"></i>
                    </span>
                    @if($item->category)
                        <span class="card-category">
                            <i class="fas fa-tag"></i> {{ $item->category->name }}
                        </span>
                    @endif
                </div>
            </a>
        @empty
            <div class="empty-state">
                <i class="fas fa-newspaper"></i>
                <h3>Belum Ada Berita</h3>
                <p>Informasi terbaru akan segera hadir</p>
            </div>
        @endforelse
    </div>

    <!-- Empty Search State -->
    <div id="emptySearch" class="empty-search" style="display: none;">
        <i class="fas fa-search"></i>
        <h3>Tidak Ditemukan</h3>
        <p id="emptyMessage"></p>
    </div>

    <!-- Pagination -->
    @if($news->hasPages() && $news->count() > 0)
    <div class="pagination-wrapper">
        <div class="pagination-info">
            <i class="fas fa-chart-line"></i>
            <span>Menampilkan {{ $news->firstItem() }} - {{ $news->lastItem() }} dari {{ $news->total() }} berita</span>
        </div>
        <div class="pagination-pages">
            @if($news->onFirstPage())
                <span class="page-item disabled"><i class="fas fa-chevron-left"></i></span>
            @else
                <a href="{{ $news->previousPageUrl() }}" class="page-item"><i class="fas fa-chevron-left"></i></a>
            @endif

            @for($i = 1; $i <= min($news->lastPage(), 5); $i++)
                @if($i == $news->currentPage())
                    <span class="page-item active">{{ $i }}</span>
                @else
                    <a href="{{ $news->url($i) }}" class="page-item">{{ $i }}</a>
                @endif
            @endfor

            @if($news->lastPage() > 5)
                <span class="page-item disabled">...</span>
                <a href="{{ $news->url($news->lastPage()) }}" class="page-item">{{ $news->lastPage() }}</a>
            @endif

            @if($news->hasMorePages())
                <a href="{{ $news->nextPageUrl() }}" class="page-item"><i class="fas fa-chevron-right"></i></a>
            @else
                <span class="page-item disabled"><i class="fas fa-chevron-right"></i></span>
            @endif
        </div>
    </div>
    @endif
</div>

<!-- Scroll to Top Button -->
<div class="scroll-top" id="scrollTop">
    <i class="fas fa-arrow-up"></i>
</div>

<script>
    // Search functionality
    const searchInput = document.getElementById('search');
    const newsGrid = document.getElementById('newsGrid');
    const emptySearch = document.getElementById('emptySearch');
    const emptyMessage = document.getElementById('emptyMessage');
    const newsCards = document.querySelectorAll('.news-card');

    function performSearch() {
        const query = searchInput.value.toLowerCase().trim();
        let visibleCount = 0;

        newsCards.forEach(card => {
            const title = card.dataset.title || '';
            const content = card.dataset.content || '';
            const match = !query || title.includes(query) || content.includes(query);
            
            card.style.display = match ? 'flex' : 'none';
            if (match) visibleCount++;
        });

        if (query && visibleCount === 0) {
            emptyMessage.textContent = `Tidak ada berita dengan kata kunci "${query}"`;
            emptySearch.style.display = 'block';
            newsGrid.style.display = 'none';
        } else {
            emptySearch.style.display = 'none';
            newsGrid.style.display = 'grid';
        }

        if (!query) {
            emptySearch.style.display = 'none';
            newsGrid.style.display = 'grid';
        }
    }

    searchInput.addEventListener('input', performSearch);

    // Scroll to Top functionality
    const scrollTopBtn = document.getElementById('scrollTop');
    
    window.addEventListener('scroll', () => {
        if (window.pageYOffset > 300) {
            scrollTopBtn.classList.add('show');
        } else {
            scrollTopBtn.classList.remove('show');
        }
    });

    scrollTopBtn.addEventListener('click', () => {
        window.scrollTo({
            top: 0,
            behavior: 'smooth'
        });
    });

    // Add subtle animation on page load for cards
    document.addEventListener('DOMContentLoaded', () => {
        // Ensure all cards are visible with their animations
        const cards = document.querySelectorAll('.news-card');
        cards.forEach((card, index) => {
            card.style.animationDelay = `${index * 0.05}s`;
        });
    });
</script>
@endsection