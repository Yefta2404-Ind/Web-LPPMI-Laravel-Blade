@extends('layouts.public')

@section('title', 'Berita | Universitas Kampus')

@section('styles')
<style>
    /* Simple clean style with white background */
    :root {
        --primary: #2563eb;
        --primary-dark: #1d4ed8;
        --gray-900: #111827;
        --gray-700: #374151;
        --gray-500: #6b7280;
        --gray-300: #d1d5db;
        --gray-100: #f3f4f6;
        --white: #ffffff;
        --shadow: 0 1px 3px rgba(0,0,0,0.1);
        --shadow-md: 0 4px 6px -1px rgba(0,0,0,0.1);
        --radius: 8px;
    }

    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }

    body {
        background: var(--white);
        font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
        line-height: 1.5;
        color: var(--gray-900);
    }

    .news-page {
        background: var(--white);
        padding: 2rem 0;
    }

    .container {
        max-width: 1200px;
        margin: 0 auto;
        padding: 0 1.5rem;
    }

    /* Header simple */
    .news-header {
        text-align: center;
        margin-bottom: 3rem;
    }

    .news-header h1 {
        font-size: 2.5rem;
        font-weight: 700;
        color: var(--gray-900);
        margin-bottom: 0.5rem;
    }

    .news-header p {
        font-size: 1.1rem;
        color: var(--gray-500);
    }

    /* Featured News */
    .featured-news {
        display: grid;
        grid-template-columns: 1fr 1fr;
        background: var(--white);
        border: 1px solid var(--gray-300);
        border-radius: var(--radius);
        overflow: hidden;
        margin-bottom: 3rem;
    }

    .featured-image {
        height: 350px;
        overflow: hidden;
    }

    .featured-image img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .featured-content {
        padding: 2rem;
        display: flex;
        flex-direction: column;
        justify-content: center;
    }

    .featured-badge {
        display: inline-block;
        background: var(--primary);
        color: white;
        padding: 0.25rem 1rem;
        border-radius: 20px;
        font-size: 0.85rem;
        font-weight: 600;
        width: fit-content;
        margin-bottom: 1rem;
    }

    .featured-content h2 {
        font-size: 1.8rem;
        color: var(--gray-900);
        margin-bottom: 1rem;
        line-height: 1.3;
    }

    .featured-content p {
        color: var(--gray-700);
        margin-bottom: 1.5rem;
    }

    .featured-meta {
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .featured-meta span {
        color: var(--gray-500);
        font-size: 0.9rem;
    }

    .read-btn {
        display: inline-block;
        background: var(--primary);
        color: white;
        padding: 0.6rem 1.5rem;
        border-radius: 6px;
        text-decoration: none;
        font-weight: 500;
        font-size: 0.95rem;
        transition: background 0.2s;
    }

    .read-btn:hover {
        background: var(--primary-dark);
    }

    /* Controls */
    .news-controls {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 2rem;
        gap: 1rem;
        flex-wrap: wrap;
    }

    .search-box {
        flex: 1;
        min-width: 280px;
    }

    .search-box input {
        width: 100%;
        padding: 0.75rem 1rem;
        border: 1px solid var(--gray-300);
        border-radius: 6px;
        font-size: 1rem;
    }

    .search-box input:focus {
        outline: none;
        border-color: var(--primary);
    }

    .view-toggle {
        display: flex;
        gap: 0.5rem;
    }

    .view-btn {
        padding: 0.6rem 1.2rem;
        border: 1px solid var(--gray-300);
        background: var(--white);
        border-radius: 6px;
        cursor: pointer;
        font-size: 0.95rem;
        color: var(--gray-700);
    }

    .view-btn.active {
        background: var(--primary);
        color: white;
        border-color: var(--primary);
    }

    /* Grid View */
    .news-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
        gap: 2rem;
        margin-bottom: 3rem;
    }

    .news-card {
        background: var(--white);
        border: 1px solid var(--gray-300);
        border-radius: var(--radius);
        overflow: hidden;
        transition: box-shadow 0.2s;
    }

    .news-card:hover {
        box-shadow: var(--shadow-md);
    }

    .card-image {
        height: 200px;
        overflow: hidden;
    }

    .card-image img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .card-content {
        padding: 1.5rem;
    }

    .card-date {
        font-size: 0.85rem;
        color: var(--gray-500);
        margin-bottom: 0.5rem;
    }

    .card-content h3 {
        font-size: 1.2rem;
        color: var(--gray-900);
        margin-bottom: 0.75rem;
        line-height: 1.4;
    }

    .card-content p {
        color: var(--gray-700);
        font-size: 0.95rem;
        margin-bottom: 1rem;
    }

    .card-link {
        color: var(--primary);
        text-decoration: none;
        font-weight: 500;
        font-size: 0.95rem;
    }

    .card-link:hover {
        text-decoration: underline;
    }

    /* List View */
    .news-list {
        display: flex;
        flex-direction: column;
        gap: 1.5rem;
        margin-bottom: 3rem;
    }

    .list-item {
        display: grid;
        grid-template-columns: 250px 1fr;
        background: var(--white);
        border: 1px solid var(--gray-300);
        border-radius: var(--radius);
        overflow: hidden;
    }

    .list-image {
        height: 180px;
        overflow: hidden;
    }

    .list-image img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .list-content {
        padding: 1.5rem;
    }

    .list-meta {
        font-size: 0.85rem;
        color: var(--gray-500);
        margin-bottom: 0.5rem;
    }

    .list-content h3 {
        font-size: 1.3rem;
        color: var(--gray-900);
        margin-bottom: 0.75rem;
    }

    .list-content p {
        color: var(--gray-700);
        margin-bottom: 1rem;
    }

    .list-link {
        color: var(--primary);
        text-decoration: none;
        font-weight: 500;
    }

    .list-link:hover {
        text-decoration: underline;
    }

    /* Pagination */
    .news-pagination {
        display: flex;
        justify-content: center;
        align-items: center;
        gap: 1rem;
        margin: 3rem 0;
        flex-wrap: wrap;
    }

    .pagination-btn {
        padding: 0.6rem 1.2rem;
        background: var(--white);
        border: 1px solid var(--gray-300);
        border-radius: 6px;
        color: var(--gray-700);
        text-decoration: none;
        font-weight: 500;
    }

    .pagination-btn:hover {
        background: var(--gray-100);
    }

    .pagination-pages {
        display: flex;
        gap: 0.5rem;
    }

    .page-link,
    .page-current {
        padding: 0.5rem 1rem;
        border-radius: 6px;
        text-decoration: none;
    }

    .page-link {
        color: var(--gray-700);
        border: 1px solid var(--gray-300);
    }

    .page-link:hover {
        background: var(--gray-100);
    }

    .page-current {
        background: var(--primary);
        color: white;
    }

    /* Newsletter */
    .newsletter {
        background: var(--gray-100);
        border-radius: var(--radius);
        padding: 3rem 2rem;
        text-align: center;
        margin-top: 3rem;
    }

    .newsletter h3 {
        font-size: 1.8rem;
        color: var(--gray-900);
        margin-bottom: 0.5rem;
    }

    .newsletter p {
        color: var(--gray-700);
        margin-bottom: 2rem;
    }

    .newsletter-form {
        display: flex;
        max-width: 500px;
        margin: 0 auto;
        gap: 0.5rem;
    }

    .newsletter-form input {
        flex: 1;
        padding: 0.75rem 1rem;
        border: 1px solid var(--gray-300);
        border-radius: 6px;
        font-size: 1rem;
    }

    .newsletter-form input:focus {
        outline: none;
        border-color: var(--primary);
    }

    .newsletter-form button {
        padding: 0.75rem 2rem;
        background: var(--primary);
        color: white;
        border: none;
        border-radius: 6px;
        font-weight: 500;
        cursor: pointer;
    }

    .newsletter-form button:hover {
        background: var(--primary-dark);
    }

    /* Empty State */
    .empty-state {
        text-align: center;
        padding: 3rem;
        background: var(--white);
        border: 1px solid var(--gray-300);
        border-radius: var(--radius);
    }

    .empty-state-icon {
        font-size: 3rem;
        margin-bottom: 1rem;
        opacity: 0.5;
    }

    .empty-state h3 {
        color: var(--gray-900);
        margin-bottom: 0.5rem;
    }

    .empty-state p {
        color: var(--gray-500);
    }

    /* Form Feedback */
    .form-feedback {
        margin-top: 1rem;
        padding: 0.75rem;
        border-radius: 6px;
        font-size: 0.95rem;
    }

    .form-feedback.success {
        background: #d1fae5;
        color: #065f46;
    }

    .form-feedback.error {
        background: #fee2e2;
        color: #991b1b;
    }

    /* Utility */
    .loading {
        display: inline-block;
        width: 16px;
        height: 16px;
        border: 2px solid rgba(255,255,255,0.3);
        border-radius: 50%;
        border-top-color: white;
        animation: spin 0.8s linear infinite;
    }

    @keyframes spin {
        to { transform: rotate(360deg); }
    }

    /* Responsive */
    @media (max-width: 768px) {
        .container {
            padding: 0 1rem;
        }

        .news-header h1 {
            font-size: 2rem;
        }

        .featured-news {
            grid-template-columns: 1fr;
        }

        .featured-image {
            height: 250px;
        }

        .featured-content {
            padding: 1.5rem;
        }

        .featured-content h2 {
            font-size: 1.5rem;
        }

        .news-controls {
            flex-direction: column;
            align-items: stretch;
        }

        .view-toggle {
            justify-content: center;
        }

        .list-item {
            grid-template-columns: 1fr;
        }

        .list-image {
            height: 200px;
        }

        .newsletter-form {
            flex-direction: column;
        }

        .newsletter-form button {
            width: 100%;
        }

        .news-pagination {
            flex-direction: column;
        }
    }

    @media (max-width: 480px) {
        .news-header h1 {
            font-size: 1.75rem;
        }

        .featured-image {
            height: 200px;
        }

        .news-grid {
            grid-template-columns: 1fr;
        }

        .view-btn {
            padding: 0.5rem 1rem;
            font-size: 0.9rem;
        }
    }
