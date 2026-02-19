@extends('layouts.admin')

@section('title', 'Video Management')
@section('page-title', 'Video Management')

@section('content')
<style>
    /* Video Management Styles */
    .video-admin-container {
        max-width: 1400px;
        margin: 0 auto;
        padding: 0 1rem;
    }

    .video-admin-header {
        margin-bottom: 2rem;
    }

    .video-admin-title {
        font-size: 1.875rem;
        font-weight: 600;
        color: #1f2937;
        margin-bottom: 0.5rem;
    }

    .video-admin-subtitle {
        color: #6b7280;
        font-size: 0.875rem;
    }

    .video-admin-card {
        background: white;
        border-radius: 0.75rem;
        border: 1px solid #e5e7eb;
        box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
        overflow: hidden;
    }

    /* Table Styles */
    .video-admin-table-container {
        overflow-x: auto;
        -webkit-overflow-scrolling: touch;
    }

    .video-admin-table {
        width: 100%;
        min-width: 800px;
        border-collapse: collapse;
    }

    .video-admin-table thead {
        background-color: #f9fafb;
    }

    .video-admin-table th {
        padding: 0.75rem 1.5rem;
        text-align: left;
        font-size: 0.75rem;
        font-weight: 600;
        color: #6b7280;
        text-transform: uppercase;
        letter-spacing: 0.05em;
        border-bottom: 2px solid #e5e7eb;
    }

    .video-admin-table td {
        padding: 1rem 1.5rem;
        border-bottom: 1px solid #e5e7eb;
        vertical-align: middle;
    }

    .video-admin-table tbody tr:hover {
        background-color: #f9fafb;
    }

    .video-admin-table tbody tr:last-child td {
        border-bottom: none;
    }

    /* Status Badges */
    .status-badge {
        display: inline-flex;
        align-items: center;
        padding: 0.25rem 0.75rem;
        border-radius: 9999px;
        font-size: 0.75rem;
        font-weight: 500;
        line-height: 1;
        white-space: nowrap;
        margin: 0.125rem 0;
    }

    .status-approved {
        background-color: #d1fae5;
        color: #065f46;
    }

    .status-rejected {
        background-color: #fee2e2;
        color: #991b1b;
    }

    .status-pending {
        background-color: #fef3c7;
        color: #92400e;
    }

    .status-published {
        background-color: #dbeafe;
        color: #1e40af;
    }

    .status-unpublished {
        background-color: #f3f4f6;
        color: #4b5563;
    }

    /* Featured Status Variations */
    .status-featured-active {
        background: linear-gradient(135deg, #f59e0b 0%, #fbbf24 100%);
        color: #92400e;
        border: 1px solid #f59e0b;
        font-weight: 600;
        box-shadow: 0 2px 4px rgba(245, 158, 11, 0.2);
    }

    .status-featured-inactive {
        background: linear-gradient(135deg, #9ca3af 0%, #d1d5db 100%);
        color: #1f2937;
        border: 1px solid #9ca3af;
        font-weight: 500;
        opacity: 0.8;
    }

    /* Animation for active featured */
    @keyframes pulse-featured {
        0%, 100% {
            box-shadow: 0 0 0 0 rgba(245, 158, 11, 0.7);
        }
        50% {
            box-shadow: 0 0 0 4px rgba(245, 158, 11, 0);
        }
    }

    .status-featured-active-animated {
        animation: pulse-featured 2s infinite;
    }

    /* Featured Stats */
    .featured-stats {
        display: flex;
        gap: 1rem;
        margin-bottom: 1.5rem;
        padding: 0.75rem 1rem;
        background: #f9fafb;
        border-radius: 0.5rem;
        border: 1px solid #e5e7eb;
    }

    .featured-stat-item {
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    .featured-stat-badge {
        width: 12px;
        height: 12px;
        border-radius: 50%;
    }

    .featured-stat-badge.active {
        background: #f59e0b;
    }

    .featured-stat-badge.inactive {
        background: #9ca3af;
    }

    .featured-stat-text {
        font-size: 0.875rem;
        color: #4b5563;
    }

    /* Action Buttons */
    .btn-group {
        display: flex;
        flex-wrap: wrap;
        gap: 0.5rem;
        align-items: center;
    }

    .btn {
        display: inline-flex;
        align-items: center;
        padding: 0.375rem 0.75rem;
        border-radius: 0.375rem;
        font-size: 0.75rem;
        font-weight: 500;
        line-height: 1;
        text-decoration: none;
        border: 1px solid transparent;
        cursor: pointer;
        transition: all 0.2s;
        white-space: nowrap;
    }

    .btn-sm {
        padding: 0.25rem 0.5rem;
        font-size: 0.6875rem;
    }

    .btn-primary {
        background-color: #3b82f6;
        color: white;
        border-color: #3b82f6;
    }

    .btn-primary:hover {
        background-color: #2563eb;
        border-color: #2563eb;
    }

    .btn-secondary {
        background-color: #6b7280;
        color: white;
        border-color: #6b7280;
    }

    .btn-secondary:hover {
        background-color: #4b5563;
        border-color: #4b5563;
    }

    .btn-success {
        background-color: #10b981;
        color: white;
        border-color: #10b981;
    }

    .btn-success:hover {
        background-color: #059669;
        border-color: #059669;
    }

    .btn-danger {
        background-color: #ef4444;
        color: white;
        border-color: #ef4444;
    }

    .btn-danger:hover {
        background-color: #dc2626;
        border-color: #dc2626;
    }

    .btn-warning {
        background-color: #f59e0b;
        color: white;
        border-color: #f59e0b;
    }

    .btn-warning:hover {
        background-color: #d97706;
        border-color: #d97706;
    }

    .btn-outline {
        background-color: transparent;
        color: #374151;
        border-color: #d1d5db;
    }

    .btn-outline:hover {
        background-color: #f9fafb;
        border-color: #9ca3af;
    }

    .btn:disabled,
    .btn.disabled {
        opacity: 0.5;
        cursor: not-allowed;
    }

    .btn i {
        margin-right: 0.25rem;
        font-size: 0.75rem;
    }

    /* Featured Only Filter */
    .featured-filter {
        display: flex;
        gap: 0.5rem;
        margin-bottom: 1.5rem;
        padding: 1rem;
        background: #f8fafc;
        border-radius: 0.5rem;
        border: 1px solid #e2e8f0;
    }

    .filter-btn {
        padding: 0.5rem 1rem;
        border-radius: 0.375rem;
        font-size: 0.875rem;
        font-weight: 500;
        cursor: pointer;
        border: 1px solid #cbd5e1;
        background: white;
        color: #475569;
        transition: all 0.2s;
    }

    .filter-btn:hover {
        background: #f1f5f9;
        border-color: #94a3b8;
    }

    .filter-btn.active {
        background: #3b82f6;
        color: white;
        border-color: #3b82f6;
    }

    /* Pagination */
    .pagination-container {
        padding: 1.5rem;
        border-top: 1px solid #e5e7eb;
    }

    .pagination-info {
        font-size: 0.875rem;
        color: #6b7280;
        margin-bottom: 1rem;
    }

    .pagination-controls {
        display: flex;
        justify-content: space-between;
        align-items: center;
        flex-wrap: wrap;
        gap: 1rem;
    }

    .pagination-buttons {
        display: flex;
        gap: 0.5rem;
    }

    /* Empty State */
    .empty-state {
        text-align: center;
        padding: 3rem 1rem;
        color: #6b7280;
    }

    .empty-state-icon {
        font-size: 3rem;
        color: #d1d5db;
        margin-bottom: 1rem;
    }

    .empty-state-title {
        font-size: 1.125rem;
        font-weight: 500;
        color: #374151;
        margin-bottom: 0.5rem;
    }

    .empty-state-description {
        font-size: 0.875rem;
        color: #6b7280;
    }

    /* Status Container */
    .status-container {
        display: flex;
        flex-direction: column;
        gap: 0.25rem;
    }

    /* Responsive Design */
    @media (max-width: 768px) {
        .video-admin-container {
            padding: 0 0.5rem;
        }

        .video-admin-title {
            font-size: 1.5rem;
        }

        .video-admin-table th,
        .video-admin-table td {
            padding: 0.75rem 1rem;
        }

        .btn {
            padding: 0.25rem 0.5rem;
            font-size: 0.6875rem;
        }

        .pagination-controls {
            flex-direction: column;
            align-items: stretch;
        }

        .pagination-buttons {
            justify-content: center;
        }

        .featured-stats {
            flex-direction: column;
            gap: 0.5rem;
        }
    }

    @media (max-width: 640px) {
        .video-admin-table th:nth-child(2),
        .video-admin-table td:nth-child(2) {
            display: none;
        }

        .video-admin-table th:nth-child(4),
        .video-admin-table td:nth-child(4) {
            display: none;
        }
    }
</style>

<div class="video-admin-container">
    <div class="video-admin-header">
        <h1 class="video-admin-title">Video Management</h1>
        <p class="video-admin-subtitle">Manage all uploaded videos</p>
    </div>

@php
    $totalFeatured = $videos->where('is_featured', 1)->count();
    $activeFeatured = $videos->where('is_featured', 1)->where('is_published', 1)->count();
    $inactiveFeatured = $totalFeatured - $activeFeatured;
@endphp


    <div class="featured-stats">
        <div class="featured-stat-item">
            <div class="featured-stat-badge active"></div>
            <span class="featured-stat-text">
                <strong>{{ $activeFeatured }}</strong> Active Featured
            </span>
        </div>
        <div class="featured-stat-item">
            <div class="featured-stat-badge inactive"></div>
            <span class="featured-stat-text">
                <strong>{{ $inactiveFeatured }}</strong> Inactive Featured
            </span>
        </div>
        <div class="featured-stat-item">
            <div class="featured-stat-badge" style="background: #3b82f6"></div>
            <span class="featured-stat-text">
                <strong>{{ $totalFeatured }}</strong> Total Featured
            </span>
        </div>
    </div>

    <!-- Featured Filter -->
    <div class="featured-filter">
        <button class="filter-btn {{ !request()->has('featured') ? 'active' : '' }}" 
                onclick="window.location='{{ route('admin.videos.index') }}'">
            All Videos
        </button>
        <button class="filter-btn {{ request('featured') === 'active' ? 'active' : '' }}" 
                onclick="window.location='{{ route('admin.videos.index', ['featured' => 'active']) }}'">
            Active Featured
        </button>
        <button class="filter-btn {{ request('featured') === 'inactive' ? 'active' : '' }}" 
                onclick="window.location='{{ route('admin.videos.index', ['featured' => 'inactive']) }}'">
            Inactive Featured
        </button>
        <button class="filter-btn {{ request('featured') === 'all_featured' ? 'active' : '' }}" 
                onclick="window.location='{{ route('admin.videos.index', ['featured' => 'all_featured']) }}'">
            All Featured
        </button>
    </div>

    <div class="video-admin-card">
        @if($videos->count() > 0)
            <div class="video-admin-table-container">
                <table class="video-admin-table">
                    <thead>
                        <tr>
                            <th>Judul</th>
                            <th>Staff</th>
                            <th>Status</th>
                            <th>Preview</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($videos as $video)
                        <tr>
                            <td>{{ $video->title }}</td>
                            <td>{{ $video->user->name }}</td>
                            <td>
                                <div class="status-container">
                                    {{-- APPROVAL --}}
                                    <span class="status-badge
                                        @if($video->status === 'approved') status-approved
                                        @elseif($video->status === 'rejected') status-rejected
                                        @else status-pending @endif">
                                        {{ ucfirst($video->status) }}
                                    </span>

                                    {{-- PUBLISH --}}
                                    @if($video->status === 'approved')
                                        <span class="status-badge
                                            {{ $video->is_published ? 'status-published' : 'status-unpublished' }}">
                                            {{ $video->is_published ? 'Published' : 'Not Published' }}
                                        </span>
                                    @endif
                                    
                                    {{-- FEATURED --}}
                                    @if($video->is_featured)
    @if($video->is_published)
        <span class="status-badge status-featured-active status-featured-active-animated">
            ⭐ Featured (Active)
        </span>
    @else
        <span class="status-badge status-featured-inactive">
            ⭐ Featured (Inactive)
        </span>
    @endif
@endif

                                </div>
                            </td>

                            <td>
                                @if($video->url)
                                    @php
                                        preg_match('%(?:youtube\.com/(?:.*v=|v/|embed/)|youtu\.be/)([^&\n?#]+)%', $video->url, $matches);
                                        $youtubeId = $matches[1] ?? null;
                                    @endphp
                                    @if($youtubeId)
                                        <a href="https://www.youtube.com/watch?v={{ $youtubeId }}" 
                                           target="_blank" 
                                           class="btn btn-outline btn-sm">
                                            <i class="fas fa-external-link-alt"></i> YouTube
                                        </a>
                                    @else
                                        <a href="{{ $video->url }}" target="_blank" class="btn btn-outline btn-sm">
                                            <i class="fas fa-external-link-alt"></i> Video
                                        </a>
                                    @endif
                                @elseif($video->video_path)
                                    <a href="{{ asset('storage/'.$video->video_path) }}" target="_blank" class="btn btn-outline btn-sm">
                                        <i class="fas fa-play-circle"></i> Play Video
                                    </a>
                                @else
                                    <span style="color: #9ca3af;">No preview</span>
                                @endif
                            </td>
                            <td>
                                <div class="btn-group">
                                    @if($video->status === 'pending')
                                        <form action="{{ route('admin.videos.approve', $video) }}" method="POST">
                                            @csrf
                                            <button type="submit" class="btn btn-success btn-sm" onclick="return confirm('Approve video ini?')">
                                                <i class="fas fa-check"></i> Approve
                                            </button>
                                        </form>
                                        <form action="{{ route('admin.videos.reject', $video) }}" method="POST">
                                            @csrf
                                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Reject video ini?')">
                                                <i class="fas fa-times"></i> Reject
                                            </button>
                                        </form>
                                    @elseif($video->status === 'approved')
                                        {{-- PUBLISH --}}
                                        <form action="{{ route('admin.videos.toggle-publish', $video) }}" method="POST">
                                            @csrf
                                            @method('PATCH')
                                            <button type="submit" class="btn btn-primary btn-sm">
                                                <i class="fas {{ $video->is_published ? 'fa-eye-slash' : 'fa-eye' }}"></i>
                                                {{ $video->is_published ? 'Unpublish' : 'Publish' }}
                                            </button>
                                        </form>

                                        {{-- FEATURED MANAGEMENT --}}
                                        @if($video->featured)
                                            {{-- Toggle Featured Active --}}
                                            <form action="{{ route('admin.videos.toggle-featured-active', $video) }}" method="POST">
                                                @csrf
                                                @method('PATCH')
                                                <button type="submit"
                                                    class="btn {{ $video->featured_active ? 'btn-secondary' : 'btn-warning' }} btn-sm"
                                                    onclick="return confirm('{{ $video->featured_active ? 'Nonaktifkan featured?' : 'Aktifkan featured?' }}')">
                                                    @if($video->featured_active)
                                                        <i class="fas fa-toggle-on"></i> Deactivate
                                                    @else
                                                        <i class="fas fa-toggle-off"></i> Activate
                                                    @endif
                                                </button>
                                            </form>
                                            
                                            {{-- Remove Featured --}}
                                            <form action="{{ route('admin.videos.remove-featured', $video) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm"
                                                    onclick="return confirm('Hapus dari featured?')">
                                                    <i class="fas fa-trash"></i> Remove
                                                </button>
                                            </form>
                                        @else
                                            {{-- Add to Featured --}}
                                            <form action="{{ route('admin.videos.featured', $video) }}" method="POST">
                                                @csrf
                                                <button type="submit"
                                                    class="btn btn-warning btn-sm"
                                                    onclick="return confirm('Jadikan video ini FEATURED?')">
                                                    ⭐ Add Featured
                                                </button>
                                            </form>
                                        @endif
                                    @else
                                        <span style="color: #9ca3af;">No actions</span>
                                    @endif
                                    
                                    
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            @if($videos->hasPages())
            <div class="pagination-container">
                <div class="pagination-controls">
                    <div class="pagination-info">
                        Showing {{ $videos->firstItem() }} to {{ $videos->lastItem() }} of {{ $videos->total() }} videos
                    </div>
                    <div class="pagination-buttons">
                        @if($videos->onFirstPage())
                            <span class="btn btn-outline disabled">
                                <i class="fas fa-chevron-left"></i> Previous
                            </span>
                        @else
                            <a href="{{ $videos->previousPageUrl() }}" class="btn btn-outline">
                                <i class="fas fa-chevron-left"></i> Previous
                            </a>
                        @endif

                        @if($videos->hasMorePages())
                            <a href="{{ $videos->nextPageUrl() }}" class="btn btn-outline">
                                Next <i class="fas fa-chevron-right"></i>
                            </a>
                        @else
                            <span class="btn btn-outline disabled">
                                Next <i class="fas fa-chevron-right"></i>
                            </span>
                        @endif
                    </div>
                </div>
            </div>
            @endif

        @else
            <div class="empty-state">
                <div class="empty-state-icon">
                    <i class="fas fa-video-slash"></i>
                </div>
                <h3 class="empty-state-title">Belum ada video</h3>
                <p class="empty-state-description">
                    @if(request()->has('featured'))
                        Tidak ada video featured yang ditemukan.
                    @else
                        Video yang diupload akan muncul di sini.
                    @endif
                </p>
            </div>
        @endif
    </div>
</div>

<script>
    // Konfirmasi sebelum menghapus featured
    document.addEventListener('DOMContentLoaded', function() {
        const removeButtons = document.querySelectorAll('form[action*="remove-featured"] button');
        removeButtons.forEach(button => {
            button.addEventListener('click', function(e) {
                if (!confirm('Yakin ingin menghapus video dari featured? Video tidak akan ditampilkan di halaman utama.')) {
                    e.preventDefault();
                }
            });
        });

        // Toast notification simulation
        @if(session('success'))
            showToast('{{ session('success') }}', 'success');
        @endif

        @if(session('error'))
            showToast('{{ session('error') }}', 'error');
        @endif
    });

    function showToast(message, type) {
        const toast = document.createElement('div');
        toast.style.position = 'fixed';
        toast.style.top = '20px';
        toast.style.right = '20px';
        toast.style.padding = '12px 20px';
        toast.style.borderRadius = '6px';
        toast.style.color = 'white';
        toast.style.fontWeight = '500';
        toast.style.zIndex = '9999';
        toast.style.boxShadow = '0 4px 12px rgba(0,0,0,0.15)';
        
        if (type === 'success') {
            toast.style.backgroundColor = '#10b981';
        } else {
            toast.style.backgroundColor = '#ef4444';
        }
        
        toast.textContent = message;
        document.body.appendChild(toast);
        
        setTimeout(() => {
            toast.remove();
        }, 3000);
    }
</script>
@endsection