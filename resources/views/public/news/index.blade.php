@extends('layouts.public')

@section('title', 'Berita | Universitas Kampus')

@section('content')
<div class="news-page">
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
            <p>{{ Str::limit(strip_tags($featured->content), 120) }}</p>
            <div class="featured-meta">
                <span>{{ $featured->created_at->format('d M Y') }}</span>
                <a href="{{ route('public.news.show', $featured) }}" class="read-btn">Baca →</a>
            </div>
        </div>
    </div>
    @endif

    <!-- Search & Filter -->
    <div class="news-controls">
        <div class="search-box">
            <input type="text" placeholder="Cari berita...">
        </div>
        <div class="view-toggle">
            <button class="view-btn active" data-view="grid">Grid</button>
            <button class="view-btn" data-view="list">List</button>
        </div>
    </div>

    <!-- News Grid -->
    <div class="news-grid-view active" id="gridView">
        <div class="news-grid">
            @foreach($news as $index => $item)
                @if($loop->first && $news->count() > 0)
                    @continue
                @endif
                
                <div class="news-card">
                    <div class="card-image">
                        <img src="{{ asset('storage/'.$item->image) }}" alt="{{ $item->title }}">
                    </div>
                    <div class="card-content">
                        <div class="card-date">{{ $item->created_at->format('d M Y') }}</div>
                        <h3>{{ Str::limit($item->title, 60) }}</h3>
                        <p>{{ Str::limit(strip_tags($item->content), 80) }}</p>
                        <a href="{{ route('public.news.show', $item) }}" class="card-link">Baca selengkapnya</a>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <!-- News List -->
    <div class="news-list-view" id="listView">
        <div class="news-list">
            @foreach($news as $index => $item)
                @if($loop->first && $news->count() > 0)
                    @continue
                @endif
                
                <div class="list-item">
                    <div class="list-image">
                        <img src="{{ asset('storage/'.$item->image) }}" alt="{{ $item->title }}">
                    </div>
                    <div class="list-content">
                        <div class="list-meta">
                            <span>{{ $item->created_at->format('d M Y') }}</span>
                        </div>
                        <h3>{{ $item->title }}</h3>
                        <p>{{ Str::limit(strip_tags($item->content), 100) }}</p>
                        <a href="{{ route('public.news.show', $item) }}" class="list-link">Baca →</a>
                    </div>
                </div>
            @endforeach
        </div>
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
                $start = max($current - 1, 1);
                $end = min($current + 1, $last);
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

    <!-- Newsletter -->
    <div class="newsletter">
        <h3>Berlangganan Newsletter</h3>
        <p>Dapatkan berita terbaru via email</p>
        <form class="newsletter-form">
            <input type="email" placeholder="Email Anda" required>
            <button type="submit">Berlangganan</button>
        </form>
    </div>
</div>

<style>
/* Reset untuk halaman ini saja */
.news-page {
    background: white;
    padding: 2rem 1rem;
    font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif;
    max-width: 1200px;
    margin: 0 auto;
}

/* Header */
.news-header {
    text-align: center;
    margin-bottom: 3rem;
}

.news-header h1 {
    font-size: 2.5rem;
    color: #2d3748;
    margin-bottom: 0.5rem;
}

.news-header p {
    color: #718096;
    font-size: 1.1rem;
}

/* Featured News */
.featured-news {
    display: flex;
    flex-direction: column;
    background: white;
    border-radius: 12px;
    overflow: hidden;
    box-shadow: 0 2px 8px rgba(0,0,0,0.1);
    margin-bottom: 3rem;
}

.featured-image {
    height: 300px;
    overflow: hidden;
}

.featured-image img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

.featured-content {
    padding: 2rem;
}

.featured-badge {
    display: inline-block;
    background: #4299e1;
    color: white;
    padding: 0.25rem 1rem;
    border-radius: 4px;
    font-size: 0.9rem;
    font-weight: 600;
    margin-bottom: 1rem;
}