</style>
@endsection

@section('content')
<div class="news-page">
    <div class="container">
        <!-- Header -->
        <div class="news-header">
            <h1>Berita Kampus</h1>
            <p>Informasi terkini seputar kegiatan dan perkembangan kampus</p>
        </div>

        <!-- Featured News -->
        @if($news->count() > 0)
        @php $featured = $news->first(); @endphp
        <div class="featured-news">
            <div class="featured-image">
                <img src="{{ asset('storage/'.$featured->image) }}" alt="{{ $featured->title }}">
            </div>
            <div class="featured-content">
                <span class="featured-badge">BERITA UTAMA</span>
                <h2>{{ $featured->title }}</h2>
                <p>{{ Str::limit(strip_tags($featured->content), 150) }}</p>
                <div class="featured-meta">
                    <span>{{ $featured->created_at->format('d F Y') }}</span>
                    <a href="{{ route('public.news.show', $featured) }}" class="read-btn">Baca Selengkapnya</a>
                </div>
            </div>
        </div>
        @endif

        <!-- Controls -->
        <div class="news-controls">
            <div class="search-box">
                <input type="text" id="searchInput" placeholder="Cari berita...">
            </div>
            <div class="view-toggle">
                <button class="view-btn active" data-view="grid">Grid</button>
                <button class="view-btn" data-view="list">List</button>
            </div>
        </div>

        <!-- Grid View -->
        <div class="news-grid-view active" id="gridView">
            <div class="news-grid">
                @foreach($news as $index => $item)
                    @if($loop->first && $news->count() > 0)
                        @continue
                    @endif
                    
                    <div class="news-card">
                        <div class="card-image">
                            <img src="{{ asset('storage/'.$item->image) }}" alt="{{ $item->title }}" loading="lazy">
                        </div>
                        <div class="card-content">
                            <div class="card-date">{{ $item->created_at->format('d F Y') }}</div>
                            <h3>{{ Str::limit($item->title, 70) }}</h3>
                            <p>{{ Str::limit(strip_tags($item->content), 100) }}</p>
                            <a href="{{ route('public.news.show', $item) }}" class="card-link">Baca selengkapnya →</a>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        <!-- List View -->
        <div class="news-list-view" id="listView" style="display: none;">
            <div class="news-list">
                @foreach($news as $index => $item)
                    @if($loop->first && $news->count() > 0)
                        @continue
                    @endif
                    
                    <div class="list-item">
                        <div class="list-image">
                            <img src="{{ asset('storage/'.$item->image) }}" alt="{{ $item->title }}" loading="lazy">
                        </div>
                        <div class="list-content">
                            <div class="list-meta">{{ $item->created_at->format('d F Y') }}</div>
                            <h3>{{ $item->title }}</h3>
                            <p>{{ Str::limit(strip_tags($item->content), 150) }}</p>
                            <a href="{{ route('public.news.show', $item) }}" class="list-link">Baca selengkapnya →</a>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        <!-- Empty State -->
        <div class="empty-state" id="emptyState" style="display: none;">
            <div class="empty-state-icon">🔍</div>
            <h3>Tidak ada berita ditemukan</h3>
            <p>Coba kata kunci pencarian yang lain</p>
        </div>

        <!-- Pagination -->
        @if($news->hasPages())
        <div class="news-pagination">
            @if (!$news->onFirstPage())
                <a href="{{ $news->previousPageUrl() }}" class="pagination-btn">← Sebelumnya</a>
            @endif
            
            <div class="pagination-pages">
                @php
                    $current = $news->currentPage();
                    $last = $news->lastPage();
                    $start = max($current - 2, 1);
                    $end = min($current + 2, $last);
                @endphp
                
                @for ($page = $start; $page <= $end; $page++)
                    @if ($page == $current)
                        <span class="page-current">{{ $page }}</span>
                    @else
                        <a href="{{ $news->url($page) }}" class="page-link">{{ $page }}</a>
                    @endif
                @endfor
            </div>
            
            @if ($news->hasMorePages())
                <a href="{{ $news->nextPageUrl() }}" class="pagination-btn">Selanjutnya →</a>
            @endif
        </div>
        @endif

    
    </div>
