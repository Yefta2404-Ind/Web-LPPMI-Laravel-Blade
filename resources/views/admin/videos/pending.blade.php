@extends('layouts.admin')

@section('page-title', 'Video Pending')
@section('content')
<style>
    /* Variables - Konsisten dengan layout admin */
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

    @media (min-width: 1024px) {
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
    }

    .stat-card:hover {
        border-color: var(--primary-color);
        box-shadow: var(--shadow-md);
        transform: translateY(-2px);
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

    .stat-icon.pending {
        background-color: var(--warning-light);
        color: var(--warning-color);
    }

    .stat-icon.youtube {
        background-color: var(--danger-light);
        color: var(--danger-color);
    }

    .stat-icon.upload {
        background-color: var(--primary-light);
        color: var(--primary-color);
    }

    .stat-icon.processed {
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

    /* Videos Grid */
    .videos-grid {
        display: grid;
        grid-template-columns: repeat(1, 1fr);
        gap: 24px;
        margin-bottom: 40px;
    }

    @media (min-width: 768px) {
        .videos-grid {
            grid-template-columns: repeat(2, 1fr);
        }
    }

    @media (min-width: 1200px) {
        .videos-grid {
            grid-template-columns: repeat(3, 1fr);
        }
    }

    /* Video Card */
    .video-card {
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

    .video-card:hover {
        border-color: var(--primary-color);
        box-shadow: var(--shadow-md);
        transform: translateY(-4px);
    }

    .video-card-header {
        padding: 20px 20px 16px;
        border-bottom: 1px solid var(--gray-200);
        background-color: var(--gray-50);
    }

    .video-card-title {
        font-size: 1rem;
        font-weight: 600;
        color: var(--gray-900);
        margin-bottom: 8px;
        line-height: 1.4;
    }

    .video-card-body {
        padding: 20px;
        flex: 1;
    }

    .video-card-footer {
        padding: 16px 20px;
        border-top: 1px solid var(--gray-200);
        background-color: var(--gray-50);
    }

    /* Video Preview */
    .video-preview-container {
        position: relative;
        width: 100%;
        padding-top: 56.25%; /* 16:9 Aspect Ratio */
        background: var(--gray-900);
        border-radius: var(--border-radius-sm);
        overflow: hidden;
        margin-bottom: 16px;
    }

    .video-preview {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        border: 0;
    }

    .video-placeholder {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        display: flex;
        align-items: center;
        justify-content: center;
        color: var(--gray-400);
        font-size: 2rem;
    }

    /* Video Meta */
    .video-meta {
        display: flex;
        flex-wrap: wrap;
        gap: 12px;
        margin-bottom: 16px;
        font-size: 0.8125rem;
        color: var(--gray-600);
    }

    .meta-item {
        display: flex;
        align-items: center;
        gap: 6px;
    }

    .meta-icon {
        color: var(--gray-500);
        font-size: 0.875rem;
        width: 14px;
        text-align: center;
    }

    /* Video Type Badge */
    .video-type-badge {
        display: inline-block;
        padding: 4px 10px;
        border-radius: 20px;
        font-size: 0.75rem;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.05em;
        border: 1px solid;
        margin-left: 8px;
    }

    .video-type-youtube {
        background-color: rgba(239, 68, 68, 0.1);
        color: var(--danger-color);
        border-color: rgba(239, 68, 68, 0.2);
    }

    .video-type-upload {
        background-color: rgba(37, 99, 235, 0.1);
        color: var(--primary-color);
        border-color: rgba(37, 99, 235, 0.2);
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

    .status-published {
        background-color: var(--primary-light);
        color: var(--primary-color);
        border-color: rgba(37, 99, 235, 0.2);
    }

    /* Action Buttons */
    .action-buttons {
        display: flex;
        flex-wrap: wrap;
        gap: 8px;
    }

    .btn {
        padding: 8px 16px;
        border-radius: var(--border-radius-sm);
        font-size: 0.8125rem;
        font-weight: 500;
        text-decoration: none;
        cursor: pointer;
        border: 1px solid transparent;
        transition: all var(--transition);
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 6px;
        white-space: nowrap;
        flex: 1;
        min-width: 100px;
    }

    .btn-sm {
        padding: 6px 12px;
        font-size: 0.75rem;
        min-width: auto;
    }

    .btn-view {
        background-color: white;
        color: var(--gray-700);
        border-color: var(--gray-300);
    }

    .btn-view:hover {
        background-color: var(--gray-50);
        border-color: var(--gray-400);
    }

    .btn-approve {
        background-color: var(--success-color);
        color: white;
        border-color: var(--success-color);
    }

    .btn-approve:hover {
        background-color: #0da271;
        border-color: #0da271;
    }

    .btn-reject {
        background-color: var(--danger-color);
        color: white;
        border-color: var(--danger-color);
    }

    .btn-reject:hover {
        background-color: #dc2626;
        border-color: #dc2626;
    }

    .btn-publish {
        background-color: var(--primary-color);
        color: white;
        border-color: var(--primary-color);
    }

    .btn-publish:hover {
        background-color: var(--primary-dark);
        border-color: var(--primary-dark);
    }

    .btn-unpublish {
        background-color: var(--warning-color);
        color: white;
        border-color: var(--warning-color);
    }

    .btn-unpublish:hover {
        background-color: #d97706;
        border-color: #d97706;
    }

    .form-inline {
        display: inline;
        flex: 1;
    }

    .form-inline .btn {
        width: 100%;
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

    .empty-text {
        font-size: 1rem;
        color: var(--gray-600);
        margin-bottom: 8px;
    }

    .empty-subtext {
        font-size: 0.875rem;
        color: var(--gray-500);
        margin-bottom: 24px;
    }

    /* Video Description */
    .video-description {
        font-size: 0.875rem;
        color: var(--gray-600);
        line-height: 1.5;
        margin-bottom: 16px;
        display: -webkit-box;
        -webkit-line-clamp: 3;
        -webkit-box-orient: vertical;
        overflow: hidden;
        text-overflow: ellipsis;
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
        
        .videos-grid {
            grid-template-columns: 1fr;
        }
        
        .video-meta {
            flex-direction: column;
            gap: 8px;
        }
        
        .action-buttons {
            flex-direction: column;
        }
        
        .btn {
            width: 100%;
            justify-content: center;
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
        
        .alert {
            padding: 12px 16px;
            font-size: 0.875rem;
        }
        
        .video-card-header,
        .video-card-body,
        .video-card-footer {
            padding: 16px;
        }
    }

    /* Video Details */
    .video-details {
        background: var(--gray-50);
        border-radius: var(--border-radius-sm);
        padding: 12px;
        margin-top: 12px;
    }

    .detail-row {
        display: flex;
        justify-content: space-between;
        padding: 6px 0;
        border-bottom: 1px solid var(--gray-200);
        font-size: 0.8125rem;
    }

    .detail-row:last-child {
        border-bottom: none;
    }

    .detail-label {
        color: var(--gray-600);
        font-weight: 500;
    }

    .detail-value {
        color: var(--gray-700);
        text-align: right;
        max-width: 60%;
        word-break: break-word;
    }
</style>

<div class="admin-container">
    <!-- Page Header -->
    <div class="page-header">
        <h1 class="page-title">Video Pending</h1>
        <p class="page-description">Kelola dan tinjau video yang diajukan oleh staff. Approve video untuk dipublikasikan.</p>
    </div>

    <!-- Stats -->
    <div class="stats-grid">
        <div class="stat-card">
            <div class="stat-icon pending">
                <i class="fas fa-clock"></i>
            </div>
            <div class="stat-content">
                <div class="stat-label">Total Pending</div>
                <div class="stat-value">{{ $videos->count() }}</div>
            </div>
        </div>
        
        <div class="stat-card">
            <div class="stat-icon youtube">
                <i class="fab fa-youtube"></i>
            </div>
            <div class="stat-content">
                <div class="stat-label">YouTube Links</div>
                <div class="stat-value">{{ $videos->where('url', '!=', null)->count() }}</div>
            </div>
        </div>
        
        <div class="stat-card">
            <div class="stat-icon upload">
                <i class="fas fa-upload"></i>
            </div>
            <div class="stat-content">
                <div class="stat-label">Uploaded Videos</div>
                <div class="stat-value">{{ $videos->where('video_path', '!=', null)->count() }}</div>
            </div>
        </div>
        
        <div class="stat-card">
            <div class="stat-icon processed">
                <i class="fas fa-check-double"></i>
            </div>
            <div class="stat-content">
                <div class="stat-label">Sudah Diproses</div>
                <div class="stat-value">{{ $processedCount ?? 0 }}</div>
            </div>
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

    <!-- Videos Grid -->
    <div class="videos-grid">
        @if($videos->count() > 0)
            @foreach($videos as $video)
                <div class="video-card">
                    <div class="video-card-header">
                        <div class="video-card-title">
                            {{ Str::limit($video->title, 50) }}
                            <span class="video-type-badge {{ $video->video_path ? 'video-type-upload' : 'video-type-youtube' }}">
                                {{ $video->video_path ? 'UPLOAD' : 'YOUTUBE' }}
                            </span>
                        </div>
                        <div style="display: flex; align-items: center; gap: 8px; flex-wrap: wrap;">
                            <span class="status-badge status-pending">
                                <i class="fas fa-clock"></i> {{ ucfirst($video->status) }}
                            </span>
                            @if($video->status === 'approved')
                                <span class="status-badge {{ $video->is_published ? 'status-published' : 'status-approved' }}">
                                    <i class="fas {{ $video->is_published ? 'fa-eye' : 'fa-eye-slash' }}"></i>
                                    {{ $video->is_published ? 'Published' : 'Unpublished' }}
                                </span>
                            @endif
                        </div>
                    </div>
                    
                    <div class="video-card-body">
                        <!-- Video Preview -->
                        <div class="video-preview-container">
                            @if($video->url)
                                @php
                                    preg_match(
                                        '%(?:youtube\.com/(?:.*v=|v/|embed/)|youtu\.be/)([^&\n?#]+)%',
                                        $video->url,
                                        $matches
                                    );
                                    $youtubeId = $matches[1] ?? null;
                                @endphp
                                
                                @if($youtubeId)
                                    <iframe 
                                        src="https://www.youtube.com/embed/{{ $youtubeId }}"
                                        class="video-preview"
                                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                                        allowfullscreen>
                                    </iframe>
                                @else
                                    <div class="video-placeholder">
                                        <i class="fas fa-video-slash"></i>
                                    </div>
                                @endif
                            @elseif($video->video_path)
                                <video controls class="video-preview" poster="{{ asset('images/video-thumbnail.jpg') }}">
                                    <source src="{{ asset('storage/'.$video->video_path) }}" type="video/mp4">
                                    Browser Anda tidak mendukung tag video.
                                </video>
                            @else
                                <div class="video-placeholder">
                                    <i class="fas fa-video-slash"></i>
                                </div>
                            @endif
                        </div>
                        
                        @if($video->description)
                            <div class="video-description">
                                {{ Str::limit($video->description, 120) }}
                            </div>
                        @endif
                        
                        <!-- Video Meta -->
                        <div class="video-meta">
                            <div class="meta-item">
                                <i class="fas fa-user meta-icon"></i>
                                <span>{{ $video->user->name ?? 'Unknown' }}</span>
                            </div>
                            
                            <div class="meta-item">
                                <i class="fas fa-calendar meta-icon"></i>
                                <span>{{ $video->created_at->format('d M Y') }}</span>
                            </div>
                            
                            <div class="meta-item">
                                <i class="fas fa-clock meta-icon"></i>
                                <span>{{ $video->created_at->format('H:i') }}</span>
                            </div>
                        </div>
                        
                        <!-- Video Details -->
                        <div class="video-details">
                            <div class="detail-row">
                                <span class="detail-label">Tipe:</span>
                                <span class="detail-value">{{ $video->video_path ? 'Upload File' : 'YouTube Link' }}</span>
                            </div>
                            <div class="detail-row">
                                <span class="detail-label">Durasi:</span>
                                <span class="detail-value">{{ $video->duration ?? 'Unknown' }}</span>
                            </div>
                            <div class="detail-row">
                                <span class="detail-label">Views:</span>
                                <span class="detail-value">{{ $video->views ?? '0' }}</span>
                            </div>
                        </div>
                    </div>
                    
                    <div class="video-card-footer">
                        <div class="action-buttons">
                            <!-- View Button -->
                            @if($video->url)
                                <a href="{{ $video->url }}" 
                                   target="_blank" 
                                   class="btn btn-view btn-sm">
                                    <i class="fas fa-external-link-alt"></i> YouTube
                                </a>
                            @elseif($video->video_path)
                                <a href="{{ asset('storage/'.$video->video_path) }}" 
                                   target="_blank" 
                                   class="btn btn-view btn-sm">
                                    <i class="fas fa-play-circle"></i> Putar
                                </a>
                            @endif
                            
                            <!-- Status Actions -->
                            @if($video->status === 'pending')
                                <!-- Approve Button -->
                                <form method="POST" 
                                      action="{{ route('admin.videos.approve', $video) }}" 
                                      class="form-inline"
                                      onsubmit="return confirmAction('approve', '{{ addslashes($video->title) }}')">
                                    @csrf
                                    <button type="submit" class="btn btn-approve">
                                        <i class="fas fa-check"></i> Approve
                                    </button>
                                </form>
                                
                                <!-- Reject Button -->
                                <form method="POST" 
                                      action="{{ route('admin.videos.reject', $video) }}" 
                                      class="form-inline"
                                      onsubmit="return confirmAction('reject', '{{ addslashes($video->title) }}')">
                                    @csrf
                                    <button type="submit" class="btn btn-reject">
                                        <i class="fas fa-times"></i> Reject
                                    </button>
                                </form>
                            @endif
                            
                            <!-- Publish/Unpublish Toggle -->
                            @if($video->status === 'approved')
                                <form method="POST" 
                                      action="{{ route('admin.videos.toggle-publish', $video) }}" 
                                      class="form-inline"
                                      onsubmit="return confirm('{{ $video->is_published ? 'Unpublish' : 'Publish' }} video ini?')">
                                    @csrf
                                    @method('PATCH')
                                    <button type="submit" class="btn {{ $video->is_published ? 'btn-unpublish' : 'btn-publish' }}">
                                        <i class="fas {{ $video->is_published ? 'fa-eye-slash' : 'fa-eye' }}"></i>
                                        {{ $video->is_published ? 'Unpublish' : 'Publish' }}
                                    </button>
                                </form>
                            @endif
                        </div>
                    </div>
                </div>
            @endforeach
        @else
            <div class="empty-state">
                <div class="empty-icon">
                    <i class="fas fa-check-circle"></i>
                </div>
                <p class="empty-text">Tidak ada video pending</p>
                <p class="empty-subtext">Semua video telah diproses atau belum ada pengajuan video baru.</p>
                <a href="{{ route('admin.dashboard') }}" class="btn btn-view">
                    <i class="fas fa-arrow-left"></i> Kembali ke Dashboard
                </a>
            </div>
        @endif
    </div>
</div>

<!-- Modal for Video Preview -->
<div id="videoModal" style="display:none; position:fixed; top:0; left:0; width:100%; height:100%; background:rgba(0,0,0,0.9); z-index:1000; align-items:center; justify-content:center; padding:20px;">
    <div style="position:relative; width:100%; max-width:900px; max-height:90vh;">
        <button onclick="closeVideoModal()" style="position:absolute; top:-40px; right:0; background:none; border:none; color:white; font-size:1.5rem; cursor:pointer; z-index:1001;">&times;</button>
        <div id="modalVideoContainer" style="width:100%; height:0; padding-bottom:56.25%; position:relative;">
            <!-- Video will be loaded here -->
        </div>
    </div>
</div>

<script>
function confirmAction(action, title) {
    const actionMap = {
        'approve': 'menyetujui',
        'reject': 'menolak'
    };
    
    return confirm(`Apakah Anda yakin ingin ${actionMap[action]} video "${title}"?`);
}

function viewVideoInModal(videoElement) {
    const modal = document.getElementById('videoModal');
    const container = document.getElementById('modalVideoContainer');
    
    // Clone the video element
    const clonedVideo = videoElement.cloneNode(true);
    clonedVideo.style.width = '100%';
    clonedVideo.style.height = '100%';
    clonedVideo.style.position = 'absolute';
    clonedVideo.style.top = '0';
    clonedVideo.style.left = '0';
    
    // Clear container and add cloned video
    container.innerHTML = '';
    container.appendChild(clonedVideo);
    
    // Show modal
    modal.style.display = 'flex';
    document.body.style.overflow = 'hidden';
}

function closeVideoModal() {
    document.getElementById('videoModal').style.display = 'none';
    document.body.style.overflow = 'auto';
}

// Close modal when clicking outside
document.getElementById('videoModal').addEventListener('click', function(e) {
    if (e.target === this) {
        closeVideoModal();
    }
});

// Close modal with Escape key
document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape') {
        closeVideoModal();
    }
});

// Auto-hide alerts after 5 seconds
setTimeout(() => {
    const alerts = document.querySelectorAll('.alert');
    alerts.forEach(alert => {
        alert.style.transition = 'opacity 0.3s ease';
        alert.style.opacity = '0';
        setTimeout(() => alert.remove(), 300);
    });
}, 5000);

// Make video previews clickable for fullscreen
document.addEventListener('DOMContentLoaded', function() {
    const videoPreviews = document.querySelectorAll('.video-preview');
    videoPreviews.forEach(video => {
        video.addEventListener('click', function(e) {
            if (this.tagName === 'VIDEO') {
                // For uploaded videos, use fullscreen
                if (this.requestFullscreen) {
                    this.requestFullscreen();
                } else if (this.webkitRequestFullscreen) {
                    this.webkitRequestFullscreen();
                } else if (this.mozRequestFullScreen) {
                    this.mozRequestFullScreen();
                }
            }
        });
    });
});
</script>
@endsection