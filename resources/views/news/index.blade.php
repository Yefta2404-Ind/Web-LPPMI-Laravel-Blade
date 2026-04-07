@extends('layouts.cms')

@section('page-title', 'Data Berita')
@section('content')
<style>
/* ============================================
   DATA BERITA - FULL RESPONSIVE
   MOBILE FIRST APPROACH
   ============================================ */

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
    --border-radius: 16px;
    --border-radius-sm: 12px;
    --border-radius-xs: 8px;
    --shadow-sm: 0 1px 2px 0 rgba(0, 0, 0, 0.03);
    --shadow: 0 1px 3px 0 rgba(0, 0, 0, 0.05);
    --shadow-md: 0 4px 6px -1px rgba(0, 0, 0, 0.05);
    --shadow-lg: 0 10px 15px -3px rgba(0, 0, 0, 0.08);
    --transition: all 0.25s ease;
}

* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

/* ============================================
   MOBILE FIRST (0 - 768px)
   ============================================ */

/* Container */
.admin-container {
    width: 100%;
    max-width: 1400px;
    margin: 0 auto;
    padding: 12px;
}

/* Page Header */
.page-header {
    margin-bottom: 20px;
    padding-bottom: 16px;
    border-bottom: 2px solid rgba(37, 99, 235, 0.1);
}

.page-title {
    font-size: 1.35rem;
    font-weight: 700;
    color: var(--gray-800);
    margin-bottom: 6px;
    display: flex;
    align-items: center;
    gap: 8px;
}

.page-description {
    color: var(--gray-500);
    font-size: 0.75rem;
    line-height: 1.4;
}

/* Alerts */
.alert {
    padding: 12px 14px;
    border-radius: var(--border-radius-sm);
    margin-bottom: 16px;
    display: flex;
    align-items: center;
    gap: 10px;
    font-size: 0.8rem;
    animation: slideIn 0.3s ease;
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
    background: #ecfdf5;
    color: #065f46;
    border-left: 3px solid var(--success-color);
}

.alert-error {
    background: #fef2f2;
    color: #991b1b;
    border-left: 3px solid var(--danger-color);
}

.alert i {
    font-size: 1rem;
    flex-shrink: 0;
}

/* Stats Cards - Mobile */
.stats-grid {
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    gap: 12px;
    margin-bottom: 20px;
}

.stat-card {
    background: white;
    border-radius: var(--border-radius-sm);
    padding: 14px;
    transition: var(--transition);
    border: 1px solid #e5e7eb;
    box-shadow: var(--shadow-sm);
    cursor: pointer;
}

.stat-card:active {
    transform: scale(0.98);
}

.stat-card.active {
    border-color: var(--primary-color);
    background: var(--primary-bg-light);
}

.stat-icon {
    width: 40px;
    height: 40px;
    border-radius: var(--border-radius-xs);
    display: flex;
    align-items: center;
    justify-content: center;
    margin-bottom: 10px;
    font-size: 1.1rem;
}

.stat-icon.total {
    background: #eff6ff;
    color: var(--primary-color);
}

.stat-icon.draft {
    background: #f3f4f6;
    color: #6b7280;
}

.stat-icon.pending {
    background: #fffbeb;
    color: var(--warning-color);
}

.stat-icon.approved {
    background: #f0fdf4;
    color: var(--success-color);
}

.stat-label {
    font-size: 0.6rem;
    color: var(--gray-500);
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: 0.03em;
    margin-bottom: 4px;
}

.stat-value {
    font-size: 1.5rem;
    font-weight: 700;
    color: var(--gray-800);
    line-height: 1.2;
}

/* News Grid - Mobile */
.news-grid {
    display: flex;
    flex-direction: column;
    gap: 16px;
    margin-bottom: 24px;
}

/* News Card - Mobile */
.news-card {
    background: white;
    border-radius: var(--border-radius-sm);
    border: 1px solid #e5e7eb;
    overflow: hidden;
    transition: var(--transition);
}

.news-card:active {
    transform: scale(0.99);
}

.news-image-container {
    position: relative;
    width: 100%;
    height: 180px;
    overflow: hidden;
    background: #f3f4f6;
}

