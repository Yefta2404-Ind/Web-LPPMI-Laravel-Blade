@extends('layouts.public')

@section('title', 'Lembaga Pengendalian dan Penjaminan Mutu Internal')

@section('content')
<section class="news-section">
    <div class="lpm-container">
        {{-- Empty State --}}
@if(!isset($news) || $news->count() == 0)
<div class="empty-state">
    <div class="empty-icon">
        <svg width="64" height="64" viewBox="0 0 24 24" fill="none">
            <path d="M20 12V18H4V12M20 12L12 5L4 12" stroke="currentColor" stroke-width="1.5"/>
        </svg>
    </div>
    <h3>Belum Ada Berita</h3>
    <p>Bulan ini belum tersedia informasi berita terbaru.</p>
</div>
@else

<div class="agenda-header">
    <div class="agenda-header-left">
        <div class="section-label">Informasi</div>
        <h2 class="agenda-title">Berita Terbaru</h2>
        <p class="agenda-subtitle">Informasi terbaru LPPMI</p>
    </div>
</div>

<div class="news-carousel">
    <div class="news-viewport">
        <div class="news-track">

            @foreach($news as $item)
            <div class="news-slide">
                <div class="news-card">

                    @if($item->image)
                    <div class="news-image">
                        <img src="{{ asset('storage/'.$item->image) }}" alt="{{ $item->title }}">
                    </div>
                    @endif

                    <div class="news-content">
                        <span class="news-date">
                            {{ \Carbon\Carbon::parse($item->created_at)->format('d M Y') }}
                        </span>

                        <h3>{{ \Illuminate\Support\Str::limit($item->title, 55) }}</h3>

                        <p>
                            {{ \Illuminate\Support\Str::limit(strip_tags($item->content), 70) }}
                        </p>

                        <a href="{{ route('public.news.show', $item->id) }}" class="read-more">
                            Baca Selengkapnya
                        </a>
                    </div>

                </div>
            </div>
            @endforeach

        </div>
    </div>

    <a href="{{ route('public.news.index') }}" class="view-all">
        Lihat Semua
    </a>
</div>

@endif
    </div>
</section>

<style>
/* ===== BASE STYLES ===== */
.lpm-container {
    max-width: 1800px;
    margin: 0 auto;
    padding: 0 24px;
    width: 100%;
}

/* ===== EMPTY STATE STYLES ===== */
.empty-state {
    text-align: center;
    padding: 60px 24px;
    background: #ffffff;
    border-radius: 24px;
    border: 1px solid #e5e7eb;
    box-shadow: 0 1px 2px rgba(0,0,0,0.05);
}

.empty-icon {
    width: 80px;
    height: 80px;
    margin: 0 auto 20px;
    background: #f3f4f6;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    color: #9ca3af;
}

.empty-state h3 {
    font-size: 20px;
    font-weight: 600;
    color: #374151;
    margin-bottom: 12px;
}

.empty-state p {
    font-size: 14px;
    color: #6b7280;
    line-height: 1.5;
}

.news-viewport {
    overflow: hidden;
    max-width: 1800px;
    margin: auto;
}

.section-header {
    display: flex;
    flex-direction: column;
    align-items: center;
    text-align: center;
    margin-bottom: 48px;
    border-bottom: none;
    padding-bottom: 0;
}

.section-header h2 {
    font-size: 2.2rem;
    color: var(--primary);
    font-weight: 700;
    margin: 0 0 8px 0;
    letter-spacing: 0.05em;
    text-transform: uppercase;
    font-family: var(--font-heading);
}

.section-header .section-subtitle {
    font-size: 0.95rem;
    color: var(--text-light);
    font-weight: 400;
    margin: 0;
}

.news-card h3{
    font-size: 22px;
    font-weight: 700;
    line-height: 1.4;
    margin-bottom: 10px;
    color: #111827;
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
    overflow: hidden;
}

.news-card p{
    font-size: 15px;
    line-height: 1.6;
    color: #374151;
}

.news-meta{
    font-size: 14px;
    color: #6b7280;
    margin-bottom: 8px;
}

.view-all {
    display: flex;
    margin: 40px auto 0;
    background: var(--primary);
    text-decoration: none;
    border: none;
    color: var(--white);
    font-size: 0.9rem;
    font-weight: 600;
    align-items: center;
    gap: 8px;
    cursor: pointer;
    padding: 14px 36px;
    border-radius: 40px;
    transition: all 0.2s;
    letter-spacing: 0.02em;
    width: fit-content;
}

