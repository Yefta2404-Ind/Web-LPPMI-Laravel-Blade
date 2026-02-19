@extends('layouts.admin')

@section('title', 'Pilih Struktur Organisasi Aktif')

@push('styles')
<style>
    /* Reset dan base */
    .structure-container {
        font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
    }

    /* Header */
    .page-header {
        padding: 1.5rem 0;
        border-bottom: 1px solid #e9ecef;
        margin-bottom: 2rem;
    }

    .page-title {
        font-size: 1.5rem;
        font-weight: 600;
        color: #343a40;
        margin-bottom: 0.25rem;
    }

    .page-subtitle {
        color: #6c757d;
        font-size: 0.875rem;
    }

    /* Alert */
    .custom-alert {
        border: none;
        border-left: 4px solid;
        border-radius: 0;
        padding: 1rem 1.25rem;
        margin-bottom: 1.5rem;
    }

    .alert-success {
        background-color: #d1e7dd;
        border-left-color: #0f5132;
    }

    .alert-danger {
        background-color: #f8d7da;
        border-left-color: #842029;
    }

    /* Card */
    .main-card {
        background: white;
        border: 1px solid #e0e0e0;
        border-radius: 8px;
        overflow: hidden;
    }

    /* Table */
    .structure-table {
        width: 100%;
        border-collapse: separate;
        border-spacing: 0;
    }

    .structure-table thead {
        background-color: #f8f9fa;
    }

    .structure-table th {
        padding: 1rem 1.25rem;
        font-weight: 600;
        color: #495057;
        text-transform: uppercase;
        font-size: 0.75rem;
        letter-spacing: 0.5px;
        border-bottom: 2px solid #dee2e6;
    }

    .structure-table td {
        padding: 1.25rem;
        vertical-align: middle;
        border-bottom: 1px solid #f0f0f0;
    }

    .structure-table tbody tr:last-child td {
        border-bottom: none;
    }

    .structure-table tbody tr:hover {
        background-color: #fafafa;
    }

    /* Status indicator */
    .status-indicator {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        width: 24px;
        height: 24px;
        border-radius: 50%;
        margin-right: 12px;
        flex-shrink: 0;
    }

    .status-active {
        background-color: #198754;
        color: white;
    }

    .status-inactive {
        background-color: #e9ecef;
        color: #adb5bd;
    }

    /* Structure info */
    .structure-name {
        font-weight: 500;
        color: #212529;
        margin-bottom: 2px;
    }

    .structure-meta {
        color: #6c757d;
        font-size: 0.8125rem;
        display: flex;
        align-items: center;
        gap: 8px;
    }

    /* Badge */
    .member-badge {
        display: inline-block;
        padding: 4px 8px;
        background-color: #e7f5ff;
        color: #0c63e4;
        border-radius: 4px;
        font-size: 0.75rem;
        font-weight: 500;
    }

    .status-badge {
        display: inline-block;
        padding: 4px 10px;
        background-color: #d1e7dd;
        color: #0f5132;
        border: 1px solid #badbcc;
        border-radius: 4px;
        font-size: 0.75rem;
        font-weight: 500;
    }

    /* Action buttons */
    .action-buttons {
        display: flex;
        gap: 8px;
        justify-content: flex-end;
    }

    .btn-preview {
        background: white;
        border: 1px solid #dee2e6;
        color: #495057;
        padding: 6px 12px;
        border-radius: 4px;
        font-size: 0.875rem;
        transition: all 0.2s;
        display: inline-flex;
        align-items: center;
        gap: 6px;
    }

    .btn-preview:hover {
        background-color: #f8f9fa;
        border-color: #adb5bd;
    }

    .btn-activate {
        background: #198754;
        border: 1px solid #198754;
        color: white;
        padding: 6px 16px;
        border-radius: 4px;
        font-size: 0.875rem;
        font-weight: 500;
        transition: all 0.2s;
    }

    .btn-activate:hover {
        background: #157347;
        border-color: #146c43;
    }

    .btn-disabled {
        background: white;
        border: 1px solid #198754;
        color: #198754;
        padding: 6px 16px;
        border-radius: 4px;
        font-size: 0.875rem;
        font-weight: 500;
        cursor: default;
    }

    /* Empty state */
    .empty-state {
        padding: 4rem 2rem;
        text-align: center;
    }

    .empty-icon {
        color: #dee2e6;
        font-size: 3rem;
        margin-bottom: 1.5rem;
    }

    .empty-title {
        color: #6c757d;
        font-size: 1.125rem;
        margin-bottom: 0.5rem;
    }

    .empty-description {
        color: #adb5bd;
        font-size: 0.875rem;
        margin-bottom: 1.5rem;
    }

    .btn-empty {
        background: #0d6efd;
        border: 1px solid #0d6efd;
        color: white;
        padding: 8px 20px;
        border-radius: 4px;
        font-size: 0.875rem;
        font-weight: 500;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        text-decoration: none;
        transition: all 0.2s;
    }

    .btn-empty:hover {
        background: #0b5ed7;
        border-color: #0a58ca;
        color: white;
    }

    /* Info box */
    .info-box {
        background: #f8f9fa;
        border-top: 1px solid #e9ecef;
        padding: 1.25rem;
    }

    .info-content {
        display: flex;
        align-items: flex-start;
        gap: 12px;
        color: #495057;
        font-size: 0.875rem;
        line-height: 1.5;
    }

    .info-icon {
        color: #0d6efd;
        font-size: 1rem;
        flex-shrink: 0;
        margin-top: 2px;
    }

    /* Modal */
    .preview-modal .modal-content {
        border: none;
        border-radius: 8px;
        box-shadow: 0 4px 20px rgba(0,0,0,0.15);
    }

    .preview-modal .modal-header {
        background: #f8f9fa;
        border-bottom: 1px solid #dee2e6;
        padding: 1.25rem 1.5rem;
    }

    .preview-modal .modal-title {
        font-weight: 600;
        color: #212529;
        font-size: 1.125rem;
    }

    .preview-modal .modal-body {
        padding: 1.5rem;
        max-height: 60vh;
        overflow-y: auto;
    }

    .preview-modal .modal-footer {
        border-top: 1px solid #dee2e6;
        padding: 1.25rem 1.5rem;
        background: #f8f9fa;
    }

    .member-list-title {
        color: #6c757d;
        font-size: 0.875rem;
        font-weight: 500;
        margin-bottom: 1rem;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .member-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
        gap: 1rem;
    }

    .member-card {
        background: white;
        border: 1px solid #e9ecef;
        border-radius: 6px;
        padding: 1rem;
        transition: box-shadow 0.2s;
    }

    .member-card:hover {
        box-shadow: 0 2px 8px rgba(0,0,0,0.1);
    }

    .member-info {
        display: flex;
        align-items: flex-start;
        gap: 12px;
    }

    .member-avatar {
        width: 50px;
        height: 50px;
        border-radius: 6px;
        object-fit: cover;
        background-color: #f8f9fa;
        flex-shrink: 0;
    }

    .member-details {
        flex: 1;
        min-width: 0;
    }

    .member-name {
        font-weight: 500;
        color: #212529;
        margin-bottom: 2px;
        word-break: break-word;
    }

    .member-position {
        color: #6c757d;
        font-size: 0.8125rem;
        word-break: break-word;
    }

    /* Footer info */
    .footer-info {
        padding: 1.25rem;
        border-top: 1px solid #e9ecef;
        background: #f8f9fa;
        color: #6c757d;
        font-size: 0.875rem;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    /* Responsive */
    @media (max-width: 768px) {
        .structure-table th,
        .structure-table td {
            padding: 0.75rem;
        }

        .member-grid {
            grid-template-columns: 1fr;
        }

        .action-buttons {
            flex-direction: column;
            gap: 6px;
        }

        .btn-preview,
        .btn-activate,
        .btn-disabled {
            width: 100%;
            justify-content: center;
        }

        .footer-info {
            flex-direction: column;
            gap: 8px;
            text-align: center;
        }
    }

    @media (max-width: 576px) {
        .structure-table {
            display: block;
        }

        .structure-table thead {
            display: none;
        }

        .structure-table tbody,
        .structure-table tr,
        .structure-table td {
            display: block;
            width: 100%;
        }

        .structure-table tr {
            margin-bottom: 1rem;
            border: 1px solid #dee2e6;
            border-radius: 6px;
            padding: 0;
        }

        .structure-table td {
            padding: 0.75rem;
            border-bottom: 1px solid #f0f0f0;
        }

        .structure-table td:last-child {
            border-bottom: none;
        }

        .structure-table td::before {
            content: attr(data-label);
            font-weight: 600;
            color: #495057;
            display: block;
            font-size: 0.75rem;
            margin-bottom: 4px;
            text-transform: uppercase;
        }

        .action-buttons {
            justify-content: flex-start;
        }
    }
</style>
@endpush

@section('content')
<div class="structure-container">
    <div class="page-header">
        <div class="d-flex justify-content-between align-items-center">
            <div>
                <h1 class="page-title">Pilih Struktur Organisasi Aktif</h1>
                <p class="page-subtitle">Kelola struktur organisasi yang akan ditampilkan di halaman publik</p>
            </div>
            <a href="{{ route('admin.organization-structure.index') }}" class="btn-preview">
                <i class="fas fa-arrow-left"></i>
                <span>Kembali</span>
            </a>
        </div>
    </div>

    @if(session('success'))
    <div class="custom-alert alert-success">
        <div class="d-flex align-items-center">
            <i class="fas fa-check-circle me-2"></i>
            <span>{{ session('success') }}</span>
        </div>
    </div>
    @endif

    @if(session('error'))
    <div class="custom-alert alert-danger">
        <div class="d-flex align-items-center">
            <i class="fas fa-exclamation-circle me-2"></i>
            <span>{{ session('error') }}</span>
        </div>
    </div>
    @endif

    <div class="main-card">
        @if($data->count() > 0)
        <div class="table-responsive">
            <table class="structure-table">
                <thead>
                    <tr>
                        <th style="width: 60px;">No</th>
                        <th>Struktur Organisasi</th>
                        <th style="width: 100px;" class="text-center">Anggota</th>
                        <th style="width: 200px;">Status</th>
                        <th style="width: 200px;" class="text-end">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($data as $index => $structure)
                    <tr>
                        <td data-label="No">{{ $index + 1 }}</td>
                        <td data-label="Struktur Organisasi">
                            <div class="d-flex align-items-start">
                                <div class="status-indicator {{ $structure->is_active ? 'status-active' : 'status-inactive' }}">
                                    <i class="fas {{ $structure->is_active ? 'fa-check' : 'fa-circle' }} fa-xs"></i>
                                </div>
                                <div>
                                    <div class="structure-name">{{ $structure->name }}</div>
                                    <div class="structure-meta">
                                        <span><i class="far fa-user"></i> {{ $structure->user->name ?? 'Tidak diketahui' }}</span>
                                        <span>•</span>
                                        <span><i class="far fa-calendar"></i> {{ $structure->updated_at->format('d/m/Y') }}</span>
                                    </div>
                                </div>
                            </div>
                        </td>
                        <td data-label="Anggota" class="text-center">
                            <span class="member-badge">{{ $structure->members->count() }}</span>
                        </td>
                        <td data-label="Status">
                            @if($structure->is_active)
                            <span class="status-badge">Aktif</span>
                            @else
                            <span class="text-muted">Nonaktif</span>
                            @endif
                        </td>
                        <td data-label="Aksi" class="text-end">
                            <div class="action-buttons">
                                <button type="button" 
                                        class="btn-preview"
                                        data-bs-toggle="modal" 
                                        data-bs-target="#previewModal{{ $structure->id }}">
                                    <i class="fas fa-eye"></i>
                                    <span>Preview</span>
                                </button>
                                
                                @if(!$structure->is_active)
                                <form action="{{ route('admin.organization-structure.approve', $structure->id) }}" 
                                      method="POST" 
                                      class="d-inline"
                                      onsubmit="return confirm('Aktifkan struktur organisasi ini? Struktur aktif sebelumnya akan dinonaktifkan.')">
                                    @csrf
                                    <button type="submit" class="btn-activate">
                                        <i class="fas fa-check me-1"></i>
                                        <span>Aktifkan</span>
                                    </button>
                                </form>
                                @else
                                <button class="btn-disabled" disabled>
                                    <i class="fas fa-check-double me-1"></i>
                                    <span>Aktif</span>
                                </button>
                                @endif
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="info-box">
            <div class="info-content">
                <i class="fas fa-info-circle info-icon"></i>
                <div>
                    Hanya satu struktur organisasi yang dapat aktif pada satu waktu. 
                    Mengaktifkan struktur baru akan menonaktifkan struktur aktif sebelumnya.
                </div>
            </div>
        </div>
        @else
        <div class="empty-state">
            <div class="empty-icon">
                <i class="fas fa-sitemap"></i>
            </div>
            <h3 class="empty-title">Belum ada struktur organisasi</h3>
            <p class="empty-description">
                Tidak ada struktur organisasi yang telah disetujui.
            </p>
            <a href="{{ route('admin.organization-structure.pending') }}" class="btn-empty">
                <i class="fas fa-clock"></i>
                <span>Lihat yang menunggu persetujuan</span>
            </a>
        </div>
        @endif
    </div>

    @if($data->count() > 0)
    <div class="footer-info">
        <span>Total: {{ $data->count() }} struktur organisasi</span>
        <span>Klik "Preview" untuk melihat detail struktur</span>
    </div>
    @endif
</div>

<!-- Modals -->
@foreach($data as $structure)
<div class="modal fade preview-modal" id="previewModal{{ $structure->id }}" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">{{ $structure->name }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <div class="member-list-title">Daftar Anggota</div>
                <div class="member-grid">
                    @foreach($structure->members->sortBy('order') as $member)
                    <div class="member-card">
                        <div class="member-info">
                            @if($member->photo)
                            <img src="{{ asset('storage/' . $member->photo) }}" 
                                 class="member-avatar" 
                                 alt="{{ $member->name }}"
                                 onerror="this.src='https://ui-avatars.com/api/?name={{ urlencode($member->name) }}&background=e9ecef&color=495057&size=50'">
                            @else
                            <img src="https://ui-avatars.com/api/?name={{ urlencode($member->name) }}&background=e9ecef&color=495057&size=50" 
                                 class="member-avatar" 
                                 alt="{{ $member->name }}">
                            @endif
                            <div class="member-details">
                                <div class="member-name">{{ $member->name }}</div>
                                <div class="member-position">{{ $member->position }}</div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn-preview" data-bs-dismiss="modal">
                    <i class="fas fa-times me-1"></i>
                    <span>Tutup</span>
                </button>
                @if(!$structure->is_active)
                <form action="{{ route('admin.organization-structure.approve', $structure->id) }}" method="POST">
                    @csrf
                    <button type="submit" class="btn-activate">
                        <i class="fas fa-check me-1"></i>
                        <span>Aktifkan Struktur Ini</span>
                    </button>
                </form>
                @endif
            </div>
        </div>
    </div>
</div>
@endforeach

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Auto close alerts after 5 seconds
        const alerts = document.querySelectorAll('.custom-alert');
        alerts.forEach(alert => {
            setTimeout(() => {
                if (alert.parentNode) {
                    const closeBtn = alert.querySelector('.btn-close');
                    if (closeBtn) closeBtn.click();
                }
            }, 5000);
        });

        // Add data-label attributes for responsive table
        if (window.innerWidth <= 576) {
            const tableCells = document.querySelectorAll('.structure-table td');
            const headers = ['No', 'Struktur Organisasi', 'Anggota', 'Status', 'Aksi'];
            
            tableCells.forEach((cell, index) => {
                const headerIndex = index % 5;
                cell.setAttribute('data-label', headers[headerIndex]);
            });
        }

        // Handle image errors
        document.querySelectorAll('.member-avatar').forEach(img => {
            img.addEventListener('error', function() {
                const name = this.alt || '';
                const encodedName = encodeURIComponent(name);
                this.src = `https://ui-avatars.com/api/?name=${encodedName}&background=e9ecef&color=495057&size=50`;
            });
        });
    });
</script>
@endpush
@endsection