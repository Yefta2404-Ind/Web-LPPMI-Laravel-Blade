@extends('layouts.cms')

@section('page-title', 'Data Berita')
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

    /* News Grid */
    .news-grid {
        display: grid;
        grid-template-columns: repeat(1, 1fr);
        gap: 24px;
        margin-bottom: 40px;
    }

    @media (min-width: 768px) {
        .news-grid {
            grid-template-columns: repeat(2, 1fr);
        }
    }

    @media (min-width: 1024px) {
        .news-grid {
            grid-template-columns: repeat(3, 1fr);
        }
    }

    /* News Card */
    .news-card {
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

    .news-card:hover {
        border-color: var(--primary-color);
        box-shadow: var(--shadow-md);
        transform: translateY(-4px);
    }

    .news-image-container {
        position: relative;
        width: 100%;
        padding-top: 56.25%; /* 16:9 Aspect Ratio */
        overflow: hidden;
        background-color: var(--gray-100);
    }

    .news-image {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform var(--transition);
    }

    .news-card:hover .news-image {
        transform: scale(1.05);
    }

    .news-status {
        position: absolute;
        top: 12px;
        right: 12px;
        z-index: 2;
    }

    .news-content {
        padding: 24px;
        flex: 1;
        display: flex;
        flex-direction: column;
    }

    .news-header {
        display: flex;
        justify-content: space-between;
        align-items: flex-start;
        margin-bottom: 12px;
        gap: 12px;
    }

    .news-title {
        font-size: 1.125rem;
        font-weight: 600;
        color: var(--gray-900);
        line-height: 1.4;
        flex: 1;
        margin-bottom: 12px;
    }

    .news-title a {
        text-decoration: none;
        color: inherit;
        transition: color var(--transition);
        display: block;
    }

    .news-title a:hover {
        color: var(--primary-color);
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

    .news-excerpt {
        font-size: 0.875rem;
        color: var(--gray-600);
        line-height: 1.5;
        margin-bottom: 20px;
        flex: 1;
        display: -webkit-box;
        -webkit-line-clamp: 3;
        -webkit-box-orient: vertical;
        overflow: hidden;
        text-overflow: ellipsis;
    }

    .news-meta {
        display: flex;
        justify-content: space-between;
        align-items: center;
        font-size: 0.8125rem;
        color: var(--gray-500);
        padding-top: 16px;
        border-top: 1px solid var(--gray-200);
        margin-top: auto;
    }

    .meta-left {
        display: flex;
        align-items: center;
        gap: 12px;
    }

    .meta-item {
        display: flex;
        align-items: center;
        gap: 6px;
    }

    .meta-icon {
        color: var(--gray-400);
        font-size: 0.875rem;
    }

    .news-actions {
        display: flex;
        gap: 8px;
    }

    .btn-icon {
        padding: 8px;
        border-radius: var(--border-radius-sm);
        font-size: 0.875rem;
        background: none;
        border: 1px solid var(--gray-300);
        color: var(--gray-600);
        cursor: pointer;
        transition: all var(--transition);
        display: flex;
        align-items: center;
        justify-content: center;
        width: 36px;
        height: 36px;
    }

    .btn-icon:hover {
        background-color: var(--gray-50);
        border-color: var(--gray-400);
        color: var(--gray-700);
    }

    .btn-icon.edit:hover {
        background-color: var(--primary-light);
        border-color: var(--primary-color);
        color: var(--primary-color);
    }

    .btn-icon.delete:hover {
        background-color: var(--danger-light);
        border-color: var(--danger-color);
        color: var(--danger-color);
    }

    /* Category Badge */
    .category-badge {
        display: inline-block;
        padding: 4px 12px;
        border-radius: 20px;
        font-size: 0.75rem;
        font-weight: 500;
        background-color: var(--info-light);
        color: var(--info-color);
        border: 1px solid rgba(139, 92, 246, 0.2);
        margin-bottom: 12px;
        width: fit-content;
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

    /* Pagination */
    .pagination-container {
        display: flex;
        justify-content: center;
        margin-top: 32px;
        padding-top: 24px;
        border-top: 1px solid var(--gray-200);
    }

    .pagination {
        display: flex;
        gap: 8px;
        align-items: center;
        flex-wrap: wrap;
    }

    .pagination-link {
        padding: 8px 12px;
        border: 1px solid var(--gray-300);
        border-radius: var(--border-radius-sm);
        font-size: 0.875rem;
        color: var(--gray-700);
        text-decoration: none;
        transition: all var(--transition);
        min-width: 40px;
        text-align: center;
    }

    .pagination-link:hover {
        background-color: var(--gray-50);
        border-color: var(--gray-400);
    }

    .pagination-link.active {
        background-color: var(--primary-color);
        border-color: var(--primary-color);
        color: white;
    }

    .pagination-link.disabled {
        opacity: 0.5;
        cursor: not-allowed;
        background-color: var(--gray-100);
    }

    /* Quick Actions */
    .quick-actions {
        display: flex;
        gap: 12px;
        margin-bottom: 24px;
        flex-wrap: wrap;
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
        
        .news-grid {
            grid-template-columns: 1fr;
        }
        
        .news-actions {
            flex-direction: column;
        }
        
        .btn-icon {
            width: 100%;
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
        
        .news-content {
            padding: 16px;
        }
        
        .news-meta {
            flex-direction: column;
            align-items: flex-start;
            gap: 12px;
        }
        
        .news-actions {
            width: 100%;
            justify-content: flex-start;
        }
        
        .pagination {
            justify-content: center;
        }
    }
</style>

<div class="admin-container">
    <!-- Page Header -->
    <div class="page-header">
        <div>
            <h1 class="page-title">Data Berita</h1>
            <p class="page-description">Kelola berita yang Anda buat. Lihat status, edit, atau hapus berita.</p>
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
        $totalNews = $news->total();
        $pendingCount = $news->where('status', 'pending')->count();
        $approvedCount = $news->where('status', 'approved')->count();
        $rejectedCount = $news->where('status', 'rejected')->count();
        $draftCount = $news->where('status', 'draft')->count();
        
        $currentStatus = request('status');
    @endphp

    <div class="stats-grid">
        <div class="stat-card {{ !$currentStatus ? 'active' : '' }}" onclick="filterByStatus('')">
            <div class="stat-icon total">
                <i class="fas fa-newspaper"></i>
            </div>
            <div class="stat-content">
                <div class="stat-label">Total Berita</div>
                <div class="stat-value">{{ $totalNews }}</div>
            </div>
        </div>

        <div class="stat-card {{ $currentStatus == 'draft' ? 'active' : '' }}" onclick="filterByStatus('draft')">
            <div class="stat-icon draft">
                <i class="fas fa-edit"></i>
            </div>
            <div class="stat-content">
                <div class="stat-label">Draft</div>
                <div class="stat-value">{{ $draftCount }}</div>
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


    <!-- News Grid -->
    <div class="news-grid">
        @forelse($news as $n)
            <div class="news-card">
                <!-- News Image -->
                <div class="news-image-container">
                    <img 
                        src="{{ $n->image ? asset('storage/'.$n->image) : 'https://images.unsplash.com/photo-1504711434969-e33886168f5c?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80' }}" 
                        alt="{{ $n->title }}"
                        class="news-image"
                        onerror="this.src='https://images.unsplash.com/photo-1504711434969-e33886168f5c?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80'"
                    >
                    
                    <!-- Status Badge -->
                    <div class="news-status">
                        @if($n->status === 'draft')
                            <span class="status-badge status-draft">
                                <i class="fas fa-edit"></i> Draft
                            </span>
                        @elseif($n->status === 'pending')
                            <span class="status-badge status-pending">
                                <i class="fas fa-clock"></i> Menunggu
                            </span>
                        @elseif($n->status === 'approved')
                            <span class="status-badge status-approved">
                                <i class="fas fa-check-circle"></i> Disetujui
                            </span>
                        @elseif($n->status === 'rejected')
                            <span class="status-badge status-rejected">
                                <i class="fas fa-times-circle"></i> Ditolak
                            </span>
                        @endif
                    </div>
                </div>
                
                <!-- News Content -->
                <div class="news-content">
                    <!-- Category -->
                    @if($n->category)
                        <div class="category-badge">
                            {{ $n->category->name ?? '' }}
                        </div>
                    @endif
                    
                    <!-- Title -->
                    
                    <!-- Excerpt -->
                    <div class="news-excerpt">
                        {{ Str::limit(strip_tags($n->content), 120) }}
                    </div>
                    
                    <!-- Meta & Actions -->
                    <div class="news-meta">
                        <div class="meta-left">
                            <div class="meta-item">
                                <i class="fas fa-calendar meta-icon"></i>
                                <span>{{ $n->created_at->format('d M Y') }}</span>
                            </div>
                            
                            @if($n->views)
                                <div class="meta-item">
                                    <i class="fas fa-eye meta-icon"></i>
                                    <span>{{ $n->views }}</span>
                                </div>
                            @endif
                        </div>
                        
                        <div class="news-actions">
                            <!-- Edit Button -->
                            @if($n->status === 'draft' || $n->status === 'rejected')
                                <a href="{{ route('staff.news.edit', $n) }}" 
                                   class="btn-icon edit"
                                   title="Edit Berita">
                                    <i class="fas fa-edit"></i>
                                </a>
                            @endif
                            
                            <!-- Delete Button -->
                            <form method="POST" 
                                  action="{{ route('staff.news.destroy', $n) }}" 
                                  class="form-inline"
                                  onsubmit="return confirm('Apakah Anda yakin ingin menghapus berita ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn-icon delete" title="Hapus Berita">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                            
                            <!-- View Button -->
                            @if($n->status === 'approved')
                                
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <div class="empty-state">
                <div class="empty-icon">
                    <i class="fas fa-newspaper"></i>
                </div>
                <h3 class="empty-title">
                    @if(request()->hasAny(['status', 'category', 'search']))
                        Tidak ada berita ditemukan
                    @else
                        Belum ada berita
                    @endif
                </h3>
                <p class="empty-description">
                    @if(request()->hasAny(['status', 'category', 'search']))
                        Coba ubah filter pencarian Anda atau reset filter untuk melihat semua berita.
                    @else
                        Mulai buat berita pertama Anda dengan menekan tombol "Buat Berita Baru" di atas.
                    @endif
                </p>
                @if(request()->hasAny(['status', 'category', 'search']))
                    <a href="{{ route('staff.news.index') }}" class="btn btn-outline">
                        <i class="fas fa-times"></i> Reset Filter
                    </a>
                @else
                    <a href="{{ route('staff.news.create') }}" class="btn btn-primary">
                        <i class="fas fa-plus"></i> Buat Berita Pertama
                    </a>
                @endif
            </div>
        @endforelse
    </div>

    <!-- Pagination -->
    @if($news->hasPages())
        <div class="pagination-container">
            <div class="pagination">
                @if($news->onFirstPage())
                    <span class="pagination-link disabled">
                        <i class="fas fa-chevron-left"></i> Sebelumnya
                    </span>
                @else
                    <a href="{{ $news->previousPageUrl() }}" class="pagination-link">
                        <i class="fas fa-chevron-left"></i> Sebelumnya
                    </a>
                @endif

                @foreach($news->getUrlRange(1, $news->lastPage()) as $page => $url)
                    @if($page == $news->currentPage())
                        <span class="pagination-link active">{{ $page }}</span>
                    @elseif(abs($page - $news->currentPage()) <= 2 || $page == 1 || $page == $news->lastPage())
                        <a href="{{ $url }}" class="pagination-link">{{ $page }}</a>
                    @elseif(abs($page - $news->currentPage()) == 3)
                        <span class="pagination-link disabled">...</span>
                    @endif
                @endforeach

                @if($news->hasMorePages())
                    <a href="{{ $news->nextPageUrl() }}" class="pagination-link">
                        Selanjutnya <i class="fas fa-chevron-right"></i>
                    </a>
                @else
                    <span class="pagination-link disabled">
                        Selanjutnya <i class="fas fa-chevron-right"></i>
                    </span>
                @endif
            </div>
        </div>
    @endif
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