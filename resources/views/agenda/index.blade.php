@extends('layouts.cms')

@section('page-title', 'Agenda Saya')
@section('content')
<style>
    /* Simplified CSS Variables */
    :root {
        --primary: #2563eb;
        --primary-dark: #1d4ed8;
        --success: #10b981;
        --warning: #f59e0b;
        --danger: #ef4444;
        --gray-50: #f9fafb;
        --gray-100: #f3f4f6;
        --gray-200: #e5e7eb;
        --gray-300: #d1d5db;
        --gray-500: #6b7280;
        --gray-600: #4b5563;
        --gray-700: #374151;
        --gray-800: #1f2937;
        --shadow: 0 1px 3px rgba(0,0,0,0.1);
        --shadow-md: 0 4px 6px -1px rgba(0,0,0,0.1);
        --radius: 8px;
    }

    /* Container */
    .agenda-container {
        max-width: 1400px;
        margin: 0 auto;
        padding: 0 20px;
    }

    /* Header */
    .agenda-header-section {
        margin-bottom: 24px;
        padding-bottom: 16px;
        border-bottom: 1px solid var(--gray-200);
    }

    .agenda-title {
        font-size: 1.5rem;
        font-weight: 700;
        color: var(--gray-800);
        margin-bottom: 4px;
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .agenda-subtitle {
        color: var(--gray-600);
        font-size: 0.875rem;
    }

    /* Alerts */
    .alert {
        padding: 12px 16px;
        border-radius: var(--radius);
        margin-bottom: 20px;
        display: flex;
        align-items: center;
        gap: 10px;
        font-size: 0.875rem;
    }

    .alert-success {
        background: #d1fae5;
        color: #065f46;
        border-left: 3px solid var(--success);
    }

    .alert-error {
        background: #fee2e2;
        color: #991b1b;
        border-left: 3px solid var(--danger);
    }

    /* Stats Cards - Responsive Grid */
    .stats-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: 16px;
        margin-bottom: 24px;
    }

    .stat-card {
        background: white;
        border-radius: var(--radius);
        border: 1px solid var(--gray-200);
        padding: 16px;
        cursor: pointer;
        transition: all 0.2s;
    }

    .stat-card:hover {
        border-color: var(--primary);
        box-shadow: var(--shadow-md);
        transform: translateY(-2px);
    }

    .stat-card.active {
        border-color: var(--primary);
        background: #eff6ff;
    }

    .stat-icon {
        width: 40px;
        height: 40px;
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-bottom: 12px;
        font-size: 1.125rem;
    }

    .stat-icon.total { background: #dbeafe; color: var(--primary); }
    .stat-icon.pending { background: #fef3c7; color: var(--warning); }
    .stat-icon.approved { background: #d1fae5; color: var(--success); }

    .stat-label {
        font-size: 0.7rem;
        color: var(--gray-500);
        font-weight: 500;
        text-transform: uppercase;
        margin-bottom: 4px;
    }

    .stat-value {
        font-size: 1.5rem;
        font-weight: 700;
        color: var(--gray-800);
    }

    /* Filters - Mobile First */
    .filters-card {
        background: white;
        border-radius: var(--radius);
        border: 1px solid var(--gray-200);
        padding: 16px;
        margin-bottom: 24px;
    }

    .filters-form {
        display: flex;
        flex-direction: column;
        gap: 12px;
    }

    .filter-group {
        width: 100%;
    }

    .filter-label {
        font-size: 0.8125rem;
        font-weight: 500;
        color: var(--gray-700);
        display: flex;
        align-items: center;
        gap: 6px;
        margin-bottom: 6px;
    }

    .filter-select, .filter-input {
        width: 100%;
        padding: 10px 12px;
        border: 1px solid var(--gray-300);
        border-radius: 6px;
        font-size: 0.875rem;
        transition: all 0.2s;
    }

    .search-group {
        display: flex;
        gap: 8px;
    }

    .search-group .filter-input {
        flex: 1;
    }

    .btn {
        padding: 10px 16px;
        border-radius: 6px;
        font-size: 0.875rem;
        font-weight: 500;
        cursor: pointer;
        border: 1px solid transparent;
        transition: all 0.2s;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 6px;
        text-decoration: none;
        white-space: nowrap;
    }

    .btn-primary {
        background: var(--primary);
        color: white;
    }

    .btn-primary:hover {
        background: var(--primary-dark);
    }

    .btn-outline {
        background: white;
        border-color: var(--gray-300);
        color: var(--gray-700);
    }

    .btn-outline:hover {
        background: var(--gray-50);
    }

    .btn-sm {
        padding: 8px 12px;
        font-size: 0.8125rem;
    }

    /* Agenda Grid - Responsive */
    .agenda-grid {
        display: grid;
        grid-template-columns: 1fr;
        gap: 16px;
        margin-bottom: 40px;
    }

    /* Agenda Card - Mobile First */
    .agenda-card {
        background: white;
        border-radius: var(--radius);
        border: 1px solid var(--gray-200);
        overflow: hidden;
        transition: all 0.2s;
        display: flex;
        flex-direction: column;
    }

    .agenda-card:hover {
        border-color: var(--primary);
        box-shadow: var(--shadow-md);
    }

    .card-header {
        padding: 16px;
        background: var(--gray-50);
        border-bottom: 1px solid var(--gray-200);
    }

    .card-date {
        font-size: 0.75rem;
        color: var(--gray-500);
        margin-bottom: 8px;
        display: flex;
        align-items: center;
        gap: 6px;
    }

    .card-title {
        font-size: 1rem;
        font-weight: 600;
        color: var(--gray-800);
        margin-bottom: 10px;
        line-height: 1.4;
    }

    .status-badge {
        display: inline-flex;
        align-items: center;
        gap: 4px;
        padding: 4px 8px;
        border-radius: 20px;
        font-size: 0.6875rem;
        font-weight: 600;
    }

    .status-draft { background: var(--gray-100); color: var(--gray-600); }
    .status-pending { background: #fef3c7; color: var(--warning); }
    .status-approved { background: #d1fae5; color: var(--success); }
    .status-rejected { background: #fee2e2; color: var(--danger); }

    .card-content {
        padding: 16px;
        flex: 1;
    }

    .card-description {
        color: var(--gray-600);
        font-size: 0.8125rem;
        line-height: 1.5;
        margin-bottom: 12px;
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }

    .details-list {
        background: var(--gray-50);
        border-radius: 6px;
        padding: 10px;
        margin-bottom: 16px;
    }

    .detail-item {
        display: flex;
        align-items: center;
        gap: 8px;
        padding: 5px 0;
        font-size: 0.75rem;
        color: var(--gray-600);
    }

    .detail-icon {
        width: 18px;
        font-size: 0.75rem;
        color: var(--gray-500);
    }

    .card-actions {
        padding: 12px 16px;
        border-top: 1px solid var(--gray-200);
        display: flex;
        gap: 10px;
    }

    .action-btn {
        flex: 1;
        padding: 8px;
        border-radius: 6px;
        font-size: 0.75rem;
        font-weight: 500;
        text-align: center;
        cursor: pointer;
        border: 1px solid;
        background: white;
        transition: all 0.2s;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 6px;
    }

    .action-edit {
        border-color: var(--primary);
        color: var(--primary);
    }

    .action-edit:hover {
        background: var(--primary);
        color: white;
    }

    .action-delete {
        border-color: var(--danger);
        color: var(--danger);
    }

    .action-delete:hover {
        background: var(--danger);
        color: white;
    }

    .locked-message {
        background: var(--gray-100);
        border-radius: 6px;
        padding: 10px;
        text-align: center;
        color: var(--gray-500);
        font-size: 0.75rem;
        flex: 1;
    }

    /* Empty State */
    .empty-state {
        text-align: center;
        padding: 40px 20px;
        grid-column: 1 / -1;
    }

    .empty-icon {
        font-size: 3rem;
        color: var(--gray-300);
        margin-bottom: 12px;
    }

    .empty-title {
        font-size: 1rem;
        font-weight: 600;
        color: var(--gray-600);
        margin-bottom: 6px;
    }

    .empty-text {
        color: var(--gray-500);
        font-size: 0.8125rem;
        margin-bottom: 16px;
    }

    /* Tablet Styles */
    @media (min-width: 640px) {
        .agenda-container {
            padding: 0 24px;
        }
        
        .agenda-title {
            font-size: 1.75rem;
        }
        
        .stats-grid {
            gap: 20px;
        }
        
        .stat-card {
            padding: 20px;
        }
        
        .stat-icon {
            width: 48px;
            height: 48px;
            font-size: 1.25rem;
        }
        
        .stat-value {
            font-size: 1.75rem;
        }
        
        .agenda-grid {
            gap: 20px;
        }
        
        .card-header {
            padding: 20px;
        }
        
        .card-title {
            font-size: 1.125rem;
        }
        
        .card-content {
            padding: 20px;
        }
        
        .card-actions {
            padding: 16px 20px;
        }
        
        .action-btn {
            font-size: 0.8125rem;
            padding: 8px 12px;
        }
    }

    /* Desktop Styles */
    @media (min-width: 768px) {
        .filters-form {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 16px;
        }
        
        .agenda-grid {
            grid-template-columns: repeat(2, 1fr);
            gap: 24px;
        }
    }

    @media (min-width: 1024px) {
        .filters-form {
            grid-template-columns: repeat(4, 1fr);
        }
        
        .agenda-grid {
            grid-template-columns: repeat(3, 1fr);
        }
    }

    /* Large Desktop */
    @media (min-width: 1280px) {
        .agenda-container {
            padding: 0 32px;
        }
        
        .agenda-grid {
            gap: 28px;
        }
    }

    /* Mobile Landscape */
    @media (max-width: 640px) {
        .search-group {
            flex-direction: column;
        }
        
        .search-group .btn {
            width: 100%;
        }
        
        .card-actions {
            flex-direction: column;
        }
        
        .action-btn {
            width: 100%;
        }
        
        .locked-message {
            width: 100%;
        }
        
        .stats-grid {
            grid-template-columns: 1fr;
            gap: 12px;
        }
        
        .stat-card {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 12px 16px;
        }
        
        .stat-icon {
            margin-bottom: 0;
            width: 36px;
            height: 36px;
        }
        
        .stat-content {
            flex: 1;
            margin-left: 12px;
        }
        
        .stat-label {
            font-size: 0.6875rem;
        }
        
        .stat-value {
            font-size: 1.25rem;
        }
        
        .detail-item {
            font-size: 0.6875rem;
        }
        
        .status-badge {
            font-size: 0.625rem;
            padding: 3px 8px;
        }
    }

    /* Very Small Devices */
    @media (max-width: 480px) {
        .agenda-container {
            padding: 0 12px;
        }
        
        .agenda-title {
            font-size: 1.25rem;
        }
        
        .agenda-subtitle {
            font-size: 0.75rem;
        }
        
        .alert {
            padding: 10px 12px;
            font-size: 0.75rem;
        }
        
        .filters-card {
            padding: 12px;
        }
        
        .filter-select, .filter-input {
            padding: 8px 10px;
            font-size: 0.8125rem;
        }
        
        .card-header {
            padding: 12px;
        }
        
        .card-title {
            font-size: 0.9375rem;
        }
        
        .card-content {
            padding: 12px;
        }
        
        .details-list {
            padding: 8px;
        }
        
        .detail-item {
            padding: 4px 0;
        }
        
        .empty-state {
            padding: 30px 16px;
        }
        
        .empty-icon {
            font-size: 2.5rem;
        }
    }

    /* Touch-friendly improvements */
    @media (hover: none) and (pointer: coarse) {
        .stat-card, .action-btn, .btn {
            cursor: pointer;
            -webkit-tap-highlight-color: transparent;
        }
        
        .action-btn:active {
            transform: scale(0.98);
        }
        
        .stat-card:active {
            transform: scale(0.98);
        }
    }
</style>

<div class="agenda-container">
    <!-- Header -->
    <div class="agenda-header-section">
        <h1 class="agenda-title">
            <i class="fas fa-calendar-alt"></i>
            Agenda Saya
        </h1>
        <p class="agenda-subtitle">Kelola semua agenda yang Anda buat</p>
    </div>

    <!-- Alerts -->
    @if(session('success'))
        <div class="alert alert-success">
            <i class="fas fa-check-circle"></i>
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-error">
            <i class="fas fa-exclamation-circle"></i>
            {{ session('error') }}
        </div>
    @endif

    <!-- Stats -->
    @php
        $total = $agendas->count();
        $pending = $agendas->where('status', 'pending')->count();
        $approved = $agendas->where('status', 'approved')->count();
        $currentStatus = request('status');
    @endphp

    <div class="stats-grid">
        <div class="stat-card {{ !$currentStatus ? 'active' : '' }}" onclick="filterByStatus('')">
            <div class="stat-icon total">
                <i class="fas fa-calendar"></i>
            </div>
            <div class="stat-content">
                <div class="stat-label">Total Agenda</div>
                <div class="stat-value">{{ $total }}</div>
            </div>
        </div>

        <div class="stat-card {{ $currentStatus == 'pending' ? 'active' : '' }}" onclick="filterByStatus('pending')">
            <div class="stat-icon pending">
                <i class="fas fa-clock"></i>
            </div>
            <div class="stat-content">
                <div class="stat-label">Menunggu</div>
                <div class="stat-value">{{ $pending }}</div>
            </div>
        </div>

        <div class="stat-card {{ $currentStatus == 'approved' ? 'active' : '' }}" onclick="filterByStatus('approved')">
            <div class="stat-icon approved">
                <i class="fas fa-check-circle"></i>
            </div>
            <div class="stat-content">
                <div class="stat-label">Disetujui</div>
                <div class="stat-value">{{ $approved }}</div>
            </div>
        </div>
    </div>

    <!-- Filters -->
    <div class="filters-card">
        <form method="GET" action="{{ route('staff.agenda.index') }}" class="filters-form">
            <div class="filter-group">
                <label class="filter-label">
                    <i class="fas fa-filter"></i> Status
                </label>
                <select name="status" class="filter-select" onchange="this.form.submit()">
                    <option value="">Semua Status</option>
                    <option value="draft" {{ request('status') == 'draft' ? 'selected' : '' }}>Draft</option>
                    <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Menunggu</option>
                    <option value="approved" {{ request('status') == 'approved' ? 'selected' : '' }}>Disetujui</option>
                    <option value="rejected" {{ request('status') == 'rejected' ? 'selected' : '' }}>Ditolak</option>
                </select>
            </div>

            <div class="filter-group">
                <label class="filter-label">
                    <i class="fas fa-sort"></i> Urutkan
                </label>
                <select name="sort" class="filter-select" onchange="this.form.submit()">
                    <option value="latest" {{ request('sort') == 'latest' ? 'selected' : '' }}>Terbaru</option>
                    <option value="oldest" {{ request('sort') == 'oldest' ? 'selected' : '' }}>Terlama</option>
                    <option value="date_asc" {{ request('sort') == 'date_asc' ? 'selected' : '' }}>Tanggal (Awal)</option>
                    <option value="date_desc" {{ request('sort') == 'date_desc' ? 'selected' : '' }}>Tanggal (Akhir)</option>
                </select>
            </div>

            <div class="filter-group">
                <label class="filter-label">
                    <i class="fas fa-search"></i> Cari
                </label>
                <div class="search-group">
                    <input type="text" 
                           name="search" 
                           value="{{ request('search') }}" 
                           placeholder="Cari judul..." 
                           class="filter-input">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-search"></i> Cari
                    </button>
                </div>
            </div>

            @if(request()->hasAny(['status', 'sort', 'search']))
                <div class="filter-group">
                    <label class="filter-label">&nbsp;</label>
                    <a href="{{ route('staff.agenda.index') }}" class="btn btn-outline">
                        <i class="fas fa-times"></i> Reset
                    </a>
                </div>
            @endif
        </form>
    </div>

    <!-- Agenda Grid -->
    <div class="agenda-grid">
        @forelse($agendas as $agenda)
            <div class="agenda-card">
                <div class="card-header">
                    <div class="card-date">
                        <i class="far fa-calendar-alt"></i>
                        {{ \Carbon\Carbon::parse($agenda->date)->translatedFormat('d F Y') }}
                    </div>
                    <h3 class="card-title">{{ Str::limit($agenda->title, 60) }}</h3>
                    <span class="status-badge status-{{ $agenda->status }}">
                        <i class="fas fa-{{ $agenda->status == 'pending' ? 'clock' : ($agenda->status == 'approved' ? 'check-circle' : 'edit') }}"></i>
                        {{ ucfirst($agenda->status) }}
                    </span>
                </div>

                <div class="card-content">
                    @if($agenda->description)
                        <div class="card-description">
                            {{ Str::limit($agenda->description, 100) }}
                        </div>
                    @endif

                    <div class="details-list">
                        <div class="detail-item">
                            <i class="fas fa-clock detail-icon"></i>
                            <span>{{ \Carbon\Carbon::parse($agenda->time)->format('H:i') }} WIB</span>
                        </div>
                        @if($agenda->location)
                            <div class="detail-item">
                                <i class="fas fa-map-marker-alt detail-icon"></i>
                                <span>{{ Str::limit($agenda->location, 30) }}</span>
                            </div>
                        @endif
                        <div class="detail-item">
                            <i class="fas fa-calendar-plus detail-icon"></i>
                            <span>Dibuat {{ $agenda->created_at->diffForHumans() }}</span>
                        </div>
                    </div>
                </div>

                <div class="card-actions">
                    @if($agenda->status !== 'approved')
                        <a href="{{ route('staff.agenda.edit', $agenda->id) }}" class="action-btn action-edit">
                            <i class="fas fa-edit"></i> Edit
                        </a>
                        <form method="POST" 
                              action="{{ route('staff.agenda.destroy', $agenda->id) }}"
                              style="flex: 1"
                              onsubmit="return confirm('Hapus agenda ini?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="action-btn action-delete" style="width: 100%">
                                <i class="fas fa-trash"></i> Hapus
                            </button>
                        </form>
                    @else
                        <div class="locked-message">
                            <i class="fas fa-lock"></i> Sudah disetujui
                        </div>
                    @endif
                </div>
            </div>
        @empty
            <div class="empty-state">
                <div class="empty-icon">
                    <i class="fas fa-calendar-times"></i>
                </div>
                <h3 class="empty-title">
                    @if(request()->hasAny(['status', 'search']))
                        Tidak ada agenda ditemukan
                    @else
                        Belum ada agenda
                    @endif
                </h3>
                <p class="empty-text">
                    @if(request()->hasAny(['status', 'search']))
                        Coba ubah filter pencarian Anda
                    @else
                        Mulai buat agenda pertama Anda
                    @endif
                </p>
                @if(request()->hasAny(['status', 'search']))
                    <a href="{{ route('staff.agenda.index') }}" class="btn btn-outline">
                        <i class="fas fa-times"></i> Reset Filter
                    </a>
                @endif
            </div>
        @endforelse
    </div>
</div>

<script>
function filterByStatus(status) {
    const url = new URL(window.location.href);
    if (status) {
        url.searchParams.set('status', status);
    } else {
        url.searchParams.delete('status');
    }
    window.location.href = url.toString();
}

// Auto hide alerts after 3 seconds
setTimeout(() => {
    const alerts = document.querySelectorAll('.alert');
    alerts.forEach(alert => {
        alert.style.opacity = '0';
        alert.style.transition = 'opacity 0.3s';
        setTimeout(() => alert.remove(), 300);
    });
}, 3000);
</script>
@endsection