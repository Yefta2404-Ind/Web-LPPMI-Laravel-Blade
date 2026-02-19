@extends('layouts.admin')

@section('content')
<style>
    /* Variables */
    :root {
        --primary-color: #2563eb;
        --primary-dark: #1d4ed8;
        --primary-light: #dbeafe;
        --success-color: #10b981;
        --success-light: #d1fae5;
        --warning-color: #f59e0b;
        --warning-light: #fef3c7;
        --danger-color: #ef4444;
        --danger-light: #fee2e2;
        --info-color: #8b5cf6;
        --info-light: #ede9fe;
        --gray-50: #f9fafb;
        --gray-100: #f3f4f6;
        --gray-200: #e5e7eb;
        --gray-300: #d1d5db;
        --gray-400: #9ca3af;
        --gray-500: #6b7280;
        --gray-600: #4b5563;
        --gray-700: #374151;
        --gray-800: #1f2937;
        --gray-900: #111827;
        --border-radius: 8px;
        --border-radius-sm: 6px;
        --shadow-sm: 0 1px 2px 0 rgba(0, 0, 0, 0.05);
        --shadow: 0 1px 3px 0 rgba(0, 0, 0, 0.1), 0 1px 2px -1px rgba(0, 0, 0, 0.1);
        --shadow-md: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -2px rgba(0, 0, 0, 0.1);
        --shadow-lg: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -4px rgba(0, 0, 0, 0.1);
        --transition: 200ms ease;
    }

    /* Base Styles */
    .admin-container {
        max-width: 1400px;
        margin: 0 auto;
        padding: 0 16px;
    }

    /* Page Header */
    .page-header {
        margin-bottom: 32px;
        padding-bottom: 20px;
        border-bottom: 1px solid var(--gray-200);
    }

    .page-title {
        font-size: 1.75rem;
        font-weight: 700;
        color: var(--gray-900);
        margin-bottom: 8px;
    }

    .page-description {
        color: var(--gray-600);
        font-size: 0.9375rem;
        line-height: 1.5;
    }

    /* Statistics Grid */
    .stats-grid {
        display: grid;
        grid-template-columns: repeat(1, 1fr);
        gap: 16px;
        margin-bottom: 32px;
    }

    @media (min-width: 640px) {
        .stats-grid {
            grid-template-columns: repeat(2, 1fr);
        }
    }

    @media (min-width: 1024px) {
        .stats-grid {
            grid-template-columns: repeat(5, 1fr);
        }
    }

    .stat-card {
        background: white;
        border-radius: var(--border-radius);
        border: 1px solid var(--gray-200);
        padding: 20px;
        transition: all var(--transition);
        position: relative;
        overflow: hidden;
    }

    .stat-card:hover {
        border-color: var(--primary-color);
        box-shadow: var(--shadow-md);
        transform: translateY(-2px);
    }

    .stat-icon {
        width: 48px;
        height: 48px;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-bottom: 16px;
        font-size: 1.25rem;
    }

    .stat-icon.news {
        background-color: rgba(245, 158, 11, 0.1);
        color: var(--warning-color);
    }

    .stat-icon.agenda {
        background-color: rgba(139, 92, 246, 0.1);
        color: var(--info-color);
    }

    .stat-icon.approved {
        background-color: rgba(16, 185, 129, 0.1);
        color: var(--success-color);
    }

    .stat-icon.rejected {
        background-color: rgba(239, 68, 68, 0.1);
        color: var(--danger-color);
    }

    .stat-icon.video {
        background-color: rgba(59, 130, 246, 0.1);
        color: var(--primary-color);
    }

    .stat-content {
        flex: 1;
    }

    .stat-label {
        font-size: 0.8125rem;
        color: var(--gray-600);
        font-weight: 500;
        text-transform: uppercase;
        letter-spacing: 0.05em;
        margin-bottom: 4px;
    }

    .stat-value {
        font-size: 1.75rem;
        font-weight: 700;
        color: var(--gray-900);
        line-height: 1.2;
    }

    .stat-action {
        margin-top: 12px;
    }

    /* Dashboard Grid */
    .dashboard-grid {
        display: grid;
        grid-template-columns: repeat(1, 1fr);
        gap: 24px;
        margin-bottom: 40px;
    }

    @media (min-width: 1024px) {
        .dashboard-grid {
            grid-template-columns: repeat(2, 1fr);
        }
    }

    /* Section Cards */
    .section-card {
        background: white;
        border-radius: var(--border-radius);
        border: 1px solid var(--gray-200);
        box-shadow: var(--shadow-sm);
        overflow: hidden;
        height: 100%;
        display: flex;
        flex-direction: column;
    }

    .section-header {
        padding: 20px 24px;
        border-bottom: 1px solid var(--gray-200);
        background-color: var(--gray-50);
    }

    .section-title {
        font-size: 1.125rem;
        font-weight: 600;
        color: var(--gray-900);
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .section-icon {
        color: var(--primary-color);
        font-size: 1.25rem;
    }

    .section-body {
        padding: 24px;
        flex: 1;
        overflow-y: auto;
        max-height: 600px;
    }

    /* Empty State */
    .empty-state {
        text-align: center;
        padding: 48px 20px;
        color: var(--gray-500);
    }

    .empty-icon {
        font-size: 2.5rem;
        margin-bottom: 16px;
        opacity: 0.5;
    }

    .empty-text {
        font-size: 0.9375rem;
        color: var(--gray-600);
    }

    /* Pending Lists */
    .pending-list {
        display: flex;
        flex-direction: column;
        gap: 16px;
    }

    .pending-item {
        padding: 20px;
        border: 1px solid var(--gray-200);
        border-radius: var(--border-radius-sm);
        background: white;
        transition: all var(--transition);
    }

    .pending-item:hover {
        border-color: var(--primary-color);
        box-shadow: var(--shadow);
        transform: translateX(2px);
    }

    .item-header {
        display: flex;
        justify-content: space-between;
        align-items: flex-start;
        margin-bottom: 12px;
        gap: 12px;
    }

    .item-title {
        font-weight: 600;
        color: var(--gray-900);
        font-size: 1rem;
        line-height: 1.4;
        flex: 1;
    }

    .item-type {
        padding: 4px 10px;
        border-radius: 20px;
        font-size: 0.75rem;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.05em;
        white-space: nowrap;
        border: 1px solid;
    }

    .item-type.news {
        background-color: var(--warning-light);
        color: var(--warning-color);
        border-color: rgba(245, 158, 11, 0.2);
    }

    .item-type.agenda {
        background-color: var(--info-light);
        color: var(--info-color);
        border-color: rgba(139, 92, 246, 0.2);
    }

    .item-type.video {
        background-color: var(--primary-light);
        color: var(--primary-color);
        border-color: rgba(59, 130, 246, 0.2);
    }

    .item-meta {
        display: flex;
        flex-wrap: wrap;
        gap: 16px;
        margin-bottom: 16px;
        font-size: 0.8125rem;
        color: var(--gray-600);
    }

    .meta-item {
        display: flex;
        align-items: center;
        gap: 6px;
    }

    .meta-icon {
        color: var(--gray-500);
        font-size: 0.875rem;
    }

    .item-actions {
        display: flex;
        gap: 8px;
        flex-wrap: wrap;
    }

    /* Video Preview */
    .video-preview-container {
        margin-bottom: 20px;
        border-radius: var(--border-radius-sm);
        overflow: hidden;
        background-color: var(--gray-900);
        position: relative;
        padding-top: 56.25%; /* 16:9 Aspect Ratio */
    }

    .video-preview {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        border: 0;
    }

    /* Buttons */
    .btn {
        padding: 8px 16px;
        border-radius: var(--border-radius-sm);
        font-size: 0.8125rem;
        font-weight: 500;
        text-decoration: none;
        cursor: pointer;
        border: 1px solid transparent;
        transition: all var(--transition);
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 6px;
        white-space: nowrap;
    }

    .btn-sm {
        padding: 6px 12px;
        font-size: 0.75rem;
    }

    .btn-view {
        background-color: white;
        color: var(--gray-700);
        border-color: var(--gray-300);
    }

    .btn-view:hover {
        background-color: var(--gray-50);
        border-color: var(--gray-400);
    }

    .btn-approve {
        background-color: var(--success-color);
        color: white;
        border-color: var(--success-color);
    }

    .btn-approve:hover {
        background-color: #0da271;
        border-color: #0da271;
    }

    .btn-reject {
        background-color: var(--danger-color);
        color: white;
        border-color: var(--danger-color);
    }

    .btn-reject:hover {
        background-color: #dc2626;
        border-color: #dc2626;
    }

    .btn-video {
        background-color: var(--primary-color);
        color: white;
        border-color: var(--primary-color);
    }

    .btn-video:hover {
        background-color: var(--primary-dark);
        border-color: var(--primary-dark);
    }

    .form-inline {
        display: inline;
    }

    /* Video Section */
    .video-section {
        margin-top: 24px;
    }

    /* Responsive */
    @media (max-width: 768px) {
        .admin-container {
            padding: 0 12px;
        }
        
        .section-body {
            padding: 16px;
        }
        
        .item-actions {
            flex-direction: column;
        }
        
        .item-actions .btn {
            width: 100%;
            justify-content: center;
        }
        
        .item-header {
            flex-direction: column;
            align-items: flex-start;
            gap: 8px;
        }
        
        .item-type {
            align-self: flex-start;
        }
        
        .item-meta {
            flex-direction: column;
            gap: 8px;
        }
        
        .stats-grid {
            gap: 12px;
        }
        
        .stat-card {
            padding: 16px;
        }
        
        .stat-value {
            font-size: 1.5rem;
        }
    }

    @media (max-width: 480px) {
        .page-title {
            font-size: 1.5rem;
        }
        
        .section-header {
            padding: 16px;
        }
        
        .pending-item {
            padding: 16px;
        }
        
        .dashboard-grid {
            gap: 16px;
        }
    }
</style>

<div class="admin-container">
    <!-- Page Header -->
    <div class="page-header">
        <h1 class="page-title">Admin Dashboard</h1>
        <p class="page-description">Kelola persetujuan konten berita, agenda, dan video yang diajukan oleh staff</p>
    </div>

    <!-- Statistics -->
    <div class="stats-grid">
        <!-- Pending News -->
        <div class="stat-card">
            <div class="stat-icon news">
                <i class="fas fa-newspaper"></i>
            </div>
            <div class="stat-content">
                <div class="stat-label">Berita Pending</div>
                <div class="stat-value">{{ $pendingNews->count() }}</div>
                <div class="stat-action">
                    @if($pendingNews->count() > 0)
                    <a href="#pending-news" class="btn btn-view btn-sm" style="font-size: 0.75rem;">
                        <i class="fas fa-arrow-down"></i> Lihat
                    </a>
                    @endif
                </div>
            </div>
        </div>

        <!-- Pending Agenda -->
        <div class="stat-card">
            <div class="stat-icon agenda">
                <i class="fas fa-calendar-alt"></i>
            </div>
            <div class="stat-content">
                <div class="stat-label">Agenda Pending</div>
                <div class="stat-value">{{ $pendingAgenda->count() }}</div>
                <div class="stat-action">
                    @if($pendingAgenda->count() > 0)
                    <a href="#pending-agenda" class="btn btn-view btn-sm" style="font-size: 0.75rem;">
                        <i class="fas fa-arrow-down"></i> Lihat
                    </a>
                    @endif
                </div>
            </div>
        </div>

        <!-- Pending Videos -->
        <div class="stat-card">
            <div class="stat-icon video">
                <i class="fas fa-video"></i>
            </div>
            <div class="stat-content">
                <div class="stat-label">Video Pending</div>
                <div class="stat-value">{{ $pendingVideos->count() }}</div>
                <div class="stat-action">
                    @if($pendingVideos->count() > 0)
                    <a href="#pending-videos" class="btn btn-view btn-sm" style="font-size: 0.75rem;">
                        <i class="fas fa-arrow-down"></i> Lihat
                    </a>
                    @endif
                </div>
            </div>
        </div>

        <!-- Approved -->
        <div class="stat-card">
            <div class="stat-icon approved">
                <i class="fas fa-check-circle"></i>
            </div>
            <div class="stat-content">
                <div class="stat-label">Total Disetujui</div>
                <div class="stat-value">{{ $approvedCount ?? 0 }}</div>
            </div>
        </div>

        <!-- Rejected -->
        <div class="stat-card">
            <div class="stat-icon rejected">
                <i class="fas fa-times-circle"></i>
            </div>
            <div class="stat-content">
                <div class="stat-label">Total Ditolak</div>
                <div class="stat-value">{{ $rejectedCount ?? 0 }}</div>
            </div>
        </div>
    </div>

    <!-- Pending Content -->
    <div class="dashboard-grid">
        <!-- Pending News -->
        <div class="section-card" id="pending-news">
            <div class="section-header">
                <h2 class="section-title">
                    <i class="fas fa-newspaper section-icon"></i>
                    Berita Menunggu Persetujuan
                </h2>
            </div>
            
            <div class="section-body">
                @if($pendingNews->count() > 0)
                    <div class="pending-list">
                        @foreach($pendingNews as $news)
                            <div class="pending-item">
                                <div class="item-header">
                                    <div class="item-title">{{ Str::limit($news->title, 70) }}</div>
                                    <span class="item-type news">Berita</span>
                                </div>
                                
                                <div class="item-meta">
                                    <div class="meta-item">
                                        <i class="fas fa-clock meta-icon"></i>
                                        {{ $news->created_at->diffForHumans() }}
                                    </div>
                                    <div class="meta-item">
                                        <i class="fas fa-user meta-icon"></i>
                                        {{ $news->user->name ?? 'Unknown' }}
                                    </div>
                                </div>
                                
                                <div class="item-actions">
                                    <form method="POST" action="{{ route('admin.news.approve', $news->id) }}" class="form-inline">
                                        @csrf
                                        <button type="submit" class="btn btn-approve btn-sm" 
                                                data-confirm="Setujui berita ini?">
                                            <i class="fas fa-check"></i>
                                            Setujui
                                        </button>
                                    </form>
                                    <form method="POST" action="{{ route('admin.news.reject', $news->id) }}" class="form-inline">
                                        @csrf
                                        <button type="submit" class="btn btn-reject btn-sm"
                                                data-confirm="Tolak berita ini?">
                                            <i class="fas fa-times"></i>
                                            Tolak
                                        </button>
                                    </form>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="empty-state">
                        <div class="empty-icon">
                            <i class="fas fa-newspaper"></i>
                        </div>
                        <p class="empty-text">Tidak ada berita yang menunggu persetujuan</p>
                    </div>
                @endif
            </div>
        </div>

        <!-- Pending Agenda -->
        <div class="section-card" id="pending-agenda">
            <div class="section-header">
                <h2 class="section-title">
                    <i class="fas fa-calendar-alt section-icon"></i>
                    Agenda Menunggu Persetujuan
                </h2>
            </div>
            
            <div class="section-body">
                @if($pendingAgenda->count() > 0)
                    <div class="pending-list">
                        @foreach($pendingAgenda as $agenda)
                            <div class="pending-item">
                                <div class="item-header">
                                    <div class="item-title">{{ Str::limit($agenda->title, 70) }}</div>
                                    <span class="item-type agenda">Agenda</span>
                                </div>
                                
                                <div class="item-meta">
                                    <div class="meta-item">
                                        <i class="fas fa-calendar meta-icon"></i>
                                        {{ \Carbon\Carbon::parse($agenda->date)->format('d M Y H:i') }}
                                    </div>
                                    <div class="meta-item">
                                        <i class="fas fa-user meta-icon"></i>
                                        {{ $agenda->user->name ?? 'Unknown' }}
                                    </div>
                                    @if($agenda->location)
                                    <div class="meta-item">
                                        <i class="fas fa-map-marker-alt meta-icon"></i>
                                        {{ Str::limit($agenda->location, 30) }}
                                    </div>
                                    @endif
                                </div>
                                
                                <div class="item-actions">
                                    <a href="{{ route('agenda.show', $agenda->id) }}" class="btn btn-view btn-sm" target="_blank">
                                        <i class="fas fa-eye"></i>
                                        Lihat
                                    </a>
                                    <form method="POST" action="{{ route('admin.agenda.approve', $agenda->id) }}" class="form-inline">
                                        @csrf
                                        <button type="submit" class="btn btn-approve btn-sm" 
                                                data-confirm="Setujui agenda ini?">
                                            <i class="fas fa-check"></i>
                                            Setujui
                                        </button>
                                    </form>
                                    <form method="POST" action="{{ route('admin.agenda.reject', $agenda->id) }}" class="form-inline">
                                        @csrf
                                        <button type="submit" class="btn btn-reject btn-sm"
                                                data-confirm="Tolak agenda ini?">
                                            <i class="fas fa-times"></i>
                                            Tolak
                                        </button>
                                    </form>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="empty-state">
                        <div class="empty-icon">
                            <i class="fas fa-calendar-alt"></i>
                        </div>
                        <p class="empty-text">Tidak ada agenda yang menunggu persetujuan</p>
                    </div>
                @endif
            </div>
        </div>
    </div>

    <!-- Pending Videos Section -->
    <div class="video-section" id="pending-videos">
        <div class="section-card">
            <div class="section-header">
                <h2 class="section-title">
                    <i class="fas fa-video section-icon"></i>
                    Video Menunggu Persetujuan
                </h2>
            </div>
            
            <div class="section-body">
                @if($pendingVideos->count() > 0)
                    <!-- Video Preview -->
                    @if($pendingVideos->first())
                        <div class="video-preview-container">
                            <iframe 
                                src="{{ str_replace('watch?v=', 'embed/', $pendingVideos->first()->url) }}"
                                class="video-preview"
                                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                                allowfullscreen>
                            </iframe>
                        </div>
                    @endif

                    <div class="pending-list">
                        @foreach($pendingVideos as $video)
                            <div class="pending-item">
                                <div class="item-header">
                                    <div class="item-title">{{ Str::limit($video->title, 70) }}</div>
                                    <span class="item-type video">Video</span>
                                </div>
                                
                                <div class="item-meta">
                                    <div class="meta-item">
                                        <i class="fas fa-clock meta-icon"></i>
                                        {{ $video->created_at->diffForHumans() }}
                                    </div>
                                    <div class="meta-item">
                                        <i class="fas fa-user meta-icon"></i>
                                        {{ $video->user->name ?? 'Unknown' }}
                                    </div>
                                </div>
                                
                                <div class="item-actions">
                                    <a href="{{ $video->url }}" target="_blank" class="btn btn-view btn-sm">
                                        <i class="fas fa-external-link-alt"></i>
                                        Buka Video
                                    </a>
                                    <form method="POST" action="{{ route('admin.videos.approve', $video->id) }}" class="form-inline">
                                        @csrf
                                        <button type="submit" class="btn btn-approve btn-sm"
                                                data-confirm="Setujui video ini?">
                                            <i class="fas fa-check"></i>
                                            Setujui
                                        </button>
                                    </form>
                                    <form method="POST" action="{{ route('admin.videos.reject', $video->id) }}" class="form-inline">
                                        @csrf
                                        <button type="submit" class="btn btn-reject btn-sm"
                                                data-confirm="Tolak video ini?">
                                            <i class="fas fa-times"></i>
                                            Tolak
                                        </button>
                                    </form>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="empty-state">
                        <div class="empty-icon">
                            <i class="fas fa-video"></i>
                        </div>
                        <p class="empty-text">Tidak ada video yang menunggu persetujuan</p>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Confirmation for all action buttons
    const actionButtons = document.querySelectorAll('[data-confirm]');
    actionButtons.forEach(button => {
        button.addEventListener('click', function(e) {
            const message = this.getAttribute('data-confirm');
            if (!confirm(message)) {
                e.preventDefault();
            }
        });
    });

    // Smooth scroll to sections
    const scrollLinks = document.querySelectorAll('a[href^="#"]');
    scrollLinks.forEach(link => {
        link.addEventListener('click', function(e) {
            const targetId = this.getAttribute('href');
            if (targetId === '#') return;
            
            const targetElement = document.querySelector(targetId);
            if (targetElement) {
                e.preventDefault();
                window.scrollTo({
                    top: targetElement.offsetTop - 20,
                    behavior: 'smooth'
                });
            }
        });
    });

    // Auto-refresh page every 60 seconds to check for new pending items
    setTimeout(() => {
        window.location.reload();
    }, 60000);
});
</script>
@endsection