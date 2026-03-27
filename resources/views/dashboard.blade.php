@extends('layouts.cms')

@section('title', 'Dashboard Staff')
@section('content-subtitle', 'Kelola konten dan aktivitas Anda')

@section('content')
<style>
    :root {
        --primary: #0f2a44;
        --secondary: #2563eb;
        --success: #10b981;
        --warning: #f59e0b;
        --danger: #ef4444;
        --gray-50: #f9fafb;
        --gray-100: #f3f4f6;
        --gray-200: #e5e7eb;
        --gray-300: #d1d5db;
        --gray-400: #9ca3af;
        --gray-500: #6b7280;
        --gray-600: #4b5563;
        --gray-700: #374151;
        --gray-800: #1f2937;
        --border-radius: 8px;
        --shadow-sm: 0 1px 2px 0 rgba(0, 0, 0, 0.05);
        --shadow: 0 1px 3px 0 rgba(0, 0, 0, 0.1);
        --shadow-md: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
    }

    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }

    body {
        font-family: 'Inter', -apple-system, sans-serif;
        background-color: var(--gray-50);
    }

    .dashboard-container {
        padding: 24px;
        max-width: 1400px;
        margin: 0 auto;
    }

    @media (max-width: 768px) {
        .dashboard-container {
            padding: 16px;
        }
    }

    /* Header */
    .dashboard-header {
        margin-bottom: 32px;
    }

    .welcome-section h1 {
        font-size: 24px;
        font-weight: 700;
        color: var(--gray-800);
        margin-bottom: 4px;
    }

    .welcome-section .subtitle {
        font-size: 15px;
        color: var(--gray-500);
        line-height: 1.5;
    }

    /* Stats Grid */
    .stats-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(240px, 1fr));
        gap: 20px;
        margin-bottom: 32px;
    }

    @media (max-width: 640px) {
        .stats-grid {
            grid-template-columns: 1fr;
        }
    }

    .stat-card {
        background: white;
        border-radius: var(--border-radius);
        padding: 20px;
        box-shadow: var(--shadow);
        border: 1px solid var(--gray-200);
        transition: transform 0.2s ease, box-shadow 0.2s ease;
    }

    .stat-card:hover {
        transform: translateY(-2px);
        box-shadow: var(--shadow-md);
    }

    .stat-card .header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        margin-bottom: 16px;
    }

    .stat-card .title {
        font-size: 14px;
        font-weight: 500;
        color: var(--gray-500);
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .stat-card .icon {
        width: 40px;
        height: 40px;
        border-radius: 8px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 18px;
    }

    .stat-card .value {
        font-size: 28px;
        font-weight: 700;
        color: var(--gray-800);
        margin-bottom: 4px;
        line-height: 1.2;
    }

    .stat-card .trend {
        font-size: 13px;
        font-weight: 500;
    }

    .trend.positive {
        color: var(--success);
    }

    .trend.negative {
        color: var(--danger);
    }

    /* Content Grid */
    .content-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(350px, 1fr));
        gap: 24px;
        margin-bottom: 32px;
    }

    @media (max-width: 768px) {
        .content-grid {
            grid-template-columns: 1fr;
        }
    }

    .content-card {
        background: white;
        border-radius: var(--border-radius);
        box-shadow: var(--shadow);
        border: 1px solid var(--gray-200);
        overflow: hidden;
    }

    .card-header {
        padding: 20px;
        border-bottom: 1px solid var(--gray-200);
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .card-header h3 {
        font-size: 16px;
        font-weight: 600;
        color: var(--gray-800);
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .card-actions {
        display: flex;
        gap: 8px;
    }

    .btn {
        padding: 8px 16px;
        border-radius: 6px;
        font-size: 13px;
        font-weight: 500;
        text-decoration: none;
        transition: all 0.2s ease;
        border: 1px solid transparent;
        cursor: pointer;
        display: inline-flex;
        align-items: center;
        gap: 6px;
        white-space: nowrap;
    }

    .btn-primary {
        background: var(--secondary);
        color: white;
        border-color: var(--secondary);
    }

    .btn-primary:hover {
        background: #1d4ed8;
        transform: translateY(-1px);
    }

    .btn-outline {
        background: white;
        color: var(--gray-600);
        border-color: var(--gray-300);
    }

    .btn-outline:hover {
        background: var(--gray-50);
        border-color: var(--gray-400);
    }

    .btn-sm {
        padding: 6px 12px;
        font-size: 12px;
    }

    /* Card Content */
    .card-content {
        padding: 20px;
    }

    .empty-state {
        text-align: center;
        padding: 40px 20px;
    }

    .empty-state .icon {
        font-size: 40px;
        color: var(--gray-300);
        margin-bottom: 16px;
        opacity: 0.5;
    }

    .empty-state .text {
        font-size: 14px;
        color: var(--gray-500);
        margin-bottom: 16px;
        line-height: 1.5;
    }

    /* Items List */
    .items-list {
        display: flex;
        flex-direction: column;
        gap: 12px;
    }

    .list-item {
        padding: 16px;
        border: 1px solid var(--gray-200);
        border-radius: var(--border-radius);
        transition: all 0.2s ease;
        background: var(--gray-50);
    }

    .list-item:hover {
        border-color: var(--gray-300);
        background: white;
        box-shadow: var(--shadow-sm);
    }

    .item-header {
        display: flex;
        justify-content: space-between;
        align-items: flex-start;
        margin-bottom: 12px;
        gap: 12px;
    }

    .item-title {
        font-weight: 500;
        color: var(--gray-800);
        font-size: 14px;
        line-height: 1.4;
        flex: 1;
    }

    .status-badge {
        padding: 4px 10px;
        border-radius: 12px;
        font-size: 11px;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.3px;
        white-space: nowrap;
    }

    .status-draft {
        background: var(--gray-100);
        color: var(--gray-600);
    }

    .status-pending {
        background: #fef3c7;
        color: #92400e;
    }

    .status-approved {
        background: #d1fae5;
        color: #065f46;
    }

    .status-rejected {
        background: #fee2e2;
        color: #991b1b;
    }

    .item-meta {
        display: flex;
        gap: 16px;
        margin-bottom: 12px;
        font-size: 12px;
        color: var(--gray-500);
    }

    .meta-item {
        display: flex;
        align-items: center;
        gap: 6px;
    }

    .item-actions {
        display: flex;
        gap: 8px;
        flex-wrap: wrap;
    }

    .btn-secondary {
        background: var(--gray-100);
        color: var(--gray-700);
        border-color: var(--gray-300);
    }

    .btn-secondary:hover {
        background: var(--gray-200);
    }

    .btn-danger {
        background: white;
        color: var(--danger);
        border-color: var(--danger);
    }

    .btn-danger:hover {
        background: var(--danger);
        color: white;
    }

    .view-all {
        text-align: center;
        margin-top: 20px;
        padding-top: 20px;
        border-top: 1px solid var(--gray-200);
    }

    .view-all-link {
        color: var(--secondary);
        text-decoration: none;
        font-size: 13px;
        font-weight: 500;
        display: inline-flex;
        align-items: center;
        gap: 6px;
    }

    .view-all-link:hover {
        color: #1d4ed8;
        text-decoration: underline;
    }

    /* Activity Card */
    .activity-card {
        background: white;
        border-radius: var(--border-radius);
        box-shadow: var(--shadow);
        border: 1px solid var(--gray-200);
        margin-top: 24px;
    }

    .activity-list {
        padding: 0;
    }

    .activity-item {
        padding: 16px 20px;
        border-bottom: 1px solid var(--gray-200);
        display: flex;
        align-items: center;
        gap: 12px;
    }

    .activity-item:last-child {
        border-bottom: none;
    }

    .activity-icon {
        width: 32px;
        height: 32px;
        border-radius: 6px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 14px;
        background: var(--gray-100);
        color: var(--gray-600);
        flex-shrink: 0;
    }

    .activity-content {
        flex: 1;
        min-width: 0;
    }

    .activity-title {
        font-weight: 500;
        color: var(--gray-800);
        font-size: 13px;
        margin-bottom: 4px;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }

    .activity-meta {
        font-size: 11px;
        color: var(--gray-500);
        display: flex;
        align-items: center;
        gap: 8px;
        flex-wrap: wrap;
    }

    .activity-type {
        padding: 2px 6px;
        border-radius: 4px;
        font-size: 10px;
        background: var(--gray-100);
        color: var(--gray-600);
    }

    /* Form styles */
    .form-delete {
        display: inline;
    }

    /* Utility Classes */
    .text-truncate {
        overflow: hidden;
        text-overflow: ellipsis;
        white-space: nowrap;
    }

    /* Color Themes for Stats */
    .stat-news .icon {
        background: rgba(37, 99, 235, 0.1);
        color: var(--secondary);
    }

    .stat-agenda .icon {
        background: rgba(16, 185, 129, 0.1);
        color: var(--success);
    }

    .stat-surveys .icon {
        background: rgba(245, 158, 11, 0.1);
        color: var(--warning);
    }

    .stat-approved .icon {
        background: rgba(139, 92, 246, 0.1);
        color: #8b5cf6;
    }

    .stat-videos .icon {
        background: rgba(239, 68, 68, 0.1);
        color: var(--danger);
    }
</style>

<div class="dashboard-container">
    <!-- Header -->
    <div class="dashboard-header">
        <div class="welcome-section">
            <h1>Halo, {{ auth()->user()->name ?? 'Staff' }} 👋</h1>
            <p class="subtitle">Kelola konten dan aktivitas Anda di sistem</p>
        </div>
    </div>

    <!-- Stats Grid -->
    <div class="stats-grid">
        <div class="stat-card stat-news">
            <div class="header">
                <div class="title">Total Berita</div>
                <div class="icon">
                    <i class="fas fa-newspaper"></i>
                </div>
            </div>
            <div class="value">{{ $myNews->count() }}</div>
            <div class="trend positive">
                +{{ $myNews->where('created_at', '>=', now()->subDays(7))->count() }} minggu ini
            </div>
        </div>

        <div class="stat-card stat-agenda">
            <div class="header">
                <div class="title">Total Agenda</div>
                <div class="icon">
                    <i class="fas fa-calendar-alt"></i>
                </div>
            </div>
            <div class="value">{{ $myAgenda->count() }}</div>
            <div class="trend positive">
                +{{ $myAgenda->where('created_at', '>=', now()->subDays(7))->count() }} minggu ini
            </div>
        </div>

        <div class="stat-card stat-surveys">
            <div class="header">
                <div class="title">Survey Saya</div>
                <div class="icon">
                    <i class="fas fa-poll"></i>
                </div>
            </div>
            <div class="value">{{ $mySurveys->count() }}</div>
            <div class="trend {{ $mySurveys->where('status', 'pending')->count() > 0 ? 'warning' : '' }}">
                {{ $mySurveys->where('status', 'pending')->count() }} pending
            </div>
        </div>

        <div class="stat-card stat-approved">
            <div class="header">
                <div class="title">Telah Disetujui</div>
                <div class="icon">
                    <i class="fas fa-check-circle"></i>
                </div>
            </div>
            <div class="value">
                {{ $myNews->where('status', 'approved')->count() + $myAgenda->where('status', 'approved')->count() }}
            </div>
            <div class="trend positive">
                @if($myVideos)
                +{{ $myVideos->where('status', 'approved')->count() }} video
                @endif
            </div>
        </div>
    </div>

    <!-- Content Grid -->
    <div class="content-grid">
        <!-- Berita Section -->
        <div class="content-card">
            <div class="card-header">
                <h3><i class="fas fa-newspaper"></i> Berita Saya</h3>
                <div class="card-actions">
                    <a href="{{ route('staff.news.create') }}" class="btn btn-primary btn-sm">
                        <i class="fas fa-plus"></i> Baru
                    </a>
                    <a href="{{ route('staff.news.index') }}" class="btn btn-outline btn-sm">
                        Semua
                    </a>
                </div>
            </div>
            
            <div class="card-content">
                @if($myNews->count() > 0)
                    <div class="items-list">
                        @foreach($myNews->take(4) as $news)
                            <div class="list-item">
                                <div class="item-header">
                                    <div class="item-title text-truncate">{{ $news->title }}</div>
                                    <span class="status-badge status-{{ $news->status }}">
                                        {{ ucfirst($news->status) }}
                                    </span>
                                </div>
                                
                                <div class="item-meta">
                                    <div class="meta-item">
                                        <i class="far fa-calendar"></i>
                                        {{ $news->created_at->format('d M Y') }}
                                    </div>
                                    @if($news->views)
                                    <div class="meta-item">
                                        <i class="far fa-eye"></i>
                                        {{ $news->views }}
                                    </div>
                                    @endif
                                </div>
                                
                                <div class="item-actions">
                                    <a href="{{ route('staff.news.edit', $news->id) }}" class="btn btn-secondary btn-sm">
                                        <i class="fas fa-edit"></i> Edit
                                    </a>
                                    <form action="{{ route('staff.news.destroy', $news->id) }}" method="POST" class="form-delete">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm" 
                                                onclick="return confirm('Hapus berita ini?')">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    
                    @if($myNews->count() > 4)
                        <div class="view-all">
                            <a href="{{ route('staff.news.index') }}" class="view-all-link">
                                Lihat semua berita
                                <i class="fas fa-arrow-right"></i>
                            </a>
                        </div>
                    @endif
                @else
                    <div class="empty-state">
                        <div class="icon">
                            <i class="fas fa-newspaper"></i>
                        </div>
                        <div class="text">Belum ada berita yang dibuat</div>
                        <a href="{{ route('staff.news.create') }}" class="btn btn-primary btn-sm">
                            <i class="fas fa-plus"></i> Buat Berita
                        </a>
                    </div>
                @endif
            </div>
        </div>

        <!-- Agenda Section -->
        <div class="content-card">
            <div class="card-header">
                <h3><i class="fas fa-calendar-alt"></i> Agenda Saya</h3>
                <div class="card-actions">
                    <a href="{{ route('staff.agenda.create') }}" class="btn btn-primary btn-sm">
                        <i class="fas fa-plus"></i> Baru
                    </a>
                    <a href="{{ route('staff.agenda.index') }}" class="btn btn-outline btn-sm">
                        Semua
                    </a>
                </div>
            </div>
            
            <div class="card-content">
                @if($myAgenda->count() > 0)
                    <div class="items-list">
                        @foreach($myAgenda->take(4) as $agenda)
                            <div class="list-item">
                                <div class="item-header">
                                    <div class="item-title text-truncate">{{ $agenda->title }}</div>
                                    <span class="status-badge status-{{ $agenda->status }}">
                                        {{ ucfirst($agenda->status) }}
                                    </span>
                                </div>
                                
                                <div class="item-meta">
                                    <div class="meta-item">
                                        <i class="fas fa-calendar-day"></i>
                                        {{ \Carbon\Carbon::parse($agenda->date)->format('d M Y') }}
                                    </div>
                                    @if($agenda->time)
                                    <div class="meta-item">
                                        <i class="fas fa-clock"></i>
                                        {{ $agenda->time }}
                                    </div>
                                    @endif
                                </div>
                                
                                <div class="item-actions">
                                    <a href="{{ route('staff.agenda.edit', $agenda->id) }}" class="btn btn-secondary btn-sm">
                                        <i class="fas fa-edit"></i> Edit
                                    </a>
                                    <form action="{{ route('staff.agenda.destroy', $agenda->id) }}" method="POST" class="form-delete">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm"
                                                onclick="return confirm('Hapus agenda ini?')">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    
                    @if($myAgenda->count() > 4)
                        <div class="view-all">
                            <a href="{{ route('staff.agenda.index') }}" class="view-all-link">
                                Lihat semua agenda
                                <i class="fas fa-arrow-right"></i>
                            </a>
                        </div>
                    @endif
                @else
                    <div class="empty-state">
                        <div class="icon">
                            <i class="fas fa-calendar-alt"></i>
                        </div>
                        <div class="text">Belum ada agenda yang dibuat</div>
                        <a href="{{ route('staff.agenda.create') }}" class="btn btn-primary btn-sm">
                            <i class="fas fa-plus"></i> Buat Agenda
                        </a>
                    </div>
                @endif
            </div>
        </div>


    <!-- Recent Activity -->
    <div class="activity-card">
        <div class="card-header">
            <h3><i class="fas fa-history"></i> Aktivitas Terbaru</h3>
        </div>
        
        <div class="activity-list">
            @php
                $recentNews = $myNews->sortByDesc('created_at')->take(2);
                $recentAgenda = $myAgenda->sortByDesc('created_at')->take(2);
                $recentActivity = $recentNews->concat($recentAgenda)->sortByDesc('created_at')->take(5);
            @endphp
            
            @forelse($recentActivity as $activity)
                <div class="activity-item">
                    <div class="activity-icon">
                        <i class="{{ isset($activity->date) ? 'fas fa-calendar' : 'fas fa-newspaper' }}"></i>
                    </div>
                    <div class="activity-content">
                        <div class="activity-title">{{ $activity->title }}</div>
                        <div class="activity-meta">
                            <span class="status-badge status-{{ $activity->status }}">
                                {{ ucfirst($activity->status) }}
                            </span>
                            <span class="activity-type">
                                {{ isset($activity->date) ? 'Agenda' : 'Berita' }}
                            </span>
                            <span>{{ $activity->created_at->diffForHumans() }}</span>
                        </div>
                    </div>
                </div>
            @empty
                <div class="empty-state" style="padding: 40px 20px;">
                    <div class="icon">
                        <i class="fas fa-history"></i>
                    </div>
                    <div class="text">Belum ada aktivitas terbaru</div>
                </div>
            @endforelse
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Delete confirmation
        const deleteForms = document.querySelectorAll('.form-delete');
        deleteForms.forEach(form => {
            const button = form.querySelector('button[type="submit"]');
            if (button) {
                button.addEventListener('click', function(e) {
                    if (!confirm('Apakah Anda yakin ingin menghapus item ini?')) {
                        e.preventDefault();
                    }
                });
            }
        });

        function handleResize() {
            const cards = document.querySelectorAll('.content-card');
            const isMobile = window.innerWidth < 768;
            
            cards.forEach(card => {
                const itemActions = card.querySelectorAll('.item-actions');
                itemActions.forEach(actions => {
                    if (isMobile) {
                        actions.style.flexDirection = 'column';
                        actions.style.alignItems = 'stretch';
                    } else {
                        actions.style.flexDirection = 'row';
                        actions.style.alignItems = 'center';
                    }
                });
            });
        }
        
        // Initial check
        handleResize();
        
        // Listen for resize
        window.addEventListener('resize', handleResize);
        
        // Add loading state to buttons
        const primaryButtons = document.querySelectorAll('.btn-primary');
        primaryButtons.forEach(button => {
            button.addEventListener('click', function(e) {
                if (!this.href.includes('javascript')) {
                    this.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Loading...';
                    this.disabled = true;
                }
            });
        });
    });
</script>
@endsection