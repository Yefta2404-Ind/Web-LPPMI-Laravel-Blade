@extends('layouts.admin')

@section('page-title', 'Hero Banner - Approved')

@section('content')
@if(session('success'))
<div class="alert alert-success alert-dismissible fade show mb-4" role="alert">
    <i class="fas fa-check-circle me-2"></i>
    {{ session('success') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif

<div class="approved-banner-container">
    <div class="approved-header">
        <h3><i class="fas fa-check-circle approved-icon"></i> Banner Disetujui</h3>
        <div class="header-stats">
            <span class="stat-item">
                <i class="fas fa-layer-group"></i>
                Total: {{ $banners->count() }}
            </span>
            <span class="stat-item">
                <i class="fas fa-toggle-on"></i>
                Aktif: {{ $banners->where('is_active', true)->count() }}
            </span>
        </div>
    </div>

    @if($banners->count() > 0)
    <div class="banner-table-container">
        <table class="banner-table">
            <thead>
                <tr>
                    <th width="120">Preview</th>
                    <th>Judul Banner</th>
                    <th width="100">Urutan</th>
                    <th width="120">Status</th>
                </tr>
            </thead>
            <tbody>
                @foreach($banners->sortBy('order') as $banner)
                <tr class="banner-row {{ !$banner->is_active ? 'inactive' : '' }}">
                    <td>
                        <div class="banner-preview">
                            <img src="{{ asset('storage/'.$banner->image) }}" 
                                 alt="{{ $banner->title ?? 'Banner' }}">
                            @if($banner->is_active)
                            <span class="active-badge">AKTIF</span>
                            @endif
                        </div>
                    </td>
                    <td>
                        <div class="banner-title">
                            <strong>{{ $banner->title ?? 'Tanpa Judul' }}</strong>
                            <div class="banner-meta">
                                <span class="meta-item">
                                    <i class="fas fa-sort-numeric-up"></i>
                                    Order: {{ $banner->order }}
                                </span>
                            </div>
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
                                   min="1"
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
                                {{ $banner->is_active ? 'Aktif' : 'Nonaktif' }}
                            </button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    @else
    <div class="empty-state">
        <i class="fas fa-images"></i>
        <h4>Belum ada banner disetujui</h4>
        <p>Setujui banner dari halaman pending terlebih dahulu</p>
    </div>
    @endif
</div>

<style>
.approved-banner-container {
    background: white;
    border-radius: 12px;
    padding: 24px;
    box-shadow: 0 2px 8px rgba(0,0,0,0.05);
}

.approved-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 24px;
    padding-bottom: 16px;
    border-bottom: 1px solid #f0f0f0;
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
    color: #28a745;
}

.header-stats {
    display: flex;
    gap: 20px;
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

.banner-table-container {
    overflow-x: auto;
}

.banner-table {
    width: 100%;
    border-collapse: collapse;
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
}

.banner-preview img {
    width: 100%;
    height: 100%;
    object-fit: cover;
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
    text-transform: uppercase;
    letter-spacing: 0.5px;
}

.banner-title {
    display: flex;
    flex-direction: column;
    gap: 6px;
}

.banner-title strong {
    font-size: 15px;
    color: #333;
    font-weight: 500;
}

.banner-meta {
    display: flex;
    gap: 12px;
}

.meta-item {
    display: flex;
    align-items: center;
    gap: 5px;
    font-size: 12px;
    color: #666;
}

.meta-item i {
    color: #888;
    font-size: 11px;
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
    transition: border-color 0.2s;
}

.order-input:focus {
    outline: none;
    border-color: #28a745;
    box-shadow: 0 0 0 3px rgba(40, 167, 69, 0.1);
}

.status-form {
    display: inline-block;
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
    transition: all 0.2s;
    width: 110px;
    justify-content: center;
}

.status-toggle.active {
    background: #d4edda;
    color: #155724;
    border: 1px solid #c3e6cb;
}

.status-toggle.active:hover {
    background: #c3e6cb;
}

.status-toggle.inactive {
    background: #f8f9fa;
    color: #6c757d;
    border: 1px solid #dee2e6;
}

.status-toggle.inactive:hover {
    background: #e2e6ea;
}

.empty-state {
    text-align: center;
    padding: 60px 20px;
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

@media (max-width: 768px) {
    .approved-header {
        flex-direction: column;
        align-items: flex-start;
        gap: 12px;
    }
    
    .header-stats {
        width: 100%;
        justify-content: space-between;
    }
    
    .approved-banner-container {
        padding: 16px;
    }
    
    .banner-table th,
    .banner-table td {
        padding: 12px;
    }
}
</style>
@endsection