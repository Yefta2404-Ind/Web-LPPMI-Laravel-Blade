@extends('layouts.admin')

@section('content')
<style>
/* ============================================
   RESET & VARIABLES
   ============================================ */
:root {
    --primary-color: #2563eb;
    --primary-light: #3b82f6;
    --primary-dark: #1d4ed8;
    --primary-soft: #dbeafe;
    --success-color: #059669;
    --danger-color: #dc2626;
    --warning-color: #d97706;
    --secondary-color: #64748b;
    --text-primary: #0f172a;
    --text-secondary: #475569;
    --text-muted: #64748b;
    --border-color: #e2e8f0;
    --light-bg: #f8fafc;
    --white: #ffffff;
    --shadow-sm: 0 1px 2px 0 rgb(0 0 0 / 0.05);
    --radius-sm: 0.5rem;
    --radius-md: 0.75rem;
    --radius-lg: 1rem;
}

* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

/* ============================================
   MOBILE FIRST STYLES (0 - 767px)
   ============================================ */
.container-fluid {
    width: 100%;
    padding: 12px !important;
    margin: 0 auto;
}

/* Header - Stack di mobile */
.header-wrapper {
    display: flex;
    flex-direction: column;
    gap: 12px;
    margin-bottom: 16px;
}

.header-title h1 {
    font-size: 20px;
    font-weight: 700;
    color: var(--text-primary);
    margin-bottom: 4px;
    display: flex;
    align-items: center;
    gap: 8px;
}

.header-title h1 i {
    color: var(--primary-color);
    background: var(--primary-soft);
    padding: 8px;
    border-radius: var(--radius-md);
    font-size: 16px;
}

.header-title p {
    font-size: 12px;
    color: var(--text-muted);
    margin-bottom: 0;
    display: flex;
    align-items: center;
    gap: 4px;
}

/* Tombol Primary - Full width di mobile */
.btn-primary {
    background: var(--primary-color);
    border: none;
    padding: 12px 16px;
    font-size: 14px;
    font-weight: 500;
    border-radius: var(--radius-md);
    transition: all 0.2s ease;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 8px;
    color: white;
    width: 100%;
    cursor: pointer;
    text-decoration: none;
}

.btn-primary:active {
    transform: scale(0.98);
    background: var(--primary-dark);
}

/* Alert */
.alert {
    border-radius: var(--radius-md);
    margin-bottom: 16px;
    padding: 12px;
    font-size: 12px;
    display: flex;
    align-items: center;
    gap: 8px;
    background: var(--white);
    border-left: 3px solid;
    box-shadow: var(--shadow-sm);
}

.alert-success {
    border-left-color: var(--success-color);
    background: #ecfdf5;
    color: var(--success-color);
}

.alert-danger {
    border-left-color: var(--danger-color);
    background: #fef2f2;
    color: var(--danger-color);
}

.alert i {
    font-size: 14px;
}

.alert .btn-close {
    margin-left: auto;
    background: none;
    border: none;
    font-size: 18px;
    cursor: pointer;
    padding: 0 4px;
}

/* Card */
.card {
    background: var(--white);
    border-radius: var(--radius-lg);
    overflow: hidden;
    box-shadow: var(--shadow-sm);
    border: 1px solid var(--border-color);
}

/* ============================================
   CARD LAYOUT UNTUK HP - TIDAK PAKAI TABLE!
   ============================================ */
/* Sembunyikan tabel di mobile */
.table-responsive {
    display: none;
}

/* Tampilan card untuk mobile */
.mobile-card-view {
    display: flex;
    flex-direction: column;
    gap: 12px;
    padding: 12px;
}

.mobile-item-card {
    background: var(--white);
    border: 1px solid var(--border-color);
    border-radius: var(--radius-md);
    overflow: hidden;
    transition: all 0.2s ease;
}

.mobile-item-card:active {
    transform: scale(0.99);
    background: var(--light-bg);
}

.card-header-mobile {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 12px;
    background: var(--light-bg);
    border-bottom: 1px solid var(--border-color);
}

