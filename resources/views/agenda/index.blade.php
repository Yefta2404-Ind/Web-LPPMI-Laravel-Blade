@extends('layouts.cms')

@section('page-title', 'Agenda Saya')
@section('content')
<style>
    /* Variables - Konsisten dengan layout */
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

    /* Base Container */
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
        display: flex;
        align-items: center;
        gap: 12px;
    }

    .page-description {
        color: var(--gray-600);
        font-size: 0.9375rem;
        line-height: 1.5;
    }

    .page-actions {
        display: flex;
        gap: 12px;
        flex-wrap: wrap;
        margin-top: 16px;
    }

    /* Alerts */
    .alert {
        padding: 16px 20px;
        border-radius: var(--border-radius-sm);
        margin-bottom: 24px;
        display: flex;
        align-items: center;
        gap: 12px;
        font-size: 0.9375rem;
    }

    .alert-success {
        background-color: var(--success-light);
        color: var(--success-color);
        border-left: 4px solid var(--success-color);
    }

    .alert-error {
        background-color: var(--danger-light);
        color: var(--danger-color);
        border-left: 4px solid var(--danger-color);
    }

    .alert-warning {
        background-color: var(--warning-light);
        color: var(--warning-color);
        border-left: 4px solid var(--warning-color);
    }

    .alert-info {
        background-color: var(--primary-light);
        color: var(--primary-color);
        border-left: 4px solid var(--primary-color);
    }

    .alert-icon {
        font-size: 1.125rem;
        flex-shrink: 0;
    }

    /* Stats Cards */
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

    @media (min-width: 768px) {
        .stats-grid {
            grid-template-columns: repeat(4, 1fr);
        }
    }

    .stat-card {
        background: white;
        border-radius: var(--border-radius);
        border: 1px solid var(--gray-200);
        padding: 20px;
        transition: all var(--transition);
        cursor: pointer;
    }

    .stat-card:hover {
        border-color: var(--primary-color);
        box-shadow: var(--shadow-md);
        transform: translateY(-2px);
    }

    .stat-card.active {
        border-color: var(--primary-color);
        background-color: var(--primary-light);
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

    .stat-icon.total {
        background-color: var(--primary-light);
        color: var(--primary-color);
    }

    .stat-icon.draft {
        background-color: var(--gray-100);
        color: var(--gray-600);
    }

    .stat-icon.pending {
        background-color: var(--warning-light);
        color: var(--warning-color);
    }

    .stat-icon.approved {
        background-color: var(--success-light);
        color: var(--success-color);
    }

    .stat-icon.rejected {
        background-color: var(--danger-light);
        color: var(--danger-color);
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

    /* Filters */
    .filters-container {
        background: white;
        border-radius: var(--border-radius);
        border: 1px solid var(--gray-200);
        padding: 24px;
        margin-bottom: 32px;
        box-shadow: var(--shadow-sm);
    }

    .filters-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 20px;
        flex-wrap: wrap;
        gap: 16px;
    }

    .filters-title {
        font-size: 1.125rem;
        font-weight: 600;
        color: var(--gray-900);
    }

    .filters-form {
        display: grid;
        grid-template-columns: repeat(1, 1fr);
        gap: 20px;
    }

    @media (min-width: 768px) {
        .filters-form {
            grid-template-columns: repeat(2, 1fr);
        }
    }

    @media (min-width: 1024px) {
        .filters-form {
            grid-template-columns: repeat(4, 1fr);
        }
    }

    .filter-group {
        display: flex;
        flex-direction: column;
        gap: 8px;
    }

    .filter-label {
        font-size: 0.875rem;
        font-weight: 500;
        color: var(--gray-700);
        display: flex;
        align-items: center;
        gap: 6px;
    }

    .filter-label-icon {
        color: var(--gray-500);
        font-size: 0.875rem;
    }

    .filter-select {
        padding: 10px 12px;
        border: 1px solid var(--gray-300);
        border-radius: var(--border-radius-sm);
        font-size: 0.875rem;
        color: var(--gray-700);
        background-color: white;
        cursor: pointer;
        transition: all var(--transition);
        width: 100%;
    }

    .filter-select:focus {
        outline: none;
        border-color: var(--primary-color);
        box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.1);
    }

    .filter-actions {
        display: flex;
        gap: 12px;
        align-items: flex-end;
    }

    /* Buttons */
    .btn {
        padding: 10px 20px;
        border-radius: var(--border-radius-sm);
        font-size: 0.875rem;
        font-weight: 500;
        text-decoration: none;
        cursor: pointer;
        border: 1px solid transparent;
        transition: all var(--transition);
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        white-space: nowrap;
        height: fit-content;
    }

    .btn-sm {
        padding: 8px 16px;
        font-size: 0.8125rem;
    }

    .btn-primary {
        background-color: var(--primary-color);
        color: white;
        border-color: var(--primary-color);
    }

    .btn-primary:hover {
        background-color: var(--primary-dark);
        border-color: var(--primary-dark);
    }

    .btn-outline {
        background-color: white;
        color: var(--gray-700);
        border-color: var(--gray-300);
    }

    .btn-outline:hover {
        background-color: var(--gray-50);
        border-color: var(--gray-400);
    }

    .btn-success {
        background-color: var(--success-color);
        color: white;
        border-color: var(--success-color);
    }

    .btn-success:hover {
        background-color: #0da271;
        border-color: #0da271;
    }

    .btn-warning {
        background-color: var(--warning-color);
        color: white;
        border-color: var(--warning-color);
    }

    .btn-warning:hover {
        background-color: #d97706;
        border-color: #d97706;
    }

    .btn-danger {
        background-color: var(--danger-color);
        color: white;
        border-color: var(--danger-color);
    }

    .btn-danger:hover {
        background-color: #dc2626;
        border-color: #dc2626;
    }

    /* Agenda Grid */
    .agenda-grid {
        display: grid;
        grid-template-columns: repeat(1, 1fr);
        gap: 24px;
        margin-bottom: 40px;
    }

    @media (min-width: 768px) {
        .agenda-grid {
            grid-template-columns: repeat(2, 1fr);
        }
    }

    @media (min-width: 1024px) {
        .agenda-grid {
            grid-template-columns: repeat(3, 1fr);
        }
    }

    /* Agenda Card */
    .agenda-card {
        background: white;
        border-radius: var(--border-radius);
        border: 1px solid var(--gray-200);
        box-shadow: var(--shadow-sm);
        overflow: hidden;
        transition: all var(--transition);
        display: flex;
        flex-direction: column;
        height: 100%;
    }

    .agenda-card:hover {
        border-color: var(--primary-color);
        box-shadow: var(--shadow-md);
        transform: translateY(-4px);
    }

    .agenda-header {
        padding: 24px 24px 16px;
        background: var(--gray-50);
        border-bottom: 1px solid var(--gray-200);
        position: relative;
    }

    .agenda-date-badge {
        position: absolute;
        top: 16px;
        right: 16px;
        background: white;
        border: 1px solid var(--gray-300);
        border-radius: var(--border-radius-sm);
        padding: 6px 10px;
        font-size: 0.75rem;
        font-weight: 600;
        color: var(--gray-700);
        display: flex;
        align-items: center;
        gap: 6px;
        z-index: 2;
    }

    .agenda-title {
        font-size: 1.125rem;
        font-weight: 600;
        color: var(--gray-900);
        line-height: 1.4;
        margin-bottom: 8px;
        padding-right: 80px;
    }

    .agenda-content {
        padding: 24px;
        flex: 1;
        display: flex;
        flex-direction: column;
    }

    /* Status Badge */
    .status-badge {
        display: inline-flex;
        align-items: center;
        padding: 6px 12px;
        border-radius: 20px;
        font-size: 0.75rem;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.05em;
        border: 1px solid;
        gap: 6px;
        width: fit-content;
        margin-bottom: 16px;
    }

    .status-draft {
        background-color: var(--gray-100);
        color: var(--gray-600);
        border-color: var(--gray-300);
    }

    .status-pending {
        background-color: var(--warning-light);
        color: var(--warning-color);
        border-color: rgba(245, 158, 11, 0.2);
    }

    .status-approved {
        background-color: var(--success-light);
        color: var(--success-color);
        border-color: rgba(16, 185, 129, 0.2);
    }

    .status-rejected {
        background-color: var(--danger-light);
        color: var(--danger-color);
        border-color: rgba(239, 68, 68, 0.2);
    }

    /* Agenda Details */
    .agenda-details {
        background: var(--gray-50);
        border-radius: var(--border-radius-sm);
        padding: 16px;
        margin-bottom: 20px;
        flex: 1;
    }

    .detail-row {
        display: flex;
        align-items: flex-start;
        padding: 8px 0;
        border-bottom: 1px solid var(--gray-200);
        font-size: 0.8125rem;
    }

    .detail-row:last-child {
        border-bottom: none;
    }

    .detail-label {
        color: var(--gray-600);
        font-weight: 500;
        min-width: 80px;
        display: flex;
        align-items: center;
        gap: 6px;
    }

    .detail-icon {
        color: var(--gray-500);
        font-size: 0.875rem;
        width: 14px;
        text-align: center;
    }

    .detail-value {
        color: var(--gray-700);
        flex: 1;
        text-align: left;
        word-break: break-word;
    }

    /* Agenda Description */
    .agenda-description {
        font-size: 0.875rem;
        color: var(--gray-600);
        line-height: 1.5;
        margin-bottom: 20px;
        display: -webkit-box;
        -webkit-line-clamp: 3;
        -webkit-box-orient: vertical;
        overflow: hidden;
        text-overflow: ellipsis;
        flex: 1;
    }

    /* Action Buttons */
    .agenda-actions {
        display: flex;
        gap: 8px;
        padding-top: 20px;
        border-top: 1px solid var(--gray-200);
        margin-top: auto;
    }

    .btn-icon {
        padding: 8px 12px;
        border-radius: var(--border-radius-sm);
        font-size: 0.8125rem;
        background: none;
        border: 1px solid var(--gray-300);
        color: var(--gray-600);
        cursor: pointer;
        transition: all var(--transition);
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 6px;
        flex: 1;
    }

    .btn-icon:hover {
        transform: translateY(-2px);
    }

    .btn-icon.edit {
        border-color: var(--primary-color);
        color: var(--primary-color);
        background-color: var(--primary-light);
    }

    .btn-icon.edit:hover {
        background-color: var(--primary-color);
        color: white;
    }

    .btn-icon.delete {
        border-color: var(--danger-color);
        color: var(--danger-color);
        background-color: var(--danger-light);
    }

    .btn-icon.delete:hover {
        background-color: var(--danger-color);
        color: white;
    }

    .btn-icon.view {
        border-color: var(--success-color);
        color: var(--success-color);
        background-color: var(--success-light);
    }

    .btn-icon.view:hover {
        background-color: var(--success-color);
        color: white;
    }

    .form-inline {
        display: inline;
        flex: 1;
    }

    /* Locked State */
    .locked-message {
        background: var(--gray-50);
        border: 1px solid var(--gray-300);
        border-radius: var(--border-radius-sm);
        padding: 12px 16px;
        text-align: center;
        margin-top: 20px;
    }

    .locked-icon {
        font-size: 1.5rem;
        color: var(--gray-400);
        margin-bottom: 8px;
    }

    .locked-text {
        font-size: 0.8125rem;
        color: var(--gray-600);
        font-weight: 500;
    }

    /* Empty State */
    .empty-state {
        text-align: center;
        padding: 60px 20px;
        color: var(--gray-500);
        grid-column: 1 / -1;
    }

    .empty-icon {
        font-size: 3rem;
        margin-bottom: 16px;
        opacity: 0.5;
    }

    .empty-title {
        font-size: 1.125rem;
        font-weight: 600;
        color: var(--gray-600);
        margin-bottom: 8px;
    }

    .empty-description {
        font-size: 0.875rem;
        color: var(--gray-500);
        margin-bottom: 24px;
        max-width: 400px;
        margin-left: auto;
        margin-right: auto;
    }

    /* Responsive */
    @media (max-width: 768px) {
        .admin-container {
            padding: 0 12px;
        }
        
        .page-header {
            margin-bottom: 24px;
        }
        
        .page-title {
            font-size: 1.5rem;
        }
        
        .filters-form {
            grid-template-columns: 1fr;
        }
        
        .filter-actions {
            flex-direction: column;
            width: 100%;
        }
        
        .filter-actions .btn {
            width: 100%;
            justify-content: center;
        }
        
        .agenda-grid {
            grid-template-columns: 1fr;
        }
        
        .agenda-header {
            padding: 20px 20px 16px;
        }
        
        .agenda-date-badge {
            position: static;
            margin-bottom: 12px;
            width: fit-content;
        }
        
        .agenda-title {
            padding-right: 0;
        }
        
        .agenda-content {
            padding: 20px;
        }
        
        .agenda-actions {
            flex-direction: column;
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
            font-size: 1.25rem;
        }
        
        .page-actions {
            flex-direction: column;
            width: 100%;
        }
        
        .page-actions .btn {
            width: 100%;
            justify-content: center;
        }
        
        .alert {
            padding: 12px 16px;
            font-size: 0.875rem;
        }
        
        .detail-row {
            flex-direction: column;
            gap: 4px;
        }
        
        .detail-label {
            min-width: auto;
        }
    }

    /* Date Format */
    .date-day {
        font-size: 1.5rem;
        font-weight: 700;
        color: var(--primary-color);
        line-height: 1;
    }

    .date-month {
        font-size: 0.875rem;
        font-weight: 600;
        color: var(--gray-600);
        text-transform: uppercase;
    }

    .date-year {
        font-size: 0.75rem;
        color: var(--gray-500);
    }

    .date-time {
        font-size: 0.8125rem;
        color: var(--gray-700);
        font-weight: 500;
        margin-top: 2px;
    }
