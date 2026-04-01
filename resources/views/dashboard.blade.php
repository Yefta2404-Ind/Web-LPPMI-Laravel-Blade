@extends('layouts.cms')

@section('title', 'Dashboard Staff')
@section('content-subtitle', 'Kelola konten dan aktivitas Anda')

@section('content')
<style>
    :root {
        --primary: #0f2a44;
        --primary-dark: #0a1e32;
        --primary-light: #1e3a5f;
        --secondary: #2563eb;
        --secondary-dark: #1d4ed8;
        --secondary-light: #3b82f6;
        --success: #10b981;
        --success-light: #d1fae5;
        --warning: #f59e0b;
        --warning-light: #fef3c7;
        --danger: #ef4444;
        --danger-light: #fee2e2;
        --purple: #8b5cf6;
        --purple-light: #ede9fe;
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
        --radius-lg: 24px;
        --radius-md: 20px;
        --radius-sm: 16px;
        --radius-xs: 12px;
        --shadow-sm: 0 1px 2px 0 rgba(0, 0, 0, 0.03);
        --shadow-md: 0 4px 6px -1px rgba(0, 0, 0, 0.05), 0 2px 4px -2px rgba(0, 0, 0, 0.03);
        --shadow-lg: 0 10px 15px -3px rgba(0, 0, 0, 0.08), 0 4px 6px -4px rgba(0, 0, 0, 0.04);
        --shadow-xl: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 8px 10px -6px rgba(0, 0, 0, 0.05);
        --transition: all 0.25s cubic-bezier(0.4, 0, 0.2, 1);
    }

    .dashboard-container {
        padding: 24px;
        max-width: 1400px;
        margin: 0 auto;
    }

    /* Welcome Section - Enhanced with Blue Gradient */
    .welcome-card {
        background: linear-gradient(135deg, var(--primary) 0%, #1e3a8a 50%, var(--secondary) 100%);
        border-radius: var(--radius-lg);
        padding: 32px 36px;
        margin-bottom: 32px;
        color: white;
        position: relative;
        overflow: hidden;
        box-shadow: var(--shadow-lg);
    }
    
    .welcome-card::before {
        content: "📰";
        position: absolute;
        right: 20px;
        top: 20px;
        font-size: 80px;
        opacity: 0.08;
        pointer-events: none;
    }
    
    .welcome-card::after {
        content: "";
        position: absolute;
        bottom: -30px;
        right: -30px;
        width: 150px;
        height: 150px;
        background: radial-gradient(circle, rgba(255,255,255,0.1) 0%, transparent 70%);
        border-radius: 50%;
        pointer-events: none;
    }
    
    .welcome-card h1 {
        font-size: 28px;
        font-weight: 800;
        margin-bottom: 8px;
        letter-spacing: -0.3px;
    }
    
    .welcome-card p {
        font-size: 14px;
        opacity: 0.85;
        margin-bottom: 20px;
    }
    
    .date-badge {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        background: rgba(255,255,255,0.2);
        backdrop-filter: blur(10px);
        padding: 8px 16px;
        border-radius: 40px;
        font-size: 13px;
        font-weight: 500;
        border: 1px solid rgba(255,255,255,0.2);
    }

    /* Quick Actions - Enhanced */
    .quick-actions {
        display: flex;
        flex-wrap: wrap;
        gap: 12px;
        margin-bottom: 32px;
    }
    
    .action-btn {
        display: inline-flex;
        align-items: center;
        gap: 10px;
        padding: 12px 24px;
        border-radius: var(--radius-xs);
        font-size: 14px;
        font-weight: 600;
        text-decoration: none;
        transition: var(--transition);
        background: white;
        border: 1px solid var(--gray-200);
        color: var(--gray-700);
        box-shadow: var(--shadow-sm);
    }
    
    .action-btn:hover {
        transform: translateY(-3px);
        box-shadow: var(--shadow-md);
        border-color: var(--secondary);
        color: var(--secondary);
    }
    
    .action-btn-primary {
        background: linear-gradient(135deg, var(--secondary), var(--secondary-dark));
        border: none;
        color: white;
        box-shadow: var(--shadow-sm);
    }
    
    .action-btn-primary:hover {
        background: linear-gradient(135deg, var(--secondary-dark), var(--secondary));
        transform: translateY(-3px);
        box-shadow: var(--shadow-md);
        color: white;
    }

    /* Stats Grid - Enhanced */
    .stats-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(260px, 1fr));
        gap: 24px;
        margin-bottom: 32px;
    }
    
    .stat-card {
        background: white;
        border-radius: var(--radius-md);
        padding: 24px;
        box-shadow: var(--shadow-sm);
        transition: var(--transition);
        text-decoration: none;
        display: flex;
        align-items: center;
        justify-content: space-between;
        border: 1px solid rgba(37, 99, 235, 0.08);
        position: relative;
        overflow: hidden;
    }
    
    .stat-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 3px;
        background: linear-gradient(90deg, var(--secondary), var(--secondary-light));
        transform: scaleX(0);
        transition: transform 0.3s ease;
    }
    
    .stat-card:hover::before {
        transform: scaleX(1);
    }
    
    .stat-card:hover {
        transform: translateY(-4px);
        box-shadow: var(--shadow-lg);
        border-color: rgba(37, 99, 235, 0.2);
    }
    
    .stat-info h3 {
        font-size: 12px;
        font-weight: 600;
        color: var(--gray-500);
        text-transform: uppercase;
        letter-spacing: 0.5px;
        margin-bottom: 8px;
    }
    
    .stat-number {
        font-size: 36px;
        font-weight: 800;
        color: var(--gray-800);
        margin-bottom: 6px;
        line-height: 1;
    }
    
    .stat-trend {
        font-size: 12px;
        color: var(--success);
        font-weight: 500;
        display: flex;
        align-items: center;
        gap: 4px;
    }
    
    .stat-icon {
        width: 56px;
        height: 56px;
        border-radius: 18px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 28px;
    }
    
    .stat-icon.news { 
        background: linear-gradient(135deg, #eff6ff, #dbeafe); 
        color: var(--secondary); 
    }
    .stat-icon.agenda { 
        background: linear-gradient(135deg, #ecfdf5, #d1fae5); 
        color: var(--success); 
    }
    .stat-icon.approved { 
        background: linear-gradient(135deg, #f5f3ff, #ede9fe); 
        color: var(--purple); 
    }

    /* Content Grid */
    .content-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(380px, 1fr));
        gap: 28px;
        margin-bottom: 32px;
    }
    
    .card {
        background: white;
        border-radius: var(--radius-md);
        box-shadow: var(--shadow-sm);
        border: 1px solid rgba(37, 99, 235, 0.08);
        overflow: hidden;
        transition: var(--transition);
    }
    
    .card:hover {
        box-shadow: var(--shadow-md);
        border-color: rgba(37, 99, 235, 0.15);
    }
    
    .card-header {
        padding: 20px 24px;
        border-bottom: 1px solid var(--gray-100);
        display: flex;
        justify-content: space-between;
        align-items: center;
        background: linear-gradient(135deg, white, var(--gray-50));
    }
    
    .card-header h3 {
        font-size: 17px;
        font-weight: 700;
        color: var(--gray-800);
        display: flex;
        align-items: center;
        gap: 10px;
    }
    
    .btn-sm {
        padding: 8px 16px;
        border-radius: 40px;
        font-size: 12px;
        font-weight: 600;
        text-decoration: none;
        transition: var(--transition);
        display: inline-flex;
        align-items: center;
        gap: 6px;
        cursor: pointer;
    }
    
    .btn-primary-sm {
        background: linear-gradient(135deg, var(--secondary), var(--secondary-dark));
        color: white;
        border: none;
    }
    
    .btn-primary-sm:hover {
        transform: translateY(-2px);
        box-shadow: var(--shadow-sm);
    }
    
    .btn-outline-sm {
        background: white;
        color: var(--gray-700);
        border: 1px solid var(--gray-200);
    }
    
    .btn-outline-sm:hover {
        background: var(--gray-50);
        border-color: var(--secondary);
        color: var(--secondary);
        transform: translateY(-1px);
    }
    
    .card-content {
        padding: 20px 24px;
        max-height: 460px;
        overflow-y: auto;
    }
    
    /* Custom Scrollbar */
    .card-content::-webkit-scrollbar {
        width: 5px;
    }
    
    .card-content::-webkit-scrollbar-track {
        background: var(--gray-100);
        border-radius: 10px;
    }
    
    .card-content::-webkit-scrollbar-thumb {
        background: var(--secondary-light);
        border-radius: 10px;
    }
    
    /* Item List - Enhanced */
    .item {
        padding: 16px;
        border: 1px solid var(--gray-100);
        border-radius: var(--radius-xs);
        margin-bottom: 14px;
        transition: var(--transition);
        background: white;
    }
    
    .item:hover {
        border-color: var(--secondary-light);
        box-shadow: var(--shadow-sm);
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
        font-weight: 700;
        color: var(--gray-800);
        font-size: 14px;
        flex: 1;
        line-height: 1.4;
    }
    
    .badge {
        padding: 5px 12px;
        border-radius: 30px;
        font-size: 10px;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.3px;
        white-space: nowrap;
    }
    
    .badge-draft { background: var(--gray-100); color: var(--gray-600); }
    .badge-pending { background: var(--warning-light); color: #b45309; }
    .badge-approved { background: var(--success-light); color: #065f46; }
    .badge-rejected { background: var(--danger-light); color: #991b1b; }
    
    .item-meta {
        display: flex;
        gap: 16px;
        font-size: 11px;
        color: var(--gray-500);
        margin-bottom: 14px;
        flex-wrap: wrap;
    }
    
    .item-meta i {
        width: 14px;
        color: var(--secondary);
        opacity: 0.7;
    }
    
    .item-actions {
        display: flex;
        gap: 10px;
    }
    
    .btn-icon {
        padding: 6px 14px;
        border-radius: 8px;
        font-size: 11px;
        font-weight: 500;
        text-decoration: none;
        transition: var(--transition);
        background: var(--gray-50);
        color: var(--gray-600);
        border: 1px solid var(--gray-200);
        cursor: pointer;
        display: inline-flex;
        align-items: center;
        gap: 6px;
    }
    
    .btn-icon:hover {
        background: var(--gray-100);
        border-color: var(--gray-300);
        transform: translateY(-1px);
    }
    
    .btn-danger-sm {
        color: var(--danger);
    }
    
    .btn-danger-sm:hover {
        background: var(--danger-light);
        border-color: var(--danger);
        color: var(--danger);
    }
    
    /* Empty State - Enhanced */
    .empty-state {
        text-align: center;
        padding: 48px 24px;
    }
    
    .empty-state i {
        font-size: 56px;
        background: linear-gradient(135deg, var(--gray-300), var(--gray-400));
        -webkit-background-clip: text;
        background-clip: text;
        color: transparent;
        margin-bottom: 16px;
        display: inline-block;
    }
    
    .empty-state p {
        color: var(--gray-500);
        font-size: 13px;
        margin-bottom: 20px;
    }
    
    /* Activity Feed - Enhanced */
    .activity-feed {
        background: white;
        border-radius: var(--radius-md);
        border: 1px solid rgba(37, 99, 235, 0.08);
        overflow: hidden;
        box-shadow: var(--shadow-sm);
    }
    
    .activity-item {
        padding: 18px 24px;
        border-bottom: 1px solid var(--gray-100);
        display: flex;
        align-items: center;
        gap: 14px;
        transition: var(--transition);
    }
    
    .activity-item:hover {
        background: linear-gradient(135deg, white, var(--gray-50));
        transform: translateX(2px);
    }
    
    .activity-icon {
        width: 44px;
        height: 44px;
        border-radius: 14px;
        background: linear-gradient(135deg, var(--gray-100), var(--gray-50));
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 18px;
        color: var(--secondary);
        flex-shrink: 0;
    }
    
    .activity-content {
        flex: 1;
    }
    
    .activity-title {
        font-weight: 600;
        color: var(--gray-800);
        font-size: 13px;
        margin-bottom: 6px;
        line-height: 1.4;
    }
    
    .activity-meta {
        font-size: 11px;
        color: var(--gray-500);
        display: flex;
        gap: 12px;
        align-items: center;
        flex-wrap: wrap;
    }
    
    .activity-meta .badge {
        padding: 3px 10px;
        font-size: 9px;
    }
    
    /* Responsive */
    @media (max-width: 768px) {
        .dashboard-container { padding: 16px; }
        .welcome-card { padding: 24px; }
        .welcome-card h1 { font-size: 22px; }
        .stats-grid { gap: 16px; }
        .content-grid { gap: 20px; grid-template-columns: 1fr; }
        .card-header { padding: 16px 20px; }
        .card-content { padding: 16px 20px; }
        .stat-number { font-size: 28px; }
        .stat-icon { width: 48px; height: 48px; font-size: 24px; }
        .action-btn { padding: 10px 18px; font-size: 13px; }
    }
    
    @media (max-width: 480px) {
        .quick-actions { flex-direction: column; }
        .action-btn { width: 100%; justify-content: center; }
        .item-header { flex-direction: column; align-items: flex-start; }
        .activity-item { padding: 14px 16px; }
        .activity-icon { width: 36px; height: 36px; font-size: 14px; }
    }
</style>

<div class="dashboard-container">
    {{-- Welcome Section --}}
    <div class="welcome-card">
        <h1>Halo, {{ auth()->user()->name ?? 'Staff' }}! 👋</h1>
        <p>Selamat datang kembali. Kelola konten dan pantau aktivitas Anda di sini.</p>
        <span class="date-badge">
            <i class="far fa-calendar-alt"></i> {{ now()->translatedFormat('l, d F Y') }}
        </span>
    </div>

    {{-- Quick Actions --}}
    <div class="quick-actions">
        <a href="{{ route('staff.news.create') }}" class="action-btn action-btn-primary">
            <i class="fas fa-plus-circle"></i> Buat Berita
        </a>
        <a href="{{ route('staff.agenda.create') }}" class="action-btn">
            <i class="fas fa-calendar-plus"></i> Tambah Agenda
        </a>
        <a href="{{ route('staff.password.edit') }}" class="action-btn">
            <i class="fas fa-key"></i> Ganti Password
        </a>
    </div>

    {{-- Statistics --}}
    <div class="stats-grid">
        <a href="{{ route('staff.news.index') }}" class="stat-card">
            <div class="stat-info">
                <h3>Total Berita</h3>
                <div class="stat-number">{{ $myNews->count() }}</div>
                <div class="stat-trend">
                    <i class="fas fa-arrow-up"></i> +{{ $myNews->where('created_at', '>=', now()->subDays(7))->count() }} minggu ini
                </div>
            </div>
            <div class="stat-icon news">
                <i class="fas fa-newspaper"></i>
            </div>
        </a>

        <a href="{{ route('staff.agenda.index') }}" class="stat-card">
            <div class="stat-info">
                <h3>Total Agenda</h3>
                <div class="stat-number">{{ $myAgenda->count() }}</div>
                <div class="stat-trend">
                    <i class="fas fa-arrow-up"></i> +{{ $myAgenda->where('created_at', '>=', now()->subDays(7))->count() }} minggu ini
                </div>
            </div>
            <div class="stat-icon agenda">
                <i class="fas fa-calendar-alt"></i>
            </div>
        </a>

        <div class="stat-card">
            <div class="stat-info">
                <h3>Konten Aktif</h3>
                <div class="stat-number">
                    {{ $myNews->where('status','approved')->count() +
                       $myAgenda->where('status','approved')->count() }}
                </div>
                <div class="stat-trend">
                    <i class="fas fa-check-circle"></i> Telah disetujui
                </div>
            </div>
            <div class="stat-icon approved">
                <i class="fas fa-check-circle"></i>
            </div>
        </div>
    </div>

    {{-- Content Grid --}}
    <div class="content-grid">
        {{-- Berita Card --}}
        <div class="card">
            <div class="card-header">
                <h3><i class="fas fa-newspaper" style="color: var(--secondary);"></i> Berita Terbaru</h3>
                <div>
                    <a href="{{ route('staff.news.create') }}" class="btn-sm btn-primary-sm">
                        <i class="fas fa-plus"></i> Baru
                    </a>
                </div>
            </div>
            <div class="card-content">
                @if($myNews->count())
                    @foreach($myNews->take(4) as $news)
                        <div class="item">
                            <div class="item-header">
                                <div class="item-title">{{ Str::limit($news->title, 55) }}</div>
                                <span class="badge badge-{{ $news->status }}">{{ ucfirst($news->status) }}</span>
                            </div>
                            <div class="item-meta">
                                <span><i class="far fa-calendar"></i> {{ $news->created_at->format('d M Y') }}</span>
                                @if($news->views)
                                <span><i class="far fa-eye"></i> {{ number_format($news->views) }}x</span>
                                @endif
                            </div>
                            <div class="item-actions">
                                <a href="{{ route('staff.news.edit', $news->id) }}" class="btn-icon">
                                    <i class="fas fa-edit"></i> Edit
                                </a>
                                <form action="{{ route('staff.news.destroy', $news->id) }}" method="POST" style="display: inline;">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="btn-icon btn-danger-sm" onclick="return confirm('Hapus berita ini?')">
                                        <i class="fas fa-trash"></i> Hapus
                                    </button>
                                </form>
                            </div>
                        </div>
                    @endforeach
                    @if($myNews->count() > 4)
                        <div style="text-align: center; margin-top: 16px;">
                            <a href="{{ route('staff.news.index') }}" style="color: var(--secondary); text-decoration: none; font-size: 12px; font-weight: 500;">
                                Lihat semua <i class="fas fa-arrow-right"></i>
                            </a>
                        </div>
                    @endif
                @else
                    <div class="empty-state">
                        <i class="fas fa-newspaper"></i>
                        <p>Belum ada berita</p>
                        <a href="{{ route('staff.news.create') }}" class="btn-sm btn-primary-sm">Buat Berita</a>
                    </div>
                @endif
            </div>
        </div>

        {{-- Agenda Card --}}
        <div class="card">
            <div class="card-header">
                <h3><i class="fas fa-calendar-alt" style="color: var(--success);"></i> Agenda Mendatang</h3>
                <div>
                    <a href="{{ route('staff.agenda.create') }}" class="btn-sm btn-primary-sm">
                        <i class="fas fa-plus"></i> Baru
                    </a>
                </div>
            </div>
            <div class="card-content">
                @if($myAgenda->count())
                    @foreach($myAgenda->take(4) as $agenda)
                        <div class="item">
                            <div class="item-header">
                                <div class="item-title">{{ Str::limit($agenda->title, 55) }}</div>
                                <span class="badge badge-{{ $agenda->status }}">{{ ucfirst($agenda->status) }}</span>
                            </div>
                            <div class="item-meta">
                                <span><i class="fas fa-calendar-day"></i> {{ \Carbon\Carbon::parse($agenda->date)->translatedFormat('d M Y') }}</span>
                                @if($agenda->time)
                                <span><i class="fas fa-clock"></i> {{ \Carbon\Carbon::parse($agenda->time)->format('H:i') }}</span>
                                @endif
                            </div>
                            <div class="item-actions">
                                <a href="{{ route('staff.agenda.edit', $agenda->id) }}" class="btn-icon">
                                    <i class="fas fa-edit"></i> Edit
                                </a>
                                <form action="{{ route('staff.agenda.destroy', $agenda->id) }}" method="POST" style="display: inline;">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="btn-icon btn-danger-sm" onclick="return confirm('Hapus agenda ini?')">
                                        <i class="fas fa-trash"></i> Hapus
                                    </button>
                                </form>
                            </div>
                        </div>
                    @endforeach
                    @if($myAgenda->count() > 4)
                        <div style="text-align: center; margin-top: 16px;">
                            <a href="{{ route('staff.agenda.index') }}" style="color: var(--secondary); text-decoration: none; font-size: 12px; font-weight: 500;">
                                Lihat semua <i class="fas fa-arrow-right"></i>
                            </a>
                        </div>
                    @endif
                @else
                    <div class="empty-state">
                        <i class="fas fa-calendar-alt"></i>
                        <p>Belum ada agenda</p>
                        <a href="{{ route('staff.agenda.create') }}" class="btn-sm btn-primary-sm">Tambah Agenda</a>
                    </div>
                @endif
            </div>
        </div>
    </div>

    {{-- Activity Feed --}}
    <div class="activity-feed">
        <div class="card-header">
            <h3><i class="fas fa-history" style="color: var(--secondary);"></i> Aktivitas Terkini</h3>
        </div>
        @php
            $recentActivity = collect()
                ->concat($myNews->map(fn($n) => (object)[
                    'title' => $n->title,
                    'status' => $n->status,
                    'type' => 'Berita',
                    'icon' => 'fa-newspaper',
                    'created_at' => $n->created_at
                ]))
                ->concat($myAgenda->map(fn($a) => (object)[
                    'title' => $a->title,
                    'status' => $a->status,
                    'type' => 'Agenda',
                    'icon' => 'fa-calendar-alt',
                    'created_at' => $a->created_at
                ]))
                ->sortByDesc('created_at')
                ->take(6);
        @endphp

        @forelse($recentActivity as $activity)
            <div class="activity-item">
                <div class="activity-icon">
                    <i class="fas {{ $activity->icon }}"></i>
                </div>
                <div class="activity-content">
                    <div class="activity-title">{{ Str::limit($activity->title, 65) }}</div>
                    <div class="activity-meta">
                        <span class="badge badge-{{ $activity->status }}" style="padding: 3px 10px;">{{ ucfirst($activity->status) }}</span>
                        <span><i class="fas fa-tag"></i> {{ $activity->type }}</span>
                        <span><i class="far fa-clock"></i> {{ $activity->created_at->diffForHumans() }}</span>
                    </div>
                </div>
            </div>
        @empty
            <div class="empty-state" style="padding: 48px;">
                <i class="fas fa-inbox"></i>
                <p>Belum ada aktivitas</p>
            </div>
        @endforelse
    </div>
</div>
@endsection