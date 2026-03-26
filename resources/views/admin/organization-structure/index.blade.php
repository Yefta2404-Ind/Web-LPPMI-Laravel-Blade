@extends('layouts.admin')

@section('page-title', 'Struktur Organisasi')

@section('content')
@if(session('success'))
<div class="alert alert-success alert-dismissible fade show mb-4" role="alert">
    <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
</div>
@endif

@if(session('error'))
<div class="alert alert-danger alert-dismissible fade show mb-4" role="alert">
    <i class="fas fa-exclamation-circle me-2"></i>{{ session('error') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
</div>
@endif

<div class="org-container">
    <div class="org-header">
        <h3><i class="fas fa-sitemap org-icon"></i> Struktur Organisasi</h3>
        <div class="header-right">
            <div class="header-stats">
                <span class="stat-item">
                    <i class="fas fa-layer-group"></i>
                    Total: {{ $data->total() }}
                </span>
                <span class="stat-item">
                    <i class="fas fa-toggle-on"></i>
                    Aktif: {{ $data->where('is_active', true)->count() }}
                </span>
            </div>
            <a href="{{ route('admin.organization-structure.create') }}" class="btn-add">
                <i class="fas fa-plus"></i> Tambah Struktur
            </a>
        </div>
    </div>

    @if($data->count() > 0)
    <div class="table-responsive">
        <table class="org-table">
            <thead>
                <tr>
                    <th>Nama Struktur</th>
                    <th width="100" class="text-center">Anggota</th>
                    <th width="120" class="text-center">Status</th>
                    <th width="160" class="text-end">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($data as $structure)
                <tr class="{{ $structure->is_active ? 'row-active' : '' }}">
                    <td>
                        <div class="structure-info">
                            <div class="status-dot {{ $structure->is_active ? 'dot-active' : 'dot-inactive' }}"></div>
                            <div>
                                <div class="structure-name">{{ $structure->name }}</div>
                                <div class="structure-meta">
                                    <i class="far fa-calendar"></i>
                                    {{ $structure->created_at->format('d M Y') }}
                                </div>
                            </div>
                        </div>
                    </td>
                    <td class="text-center">
                        <span class="member-badge">{{ $structure->members->count() }}</span>
                    </td>
                    <td class="text-center">
                        @if($structure->is_active)
                        <span class="badge-active">Aktif</span>
                        @else
                        <span class="badge-inactive">Nonaktif</span>
                        @endif
                    </td>
                    <td class="text-end">
                        <div class="action-buttons">
                            <!-- Toggle Active -->
                            <form method="POST" action="{{ route('admin.organization-structure.toggle-active', $structure->id) }}">
                                @csrf
                                <button type="submit"
                                        class="btn-toggle {{ $structure->is_active ? 'btn-toggle-on' : 'btn-toggle-off' }}"
                                        title="{{ $structure->is_active ? 'Nonaktifkan' : 'Aktifkan' }}"
                                        @if(!$structure->is_active) onclick="return confirm('Aktifkan struktur ini? Struktur aktif sebelumnya akan dinonaktifkan.')" @endif>
                                    <i class="fas {{ $structure->is_active ? 'fa-toggle-on' : 'fa-toggle-off' }}"></i>
                                </button>
                            </form>

                            <!-- Edit -->
                            <a href="{{ route('admin.organization-structure.edit', $structure->id) }}"
                               class="btn-action btn-edit" title="Edit">
                                <i class="fas fa-edit"></i>
                            </a>

                            <!-- Delete -->
                            <form method="POST" action="{{ route('admin.organization-structure.destroy', $structure->id) }}"
                                  onsubmit="return confirm('Hapus struktur ini? Semua anggota akan ikut terhapus.')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn-action btn-delete" title="Hapus">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>

                            <!-- Preview -->
                            <button type="button" class="btn-action btn-preview"
                                    data-bs-toggle="modal"
                                    data-bs-target="#previewModal{{ $structure->id }}"
                                    title="Preview">
                                <i class="fas fa-eye"></i>
                            </button>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="mt-4 px-2">
        {{ $data->links() }}
    </div>

    @else
    <div class="empty-state">
        <i class="fas fa-sitemap"></i>
        <h4>Belum ada struktur organisasi</h4>
        <p>Tambahkan struktur organisasi untuk ditampilkan di halaman publik</p>
        <a href="{{ route('admin.organization-structure.create') }}" class="btn-add mt-3">
            <i class="fas fa-plus"></i> Tambah Struktur
        </a>
    </div>
    @endif
</div>

<!-- Preview Modals -->
@foreach($data as $structure)
<div class="modal fade" id="previewModal{{ $structure->id }}" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">
                    <i class="fas fa-sitemap me-2"></i>{{ $structure->name }}
                    @if($structure->is_active)
                    <span class="badge-active ms-2" style="font-size:11px;">Aktif</span>
                    @endif
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <p class="text-muted mb-3" style="font-size:13px;">
                    {{ $structure->members->count() }} anggota
                </p>
                <div class="member-grid">
                    @foreach($structure->members->sortBy('order') as $member)
                    <div class="member-card">
                        <div class="member-info">
                            @if($member->photo)
                            <img src="{{ asset('storage/'.$member->photo) }}"
                                 class="member-avatar"
                                 alt="{{ $member->name }}"
                                 onerror="this.src='https://ui-avatars.com/api/?name={{ urlencode($member->name) }}&background=e9ecef&color=495057&size=50'">
                            @else
                            <img src="https://ui-avatars.com/api/?name={{ urlencode($member->name) }}&background=e9ecef&color=495057&size=50"
                                 class="member-avatar" alt="{{ $member->name }}">
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
                <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Tutup</button>
                <a href="{{ route('admin.organization-structure.edit', $structure->id) }}"
                   class="btn btn-primary btn-sm">
                    <i class="fas fa-edit me-1"></i> Edit
                </a>
            </div>
        </div>
    </div>
</div>
@endforeach

<style>
.org-container {
    background: white;
    border-radius: 12px;
    padding: 24px;
    box-shadow: 0 2px 8px rgba(0,0,0,0.05);
}

.org-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 24px;
    padding-bottom: 16px;
    border-bottom: 1px solid #f0f0f0;
}

.org-header h3 {
    margin: 0;
    font-size: 18px;
    font-weight: 600;
    color: #333;
    display: flex;
    align-items: center;
    gap: 10px;
}

.org-icon { color: #4361ee; }

.header-right {
    display: flex;
    align-items: center;
    gap: 16px;
}

.header-stats {
    display: flex;
    gap: 12px;
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

.stat-item i { color: #28a745; }

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
    transition: background 0.2s;
}

.btn-add:hover { background: #3651d4; color: white; }

.org-table {
    width: 100%;
    border-collapse: collapse;
}

.org-table thead {
    background: #f8f9fa;
}

.org-table th {
    padding: 14px 16px;
    font-weight: 600;
    color: #495057;
    font-size: 14px;
    border-bottom: 2px solid #e9ecef;
    text-align: left;
}

.org-table td {
    padding: 16px;
    border-bottom: 1px solid #f0f0f0;
    vertical-align: middle;
}

.org-table tr:hover { background: #f8fafc; }

.row-active { background: #f0fff4; }
.row-active:hover { background: #e8fef0; }

.structure-info {
    display: flex;
    align-items: center;
    gap: 12px;
}

.status-dot {
    width: 10px;
    height: 10px;
    border-radius: 50%;
    flex-shrink: 0;
}

.dot-active { background: #28a745; }
.dot-inactive { background: #dee2e6; }

.structure-name {
    font-weight: 500;
    color: #333;
    font-size: 15px;
}

.structure-meta {
    font-size: 12px;
    color: #888;
    margin-top: 3px;
    display: flex;
    align-items: center;
    gap: 5px;
}

.member-badge {
    display: inline-block;
    padding: 4px 10px;
    background: #e7f5ff;
    color: #0c63e4;
    border-radius: 4px;
    font-size: 13px;
    font-weight: 500;
}

.badge-active {
    display: inline-block;
    padding: 4px 10px;
    background: #d4edda;
    color: #155724;
    border: 1px solid #c3e6cb;
    border-radius: 4px;
    font-size: 12px;
    font-weight: 500;
}

.badge-inactive {
    display: inline-block;
    padding: 4px 10px;
    background: #f8f9fa;
    color: #6c757d;
    border: 1px solid #dee2e6;
    border-radius: 4px;
    font-size: 12px;
    font-weight: 500;
}

.action-buttons {
    display: flex;
    align-items: center;
    gap: 6px;
    justify-content: flex-end;
}

.action-buttons form { margin: 0; }

.btn-toggle {
    padding: 7px 10px;
    border: none;
    border-radius: 6px;
    font-size: 16px;
    cursor: pointer;
    transition: all 0.2s;
    line-height: 1;
}

.btn-toggle-on { color: #28a745; background: #d4edda; border: 1px solid #c3e6cb; }
.btn-toggle-on:hover { background: #c3e6cb; }
.btn-toggle-off { color: #6c757d; background: #f8f9fa; border: 1px solid #dee2e6; }
.btn-toggle-off:hover { background: #e2e6ea; }

.btn-action {
    padding: 7px 10px;
    border-radius: 6px;
    font-size: 13px;
    cursor: pointer;
    transition: all 0.2s;
    border: 1px solid #dee2e6;
    background: white;
    color: #495057;
    text-decoration: none;
    display: inline-flex;
    align-items: center;
}

.btn-edit:hover { color: #856404; background: #fff3cd; border-color: #ffc107; }
.btn-delete:hover { color: #fff; background: #dc3545; border-color: #dc3545; }
.btn-preview:hover { color: #0c63e4; background: #e7f5ff; border-color: #0c63e4; }

/* Modal */
.member-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(260px, 1fr));
    gap: 12px;
}

.member-card {
    border: 1px solid #e9ecef;
    border-radius: 8px;
    padding: 12px;
}

.member-info {
    display: flex;
    align-items: center;
    gap: 12px;
}

.member-avatar {
    width: 48px;
    height: 48px;
    border-radius: 8px;
    object-fit: cover;
    flex-shrink: 0;
}

.member-name {
    font-weight: 500;
    color: #212529;
    font-size: 14px;
}

.member-position {
    color: #6c757d;
    font-size: 13px;
    margin-top: 2px;
}

/* Empty state */
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

.empty-state h4 { margin: 0 0 8px; color: #666; font-size: 18px; }
.empty-state p { margin: 0; color: #999; font-size: 14px; }

@media (max-width: 768px) {
    .org-header { flex-direction: column; align-items: flex-start; gap: 12px; }
    .header-right { width: 100%; flex-direction: column; align-items: flex-start; gap: 10px; }
    .btn-add { width: 100%; justify-content: center; }
    .org-container { padding: 16px; }
}
</style>
@endsection