@extends('layouts.admin')

@section('page-title', 'Struktur Organisasi')

@section('content')
<style>
/* --- Simple & Clean CSS --- */
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

/* Alert */
.alert-custom {
    border: none;
    border-radius: 12px;
    padding: 12px 20px;
    margin-bottom: 24px;
    background: #f8fafc;
}

/* Main Card */
.main-card {
    background: white;
    border-radius: 20px;
    box-shadow: 0 1px 3px rgba(0,0,0,0.05);
    overflow: hidden;
}

/* Header */
.card-header-custom {
    padding: 24px 28px;
    border-bottom: 1px solid #f0f0f0;
    display: flex;
    justify-content: space-between;
    align-items: center;
    flex-wrap: wrap;
    gap: 16px;
}

.header-left h3 {
    font-size: 18px;
    font-weight: 600;
    color: #1a1a2e;
    margin-bottom: 4px;
}

.header-left p {
    font-size: 13px;
    color: #6c757d;
    margin: 0;
}

.header-right {
    display: flex;
    gap: 12px;
    align-items: center;
    flex-wrap: wrap;
}

.badge-stat {
    padding: 6px 14px;
    background: #f8f9fa;
    border-radius: 30px;
    font-size: 13px;
    color: #495057;
}

.badge-stat i {
    margin-right: 6px;
    font-size: 12px;
}

.badge-stat.active {
    background: #e3f2fd;
    color: #1976d2;
}

.btn-add {
    background: #1976d2;
    color: white;
    border: none;
    padding: 8px 20px;
    border-radius: 30px;
    font-size: 13px;
    font-weight: 500;
    text-decoration: none;
    display: inline-flex;
    align-items: center;
    gap: 8px;
    transition: all 0.2s;
}

.btn-add:hover {
    background: #1565c0;
    color: white;
    transform: translateY(-1px);
}

/* Grid Layout - CENTERED HORIZONTALLY */
.structures-grid {
    padding: 32px 28px;
    display: flex;
    flex-wrap: wrap;
    justify-content: center;
    gap: 24px;
    background: #fafbfc;
}

/* Structure Card - Fixed Width */
.structure-item {
    background: white;
    border-radius: 16px;
    width: 380px;
    transition: all 0.2s;
    box-shadow: 0 1px 2px rgba(0,0,0,0.03);
    border: 1px solid #eef2f6;
    flex-shrink: 0;
}

.structure-item:hover {
    box-shadow: 0 4px 12px rgba(0,0,0,0.08);
    transform: translateY(-2px);
    border-color: #e0e7ed;
}

/* Card Content */
.card-padding {
    padding: 20px;
}

.card-header-info {
    display: flex;
    justify-content: space-between;
    align-items: flex-start;
    margin-bottom: 16px;
}

.structure-title {
    font-size: 16px;
    font-weight: 600;
    color: #1a1a2e;
    margin-bottom: 6px;
}

.structure-date {
    font-size: 11px;
    color: #94a3b8;
    display: flex;
    align-items: center;
    gap: 5px;
}

.status {
    padding: 4px 10px;
    border-radius: 30px;
    font-size: 11px;
    font-weight: 500;
}

.status-active {
    background: #e6f7e6;
    color: #2e7d32;
}

.status-inactive {
    background: #f5f5f5;
    color: #757575;
}

/* Member Section */
.member-info {
    margin: 16px 0;
    padding: 12px 0;
    border-top: 1px solid #f0f0f0;
    border-bottom: 1px solid #f0f0f0;
}

.member-count {
    display: flex;
    align-items: center;
    justify-content: space-between;
    margin-bottom: 12px;
}

.count-badge {
    background: #f0f7ff;
    padding: 4px 10px;
    border-radius: 20px;
    font-size: 12px;
    font-weight: 500;
    color: #1976d2;
}

.count-badge i {
    margin-right: 5px;
    font-size: 11px;
}

.btn-view {
    background: none;
    border: none;
    color: #1976d2;
    font-size: 12px;
    cursor: pointer;
    padding: 0;
}

.btn-view:hover {
    text-decoration: underline;
}

/* Member List Preview */
.member-list {
    display: flex;
    flex-direction: column;
    gap: 8px;
}

.member-row {
    display: flex;
    align-items: center;
    gap: 10px;
    padding: 6px 0;
}

