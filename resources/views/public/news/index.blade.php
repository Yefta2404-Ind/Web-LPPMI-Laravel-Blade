@extends('layouts.public')

@section('title', 'Berita | Universitas Kampus')

@section('styles')
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">
<style>
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }

    body {
        font-family: 'Poppins', sans-serif;
        background: #ffffff;
        color: #1e293b;
    }

    .container {
        max-width: 800px;
        margin: 0 auto;
        padding: 2rem 1.5rem;
    }

    /* Header */
    .header {
        margin-bottom: 2rem;
        padding-bottom: 1rem;
        border-bottom: 3px solid #0a2463;
        display: flex;
        justify-content: space-between;
        align-items: flex-end;
    }

    .header h1 {
        font-size: 1.8rem;
        font-weight: 600;
        color: #0a2463;
    }

    .header .badge {
        background: #0a2463;
        color: white;
        padding: 0.3rem 1rem;
        font-size: 0.8rem;
        font-weight: 500;
    }

    /* Search */
    .search {
        margin-bottom: 1.5rem;
    }

    .search input {
        width: 100%;
        padding: 0.8rem 1rem;
        border: 2px solid #e2e8f0;
        font-family: 'Poppins', sans-serif;
        font-size: 0.9rem;
    }

    .search input:focus {
        outline: none;
        border-color: #0a2463;
    }

    /* Info Bar */
    .info {
        background: #eef2ff;
        padding: 0.75rem 1rem;
        margin-bottom: 1.5rem;
        border-left: 4px solid #0a2463;
        display: flex;
        justify-content: space-between;
        align-items: center;
        font-size: 0.85rem;
    }

    .info .page {
        color: #0a2463;
        font-weight: 600;
    }

    .info .limit {
        background: #0a2463;
        color: white;
        padding: 0.2rem 0.8rem;
    }

    /* List */
    .list {
        display: flex;
        flex-direction: column;
        gap: 1rem;
        min-height: 400px;
    }

    .card {
        display: block;
        border: 2px solid #e2e8f0;
        padding: 1.25rem;
        text-decoration: none;
        color: inherit;
        transition: all 0.2s;
    }

    .card:hover {
        border-color: #0a2463;
        background: #fafcff;
    }

    .date {
        font-size: 0.7rem;
        color: #64748b;
        margin-bottom: 0.5rem;
        display: inline-block;
        background: #f1f5f9;
        padding: 0.2rem 0.8rem;
        border: 1px solid #e2e8f0;
    }

    .title {
        font-size: 1.1rem;
        font-weight: 600;
        color: #0a2463;
        margin-bottom: 0.5rem;
        line-height: 1.4;
    }

    .excerpt {
        font-size: 0.85rem;
        color: #475569;
        margin-bottom: 1rem;
    }

    .footer {
        display: flex;
        justify-content: space-between;
        align-items: center;
        border-top: 1px solid #e2e8f0;
        padding-top: 0.75rem;
        font-size: 0.8rem;
    }

    .read {
        color: #0a2463;
        font-weight: 500;
    }

    .time {
        color: #94a3b8;
    }

    /* Empty */
    .empty {
        text-align: center;
        padding: 3rem;
        border: 2px dashed #cbd5e1;
        background: #f8fafc;
    }

    .empty h3 {
        color: #0a2463;
        margin-bottom: 0.5rem;
    }

    .empty p {
        color: #64748b;
    }

    /* Pagination - Simple */
    .pagination {
        margin-top: 2.5rem;
        text-align: center;
    }

    .pagination-info {
        margin-bottom: 1rem;
        font-size: 0.85rem;
        color: #64748b;
    }

    .pages {
        display: flex;
        justify-content: center;
        gap: 0.25rem;
        flex-wrap: wrap;
    }

    .page {
        padding: 0.5rem 1rem;
        border: 2px solid #e2e8f0;
        background: white;
        color: #0a2463;
        text-decoration: none;
        min-width: 40px;
        text-align: center;
        font-weight: 500;
    }

    .page:hover {
        background: #eef2ff;
        border-color: #0a2463;
    }

    .page.active {
        background: #0a2463;
        color: white;
        border-color: #0a2463;
    }

    .page.disabled {
        opacity: 0.5;
        pointer-events: none;
        background: #f1f5f9;
    }

    /* Responsive */
    @media (max-width: 480px) {
        .container {
            padding: 1rem;
        }
        
        .header {
            flex-direction: column;
            align-items: flex-start;
            gap: 0.5rem;
        }
        
        .card {
            padding: 1rem;
        }
    }