.card-number {
    background: var(--primary-soft);
    color: var(--primary-color);
    width: 28px;
    height: 28px;
    display: flex;
    align-items: center;
    justify-content: center;
    border-radius: var(--radius-sm);
    font-weight: 600;
    font-size: 12px;
}

.status-badge-mobile {
    padding: 4px 10px;
    border-radius: 20px;
    font-size: 10px;
    font-weight: 600;
    display: inline-flex;
    align-items: center;
    gap: 4px;
    border: none;
    cursor: pointer;
}

.status-active {
    background: var(--success-color);
    color: white;
}

.status-draft {
    background: var(--secondary-color);
    color: white;
}

.card-body-mobile {
    padding: 12px;
}

.info-row {
    margin-bottom: 12px;
    padding-bottom: 12px;
    border-bottom: 1px solid var(--border-color);
}

.info-row:last-child {
    margin-bottom: 0;
    padding-bottom: 0;
    border-bottom: none;
}

.info-label {
    font-size: 10px;
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    color: var(--text-muted);
    margin-bottom: 6px;
    display: flex;
    align-items: center;
    gap: 4px;
}

.info-value {
    font-size: 13px;
    color: var(--text-primary);
    word-break: break-word;
}

.info-value code {
    background: var(--primary-soft);
    padding: 4px 8px;
    border-radius: var(--radius-sm);
    font-size: 12px;
    color: var(--primary-dark);
    display: inline-block;
}

.meta-info {
    display: flex;
    gap: 12px;
    font-size: 11px;
    color: var(--text-muted);
}

.meta-info i {
    font-size: 10px;
}

.description-text {
    font-size: 11px;
    color: var(--text-muted);
    margin-top: 4px;
    line-height: 1.4;
}

/* Action buttons mobile */
.action-buttons-mobile {
    display: flex;
    gap: 8px;
    margin-top: 12px;
    padding-top: 12px;
    border-top: 1px solid var(--border-color);
}

.btn-mobile {
    flex: 1;
    padding: 10px;
    border-radius: var(--radius-sm);
    font-size: 12px;
    font-weight: 500;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 6px;
    cursor: pointer;
    text-decoration: none;
    border: 1px solid;
    background: var(--white);
    transition: all 0.2s;
}

.btn-mobile:active {
    transform: scale(0.97);
}

.btn-mobile-preview {
    border-color: var(--secondary-color);
    color: var(--secondary-color);
}

.btn-mobile-edit {
    border-color: var(--primary-color);
    color: var(--primary-color);
}

.btn-mobile-delete {
    border-color: var(--danger-color);
    color: var(--danger-color);
}

/* Empty state mobile */
.empty-state-mobile {
    text-align: center;
    padding: 48px 20px;
}

.empty-state-mobile i {
    font-size: 48px;
    color: var(--primary-soft);
    margin-bottom: 16px;
}

.empty-state-mobile p {
    font-size: 14px;
    color: var(--text-primary);
    margin-bottom: 20px;
}

/* Pagination mobile */
.pagination-mobile {
    padding: 12px;
    background: var(--light-bg);
    border-top: 1px solid var(--border-color);
}

.pagination-stats {
    text-align: center;
    font-size: 11px;
    color: var(--text-muted);
    margin-bottom: 12px;
}

.pagination-buttons {
    display: flex;
    flex-wrap: wrap;
    justify-content: center;
    gap: 6px;
}

.page-btn {
    padding: 6px 10px;
    border: 1px solid var(--border-color);
    background: var(--white);
    border-radius: var(--radius-sm);
    font-size: 12px;
    color: var(--primary-color);
    cursor: pointer;
    text-decoration: none;
    display: inline-flex;
    align-items: center;
    gap: 4px;
}

.page-btn.active {
    background: var(--primary-color);
    color: white;
    border-color: var(--primary-color);
}

.page-btn:active {
    transform: scale(0.95);
}

/* ============================================
   TABLET KE ATAS (min-width: 768px)
   ============================================ */
