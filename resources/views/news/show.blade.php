<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $news->title }} - LPM Universitas Kampus</title>
    <style>
        /* RESET & BASE */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: 'Segoe UI', 'Helvetica Neue', Arial, sans-serif;
            line-height: 1.6;
            color: #333;
            background: #f8f9fa;
        }
        
        a {
            color: #0f2a44;
            text-decoration: none;
        }
        
        a:hover {
            text-decoration: underline;
        }
        
        /* HEADER */
        .site-header {
            background: #0f2a44;
            padding: 15px 0;
            border-bottom: 3px solid #1a4a6e;
        }
        
        .header-container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        
        .logo {
            color: white;
            font-size: 20px;
            font-weight: bold;
        }
        
        .logo small {
            font-size: 12px;
            opacity: 0.8;
            font-weight: normal;
        }
        
        .nav-links {
            display: flex;
            gap: 20px;
        }
        
        .nav-links a {
            color: white;
            font-weight: 500;
        }
        
        /* BREADCRUMB */
        .breadcrumb {
            background: #f1f5f9;
            padding: 12px 0;
            border-bottom: 1px solid #e2e8f0;
        }
        
        .breadcrumb-container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 20px;
        }
        
        .breadcrumb a {
            color: #64748b;
        }
        
        .breadcrumb span {
            color: #0f2a44;
            font-weight: 500;
        }
        
        /* MAIN CONTENT */
        .main-container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 40px 20px;
        }
        
        .article-container {
            display: flex;
            gap: 40px;
        }
        
        /* ARTICLE CONTENT */
        .article-content {
            flex: 1;
            min-width: 0;
        }
        
        .article-header {
            margin-bottom: 30px;
        }
        
        .article-title {
            font-size: 32px;
            color: #0f2a44;
            margin-bottom: 15px;
            line-height: 1.3;
        }
        
        .article-meta {
            display: flex;
            align-items: center;
            gap: 20px;
            color: #64748b;
            font-size: 14px;
            margin-bottom: 20px;
            padding-bottom: 15px;
            border-bottom: 1px solid #e2e8f0;
        }
        
        .meta-item {
            display: flex;
            align-items: center;
            gap: 5px;
        }
        
        .meta-item i {
            font-style: normal;
            font-weight: 500;
        }
        
        .article-image {
            margin-bottom: 30px;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
        }
        
        .article-image img {
            width: 100%;
            height: auto;
            display: block;
            max-height: 500px;
            object-fit: cover;
        }
        
        .image-caption {
            padding: 10px;
            background: #f8fafc;
            font-size: 14px;
            color: #64748b;
            text-align: center;
            border-top: 1px solid #e2e8f0;
        }
        
        .article-body {
            font-size: 16px;
            line-height: 1.8;
        }
        
        .article-body p {
            margin-bottom: 20px;
        }
        
        .article-body h2 {
            font-size: 24px;
            color: #0f2a44;
            margin: 30px 0 15px;
            padding-bottom: 8px;
            border-bottom: 2px solid #e2e8f0;
        }
        
        .article-body h3 {
            font-size: 20px;
            color: #1e40af;
            margin: 25px 0 12px;
        }
        
        .article-body ul, .article-body ol {
            margin-left: 20px;
            margin-bottom: 20px;
        }
        
        .article-body li {
            margin-bottom: 8px;
        }
        
        .article-body blockquote {
            border-left: 4px solid #0f2a44;
            padding-left: 20px;
            margin: 25px 0;
            color: #4b5563;
            font-style: italic;
            background: #f8fafc;
            padding: 20px;
            border-radius: 0 8px 8px 0;
        }
        
        /* SIDEBAR */
        .article-sidebar {
            width: 300px;
            flex-shrink: 0;
        }
        
        .sidebar-section {
            background: white;
            border-radius: 8px;
            padding: 20px;
            margin-bottom: 20px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.05);
            border: 1px solid #e2e8f0;
        }
        
        .sidebar-title {
            font-size: 18px;
            color: #0f2a44;
            margin-bottom: 15px;
            padding-bottom: 8px;
            border-bottom: 2px solid #e2e8f0;
        }
        
        .recent-news {
            list-style: none;
        }
        
        .recent-news li {
            margin-bottom: 12px;
            padding-bottom: 12px;
            border-bottom: 1px solid #f1f5f9;
        }
        
        .recent-news li:last-child {
            margin-bottom: 0;
            padding-bottom: 0;
            border-bottom: none;
        }
        
        .recent-news a {
            color: #334155;
            display: block;
            font-size: 14px;
            line-height: 1.4;
        }
        
        .recent-news a:hover {
            color: #0f2a44;
        }
        
        .news-date {
            display: block;
            font-size: 12px;
            color: #94a3b8;
            margin-top: 3px;
        }
        
        .sidebar-btn {
            display: block;
            width: 100%;
            background: #0f2a44;
            color: white;
            text-align: center;
            padding: 12px;
            border-radius: 5px;
            font-weight: 500;
            margin-top: 15px;
            transition: background 0.3s;
        }
        
        .sidebar-btn:hover {
            background: #1a4a6e;
            text-decoration: none;
        }
        
        /* BACK BUTTON */
        .back-button {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            background: #f1f5f9;
            padding: 8px 16px;
            border-radius: 5px;
            margin-bottom: 20px;
            font-weight: 500;
            color: #475569;
        }
        
        .back-button:hover {
            background: #e2e8f0;
            text-decoration: none;
        }
        
        /* NO CONTENT STYLES */
        .no-content {
            text-align: center;
            padding: 30px;
            color: #64748b;
            background: white;
            border-radius: 8px;
            border: 1px solid #e2e8f0;
        }
        
        /* FOOTER */
        .site-footer {
            background: #0f2a44;
            color: white;
            padding: 40px 0;
            margin-top: 60px;
        }
        
        .footer-container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 20px;
        }
        
        .footer-content {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 40px;
            margin-bottom: 30px;
        }
        
        .footer-section h3 {
            font-size: 18px;
            margin-bottom: 15px;
            color: #fff;
        }
        
        .footer-section p {
            margin-bottom: 8px;
            opacity: 0.9;
            font-size: 14px;
        }
        
        .footer-copyright {
            text-align: center;
            padding-top: 20px;
            border-top: 1px solid rgba(255,255,255,0.1);
            font-size: 14px;
            opacity: 0.7;
        }
        
        /* RESPONSIVE */
        @media (max-width: 1024px) {
            .article-container {
                flex-direction: column;
            }
            
            .article-sidebar {
                width: 100%;
            }
        }
        
        @media (max-width: 768px) {
            .header-container {
                flex-direction: column;
                gap: 15px;
            }
            
            .nav-links {
                flex-wrap: wrap;
                justify-content: center;
            }
            
            .article-title {
                font-size: 28px;
            }
            
            .article-meta {
                flex-direction: column;
                align-items: flex-start;
                gap: 10px;
            }
        }
        
        @media (max-width: 480px) {
            .article-title {
                font-size: 24px;
            }
            
            .main-container {
                padding: 20px 15px;
            }
        }
    </style>