</style>

<div class="admin-container">
    <!-- Page Header -->
    <div class="page-header">
        <div>
            <h1 class="page-title">
                <i class="fas fa-calendar-alt"></i>
                Agenda Saya
            </h1>
            <p class="page-description">Kelola agenda yang Anda buat. Lihat status, edit, atau hapus agenda.</p>
        </div>
    </div>


    <!-- Alerts -->
    @if(session('success'))
        <div class="alert alert-success">
            <i class="fas fa-check-circle alert-icon"></i>
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-error">
            <i class="fas fa-exclamation-circle alert-icon"></i>
            {{ session('error') }}
        </div>
    @endif

    @if(session('warning'))
        <div class="alert alert-warning">
            <i class="fas fa-exclamation-triangle alert-icon"></i>
            {{ session('warning') }}
        </div>
    @endif

    @if(session('info'))
        <div class="alert alert-info">
            <i class="fas fa-info-circle alert-icon"></i>
            {{ session('info') }}
        </div>
    @endif

    <!-- Status Stats -->
    @php
        $totalAgenda = $agendas->count();
        $pendingCount = $agendas->where('status', 'pending')->count();
        $approvedCount = $agendas->where('status', 'approved')->count();
        $rejectedCount = $agendas->where('status', 'rejected')->count();
        $draftCount = $agendas->where('status', 'draft')->count();
        
        $currentStatus = request('status');
    @endphp

    <div class="stats-grid">
        <div class="stat-card {{ !$currentStatus ? 'active' : '' }}" onclick="filterByStatus('')">
            <div class="stat-icon total">
                <i class="fas fa-calendar"></i>
            </div>
            <div class="stat-content">
                <div class="stat-label">Total Agenda</div>
                <div class="stat-value">{{ $totalAgenda }}</div>
            </div>
        </div>

        <div class="stat-card {{ $currentStatus == 'pending' ? 'active' : '' }}" onclick="filterByStatus('pending')">
            <div class="stat-icon pending">
                <i class="fas fa-clock"></i>
            </div>
            <div class="stat-content">
                <div class="stat-label">Menunggu</div>
                <div class="stat-value">{{ $pendingCount }}</div>
            </div>
        </div>

        <div class="stat-card {{ $currentStatus == 'approved' ? 'active' : '' }}" onclick="filterByStatus('approved')">
            <div class="stat-icon approved">
                <i class="fas fa-check-circle"></i>
            </div>
            <div class="stat-content">
                <div class="stat-label">Disetujui</div>
                <div class="stat-value">{{ $approvedCount }}</div>
            </div>
        </div>
    </div>

    <!-- Filters -->
    <div class="filters-container">
        <div class="filters-header">
            <h2 class="filters-title">Filter Agenda</h2>
            @if(request()->hasAny(['status', 'sort', 'search']))
                <a href="{{ route('staff.agenda.index') }}" class="btn btn-outline btn-sm">
                    <i class="fas fa-times"></i> Reset Filter
                </a>
            @endif
        </div>
        
        <form method="GET" action="{{ route('staff.agenda.index') }}" class="filters-form">
            <div class="filter-group">
                <label class="filter-label">
                    <i class="fas fa-filter filter-label-icon"></i>
                    Status
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
                    <i class="fas fa-sort filter-label-icon"></i>
                    Urutkan
                </label>
                <select name="sort" class="filter-select" onchange="this.form.submit()">
                    <option value="latest" {{ request('sort') == 'latest' ? 'selected' : '' }}>Terbaru</option>
                    <option value="oldest" {{ request('sort') == 'oldest' ? 'selected' : '' }}>Terlama</option>
                    <option value="date_asc" {{ request('sort') == 'date_asc' ? 'selected' : '' }}>Tanggal (Awal ke Akhir)</option>
                    <option value="date_desc" {{ request('sort') == 'date_desc' ? 'selected' : '' }}>Tanggal (Akhir ke Awal)</option>
                </select>
            </div>
            
            <div class="filter-group">
                <label class="filter-label">
                    <i class="fas fa-search filter-label-icon"></i>
                    Cari
                </label>
                <div style="display: flex; gap: 8px;">
                    <input type="text" 
                           name="search" 
                           value="{{ request('search') }}" 
                           placeholder="Cari judul agenda..." 
                           class="filter-select" 
                           style="flex: 1;">
                    <button type="submit" class="btn btn-outline" style="white-space: nowrap;">
                        <i class="fas fa-search"></i>
                    </button>
                </div>
            </div>
        </form>
    </div>

    <!-- Agenda Grid -->
    <div class="agenda-grid">
        @forelse($agendas as $agenda)
            <div class="agenda-card">
                <!-- Agenda Header -->
                <div class="agenda-header">
                    <!-- Date Badge -->
                    <div class="agenda-date-badge">
                        <div style="text-align: center;">
                            <div class="date-day">
                                {{ \Carbon\Carbon::parse($agenda->date)->format('d') }}
                            </div>
                            <div class="date-month">
                                {{ \Carbon\Carbon::parse($agenda->date)->format('M') }}
                            </div>
                            <div class="date-year">
                                {{ \Carbon\Carbon::parse($agenda->date)->format('Y') }}
                            </div>
                        </div>
                    </div>
                    
                    <!-- Title -->
                    <h3 class="agenda-title">
                        {{ Str::limit($agenda->title, 60) }}
                    </h3>
                    
                    <!-- Status Badge -->
                    @if($agenda->status === 'draft')
                        <span class="status-badge status-draft">
                            <i class="fas fa-edit"></i> Draft
                        </span>
                    @elseif($agenda->status === 'pending')
                        <span class="status-badge status-pending">
                            <i class="fas fa-clock"></i> Menunggu
                        </span>
                    @elseif($agenda->status === 'approved')
                        <span class="status-badge status-approved">
                            <i class="fas fa-check-circle"></i> Disetujui
                        </span>
                    @elseif($agenda->status === 'rejected')
                        <span class="status-badge status-rejected">
                            <i class="fas fa-times-circle"></i> Ditolak
                        </span>
                    @endif
                </div>
                
                <!-- Agenda Content -->
                <div class="agenda-content">
                    <!-- Description -->
                    @if($agenda->description)
                        <div class="agenda-description">
                            {{ Str::limit($agenda->description, 120) }}
                        </div>
                    @endif
                    
                    <!-- Details -->
                    <div class="agenda-details">
                        <div class="detail-row">
                            <span class="detail-label">
                                <i class="fas fa-clock detail-icon"></i>
                                Waktu
                            </span>
                            <span class="detail-value">
                                {{ \Carbon\Carbon::parse($agenda->time)->format('H:i') }}
                            </span>
                        </div>
                        
                        @if($agenda->location)
                            <div class="detail-row">
                                <span class="detail-label">
                                    <i class="fas fa-map-marker-alt detail-icon"></i>
                                    Lokasi
                                </span>
                                <span class="detail-value">
                                    {{ Str::limit($agenda->location, 30) }}
                                </span>
                            </div>
                        @endif
                        
                        @if($agenda->duration)
                            <div class="detail-row">
                                <span class="detail-label">
                                    <i class="fas fa-hourglass-half detail-icon"></i>
                                    Durasi
                                </span>
                                <span class="detail-value">
                                    {{ $agenda->duration }}
                                </span>
                            </div>
                        @endif
                        
                        <div class="detail-row">
                            <span class="detail-label">
                                <i class="fas fa-calendar-plus detail-icon"></i>
                                Dibuat
                            </span>
                            <span class="detail-value">
                                {{ $agenda->created_at->diffForHumans() }}
                            </span>
                        </div>
                    </div>
                    
                    <!-- Action Buttons -->
                    <div class="agenda-actions">
                        @if($agenda->status !== 'approved')
                            <!-- Edit Button -->
                            <a href="{{ route('staff.agenda.edit', $agenda->id) }}" 
                               class="btn-icon edit">
                                <i class="fas fa-edit"></i> Edit
                            </a>
                            
                            <!-- Delete Button -->
                            <form method="POST" 
                                  action="{{ route('staff.agenda.destroy', $agenda->id) }}"
                                  class="form-inline"
                                  onsubmit="return confirm('Apakah Anda yakin ingin menghapus agenda ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn-icon delete">
                                    <i class="fas fa-trash"></i> Hapus
                                </button>
                            </form>
                        @else
                            <!-- Locked Message -->
                            <div class="locked-message">
                                <div class="locked-icon">
                                    <i class="fas fa-lock"></i>
                                </div>
                                <div class="locked-text">
                                    Agenda sudah disetujui dan tidak dapat diubah
                                </div>
                            </div>
                        @endif
                        
                        <!-- View Button (for approved agenda) -->
                        @if($agenda->status === 'approved')
                        @endif
                    </div>
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
                <p class="empty-description">
                    @if(request()->hasAny(['status', 'search']))
                        Coba ubah filter pencarian Anda atau reset filter untuk melihat semua agenda.
                    @else
                        Mulai buat agenda pertama Anda dengan menekan tombol "Tambah Agenda Baru" di atas.
                    @endif
                </p>
                @if(request()->hasAny(['status', 'search']))
                    <a href="{{ route('staff.agenda.index') }}" class="btn btn-outline">
                        <i class="fas fa-times"></i> Reset Filter
                    </a>
                @else
                    <a href="{{ route('staff.agenda.create') }}" class="btn btn-primary">
                        <i class="fas fa-plus"></i> Buat Agenda Pertama
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

// Auto-hide alerts after 5 seconds
setTimeout(() => {
    const alerts = document.querySelectorAll('.alert');
    alerts.forEach(alert => {
        alert.style.transition = 'opacity 0.3s ease';
        alert.style.opacity = '0';
        setTimeout(() => alert.remove(), 300);
    });
}, 5000);

// Add active class to clicked stat card
document.querySelectorAll('.stat-card').forEach(card => {
    card.addEventListener('click', function() {
        document.querySelectorAll('.stat-card').forEach(c => {
            c.classList.remove('active');
        });
        this.classList.add('active');
    });
});
</script>
@endsection