@media (min-width: 768px) {
    .container-fluid {
        padding: 20px !important;
        max-width: 1400px;
        margin: 0 auto;
    }
    
    .header-wrapper {
        flex-direction: row;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 24px;
    }
    
    .header-title h1 {
        font-size: 24px;
    }
    
    .btn-primary {
        width: auto;
        padding: 10px 20px;
    }
    
    /* Sembunyikan mobile card view */
    .mobile-card-view {
        display: none;
    }
    
    /* Tampilkan tabel */
    .table-responsive {
        display: block;
        overflow-x: auto;
        -webkit-overflow-scrolling: touch;
    }
    
    .table {
        width: 100%;
        margin: 0;
        min-width: 600px;
    }
    
    .table thead th {
        background: var(--light-bg);
        font-weight: 600;
        font-size: 12px;
        text-transform: uppercase;
        padding: 12px;
        border-bottom: 2px solid var(--border-color);
    }
    
    .table tbody td {
        padding: 12px;
        vertical-align: middle;
        border-bottom: 1px solid var(--border-color);
        font-size: 13px;
    }
    
    .row-number {
        display: inline-flex;
        width: 28px;
        height: 28px;
        background: var(--primary-soft);
        color: var(--primary-color);
        border-radius: var(--radius-sm);
        align-items: center;
        justify-content: center;
        font-weight: 600;
        font-size: 12px;
    }
    
    .page-title {
        font-weight: 600;
        margin-bottom: 4px;
        font-size: 14px;
    }
    
    .page-description {
        font-size: 11px;
        color: var(--text-muted);
    }
    
    .slug-container {
        background: var(--primary-soft);
        padding: 4px 8px;
        border-radius: var(--radius-sm);
        display: inline-block;
    }
    
    .slug-container code {
        font-size: 11px;
        color: var(--primary-dark);
    }
    
    .status-badge {
        padding: 5px 12px;
        border-radius: 20px;
        font-size: 11px;
        font-weight: 600;
        border: none;
        cursor: pointer;
        display: inline-flex;
        align-items: center;
        gap: 5px;
    }
    
    .status-badge.bg-success {
        background: var(--success-color);
        color: white;
    }
    
    .status-badge.bg-secondary {
        background: var(--secondary-color);
        color: white;
    }
    
    .date-text {
        font-size: 11px;
        display: flex;
        align-items: center;
        gap: 5px;
    }
    
    .action-buttons {
        display: flex;
        gap: 6px;
        justify-content: flex-end;
    }
    
    .btn-sm {
        padding: 6px 10px;
        font-size: 11px;
        border-radius: var(--radius-sm);
        border: 1px solid;
        background: var(--white);
        cursor: pointer;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 4px;
    }
    
    .btn-outline-secondary {
        border-color: var(--secondary-color);
        color: var(--secondary-color);
    }
    
    .btn-outline-primary {
        border-color: var(--primary-color);
        color: var(--primary-color);
    }
    
    .btn-outline-danger {
        border-color: var(--danger-color);
        color: var(--danger-color);
    }
    
    .card-footer {
        padding: 12px 16px;
        background: var(--light-bg);
        border-top: 1px solid var(--border-color);
    }
    
    .pagination {
        display: flex;
        gap: 4px;
        justify-content: flex-end;
        margin: 0;
    }
    
    .page-link {
        padding: 5px 10px;
        font-size: 12px;
        border: 1px solid var(--border-color);
        border-radius: var(--radius-sm);
        color: var(--primary-color);
        text-decoration: none;
    }
    
    .page-item.active .page-link {
        background: var(--primary-color);
        color: white;
        border-color: var(--primary-color);
    }
}

/* ============================================
   DESKTOP (min-width: 1024px)
   ============================================ */
@media (min-width: 1024px) {
    .container-fluid {
        padding: 24px !important;
    }
    
    .table thead th {
        padding: 14px 16px;
        font-size: 13px;
    }
    
    .table tbody td {
        padding: 14px 16px;
        font-size: 14px;
    }
    
    .btn-sm {
        padding: 7px 14px;
        font-size: 12px;
    }
    
    .btn-sm:hover {
        transform: translateY(-1px);
    }
}

