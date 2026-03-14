@extends('layouts.public')

@section('title', 'Lembaga Pengendalian dan Penjaminan Mutu Internal')

@section('content')
<section class="news-section">
    <div class="lpm-container">
        @if(isset($news) && $news->count() > 0)
        <div class="agenda-header">
    <div class="agenda-header-left">
        <div class="section-label">Informasi</div>
        <h2 class="agenda-title">Berita Terbaru</h2>
        <p class="agenda-subtitle">Informasi dan berita terkini dari LPPMI Universitas Gunung Kidul</p>
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
                                <img src="{{ asset('storage/'.$item->image) }}" alt="{{ $item->title }}" loading="lazy">
                            </div>
                            @endif
                            <div class="news-content">
                                <span class="news-date">{{ $item->created_at->format('d M Y') }}</span>
                                <h3>{{ Str::limit($item->title, 55) }}</h3>
                                <p>{{ Str::limit(strip_tags($item->content), 70) }}</p>
                                <a href="{{ route('public.news.show', $item) }}" class="read-more">Baca Selengkapnya</a>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
<a href="{{ route('public.news.index') }}" class="view-all">Lihat Semua</a>
        </div>
        @endif
    </div>
</section>

<style>
/* ===== BASE STYLES ===== */
.lpm-container {
    max-width: 1800px;
    margin: 0 auto;
    padding: 0;
    width: 100%;
}

.news-viewport {
    overflow: hidden;
    max-width: 1600px;
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

section {
    margin-bottom: 80px;
}

/* ===== VIDEO SECTION (LEBAR SAMA, TINGGI DIKURANGI) ===== */
.video-wrapper-reduced {
    position: relative;
    width: 100%;
    margin: 0 auto;
    padding-bottom: 35%; /* DIKURANGI dari 56.25% (16:9) menjadi 35% */
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
    gap: 40px;
    transition: transform 0.4s ease;
    will-change: transform;
}

.news-slide {
    flex: 0 0 380px;
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
}

.news-card:hover {
    transform: translateY(-6px);
    box-shadow: 0 8px 20px rgba(0,0,0,0.1);
}

.news-image {
    width: 100%;
    height: 180px;
    overflow: hidden;
}

.news-image img {
    width: 100%;
    height: 220px;
    object-fit: cover;
    transition: transform 0.3s;
}

.news-card:hover .news-image img {
    transform: scale(1.05);
    transition: all 0.3s ease;
}

.news-content {
    padding: 18px;
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
        flex: 0 0 280px;
    }
}

@media (max-width: 768px) {
    .lpm-container {
        padding: 30px 15px;
    }
    
    .section-header {
        flex-direction: column;
        align-items: flex-start;
        gap: 10px;
    }
    
    .news-slide {
        flex: 0 0 85%;
    }
    
    .nav-btn {
        display: none;
    }
}

@media (max-width: 480px) {
    .section-header h2 {
        font-size: 24px;
    }
    
    .news-slide {
        flex: 0 0 90%;
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

        const gap = 16;
        const newsSlideWidth = newsSlides[0].offsetWidth + gap;

        // Clone untuk infinite scroll
        newsSlides.forEach(slide => {
            const clone = slide.cloneNode(true);
            clone.classList.add('clone');
            track.appendChild(clone);
        });

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