.news-image {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

.news-status {
    position: absolute;
    top: 10px;
    right: 10px;
    z-index: 2;
}

/* Status Badge */
.status-badge {
    display: inline-flex;
    align-items: center;
    gap: 5px;
    padding: 4px 10px;
    border-radius: 20px;
    font-size: 0.65rem;
    font-weight: 600;
    backdrop-filter: blur(4px);
}

.status-draft {
    background: rgba(0, 0, 0, 0.7);
    color: white;
}

.status-pending {
    background: rgba(245, 158, 11, 0.9);
    color: white;
}

.status-approved {
    background: rgba(16, 185, 129, 0.9);
    color: white;
}

.status-rejected {
    background: rgba(239, 68, 68, 0.9);
    color: white;
}

/* News Content */
.news-content {
    padding: 14px;
}

.category-badge {
    display: inline-flex;
    align-items: center;
    gap: 5px;
    padding: 3px 10px;
    border-radius: 20px;
    font-size: 0.65rem;
    font-weight: 600;
    background: #eff6ff;
    color: var(--primary-dark);
    margin-bottom: 10px;
}

.news-title {
    font-size: 1rem;
    font-weight: 700;
    color: var(--gray-800);
    line-height: 1.35;
    margin-bottom: 8px;
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
    overflow: hidden;
}

.news-excerpt {
    font-size: 0.75rem;
    color: var(--gray-600);
    line-height: 1.5;
    margin-bottom: 12px;
    display: -webkit-box;
    -webkit-line-clamp: 3;
    -webkit-box-orient: vertical;
    overflow: hidden;
}

/* News Meta */
.news-meta {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding-top: 10px;
    border-top: 1px solid #f0f0f0;
    flex-wrap: wrap;
    gap: 10px;
}

.meta-left {
    display: flex;
    align-items: center;
    gap: 12px;
    flex-wrap: wrap;
}

.meta-item {
    display: flex;
    align-items: center;
    gap: 5px;
    font-size: 0.65rem;
    color: var(--gray-500);
}

.meta-item i {
    font-size: 0.6rem;
    color: var(--primary-color);
}

/* Action Buttons */
.news-actions {
    display: flex;
    gap: 8px;
}

.btn-icon {
    width: 32px;
    height: 32px;
    border-radius: var(--border-radius-xs);
    display: flex;
    align-items: center;
    justify-content: center;
    background: white;
    border: 1px solid #e5e7eb;
    cursor: pointer;
    transition: var(--transition);
    color: #6b7280;
    text-decoration: none;
}

.btn-icon:active {
    transform: scale(0.95);
}

.btn-icon.edit:active {
    background: #eff6ff;
    border-color: var(--primary-color);
    color: var(--primary-color);
}

.btn-icon.delete:active {
    background: #fef2f2;
    border-color: var(--danger-color);
    color: var(--danger-color);
}

/* Empty State */
.empty-state {
    text-align: center;
    padding: 40px 20px;
    background: white;
    border-radius: var(--border-radius-sm);
    border: 1px solid #e5e7eb;
}

.empty-icon {
    width: 60px;
    height: 60px;
    background: #eff6ff;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 0 auto 16px;
    font-size: 1.5rem;
    color: var(--primary-color);
}

.empty-title {
    font-size: 1rem;
    font-weight: 700;
    color: var(--gray-700);
    margin-bottom: 6px;
}

.empty-description {
    font-size: 0.75rem;
    color: var(--gray-500);
    margin-bottom: 16px;
    max-width: 280px;
    margin-left: auto;
    margin-right: auto;
}

/* Buttons */
.btn {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    gap: 8px;
    padding: 8px 16px;
    border-radius: var(--border-radius-xs);
    font-size: 0.75rem;
    font-weight: 600;
    text-decoration: none;
    cursor: pointer;
    border: 1px solid transparent;
    transition: var(--transition);
}

.btn-primary {
    background: var(--primary-color);
    color: white;
}

.btn-primary:active {
    transform: scale(0.97);
}

.btn-outline {
    background: white;
    color: var(--primary-color);
    border-color: #e5e7eb;
}

.btn-outline:active {
    background: #eff6ff;
    transform: scale(0.97);
}

/* Pagination - Mobile */
.pagination-container {
    margin-top: 20px;
    padding-top: 16px;
    border-top: 1px solid #f0f0f0;
}

.pagination {
    display: flex;
    justify-content: center;
    gap: 6px;
    flex-wrap: wrap;
}

.pagination-link {
    padding: 6px 11px;
    border: 1px solid #e5e7eb;
    border-radius: var(--border-radius-xs);
    font-size: 0.7rem;
    color: #6b7280;
    text-decoration: none;
    background: white;
    min-width: 34px;
    text-align: center;
}

.pagination-link:active {
    transform: scale(0.95);
}

.pagination-link.active {
    background: var(--primary-color);
    border-color: var(--primary-color);
    color: white;
}

.pagination-link.disabled {
    opacity: 0.5;
    cursor: not-allowed;
}

/* ============================================
   TABLET (min-width: 768px)
   ============================================ */
@media (min-width: 768px) {
    .admin-container {
        padding: 20px 24px;
    }
    
    .page-header {
        margin-bottom: 28px;
        padding-bottom: 20px;
    }
    
    .page-title {
        font-size: 1.6rem;
    }
    
    .page-description {
        font-size: 0.85rem;
    }
    
    .stats-grid {
        grid-template-columns: repeat(4, 1fr);
        gap: 16px;
        margin-bottom: 28px;
    }
    
    .stat-card {
        padding: 18px;
    }
    
    .stat-card:hover {
        transform: translateY(-2px);
        box-shadow: var(--shadow-md);
    }
    
    .stat-icon {
        width: 48px;
        height: 48px;
        font-size: 1.3rem;
    }
    
    .stat-label {
        font-size: 0.7rem;
    }
    
    .stat-value {
        font-size: 1.8rem;
    }
    
    .news-grid {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 20px;
    }
    
    .news-image-container {
        height: 200px;
    }
    
    .news-content {
        padding: 16px;
    }
    
    .news-title {
        font-size: 1.1rem;
    }
    
    .news-excerpt {
        font-size: 0.8rem;
    }
    
    .btn-icon:hover {
        transform: translateY(-2px);
    }
    
    .btn-icon.edit:hover {
        background: #eff6ff;
        border-color: var(--primary-color);
        color: var(--primary-color);
    }
    
    .btn-icon.delete:hover {
        background: #fef2f2;
        border-color: var(--danger-color);
        color: var(--danger-color);
    }
    
    .empty-state {
        padding: 60px 40px;
    }
    
    .empty-icon {
        width: 80px;
        height: 80px;
        font-size: 2rem;
    }
    
    .empty-title {
        font-size: 1.2rem;
    }
    
    .empty-description {
        font-size: 0.85rem;
        max-width: 400px;
    }
    
    .pagination-link {
        padding: 8px 14px;
        font-size: 0.8rem;
    }
    
    .pagination-link:hover {
        border-color: var(--primary-color);
        color: var(--primary-color);
        transform: translateY(-2px);
    }
}

/* ============================================
   DESKTOP (min-width: 1024px)
   ============================================ */
@media (min-width: 1024px) {
    .admin-container {
        padding: 24px 32px;
    }
    
    .news-grid {
        grid-template-columns: repeat(3, 1fr);
        gap: 24px;
    }
    
    .news-image-container {
        height: 220px;
    }
    
    .stat-card {
        padding: 20px;
    }
    
    .stat-value {
        font-size: 2rem;
    }
}

/* ============================================
   LARGE DESKTOP (min-width: 1280px)
   ============================================ */
@media (min-width: 1280px) {
    .news-grid {
        grid-template-columns: repeat(3, 1fr);
        gap: 28px;
    }
}

/* ============================================
   TOUCH DEVICE OPTIMIZATIONS
   ============================================ */
@media (hover: none) and (pointer: coarse) {
    .btn-icon,
    .stat-card,
    .pagination-link,
    .btn {
        min-height: 44px;
    }
    
    .btn-icon {
        min-width: 44px;
    }
    
    .stat-card {
        cursor: pointer;
    }
}

/* ============================================
   PRINT STYLES
   ============================================ */
@media print {
    .stats-grid,
    .news-actions,
    .pagination-container,
    .alert {
        display: none;
    }
    
    .news-card {
        break-inside: avoid;
        border: 1px solid #ddd;
        margin-bottom: 20px;
    }
    
    .news-image-container {
        height: 150px;
    }
}
</style>

<div class="admin-container">
    <!-- Page Header -->
    <div class="page-header">
        <h1 class="page-title">
            📰 Data Berita
        </h1>
        <p class="page-description">Kelola berita yang Anda buat. Lihat status, edit, atau hapus berita.</p>
    </div>

    <!-- Alerts -->
    @if(session('success'))
        <div class="alert alert-success">
            <i class="fas fa-check-circle"></i>
            <span style="flex: 1;">{{ session('success') }}</span>
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-error">
            <i class="fas fa-exclamation-circle"></i>
            <span style="flex: 1;">{{ session('error') }}</span>
        </div>
    @endif

    @if(session('warning'))
        <div class="alert alert-warning">
            <i class="fas fa-exclamation-triangle"></i>
            <span style="flex: 1;">{{ session('warning') }}</span>
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
            <div class="stat-label">Total Berita</div>
            <div class="stat-value">{{ $totalNews }}</div>
        </div>

        <div class="stat-card {{ $currentStatus == 'draft' ? 'active' : '' }}" onclick="filterByStatus('draft')">
            <div class="stat-icon draft">
                <i class="fas fa-pen-fancy"></i>
            </div>
            <div class="stat-label">Draft</div>
            <div class="stat-value">{{ $draftCount }}</div>
        </div>

        <div class="stat-card {{ $currentStatus == 'pending' ? 'active' : '' }}" onclick="filterByStatus('pending')">
            <div class="stat-icon pending">
                <i class="fas fa-clock"></i>
            </div>
            <div class="stat-label">Menunggu</div>
            <div class="stat-value">{{ $pendingCount }}</div>
        </div>

        <div class="stat-card {{ $currentStatus == 'approved' ? 'active' : '' }}" onclick="filterByStatus('approved')">
            <div class="stat-icon approved">
                <i class="fas fa-check-circle"></i>
            </div>
            <div class="stat-label">Disetujui</div>
            <div class="stat-value">{{ $approvedCount }}</div>
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
                            {{ $n->category->name ?? 'Uncategorized' }}
                        </div>
                    @endif
                    
                    <!-- Title -->
                    <h3 class="news-title">
                        {{ Str::limit($n->title, 60) }}
                    </h3>
                    
                    <!-- Excerpt -->
                    <div class="news-excerpt">
                        {{ Str::limit(strip_tags($n->content), 100) }}
                    </div>
                    
                    <!-- Meta & Actions -->
                    <div class="news-meta">
                        <div class="meta-left">
                            <div class="meta-item">
                                <i class="fas fa-calendar-alt"></i>
                                <span>{{ $n->created_at->translatedFormat('d M Y') }}</span>
                            </div>
                            
                            @if($n->views)
                                <div class="meta-item">
                                    <i class="fas fa-eye"></i>
                                    <span>{{ number_format($n->views) }}</span>
                                </div>
                            @endif
                        </div>
                        
                        <div class="news-actions">
                            <!-- Edit Button (only for draft/rejected) -->
                            @if(in_array($n->status, ['draft', 'rejected']))
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
                                  onsubmit="return confirm('Apakah Anda yakin ingin menghapus berita ini?')"
                                  style="display: inline;">
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
                        <i class="fas fa-chevron-left"></i>
                    </span>
                @else
                    <a href="{{ $news->previousPageUrl() }}" class="pagination-link">
                        <i class="fas fa-chevron-left"></i>
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
                        <i class="fas fa-chevron-right"></i>
                    </a>
                @else
                    <span class="pagination-link disabled">
                        <i class="fas fa-chevron-right"></i>
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

// Auto-hide alerts after 4 seconds
document.addEventListener('DOMContentLoaded', function() {
    const alerts = document.querySelectorAll('.alert');
    alerts.forEach(alert => {
        setTimeout(() => {
            alert.style.transition = 'opacity 0.3s ease';
            alert.style.opacity = '0';
            setTimeout(() => {
                if (alert && alert.remove) alert.remove();
            }, 300);
        }, 4000);
    });
    
    // Touch feedback for mobile
    const touchElements = document.querySelectorAll('.stat-card, .btn-icon, .pagination-link, .btn');
    touchElements.forEach(el => {
        el.addEventListener('touchstart', function() {
            this.style.transform = 'scale(0.97)';
        });
        el.addEventListener('touchend', function() {
            this.style.transform = '';
        });
        el.addEventListener('touchcancel', function() {
            this.style.transform = '';
        });
    });
});
</script>
@endsection