</head>
<body>
    <!-- HEADER -->
    <header class="site-header">
        <div class="header-container">
            <div class="logo">
                LPM<br>
                <small>Universitas Kampus</small>
            </div>
            <nav class="nav-links">
                <a href="/">Beranda</a>
                <a href="{{ route('home') }}">Berita</a>
                <a href="/agenda">Agenda</a>
                @auth
                    <a href="/dashboard">Dashboard</a>
                @else
                    <a href="/login">Login</a>
                @endauth
            </nav>
        </div>
    </header>

    <!-- BREADCRUMB -->
    <div class="breadcrumb">
        <div class="breadcrumb-container">
            <a href="/">Beranda</a> / 
            <a href="{{ route('home') }}">Berita</a> / 
            <span>{{ \Illuminate\Support\Str::limit($news->title, 50) }}</span>
        </div>
    </div>

    <!-- MAIN CONTENT -->
    <main class="main-container">
        <a href="{{ route('home') }}" class="back-button">
            ← Kembali ke Berita
        </a>

        <div class="article-container">
            <!-- ARTICLE CONTENT -->
            <article class="article-content">
                <header class="article-header">
                    <h1 class="article-title">{{ $news->title }}</h1>
                    
                    <div class="article-meta">
                        <div class="meta-item">
                            <i>📅</i> {{ $news->created_at->translatedFormat('l, d F Y') }}
                        </div>
                        <div class="meta-item">
                            <i>👤</i> {{ $news->user->name ?? 'Admin LPM' }}
                        </div>
                        <div class="meta-item">
                            <i>🏷️</i> Berita
                        </div>
                    </div>
                </header>

                @if($news->image)
                <div class="article-image">
                    <img src="{{ asset('storage/'.$news->image) }}" 
                         alt="{{ $news->title }}">
                    <div class="image-caption">
                        Ilustrasi: {{ $news->title }}
                    </div>
                </div>
                @endif

                <div class="article-body">
                    {!! nl2br(e($news->content)) !!}
                </div>
            </article>

            <!-- SIDEBAR -->
            <aside class="article-sidebar">
                <!-- Berita Terbaru - Hanya tampilkan jika ada data -->
                <div class="sidebar-section">
                    <h3 class="sidebar-title">Berita Terbaru</h3>
                    
                    @if(isset($recentNews) && count($recentNews) > 0)
                        <ul class="recent-news">
                            @foreach($recentNews as $recent)
                                @if($recent->id != $news->id) <!-- Exclude current article -->
                                    <li>
                                        <a href="{{ route('news.show', $recent) }}">
                                            {{ \Illuminate\Support\Str::limit($recent->title, 60) }}
                                            <span class="news-date">{{ $recent->created_at->format('d M Y') }}</span>
                                        </a>
                                    </li>
                                @endif
                            @endforeach
                        </ul>
                    @else
                        <div class="no-content" style="padding: 10px 0;">
                            <p>Tidak ada berita lain</p>
                        </div>
                    @endif
                    
                    <a href="{{ route('home') }}" class="sidebar-btn">
                        Lihat Semua Berita
                    </a>
                </div>

                <!-- Kategori - Hanya tampilkan jika ada data kategori -->
                @if(isset($categories) && count($categories) > 0)
                <div class="sidebar-section">
                    <h3 class="sidebar-title">Kategori</h3>
                    <ul class="recent-news">
                        @foreach($categories as $category)
                            <li><a href="#">{{ $category->name }}</a></li>
                        @endforeach
                    </ul>
                </div>
                @endif

                
            </aside>
        </div>
    </main>

    <!-- FOOTER -->
    <footer class="site-footer">
        <div class="footer-container">
            <div class="footer-content">
                <div class="footer-section">
                    <h3>LPM Universitas Kampus</h3>
                    <p>Gedung Rektorat Lt. 3</p>
                    <p>Jl. Kampus No. 1, Kota Kampus</p>
                    <p>Kode Pos: 12345</p>
                </div>
                
                <div class="footer-section">
                    <h3>Kontak</h3>
                    <p>Email: lpm@kampus.ac.id</p>
                    <p>Telepon: (021) 1234-5678</p>
                    <p>Fax: (021) 1234-5679</p>
                </div>
                
                <div class="footer-section">
                    <h3>Tautan Cepat</h3>
                    <p><a href="/" style="color: white;">Beranda</a></p>
                    <p><a href="{{ route('home') }}" style="color: white;">Berita</a></p>
                    <p><a href="#" style="color: white;">Agenda</a></p>
                    <p><a href="#" style="color: white;">Tentang Kami</a></p>
                </div>
            </div>
            
            <div class="footer-copyright">
                © {{ date('Y') }} Lembaga Penjaminan Mutu - Universitas Kampus. Semua hak dilindungi.
            </div>
        </div>
    </footer>
</body>
</html>