</div>
@endsection

@section('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // View Toggle
    const viewButtons = document.querySelectorAll('.view-btn');
    const gridView = document.getElementById('gridView');
    const listView = document.getElementById('listView');
    
    viewButtons.forEach(btn => {
        btn.addEventListener('click', function() {
            const view = this.dataset.view;
            
            viewButtons.forEach(b => b.classList.remove('active'));
            this.classList.add('active');
            
            if (view === 'grid') {
                gridView.style.display = 'block';
                listView.style.display = 'none';
            } else {
                gridView.style.display = 'none';
                listView.style.display = 'block';
            }
        });
    });

    // Search
    const searchInput = document.getElementById('searchInput');
    const emptyState = document.getElementById('emptyState');
    
    if (searchInput) {
        searchInput.addEventListener('input', function() {
            const searchTerm = this.value.toLowerCase().trim();
            
            // Grid cards
            const gridCards = document.querySelectorAll('#gridView .news-card');
            // List items
            const listItems = document.querySelectorAll('#listView .list-item');
            
            let visibleCount = 0;
            
            // Search in grid
            gridCards.forEach(card => {
                const title = card.querySelector('h3').textContent.toLowerCase();
                const text = card.querySelector('p').textContent.toLowerCase();
                
                if (title.includes(searchTerm) || text.includes(searchTerm)) {
                    card.style.display = '';
                    visibleCount++;
                } else {
                    card.style.display = 'none';
                }
            });
            
            // Search in list
            listItems.forEach(item => {
                const title = item.querySelector('h3').textContent.toLowerCase();
                const text = item.querySelector('p').textContent.toLowerCase();
                
                if (title.includes(searchTerm) || text.includes(searchTerm)) {
                    item.style.display = '';
                    visibleCount++;
                } else {
                    item.style.display = 'none';
                }
            });
            
            // Show empty state if no results
            if (searchTerm !== '' && visibleCount === 0) {
                emptyState.style.display = 'block';
                gridView.style.display = 'none';
                listView.style.display = 'none';
            } else {
                emptyState.style.display = 'none';
                // Restore current view
                const activeView = document.querySelector('.view-btn.active').dataset.view;
                if (activeView === 'grid') {
                    gridView.style.display = 'block';
                } else {
                    listView.style.display = 'block';
                }
            }
        });
    }

    // Newsletter Form
    const newsletterForm = document.getElementById('newsletterForm');
    if (newsletterForm) {
        newsletterForm.addEventListener('submit', function(e) {
            e.preventDefault();
            
            const email = document.getElementById('newsletterEmail').value;
            const button = document.getElementById('subscribeBtn');
            const feedback = document.getElementById('formFeedback');
            
            // Simple validation
            if (!email || !email.includes('@')) {
                feedback.textContent = 'Masukkan email yang valid';
                feedback.className = 'form-feedback error';
                feedback.style.display = 'block';
                return;
            }
            
            // Simulate loading
            const originalText = button.textContent;
            button.innerHTML = '<span class="loading"></span>';
            button.disabled = true;
            
            setTimeout(() => {
                button.textContent = originalText;
                button.disabled = false;
                
                feedback.textContent = 'Terima kasih! Anda telah berlangganan.';
                feedback.className = 'form-feedback success';
                feedback.style.display = 'block';
                
                newsletterForm.reset();
                
                setTimeout(() => {
                    feedback.style.display = 'none';
                }, 3000);
            }, 1000);
        });
    }
});
</script>
@endsection