/* ============================================
   UTILITY CLASSES
   ============================================ */
.text-end {
    text-align: right;
}

.d-inline {
    display: inline;
}

.me-1 {
    margin-right: 4px;
}

.me-2 {
    margin-right: 8px;
}

.mt-1 {
    margin-top: 4px;
}

.mb-0 {
    margin-bottom: 0;
}

.w-100 {
    width: 100%;
}
</style>

<div class="container-fluid">
    <!-- Header -->
    <div class="header-wrapper">
        <div class="header-title">
            <h1>
                <i class="fas fa-file-alt"></i>
                Halaman
            </h1>
            <p>
                <i class="fas fa-info-circle"></i>
                Kelola semua halaman website
            </p>
        </div>
        <a href="{{ route('admin.pages.create') }}" class="btn-primary">
            <i class="fas fa-plus"></i>
            Tambah Halaman
        </a>
    </div>

    <!-- Alert -->
    @if(session('success'))
        <div class="alert alert-success">
            <i class="fas fa-check-circle"></i>
            <span style="flex: 1;">{{ session('success') }}</span>
            <button class="btn-close" onclick="this.parentElement.remove()">×</button>
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger">
            <i class="fas fa-exclamation-circle"></i>
            <span style="flex: 1;">{{ session('error') }}</span>
            <button class="btn-close" onclick="this.parentElement.remove()">×</button>
        </div>
    @endif

    <div class="card">
        <!-- TAMPILAN MOBILE (CARD LAYOUT) -->
        <div class="mobile-card-view">
            @forelse($pages as $page)
            <div class="mobile-item-card">
                <div class="card-header-mobile">
                    <span class="card-number">{{ $loop->iteration }}</span>
                    <form action="{{ route('admin.pages.toggle-status', $page) }}" method="POST" class="d-inline">
                        @csrf
                        <button type="submit" class="status-badge-mobile {{ $page->status === 'published' ? 'status-active' : 'status-draft' }}">
                            <i class="fas {{ $page->status === 'published' ? 'fa-eye' : 'fa-eye-slash' }}"></i>
                            {{ $page->status === 'published' ? 'Published' : 'Draft' }}
                        </button>
                    </form>
                </div>
                <div class="card-body-mobile">
                    <div class="info-row">
                        <div class="info-label">
                            <i class="fas fa-heading"></i> Judul Halaman
                        </div>
                        <div class="info-value">
                            <strong>{{ $page->title }}</strong>
                        </div>
                        @if($page->meta_description)
                            <div class="description-text">
                                <i class="fas fa-align-left"></i> {{ Str::limit($page->meta_description, 80) }}
                            </div>
                        @endif
                    </div>
                    
                    <div class="info-row">
                        <div class="info-label">
                            <i class="fas fa-link"></i> URL / Slug
                        </div>
                        <div class="info-value">
                            <code>/{{ $page->slug }}</code>
                        </div>
                    </div>
                    
                    <div class="info-row">
                        <div class="info-label">
                            <i class="far fa-calendar-alt"></i> Tanggal Dibuat
                        </div>
                        <div class="info-value">
                            <div class="meta-info">
                                <span><i class="far fa-calendar"></i> {{ $page->created_at->format('d M Y') }}</span>
                                <span><i class="far fa-clock"></i> {{ $page->created_at->format('H:i') }}</span>
                            </div>
                        </div>
                    </div>
                    
                    <div class="action-buttons-mobile">
                        <a href="{{ route('admin.pages.edit', $page) }}" class="btn-mobile btn-mobile-edit">
                            <i class="fas fa-edit"></i> Edit
                        </a>
                        <form action="{{ route('admin.pages.destroy', $page) }}" method="POST" class="d-inline w-100" onsubmit="return confirm('Hapus halaman "{{ $page->title }}"?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn-mobile btn-mobile-delete" style="width: 100%;">
                                <i class="fas fa-trash"></i> Hapus
                            </button>
                        </form>
                    </div>
                </div>
            </div>
            @empty
            <div class="empty-state-mobile">
                <i class="fas fa-file-alt"></i>
                <p>Belum ada halaman yang dibuat.</p>
                <a href="{{ route('admin.pages.create') }}" class="btn-primary">Buat halaman pertama</a>
            </div>
            @endforelse
        </div>

        <!-- TAMPILAN TABLET/DESKTOP (TABLE LAYOUT) -->
        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th class="ps-3" style="width: 60px;">No</th>
                        <th>Judul Halaman</th>
                        <th style="width: 180px;">URL / Slug</th>
                        <th style="width: 110px;">Status</th>
                        <th style="width: 130px;">Tanggal Dibuat</th>
                        <th class="text-end pe-3" style="width: 180px;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($pages as $page)
                    <tr>
                        <td class="ps-3">
                            <span class="row-number">{{ $loop->iteration }}</span>
                        </td>
                        <td>
                            <div class="page-title">{{ $page->title }}</div>
                            @if($page->meta_description)
                                <div class="page-description">
                                    <i class="fas fa-align-left"></i> {{ Str::limit($page->meta_description, 60) }}
                                </div>
                            @endif
                        </td>
                        <td>
                            <div class="slug-container">
                                <code>/{{ $page->slug }}</code>
                            </div>
                        </td>
                        <td>
                            <form action="{{ route('admin.pages.toggle-status', $page) }}" method="POST" class="d-inline">
                                @csrf
                                <button type="submit" class="status-badge {{ $page->status === 'published' ? 'bg-success' : 'bg-secondary' }}">
                                    <i class="fas {{ $page->status === 'published' ? 'fa-eye' : 'fa-eye-slash' }}"></i>
                                    {{ $page->status === 'published' ? 'Published' : 'Draft' }}
                                </button>
                            </form>
                        </td>
                        <td>
                            <div class="date-text">
                                <i class="far fa-calendar-alt"></i> {{ $page->created_at->format('d M Y') }}
                            </div>
                            <div class="date-text mt-1">
                                <i class="far fa-clock"></i> {{ $page->created_at->format('H:i') }}
                            </div>
                        </td>
                        <td class="text-end pe-3">
                            <div class="action-buttons">
                                
                                <a href="{{ route('admin.pages.edit', $page) }}" class="btn-sm btn-outline-primary" title="Edit">
                                    <i class="fas fa-edit"></i> Edit
                                </a>
                                <form action="{{ route('admin.pages.destroy', $page) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn-sm btn-outline-danger" title="Hapus" onclick="return confirm('Hapus halaman &quot;{{ $page->title }}&quot;?')">
                                        <i class="fas fa-trash"></i> Hapus
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="text-center py-5">
                            <div class="empty-state-mobile" style="padding: 40px;">
                                <i class="fas fa-file-alt"></i>
                                <p>Belum ada halaman yang dibuat.</p>
                                <a href="{{ route('admin.pages.create') }}" class="btn-primary" style="display: inline-block; width: auto;">Buat halaman pertama</a>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        
        <!-- Pagination -->
        @if(isset($pages) && method_exists($pages, 'links') && $pages->hasPages())
        <div class="card-footer">
            <div class="pagination-stats">
                <i class="fas fa-file"></i> Menampilkan {{ $pages->firstItem() ?? 0 }} - {{ $pages->lastItem() ?? 0 }} dari {{ $pages->total() }} halaman
            </div>
            <div class="pagination-buttons">
                {{ $pages->onEachSide(1)->links() }}
            </div>
        </div>
        @endif
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Auto-hide alert
    const alerts = document.querySelectorAll('.alert');
    alerts.forEach(alert => {
        setTimeout(() => {
            alert.style.opacity = '0';
            alert.style.transition = 'opacity 0.3s';
            setTimeout(() => {
                if (alert && alert.remove) alert.remove();
            }, 300);
        }, 4000);
    });
    
    // Touch feedback untuk mobile
    const touchElements = document.querySelectorAll('.btn-mobile, .status-badge-mobile, .btn-primary, .page-btn');
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