@extends('layouts.cms')

@section('title', 'Dashboard Staff')
@section('content-subtitle', 'Kelola konten dan aktivitas Anda')

@section('content')
<style>
    :root {
        --primary: #0f2a44;
        --secondary: #3b82f6;
        --success: #10b981;
        --warning: #f59e0b;
        --danger: #ef4444;
        --purple: #8b5cf6;
        --gray-50: #f9fafb;
        --gray-100: #f3f4f6;
        --gray-200: #e5e7eb;
        --gray-300: #d1d5db;
        --gray-600: #4b5563;
        --gray-700: #374151;
        --gray-800: #1f2937;
    }

    .dashboard-container {
        padding: 24px;
        max-width: 1400px;
        margin: 0 auto;
    }

    /* Welcome Section */
    .welcome-card {
        background: linear-gradient(135deg, var(--primary) 0%, #1e3a8a 100%);
        border-radius: 16px;
        padding: 28px 32px;
        margin-bottom: 28px;
        color: white;
        position: relative;
        overflow: hidden;
    }
    
    .welcome-card::before {
        content: "✨";
        position: absolute;
        right: 20px;
        top: 20px;
        font-size: 60px;
        opacity: 0.1;
        pointer-events: none;
    }
    
    .welcome-card h1 {
        font-size: 24px;
        font-weight: 700;
        margin-bottom: 8px;
    }
    
    .welcome-card p {
        font-size: 14px;
        opacity: 0.9;
        margin-bottom: 20px;
    }
    
    .date-badge {
        display: inline-block;
        background: rgba(255,255,255,0.2);
        padding: 6px 12px;
        border-radius: 20px;
        font-size: 12px;
        backdrop-filter: blur(10px);
    }

    /* Quick Actions */
    .quick-actions {
        display: flex;
        flex-wrap: wrap;
        gap: 12px;
        margin-bottom: 28px;
    }
    
    .action-btn {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        padding: 10px 20px;
        border-radius: 12px;
        font-size: 13px;
        font-weight: 500;
        text-decoration: none;
        transition: all 0.2s;
        background: white;
        border: 1px solid var(--gray-200);
        color: var(--gray-700);
    }
    
    .action-btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(0,0,0,0.1);
        border-color: var(--secondary);
    }
    
    .action-btn-primary {
        background: var(--secondary);
        border-color: var(--secondary);
        color: white;
    }
    
    .action-btn-primary:hover {
        background: #2563eb;
        transform: translateY(-2px);
    }

    /* Stats Grid */
    .stats-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(240px, 1fr));
        gap: 20px;
        margin-bottom: 32px;
    }
    
    .stat-card {
        background: white;
        border-radius: 16px;
        padding: 20px;
        box-shadow: 0 1px 3px rgba(0,0,0,0.1);
        transition: all 0.2s;
        text-decoration: none;
        display: flex;
        align-items: center;
        justify-content: space-between;
        border: 1px solid var(--gray-200);
    }
    
    .stat-card:hover {
        transform: translateY(-3px);
        box-shadow: 0 8px 20px rgba(0,0,0,0.1);
    }
    
    .stat-info h3 {
        font-size: 12px;
        font-weight: 500;
        color: var(--gray-600);
        text-transform: uppercase;
        letter-spacing: 0.5px;
        margin-bottom: 8px;
    }
    
    .stat-number {
        font-size: 32px;
        font-weight: 800;
        color: var(--gray-800);
        margin-bottom: 4px;
    }
    
    .stat-trend {
        font-size: 11px;
        color: var(--success);
        font-weight: 500;
    }
    
    .stat-icon {
        width: 48px;
        height: 48px;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 24px;
    }
    
    .stat-icon.news { background: #eff6ff; color: var(--secondary); }
    .stat-icon.agenda { background: #ecfdf5; color: var(--success); }
    .stat-icon.approved { background: #f5f3ff; color: var(--purple); }

    /* Content Grid */
    .content-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(360px, 1fr));
        gap: 24px;
        margin-bottom: 32px;
    }
    
    .card {
        background: white;
        border-radius: 16px;
        box-shadow: 0 1px 3px rgba(0,0,0,0.1);
        border: 1px solid var(--gray-200);
        overflow: hidden;
    }
    
    .card-header {
        padding: 18px 20px;
        border-bottom: 1px solid var(--gray-200);
        display: flex;
        justify-content: space-between;
        align-items: center;
        background: var(--gray-50);
    }
    
    .card-header h3 {
        font-size: 16px;
        font-weight: 600;
        color: var(--gray-800);
        display: flex;
        align-items: center;
        gap: 8px;
    }
    
    .btn-sm {
        padding: 6px 12px;
        border-radius: 8px;
        font-size: 12px;
        font-weight: 500;
        text-decoration: none;
        transition: all 0.2s;
        display: inline-flex;
        align-items: center;
        gap: 6px;
    }
    
    .btn-primary-sm {
        background: var(--secondary);
        color: white;
        border: none;
    }
    
    .btn-outline-sm {
        background: white;
        color: var(--gray-700);
        border: 1px solid var(--gray-300);
    }
    
    .btn-outline-sm:hover {
        background: var(--gray-50);
    }
    
    .card-content {
        padding: 20px;
        max-height: 420px;
        overflow-y: auto;
    }
    
    /* Item List */
    .item {
        padding: 14px;
        border: 1px solid var(--gray-200);
        border-radius: 12px;
        margin-bottom: 12px;
        transition: all 0.2s;
        background: white;
    }
    
    .item:hover {
        border-color: var(--secondary);
        box-shadow: 0 2px 8px rgba(59,130,246,0.1);
    }
    
    .item-header {
        display: flex;
        justify-content: space-between;
        align-items: flex-start;
        margin-bottom: 10px;
    }
    
    .item-title {
        font-weight: 600;
        color: var(--gray-800);
        font-size: 14px;
        flex: 1;
        margin-right: 10px;
    }
    
    .badge {
        padding: 4px 10px;
        border-radius: 20px;
        font-size: 10px;
        font-weight: 600;
        text-transform: uppercase;
        white-space: nowrap;
    }
    
    .badge-draft { background: var(--gray-100); color: var(--gray-600); }
    .badge-pending { background: #fef3c7; color: #92400e; }
    .badge-approved { background: #d1fae5; color: #065f46; }
    
    .item-meta {
        display: flex;
        gap: 12px;
        font-size: 11px;
        color: var(--gray-600);
        margin-bottom: 12px;
    }
    
    .item-actions {
        display: flex;
        gap: 8px;
    }
    
    .btn-icon {
        padding: 6px 10px;
        border-radius: 6px;
        font-size: 11px;
        font-weight: 500;
        text-decoration: none;
        transition: all 0.2s;
        background: var(--gray-100);
        color: var(--gray-700);
        border: none;
        cursor: pointer;
    }
    
    .btn-icon:hover {
        background: var(--gray-200);
    }
    
    .btn-danger-sm {
        color: var(--danger);
    }
    
    .btn-danger-sm:hover {
        background: var(--danger);
        color: white;
    }
    
    .empty-state {
        text-align: center;
        padding: 40px 20px;
    }
    
    .empty-state i {
        font-size: 48px;
        color: var(--gray-300);
        margin-bottom: 12px;
    }
    
    .empty-state p {
        color: var(--gray-600);
        font-size: 13px;
        margin-bottom: 16px;
    }
    
    /* Activity Feed */
    .activity-feed {
        background: white;
        border-radius: 16px;
        border: 1px solid var(--gray-200);
        overflow: hidden;
    }
    
    .activity-item {
        padding: 16px 20px;
        border-bottom: 1px solid var(--gray-100);
        display: flex;
        align-items: center;
        gap: 12px;
        transition: background 0.2s;
    }
    
    .activity-item:hover {
        background: var(--gray-50);
    }
    
    .activity-icon {
        width: 40px;
        height: 40px;
        border-radius: 10px;
        background: var(--gray-100);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 16px;
        color: var(--gray-600);
    }
    
    .activity-content {
        flex: 1;
    }
    
    .activity-title {
        font-weight: 500;
        color: var(--gray-800);
        font-size: 13px;
        margin-bottom: 4px;
    }
    
    .activity-meta {
        font-size: 11px;
        color: var(--gray-600);
        display: flex;
        gap: 12px;
        align-items: center;
        flex-wrap: wrap;
    }
    
    @media (max-width: 768px) {
        .dashboard-container { padding: 16px; }
        .welcome-card { padding: 20px; }
        .stats-grid { gap: 12px; }
        .content-grid { gap: 16px; }
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
                                <div class="item-title">{{ Str::limit($news->title, 50) }}</div>
                                <span class="badge badge-{{ $news->status }}">{{ ucfirst($news->status) }}</span>
                            </div>
                            <div class="item-meta">
                                <span><i class="far fa-calendar"></i> {{ $news->created_at->format('d M Y') }}</span>
                                @if($news->views)
                                <span><i class="far fa-eye"></i> {{ $news->views }}x</span>
                                @endif
                            </div>
                            <div class="item-actions">
                                <a href="{{ route('staff.news.edit', $news->id) }}" class="btn-icon">
                                    <i class="fas fa-edit"></i> Edit
                                </a>
                                <form action="{{ route('staff.news.destroy', $news->id) }}" method="POST" style="display: inline;">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="btn-icon btn-danger-sm" onclick="return confirm('Hapus berita ini?')">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </div>
                    @endforeach
                    @if($myNews->count() > 4)
                        <div style="text-align: center; margin-top: 12px;">
                            <a href="{{ route('staff.news.index') }}" style="color: var(--secondary); text-decoration: none; font-size: 12px;">
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
                                <div class="item-title">{{ Str::limit($agenda->title, 50) }}</div>
                                <span class="badge badge-{{ $agenda->status }}">{{ ucfirst($agenda->status) }}</span>
                            </div>
                            <div class="item-meta">
                                <span><i class="fas fa-calendar-day"></i> {{ \Carbon\Carbon::parse($agenda->date)->format('d M Y') }}</span>
                                @if($agenda->time)
                                <span><i class="fas fa-clock"></i> {{ $agenda->time }}</span>
                                @endif
                            </div>
                            <div class="item-actions">
                                <a href="{{ route('staff.agenda.edit', $agenda->id) }}" class="btn-icon">
                                    <i class="fas fa-edit"></i> Edit
                                </a>
                                <form action="{{ route('staff.agenda.destroy', $agenda->id) }}" method="POST" style="display: inline;">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="btn-icon btn-danger-sm" onclick="return confirm('Hapus agenda ini?')">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </div>
                    @endforeach
                    @if($myAgenda->count() > 4)
                        <div style="text-align: center; margin-top: 12px;">
                            <a href="{{ route('staff.agenda.index') }}" style="color: var(--secondary); text-decoration: none; font-size: 12px;">
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
            <h3><i class="fas fa-history"></i> Aktivitas Terkini</h3>
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
                    'icon' => 'fa-calendar',
                    'created_at' => $a->created_at
                ]))
                ->sortByDesc('created_at')
                ->take(5);
        @endphp

        @forelse($recentActivity as $activity)
            <div class="activity-item">
                <div class="activity-icon">
                    <i class="fas {{ $activity->icon }}"></i>
                </div>
                <div class="activity-content">
                    <div class="activity-title">{{ Str::limit($activity->title, 60) }}</div>
                    <div class="activity-meta">
                        <span class="badge badge-{{ $activity->status }}" style="padding: 2px 8px;">{{ ucfirst($activity->status) }}</span>
                        <span><i class="fas fa-tag"></i> {{ $activity->type }}</span>
                        <span><i class="far fa-clock"></i> {{ $activity->created_at->diffForHumans() }}</span>
                    </div>
                </div>
            </div>
        @empty
            <div class="empty-state" style="padding: 40px;">
                <i class="fas fa-inbox"></i>
                <p>Belum ada aktivitas</p>
            </div>
        @endforelse
    </div>
</div>
@endsection