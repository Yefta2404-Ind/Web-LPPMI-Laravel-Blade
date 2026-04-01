@extends('layouts.cms')

@section('page-title', 'Data Berita')
@section('content')
<style>
    /* ========== VARIABEL WARNA BIRU MODERN ========== */
    :root {
        --primary-color: #2563eb;
        --primary-dark: #1d4ed8;
        --primary-light: #dbeafe;
        --primary-bg-light: #eff6ff;
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
        --border-radius: 20px;
        --border-radius-sm: 14px;
        --border-radius-xs: 10px;
        --shadow-sm: 0 1px 2px 0 rgba(0, 0, 0, 0.03);
        --shadow: 0 1px 3px 0 rgba(0, 0, 0, 0.05), 0 1px 2px -1px rgba(0, 0, 0, 0.03);
        --shadow-md: 0 4px 6px -1px rgba(0, 0, 0, 0.05), 0 2px 4px -2px rgba(0, 0, 0, 0.03);
        --shadow-lg: 0 10px 15px -3px rgba(0, 0, 0, 0.08), 0 4px 6px -4px rgba(0, 0, 0, 0.04);
        --shadow-xl: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 8px 10px -6px rgba(0, 0, 0, 0.05);
        --transition: all 0.25s cubic-bezier(0.4, 0, 0.2, 1);
    }

    /* Container */
    .admin-container {
        max-width: 1400px;
        margin: 0 auto;
        padding: 0 16px;
    }

    /* Page Header */
    .page-header {
        margin-bottom: 32px;
        padding-bottom: 20px;
        border-bottom: 2px solid rgba(37, 99, 235, 0.15);
        position: relative;
    }

    .page-header::after {
        content: '';
        position: absolute;
        bottom: -2px;
        left: 0;
        width: 80px;
        height: 2px;
        background: linear-gradient(90deg, var(--primary-color), var(--primary-light));
        border-radius: 2px;
    }

    .page-title {
        font-size: 1.85rem;
        font-weight: 800;
        color: var(--gray-800);
        margin-bottom: 8px;
        letter-spacing: -0.02em;
    }

    .page-description {
        color: var(--gray-500);
        font-size: 0.9rem;
        line-height: 1.5;
    }

    /* Alerts */
    .alert {
        padding: 16px 20px;
        border-radius: var(--border-radius-sm);
        margin-bottom: 24px;
        display: flex;
        align-items: center;
        gap: 12px;
        font-size: 0.9rem;
        animation: slideIn 0.3s ease;
        box-shadow: var(--shadow);
    }

    @keyframes slideIn {
        from {
            opacity: 0;
            transform: translateY(-10px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .alert-success {
        background: linear-gradient(135deg, #f0fdf4, #ecfdf5);
        color: #15803d;
        border-left: 4px solid var(--success-color);
    }

    .alert-error {
        background: linear-gradient(135deg, #fef2f2, #fff5f5);
        color: #b91c1c;
        border-left: 4px solid var(--danger-color);
    }

    .alert-warning {
        background: linear-gradient(135deg, #fffbeb, #fefce8);
        color: #b45309;
        border-left: 4px solid var(--warning-color);
    }

    .alert-info {
        background: linear-gradient(135deg, #eff6ff, #f0f9ff);
        color: var(--primary-dark);
        border-left: 4px solid var(--primary-color);
    }

    .alert-icon {
        font-size: 1.25rem;
        flex-shrink: 0;
    }

    /* Stats Cards */
    .stats-grid {
        display: grid;
        grid-template-columns: repeat(1, 1fr);
        gap: 20px;
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
        padding: 24px;
        transition: var(--transition);
        cursor: pointer;
        position: relative;
        overflow: hidden;
        border: 1px solid rgba(37, 99, 235, 0.08);
        box-shadow: var(--shadow-sm);
    }

    .stat-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 3px;
        background: linear-gradient(90deg, var(--primary-color), #60a5fa);
        transform: scaleX(0);
        transition: transform 0.3s ease;
    }

    .stat-card:hover::before,
    .stat-card.active::before {
        transform: scaleX(1);
    }

    .stat-card:hover {
        transform: translateY(-4px);
        box-shadow: var(--shadow-lg);
        border-color: rgba(37, 99, 235, 0.2);
    }

    .stat-card.active {
        border-color: var(--primary-color);
        background: linear-gradient(135deg, #ffffff, #f8fafc);
    }

    .stat-icon {
        width: 52px;
        height: 52px;
        border-radius: 16px;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-bottom: 16px;
        font-size: 1.5rem;
    }

    .stat-icon.total {
        background: linear-gradient(135deg, #eff6ff, #dbeafe);
        color: var(--primary-color);
    }

    .stat-icon.draft {
        background: linear-gradient(135deg, #f3f4f6, #e5e7eb);
        color: #6b7280;
    }

    .stat-icon.pending {
        background: linear-gradient(135deg, #fffbeb, #fef3c7);
        color: var(--warning-color);
    }

    .stat-icon.approved {
        background: linear-gradient(135deg, #f0fdf4, #dcfce7);
        color: var(--success-color);
    }

    .stat-label {
        font-size: 0.75rem;
        color: var(--gray-500);
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.05em;
        margin-bottom: 8px;
    }

    .stat-value {
        font-size: 2rem;
        font-weight: 800;
        color: var(--gray-800);
        line-height: 1.2;
    }

    /* Buttons */
    .btn {
        padding: 10px 20px;
        border-radius: var(--border-radius-xs);
        font-size: 0.875rem;
        font-weight: 600;
        text-decoration: none;
        cursor: pointer;
        border: 1px solid transparent;
        transition: var(--transition);
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        white-space: nowrap;
    }

    .btn-primary {
        background: linear-gradient(135deg, var(--primary-color), var(--primary-dark));
        color: white;
        box-shadow: var(--shadow-sm);
    }

    .btn-primary:hover {
        transform: translateY(-2px);
        box-shadow: var(--shadow-md);
    }

    .btn-outline {
        background: white;
        color: var(--primary-color);
        border-color: rgba(37, 99, 235, 0.3);
    }

    .btn-outline:hover {
        background: var(--primary-bg-light);
        border-color: var(--primary-color);
        transform: translateY(-1px);
    }

    /* News Grid */
    .news-grid {
        display: grid;
        grid-template-columns: repeat(1, 1fr);
        gap: 28px;
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
        border: 1px solid rgba(37, 99, 235, 0.08);
        box-shadow: var(--shadow-sm);
        overflow: hidden;
        transition: var(--transition);
        display: flex;
        flex-direction: column;
        height: 100%;
    }

    .news-card:hover {
        border-color: rgba(37, 99, 235, 0.25);
        box-shadow: var(--shadow-xl);
        transform: translateY(-6px);
    }

    .news-image-container {
        position: relative;
        width: 100%;
        padding-top: 56.25%;
        overflow: hidden;
        background: linear-gradient(135deg, var(--primary-bg-light), #eef2ff);
    }

    .news-image {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.4s ease;
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

    .news-title {
        font-size: 1.125rem;
        font-weight: 700;
        color: var(--gray-800);
        line-height: 1.4;
        margin-bottom: 12px;
    }

    /* Status Badge */
    .status-badge {
        display: inline-flex;
        align-items: center;
        padding: 5px 12px;
        border-radius: 30px;
        font-size: 0.7rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.03em;
        gap: 6px;
        backdrop-filter: blur(8px);
    }

    .status-draft {
        background: rgba(0, 0, 0, 0.65);
        color: white;
        border: none;
    }

    .status-pending {
        background: rgba(245, 158, 11, 0.9);
        color: white;
        border: none;
    }

    .status-approved {
        background: rgba(16, 185, 129, 0.9);
        color: white;
        border: none;
    }

    .status-rejected {
        background: rgba(239, 68, 68, 0.9);
        color: white;
        border: none;
    }

    .news-excerpt {
        font-size: 0.875rem;
        color: var(--gray-600);
        line-height: 1.6;
        margin-bottom: 20px;
        flex: 1;
        display: -webkit-box;
        -webkit-line-clamp: 3;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }

    .news-meta {
        display: flex;
        justify-content: space-between;
        align-items: center;
        font-size: 0.75rem;
        color: var(--gray-500);
        padding-top: 16px;
        border-top: 1px solid #f0f0f0;
        margin-top: auto;
        flex-wrap: wrap;
        gap: 12px;
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
        color: var(--primary-color);
        font-size: 0.75rem;
        opacity: 0.7;
    }

    .news-actions {
        display: flex;
        gap: 8px;
    }

    .btn-icon {
        padding: 8px;
        border-radius: var(--border-radius-xs);
        font-size: 0.875rem;
        background: white;
        border: 1px solid #e5e7eb;
        color: #6b7280;
        cursor: pointer;
        transition: var(--transition);
        display: flex;
        align-items: center;
        justify-content: center;
        width: 36px;
        height: 36px;
    }

    .btn-icon:hover {
        transform: translateY(-2px);
    }

    .btn-icon.edit:hover {
        background: var(--primary-bg-light);
        border-color: var(--primary-color);
        color: var(--primary-color);
    }

    .btn-icon.delete:hover {
        background: #fef2f2;
        border-color: var(--danger-color);
        color: var(--danger-color);
    }

    /* Category Badge */
    .category-badge {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        padding: 4px 12px;
        border-radius: 30px;
        font-size: 0.7rem;
        font-weight: 600;
        background: linear-gradient(135deg, #eff6ff, #f0f9ff);
        color: var(--primary-dark);
        width: fit-content;
        margin-bottom: 12px;
    }

    /* Empty State */
    .empty-state {
        text-align: center;
        padding: 80px 40px;
        background: white;
        border-radius: var(--border-radius);
        border: 1px solid rgba(37, 99, 235, 0.08);
        grid-column: 1 / -1;
    }

    .empty-icon {
        width: 80px;
        height: 80px;
        background: linear-gradient(135deg, #eff6ff, #eef2ff);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 24px;
        font-size: 2rem;
        color: var(--primary-color);
    }

    .empty-title {
        font-size: 1.25rem;
        font-weight: 700;
        color: var(--gray-700);
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
        border-top: 1px solid #f0f0f0;
    }

    .pagination {
        display: flex;
        gap: 8px;
        align-items: center;
        flex-wrap: wrap;
    }

    .pagination-link {
        padding: 8px 14px;
        border: 1px solid #e5e7eb;
        border-radius: var(--border-radius-xs);
        font-size: 0.875rem;
        color: #6b7280;
        text-decoration: none;
        transition: var(--transition);
        min-width: 40px;
        text-align: center;
        background: white;
    }

    .pagination-link:hover {
        border-color: var(--primary-color);
        color: var(--primary-color);
        transform: translateY(-2px);
    }

    .pagination-link.active {
        background: linear-gradient(135deg, var(--primary-color), var(--primary-dark));
        border-color: transparent;
        color: white;
    }

    .pagination-link.disabled {
        opacity: 0.5;
        cursor: not-allowed;
        background-color: #f9fafb;
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
        
        .news-grid {
            grid-template-columns: 1fr;
        }
        
        .stat-card {
            padding: 20px;
        }
        
        .stat-value {
            font-size: 1.75rem;
        }
        
        .empty-state {
            padding: 40px 20px;
        }
    }

    @media (max-width: 480px) {
        .page-title {
            font-size: 1.35rem;
        }
        
        .alert {
            padding: 12px 16px;
            font-size: 0.85rem;
        }
        
        .news-content {
            padding: 20px;
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
            <h1 class="page-title">📰 Data Berita</h1>
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
                <i class="fas fa-pen-fancy"></i>
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
                                <i class="fas fa-pen-fancy"></i> Draft
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
                            <i class="fas fa-folder-open"></i>
                            {{ $n->category->name ?? '' }}
                        </div>
                    @endif
                    
                    <!-- Title -->
                    <h3 class="news-title">
                        {{ $n->title }}
                    </h3>
                    
                    <!-- Excerpt -->
                    <div class="news-excerpt">
                        {{ Str::limit(strip_tags($n->content), 120) }}
                    </div>
                    
                    <!-- Meta & Actions -->
                    <div class="news-meta">
                        <div class="meta-left">
                            <div class="meta-item">
                                <i class="fas fa-calendar-alt meta-icon"></i>
                                <span>{{ $n->created_at->translatedFormat('d M Y') }}</span>
                            </div>
                            
                            @if($n->views)
                                <div class="meta-item">
                                    <i class="fas fa-eye meta-icon"></i>
                                    <span>{{ number_format($n->views) }}</span>
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
                                    <i class="fas fa-trash-alt"></i>
                                </button>
                            </form>
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