.featured-content h2 {
    font-size: 1.8rem;
    color: #2d3748;
    margin-bottom: 1rem;
    line-height: 1.3;
}

.featured-content p {
    color: #718096;
    line-height: 1.6;
    margin-bottom: 1.5rem;
}

.featured-meta {
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.featured-meta span {
    color: #a0aec0;
    font-size: 0.9rem;
}

.read-btn {
    color: #4299e1;
    text-decoration: none;
    font-weight: 600;
}

.read-btn:hover {
    text-decoration: underline;
}

/* Controls */
.news-controls {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 2rem;
    gap: 1rem;
}

.search-box {
    flex: 1;
    max-width: 400px;
}

.search-box input {
    width: 100%;
    padding: 0.75rem 1rem;
    border: 1px solid #e2e8f0;
    border-radius: 8px;
    font-size: 1rem;
}

.search-box input:focus {
    outline: none;
    border-color: #4299e1;
}

.view-toggle {
    display: flex;
    background: #f7fafc;
    border-radius: 8px;
    padding: 4px;
}

.view-btn {
    padding: 0.5rem 1rem;
    border: none;
    background: none;
    cursor: pointer;
    font-size: 0.9rem;
    color: #718096;
    border-radius: 6px;
}

.view-btn.active {
    background: white;
    color: #4299e1;
    font-weight: 600;
    box-shadow: 0 1px 3px rgba(0,0,0,0.1);
}

/* Grid View */
.news-grid-view.active,
.news-list-view.active {
    display: block;
}

.news-grid-view:not(.active),
.news-list-view:not(.active) {
    display: none;
}

.news-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
    gap: 2rem;
    margin-bottom: 3rem;
}

.news-card {
    background: white;
    border: 1px solid #e2e8f0;
    border-radius: 12px;
    overflow: hidden;
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}

.news-card:hover {
    transform: translateY(-4px);
    box-shadow: 0 8px 25px rgba(0,0,0,0.1);
}

.card-image {
    height: 200px;
    overflow: hidden;
}

.card-image img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform 0.5s ease;
}

.news-card:hover .card-image img {
    transform: scale(1.05);
}

.card-content {
    padding: 1.5rem;
}

.card-date {
    color: #a0aec0;
    font-size: 0.9rem;
    margin-bottom: 0.5rem;
}

.card-content h3 {
    font-size: 1.2rem;
    color: #2d3748;
    margin-bottom: 0.75rem;
    line-height: 1.4;
}

.card-content p {
    color: #718096;
    font-size: 0.95rem;
    line-height: 1.5;
    margin-bottom: 1rem;
}

.card-link {
    color: #4299e1;
    text-decoration: none;
    font-weight: 600;
    font-size: 0.9rem;
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
    display: flex;
    background: white;
    border: 1px solid #e2e8f0;
    border-radius: 12px;
    overflow: hidden;
    transition: box-shadow 0.3s ease;
}

.list-item:hover {
    box-shadow: 0 4px 12px rgba(0,0,0,0.1);
}

.list-image {
    width: 200px;
    min-height: 150px;
    overflow: hidden;
}

.list-image img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

.list-content {
    flex: 1;
    padding: 1.5rem;
}

.list-meta {
    color: #a0aec0;
    font-size: 0.9rem;
    margin-bottom: 0.5rem;
}

.list-content h3 {
    font-size: 1.3rem;
    color: #2d3748;
    margin-bottom: 0.75rem;
    line-height: 1.4;
}

.list-content p {
    color: #718096;
    line-height: 1.5;
    margin-bottom: 1rem;
}

.list-link {
    color: #4299e1;
    text-decoration: none;
    font-weight: 600;
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
}

.pagination-btn {
    padding: 0.75rem 1.5rem;
    background: #4299e1;
    color: white;
    border: none;
    border-radius: 8px;
    text-decoration: none;
    font-weight: 600;
    cursor: pointer;
    transition: background 0.3s ease;
}

.pagination-btn:hover {
    background: #3182ce;
}