.member-avatar-small {
    width: 28px;
    height: 28px;
    border-radius: 8px;
    background: #f5f5f5;
    display: flex;
    align-items: center;
    justify-content: center;
    color: #9e9e9e;
    font-size: 12px;
    overflow: hidden;
}

.member-avatar-small img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

.member-name-small {
    font-size: 13px;
    font-weight: 500;
    color: #2c3e50;
}

.member-position-small {
    font-size: 11px;
    color: #94a3b8;
}

.empty-members {
    text-align: center;
    padding: 20px;
    color: #94a3b8;
    font-size: 13px;
}

/* Action Buttons */
.action-buttons {
    display: flex;
    gap: 8px;
    justify-content: flex-end;
    margin-top: 16px;
}

.btn-action {
    width: 34px;
    height: 34px;
    border-radius: 10px;
    border: 1px solid #e5e7eb;
    background: white;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    cursor: pointer;
    transition: all 0.2s;
    color: #6b7280;
}

.btn-action:hover {
    transform: translateY(-1px);
}

.btn-toggle-on {
    color: #10b981;
    border-color: #d1fae5;
    background: #f0fdf4;
}

.btn-toggle-off {
    color: #9ca3af;
}

.btn-edit:hover {
    color: #f59e0b;
    border-color: #fed7aa;
    background: #fffbeb;
}

.btn-preview:hover {
    color: #3b82f6;
    border-color: #bfdbfe;
    background: #eff6ff;
}

.btn-delete:hover {
    color: #ef4444;
    border-color: #fecaca;
    background: #fef2f2;
}

/* Pagination */
.pagination-wrapper {
    padding: 20px 28px;
    border-top: 1px solid #f0f0f0;
    background: white;
    display: flex;
    justify-content: center;
}

.pagination {
    margin: 0;
    gap: 5px;
}

.page-link {
    border: none;
    padding: 6px 12px;
    border-radius: 8px;
    color: #5b6e8c;
    font-size: 13px;
}

.page-item.active .page-link {
    background: #1976d2;
    color: white;
}

/* Empty State */
.empty-state {
    text-align: center;
    padding: 60px 28px;
    background: #fafbfc;
}

.empty-state i {
    font-size: 48px;
    color: #cbd5e1;
    margin-bottom: 16px;
}

.empty-state h5 {
    font-size: 16px;
    font-weight: 500;
    color: #334155;
    margin-bottom: 8px;
}

.empty-state p {
    font-size: 13px;
    color: #64748b;
    margin-bottom: 20px;
}

/* Modal */
.modal-simple .modal-content {
    border-radius: 20px;
    border: none;
}

.modal-simple .modal-header {
    padding: 20px 24px;
    border-bottom: 1px solid #f0f0f0;
}

.modal-simple .modal-body {
    padding: 24px;
    max-height: 500px;
    overflow-y: auto;
}

.modal-simple .modal-footer {
    padding: 16px 24px;
    border-top: 1px solid #f0f0f0;
    background: #fafbfc;
}

.member-grid-simple {
    display: flex;
    flex-direction: column;
    gap: 12px;
}

.member-card-simple {
    display: flex;
    align-items: center;
    gap: 12px;
    padding: 12px;
    border: 1px solid #f0f0f0;
    border-radius: 12px;
    transition: all 0.2s;
}

.member-card-simple:hover {
    background: #fafbfc;
    border-color: #e5e7eb;
}

.member-avatar-modal {
    width: 44px;
    height: 44px;
    border-radius: 12px;
    object-fit: cover;
    background: #f5f5f5;
}

.member-info-modal h6 {
    font-size: 14px;
    font-weight: 600;
    color: #1a1a2e;
    margin-bottom: 4px;
}

.member-info-modal p {
    font-size: 12px;
    color: #6c757d;
    margin: 0;
}

.preview-stats-simple {
    display: flex;
    gap: 16px;
    margin-bottom: 20px;
    padding-bottom: 16px;
    border-bottom: 1px solid #f0f0f0;
}

.preview-stat-simple {
    font-size: 12px;
    color: #6c757d;
    background: #f8f9fa;
    padding: 4px 12px;
    border-radius: 20px;
}

/* Responsive */
@media (max-width: 900px) {
    .structure-item {
        width: 340px;
    }
}

@media (max-width: 768px) {
    .card-header-custom {
        padding: 20px;
        flex-direction: column;
        align-items: flex-start;
    }
    
    .header-right {
        width: 100%;
        justify-content: space-between;
    }
    
    .structures-grid {
        padding: 20px;
        gap: 20px;
    }
    
    .structure-item {
        width: 100%;
        max-width: 400px;
    }
    
    .card-padding {
        padding: 16px;
    }
    
    .action-buttons {
        justify-content: flex-start;
    }
    
    .pagination-wrapper {
        padding: 16px 20px;
    }
}