.view-all-btn {
    display: flex;
    margin: 32px auto 0;
    background: var(--primary);
    border: none;
    color: var(--white);
    font-size: 0.9rem;
    font-weight: 600;
    align-items: center;
    gap: 8px;
    cursor: pointer;
    padding: 14px 36px;
    border-radius: 40px;
    transition: all 0.2s;
    letter-spacing: 0.02em;
}

.view-all:hover {
    background: var(--primary-light);
    color: var(--white);
    text-decoration: none;
    transform: translateY(-2px);
    box-shadow: var(--shadow-md);
}

/* ===== VIDEO SECTION (LEBAR SAMA, TINGGI DIKURANGI) ===== */
.video-wrapper-reduced {
    position: relative;
    width: 100%;
    margin: 0 auto;
    padding-bottom: 35%;
    height: 0;
    overflow: hidden;
    border-radius: 12px;
    background: #000;
    margin-top: 20px;
    box-shadow: 0 10px 30px rgba(0,0,0,0.1);
}

.video-wrapper-reduced iframe,
.video-wrapper-reduced video {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    border: none;
    border-radius: 12px;
}

/* ===== NEWS CAROUSEL ===== */
.news-carousel {
    position: relative;
    margin-top: 20px;
}

.news-viewport {
    overflow: hidden;
    padding: 10px 0;
}

.news-track {
    display: flex;
    gap: 24px;
    transition: transform 0.4s ease;
    will-change: transform;
    align-items: stretch;
}

.news-slide {
    flex: 0 0 380px;
    display: flex;
    align-items: stretch;
}

.news-card {
    background: white;
    border-radius: 12px;
    border: 1px solid #e5e7eb;
    overflow: hidden;
    height: 100%;
    box-shadow: 0 8px 20px rgba(0,0,0,0.05);
    transition: transform 0.3s, box-shadow 0.3s;
    max-width: 100%;
    flex-direction: column;
    display: flex;
}

.news-card:hover {
    transform: translateY(-6px);
    box-shadow: 0 8px 20px rgba(0,0,0,0.1);
}

.news-image {
    width: 100%;
    height: 200px;
    overflow: hidden;
}

.news-image img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform 0.3s;
}

.news-card:hover .news-image img {
    transform: scale(1.05);
    transition: all 0.3s ease;
}

.news-content {
    padding: 18px;
    display: flex;
    flex-direction: column;
    flex: 1;
}

.news-content h3 {
    font-size: 16px;
}

.news-section {
    width: 100%;
    background: #faf8f4;
    padding: 60px 0;
    border-top: 1px solid #ede8df;
    border-bottom: 1px solid #ede8df;
}

.news-content p {
    font-size: 13px;
}

.news-date {
    display: block;
    color: #6b7280;
    font-size: 11px;
    margin-bottom: 10px;
}

.news-content h3 {
    font-size: 18px;
    color: #111827;
    margin-bottom: 12px;
    line-height: 1.3;
    font-weight: 600;
    margin: 6px 0;
}

.news-content p {
    color: #6b7280;
    font-size: 12px;
    line-height: 1.4;
    margin-bottom: 8px;
}

.read-more {
    color: #2563eb;
    text-decoration: none;
    font-weight: 500;
    font-size: 12px;
    display: inline-flex;
    align-items: center;
    gap: 5px;
    margin-top: auto;
}

.read-more:hover {
    text-decoration: underline;
}

.nav-btn {
    position: absolute;
    top: 50%;
    transform: translateY(-50%);
    width: 48px;
    height: 48px;
    border-radius: 50%;
    border: none;
    background: white;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
    cursor: pointer;
    display: flex;
    align-items: center;
    justify-content: center;
    color: #003366;
    z-index: 10;
    transition: all 0.3s;
}

.nav-btn:hover {
    background: #003366;
    color: white;
}

.nav-btn.prev {
    left: -24px;
}

.nav-btn.next {
    right: -24px;
}

/* ===== RESPONSIVE ===== */
@media (max-width: 1024px) {
    .news-slide {
        flex: 0 0 320px;
    }
    
    .news-track {
        gap: 20px;
    }
    
    .lpm-container {
        padding: 0 20px;
    }
}