</style>
@endsection

@section('content')
<div class="container">
    <!-- Header dengan limit info -->
    <div class="header">
        <h1>Berita Kampus</h1>
        <div class="badge">Maksimal 5 per halaman</div>
    </div>

    <!-- Search -->
    <div class="search">
        <input type="text" id="search" placeholder="Cari berita...">
    </div>

    <!-- Info Bar - Menampilkan jumlah -->
    <div class="info">
        <span class="page">Halaman {{ $news->currentPage() }} dari {{ $news->lastPage() }}</span>
        <span class="limit">{{ $news->count() }} / 5 Berita</span>
    </div>

    <!-- News List - Hanya 5 per halaman -->
    <div id="list" class="list">
        @forelse($news as $item)
            <a href="{{ route('public.news.show', $item) }}" class="card" 
               data-title="{{ strtolower($item->title) }}" 
               data-content="{{ strtolower(strip_tags($item->content)) }}">
                <div class="date">{{ $item->created_at->translatedFormat('d M Y') }}</div>
                <div class="title">{{ Str::limit($item->title, 70) }}</div>
                <div class="excerpt">{{ Str::limit(strip_tags($item->content), 100) }}</div>
                <div class="footer">
                    <span class="read">Baca selengkapnya →</span>
                    <span class="time">{{ ceil(str_word_count(strip_tags($item->content)) / 200) }} min</span>
                </div>
            </a>
        @empty
            <div class="empty">
                <h3>Belum Ada Berita</h3>
                <p>Informasi terbaru akan segera hadir</p>
            </div>
        @endforelse
    </div>

    <!-- Empty Search State -->
    <div id="emptySearch" class="empty" style="display: none;">
        <h3>Tidak Ditemukan</h3>
        <p id="emptyMessage"></p>
    </div>

    <!-- Pagination - Dengan info jumlah -->
    @if($news->hasPages() && $news->count() > 0)
    <div class="pagination">
        <div class="pagination-info">
            Menampilkan {{ $news->firstItem() }} - {{ $news->lastItem() }} dari {{ $news->total() }} berita
        </div>
        <div class="pages">
            @if($news->onFirstPage())
                <span class="page disabled">←</span>
            @else
                <a href="{{ $news->previousPageUrl() }}" class="page">←</a>
            @endif

            @for($i = 1; $i <= $news->lastPage(); $i++)
                @if($i == $news->currentPage())
                    <span class="page active">{{ $i }}</span>
                @else
                    <a href="{{ $news->url($i) }}" class="page">{{ $i }}</a>
                @endif
            @endfor

            @if($news->hasMorePages())
                <a href="{{ $news->nextPageUrl() }}" class="page">→</a>
            @else
                <span class="page disabled">→</span>
            @endif
        </div>
    </div>
    @endif
</div>

<script>
    const searchInput = document.getElementById('search');
    const newsList = document.getElementById('list');
    const emptySearch = document.getElementById('emptySearch');
    const emptyMessage = document.getElementById('emptyMessage');
    const newsItems = document.querySelectorAll('.card');

    searchInput.addEventListener('input', function() {
        const query = this.value.toLowerCase().trim();
        let visibleCount = 0;

        newsItems.forEach(item => {
            const title = item.dataset.title || '';
            const content = item.dataset.content || '';
            const match = !query || title.includes(query) || content.includes(query);
            
            item.style.display = match ? 'block' : 'none';
            if (match) visibleCount++;
        });

        if (query && visibleCount === 0) {
            emptyMessage.textContent = `Tidak ada berita dengan kata kunci "${query}"`;
            emptySearch.style.display = 'block';
            newsList.style.display = 'none';
        } else {
            emptySearch.style.display = 'none';
            newsList.style.display = 'flex';
        }

        if (!query) {
            emptySearch.style.display = 'none';
            newsList.style.display = 'flex';
        }
    });
</script>
@endsection