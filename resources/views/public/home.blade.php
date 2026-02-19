@extends('layouts.public')

@section('title', 'Lembaga Pengendalian dan Penjaminan Mutu Internal')

@section('content')
<div class="lpm-container">
    
    <!-- VIDEO SECTION (LEBAR SAMA, TINGGI DIKURANGI) -->
    @if($featuredVideo)
    <section class="video-section">
        <div class="section-header">
            <h2>Video Profil</h2>
        </div>
        
        <div class="video-wrapper-reduced">
            @php
                $youtubeId = null;
                if ($featuredVideo->url) {
                    preg_match('%(?:youtube\.com/(?:.*v=|v/|embed/)|youtu\.be/)([^&\n?#]+)%', $featuredVideo->url, $matches);
                    $youtubeId = $matches[1] ?? null;
                }
            @endphp
            
            @if($youtubeId)
            <iframe
                src="https://www.youtube.com/embed/{{ $youtubeId }}?autoplay=1&mute=1&playsinline=1&rel=0&modestbranding=1"
                title="Video Profil LPM"
                frameborder="0"
                allow="autoplay; encrypted-media"
                allowfullscreen>
            </iframe>
            @elseif($featuredVideo->video_path)
            <video controls>
                <source src="{{ asset('storage/'.$featuredVideo->video_path) }}" type="video/mp4">
            </video>
            @endif
        </div>
    </section>
    @endif

    <!-- ================= BERITA SECTION ================= -->
    @if($news && count($news) > 0)
    <section class="news-section">
        <div class="section-header">
            <h2>Berita Terbaru</h2>
            <a href="{{ route('public.news.index') }}" class="view-all">Lihat Semua</a>
        </div>

        <div class="news-carousel">
            <button class="nav-btn prev" aria-label="Slide sebelumnya">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none">
                    <path d="M15 18L9 12L15 6" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                </svg>
            </button>

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
                                <span class="news-date">
                                    {{ $item->created_at->format('d M Y') }}
                                </span>

                                <h3>{{ Str::limit($item->title, 55) }}</h3>
                                <p>{{ Str::limit(strip_tags($item->content), 70) }}</p>

                                <a href="{{ route('public.news.show', $item) }}" class="read-more">
                                    Baca Selengkapnya
                                </a>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>

            <button class="nav-btn next" aria-label="Slide berikutnya">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none">
                    <path d="M9 6L15 12L9 18" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                </svg>
            </button>
        </div>
    </section>
    @endif

</div>

<style>
/* ===== BASE STYLES ===== */
.lpm-container {
    max-width: 1200px !important;
    margin: 0 auto !important;
    padding: 40px 20px !important;
    width: 100% !important;
}

.section-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 30px;
    padding-bottom: 15px;
    border-bottom: 2px solid #e5e7eb;
}

.section-header h2 {
    font-size: 28px;
    color: #003366;
    font-weight: 700;
    margin: 0;
}

.view-all {
    color: #2563eb;
    text-decoration: none;
    font-weight: 500;
    font-size: 15px;
}

.view-all:hover {
    text-decoration: underline;
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
    gap: 16px;
    transition: transform 0.4s ease;
    will-change: transform;
}

.news-slide {
    flex: 0 0 260px;
}

.news-card {
    background: white;
    border-radius: 12px;
    border: 1px solid #e5e7eb;
    overflow: hidden;
    height: 100%;
    transition: transform 0.3s, box-shadow 0.3s;
    max-width: 260px;
}

.news-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 12px 24px rgba(0, 0, 0, 0.1);
}

.news-image {
    width: 100%;
    height: 180px;
    overflow: hidden;
}

.news-image img {
    width: 100%;
    height: 140px;
    object-fit: cover;
    transition: transform 0.3s;
}

.news-card:hover .news-image img {
    transform: scale(1.05);
}

.news-content {
    padding: 10px;
}

.news-date {
    display: block;
    color: #6b7280;
    font-size: 11px;
    margin-bottom: 10px;
}

.news-content h3 {
    font-size: 14px;
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