@extends('layouts.admin')

@section('page-title', 'Manajemen Survey')
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
        --archive-color: #6b7280;
        --archive-light: #f3f4f6;
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
        --transition: 200ms ease;
    }

    .admin-container {
        max-width: 1400px;
        margin: 0 auto;
        padding: 0 16px;
    }

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
        .stats-grid { grid-template-columns: repeat(2, 1fr); }
    }
    @media (min-width: 768px) {
        .stats-grid { grid-template-columns: repeat(4, 1fr); }
    }
    @media (min-width: 1024px) {
        .stats-grid { grid-template-columns: repeat(4, 1fr); }
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

    .stat-icon.total { background-color: var(--primary-light); color: var(--primary-color); }
    .stat-icon.active { background-color: var(--info-light); color: var(--info-color); }
    .stat-icon.archive { background-color: var(--archive-light); color: var(--archive-color); }
    .stat-icon.pending { background-color: var(--warning-light); color: var(--warning-color); }

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

    /* Info Banner */
    .info-banner {
        background: linear-gradient(135deg, var(--primary-light) 0%, #eff6ff 100%);
        border: 1px solid var(--primary-color);
        border-radius: var(--border-radius);
        padding: 16px 24px;
        margin-bottom: 24px;
        display: flex;
        align-items: center;
        gap: 16px;
        color: var(--primary-dark);
    }

    .info-banner i {
        font-size: 1.5rem;
    }

    .info-banner-content {
        flex: 1;
    }

    .info-banner-title {
        font-weight: 600;
        margin-bottom: 4px;
    }

    .info-banner-text {
        font-size: 0.875rem;
        opacity: 0.9;
    }

    /* Table Container */
    .table-container {
        background: white;
        border-radius: var(--border-radius);
        border: 1px solid var(--gray-200);
        box-shadow: var(--shadow-sm);
        overflow: hidden;
        margin-bottom: 40px;
    }

    .responsive-table {
        width: 100%;
        border-collapse: collapse;
    }

    .responsive-table thead {
        background-color: var(--gray-50);
        border-bottom: 2px solid var(--gray-200);
    }

    .responsive-table th {
        padding: 16px 20px;
        text-align: left;
        font-size: 0.8125rem;
        font-weight: 600;
        color: var(--gray-600);
        text-transform: uppercase;
        letter-spacing: 0.05em;
        white-space: nowrap;
    }

    .responsive-table td {
        padding: 20px;
        font-size: 0.9375rem;
        color: var(--gray-700);
        border-bottom: 1px solid var(--gray-100);
        vertical-align: middle;
    }

    .responsive-table tbody tr:last-child td { border-bottom: none; }
    .responsive-table tbody tr:hover { background-color: var(--gray-50); }
    
    /* Row Styling */
    .row-active {
        background-color: rgba(139, 92, 246, 0.05);
        border-left: 4px solid var(--info-color);
    }
    
    .row-pending {
        background-color: rgba(245, 158, 11, 0.05);
        border-left: 4px solid var(--warning-color);
    }
    
    .row-archived {
        background-color: rgba(107, 114, 128, 0.05);
        border-left: 4px solid var(--archive-color);
    }

    /* Survey Info */
    .survey-title {
        font-weight: 600;
        color: var(--gray-900);
        margin-bottom: 4px;
        line-height: 1.4;
        display: flex;
        align-items: center;
        flex-wrap: wrap;
        gap: 8px;
    }

    .active-survey-title {
        color: var(--info-color);
        font-weight: 700;
    }

    .active-badge-small {
        display: inline-block;
        background-color: var(--info-light);
        color: var(--info-color);
        font-size: 0.6875rem;
        font-weight: 600;
        padding: 2px 8px;
        border-radius: 12px;
        text-transform: uppercase;
        letter-spacing: 0.05em;
        border: 1px solid var(--info-color);
    }

    .survey-description {
        font-size: 0.8125rem;
        color: var(--gray-600);
        line-height: 1.5;
        margin-top: 6px;
    }

    .survey-meta {
        display: flex;
        flex-wrap: wrap;
        gap: 16px;
        margin-top: 8px;
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
    }

    /* Status Badge - Sederhana & Jelas */
    .status-badge {
        display: inline-flex;
        align-items: center;
        padding: 8px 16px;
        border-radius: 20px;
        font-size: 0.8125rem;
        font-weight: 600;
        gap: 8px;
        border: 1px solid transparent;
    }

    .status-active {
        background-color: var(--info-light);
        color: var(--info-color);
        border: 1px solid var(--info-color);
    }

    .status-archived {
        background-color: var(--archive-light);
        color: var(--archive-color);
        border: 1px solid var(--archive-color);
    }

    .status-pending {
        background-color: var(--warning-light);
        color: var(--warning-color);
        border: 1px solid var(--warning-color);
    }

    /* QR Code */
    .qr-container {
        display: flex;
        flex-direction: column;
        align-items: center;
        gap: 8px;
    }

    .qr-image {
        width: 80px;
        height: 80px;
        border: 1px solid var(--gray-200);
        border-radius: var(--border-radius-sm);
        padding: 4px;
        background: white;
        transition: transform var(--transition);
        cursor: pointer;
    }

    .qr-image:hover { transform: scale(1.1); }
    .qr-action {
        font-size: 0.75rem;
        color: var(--primary-color);
        text-decoration: none;
        font-weight: 500;
    }
    .qr-action:hover { text-decoration: underline; }

    /* Action Buttons */
    .action-buttons {
        display: flex;
        flex-direction: column;
        gap: 8px;
        min-width: 140px;
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
    }

    .btn-sm { padding: 6px 12px; font-size: 0.75rem; }
    .btn-view { background-color: white; color: var(--gray-700); border-color: var(--gray-300); }
    .btn-view:hover { background-color: var(--gray-50); border-color: var(--gray-400); }
    
    .btn-activate {
        background-color: var(--info-color);
        color: white;
        border-color: var(--info-color);
    }
    .btn-activate:hover { background-color: #7c3aed; border-color: #7c3aed; }
    
    .btn-approve {
        background-color: var(--success-color);
        color: white;
        border-color: var(--success-color);
    }
    .btn-approve:hover { background-color: #0da271; border-color: #0da271; }
    
    .btn-archive-action {
        background-color: var(--archive-color);
        color: white;
        border-color: var(--archive-color);
    }
    .btn-archive-action:hover { background-color: #4b5563; border-color: #4b5563; }
    
    .btn-pending {
        background-color: var(--warning-color);
        color: white;
        border-color: var(--warning-color);
    }
    .btn-pending:hover { background-color: #d97706; border-color: #d97706; }
    
    .btn-danger {
        background-color: var(--danger-color);
        color: white;
        border-color: var(--danger-color);
    }
    .btn-danger:hover { background-color: #dc2626; border-color: #dc2626; }
    
    .btn-outline {
        background-color: white;
        color: var(--gray-700);
        border-color: var(--gray-300);
    }
    .btn-outline:hover { background-color: var(--gray-50); }

    .form-inline { display: inline; }

    /* Empty State */
    .empty-state {
        text-align: center;
        padding: 60px 20px;
        color: var(--gray-500);
    }
    .empty-icon { font-size: 3rem; margin-bottom: 16px; opacity: 0.5; }
    .empty-text { font-size: 1rem; color: var(--gray-600); margin-bottom: 8px; }
    .empty-subtext { font-size: 0.875rem; color: var(--gray-500); margin-bottom: 24px; }

    /* Modal */
    .modal {
        display: none;
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0, 0, 0, 0.5);
        z-index: 1000;
        align-items: center;
        justify-content: center;
        padding: 16px;
    }
    .modal-content {
        background: white;
        border-radius: var(--border-radius);
        width: 100%;
        max-width: 500px;
        max-height: 90vh;
        overflow-y: auto;
        animation: modalSlide 0.3s ease;
    }
    @keyframes modalSlide {
        from { opacity: 0; transform: translateY(-20px); }
        to { opacity: 1; transform: translateY(0); }
    }
    .modal-header {
        padding: 24px 24px 16px;
        border-bottom: 1px solid var(--gray-200);
        display: flex;
        align-items: center;
        justify-content: space-between;
    }
    .modal-title { font-size: 1.25rem; font-weight: 600; color: var(--gray-900); }
    .modal-close {
        background: none; border: none; font-size: 1.5rem; color: var(--gray-500);
        cursor: pointer; line-height: 1; padding: 4px;
    }
    .modal-close:hover { color: var(--gray-700); }
    .modal-body { padding: 24px; }

    /* Responsive */
    @media (max-width: 768px) {
        .admin-container { padding: 0 12px; }
        .page-header { margin-bottom: 24px; }
        .page-title { font-size: 1.5rem; }
        .stats-grid { grid-template-columns: repeat(2, 1fr); }
        .responsive-table {
            display: block;
            overflow-x: auto;
        }
        .action-buttons {
            width: 100%;
            flex-direction: row;
            flex-wrap: wrap;
        }
        .row-active, .row-pending, .row-archived {
            border-left-width: 2px;
        }
    }
    @media (max-width: 480px) {
        .page-title { font-size: 1.25rem; }
        .stats-grid { grid-template-columns: repeat(1, 1fr); }
        .action-buttons { flex-direction: column; }
        .action-buttons .btn { width: 100%; justify-content: center; }
    }
</style>

<div class="admin-container">
    <!-- Page Header -->
    <div class="page-header">
        <h1 class="page-title">Manajemen Survey</h1>
        <p class="page-description">
            <strong>Aturan Survey:</strong> Hanya <strong>1 (satu) survey</strong> yang dapat berstatus <span class="status-badge status-active" style="padding: 4px 12px; font-size: 0.75rem;">AKTIF</span> dalam satu waktu. 
            Anda dapat memilih dan mengaktifkan survey manapun yang sedang tidak aktif.
        </p>
    </div>

    <!-- Info Banner - Menjelaskan Logika -->
    <div class="info-banner">
        <i class="fas fa-info-circle"></i>
        <div class="info-banner-content">
            <div class="info-banner-title">⚡ Pilih Survey yang Akan Aktif</div>
            <div class="info-banner-text">
                Klik tombol <strong>"Aktifkan"</strong> pada survey yang ingin dijadikan aktif. 
                Survey yang sedang aktif akan otomatis diarsipkan dan digantikan oleh survey yang baru Anda pilih.
            </div>
        </div>
    </div>

    <!-- Stats Cards -->
    <div class="stats-grid">
        <div class="stat-card">
            <div class="stat-icon total">
                <i class="fas fa-poll"></i>
            </div>
            <div class="stat-content">
                <div class="stat-label">Total Survey</div>
                <div class="stat-value">{{ $surveys->count() }}</div>
            </div>
        </div>
        
        <div class="stat-card">
            <div class="stat-icon active">
                <i class="fas fa-play-circle"></i>
            </div>
            <div class="stat-content">
                <div class="stat-label">Aktif Saat Ini</div>
                <div class="stat-value">
                    {{ $surveys->where('status', 'approved')->where('archive', false)->count() }}
                </div>
            </div>
        </div>
        
        <div class="stat-card">
            <div class="stat-icon pending">
                <i class="fas fa-clock"></i>
            </div>
            <div class="stat-content">
                <div class="stat-label">Menunggu Approval</div>
                <div class="stat-value">{{ $surveys->where('status', 'pending')->count() }}</div>
            </div>
        </div>
        
        <div class="stat-card">
            <div class="stat-icon archive">
                <i class="fas fa-archive"></i>
            </div>
            <div class="stat-content">
                <div class="stat-label">Diarsipkan</div>
                <div class="stat-value">{{ $surveys->where('archive', true)->count() }}</div>
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

    <!-- Table Container -->
    <div class="table-container">
        @if($surveys->count() > 0)
            <table class="responsive-table">
                <thead>
                    <tr>
                        <th>Informasi Survey</th>
                        <th>Status Saat Ini</th>
                        <th>QR Code</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $activeSurvey = $surveys->where('status', 'approved')->where('archive', false)->first();
                    @endphp

                    @foreach($surveys as $survey)
                        @php
                            $rowClass = '';
                            if ($survey->id === optional($activeSurvey)->id) {
                                $rowClass = 'row-active';
                            } elseif ($survey->status === 'pending') {
                                $rowClass = 'row-pending';
                            } elseif ($survey->archive) {
                                $rowClass = 'row-archived';
                            }
                        @endphp
                        
                        <tr class="{{ $rowClass }}">
                            <td data-label="Informasi Survey">
                                <div class="survey-title {{ $survey->id === optional($activeSurvey)->id ? 'active-survey-title' : '' }}">
                                    {{ $survey->title }}
                                    
                                    @if($survey->id === optional($activeSurvey)->id)
                                        <span class="active-badge-small">
                                            <i class="fas fa-play-circle"></i> AKTIF
                                        </span>
                                    @endif
                                </div>
                                
                                @if($survey->description)
                                    <div class="survey-description">
                                        {{ Str::limit($survey->description, 100) }}
                                    </div>
                                @endif
                                
                                <div class="survey-meta">
                                    <div class="meta-item">
                                        <i class="fas fa-user meta-icon"></i>
                                        <span>{{ $survey->user->name ?? 'Unknown' }}</span>
                                    </div>
                                    
                                    <div class="meta-item">
                                        <i class="fas fa-calendar meta-icon"></i>
                                        <span>{{ $survey->created_at->format('d/m/Y') }}</span>
                                    </div>
                                    
                                    @if($survey->questions_count ?? false)
                                        <div class="meta-item">
                                            <i class="fas fa-question-circle meta-icon"></i>
                                            <span>{{ $survey->questions_count }} pertanyaan</span>
                                        </div>
                                    @endif
                                    
                                    @if($survey->archive && $survey->archived_at)
                                        <div class="meta-item">
                                            <i class="fas fa-clock meta-icon"></i>
                                            <span>Diarsipkan: {{ \Carbon\Carbon::parse($survey->archived_at)->diffForHumans() }}</span>
                                        </div>
                                    @endif
                                    
                                    @if($survey->status === 'pending')
                                        <div class="meta-item">
                                            <i class="fas fa-hourglass-half meta-icon"></i>
                                            <span>Menunggu approval</span>
                                        </div>
                                    @endif
                                </div>
                            </td>
                            
                            <td data-label="Status Saat Ini">
                                @if($survey->status === 'pending')
                                    <span class="status-badge status-pending">
                                        <i class="fas fa-clock"></i> Pending
                                    </span>
                                @elseif($survey->status === 'approved')
                                    @if(!$survey->archive)
                                        <span class="status-badge status-active">
                                            <i class="fas fa-play-circle"></i> AKTIF
                                        </span>
                                    @else
                                        <span class="status-badge status-archived">
                                            <i class="fas fa-archive"></i> Diarsipkan
                                        </span>
                                    @endif
                                @endif
                            </td>
                            
                            <td data-label="QR Code">
                                @if($survey->qr_code)
                                    <div class="qr-container">
                                        <img src="{{ asset('storage/' . $survey->qr_code) }}"
                                             alt="QR Code Survey"
                                             class="qr-image"
                                             onclick="viewQrCode('{{ asset('storage/' . $survey->qr_code) }}', '{{ $survey->title }}')">
                                        <a href="{{ asset('storage/' . $survey->qr_code) }}" 
                                           download="qr-code-{{ Str::slug($survey->title) }}.png"
                                           class="qr-action">
                                            <i class="fas fa-download"></i> Download
                                        </a>
                                    </div>
                                @else
                                    <div style="color: var(--gray-400); font-size: 0.875rem;">
                                        <i class="fas fa-qrcode"></i> Tidak tersedia
                                    </div>
                                @endif
                            </td>
                            
                            <td data-label="Aksi">
                                <div class="action-buttons">
                                    <!-- BUTTON DETAIL - Selalu Ada untuk Semua Survey -->
                                    <button type="button" 
                                            class="btn btn-view btn-sm"
                                            onclick="viewSurveyDetails({{ $survey->id }})">
                                        <i class="fas fa-eye"></i> Detail
                                    </button>

                                    @if($survey->id === optional($activeSurvey)->id)
                                        <!-- ========== SURVEY SEDANG AKTIF ========== -->
                                        <span class="btn btn-sm" style="background: var(--info-light); color: var(--info-color); border: 1px solid var(--info-color); cursor: default; width: 100%;">
                                            <i class="fas fa-check-circle"></i> Sedang Aktif
                                        </span>
                                        
                                    @else
                                        <!-- ========== SURVEY TIDAK AKTIF ========== -->
                                        @if($survey->status === 'approved')
    <form method="POST" 
          action="{{ route('admin.surveys.activate', $survey) }}" 
          class="form-inline w-full">
        @csrf
        <button type="submit" 
                class="btn btn-activate btn-sm" 
                style="width: 100%;"
                onclick="return confirm('Aktifkan survey \"{{ addslashes($survey->title) }}\"?\n\nSurvey aktif saat ini akan diarsipkan.')">
            <i class="fas fa-play-circle"></i> Aktifkan
        </button>
    </form>
@endif

                                        <!-- SEMUA SURVEY YANG TIDAK AKTIF BISA DIAKTIFKAN -->
                                        
                                        @if($survey->status === 'pending')
                                            <!-- Untuk Pending: Approve Sekaligus Aktifkan -->
                                            <form method="POST" 
                                                  action="{{ route('admin.surveys.approve', $survey) }}" 
                                                  class="form-inline w-full">
                                                @csrf
                                                <button type="submit" class="btn btn-approve btn-sm" style="width: 100%;"
                                                        onclick="return confirm('Setujui dan aktifkan survey \"{{ addslashes($survey->title) }}\"?\n\nSurvey yang sedang aktif akan otomatis diarsipkan.')">
                                                    <i class="fas fa-check-circle"></i> Approve & Aktifkan
                                                </button>
                                            </form>
                                        @else
                                        
                                        @endif
                                        
                                        <!-- Tombol Hapus hanya untuk yang sudah diarsipkan -->
                                        @if($survey->archive)
                                            <form method="POST" 
                                                  action="{{ route('admin.surveys.destroy', $survey) }}" 
                                                  class="form-inline w-full">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm" style="width: 100%;"
                                                        onclick="return confirm('Hapus permanen survey \"{{ addslashes($survey->title) }}\"? Tindakan ini tidak dapat dibatalkan.')">
                                                    <i class="fas fa-trash"></i> Hapus
                                                </button>
                                            </form>
                                        @endif
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <div class="empty-state">
                <div class="empty-icon">
                    <i class="fas fa-poll-h"></i>
                </div>
                <p class="empty-text">Belum ada survey</p>
                <p class="empty-subtext">Survey yang diajukan oleh staff akan muncul di sini</p>
            </div>
        @endif
    </div>
</div>

<!-- Modal for Survey Details -->
<div id="surveyModal" class="modal">
    <div class="modal-content">
        <div class="modal-header">
            <h2 class="modal-title">Detail Survey</h2>
            <button class="modal-close" onclick="closeModal()">&times;</button>
        </div>
        <div class="modal-body" id="modalContent">
            <!-- Content will be loaded here -->
        </div>
    </div>
</div>

<!-- Modal for QR Code -->
<div id="qrModal" class="modal">
    <div class="modal-content" style="max-width: 400px;">
        <div class="modal-header">
            <h2 class="modal-title" id="qrModalTitle">QR Code</h2>
            <button class="modal-close" onclick="closeQrModal()">&times;</button>
        </div>
        <div class="modal-body" style="text-align: center; padding: 32px;">
            <img id="qrModalImage" src="" alt="QR Code" style="max-width: 100%; height: auto;">
            <div style="margin-top: 20px;">
                <a id="qrDownloadLink" href="#" download class="btn btn-activate" style="width: 100%;">
                    <i class="fas fa-download"></i> Download QR Code
                </a>
            </div>
        </div>
    </div>
</div>

<script>
// View Survey Details
function viewSurveyDetails(id) {
    const modal = document.getElementById('surveyModal');
    const content = document.getElementById('modalContent');
    
    content.innerHTML = `
        <div style="text-align: center; padding: 40px 20px;">
            <i class="fas fa-spinner fa-spin" style="font-size: 2rem; color: var(--primary-color); margin-bottom: 16px;"></i>
            <p style="color: var(--gray-600);">Memuat detail survey...</p>
        </div>
    `;
    
    modal.style.display = 'flex';
    document.body.style.overflow = 'hidden';
    
    // Simulasi AJAX
    setTimeout(() => {
        content.innerHTML = `
            <div style="margin-bottom: 24px;">
                <div style="font-size: 1.125rem; font-weight: 600; color: var(--gray-900); margin-bottom: 16px;">
                    Detail Survey #${id}
                </div>
                <div style="background: var(--gray-50); padding: 20px; border-radius: var(--border-radius-sm);">
                    <p style="color: var(--gray-600); margin-bottom: 12px;">
                        <i class="fas fa-info-circle" style="color: var(--primary-color);"></i>
                        Fitur detail survey akan segera tersedia.
                    </p>
                </div>
            </div>
        `;
    }, 500);
}

// View QR Code
function viewQrCode(imageSrc, title) {
    const modal = document.getElementById('qrModal');
    const qrImage = document.getElementById('qrModalImage');
    const qrTitle = document.getElementById('qrModalTitle');
    const qrDownloadLink = document.getElementById('qrDownloadLink');
    
    qrImage.src = imageSrc;
    qrTitle.textContent = `QR Code: ${title}`;
    qrDownloadLink.href = imageSrc;
    qrDownloadLink.download = `qr-code-${title.replace(/\s+/g, '-').toLowerCase()}.png`;
    
    modal.style.display = 'flex';
    document.body.style.overflow = 'hidden';
}

// Close modals
function closeModal() {
    document.getElementById('surveyModal').style.display = 'none';
    document.body.style.overflow = 'auto';
}

function closeQrModal() {
    document.getElementById('qrModal').style.display = 'none';
    document.body.style.overflow = 'auto';
}

// Close modals when clicking outside
document.addEventListener('click', function(e) {
    if (e.target.classList.contains('modal')) {
        e.target.style.display = 'none';
        document.body.style.overflow = 'auto';
    }
});

// Close modals with Escape key
document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape') {
        closeModal();
        closeQrModal();
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
</script>
@endsection