@media (max-width: 480px) {
    .card-header-custom {
        padding: 16px;
    }
    
    .header-left h3 {
        font-size: 16px;
    }
    
    .structures-grid {
        padding: 16px;
        gap: 16px;
    }
    
    .structure-item {
        width: 100%;
    }
    
    .btn-action {
        width: 32px;
        height: 32px;
    }
    
    .member-row {
        padding: 4px 0;
    }
    
    .member-name-small {
        font-size: 12px;
    }
}
</style>

{{-- Alert Messages --}}
@if(session('success'))
<div class="alert alert-custom alert-success alert-dismissible fade show" role="alert">
    <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
</div>
@endif

@if(session('error'))
<div class="alert alert-custom alert-danger alert-dismissible fade show" role="alert">
    <i class="fas fa-exclamation-circle me-2"></i>{{ session('error') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
</div>
@endif

<div class="main-card">
    {{-- Header --}}
    <div class="card-header-custom">
        <div class="header-left">
            <h3>
                <i class="fas fa-sitemap me-2" style="color: #1976d2;"></i>
                Struktur Organisasi
            </h3>
            <p>Kelola struktur dan anggota organisasi</p>
        </div>
        <div class="header-right">
            <span class="badge-stat">
                <i class="fas fa-layer-group"></i> Total: {{ $data->total() }}
            </span>
            <span class="badge-stat active">
                <i class="fas fa-check-circle"></i> Aktif: {{ $data->where('is_active', true)->count() }}
            </span>
            <a href="{{ route('admin.organization-structure.create') }}" class="btn-add">
                <i class="fas fa-plus"></i> Tambah
            </a>
        </div>
    </div>

    @if($data->count() > 0)
    {{-- Grid Cards - CENTERED HORIZONTALLY --}}
    <div class="structures-grid">
        @foreach($data as $structure)
        @php
            $members = $structure->members->sortBy('order');
            $memberCount = $members->count();
            $previewMembers = $members->take(2);
        @endphp
        <div class="structure-item">
            <div class="card-padding">
                {{-- Header Card --}}
                <div class="card-header-info">
                    <div>
                        <div class="structure-title">{{ $structure->name }}</div>
                        <div class="structure-date">
                            <i class="far fa-calendar-alt"></i>
                            {{ $structure->created_at->translatedFormat('d F Y') }}
                        </div>
                    </div>
                    <div>
                        @if($structure->is_active)
                        <span class="status status-active">Aktif</span>
                        @else
                        <span class="status status-inactive">Nonaktif</span>
                        @endif
                    </div>
                </div>

                {{-- Member Info --}}
                <div class="member-info">
                    <div class="member-count">
                        <span class="count-badge">
                            <i class="fas fa-users"></i> {{ $memberCount }} Anggota
                        </span>
                        <button type="button" class="btn-view" data-bs-toggle="modal" data-bs-target="#previewModal{{ $structure->id }}">
                            Lihat Semua <i class="fas fa-arrow-right ms-1"></i>
                        </button>
                    </div>

                    {{-- Member Preview --}}
                    <div class="member-list">
                        @forelse($previewMembers as $member)
                        <div class="member-row">
                            <div class="member-avatar-small">
                                @if($member->photo)
                                <img src="{{ asset('storage/'.$member->photo) }}" alt="{{ $member->name }}">
                                @else
                                <i class="fas fa-user"></i>
                                @endif
                            </div>
                            <div>
                                <div class="member-name-small">{{ Str::limit($member->name, 20) }}</div>
                                <div class="member-position-small">{{ Str::limit($member->position, 25) }}</div>
                            </div>
                        </div>
                        @empty
                        <div class="empty-members">
                            <i class="fas fa-user-plus me-1"></i> Belum ada anggota
                        </div>
                        @endforelse
                        
                        @if($memberCount > 2)
                        <div class="member-row">
                            <div class="member-avatar-small">
                                <i class="fas fa-ellipsis-h"></i>
                            </div>
                            <div>
                                <div class="member-name-small">+ {{ $memberCount - 2 }} anggota lainnya</div>
                            </div>
                        </div>
                        @endif
                    </div>
                </div>

                {{-- Action Buttons --}}
                <div class="action-buttons">
                    <form method="POST" action="{{ route('admin.organization-structure.toggle-active', $structure->id) }}" class="d-inline">
                        @csrf
                        <button type="submit" 
                                class="btn-action {{ $structure->is_active ? 'btn-toggle-on' : 'btn-toggle-off' }}"
                                title="{{ $structure->is_active ? 'Nonaktifkan' : 'Aktifkan' }}">
                            <i class="fas {{ $structure->is_active ? 'fa-toggle-on' : 'fa-toggle-off' }}"></i>
                        </button>
                    </form>
                    
                    <button type="button" 
                            class="btn-action btn-preview" 
                            data-bs-toggle="modal" 
                            data-bs-target="#previewModal{{ $structure->id }}"
                            title="Preview">
                        <i class="fas fa-eye"></i>
                    </button>
                    
                    <a href="{{ route('admin.organization-structure.edit', $structure->id) }}" 
                       class="btn-action btn-edit"
                       title="Edit">
                        <i class="fas fa-edit"></i>
                    </a>
                    
                    <form method="POST" action="{{ route('admin.organization-structure.destroy', $structure->id) }}" 
                          class="d-inline"
                          onsubmit="return confirm('Apakah Anda yakin ingin menghapus struktur "{{ $structure->name }}"? Semua anggota di dalamnya juga akan terhapus secara permanen.')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn-action btn-delete" title="Hapus">
                            <i class="fas fa-trash-alt"></i>
                        </button>
                    </form>
                </div>
            </div>
        </div>
        @endforeach
    </div>

    {{-- Pagination - CENTERED --}}
    <div class="pagination-wrapper">
        {{ $data->links() }}
    </div>

    @else
    {{-- Empty State --}}
    <div class="empty-state">
        <i class="fas fa-sitemap"></i>
        <h5>Belum ada struktur organisasi</h5>
        <p>Tambahkan struktur organisasi untuk ditampilkan di halaman publik</p>
        <a href="{{ route('admin.organization-structure.create') }}" class="btn-add">
            <i class="fas fa-plus"></i> Tambah Struktur
        </a>
    </div>
    @endif
</div>

{{-- Preview Modals --}}
@foreach($data as $structure)
@php
    $members = $structure->members->sortBy('order');
    $memberCount = $members->count();
@endphp
<div class="modal fade modal-simple" id="previewModal{{ $structure->id }}" tabindex="-1" aria-labelledby="previewModalLabel{{ $structure->id }}" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <div>
                    <h5 class="modal-title" id="previewModalLabel{{ $structure->id }}">{{ $structure->name }}</h5>
                    @if($structure->is_active)
                    <span class="status status-active mt-1" style="display: inline-block; font-size: 10px;">Aktif</span>
                    @endif
                </div>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
            </div>
            <div class="modal-body">
                <div class="preview-stats-simple">
                    <span class="preview-stat-simple">
                        <i class="fas fa-users"></i> {{ $memberCount }} Anggota
                    </span>
                    <span class="preview-stat-simple">
                        <i class="far fa-calendar-alt"></i> {{ $structure->created_at->translatedFormat('d F Y') }}
                    </span>
                </div>

                @if($memberCount > 0)
                <div class="member-grid-simple">
                    @foreach($members as $member)
                    <div class="member-card-simple">
                        @if($member->photo)
                        <img src="{{ asset('storage/'.$member->photo) }}" class="member-avatar-modal" alt="{{ $member->name }}">
                        @else
                        <div class="member-avatar-modal d-flex align-items-center justify-content-center bg-light">
                            <i class="fas fa-user text-secondary"></i>
                        </div>
                        @endif
                        <div class="member-info-modal">
                            <h6>{{ $member->name }}</h6>
                            <p>{{ $member->position }}</p>
                        </div>
                    </div>
                    @endforeach
                </div>
                @else
                <div class="text-center py-4">
                    <i class="fas fa-user-friends fa-2x text-muted mb-2" style="opacity: 0.5;"></i>
                    <p class="text-muted mb-0">Belum ada anggota</p>
                </div>
                @endif
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light btn-sm" data-bs-dismiss="modal">Tutup</button>
                <a href="{{ route('admin.organization-structure.edit', $structure->id) }}" class="btn btn-primary btn-sm">
                    <i class="fas fa-edit"></i> Edit Struktur
                </a>
            </div>
        </div>
    </div>
</div>
@endforeach
@endsection