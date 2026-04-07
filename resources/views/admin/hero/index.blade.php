@extends('layouts.admin')

@section('page-title', 'Hero Banner')

@section('content')
@if(session('success'))
<div class="alert alert-success alert-dismissible fade show mb-4" role="alert">
    <i class="fas fa-check-circle me-2"></i>
    {{ session('success') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif

@if(session('error'))
<div class="alert alert-danger alert-dismissible fade show mb-4" role="alert">
    <i class="fas fa-exclamation-circle me-2"></i>
    {{ session('error') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif

<div class="approved-banner-container">
    <div class="approved-header">
        <h3><i class="fas fa-images approved-icon"></i> Hero Banner</h3>
        <div class="header-right">
            <div class="header-stats">
                <span class="stat-item">
                    <i class="fas fa-layer-group"></i>
                    Total: {{ $banners->total() }}
                </span>
                <span class="stat-item">
                    <i class="fas fa-toggle-on"></i>
                    Aktif: {{ $banners->where('is_active', true)->count() }}
                </span>
            </div>
            <a href="{{ route('admin.hero-banners.create') }}" class="btn-add">
                <i class="fas fa-plus"></i> Tambah Banner
            </a>
        </div>
    </div>

    @if($banners->count() > 0)
    
    <!-- Desktop Table View -->
    <div class="desktop-view">
        <div class="banner-table-container">
            <table class="banner-table">
                <thead>
                    <tr>
                        <th width="120">Preview</th>
                        <th>Judul Banner</th>
                        <th width="100">Urutan</th>
                        <th width="120">Status</th>
                        <th width="80">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($banners as $banner)
                    <tr class="banner-row {{ !$banner->is_active ? 'inactive' : '' }}">
                        <td>
                            <div class="banner-preview">
                                <img src="{{ asset('storage/'.$banner->image) }}"
                                     alt="{{ $banner->title ?? 'Banner' }}"
                                     loading="lazy">
                                @if($banner->is_active)
                                <span class="active-badge">AKTIF</span>
                                @endif
                            </div>
                        </td>
                        <td>
                            <div class="banner-title">
                                <strong>{{ $banner->title ?? 'Tanpa Judul' }}</strong>
                                @if($banner->link)
                                <div class="banner-meta">
                                    <span class="meta-item">
                                        <i class="fas fa-link"></i>
                                        <span class="link-text">{{ $banner->link }}</span>
                                    </span>
                                </div>
                                @endif
                            </div>
                        </td>
                        <td>
                            <form method="POST"
                                  action="{{ route('admin.hero-banners.order', $banner) }}"
                                  class="order-form">
                                @csrf
                                @method('PATCH')
                                <input type="number"
                                       name="order"
                                       value="{{ $banner->order }}"
                                       class="order-input"
                                       min="0"
                                       onchange="this.form.submit()">
                            </form>
                        </td>
                        <td>
                            <form method="POST"
                                  action="{{ route('admin.hero-banners.toggle-active', $banner) }}"
                                  class="status-form">
                                @csrf
                                @method('PATCH')
                                <button type="submit"
                                        class="status-toggle {{ $banner->is_active ? 'active' : 'inactive' }}">
                                    <i class="fas {{ $banner->is_active ? 'fa-toggle-on' : 'fa-toggle-off' }}"></i>
                                    <span>{{ $banner->is_active ? 'Aktif' : 'Nonaktif' }}</span>
                                </button>
                            </form>
                        </td>
                        <td>
                            <form method="POST"
                                  action="{{ route('admin.hero-banners.destroy', $banner) }}"
                                  onsubmit="return confirm('Apakah Anda yakin ingin menghapus banner ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn-delete" title="Hapus Banner">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <!-- Mobile Card View -->
    <div class="mobile-view">
        @foreach($banners as $banner)
        <div class="banner-card {{ !$banner->is_active ? 'inactive' : '' }}">
            <div class="card-header">
                <div class="banner-preview-card">
                    <img src="{{ asset('storage/'.$banner->image) }}"
                         alt="{{ $banner->title ?? 'Banner' }}"
                         loading="lazy">
                    @if($banner->is_active)
                    <span class="active-badge-card">AKTIF</span>
                    @endif
                </div>
                <div class="card-title">
                    <h4>{{ $banner->title ?? 'Tanpa Judul' }}</h4>
                    @if($banner->link)
                    <div class="card-link">
                        <i class="fas fa-link"></i>
                        <span>{{ $banner->link }}</span>
                    </div>
                    @endif
                </div>
            </div>
            
            <div class="card-body">
                <div class="card-info">
                    <div class="info-item">
                        <label>Urutan:</label>
                        <form method="POST"
                              action="{{ route('admin.hero-banners.order', $banner) }}"
                              class="order-form-mobile">
                            @csrf
                            @method('PATCH')
                            <input type="number"
                                   name="order"
                                   value="{{ $banner->order }}"
                                   class="order-input-mobile"
                                   min="0"
                                   onchange="this.form.submit()">
                        </form>
                    </div>
                    
                    <div class="info-item">
                        <label>Status:</label>
                        <form method="POST"
                              action="{{ route('admin.hero-banners.toggle-active', $banner) }}"
                              class="status-form-mobile">
                            @csrf
                            @method('PATCH')
                            <button type="submit"
                                    class="status-toggle-mobile {{ $banner->is_active ? 'active' : 'inactive' }}">
                                <i class="fas {{ $banner->is_active ? 'fa-toggle-on' : 'fa-toggle-off' }}"></i>
                                {{ $banner->is_active ? 'Aktif' : 'Nonaktif' }}
                            </button>
                        </form>
                    </div>
                </div>
                
                <div class="card-actions">
                    <form method="POST"
                          action="{{ route('admin.hero-banners.destroy', $banner) }}"
                          onsubmit="return confirm('Apakah Anda yakin ingin menghapus banner ini?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn-delete-mobile">
                            <i class="fas fa-trash"></i> Hapus Banner
                        </button>
                    </form>
                </div>
            </div>
        </div>
        @endforeach
    </div>

    <div class="pagination-wrapper">
        {{ $banners->links() }}
    </div>

    @else
    <div class="empty-state">
        <i class="fas fa-images"></i>
        <h4>Belum ada banner</h4>
        <p>Tambahkan banner pertama untuk ditampilkan di halaman utama</p>
        <a href="{{ route('admin.hero-banners.create') }}" class="btn-add mt-3">
            <i class="fas fa-plus"></i> Tambah Banner
        </a>
    </div>
    @endif
</div>

<style>
/* ==================== BASE STYLES ==================== */
* {
    box-sizing: border-box;
}

.approved-banner-container {
    background: white;
    border-radius: 12px;
    padding: 24px;
    box-shadow: 0 2px 8px rgba(0,0,0,0.05);
    margin: 20px 0;
    width: 100%;
    overflow-x: hidden;
}

/* ==================== HEADER ==================== */
.approved-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 24px;
    padding-bottom: 16px;
    border-bottom: 1px solid #f0f0f0;
    flex-wrap: wrap;
    gap: 16px;
}

.approved-header h3 {
    margin: 0;
    font-size: 18px;
    font-weight: 600;
    color: #333;
    display: flex;
    align-items: center;
    gap: 10px;
}

.approved-icon {
    color: #4361ee;
}

.header-right {
    display: flex;
    align-items: center;
    gap: 16px;
    flex-wrap: wrap;
}

.header-stats {
    display: flex;
    gap: 12px;
    flex-wrap: wrap;
}

.stat-item {
    display: flex;
    align-items: center;
    gap: 8px;
    font-size: 14px;
    color: #666;
    padding: 6px 12px;
    background: #f8f9fa;
    border-radius: 6px;
}

.stat-item i {
    color: #28a745;
}

.btn-add {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    padding: 10px 18px;
    background: #4361ee;
    color: white;
    border-radius: 8px;
    text-decoration: none;
    font-size: 14px;
    font-weight: 500;
    transition: all 0.2s ease;
    border: none;
    cursor: pointer;
}

.btn-add:hover {
    background: #3651d4;
    transform: translateY(-1px);
    box-shadow: 0 2px 8px rgba(67, 97, 238, 0.3);
}

/* ==================== DESKTOP TABLE VIEW ==================== */
.desktop-view {
    display: block;
}

.banner-table-container {
    overflow-x: auto;
    -webkit-overflow-scrolling: touch;
}

.banner-table {
    width: 100%;
    border-collapse: collapse;
    min-width: 500px;
}

.banner-table thead {
    background: #f8f9fa;
}

.banner-table th {
    padding: 14px 16px;
    text-align: left;
    font-weight: 600;
    color: #495057;
    font-size: 14px;
    border-bottom: 2px solid #e9ecef;
}

.banner-table td {
    padding: 16px;
    border-bottom: 1px solid #f0f0f0;
    vertical-align: middle;
}

.banner-row {
    transition: background-color 0.2s ease;
}

.banner-row:hover {
    background-color: #f8fafc;
}

.banner-row.inactive {
    background-color: #f8f9fa;
    opacity: 0.8;
}

.banner-preview {
    position: relative;
    width: 100px;
    height: 60px;
    border-radius: 6px;
    overflow: hidden;
    background: #f0f0f0;
}

.banner-preview img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform 0.3s ease;
}

.active-badge {
    position: absolute;
    top: 4px;
    right: 4px;
    background: rgba(40, 167, 69, 0.9);
    color: white;
    padding: 2px 6px;
    border-radius: 3px;
    font-size: 10px;
    font-weight: 600;
}

.banner-title strong {
    font-size: 15px;
    color: #333;
    font-weight: 500;
}

.banner-meta {
    display: flex;
    gap: 12px;
    flex-wrap: wrap;
}

.meta-item {
    display: flex;
    align-items: center;
    gap: 5px;
    font-size: 12px;
    color: #888;
    max-width: 100%;
}

.link-text {
    overflow: hidden;
    text-overflow: ellipsis;
    white-space: nowrap;
    max-width: 250px;
}

.order-form {
    width: 80px;
}

.order-input {
    width: 100%;
    padding: 8px 10px;
    border: 1px solid #dee2e6;
    border-radius: 6px;
    font-size: 14px;
    text-align: center;
}

.status-toggle {
    padding: 8px 16px;
    border: none;
    border-radius: 6px;
    font-size: 13px;
    font-weight: 500;
    cursor: pointer;
    display: flex;
    align-items: center;
    gap: 8px;
    width: 110px;
    justify-content: center;
}

.status-toggle.active {
    background: #d4edda;
    color: #155724;
    border: 1px solid #c3e6cb;
}

.status-toggle.inactive {
    background: #f8f9fa;
    color: #6c757d;
    border: 1px solid #dee2e6;
}

.btn-delete {
    padding: 8px 12px;
    background: white;
    color: #dc3545;
    border: 1px solid #dc3545;
    border-radius: 6px;
    cursor: pointer;
    transition: all 0.2s ease;
}

/* ==================== MOBILE CARD VIEW ==================== */
.mobile-view {
    display: none;
}

.banner-card {
    background: white;
    border: 1px solid #e9ecef;
    border-radius: 12px;
    margin-bottom: 16px;
    overflow: hidden;
    transition: all 0.3s ease;
    box-shadow: 0 1px 3px rgba(0,0,0,0.05);
}

.banner-card.inactive {
    opacity: 0.7;
    background: #f8f9fa;
}

.card-header {
    display: flex;
    gap: 15px;
    padding: 15px;
    border-bottom: 1px solid #f0f0f0;
    background: #fafafa;
}

.banner-preview-card {
    position: relative;
    width: 100px;
    height: 60px;
    flex-shrink: 0;
    border-radius: 8px;
    overflow: hidden;
    background: #e9ecef;
}

.banner-preview-card img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

.active-badge-card {
    position: absolute;
    top: 4px;
    right: 4px;
    background: #28a745;
    color: white;
    padding: 2px 6px;
    border-radius: 4px;
    font-size: 9px;
    font-weight: 600;
}

.card-title {
    flex: 1;
}

.card-title h4 {
    margin: 0 0 5px 0;
    font-size: 14px;
    font-weight: 600;
    color: #333;
}

.card-link {
    display: flex;
    align-items: center;
    gap: 5px;
    font-size: 11px;
    color: #6c757d;
    word-break: break-all;
}

.card-link i {
    font-size: 10px;
    flex-shrink: 0;
}

.card-body {
    padding: 15px;
}

.card-info {
    display: flex;
    flex-direction: column;
    gap: 12px;
    margin-bottom: 15px;
}

.info-item {
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 10px;
    flex-wrap: wrap;
}

.info-item label {
    font-size: 13px;
    font-weight: 600;
    color: #495057;
    min-width: 60px;
}

.order-form-mobile {
    flex: 1;
    max-width: 120px;
}

.order-input-mobile {
    width: 100%;
    padding: 8px 12px;
    border: 1px solid #dee2e6;
    border-radius: 8px;
    font-size: 14px;
    text-align: center;
    background: white;
}

.status-form-mobile {
    flex: 1;
}

.status-toggle-mobile {
    width: 100%;
    padding: 8px 12px;
    border: none;
    border-radius: 8px;
    font-size: 13px;
    font-weight: 500;
    cursor: pointer;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 8px;
}

.status-toggle-mobile.active {
    background: #d4edda;
    color: #155724;
}

.status-toggle-mobile.inactive {
    background: #f8f9fa;
    color: #6c757d;
    border: 1px solid #dee2e6;
}

.card-actions {
    padding-top: 12px;
    border-top: 1px solid #f0f0f0;
}

.btn-delete-mobile {
    width: 100%;
    padding: 10px;
    background: white;
    color: #dc3545;
    border: 1px solid #dc3545;
    border-radius: 8px;
    cursor: pointer;
    font-size: 13px;
    font-weight: 500;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 8px;
    transition: all 0.2s ease;
}

.btn-delete-mobile:active {
    background: #dc3545;
    color: white;
    transform: scale(0.98);
}

/* ==================== PAGINATION ==================== */
.pagination-wrapper {
    margin-top: 24px;
    display: flex;
    justify-content: center;
}

.pagination-wrapper .pagination {
    margin: 0;
    flex-wrap: wrap;
    justify-content: center;
}

/* ==================== EMPTY STATE ==================== */
.empty-state {
    text-align: center;
    padding: 60px 20px;
    display: flex;
    flex-direction: column;
    align-items: center;
}

.empty-state i {
    font-size: 48px;
    color: #adb5bd;
    margin-bottom: 16px;
}

.empty-state h4 {
    margin: 0 0 8px 0;
    color: #666;
    font-size: 18px;
}

.empty-state p {
    margin: 0;
    color: #999;
    font-size: 14px;
}

/* ==================== RESPONSIVE BREAKPOINTS ==================== */

/* Tablet (max-width: 768px) - Tampilkan card view */
@media (max-width: 768px) {
    .approved-banner-container {
        padding: 16px;
        margin: 12px;
        border-radius: 8px;
    }
    
    .approved-header {
        flex-direction: column;
        align-items: stretch;
    }
    
    .header-right {
        width: 100%;
        flex-direction: column;
        align-items: stretch;
    }
    
    .header-stats {
        width: 100%;
        justify-content: space-between;
    }
    
    .stat-item {
        flex: 1;
        justify-content: center;
        font-size: 12px;
    }
    
    .btn-add {
        width: 100%;
        justify-content: center;
    }
    
    /* Sembunyikan desktop view */
    .desktop-view {
        display: none;
    }
    
    /* Tampilkan mobile view */
    .mobile-view {
        display: block;
    }
}

/* Mobile Small (max-width: 480px) */
@media (max-width: 480px) {
    .approved-banner-container {
        padding: 12px;
        margin: 8px;
    }
    
    .approved-header h3 {
        font-size: 16px;
    }
    
    .stat-item {
        font-size: 11px;
        padding: 5px 10px;
    }
    
    .card-header {
        flex-direction: column;
        align-items: center;
        text-align: center;
    }
    
    .banner-preview-card {
        width: 120px;
        height: 70px;
    }
    
    .card-title h4 {
        font-size: 13px;
    }
    
    .card-link {
        justify-content: center;
        font-size: 10px;
    }
    
    .info-item {
        flex-direction: column;
        align-items: stretch;
    }
    
    .info-item label {
        min-width: auto;
    }
    
    .order-form-mobile {
        max-width: 100%;
    }
    
    .order-input-mobile {
        width: 100%;
    }
    
    .status-toggle-mobile {
        width: 100%;
    }
    
    .pagination-wrapper .pagination .page-link {
        padding: 5px 10px;
        font-size: 12px;
    }
}

/* iPhone SE and similar (max-width: 375px) */
@media (max-width: 375px) {
    .approved-banner-container {
        padding: 10px;
    }
    
    .card-body {
        padding: 12px;
    }
    
    .banner-preview-card {
        width: 100px;
        height: 60px;
    }
    
    .btn-delete-mobile {
        padding: 8px;
        font-size: 12px;
    }
}

/* Touch Device Optimization */
@media (hover: none) and (pointer: coarse) {
    .status-toggle-mobile,
    .btn-delete-mobile,
    .order-input-mobile,
    .btn-add {
        min-height: 44px;
    }
}

/* Print Styles */
@media print {
    .mobile-view,
    .btn-add,
    .pagination-wrapper {
        display: none;
    }
    
    .desktop-view {
        display: block;
    }
    
    .approved-banner-container {
        box-shadow: none;
        padding: 0;
    }
}
</style>

<!-- Add Font Awesome -->
@push('styles')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
@endpush

<script>
// Auto-hide alerts after 5 seconds
document.addEventListener('DOMContentLoaded', function() {
    const alerts = document.querySelectorAll('.alert');
    alerts.forEach(alert => {
        setTimeout(() => {
            alert.classList.remove('show');
            setTimeout(() => alert.remove(), 150);
        }, 5000);
    });
});
</script>
@endsection