@extends('layouts.admin')

@section('page-title', 'Hero Banner - Menunggu Persetujuan')

@section('content')
@if(session('success'))
<div class="alert alert-success alert-dismissible fade show" role="alert">
    <i class="fas fa-check-circle me-2"></i>
    {{ session('success') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif

@if(session('error'))
<div class="alert alert-danger alert-dismissible fade show" role="alert">
    <i class="fas fa-exclamation-circle me-2"></i>
    {{ session('error') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif

<div class="pending-banner-container">
    <div class="pending-header">
        <h3><i class="fas fa-clock pending-icon"></i> Banner Menunggu Persetujuan</h3>
        <span class="pending-count">{{ $banners->count() }} pending</span>
    </div>

    @if($banners->count() > 0)
    <div class="pending-grid">
        @foreach($banners as $banner)
        <div class="banner-card">
            <div class="banner-preview">
                <img src="{{ asset('storage/'.$banner->image) }}" alt="{{ $banner->title ?? 'Banner' }}">
                <span class="pending-badge">PENDING</span>
            </div>
            
            <div class="banner-info">
                <h4>{{ $banner->title ?? 'Tanpa Judul' }}</h4>
                
                <div class="banner-meta">
                    <div class="meta-item">
                        <i class="fas fa-user"></i>
                        <span>{{ $banner->created_by }}</span>
                    </div>
                    <div class="meta-item">
                        <i class="fas fa-calendar"></i>
                        <span>{{ $banner->created_at->format('d M Y') }}</span>
                    </div>
                </div>
            </div>
            
            <div class="banner-actions">
                <form action="{{ route('admin.hero-banners.approve', $banner) }}" method="POST" class="action-form">
                    @csrf
                    <button type="submit" class="btn-approve">
                        <i class="fas fa-check"></i> Setujui
                    </button>
                </form>
                
                <form action="{{ route('admin.hero-banners.reject', $banner) }}" method="POST" class="action-form">
                    @csrf
                    <button type="submit" class="btn-reject" onclick="return confirm('Tolak banner ini?')">
                        <i class="fas fa-times"></i> Tolak
                    </button>
                </form>
            </div>
        </div>
        @endforeach
    </div>
    @else
    <div class="empty-state">
        <i class="fas fa-check-circle"></i>
        <h4>Tidak ada banner pending</h4>
        <p>Semua banner telah diproses</p>
    </div>
    @endif
</div>

<style>
.pending-banner-container {
    background: white;
    border-radius: 12px;
    padding: 24px;
    box-shadow: 0 2px 8px rgba(0,0,0,0.05);
}

.pending-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 24px;
    padding-bottom: 16px;
    border-bottom: 1px solid #f0f0f0;
}

.pending-header h3 {
    margin: 0;
    font-size: 18px;
    font-weight: 600;
    color: #333;
    display: flex;
    align-items: center;
    gap: 10px;
}

.pending-icon {
    color: #ffc107;
}

.pending-count {
    background: #fff8e1;
    color: #ff9800;
    padding: 6px 12px;
    border-radius: 20px;
    font-size: 14px;
    font-weight: 500;
}

.pending-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(320px, 1fr));
    gap: 20px;
}

.banner-card {
    border: 1px solid #eaeaea;
    border-radius: 10px;
    overflow: hidden;
    transition: all 0.2s ease;
}

.banner-card:hover {
    border-color: #d1d1d1;
    box-shadow: 0 4px 12px rgba(0,0,0,0.05);
}

.banner-preview {
    position: relative;
    height: 160px;
    overflow: hidden;
}

.banner-preview img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

.pending-badge {
    position: absolute;
    top: 12px;
    right: 12px;
    background: rgba(255, 152, 0, 0.9);
    color: white;
    padding: 4px 10px;
    border-radius: 4px;
    font-size: 12px;
    font-weight: 500;
    text-transform: uppercase;
    letter-spacing: 0.5px;
}

.banner-info {
    padding: 16px;
}

.banner-info h4 {
    margin: 0 0 12px 0;
    font-size: 16px;
    font-weight: 600;
    color: #333;
    line-height: 1.4;
}

.banner-meta {
    display: flex;
    gap: 16px;
    margin-top: 8px;
}

.meta-item {
    display: flex;
    align-items: center;
    gap: 6px;
    font-size: 13px;
    color: #666;
}

.meta-item i {
    color: #888;
    font-size: 12px;
}

.banner-actions {
    display: flex;
    padding: 0 16px 16px 16px;
    gap: 10px;
}

.action-form {
    flex: 1;
}

.btn-approve {
    width: 100%;
    padding: 10px;
    background: #28a745;
    color: white;
    border: none;
    border-radius: 6px;
    font-size: 14px;
    font-weight: 500;
    cursor: pointer;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 8px;
    transition: background 0.2s;
}

.btn-approve:hover {
    background: #218838;
}

.btn-reject {
    width: 100%;
    padding: 10px;
    background: white;
    color: #dc3545;
    border: 1px solid #dc3545;
    border-radius: 6px;
    font-size: 14px;
    font-weight: 500;
    cursor: pointer;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 8px;
    transition: all 0.2s;
}

.btn-reject:hover {
    background: #dc3545;
    color: white;
}

.empty-state {
    text-align: center;
    padding: 60px 20px;
}

.empty-state i {
    font-size: 48px;
    color: #28a745;
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
    .pending-grid {
        grid-template-columns: 1fr;
    }
    
    .pending-header {
        flex-direction: column;
        align-items: flex-start;
        gap: 12px;
    }
    
    .pending-banner-container {
        padding: 16px;
    }
}
</style>
@endsection