@media (max-width: 768px) {
    .news-section {
        padding: 40px 0;
    }
    
    .lpm-container {
        padding: 0 16px;
    }
    
    .section-header {
        flex-direction: column;
        align-items: center;   
        text-align: center;    
        gap: 10px;
    }
    
    .agenda-header {
        flex-direction: column;
        justify-content: center;  /* override space-between */
        align-items: center;
        text-align: center;
        margin-bottom: 24px;
    }
    
        .agenda-header-left {
        width: 100%;
    }

    .section-label,
    .agenda-title,
    .agenda-subtitle {
        text-align: center;
    }

    .agenda-title {
        font-size: 24px !important;
    }
    
    .agenda-subtitle {
        font-size: 13px !important;
    }
    
    .news-slide {
        flex: 0 0 85%;
    }
    
    .news-track {
        gap: 16px;
    }
    
    .nav-btn {
        display: none;
    }
    
    .empty-state {
        padding: 40px 20px;
    }
    
    .empty-icon {
        width: 64px;
        height: 64px;
    }
    
    .empty-icon svg {
        width: 48px;
        height: 48px;
    }
    
    .empty-state h3 {
        font-size: 18px;
    }
    
    .empty-state p {
        font-size: 13px;
    }
    
    .view-all {
        padding: 12px 28px;
        font-size: 14px;
        margin-top: 32px;
    }
}

@media (max-width: 480px) {
    .section-header h2 {
        font-size: 24px;
    }
    
    .news-slide {
        flex: 0 0 92%;
    }
    
    .lpm-container {
        padding: 0 12px;
    }
    
    .news-section {
        padding: 32px 0;
    }
    
    .news-card h3 {
        font-size: 16px !important;
    }
    
    .news-image {
        height: 160px;
    }
    
    .news-content {
        padding: 14px;
    }
    
    .empty-state {
        padding: 32px 16px;
    }
    
    .empty-icon {
        width: 56px;
        height: 56px;
        margin-bottom: 16px;
    }
    
    .empty-icon svg {
        width: 40px;
        height: 40px;
    }
    
    .view-all {
        padding: 10px 24px;
        font-size: 13px;
        margin-top: 28px;
    }
}

/* Responsive untuk video yang dikurangi tinggi */
@media (max-width: 1024px) {
    .video-wrapper-reduced {
        padding-bottom: 40%;
    }
}

@media (max-width: 768px) {
    .video-wrapper-reduced {
        padding-bottom: 45%;
    }
}

@media (max-width: 480px) {
    .video-wrapper-reduced {
        padding-bottom: 50%;
    }
}

/* Agenda Header Styles */
.agenda-header {
    display: flex;
    justify-content: space-between;
    align-items: flex-end;
    margin-bottom: 32px;
    flex-wrap: wrap;
    gap: 16px;
}

.agenda-header-left {
    flex: 1;
}

.section-label {
    font-size: 13px;
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: 1px;
    color: #2563eb;
    margin-bottom: 8px;
}

.agenda-title {
    font-size: 28px;
    font-weight: 700;
    color: #111827;
    margin: 0 0 8px 0;
}

.agenda-subtitle {
    font-size: 14px;
    color: #6b7280;
    margin: 0;
}

@media (max-width: 768px) {
    .agenda-title {
        font-size: 22px;
    }
    
    .agenda-subtitle {
        font-size: 12px;
    }
}
</style>

<script>
document.addEventListener('DOMContentLoaded', () => {
    // ===== NEWS CAROUSEL =====
    const newsCarousel = document.querySelector('.news-carousel');
    if (newsCarousel) {
        const track = newsCarousel.querySelector('.news-track');
        let newsSlides = Array.from(track.children);

        const gap = 24;
        const newsSlideWidth = newsSlides[0].offsetWidth + gap;


        newsSlides = Array.from(track.children);

        let newsPosition = 0;
        let isNewsPaused = false;
        const newsSpeed = 0.4;

        function animateNews() {
            if (!isNewsPaused) {
                newsPosition += newsSpeed;

                if (newsPosition >= newsSlideWidth * (newsSlides.length / 2)) {
                    newsPosition = 0;
                }

                track.style.transform = `translateX(-${newsPosition}px)`;
            }
            requestAnimationFrame(animateNews);
        }

        animateNews();

        // Pause on hover
        newsCarousel.addEventListener('mouseenter', () => isNewsPaused = true);
        newsCarousel.addEventListener('mouseleave', () => isNewsPaused = false);
    }
});
</script>
@endsection