.pagination-pages {
    display: flex;
    gap: 0.5rem;
}

.page-link,
.page-current {
    padding: 0.5rem 1rem;
    border-radius: 6px;
    font-weight: 600;
}

.page-link {
    color: #4299e1;
    text-decoration: none;
    border: 1px solid #e2e8f0;
}

.page-link:hover {
    background: #f7fafc;
}

.page-current {
    background: #4299e1;
    color: white;
}

/* Newsletter */
.newsletter {
    background: #4299e1;
    border-radius: 12px;
    padding: 2rem;
    text-align: center;
    color: white;
    margin-top: 3rem;
}

.newsletter h3 {
    font-size: 1.5rem;
    margin-bottom: 0.5rem;
}

.newsletter p {
    opacity: 0.9;
    margin-bottom: 1.5rem;
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
    border: none;
    border-radius: 6px;
    font-size: 1rem;
}

.newsletter-form button {
    padding: 0.75rem 2rem;
    background: white;
    color: #4299e1;
    border: none;
    border-radius: 6px;
    font-weight: 600;
    cursor: pointer;
    transition: transform 0.3s ease;
}

.newsletter-form button:hover {
    transform: translateY(-2px);
}

/* Responsive */
@media (max-width: 768px) {
    .featured-news {
        flex-direction: column;
    }
    
    .featured-image {
        height: 250px;
    }
    
    .news-controls {
        flex-direction: column;
        align-items: stretch;
    }
    
    .search-box {
        max-width: 100%;
    }
    
    .list-item {
        flex-direction: column;
    }
    
    .list-image {
        width: 100%;
        height: 200px;
    }
    
    .news-pagination {
        flex-direction: column;
    }
    
    .newsletter-form {
        flex-direction: column;
    }
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // View Toggle
    const viewButtons = document.querySelectorAll('.view-btn');
    const gridView = document.getElementById('gridView');
    const listView = document.getElementById('listView');
    
    viewButtons.forEach(btn => {
        btn.addEventListener('click', function() {
            const view = this.dataset.view;
            
            // Update buttons
            viewButtons.forEach(b => b.classList.remove('active'));
            this.classList.add('active');
            
            // Show selected view
            if (view === 'grid') {
                gridView.classList.add('active');
                listView.classList.remove('active');
            } else {
                gridView.classList.remove('active');
                listView.classList.add('active');
            }
        });
    });
    
    // Search Function
    const searchInput = document.querySelector('.search-box input');
    if (searchInput) {
        searchInput.addEventListener('input', function() {
            const searchTerm = this.value.toLowerCase();
            const cards = document.querySelectorAll('.news-card, .list-item');
            
            cards.forEach(card => {
                const title = card.querySelector('h3').textContent.toLowerCase();
                const text = card.querySelector('p').textContent.toLowerCase();
                
                if (title.includes(searchTerm) || text.includes(searchTerm)) {
                    card.style.display = '';
                } else {
                    card.style.display = 'none';
                }
            });
        });
    }
    
    // Newsletter Form
    const newsletterForm = document.querySelector('.newsletter-form');
    if (newsletterForm) {
        newsletterForm.addEventListener('submit', function(e) {
            e.preventDefault();
            const email = this.querySelector('input[type="email"]').value;
            
            if (!email) return;
            
            const button = this.querySelector('button');
            const originalText = button.textContent;
            
            // Simulate submission
            button.textContent = 'Mengirim...';
            button.disabled = true;
            
            setTimeout(() => {
                button.textContent = 'Berhasil!';
                button.style.background = '#48bb78';
                
                setTimeout(() => {
                    button.textContent = originalText;
                    button.style.background = '';
                    button.disabled = false;
                    this.reset();
                }, 2000);
            }, 1000);
        });
    }
    
    // Simple hover animations
    const cards = document.querySelectorAll('.news-card, .list-item');
    cards.forEach((card, index) => {
        card.style.animationDelay = `${index * 0.05}s`;
    });
});
</script>
@endsection